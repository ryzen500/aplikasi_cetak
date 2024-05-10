<?php
// Koneksi ke database dan query staging
// $dsn = 'pgsql:host=192.168.214.222;port=5121;dbname=db_rswb_simulasi_20221227';
// $user = 'developer';
// $password = 's6SpprwyLVqh7kFg';

// Koneksi ke database dan query running
$dsn = 'pgsql:host=192.168.214.225;port=5121;dbname=db_rswb_running_new';
$user = 'developer';
$password = 's6SpprwyLVqh7kFg';
try {
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Ambil parameter nomor dari query string atau body request (POST/GET)
    $nomor = isset($_REQUEST['nomor']) ? $_REQUEST['nomor'] : '';

    if (empty($nomor)) {
        http_response_code(400);
        echo json_encode(['error' => 'Parameter nomor dibutuhkan.']);
        exit;
    }

    // Query untuk mendapatkan data dari database
    $sql = "
    SELECT t.*
FROM pendaftaran_t   t
LEFT JOIN penjaminpasien_m p ON p.penjamin_id = t.penjamin_id
LEFT JOIN pasien_m m ON m.pasien_id = t.pasien_id
LEFT JOIN buatjanjipoli_t  n ON n.buatjanjipoli_id = t.buatjanjipoli_id
WHERE 
    (n.no_buatjanji = :nomor 
    OR n.no_kartu_bpjs = :nomor 
    OR m.no_rekam_medik = :nomor 
    OR m.no_identitas_pasien = :nomor)
    AND t.pendaftaran_id IS NOT NULL
    AND t.tgl_pendaftaran ::date = CURRENT_DATE
ORDER BY t.pendaftaran_id DESC
LIMIT 1";

// $sql = " SELECT t.*
//     FROM buatjanjipoli_t t
//     LEFT JOIN penjaminpasien_m p ON p.penjamin_id = t.penjamin_id
//     LEFT JOIN pasien_m n ON n.pasien_id = t.pasien_id
//     WHERE 
//         (t.no_buatjanji = :nomor 
//         OR t.no_kartu_bpjs = :nomor 
//         OR n.no_rekam_medik = :nomor 
//         OR n.no_identitas_pasien = :nomor)
//         AND t.pendaftaran_id IS NOT NULL
//         AND t.tgljadwal::date = CURRENT_DATE
//     ORDER BY t.buatjanjipoli_id DESC
//     LIMIT 1";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':nomor', $nomor, PDO::PARAM_STR);

    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data === false) {
        // http_response_code(404);
        echo json_encode(['error' => 'Data tidak ditemukan.']);
    } else {
        // Berhasil, mengarahkan ke halaman PHP lain dengan query string
        // $query_params = http_build_query($data);
        $pendaftaran_id = $data['pendaftaran_id'];
        //  var_dump($data['pendaftaran_id']);
        echo json_encode(['redirect' => 'halaman_tujuan.php?pendaftaran_id=' . $pendaftaran_id]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
