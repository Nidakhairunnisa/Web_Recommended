

<?php
include "controller/database.php";

 $sql = "SELECT * FROM `data_user` WHERE nim = $nim";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$nim  =	$row['nim'];
		$nama_lengkap = $row['nama_lengkap'];
		$password = $row['password'];
		$file_user = $row['file_user'];
		$namaFile = "Data/user/" . $file_user;
    }
} else {
    echo "0 results";
}
$conn->close();

?>
