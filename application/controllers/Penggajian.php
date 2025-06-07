<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penggajian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }
        $models = array(
            'Rekap_model' => 'rekap'
        );
        $this->load->model($models);
        $this->load->model('Penggajian_model');
        $this->user = $this->ion_auth->user()->row();
        $this->load->library('user_agent');
    }

    public function index()
    {
        $this->session->set_userdata('referred_from', current_url());
        $chek = $this->ion_auth->is_admin();
        if (!$chek) {
            $hasil = 0;
        } else {
            $hasil = 1;
        }
        $user = $this->user;
        $data = array(
            'user' => $user,
            'users' => $this->ion_auth->user()->row(),
            'result' => $hasil,
        );
        $this->template->load('template/template', 'penggajian/penggajian_list', $data);
        $this->load->view('template/datatables');
    }

    // Fungsi untuk mengekspor data penggajian sebagai CSV
    public function export_csv()
    {
        $filename = 'data_penggajian.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $data_penggajian = $this->rekap->pengajar();
        $file = fopen('php://output', 'w');

        // Header untuk kolom CSV
        $header = array("No", "NIP", "Nama Pengajar", "Kehadiran", "Transport", "Gaji Pokok", "Total");
        fputcsv($file, $header);

        $no = 0;
        foreach ($data_penggajian as $row) {
            $no++;
            $hadir = $this->rekap->totalHadir_bak_3($row->nomor_induk);
            $tunjangan = 12500;
            $gapok = 200000;
            $total = $tunjangan + $gapok;
            $tot_gaji = $hadir * $total;
            $line = array($no, $row->nomor_induk, $row->nama_user, $hadir, $tunjangan, $gapok, $tot_gaji);
            fputcsv($file, $line);
        }

        fclose($file);
        exit;
    }

    // Fungsi untuk mengekspor data penggajian sebagai PDF
    public function export_pdf()
    {
        $this->load->library('pdf'); // Pastikan library PDF telah di-load
        $data_penggajian = $this->rekap->pengajar();
        
        $pdf = new PDF(); // Inisialisasi library PDF
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, 'Data Penggajian', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1);
        $pdf->Cell(20, 10, 'NIP', 1);
        $pdf->Cell(40, 10, 'Nama Pengajar', 1);
        $pdf->Cell(20, 10, 'Kehadiran', 1);
        $pdf->Cell(30, 10, 'Transport', 1);
        $pdf->Cell(30, 10, 'Gaji Pokok', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        $no = 0;
        foreach ($data_penggajian as $row) {
            $no++;
            $hadir = $this->rekap->totalHadir_bak_3($row->nomor_induk);
            $tunjangan = 12500;
            $gapok = 200000;
            $total = $tunjangan + $gapok;
            $tot_gaji = $hadir * $total;

            $pdf->Cell(10, 10, $no, 1);
            $pdf->Cell(20, 10, $row->nomor_induk, 1);
            $pdf->Cell(40, 10, $row->nama_user, 1);
            $pdf->Cell(20, 10, $hadir, 1);
            $pdf->Cell(30, 10, $tunjangan, 1);
            $pdf->Cell(30, 10, $gapok, 1);
            $pdf->Cell(30, 10, $tot_gaji, 1);
            $pdf->Ln();
        }

        $pdf->Output('D', 'data_penggajian.pdf');
    }
}
