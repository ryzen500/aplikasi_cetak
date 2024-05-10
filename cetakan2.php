<?php
require_once __DIR__ . '/vendor/autoload.php'; // Library tambahan jika dibutuhkan

// Siapkan koneksi ke database
$dsn = 'pgsql:host=192.168.214.222;port=5121;dbname=db_rswb_simulasi_20221227';
$user = 'developer';
$password = 's6SpprwyLVqh7kFg';

$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Dapatkan data yang dibutuhkan
$pendaftaran_id = isset($_GET['pendaftaran_id']) ? (int)$_GET['pendaftaran_id'] : 0;

// Dapatkan informasi rumah sakit, pendaftaran, pasien, dan pegawai
$modProfilRs = $pdo->query("SELECT * FROM profilrumahsakit_m WHERE profilrs_id = 1")->fetch(PDO::FETCH_ASSOC);
$modPendaftaran = $pdo->query("SELECT ruangan_m.ruangan_singkatan as ruangan_singkatan,* FROM pendaftaran_t left join ruangan_m on pendaftaran_t.ruangan_id = ruangan_m.ruangan_id WHERE pendaftaran_id = $pendaftaran_id")->fetch(PDO::FETCH_ASSOC);
$modPasien = $pdo->query("SELECT * FROM pasien_m WHERE pasien_id = {$modPendaftaran['pasien_id']}")->fetch(PDO::FETCH_ASSOC);
$print = $pdo->query("SELECT * FROM pegawai_m WHERE pegawai_id = 1")->fetch(PDO::FETCH_ASSOC);

$umur = explode(" ", $modPendaftaran['umur']);

// Stylesheet dan penyesuaian layout untuk cetak
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Karcis</title>
    <style type="text/css" media="print">
        /* body.receipt .sheet { width: 12cm; height: 12mm; } */
        @media print {
            body.receipt { width: 12cm; }  
            #print-head { display: block; } 
            td, th { font-size: 9pt !important; }
            header, footer { display: none !important; }
        }
        @page { margin: 0mm; }
        html { background-color: #FFFFFF; }
        body { margin: 2px 5mm 2px 5mm; }
    </style>
</head>
<body >
        <table width="100%" border="0" style="margin-top: 20px; margin-bottom: 30px;">
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

        <table style="width: 100%; border: none; margin-bottom: 0px;">
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
                <td><b>Dr: <?= $modPendaftaran['pegawai_nama']; ?> </b></td>
            </tr>
            <tr>
                <td><b>No. Pendaftaran: <?= $modPendaftaran['no_pendaftaran']; ?> </b></td>
            </tr>
        </table>

        <table style="width: 100%; border: none; margin-bottom: 0px;">
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
        </table>

        <table style="width: 100%; border: none; margin-bottom: 0px;">
            <tr>
                <td>Silakan duduk di ruang tunggu poli</td>
            </tr>
            <tr>
                <td>Berlaku untuk 1x kunjungan</td>
            </tr>
        </table>

        <table style="width: 100%; border: none; margin-bottom: 0px;">
            <tr>
                <td>Printed by: <?= $print['nama_pegawai']; ?></td>
            </tr>
            <tr>
                <td><?= date('d-m-Y H:i:s'); ?></td>
            </tr>
        </table>
</body>
</html>
