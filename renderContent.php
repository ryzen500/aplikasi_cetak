<?php
require_once __DIR__ . '/vendor/autoload.php'; // Library tambahan jika dibutuhkan
// Koneksi ke database dan query staging
// $dsn = 'pgsql:host=192.168.214.222;port=5121;dbname=db_rswb_simulasi_20221227';
// $user = 'developer';
// $password = 's6SpprwyLVqh7kFg';

// Koneksi ke database dan query running
$dsn = 'pgsql:host=192.168.214.225;port=5121;dbname=db_rswb_running_new';
$user = 'developer';
$password = 's6SpprwyLVqh7kFg';

$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Dapatkan data yang dibutuhkan
$pendaftaran_id = isset($_GET['pendaftaran_id']) ? (int)$_GET['pendaftaran_id'] : 0;

// Dapatkan informasi rumah sakit, pendaftaran, pasien, dan pegawai
$modProfilRs = $pdo->query("SELECT * FROM profilrumahsakit_m WHERE profilrs_id = 1")->fetch(PDO::FETCH_ASSOC);
$modPendaftaran = $pdo->query("SELECT ruangan_m.ruangan_singkatan as ruangan_singkatan,pegawai_m.nama_pegawai as nama_pegawai,* FROM pendaftaran_t left join ruangan_m on pendaftaran_t.ruangan_id = ruangan_m.ruangan_id left join pegawai_m on pendaftaran_t.pegawai_id = pegawai_m.pegawai_id WHERE pendaftaran_id = $pendaftaran_id")->fetch(PDO::FETCH_ASSOC);
$modPasien = $pdo->query("SELECT kabupaten_m.kabupaten_nama as kabupaten_nama,* FROM pasien_m left join kabupaten_m on pasien_m.kabupaten_id = kabupaten_m.kabupaten_id WHERE pasien_id = {$modPendaftaran['pasien_id']}")->fetch(PDO::FETCH_ASSOC);
$print = $pdo->query("SELECT * FROM pegawai_m WHERE pegawai_id = 1")->fetch(PDO::FETCH_ASSOC);

$umur = explode(" ", $modPendaftaran['umur']);

// Stylesheet dan penyesuaian layout untuk cetak
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Antrian</title>
    <style type="text/css">
        body {
            margin: 0;
            /* Tidak ada margin di seluruh tubuh */
            padding: 0;
            /* Tidak ada padding di seluruh tubuh */
            font-size: 9pt;
            /* Mengatur ukuran font untuk semua elemen */
        }

        table {
            width: 100%;
            /* Lebar penuh tanpa margin */
            border-collapse: collapse;
            /* Menghapus spasi antar elemen tabel */
            padding: 0;
            /* Tidak ada padding pada tabel */
            margin: 0;
            /* Tidak ada margin pada tabel */
        }

        td,
        th {
            text-align: left;
            /* Pastikan teks sejajar kiri */
            padding: 0;
            /* Tidak ada padding pada sel tabel */
            margin: 0;
            /* Tidak ada margin pada sel tabel */
        }

        @page {
            margin: 0mm;
            /* Tidak ada margin pada halaman cetak */
        }

        @media print {
            body {
                width: 100%;
                /* Lebar penuh pada cetakan */
            }
        }
    </style>
</head>

<body >
    <table width="100%" border="0" style="margin-top: 10px; margin-bottom: 10px;">
        <tr>
            <td align="left">
                <div>
                    <b><?= strtoupper($modProfilRs['nama_rumahsakit']); ?></b>
                </div>
                <div>
                    Telp. <?= $modProfilRs['no_telp_profilrs']; ?> , Fax. <?= $modProfilRs['no_faksimili']; ?>
                </div>
                <div>
                    <?= $modProfilRs['alamatlokasi_rumahsakit']; ?>
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%; border: none; margin-bottom: 10px;">
        <?php if ($modPendaftaran['ruangan_id'] !== 1) { // Contoh
        ?>
            <tr>
                <td>
                    <h1 style="font-size: 16pt;">Antrian No. <?= $modPendaftaran['ruangan_singkatan'] . "-" . $modPendaftaran['no_urutantri']; ?></h1>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td><b>Poli: <?= $modPendaftaran['ruangan_nama']; ?> </b></td>
        </tr>
        <tr>
            <td><b>Dr: <?= $modPendaftaran['nama_pegawai']; ?> </b></td>
        </tr>
        <tr>
            <td><b>No. Pendaftaran: <?= $modPendaftaran['no_pendaftaran']; ?> </b></td>
        </tr>
    </table>

    <table style="width: 100%; border: none; margin-bottom: 20px;">
        <tr>
            <td><strong>No RM: <?= $modPasien['no_rekam_medik']; ?></strong></td>
        </tr>
        <tr>
            <td><b><?= $modPasien['nama_pasien']; ?></b></td>
        </tr>
        <tr>
            <td>[<?= !empty($modPasien['jeniskelamin']) ? $modPasien['jeniskelamin'] : ' - '; ?>] <?= $umur[0] . ' (' . $umur[2] . ') Tahun'; ?></td>
        </tr>
        <tr>
            <td>Alamat: <?= strtoupper($modPasien['alamat_pasien']); ?></td>
        </tr>

        <tr>
            <td>kabupaten: <?= strtoupper($modPasien['kabupaten_nama']); ?></td>
        </tr>
    </table>

    <table style="width: 100%; border: none; margin-bottom: 20px;">
        <tr>
            <td>Silakan duduk di ruang tunggu poli</td>
        </tr>
        <tr>
            <td>Berlaku untuk 1x kunjungan</td>
        </tr>
    </table>

    <table style="width: 100%; border: none; margin-bottom: 0px;">
        <tr>
            <td>Printed Date: <?= $print['nama_pegawai']; ?></td>
        </tr>
        <tr>
            <td><?= date('d-m-Y H:i:s'); ?></td>
        </tr>
    </table>
</body>

</html>