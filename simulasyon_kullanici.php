<?php ob_start() ?>
<?php session_start(); ?>
<?php 
$navbar_kimlik = "simulasyon_kullanici";
$navbar_baslik = "KREDİ SİMÜLASYONU";
$title="İDE Eğitim Danışmanlık | Kredi Simülasyonu";
$description="İDE EĞİTİM VE DANIŞMANLIK, kurumların insan kaynağı ve finansal danışmanlık gereksinimlerini eksiksiz karşılamak üzere kurulmuş bir firmadır.";
$keywords="egitim, danışmanlık, eğitim, kredi eğitimi, finansal danışmanlık, şirket değerleme, bilanço analizi";
if(isset($_SESSION['kullanici_id'])) {
			include "header.php";
			
			
			
			$kullanici_id = $_SESSION['kullanici_id'];
			
			$kullanici_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_id='".$kullanici_id."'");
			$kullanici_sorgu->execute();
			$kullanici=$kullanici_sorgu->fetch(PDO::FETCH_ASSOC);
	
			$kullanici_simulasyon_id = $kullanici['kullanici_simulasyon_id'];
			
			$simulasyon_sorgu=$db->prepare("SELECT * FROM simulasyon WHERE simulasyon_kimlik='".$kullanici_simulasyon_id."'");
			$simulasyon_sorgu->execute();
			$simulasyon=$simulasyon_sorgu->fetch(PDO::FETCH_ASSOC);
			
			$simulasyon_sablon_id = $simulasyon['simulasyon_sablon_id'];
		    $simulasyon_kimlik = $simulasyon['simulasyon_kimlik'];
			$anlik_sene = $simulasyon['simulasyon_anlik_sene'];
			$anlik_sene = $simulasyon['simulasyon_anlik_sene'];
	
	
			$sablon_sorgu=$db->prepare("SELECT * FROM sablon WHERE sablon_id='".$simulasyon_sablon_id."'");
			$sablon_sorgu->execute();
			$sablon=$sablon_sorgu->fetch(PDO::FETCH_ASSOC);
			
		 															  
		 ?>
<?php 
	
if (isset($_POST['teklif_gonder'])) {											  
		$teklif_ekle = $db->prepare("UPDATE oneri SET 
			oneri_kontrol =:oneri_kontrol,
			teklif_tl_miktar =:teklif_tl_miktar,
			teklif_tl_oran =:teklif_tl_oran,
			teklif_usd_miktar =:teklif_usd_miktar,
			teklif_usd_oran =:teklif_usd_oran,
			teklif_tem_miktar =:teklif_tem_miktar,
			teklif_tem_oran =:teklif_tem_oran,
			teklif_itha_miktar =:teklif_itha_miktar,
			teklif_itha_oran =:teklif_itha_oran,
			teklif_forw_miktar =:teklif_forw_miktar,
			teklif_forw_oran =:teklif_forw_oran
			 WHERE oneri_kullanici_id={$_POST['oneri_kullanici_id']} AND oneri_firma_id={$_POST['oneri_firma_id']} AND oneri_sene={$_POST['oneri_sene']}");
			
			$teklif_ekle_insert= $teklif_ekle->execute(array(
			'oneri_kontrol' => 1,
			'teklif_tl_miktar' => str_replace(".", "", $_POST['teklif_tl_miktar']),
			'teklif_tl_oran' => htmlspecialchars($_POST['teklif_tl_oran']),
			'teklif_usd_miktar' => str_replace(".", "", $_POST['teklif_usd_miktar']),
			'teklif_usd_oran' => htmlspecialchars($_POST['teklif_usd_oran']),
			'teklif_tem_miktar' => str_replace(".", "", $_POST['teklif_tem_miktar']),
			'teklif_tem_oran' => htmlspecialchars($_POST['teklif_tem_oran']),
			'teklif_itha_miktar' => str_replace(".", "", $_POST['teklif_itha_miktar']),
			'teklif_itha_oran' => htmlspecialchars($_POST['teklif_itha_oran']),
			'teklif_forw_miktar' => str_replace(".", "", $_POST['teklif_forw_miktar']),
			'teklif_forw_oran' => htmlspecialchars($_POST['teklif_forw_oran']),
			));
	
	 if ( $teklif_ekle_insert ){
     header("Location: simulasyon_kullanici.php?teklif=gonder");
 }
}
	
	
if (isset($_POST['teklif_sil'])) {											  
		$teklif_sil = $db->prepare("UPDATE oneri SET 
			oneri_kontrol =:oneri_kontrol,
			teklif_tl_miktar =:teklif_tl_miktar,
			teklif_tl_oran =:teklif_tl_oran,
			teklif_usd_miktar =:teklif_usd_miktar,
			teklif_usd_oran =:teklif_usd_oran,
			teklif_tem_miktar =:teklif_tem_miktar,
			teklif_tem_oran =:teklif_tem_oran,
			teklif_itha_miktar =:teklif_itha_miktar,
			teklif_itha_oran =:teklif_itha_oran,
			teklif_forw_miktar =:teklif_forw_miktar,
			teklif_forw_oran =:teklif_forw_oran
			 WHERE oneri_kullanici_id={$_POST['oneri_kullanici_id']} AND oneri_firma_id={$_POST['oneri_firma_id']} AND oneri_sene={$_POST['oneri_sene']}");
			
			$teklif_sil_insert= $teklif_sil->execute(array(
			'oneri_kontrol' => 0,
			'teklif_tl_miktar' => 0,
			'teklif_tl_oran' => 0,
			'teklif_usd_miktar' => 0,
			'teklif_usd_oran' => 0,
			'teklif_tem_miktar' => 0,
			'teklif_tem_oran' => 0,
			'teklif_itha_miktar' => 0,
			'teklif_itha_oran' => 0,
			'teklif_forw_miktar' => 0,
			'teklif_forw_oran' => 0,
			));
	
	 if ( $teklif_sil_insert ){
     header("Location: simulasyon_kullanici.php?teklif=sil");
 }
}




?>
<?php include "simulasyon_yonet_modal_2.php"; ?>
<nav style="margin-top:40px;margin-right:40px;margin-left:40px;background-color:#26354A;"class="mobile_margin navbar navbar-light">
	
		<div style="width:100%;"class="row justify-content-between">
			<div style="padding-left:30px;padding-top:10px;padding-bottom:10px;"class="col-12 col-md-9">
				<span style="font-family: 'Besley', serif;font-size:24px;color:#FFBA00;letter-spacing:4px;"><?php echo $kullanici['kullanici_banka_ad']; ?> Bank</span><br>
				<span style="font-family: 'Besley', serif;font-size:12px;color:whitesmoke;letter-spacing:5px;">İletişim Sayfası - Sene: <?php echo $simulasyon['simulasyon_anlik_sene'];?></span>
				
			</div>
			<div style="text-align:right;padding-top:18px;"class="mobile_hide col-12 col-md-3">
				 <div class="row justify-content-end">
					 <div class="col-8">
					 <a class="btn btn-light" href="#" onclick="window.location.reload(true);">Sayfayı Yenile 🔄 </a>
					</div>
					<div class="col-4">
					 <a class="btn btn-light" href="logout_simulasyon.php">  Çıkış Yap</a>
						
					</div>
					 
					
  				</div>
				
			</div>
		</div>
	
</nav>

<div style="margin-left:40px;margin-right:40px;"class="mobile_margin row justify-content-start">
<?php
		$oneri_sorgu_id=1;
		$oneri_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_kullanici_id='".$kullanici_id."' AND oneri_sene='".$anlik_sene."'");
		$oneri_sorgu->execute();
		while ($oneri_exe=$oneri_sorgu->fetch(PDO::FETCH_ASSOC)) { $oneri_sorgu_id++; ?>	

<div class="modal fade" id="teklif_<?php echo $oneri_exe['oneri_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div style="max-width:990px;" class="mobile_modal modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div style="background-color:#D4DCE6;pbadding:25px;" class="modal-body">
       <div class="container">
           <div class="row justify-content-end">		
		<button type="button" class="btn btn-light" data-dismiss="modal" aria-label="">
         KAPAT ❌
        </button>
			   
	<div class="col-12 col-md-12">
		<br>
		<form enctype="multipart/form-data" action="" method="POST" id="<?php echo $oneri_exe['oneri_firma_id']?>">
		<table class="table">
		<thead class="thead-light">
		<tr>
		<th style="padding:30px;font-size:19px;text-align:center;" colspan="3" scope="col"><?php echo $oneri_exe['oneri_firma_ad'];?></th>
		</tr>
		</thead>
		<thead class="thead-light">
		<tr>
		<th scope="col">Kredi Cinsi</th>
		<th scope="col">Miktar</th>
		<th scope="col">Faiz/Kom. Oranı</th>
		</tr>
		</thead>
		<tbody style="background-color:white;">
		<tr>
		<th scope="row">Türk Lirası nakdi kredi:</th>
		<td><input onfocus="this.value=''" type="text" class="user_input form-control number-separator" name="teklif_tl_miktar" value="<?php echo $oneri_exe['teklif_tl_miktar'];?>" ></td>
		<td><input onfocus="this.value=''" type="text" maxlength="2" class="user_input form-control" name="teklif_tl_oran" value="<?php echo $oneri_exe['teklif_tl_oran'];?>"></td>
		</tr>
		<tr>
		<th scope="row">Döviz nakdi kredi:</th>
		<td><input onfocus="this.value=''" type="text" class="user_input form-control number-separator" name="teklif_usd_miktar" value="<?php echo $oneri_exe['teklif_usd_miktar'];?>"></td>
		<td><input onfocus="this.value=''" type="text" maxlength="2" class="user_input form-control" name="teklif_usd_oran" value="<?php echo $oneri_exe['teklif_usd_oran'];?>"></td>
		</tr>
		<tr>
		<th scope="row">Teminat mektubu:</th>
		<td><input onfocus="this.value=''" type="text" class="user_input form-control number-separator" name="teklif_tem_miktar" value="<?php echo $oneri_exe['teklif_tem_miktar'];?>"></td>
		<td><input onfocus="this.value=''" type="text" maxlength="2" class="user_input form-control" name="teklif_tem_oran" value="<?php echo $oneri_exe['teklif_tem_oran'];?>"></td>
		</tr>
		<tr>
		<th scope="row">İthalat akreditifi:</th>
		<td><input onfocus="this.value=''" type="text" class="user_input form-control number-separator" name="teklif_itha_miktar" value="<?php echo $oneri_exe['teklif_itha_miktar'];?>"></td>
		<td><input onfocus="this.value=''" type="text" maxlength="2" class="user_input form-control" name="teklif_itha_oran" value="<?php echo $oneri_exe['teklif_itha_oran'];?>"></td>
		</tr>
		<tr>
		<th scope="row">Forward:</th>
		<td><input onfocus="this.value=''" type="text" class="user_input form-control number-separator" name="teklif_forw_miktar" value="<?php echo $oneri_exe['teklif_forw_miktar'];?>"></td>
		<td><input onfocus="this.value=''"type="text" maxlength="2" class="user_input form-control" name="teklif_forw_oran" value="<?php echo $oneri_exe['teklif_forw_oran'];?>"></td>
		</tr>
		</tbody>
		</table>
		<input type="hidden" name="oneri_kullanici_id" value="<?php echo $kullanici_id; ?>">
		<input type="hidden" name="oneri_sene" value="<?php echo $anlik_sene; ?>">
		<input type="hidden" name="oneri_firma_id" value="<?php echo $oneri_exe['oneri_firma_id']; ?>">
		<div style="text-align:center;">
		<?php if($oneri_exe['oneri_kontrol'] == 1){?>
		<button type="submit" class="btn btn-light" name="teklif_gonder" form="<?php echo $oneri_exe['oneri_firma_id']?>">Teklif Güncelle</button>
		<button type="submit" class="btn btn-danger" name="teklif_sil" form="<?php echo $oneri_exe['oneri_firma_id']?>">Teklifi Sil</button>
		<?php }elseif($oneri_exe['oneri_kontrol'] == 0){?>
			<button type="submit" class="btn btn-light" name="teklif_gonder" form="<?php echo $oneri_exe['oneri_firma_id']?>">Teklif Gönder</button>
		<?php } ?>
		</div>
		</form>
	</div>

               
    
               
           </div>
       </div>
      </div>
     
    </div>
  </div>
</div>
	
	
	
<div class="modal fade" id="bulten_gecmis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div style="max-width:990px;" class="mobile_modal modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div style="background-color:#D4DCE6;pbadding:25px;" class="modal-body">
       <div class="container">
           <div class="row justify-content-end">		
		<button type="button" class="btn btn-light" data-dismiss="modal" aria-label="">
         KAPAT ❌
        </button>
			   <br>
			   
	<div style="height:calc(100vh - 200px);overflow-y:scroll;" class="col-12 col-md-12">
		<br>
		<?php for($bulten_sene=1;$bulten_sene<=$anlik_sene; $bulten_sene++){	?>
		<div style="border:1px solid grey;background-color:#DAEEF3;padding-top:25px;" class="col-12 col-md-12">
		
		<h6 style="text-align:center;font-size:19px;">Bülten <?php echo $bulten_sene;?>.Sene</h6>
		<pre> <?php echo $sablon['bulten_sene_'.$bulten_sene.''];?></pre>
	</div>
		<br>
		<?php } ?>
	</div>

               
    
               
           </div>
       </div>
      </div>
     
    </div>
  </div>
</div>
<?php } ?>
<!-- -------------------- DURAKLATILDI BAŞLANGIÇ -------------------- -->
<!-- -------------------- AKTİF BAŞLANGIÇ -------------------- -->

<div style="background-color:#D4DCE6;"class="col-12">	

<div style="width:550px; margin:auto; text-align:center;">
	

	
</div>
<br>
<div class="row" style="padding-right:25px;padding-left:25px;padding-bottom:12.5px;">
	<div style="height:calc(100vh - 260px);overflow-y:scroll;border:1px solid grey;background-color:#DAEEF3;padding-top:25px;" class="col-12 col-md-6">
		
		<h5 style="text-align:center;font-size:20px;">Mali Bilgilendirme Bülteni</h5>	
		<hr>
		<h6 style="text-align:center;font-size:19px;">Bülten <?php echo $simulasyon['simulasyon_anlik_sene'];?>.Sene</h6>
		<pre> <?php echo $sablon['bulten_sene_'.$anlik_sene.''];?></pre>
	</div>
	
	
	<div style="height:calc(100vh - 260px);overflow-y:scroll;text-align:center;margin:auto" class="col-12 col-md-6">
	<br>
		<h6 style="text-align:center;font-size:16.5x;">KREDİ KULLANMAK İÇİN BAŞVURUSU OLAN ŞİRKETLER</h6>
		<div style="text-align:center;font-size:15px;color:#171717
;"> Aşağıda, bankamızdan kredi talep eden şirketlerin listesi bulunmaktadır. Şirketlere kullandırmayı uygun gördüğünüz kredilerin miktar ve faiz oranlarını <ins>tamsayı değerler</ins> olarak giriniz. Şirketlerin, verdiğiniz teklifi kabul edip etmedikleri tarafınıza bildirilecektir.
		</div>
		<br>
		<a class="btn btn-light" href="#" onclick="window.location.reload(true);">Sayfayı Yenile 🔄 </a>
		
			<button class="btn btn-light" data-toggle="modal" data-target="#bulten_gecmis">Bülten Geçmişi 📋</button>
			<br>
		<br>
		<br>
		<table style="text-align:left;border: 2.2px solid #E9ECEF;" class="table table-bordered">
		<thead class="thead-light">
		<tr>
		<th scope="col"></th>
		<th scope="col">Firma Adı</th>
		<th scope="col">Teklif</th>
		</tr>
		</thead>
		<tbody style="background-color:white;">
		<?php
		$basvuru_sorgu_id=0;
		$basvuru_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_kullanici_id='".$kullanici_id."' AND oneri_sene='".$anlik_sene."' ORDER BY oneri_id" );
		$basvuru_sorgu->execute();
		while ($basvuru_exe=$basvuru_sorgu->fetch(PDO::FETCH_ASSOC)) { $basvuru_sorgu_id++; ?>
		<tr style="background-color:white;">
		<th scope="row"><?php echo $basvuru_sorgu_id; ?></th>
		<td style="width:60%;" scope="row"><strong><?php echo $basvuru_exe['oneri_firma_ad']; ?></strong>
		<br>
		<span style="font-size:14px;color:blue">Firmanın mali bilgilerini incelemek için
		<a target="_blank" style="color:black;" href="simulasyon_dosya/<?php echo $basvuru_exe['oneri_firma_dosya']?>"><ins>tıklayınız.</ins></a>
		</span>
		
		</td>
		<td style="width:40%;">
		<?php if($basvuru_exe['oneri_kontrol'] == 1){?>
			<span style="margin-right:10px;color:green">Teklif Verildi !</span>
			<button style="display:<?php echo $simulasyon['simulasyon_display_kullanici']?>;" data-toggle="modal" data-target="#teklif_<?php echo $basvuru_exe['oneri_id']?>">Görüntüle</button>
		<?php }elseif($basvuru_exe['oneri_kontrol'] == 0){ ?>
			<button style="display:<?php echo $simulasyon['simulasyon_display_kullanici']?>;" data-toggle="modal" data-target="#teklif_<?php echo $basvuru_exe['oneri_id']?>">Teklif Ver</button>
		<?php } ?>
		</td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
	
		
	<div id="bgt" style="padding-right:50px;padding-left:50px;padding-top:50px;margin:auto;" class="col-12">
		<h5 style="text-align:center;"> Bilanço ve Gelir - Gider Tabloları</h5>
		<br>
		<table class="table table-light table-bordered"> 	
		<thead class="thead-light">
		<tr>
		<th style="text-align:center;" scope="col">1.Sene</th>
		<th style="text-align:center;" scope="col">2.Sene</th>
		<th style="text-align:center;" scope="col">3.Sene</th>
		<th style="text-align:center;" scope="col">4.Sene</th>
		</tr>
		</thead>	
		<tbody>

		<tr style="text-align:center;">
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $kullanici_id?>_1" >İncele</button></td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $kullanici_id?>_2" >İncele</button></td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $kullanici_id?>_3" >İncele</button></td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $kullanici_id?>_4" >İncele</button></td>
		
		</tr>


		</tbody>
		</table>
	</div>
	</div>
</div>
</div>   

<!-- -------------------- AKTİF BİTİŞ -------------------- -->
                    </div>

        <?php include "footer.php"; ?>
<?php 
}else{
	header('location:simulasyon_anasayfa.php?hata=girisyapilmadi');
}?>
<?php ob_end_flush() ?>

