import re

def process_file():
    with open('application/controllers/Provinsi.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # Define function replacements
    # 1. Functions for getting data and rendering views
    view_functions = [
        'VisiRPJPD', 'VisiRPJMD', 'TahapanRPJPD', 'TahapanRPJMD', 'IUPRPJPD', 'IUPRPJMD'
    ]
    
    for fn in view_functions:
        if fn == 'VisiRPJPD':
            pattern = r'public function VisiRPJPD\(\)\s*\{([\s\S]*?)\$visi_data = \$this->db->query\("SELECT v\.\*,k\.\* FROM visirpjpdp as v, kodewilayah as k WHERE v\.KodeWilayah = k\.Kode AND v\.deleted_at IS NULL"\)->result_array\(\);'
            replacement = r'''public function VisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "v.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND v.KodeWilayah = '$KodeWilayah'";
		}
		
		$visi_data = $this->db->query("SELECT v.*,k.* FROM visirpjpdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND $where_clause")->result_array();'''
            content = re.sub(pattern, replacement, content)

        elif fn == 'VisiRPJMD':
            pattern = r'public function VisiRPJMD\(\)\s*\{([\s\S]*?)\$visi_data = \$this->db->query\("SELECT v\.\*,k\.\* FROM visirpjmdp as v, kodewilayah as k WHERE v\.KodeWilayah = k\.Kode AND v\.deleted_at IS NULL"\)->result_array\(\);'
            replacement = r'''public function VisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "v.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND v.KodeWilayah = '$KodeWilayah'";
		}
		
		$visi_data = $this->db->query("SELECT v.*,k.* FROM visirpjmdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND $where_clause")->result_array();'''
            content = re.sub(pattern, replacement, content)
            
        elif fn == 'TahapanRPJPD':
            pattern = r'public function TahapanRPJPD\(\)\s*\{([\s\S]*?)\$Data\[\'Tahapan\'\] = \$this->db->query\("SELECT v\.\*,t\.\*,k\.\* FROM visirpjpdp as v,tahapanrpjpdp as t, kodewilayah as k WHERE t\._Id = v\.Id AND t\.KodeWilayah = k\.Kode AND t\.deleted_at IS NULL"\)->result_array\(\);'
            replacement = r'''public function TahapanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "t.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND t.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjpdp as v,tahapanrpjpdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND $where_clause")->result_array();'''
            content = re.sub(pattern, replacement, content)

        elif fn == 'TahapanRPJMD':
            pattern = r'public function TahapanRPJMD\(\)\s*\{([\s\S]*?)\$Data\[\'Tahapan\'\] = \$this->db->query\("SELECT v\.\*,t\.\*,k\.\* FROM visirpjmdp as v,tahapanrpjmdp as t, kodewilayah as k WHERE t\._Id = v\.Id AND t\.KodeWilayah = k\.Kode AND t\.deleted_at IS NULL"\)->result_array\(\);'
            replacement = r'''public function TahapanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "t.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND t.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjmdp as v,tahapanrpjmdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND $where_clause")->result_array();'''
            content = re.sub(pattern, replacement, content)

        elif fn == 'IUPRPJPD':
            pattern = r'public function IUPRPJPD\(\)\s*\{([\s\S]*?)\$Data\[\'IUP\'\] = \$this->db->query\("SELECT v\.\*,i\.\*,k\.\* FROM visirpjpdp as v,iuprpjpdp as i, kodewilayah as k WHERE i\._Id = v\.Id AND i\.KodeWilayah = k\.Kode AND i\.deleted_at IS NULL"\)->result_array\(\);'
            replacement = r'''public function IUPRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "i.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND i.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjpdp as v,iuprpjpdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND $where_clause")->result_array();'''
            content = re.sub(pattern, replacement, content)

        elif fn == 'IUPRPJMD':
            pattern = r'public function IUPRPJMD\(\)\s*\{([\s\S]*?)\$Data\[\'IUP\'\] = \$this->db->query\("SELECT v\.\*,i\.\*,k\.\* FROM visirpjmdp as v,iuprpjmdp as i, kodewilayah as k WHERE i\._Id = v\.Id AND i\.KodeWilayah = k\.Kode AND i\.deleted_at IS NULL"\)->result_array\(\);'
            replacement = r'''public function IUPRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "i.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND i.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjmdp as v,iuprpjmdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND $where_clause")->result_array();'''
            content = re.sub(pattern, replacement, content)

    # 2. Modify Input functions to add KodeWilayah
    input_functions = [
        'InputVisiRPJPD', 'InputMisiRPJPD', 'InputTujuanRPJPD', 'InputSasaranRPJPD', 'InputTahapanRPJPD', 'InputIUPRPJPD',
        'InputVisiRPJMD', 'InputMisiRPJMD', 'InputTujuanRPJMD', 'InputSasaranRPJMD', 'InputTahapanRPJMD', 'InputIUPRPJMD',
        'InputSubTahapanRPJPD', 'InputPembangunanTahapanRPJPD', 'InputSubTahapanRPJMD', 'InputPembangunanTahapanRPJMD'
    ]

    for fn in input_functions:
        # Regex to find `public function InputXYZ(){ ... $this->db->insert('tablename',$_POST);`
        pattern = r'public function ' + fn + r'\(\)\s*\{\s*\$this->db->insert\(\'(.*?)\',\$_POST\);'
        replacement = r'''public function ''' + fn + r'''(){  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('\1',$_POST);'''
        content = re.sub(pattern, replacement, content)
        
    with open('application/controllers/Provinsi.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
