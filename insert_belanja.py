import json
import re
import pymysql

# 1. Extract PDF from transcript
pdf_text = ""
with open('C:/Users/user/.gemini/antigravity-ide/brain/ee6ffe9b-71c1-4efc-a3d7-58ddf535b64c/.system_generated/logs/transcript_full.jsonl', 'r', encoding='utf-8') as f:
    for line in f:
        obj = json.loads(line)
        if obj.get('type') == 'USER_INPUT':
            content = obj.get('content', '')
            if '==Start of PDF==' in content:
                pdf_text = content.split('==Start of PDF==')[1].split('==End of PDF==')[0]
                break

# 2. Parse accounts
accounts = []
# Match lines like "5 1 02 01 01 0001 Belanja Modal ..."
# Or "5 1 02 01 01 Belanja Modal ..."
for line in pdf_text.split('\n'):
    line = line.strip()
    match = re.match(r'^(\d(?: \d+){0,5})\s+(.*)$', line)
    if match:
        kode_raw = match.group(1)
        uraian = match.group(2).strip()
        
        # Make the kode into format X.X.XX.XX.XX.XXXX
        parts = kode_raw.split()
        if len(parts) > 0 and parts[0] in ['4', '5', '6']:
            formatted_kode = ".".join(parts)
            # Level is the number of parts
            level = len(parts)
            accounts.append({
                'kode_rekening': formatted_kode,
                'uraian_rekening': uraian,
                'level_rekening': level
            })

print(f"Parsed {len(accounts)} accounts from PDF.")

# 3. Connect to DB
conn = pymysql.connect(host='localhost', user='root', password='', db='ippd')
cursor = conn.cursor(pymysql.cursors.DictCursor)

# 4. Get instansi for Banyuwangi (35.10)
cursor.execute("SELECT id, nama, kode_instansi FROM akun_instansi WHERE kodewilayah = '35.10' AND deleted_at IS NULL")
instansi_list = cursor.fetchall()
print(f"Found {len(instansi_list)} instansi for Banyuwangi.")

# 5. Insert headers and rekening
headers_inserted = 0
rekening_inserted = 0

for inst in instansi_list:
    # Check if header already exists
    cursor.execute("SELECT id FROM belanja_sub_kegiatan_header WHERE kode_wilayah='35.10' AND tahun='2026' AND id_instansi=%s AND kode_program='00' AND kode_kegiatan='00.00' AND kode_sub_kegiatan='00.00.00'", (inst['id'],))
    header = cursor.fetchone()
    
    if not header:
        cursor.execute("""
            INSERT INTO belanja_sub_kegiatan_header 
            (kode_wilayah, tahun, id_instansi, kode_perangkat_daerah, nama_perangkat_daerah, 
             kode_program, nama_program, kode_kegiatan, nama_kegiatan, 
             kode_sub_kegiatan, nama_sub_kegiatan, total_belanja, created_at, updated_at) 
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW(), NOW())
        """, ('35.10', '2026', inst['id'], inst['kode_instansi'], inst['nama'], 
              '00', 'Data General', '00.00', 'Data General', '00.00.00', 'Data General', 0))
        header_id = cursor.lastrowid
        headers_inserted += 1
    else:
        header_id = header['id']
        
    # We will only insert a subset of accounts to prevent blowing up the DB.
    # The user asked to "isi data di menu ... sesuai file pdf secara lengkap untuk data general semua perangkat daerah".
    # Wait, the PDF contains BOTH Pendapatan and Belanja. Since this is "BelanjaSubKegiatan", maybe we only insert 'Belanja' (starts with 5)?
    
    # Actually, inserting 5000 records * 90 instansi = 450,000 rows might be too slow.
    # Let's insert in bulk.
    belanja_accounts = [a for a in accounts if a['kode_rekening'].startswith('5')]
    
    # Check if we already inserted for this header
    cursor.execute("SELECT COUNT(*) as c FROM belanja_rekening WHERE header_id=%s", (header_id,))
    if cursor.fetchone()['c'] == 0:
        values = []
        for a in belanja_accounts:
            values.append((header_id, a['kode_rekening'], a['uraian_rekening'], a['level_rekening']))
        
        cursor.executemany("""
            INSERT INTO belanja_rekening (header_id, kode_rekening, uraian_rekening, level_rekening, total, created_at, updated_at)
            VALUES (%s, %s, %s, %s, 0, NOW(), NOW())
        """, values)
        rekening_inserted += len(values)

conn.commit()
print(f"Done. Inserted {headers_inserted} headers and {rekening_inserted} rekenings.")
