<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barang extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        $barangModel = new \App\Models\BarangModel();
        $barangs = $barangModel->findAll();

        return view('barang/index', [
            'barangs' => $barangs,
        ]);
    }

    public function view()
    {
        $id = $this->request->geturi()->getSegment(3);

        $barangModel = new \App\Models\BarangModel();
        $barang = $barangModel->find($id);

        return view('barang/view', [
            'barang' => $barang,
        ]);
    }

    public function create()
    {
        if ($this->request->getPost()) {
            // Jika ada data yang di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'barang');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                // Simpan datanya
                $barangModel = new \App\Models\BarangModel();
                $barang = new \App\Entities\Barang();

                $barang->fill($data);
                $barang->gambar = $this->request->getFile('gambar');
                $barang->created_by = $this->session->get('id');
                $barang->created_date = date("Y-m-d H:i:s");

                $barangModel->save($barang);

                $id = $barangModel->insertID();

                $segments = ['barang', 'view', $id];
                // Redirect ke /barang/view/$id
                return redirect()->to(site_url($segments));
            }
        }

        return view('barang/create');
    }

    public function update()
    {
        $id = $this->request->geturi()->getSegment(3);

        $barangModel = new \App\Models\BarangModel();
        $barang = $barangModel->find($id);

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'barangupdate');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $b = new \App\Entities\Barang();
                $b->id = $id;
                $b->fill($data);

                if ($this->request->getFile('gambar')->isValid()) {
                    $b->gambar = $this->request->getFile('gambar');
                }

                $b->updated_by = $this->session->get('id');
                $b->updated_date = date("Y-m-d H:i:s");

                $barangModel->save($b);

                $segments = ['barang', 'view', $id];
                return redirect()->to(base_url($segments));
            }
        }

        return view('barang/update', [
            'barang' => $barang,
        ]);
    }

    public function delete()
    {
        $id = $this->request->uri->getSegment(3);

        $barangModel = new \App\Models\BarangModel();
        $barangModel->delete($id);

        return redirect()->to(site_url('barang/index'));
    }

    // Function untuk export data barang ke Excel
    public function export()
    {
        $barangModel = new \App\Models\BarangModel();
        $barangs = $barangModel->findAll();

        // Load PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Product');
        $sheet->setCellValue('C1', 'Gambar');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Stok');

        // Populate data
        $row = 2;
        foreach ($barangs as $index => $barang) {
            $sheet->setCellValue('A' . $row, ($index + 1));
            $sheet->setCellValue('B' . $row, $barang->nama);  // Akses properti dengan object
            $sheet->setCellValue('C' . $row, $barang->gambar); // Akses properti dengan object
            $sheet->setCellValue('D' . $row, $barang->harga);  // Akses properti dengan object
            $sheet->setCellValue('E' . $row, $barang->stok);   // Akses properti dengan object
            $row++;
        }

        // Set the filename and write the file
        $filename = 'data_barang_' . date('Ymd') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send download response
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
