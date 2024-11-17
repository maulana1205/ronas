<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\Controller;

class report extends Controller
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $transaksis = $transaksiModel->getAllTransaksi();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'ID Barang');
        $sheet->setCellValue('C1', 'ID Pembeli');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Jumlah');
        $sheet->setCellValue('F1', 'Total Harga');
        $sheet->setCellValue('G1', 'Waktu Transaksi');

        $row = 2;
        foreach ($transaksis as $transaksi) {
            $sheet->setCellValue('A' . $row, $transaksi->id);
            $sheet->setCellValue('B' . $row, $transaksi->id_barang);
            $sheet->setCellValue('C' . $row, $transaksi->id_pembeli);
            $sheet->setCellValue('D' . $row, $transaksi->alamat);
            $sheet->setCellValue('E' . $row, $transaksi->jumlah);
            $sheet->setCellValue('F' . $row, $transaksi->total_harga);
            $sheet->setCellValue('G' . $row, $transaksi->created_date);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="transaksi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
