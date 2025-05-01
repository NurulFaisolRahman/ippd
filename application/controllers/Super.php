<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

  public function __construct() {
		parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function VisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/VisiRPJPN',$Data);
	}

  public function InputVisiRPJPN(){  
    $this->db->insert('visirpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function MisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjpn as v, misirpjpn as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/MisiRPJPN',$Data);
	}

  public function InputMisiRPJPN(){  
    $this->db->insert('misirpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TujuanRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjpn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TujuanRPJPN',$Data);
	}

  public function InputTujuanRPJPN(){  
    $this->db->insert('tujuanrpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function SasaranRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjpn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t, sasaranrpjpn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/SasaranRPJPN',$Data);
	}

  public function InputSasaranRPJPN(){  
    $this->db->insert('sasaranrpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function VisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/VisiRPJMN',$Data);
	}

  public function InputVisiRPJMN(){  
    $this->db->insert('visirpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function MisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjmn as v, misirpjmn as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/MisiRPJMN',$Data);
	}

  public function InputMisiRPJMN(){  
    $this->db->insert('misirpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TujuanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjmn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TujuanRPJMN',$Data);
	}

  public function InputTujuanRPJMN(){  
    $this->db->insert('tujuanrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function SasaranRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjmn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t, sasaranrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/SasaranRPJMN',$Data);
	}

  public function InputSasaranRPJMN(){  
    $this->db->insert('sasaranrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

	public function VMTS(){
    $Header['Halaman'] = 'VMTS';
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
    $this->load->view('Super/header',$Header);
		$this->load->view('Super/VMTS',$Data);
	}

	public function GetVMTS($Id){
    echo json_encode($this->db->get_where('vmts', array('Id' => $Id))->row_array());
	}

	public function InputVMTS(){  
    $this->db->insert('vmts',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVMTS(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('vmts', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }
  public function Kementerian() {
    $Header['Halaman'] = 'Kementerian';
    $Data['Kementerian'] = $this->db->query("SELECT * FROM `kementerian` WHERE deleted_at IS NULL")->result_array();
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/Kementerian', $Data);
}

public function InputKementerian() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    // Validate period
    if (!is_numeric($TahunMulai) || !is_numeric($TahunAkhir) || $TahunMulai > $TahunAkhir) {
        echo 'Tahun Mulai harus lebih kecil atau sama dengan Tahun Akhir!';
        return;
    }

    $data = [
        'NamaKementerian' => $this->input->post('NamaKementerian'),
        'TahunMulai' => $TahunMulai,
        'TahunAkhir' => $TahunAkhir,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('kementerian', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateKementerian() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    // Validate period
    if (!is_numeric($TahunMulai) || !is_numeric($TahunAkhir) || $TahunMulai > $TahunAkhir) {
        echo 'Tahun Mulai harus lebih kecil atau sama dengan Tahun Akhir!';
        return;
    }

    $data = [
        'NamaKementerian' => $this->input->post('NamaKementerian'),
        'TahunMulai' => $TahunMulai,
        'TahunAkhir' => $TahunAkhir,
        'edited_at' => date('Y-m-d H:i:s')
    ];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('kementerian', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteKementerian() {
    $data = [
        'deleted_at' => date('Y-m-d H:i:s')
    ];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('kementerian', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

  public function IsuStrategis() {
    $Header['Halaman'] = 'Isu';
    
    // Query dengan JOIN ke tabel kementerian untuk Isu Strategis
    $Data['IsuStrategis'] = $this->db->query("
        SELECT ist.*, k.NamaKementerian 
        FROM isu_strategis ist
        LEFT JOIN kementerian k ON ist.IdKementerian = k.Id
        WHERE ist.deleted_at IS NULL
    ")->result_array();
    
    // Ambil data kementerian untuk dropdown
    $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Ambil data periode unik dari kementerian
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir
        FROM kementerian
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai ASC
    ")->result_array();
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/IsuStrategis', $Data);
}

public function InputIsuStrategis() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuStrategis() {
    $data = [
        'IdKementerian'

=> $this->input->post('IdKementerian'),
        'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuStrategis() {
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id']);
    $this->db->update('isu_strategis', $_POST);
    if ($this->db->affected_rows()) {
        echo '1';
    } else {
        echo 'Gagal Hapus Data!';
    }
}

// New method to fetch Kementerian by period
public function GetKementerianByPeriode() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $Kementerian = $this->db->query("
        SELECT Id, NamaKementerian
        FROM kementerian
        WHERE TahunMulai = ? AND TahunAkhir = ? AND deleted_at IS NULL
    ", [$TahunMulai, $TahunAkhir])->result_array();
    
    echo json_encode($Kementerian);
}


public function SPM() {
  $Header['Halaman'] = 'Kementerian';
  
  // Query dengan JOIN ke tabel kementerian
  $Data['SPM'] = $this->db->query("
      SELECT s.*, k.NamaKementerian 
      FROM spm s
      LEFT JOIN kementerian k ON s.IdKementerian = k.Id
      WHERE s.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir
      FROM kementerian
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/SPM', $Data);
}



public function InputSPM() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaSPM' => $this->input->post('NamaSPM'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'TargetTahun1' => $this->input->post('TargetTahun1'),
      'TargetTahun2' => $this->input->post('TargetTahun2'),
      'TargetTahun3' => $this->input->post('TargetTahun3'),
      'TargetTahun4' => $this->input->post('TargetTahun4'),
      'TargetTahun5' => $this->input->post('TargetTahun5'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('spm', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateSPM() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaSPM' => $this->input->post('NamaSPM'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'TargetTahun1' => $this->input->post('TargetTahun1'),
      'TargetTahun2' => $this->input->post('TargetTahun2'),
      'TargetTahun3' => $this->input->post('TargetTahun3'),
      'TargetTahun4' => $this->input->post('TargetTahun4'),
      'TargetTahun5' => $this->input->post('TargetTahun5'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('spm', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteSPM() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('spm', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}




public function ProyekStrategis() {
  $Header['Halaman'] = 'Kementerian';
  
  // Query dengan JOIN ke tabel kementerian dan program_strategis
  $Data['Proyek'] = $this->db->query("
      SELECT p.*, k.NamaKementerian, ps.NamaProgram
      FROM proyek_strategis p
      LEFT JOIN kementerian k ON p.IdKementerian = k.Id
      LEFT JOIN program_strategis ps ON p.IdProgramStrategis = ps.Id
      WHERE p.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM kementerian 
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai DESC
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/ProyekStrategis', $Data);
}

public function GetProgramByKementerianAndPeriode() {
  $TahunMulai = $this->input->post('TahunMulai');
  $TahunAkhir = $this->input->post('TahunAkhir');
  $IdKementerian = $this->input->post('IdKementerian');
  $data = $this->db->query("
      SELECT Id, NamaProgram 
      FROM program_strategis 
      WHERE IdKementerian = ? 
      AND TahunMulai = ? 
      AND TahunAkhir = ? 
      AND deleted_at IS NULL
  ", [$IdKementerian, $TahunMulai, $TahunAkhir])->result_array();
  echo json_encode($data);
}

public function InputProyek() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'IdProgramStrategis' => $this->input->post('IdProgramStrategis'),
      'NamaProyek' => $this->input->post('NamaProyek'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'TargetTahun1' => $this->input->post('TargetTahun1'),
      'TargetTahun2' => $this->input->post('TargetTahun2'),
      'TargetTahun3' => $this->input->post('TargetTahun3'),
      'TargetTahun4' => $this->input->post('TargetTahun4'),
      'TargetTahun5' => $this->input->post('TargetTahun5'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('proyek_strategis', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateProyek() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'IdProgramStrategis' => $this->input->post('IdProgramStrategis'),
      'NamaProyek' => $this->input->post('NamaProyek'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'TargetTahun1' => $this->input->post('TargetTahun1'),
      'TargetTahun2' => $this->input->post('TargetTahun2'),
      'TargetTahun3' => $this->input->post('TargetTahun3'),
      'TargetTahun4' => $this->input->post('TargetTahun4'),
      'TargetTahun5' => $this->input->post('TargetTahun5'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('proyek_strategis', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteProyek() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('proyek_strategis', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}


public function ProgramStrategis() {
  $Header['Halaman'] = 'Kementerian';
  
  // Query dengan JOIN ke tabel kementerian
  $Data['Program'] = $this->db->query("
      SELECT p.*, k.NamaKementerian 
      FROM program_strategis p
      LEFT JOIN kementerian k ON p.IdKementerian = k.Id
      WHERE p.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir
      FROM kementerian
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/ProgramStrategis', $Data);
}

public function InputProgram() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaProgram' => $this->input->post('NamaProgram'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'TargetTahun1' => $this->input->post('TargetTahun1'),
      'TargetTahun2' => $this->input->post('TargetTahun2'),
      'TargetTahun3' => $this->input->post('TargetTahun3'),
      'TargetTahun4' => $this->input->post('TargetTahun4'),
      'TargetTahun5' => $this->input->post('TargetTahun5'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('program_strategis', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateProgram() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaProgram' => $this->input->post('NamaProgram'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'TargetTahun1' => $this->input->post('TargetTahun1'),
      'TargetTahun2' => $this->input->post('TargetTahun2'),
      'TargetTahun3' => $this->input->post('TargetTahun3'),
      'TargetTahun4' => $this->input->post('TargetTahun4'),
      'TargetTahun5' => $this->input->post('TargetTahun5'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('program_strategis', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteProgram() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('program_strategis', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}


    public function PermasalahanPokok() {
      $Header['Halaman'] = 'Isu';
      
      // Query dengan JOIN ke tabel kementerian
      $Data['PermasalahanPokok'] = $this->db->query("
          SELECT p.*, k.NamaKementerian 
          FROM permasalahan_pokok p
          LEFT JOIN kementerian k ON p.IdKementerian = k.Id
          WHERE p.deleted_at IS NULL
      ")->result_array();
      
      // Ambil data kementerian untuk dropdown
      $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
      
      // Ambil data periode unik dari kementerian
      $Data['Periode'] = $this->db->query("
          SELECT DISTINCT TahunMulai, TahunAkhir 
          FROM kementerian 
          WHERE deleted_at IS NULL
          ORDER BY TahunMulai DESC
      ")->result_array();
      
      $this->load->view('Super/header', $Header);
      $this->load->view('Super/PermasalahanPokok', $Data);
  }

  public function InputPermasalahanPokok() {
      $data = [
          'IdKementerian' => $this->input->post('IdKementerian'),
          'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
          'TahunMulai' => $this->input->post('TahunMulai'),
          'TahunAkhir' => $this->input->post('TahunAkhir'),
          'created_at' => date('Y-m-d H:i:s')
      ];
      
      $this->db->insert('permasalahan_pokok', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
  }

  public function UpdatePermasalahanPokok() {
      $data = [
          'IdKementerian' => $this->input->post('IdKementerian'),
          'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
          'TahunMulai' => $this->input->post('TahunMulai'),
          'TahunAkhir' => $this->input->post('TahunAkhir'),
          'edited_at' => date('Y-m-d H:i:s')
      ];
      
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('permasalahan_pokok', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
  }

  public function DeletePermasalahanPokok() {
      $data = ['deleted_at' => date('Y-m-d H:i:s')];
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('permasalahan_pokok', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
  }
  
  public function IsuKLHS() {
    $Header['Halaman'] = 'Isu';
    
    // Query dengan JOIN ke tabel kementerian
    $Data['IsuKLHS'] = $this->db->query("
        SELECT ik.*, k.NamaKementerian 
        FROM isu_klhs ik
        LEFT JOIN kementerian k ON ik.IdKementerian = k.Id
        WHERE ik.deleted_at IS NULL
    ")->result_array();
    
    // Ambil data kementerian untuk dropdown
    $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Ambil data periode unik dari kementerian
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/IsuKLHS', $Data);
}

public function InputIsuKLHS() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('isu_klhs', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuKLHS() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_klhs', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuKLHS() {
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_klhs', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function IsuGlobal() {
  $Header['Halaman'] = 'Isu';
  
  // Query dengan JOIN ke tabel kementerian
  $Data['IsuGlobal'] = $this->db->query("
      SELECT ig.*, k.NamaKementerian 
      FROM isu_global ig
      LEFT JOIN kementerian k ON ig.IdKementerian = k.Id
      WHERE ig.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM kementerian 
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai DESC
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/IsuGlobal', $Data);
}

public function InputIsuGlobal() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuGlobal' => $this->input->post('NamaIsuGlobal'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('isu_global', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuGlobal() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuGlobal' => $this->input->post('NamaIsuGlobal'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_global', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuGlobal() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_global', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function IsuNasional(): void {
  $Header['Halaman'] = 'Isu';
  
  // Query dengan JOIN ke tabel kementerian
  $Data['IsuNasional'] = $this->db->query("
      SELECT ina.*, k.NamaKementerian 
      FROM isu_nasional ina
      LEFT JOIN kementerian k ON ina.IdKementerian = k.Id
      WHERE ina.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM kementerian 
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai DESC
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/IsuNasional', $Data);
}

public function InputIsuNasional() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuNasional' => $this->input->post('NamaIsuNasional'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('isu_nasional', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuNasional() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuNasional' => $this->input->post('NamaIsuNasional'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_nasional', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuNasional() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_nasional', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

}



