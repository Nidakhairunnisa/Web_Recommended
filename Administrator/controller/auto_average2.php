<?php
include "database.php";

$sqlinsert = "INSERT INTO data_rating (id_rating, id_pinjam, nim, rating)
VALUES (null, $id_pinjamSatuan, $nimSatuan, $angka_acakSatuan)";

if ($conn->query($sqlinsert) === TRUE) {
   //echo  "telah tersimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>