<?php
include "database.php";

	//$tombol_submit = Submit;
    if ($_POST['Submit'] == "Submit") {
    $tanggal_pinjam = $_POST['tgl_peminjaman'];
    $nim          	= $_POST['nim'];
    $judul_buku     = $_POST['judul_buku'];

//validasi data data kosong
    if (empty($tanggal_pinjam)||empty($nim)||empty($judul_buku)) {
        ?>
            <script language="JavaScript">
                alert('Data Harap Dilengkapi!');
            </script>
        <?php
    }
    else {
    //include "../../koneksi-tutor.php";
	
    //Masukan data ke Table
    $input    		= "INSERT INTO pinjam_buku (tanggal_pinjam,nim,judul_buku,status) VALUES ('$tanggal_pinjam','$nim','$judul_buku','dipinjam')";
    $query_input	= $conn->query($input);
    if ($query_input) {
    //Jika Sukses
    ?>
        <script language="JavaScript">
        alert('Input Peminjaman buku Berhasil');
		
		window.location.replace('http://<?=$_SERVER['SERVER_NAME']?>/administrator/home.php?a=addpinjam');

        </script>
    <?php
    }
    else {
    //Jika Gagal
    echo "Input peminjaman buku Gagal!, Silahkan diulangi!";
    }
//Tutup koneksi engine MySQL
    //mysql_close($Open);
    }
}
?>