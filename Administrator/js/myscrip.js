


$(document).ready(function(event){
	// del user
	$('.delete-user').click(function (){
		alert("del this user");
	});
   $('#judul_buku').click(function(){
	   var judul_buku = $(this).attr(judul_buku);
	   
   })
   $('#searchbox').keypress(function (event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			doSearch();
		}  

	});
	
	$('.tanggal-kembali').click(function (){
		
		//saat span di klik kita ubah ke textbox
		var noid = $(this).attr('data-id');
		var statusNya = $(this).attr('status');
		var classNya = $(this).attr('class') + '-edit';
		
		var tglAwal = $(this).text();
		var textbox = "<input status='"+ statusNya +"' class='"+ classNya +"' data-id='"+ noid +"' type='date' value='"+ tglAwal +"'>";
		
		
		var bungkusTd = $(this).parent('td');
		bungkusTd.append(textbox);
		$(this).remove();
	});
	
	$('body').on('change', '.tanggal-kembali-edit', function(event){
		//var keycode = (event.keycode ? 
		//event.keycode : event.which);
		//if(keycode == '13'){
			
		//}
		var noid = $(this).attr('data-id');
		var statusNya = $(this).attr('status');
		var classNya = $(this).attr('class') + ' tanggal-kembali';
		
		var bungkusTd = $(this).parent("td");
		
		var elspan = "<span status='"+ statusNya +"' class='"+ classNya +"' data-id='"+ noid +"'>" + $(this).val() + "</span>";
		bungkusTd.append(elspan);
		$(this).remove();
		
		var alamatUpdate = "controller/updatestatuspeminjaman.php";
	  
		$.post(alamatUpdate, {id: noid, statusNya:statusNya}, function(result){
		//alert(result);
		
		setTimeout(location.reload.bind(location),3000);
		
		//window.location.reload();
		});
		
		
		});
	
	$('body').on('keyup','#judul_buku', function(){
		
	   var dicari = $(this).val();
	   var alamatTujuan = "controller/search_bukupinjam.php";
	var data = {judul_buku:dicari};
	
	   $.get(alamatTujuan, data, function(respon){
			 var buku = JSON.parse(respon);
			 var nomor;
			 var namaKetemu;
			 for (nomor=0; nomor<buku.length; nomor++){
				namaKetemu += buku[nomor];
				$('form').append(namaKetemu);
			 }
			 
	   });
   });
   
	$('#searchbutton').click(function (){

		doSearch();
	});
	
	$('.tombol-status').click(function (){
	  // ketika tombol-status dklik 
	  // kita akan mengubah text menjadi :
	  // terlewat, dipinjam dan dikembalikan 
	  
	  var status = $(this).attr('status');
	  var nextstatus = "";
	  var idNya = $(this).attr('id');
	 
	  var nimNya = $(this).attr('nim');
	  var judulbukuNya = $(this).parent('td').siblings('.judul-buku').text();
	  //alert ('nim' + nimNya + 'judul_buku' + judulbukuNya);
	  if (status == 'terlewat'){
		  nextstatus = 'dikembalikan';
	  }else if(status == 'dipinjam'){
		  nextstatus = 'dikembalikan';
	  }
	  
	  $(this).attr('status', nextstatus);
	  $(this).text(nextstatus);
	  //barulah panggil controller
	  //updatestatuspeminjaman.php?id=xstatus=/
	  
	  var alamatUpdate = "controller/updatestatuspeminjaman.php";
	  var dataNya = {id: idNya, statusNya:nextstatus, nim:nimNya, judul_buku:judulbukuNya};
	  
	  $.post(alamatUpdate, dataNya, function(result){
		//alert(result);
		
		setTimeout(location.reload.bind(location),3000);
		
		window.location.reload();
		});
	
	 
		
	});  
	  
});
  
  
function doSearch(){
	var alamatSaatIni = window.location.href;
	var nimDicari = $('#searchbox').val();
	var alamatTujuan;
	
	if(alamatSaatIni.includes('addpinjam')){
	// pencarian untuk addpinjam page
	 alamatTujuan = "home.php?a=addpinjam&nim=" + nimDicari;
	
	} else if(alamatSaatIni.includes('listbuku')){
	// pencarian untuk viewbukuall page
	 alamatTujuan = "home.php?a=listbuku&judul_buku=" + nimDicari;
	
	} else if(alamatSaatIni.includes('listuser')){
	// pencarian untuk list user page
	 alamatTujuan = "home.php?a=listuser&nim=" + nimDicari;
	
	} else if(alamatSaatIni.includes('addpeminjaman')){
	// pencarian untuk list user page
	 alamatTujuan = "home.php?a=addpeminjaman&judul_buku=" + nimDicari;
	
	}  
	
	
	window.location.href = alamatTujuan;
	
}
  

 
 