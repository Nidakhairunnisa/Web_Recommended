<?php
include "database.php";

$nim = $_POST['nim'];

$sql = "SELECT * FROM data_kuesioner WHERE nim = '$nim'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "sudah pernah";
    }
} else {
    echo "belum pernah";
}
$conn->close();




?>