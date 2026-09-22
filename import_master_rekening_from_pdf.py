import pymupdf
import pymysql
import re
import time

pdf_path = r"C:\Users\user\.gemini\antigravity-ide\brain\ee6ffe9b-71c1-4efc-a3d7-58ddf535b64c\.user_uploaded\media_1789978225208.pdf"

print("Starting extraction from PDF...")
start_time = time.time()
doc = pymupdf.open(pdf_path)

records = {}  # kode_rekening -> {nama, level, parent_kode}

for page_idx, page in enumerate(doc):
    tf = page.find_tables()
    for tab in tf.tables:
        rows = tab.extract()
        for row in rows:
            if not row or len(row) < 7:
                continue
            
            # Clean each column
            cols = [str(c or '').strip() for c in row[:6]]
            nama = str(row[6] or '').strip()
            
            # Valid akun starts with 4, 5, or 6
            if not cols[0] or cols[0] not in ['4', '5', '6']:
                continue
            
            # Find non-empty code segments
            code_parts = []
            for part in cols:
                # Remove spaces inside parts if any
                p = re.sub(r'\s+', '', part)
                if p and p != '-':
                    code_parts.append(p)
                else:
                    break
            
            if not code_parts:
                continue
            
            kode_rekening = ".".join(code_parts)
            level = len(code_parts)
            parent_kode = ".".join(code_parts[:-1]) if level > 1 else None
            
            # Clean name (remove newlines, extra spaces)
            nama_clean = " ".join(nama.split())
            if not nama_clean:
                continue
            
            # Truncate to 255 chars if needed (DB field limit)
            if len(nama_clean) > 255:
                nama_clean = nama_clean[:255]
            
            records[kode_rekening] = {
                'kode': kode_rekening,
                'nama': nama_clean,
                'level': level,
                'parent': parent_kode
            }

print(f"Extraction completed in {time.time()-start_time:.2f}s.")
print(f"Total unique records found: {len(records)}")

# Connect to MySQL and insert
print("Connecting to MySQL...")
conn = pymysql.connect(
    host='localhost',
    user='root',
    password='',
    db='ippd',
    charset='utf8mb4',
    autocommit=False
)
cursor = conn.cursor()

batch = []
batch_size = 500
inserted = 0

sql = """
INSERT INTO master_rekening (kode_rekening, nama_rekening, level, parent_kode, created_at, updated_at)
VALUES (%s, %s, %s, %s, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    nama_rekening = VALUES(nama_rekening),
    level = VALUES(level),
    parent_kode = VALUES(parent_kode),
    updated_at = NOW()
"""

for rec in records.values():
    batch.append((rec['kode'], rec['nama'], rec['level'], rec['parent']))
    if len(batch) >= batch_size:
        cursor.executemany(sql, batch)
        conn.commit()
        inserted += len(batch)
        print(f"Inserted/updated {inserted} records...")
        batch = []

if batch:
    cursor.executemany(sql, batch)
    conn.commit()
    inserted += len(batch)
    print(f"Inserted/updated {inserted} records...")

conn.close()
print(f"Successfully finished importing {inserted} records to master_rekening!")
