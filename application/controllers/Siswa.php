<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . '../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Mata_pelajaran_model');
        $this->load->model('Nilai_model');
        $this->load->library('form_validation');
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    public function index() {
        $this->load->model('Siswa_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Mata_pelajaran_model');
        $this->load->model('Nilai_model');
    
        $data['siswa'] = $this->db->get('siswa')->result();
    
        $this->load->view('templates/header');
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id) {
        $this->load->model('Nilai_model');
        $this->load->model('Mata_pelajaran_model');
        $this->load->model('Jurusan_model');
    
        $siswa = $this->db->get_where('siswa', ['id' => $id])->row();
        $nilai = $this->Nilai_model->get_nilai_with_mapel($id);
    
        echo json_encode([
            'siswa' => $siswa,
            'nilai' => $nilai
        ]);
    }    
    public function create() {
        if ($this->input->post()) {
            $siswa_data = [
                'user_id'        => $this->session->userdata('user_id'),
                'nama_lengkap'   => $this->input->post('nama_lengkap'),
                'tempat_lahir'   => $this->input->post('tempat_lahir'),
                'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
                'nis'            => $this->input->post('nis'),
                'nisn'           => $this->input->post('nisn'),
                'no_ujian'       => $this->input->post('no_ujian'),
                'kelas'          => $this->input->post('kelas'),
                'nama_ortu'      => $this->input->post('nama_ortu'),            
                'status'         => $this->input->post('status'),
                'created_at'     => date('Y-m-d H:i:s')
            ];
            $this->Siswa_model->insert($siswa_data);
            redirect('siswa');
        }
        $this->load->view('templates/header');
        $this->load->view('siswa/create');
        $this->load->view('templates/footer');
    }
    

    public function get_mapel_by_jurusan() {
        $jurusan_id = $this->input->post('jurusan_id');
        $mapel = $this->Mata_pelajaran_model->get_by_jurusan($jurusan_id);
        echo json_encode($mapel);
    }
    public function import()
    {
        $this->load->library('upload');
    
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size']      = 2048;
    
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('file_excel')) {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('templates/header');
            $this->load->view('siswa/import', $data);
            $this->load->view('templates/footer');
        } else {
            $file = $this->upload->data('full_path');
    
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
            $data['preview'] = [];
    
            foreach ($sheet as $i => $row) {
                if ($i == 1) continue;
    
                $rawTanggal = $row['C'];
    
                if (is_numeric($rawTanggal)) {
                    $phpDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rawTanggal);
                    $tanggal_lahir = $phpDate->format('d/m/Y');
                } else {
                    $tanggal_lahir = $rawTanggal;
                }
    
                $data['preview'][] = [
                    'nama_lengkap' => $row['A'],
                    'tempat_lahir' => $row['B'],
                    'tanggal_lahir' => $tanggal_lahir,
                    'nis' => $row['D'],
                    'nisn' => $row['E'],
                    'no_ujian' => $row['F'],
                    'kelas' => $row['G'],
                    'nama_ortu' => $row['H'],
                    'status' => $row['I'],
                ];
            }
    
            $this->session->set_userdata('preview_data', $data['preview']);
            $this->load->view('templates/header');
            $this->load->view('siswa/import_preview', $data);
            $this->load->view('templates/footer');
        }
    }
    
    public function do_import()
    {
        $preview = $this->session->userdata('preview_data');
        if ($preview) {
            foreach ($preview as $row) {
                // Ubah tanggal dari dd/mm/yyyy ke yyyy-mm-dd
                $tgl_db = null;
                if (!empty($row['tanggal_lahir'])) {
                    $date = DateTime::createFromFormat('d/m/Y', $row['tanggal_lahir']);
                    if ($date) {
                        $tgl_db = $date->format('Y-m-d');
                    }
                }
    
                $siswa_data = [
                    'user_id'       => $this->session->userdata('user_id'),
                    'nama_lengkap'  => $row['nama_lengkap'],
                    'tempat_lahir'  => $row['tempat_lahir'],
                    'tanggal_lahir' => $tgl_db,
                    'nis'           => $row['nis'],
                    'nisn'          => $row['nisn'],
                    'no_ujian'      => $row['no_ujian'],
                    'kelas'         => $row['kelas'],
                    'nama_ortu'     => $row['nama_ortu'],
                    'status'        => $row['status'],
                    'created_at'    => date('Y-m-d H:i:s'),
                ];
    
                $this->Siswa_model->create($siswa_data);
            }
            $this->session->unset_userdata('preview_data');
        }
        redirect('siswa');
    }
    public function edit($id)
    {
        $siswa = $this->Siswa_model->get_by_id($id);

        if (!$siswa) {
            show_404();
        }

        if ($this->input->post()) {
            $siswa_data = [
                'nama_lengkap'   => $this->input->post('nama_lengkap'),
                'tempat_lahir'   => $this->input->post('tempat_lahir'),
                'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
                'nis'            => $this->input->post('nis'),
                'nisn'           => $this->input->post('nisn'),
                'no_ujian'       => $this->input->post('no_ujian'),
                'kelas'          => $this->input->post('kelas'),
                'nama_ortu'      => $this->input->post('nama_ortu'),
                'status'         => $this->input->post('status'),
                'updated_at'     => date('Y-m-d H:i:s')
            ];

            $this->Siswa_model->update($id, $siswa_data);
            redirect('siswa');
        }

        $data['siswa'] = $siswa;
        $this->load->view('templates/header');
        $this->load->view('siswa/edit', $data);
        $this->load->view('templates/footer');
    }


    public function delete($id = null)
    {
        if (!$id) {
            redirect('siswa');
        }
    
        $this->load->model('Siswa_model');
        $this->Siswa_model->delete($id);
        redirect('siswa');
    }    
}
