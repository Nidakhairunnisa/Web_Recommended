<?php
include "database.php";

if (isset ($_POST['nomor_id'])){
	$nomor_id = $_POST['nomor_id'];
} else {
	$nomor_id = "" ;
}

$id_pinjam = $_POST['id_pinjam'];
$id_user = $_POST['nim'];
$rating = $_POST['rating'];



$sqlupdate = "UPDATE data_rating SET id_pinjam = $id_pinjam, nim= $id_user, 
rating = $rating, WHERE id=$nomor_id";


$sqlinsert = "INSERT INTO data_rating (id_rating, id_pinjam, nim, rating)
VALUES (null, $id_pinjam, $id_user, $rating)";



if ($nomor_id == ""){
	$sql=$sqlinsert;
} else {
	$sql=$sqlupdate;
}


if ($conn->query($sql) === TRUE) {
    echo "sukses";
} else {
    echo "gagal";
}

$conn->close();
?>