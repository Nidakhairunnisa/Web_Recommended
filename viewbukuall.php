<html>
	<head>
		<meta charset="UTF-8">
		<title>sistem perpus</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>

<?php
include "controler/database.php";


$template=file_get_contents("templateviewbuku.html"); 
// echo $template;

$sql = "SELECT * FROM `buku`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$judul = $row["judul_buku"];
		if (strlen($nama)>14) {
			$judul = substr($judul, 0,15) . "..." ;
		} 
		
		
		
        $templatefinal = str_replace("ID_BUKU",$row["id_buku"],$template);
		$templatefinal = str_replace("NAMA_BUKU",$nama,$templatefinal);
		$templatefinal = str_replace("PENGARANG_BUKU",$row["pengarang"],$templatefinal);
		$templatefinal = str_replace("NAMA_FILE",$row["file_name"],$templatefinal);
		$templatefinal = str_replace("PENERBIT_BUKU",$row["penerbit"],$templatefinal);
		$templatefinal = str_replace("KLARIFIKASI_BUKU",$row["klarifikasi_buku"],$templatefinal);
		$templatefinal = str_replace("SINOPSIS_BUKU",$row["sinopsis"],$templatefinal);
		
		echo $templatefinal;
		
		

    }
} else {
    echo "0 results";
}

if ($conn->query($sqldelete) === TRUE) {
    echo "New record created successfully";
	header( 'Location: http://www.perpus.com/home.php' ) ;
} else {
    echo "Error: " . $sqldelete . "<br>" . $conn->error;
}
   
$conn->close();
?>
	
</body>
</html>