<?php
include "database.php";

$nim = $_POST['nim'];

$sqlupdate = "UPDATE data_notif SET terbaca = 1 WHERE nim=$nim";


if ($conn->query($sqlupdate) === TRUE) {
			echo "sukses";
} else {
    echo "gagal";
}

$conn->close();
?>