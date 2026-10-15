import re

def process_file():
    with open('application/controllers/Daerah.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Update IsuStrategisDaerah to include children
    old_query = """                $Data['IsuStrategis'] = !empty($KodeWilayah) ? $this->db->query($sql, $params)->result_array() : [];"""
    
    new_query = """                $IsuStrategis = !empty($KodeWilayah) ? $this->db->query($sql, $params)->result_array() : [];
                
                // Fetch children Permasalahan
                if (!empty($IsuStrategis)) {
                    foreach ($IsuStrategis as &$isu) {
                        $isu['PermasalahanList'] = $this->db->where('IdIsuStrategis', $isu['Id'])
                                                            ->where('deleted_at IS NULL', NULL, FALSE)
                                                            ->get('isustrategisdaerah_permasalahan')
                                                            ->result_array();
                    }
                }
                $Data['IsuStrategis'] = $IsuStrategis;"""
    content = content.replace(old_query, new_query)
    
    # 2. Add methods for Permasalahan
    perm_methods = """
        // ==========================================
        // MANAJEMEN PERMASALAHAN ISU STRATEGIS
        // ==========================================
        
        public function GetPermasalahanById() {
            $id = $this->input->post('Id', TRUE);
            $data = $this->db->where('Id', $id)->where('deleted_at IS NULL', NULL, FALSE)->get('isustrategisdaerah_permasalahan')->row_array();
            echo json_encode($data);
        }

        public function InputPermasalahan() {
            $idIsuStrategis = trim($this->input->post('IdIsuStrategis', TRUE));
            $permasalahan = trim($this->input->post('Permasalahan', TRUE));
            
            if (empty($idIsuStrategis) || empty($permasalahan)) {
                echo "Data tidak boleh kosong!";
                return;
            }

            $data = array(
                'IdIsuStrategis' => $idIsuStrategis,
                'Permasalahan'   => $permasalahan
            );

            if ($this->db->insert('isustrategisdaerah_permasalahan', $data)) {
                echo "1";
            } else {
                echo "Gagal menyimpan data!";
            }
        }

        public function UpdatePermasalahan() {
            $id = $this->input->post('Id', TRUE);
            $idIsuStrategis = trim($this->input->post('IdIsuStrategis', TRUE));
            $permasalahan = trim($this->input->post('Permasalahan', TRUE));

            if (empty($idIsuStrategis) || empty($permasalahan)) {
                echo "Data tidak boleh kosong!";
                return;
            }

            $data = array(
                'IdIsuStrategis' => $idIsuStrategis,
                'Permasalahan'   => $permasalahan
            );

            $this->db->where('Id', $id);
            if ($this->db->update('isustrategisdaerah_permasalahan', $data)) {
                echo "1";
            } else {
                echo "Gagal memperbarui data!";
            }
        }

        public function DeletePermasalahan() {
            $id = $this->input->post('Id', TRUE);
            $data = array('deleted_at' => date('Y-m-d H:i:s'));
            $this->db->where('Id', $id);
            if ($this->db->update('isustrategisdaerah_permasalahan', $data)) {
                echo "1";
            } else {
                echo "Gagal menghapus data!";
            }
        }
"""
    # Insert right before DeleteIsuStrategis
    content = content.replace("        public function DeleteIsuStrategis() {", perm_methods + "\n        public function DeleteIsuStrategis() {")

    with open('application/controllers/Daerah.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
