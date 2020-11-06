<?php
include "database.php";


$sql = "SELECT * FROM data_user WHERE nama_lengkap = '$nama_dicari'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $nim = $row['nim'];
    }
}else{
	    $nim = '1111111111';
} 
$conn->close();

?>