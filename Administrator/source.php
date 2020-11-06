<?php
include "controller/database.php";

$jdlBuku = $_GET["query"];

// Query ke database.
$query  = $conn->query("SELECT * FROM data_buku WHERE judul_buku LIKE '%$jdlBuku%' ORDER BY judul_buku DESC");
$result = $query->fetch_all(MYSQLI_ASSOC);

// Format bentuk data untuk autocomplete.
foreach($result as $data) {
    $output['suggestions'][] = [
        'value' 		=> $data['id_buku'],
        'judul_buku'  	=> $data['judul_buku']
    ];
}

if (! empty($output)) {
    // Encode ke format JSON.
    echo json_encode($output);
}


?>