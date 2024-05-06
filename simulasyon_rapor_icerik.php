<?php ob_start() ?>
<?php session_start(); ?>
<?php 
$url_id = $simulasyon_kimlik;
$navbar_kimlik = "simulasyon_admin";
$navbar_baslik = "YÖNETİM PANELİ";
$title="İDE Eğitim Danışmanlık | Yönetim Paneli";
$description="İDE EĞİTİM VE DANIŞMANLIK, kurumların insan kaynağı ve finansal danışmanlık gereksinimlerini eksiksiz karşılamak üzere kurulmuş bir firmadır.";
$keywords="egitim, danışmanlık, eğitim, kredi eğitimi, finansal danışmanlık, şirket değerleme, bilanço analizi";
if($_SESSION['kullanici_ad'] == "kredisim"){?>
<?php 
 include "header.php"; 
 include "navbar_simulasyon.php";  

	$simulasyon_sorgu=$db->prepare("SELECT * FROM simulasyon WHERE simulasyon_kimlik='".$simulasyon_kimlik."'");
	$simulasyon_sorgu->execute();
	$simulasyon_exe=$simulasyon_sorgu->fetch(PDO::FETCH_ASSOC);
	
	$simulasyon_sablon_id = $simulasyon_exe['simulasyon_sablon_id'];
	$anlik_sene = $simulasyon_exe['simulasyon_anlik_sene'];
	$toplam_sene = $simulasyon_exe['simulasyon_toplam_sene'];
	$simulasyon_button = $simulasyon_exe['simulasyon_button'];
	$simulasyon_display = $simulasyon_exe['simulasyon_display'];
	
			$sablon_sorgu=$db->prepare("SELECT * FROM sablon WHERE sablon_id='".$simulasyon_sablon_id."'");
			$sablon_sorgu->execute();
			$sablon=$sablon_sorgu->fetch(PDO::FETCH_ASSOC);
	
	
	$kontrol = "SELECT COUNT(*) FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."'";
$res = $db->query($kontrol);
$count = $res->fetchColumn();


?>

<?php 

?>
<?php include "simulasyon_yonet_modal.php"; ?>
<?php include "simulasyon_yonet_modal_2.php"; ?>


<!-- ----- ANA ÇERÇEVE BAŞLANGIÇ----- -->	

<div style="height:75vh;background-color:#D4DCE6;" class="col-12">					    
<div class="row justify-content-between">

	
	<div style="padding-right:50px;padding-left:50px;padding-top:75px;margin:auto;" class="col-10">
		<h5 style="text-align:center;"> Bilanço ve Gelir - Gider Tabloları</h5>
		<br>
		<table class="table table-light table-bordered"> 	
		<tbody class="thead-light">
		<tr>
		<th scope="col">Banka Adı</th>
		<th style="text-align:center;" scope="col">1.Sene</th>
		<th style="text-align:center;" scope="col">2.Sene</th>
		<th style="text-align:center;" scope="col">3.Sene</th>
		<th style="text-align:center;" scope="col">4.Sene</th>
		</tr>
		</tbody>	
		<tbody>

		<?php
		$tablo_incele_id=1;
		$tablo_incele_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."' ORDER BY kullanici_id ASC");
		$tablo_incele_sorgu->execute();
		while ($tablo_incele=$tablo_incele_sorgu->fetch(PDO::FETCH_ASSOC)) { $tablo_incele_id++; ?>

		<tr style="text-align:center;">
		<td style="text-align:left;width:180px;"><?php echo $tablo_incele['kullanici_banka_ad'] ?> Bank</td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $tablo_incele['kullanici_id']?>_1" >İncele</button></td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $tablo_incele['kullanici_id']?>_2" >İncele</button></td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $tablo_incele['kullanici_id']?>_3" >İncele</button></td>
		<td style="vertical-align:middle;"><button data-toggle="modal" data-target="#kullanici_<?php echo $tablo_incele['kullanici_id']?>_4" >İncele</button></td>
		
		</tr>

		<?php } ?>

		</tbody>
		</table>
	</div>
	

	


</div>
<br>
<br>
	

</div>	

<!-- ----- ANA ÇERÇEVE BİTİŞ ----- -->



                    

 <?php include "footer.php"; ?>




<?php } else{
	header('location:login.php?hata=girisyapilmadi');
}?>
<?php ob_end_flush() ?>

