$(document).ready(function(event){
	$('body').on('click','#logout', function(e){
		e.preventDefault();
		var alamatTujuan = 'controller/verifikasi_kuesioner.php';
		var nim = $('#update-notif').attr('nim');
		var data = {nim:nim};
		 $.post(alamatTujuan, data,function(respon){
		   if(respon=='sudah pernah'){
				window.location="controller/logout.php";
		   } else {
			   $('#dialog-confirm').show();
		   }
		  
		});
		
		
	});
	
	$('#puas').click(function(){
		var nim = $('#update-notif').attr('nim');
		var nama = $('.dropdown-toggle span').text();
		sendQuestioner(1,nim,nama);
		
	});
	
	$('#tidak').click(function(){
		var nim = $('#update-notif').attr('nim');
		var nama = $('.dropdown-toggle span').text();
		sendQuestioner(0,nim,nama);
		
	});
	
	
	
	$('#advancesearch.non-active').hover(function(){
		$('.active.treeview').hide();
		
	});
	
	$('#advancesearch.non-active').mouseleave(function(){
		$('.active.treeview').css('display','block');
		
	});

   $('.label-success').click(function(){
	  //ubah dari success ke done 
	  $(this).attr('class', 'label-done');
	  
	  var elementtd = $(this).parent('td');
	  
	   var id_pinjam = $(this).attr('id-pinjam');
	   var alamatTujuan = "rating_skor.php?id_pinjam="+ id_pinjam;
	   //lalu memanggil rating_skor.php 
	   $.get(alamatTujuan, function(data){
		   elementtd.html(data);
		   
	   });
   });
   
    $('#advancesearch').click(function(){
	  $('.active.treeview').toggle();
	  $('.active.treeview').css('height','200px');
	  $('#advancesearch').removeClass('non-active');
   });
   
	 $('body').on('change','#rating-range', function(){
		 var nilai = $(this).val();
		 var newPoint, newPlace, offset;
		 var el = $(this); 
		 // Measure width of range input
	   width = el.width();
	   
	   // Figure out placement percentage between left and right of input
	   newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
	   
	   // Janky value to get pointer to line up better
	   offset = -1.3;
	   
	   // Prevent bubble from going beyond left or right (unsupported browsers)
	   if (newPoint < 0) { newPlace = 0; }
	   else if (newPoint > 1) { newPlace = width; }
	   else { newPlace = width * newPoint + offset; offset -= newPoint; }
	   
	   // Move bubble
	   $(".pop-up")
		 .css({
		   left: (newPlace-13),
		   marginLeft: offset + "%"
		 })
		 .text(el.val()); 
		 
	 $('.rating-value').text(nilai);
		doSearch();
		
	 
	 });
   
	
    $('body').on('click','.header', function(){
		var alamatTujuan = "?a=riwayatpinjam";
		
		//location.href=location.href + alamatTujuan;
		
	});
   
   
    $('body').on('click','#update-notif', function(){
		//alert('aaa');
		var alamatTujuan = "controller/updateterbacanotif.php";
		var nimUser = $(this).attr('nim');
		
		 $.post(alamatTujuan, {nim: nimUser},function(respon){
		   //alert(respon);
		   //location.reload();
		   //setTimeout(location.reload.bind(location),3000);
		
		});
		
		//alert('bbb');
	});
   
   
   
   $('body').on('click','.rating-skor span', function(){
		var nimUser = $('#nim-user').val();
		var skorUser = $(this).text();
		var id_pinjamUser = $(this).attr('id-pinjam');
		
		
		//alert('nim ' + nimUser + ' skor ' + skorUser + ' idpinjam ' + id_pinjamUser);
		
		
	   //jika diklik maka 
	   // kita kirimkan -----> nim, id_pinjam dan skor 
	   var alamatTujuan = "controller/save_rating.php";
	   var parentDiv = $(this).parent('.rating-skor').remove();
	   
	   $.post(alamatTujuan, {nim: nimUser, id_pinjam: id_pinjamUser, rating: skorUser},function(respon){
		   //alert(respon);
		   //location.reload();
	   });
		
   });
   
   
   
   
   
   
   $('#searchbox').keypress(function (event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			doSearch();
		}  

	});
	
	$('#search-penerbit').keypress(function (event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			doSearch();
		}  

	});
	
	$('#search-pengarang').keypress(function (event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			doSearch();
		}  

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
	  
	  if (status == 'terlewat'){
		  nextstatus = 'dikembalikan';
	  }else if(status == 'dipinjam'){
		  nextstatus = 'terlewat';
	  }
	  
	  $(this).attr('status', nextstatus);
	  $(this).text(nextstatus);
	  //barulah panggil controller
	  //updatestatuspeminjaman.php?id=xstatus=/
	  
	  var alamatUpdate = "controller/updatestatuspeminjaman.php";
	  
	  $.post(alamatUpdate, {id: idNya, statusNya:nextstatus}, function(result){
		alert(result);
		});
	
	 
		
	});  
	  
});
  
  
function doSearch(){
	var alamatSaatIni = window.location.href;
	var kataDicari = $('#searchbox').val();
	var penerbitDicari = $('#search-penerbit').val();
	var pengarangDicari = $('#search-pengarang').val();
	var rateDicari = $('#rating-range').val();
	
	
	if(penerbitDicari.length>0 && pengarangDicari.length>0 &&rateDicari.length>0 ){
	
		if(alamatSaatIni.includes('viewbuku')){
		// pencarian untuk view buku page
		var alamatTujuan = "home.php?a=viewbuku&pengarang_buku=" + pengarangDicari;
		alamatTujuan += "&penerbit=" + penerbitDicari;
		alamatTujuan += "&rate=" + rateDicari;
		
		window.location.href = alamatTujuan;
		} else if(alamatSaatIni.includes('riwayatpinjam')){
		// pencarian untuk riwayat page
		var alamatTujuan = "home.php?a=riwayatpinjam&judul_buku=" + kataDicari;
		window.location.href = alamatTujuan;
		} 
	
	} else if(kataDicari.length>0){
	
		if(alamatSaatIni.includes('viewbuku')){
		// pencarian untuk view buku page
		var alamatTujuan = "home.php?a=viewbuku&judul_buku=" + kataDicari;
		window.location.href = alamatTujuan;
		} else if(alamatSaatIni.includes('riwayatpinjam')){
		// pencarian untuk riwayat page
		var alamatTujuan = "home.php?a=riwayatpinjam&judul_buku=" + kataDicari;
		window.location.href = alamatTujuan;
		} 
	}
	/* // } if(penerbitDicari.length>0){
			// if(alamatSaatIni.includes('viewbuku')){
			pencarian untuk view buku page
			// var alamatTujuan = "home.php?a=viewbuku&penerbit=" + penerbitDicari;
			// window.location.href = alamatTujuan;
			// } else if(alamatSaatIni.includes('riwayatpinjam')){
			pencarian untuk riwayat page
			// var alamatTujuan = "home.php?a=riwayatpinjam&penerbit=" + penerbitDicari;
			// window.location.href = alamatTujuan;
			// } 
			
		// }
	
		// if(pengarangDicari.length>0){
			// if(alamatSaatIni.includes('viewbuku')){
			pencarian untuk view buku page
			// var alamatTujuan = "home.php?a=viewbuku&pengarang_buku=" + pengarangDicari;
			// window.location.href = alamatTujuan;
			// } else if(alamatSaatIni.includes('riwayatpinjam')){
			pencarian untuk riwayat page
			// var alamatTujuan = "home.php?a=riwayatpinjam&pengarang_buku=" + pengarangDicari;
			// window.location.href = alamatTujuan;
			// } 
		
		
		// }
		// if(rateDicari > 0){
			// if(alamatSaatIni.includes('viewbuku')){
			pencarian untuk view buku page
			// var alamatTujuan = "home.php?a=viewbuku&rate=" + rateDicari;
			// window.location.href = alamatTujuan;
			// } 
		// } */
		
	
}

function sendQuestioner(nilai, nim, nama){
	
	var alamatTujuan = "controller/save_kuesioner.php";
		var nimUser = nim;
		var hasil = nilai;
		var namaUser = nama;
		var data = {nim: nimUser, hasil_kuesioner:hasil, nama_lengkap:nama};
		
		 $.post(alamatTujuan, data,function(respon){
		   //alert(respon);
		   $('#dialog-confirm').hide();
		   window.location="controller/logout.php";
		});
	
}
  

 