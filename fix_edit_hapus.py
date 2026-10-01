import re

def process_file():
    with open('application/controllers/Provinsi.php', 'r', encoding='utf-8') as f:
        content = f.read()

    edit_hapus_functions = [
        'EditVisiRPJPD', 'HapusVisiRPJPD', 'EditMisiRPJPD', 'HapusMisiRPJPD', 'EditTujuanRPJPD', 'HapusTujuanRPJPD', 'EditSasaranRPJPD', 'HapusSasaranRPJPD', 'EditTahapanRPJPD', 'HapusTahapanRPJPD', 'EditIUPRPJPD', 'HapusIUPRPJPD',
        'EditVisiRPJMD', 'HapusVisiRPJMD', 'EditMisiRPJMD', 'HapusMisiRPJMD', 'EditTujuanRPJMD', 'HapusTujuanRPJMD', 'EditSasaranRPJMD', 'HapusSasaranRPJMD', 'EditTahapanRPJMD', 'HapusTahapanRPJMD', 'EditIUPRPJMD', 'HapusIUPRPJMD'
    ]

    for fn in edit_hapus_functions:
        if fn.startswith('Edit'):
            # public function EditXYZ(){  
            #   $this->db->where('Id',$_POST['Id']); 
            #   $this->db->update('tablename', $_POST);
            pattern = r'public function ' + fn + r'\(\)\{\s*\$this->db->where\(\'Id\',\$_POST\[\'Id\'\]\);\s*\$this->db->update\(\'(.*?)\', \$_POST\);'
            replacement = r'''public function ''' + fn + r'''(){  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('\1', $_POST);'''
            content = re.sub(pattern, replacement, content)
            
        elif fn.startswith('Hapus'):
            # public function HapusXYZ(){  
            #   $_POST['deleted_at'] = date('Y-m-d H:i:s');
            #   $this->db->where('Id',$_POST['Id'])->update('tablename', $_POST);
            pattern = r'public function ' + fn + r'\(\)\{\s*\$_POST\[\'deleted_at\'\] = date\(\'Y-m-d H:i:s\'\);\s*\$this->db->where\(\'Id\',\$_POST\[\'Id\'\]\)->update\(\'(.*?)\', \$_POST\);'
            replacement = r'''public function ''' + fn + r'''(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('\1', $_POST);'''
            content = re.sub(pattern, replacement, content)
            
    with open('application/controllers/Provinsi.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
