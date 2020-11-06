<html>
	<head>
		<meta charset="UTF-8">
		<title>sistem perpus</title>
		<link rel="stylesheet" type="text/css" href="administrator/css/style-view.css">
		<script src="administrator/js/jquery-3.3.1.min.js" ></script>
		<script src="js/myscripfilter.js" ></script>
	</head>
	<body>
	


<?php

include "controller/database.php";
	



$template=file_get_contents("templateviewbuku.html"); 
// echo $template;
$sql = "SELECT * FROM `data_buku`";


$result = $conn->query($sql);
$allbukufinal = '';

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$judul = $row["judul_buku"];
		if (strlen($judul)>14) {
			$judul = substr($judul, 0,15) . "..." ;
		} 
		
		
		
		//ini untuk all buku
        $templatefinal = str_replace("ID",$row["id"],$template);
		$templatefinal = str_replace("JUDUL_BUKU",$nama,$templatefinal);
		$allbukufinal = $allbukufinal . $templatefinal;
    }
	
	
} else {
    echo "0 results";
}

	
	echo $allbukufinal;

$conn->close();
?>
		
		
</body>
</html>