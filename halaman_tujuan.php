<?php
require_once __DIR__ . '/vendor/autoload.php'; // Pastikan Anda sudah menginstal mPDF via Composer

function createPdf($pendaftaran_id)
{
    // Koneksi ke database dan query staging
    // $dsn = 'pgsql:host=192.168.214.222;port=5121;dbname=db_rswb_simulasi_20221227';
    // $user = 'developer';
    // $password = 's6SpprwyLVqh7kFg';

    // Koneksi ke database dan query running
    $dsn = 'pgsql:host=192.168.214.225;port=5121;dbname=db_rswb_running_new';
    $user = 'developer';
    $password = 's6SpprwyLVqh7kFg';

    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Mendapatkan data yang diperlukan
    $modPendaftaran = $pdo->query("SELECT * FROM pendaftaran_t WHERE pendaftaran_id = $pendaftaran_id")->fetch(PDO::FETCH_ASSOC);
    $modPasien = $pdo->query("SELECT * FROM pasien_m WHERE pasien_id = {$modPendaftaran['pasien_id']}")->fetch(PDO::FETCH_ASSOC);

    if (!$modPendaftaran || !$modPasien) {
        throw new Exception("Data tidak ditemukan.");
    }

    // Buat instance mPDF
    $mpdf = new \Mpdf\Mpdf([
        // 'format' => [100, 120,10], // Ukuran kertas khusus
        'format' => [100, 120], // Ukuran kertas khusus
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 10,
        'margin_bottom' => 10
    ]);



    // Tambahkan JavaScript untuk Auto Print
    $javascript = '
this.print(true); // true untuk dialog cetak default
';

    $mpdf->SetJS($javascript); // Menambahkan JavaScript untuk cetak otomatis


    // $mpdf = new \Mpdf\Mpdf([
    //     'margin_left' => 10,
    //     'margin_right' => 10,
    //     'margin_top' => 10,
    //     'margin_bottom' => 10,
    // ]);
    // Tambahkan CSS
    $stylesheet = file_get_contents(__DIR__ . '/css/bootstrap.css');
    $mpdf->WriteHTML($stylesheet, 1);

    $formatkonten = file_get_contents(__DIR__ . '/css/STRUCK.css');
    $mpdf->WriteHTML($formatkonten, 1);

    $mpdf->AddPage('P'); // Posisi Potret (Portrait)

    // Tangkap konten dari file terpisah
    ob_start();
    include 'renderContent.php'; // Memasukkan file yang berisi konten
    $content = ob_get_clean();

    // Masukkan konten ke PDF
    $mpdf->WriteHTML($content);

    // Output PDF langsung ke browser
    $mpdf->Output();
}

// Coba cetak PDF dengan pendaftaran_id tertentu
try {
    createPdf(123); // Gantilah dengan ID yang relevan
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
