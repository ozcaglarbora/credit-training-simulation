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
if (isset($_POST['simulasyon_calistir'])) {
	$bilgi = "adlı eğitim için, Simülasyon Çalıştırıldı. ⚙️ <br>".$anlik_sene.". Senenin sonuçlarını incelemek için aşağıdaki menüyü kullanabilirsiniz.";
$simulasyon_calistir = $db->prepare("UPDATE simulasyon SET
   simulasyon_display_kullanici = :simulasyon_display_kullanici,
   simulasyon_bilgi = :simulasyon_bilgi
  	WHERE simulasyon_kimlik='".$simulasyon_kimlik."'");
 $simulasyon_calistir_insert = $simulasyon_calistir->execute(array(
   "simulasyon_display_kullanici" => "none",
   "simulasyon_bilgi" => ($bilgi)
 ));
 if ($simulasyon_calistir_insert ){
   include "simulasyon_yonet_calistir.php";
   header("Location: simulasyon_".$url_id.".php");
 } else {
   header("Location: simulasyonn_".$url_id.".php");
 }
	 
}	

	
	
if (isset($_POST['simulasyon_gec'])) {
	$sene_gec = $anlik_sene + 1;
	$button = ($sene_gec + 1).". Sene'ye Geç ⏩";
	$bilgi = " adlı eğitimin ".$sene_gec.". sene uygulaması başlatılmıştır. Teklifler bekleniyor..";
	if($sene_gec == $toplam_sene){
	$button = "Simulasyonu Bitir";	
	}elseif($sene_gec > $toplam_sene){
	$button = "";
	$simulasyon_display = "none";
	$sene_gec--;
	$bilgi = " adlı eğitim sona erdi.";
	}else{}
$simulasyon_baslat = $db->prepare("UPDATE simulasyon SET
   simulasyon_button = :simulasyon_button,
   simulasyon_display = :simulasyon_display,
   simulasyon_display_kullanici = :simulasyon_display_kullanici,
   simulasyon_anlik_sene = :simulasyon_anlik_sene,
   simulasyon_bilgi = :simulasyon_bilgi
  	WHERE simulasyon_kimlik='".$simulasyon_kimlik."'");
 $simulasyon_baslat_insert = $simulasyon_baslat->execute(array(
   "simulasyon_button" => ($button),
   "simulasyon_display" => ($simulasyon_display),
   "simulasyon_display_kullanici" => "",
   "simulasyon_bilgi" => ($bilgi),
   "simulasyon_anlik_sene" => ($sene_gec)
 ));


 if ($simulasyon_baslat_insert ){
   header("Location: simulasyon_".$url_id.".php");
 } else {
   header("Location: simulasyonn_".$url_id.".php");
 }
}
	
	
	

?>
<?php include "simulasyon_yonet_modal.php"; ?>
<?php include "simulasyon_yonet_modal_2.php"; ?>


<div class="modal fade" id="simulasyon_bilgi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="width:50%;padding:0;max-width:50%;" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Simülasyon Hakkında</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">❌</button>
      </div>
      <div class="modal-body">
        <div class="col-12">
		<table class="table table-bordered">
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th colspan="3" scope="col">Simülasyon Bilgileri</th>
		</tr>
		</tbody>
		<tbody style="background-color:white;">
		<tr>
		<th style="width:300px;" scope="row">Simülasyon Adı:</th>
		<td colspan="2"><?php echo $simulasyon_exe['simulasyon_ad'];?></td>
		</tr>
		<tr>
		<th scope="row">Oluşturulduğu Tarih:</th>
		<td colspan="2"><?php echo $simulasyon_exe['simulasyon_tarih'];?></td>
		</tr>
		<tr>
		<th scope="row">Şablon Adı:</th>
		<td colspan="2"><?php echo $sablon['sablon_ad'];?></td>
		</tr>
		<tr>
			
		<th scope="row">Simulasyon Toplam Sene:</th>
		<td><strong>Toplam Sene: </strong><?php echo $simulasyon_exe['simulasyon_toplam_sene'];?></td>	
		<td><strong>Şu anki Sene: </strong><?php echo $simulasyon_exe['simulasyon_anlik_sene'];?></td>
		
		
		</tr>
		
		</tbody>
		</table>
	</div>
	
	<div style="text-align:center;" class="col-12">
		
		<table class="table table-light table-bordered"> 
		<tbody class="thead-light">
		<tr>
		<th scope="col">Banka Adı</th>
		<th scope="col">Kullanıcı ID</th>
		<th scope="col">Şifre</th>  
		</tr>
		</tbody>				
		<tbody>

		<?php
		$simulasyon_liste_id=1;
		$tablo_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."' ORDER BY kullanici_id 			ASC");
		$tablo_sorgu->execute();
		while ($tablo_veri=$tablo_sorgu->fetch(PDO::FETCH_ASSOC)) { $simulasyon_liste_id++; ?>

		<tr>
		<td style="width:150px;"><?php echo $tablo_veri['kullanici_banka_ad'] ?> Bank</td>
		<td><?php echo $tablo_veri['kullanici_ad'] ?></td>
		<td><?php echo $tablo_veri['kullanici_sifre'] ?></td>
		
		</tr>

		<?php } ?>

		</tbody>
		</table>
		
	</div>
		
      </div>
      
    </div>
  </div>
</div>








<!-- ----- ANA ÇERÇEVE BAŞLANGIÇ----- -->	

<div style="background-color:#D4DCE6;" class="col-12">					    
<div class="row justify-content-between">
	
	
	<div style="padding:50px;padding-top:20px;text-align:center;" class="col-12">
		<table class="table table-bordered">
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th style="padding:20px; font-size:20px;"colspan="3" scope="col">Kontrol Paneli</th>
		</tr>
		</tbody>

		<tbody style="background-color:white;">
		<tr>
		<td style="padding:65px;font-size:20px; width:200px;text-align:center;" colspan="3">
		<strong style="color:#CC3300;"><?php echo $simulasyon_exe['simulasyon_ad'];?> </strong> <?php echo $simulasyon_exe['simulasyon_bilgi']?>
		</td>
		</tr>
		<tr>
		<td style="padding:25px;" colspan="3">
		
		<form style="display:inline-block;" enctype="multipart/form-data" action="" method="POST" onSubmit="return confirm('Bu işlemi yapmak istediğinize emin misiniz ?');">
		<button name="simulasyon_gec" class="btn btn-primary" style="display:<?php echo $simulasyon_display;?>;font-size:16px;padding:10px; color:white;" type="submit">
			<?php echo $simulasyon_button; ?></button>
		<button name="simulasyon_calistir" class="btn btn-success" style="display:<?php echo $simulasyon_display;?>;font-size:16px;padding:10px; color:white;" type="submit">Simülasyonu Çalıştır ⚙️</button>
			
		</form>
		
			<button data-toggle="modal" data-target="#simulasyon_bilgi" class="btn btn-info" style="font-size:16px;padding:10px;" >
			Simülasyon Bilgileri 📋</button>
			<a href="simulasyon_<?php echo $simulasyon_kimlik; ?>_rapor.php" target="_blank" class="btn btn-secondary" style="font-size:16px;padding:10px;">Tablolar</a>
			
		
	
		</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div style="padding-right:50px;padding-left:50px;padding-top:50px;margin:auto;" class="col-12">
		
        <div style="padding:40px;"class="col-12">
    	<h4 style="color:#26354A;text-align:center;" class="mb-3"><?php echo $anlik_sene; ?> .Sene Teklif Tablosu </h4>
		<hr>
		 <?php 
		$kullanici_aktif_id=1;
		$kullanici_aktif_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."' ORDER BY 				kullanici_id ASC");
		$kullanici_aktif_sorgu->execute();
		while ($kullanici_aktif=$kullanici_aktif_sorgu->fetch(PDO::FETCH_ASSOC)) { $kullanici_aktif_id++; ?>	
		<table class="table table-bordered">
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th style="font-size:20px;" colspan="7"><?php echo $kullanici_aktif['kullanici_banka_ad']?> Bank</th>
		</tbody>
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th colspan="2">Firma Bilgileri</th>
		<th scope="col">Türk Lirası (TL)</th>
		<th scope="col">Döviz ($)</th>
		<th scope="col">Teminat M.</th>
		<th  scope="col">İthalat Akr.</th>
		<th  scope="col">Forward</th>
		</tr>
		</tbody>											
		<tbody style="background-color:white;">

		<?php 
		$oneri_aktif_id=1;
		$oneri_aktif_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND 								oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$kullanici_aktif['kullanici_id']."'");
		$oneri_aktif_sorgu->execute();
		while ($oneri_aktif=$oneri_aktif_sorgu->fetch(PDO::FETCH_ASSOC)) { $oneri_aktif_id++; ?>	

		<tr>									  
		<td><?php echo $oneri_aktif['oneri_firma_ad'];?></td>													 
		<td><?php if ($oneri_aktif['oneri_batak'] == 1){echo "Batak";}else{ echo "İyi Firma";}?></td>
		<td><?php echo number_format($oneri_aktif['teklif_tl_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % 
		<?php echo $oneri_aktif['teklif_tl_oran'];?></td>
		<td><?php echo number_format($oneri_aktif['teklif_usd_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % 
		<?php echo $oneri_aktif['teklif_usd_oran'];?></td>
		<td><?php echo number_format($oneri_aktif['teklif_tem_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % 
		<?php echo $oneri_aktif['teklif_tem_oran'];?></td>
		<td><?php echo number_format($oneri_aktif['teklif_itha_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % 
		<?php echo $oneri_aktif['teklif_itha_oran'];?></td>
		<td>
		<?php echo number_format($oneri_aktif['teklif_forw_miktar'] , 0, ',', '.');?> 
		<span style="color:grey">-</span> % <?php echo $oneri_aktif['teklif_forw_oran'];?>
		</td>
		</tr>

		<?php } ?>

		<tr>
		</tr>
		</tbody>										 
		</table>
		<br>
		<br>

		<?php } ?>

		<br>
		<br>		
	</div>
		  
     

	</div>
	<div style="padding-right:50px;padding-left:50px;padding-top:50px;margin:auto;" class="col-12">
		
        <div style="padding:40px;padding-top:0;"class="col-12">
		<br>
    	<h4 style="font-size:21px;letter-spacing:1.5px;color:#26354A;text-align:center;" class="mb-3"><?php echo $anlik_sene; ?>. SENE FİRMALAR AÇISINDAN UYGULAMA ÖZETİ</h4>
		<hr>
		 <?php 
															
		$firma_body_id=1;
		$firma_body_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sene='".$anlik_sene."' AND firma_sablon_id='".$simulasyon_sablon_id."' ORDER BY firma_sira ASC");
		$firma_body_sorgu->execute();
		while ($firma_body=$firma_body_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_body_id++; ?>	
		<table class="table table-bordered">
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th style="font-size:20px;"colspan="7"><?php echo $firma_body['firma_ad'];?></th>
		</tbody>
		<tbody style="background-color:white;">
		<tr style="text-align:center;">
		<td>Firma İhtiyaçları</td>						  
		<td><?php echo number_format($firma_body['firma_ihtiyac_tl'] , 0, ',', '.'); ?></td>
		<td><?php echo number_format($firma_body['firma_ihtiyac_usd'] , 0, ',', '.'); ?></td>
		<td><?php echo number_format($firma_body['firma_ihtiyac_tem'] , 0, ',', '.'); ?></td>
		<td><?php echo number_format($firma_body['firma_ihtiyac_itha'] , 0, ',', '.'); ?></td>
		<td><?php echo number_format($firma_body['firma_ihtiyac_forw'] , 0, ',', '.'); ?></td>
		</tr>
		</tbody>
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th style="width:200px;" scope="col">Banka Adı</th>
		<th scope="col">Türk Lirası (TL)</th>
		<th scope="col">Döviz (USD $)</th>
		<th scope="col">Teminat Mektubu</th>
		<th  scope="col">İthalat Akreditifi</th>
		<th  scope="col">Forward</th>
														
													  
													</tr>
												  </tbody>
												
												
												  <tbody style="background-color:white;">
											<?php 
														$oneri_rapor_id=1;
														$oneri_rapor_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_firma_id='".$firma_body['firma_id']."'");
														$oneri_rapor_sorgu->execute();
														while ($oneri_rapor=$oneri_rapor_sorgu->fetch(PDO::FETCH_ASSOC)) { $oneri_rapor_id++; ?>	
													 <?php 
																	  
													if($firma_body['firma_ihtiyac_forw'] < 0){
	$firma_body['firma_ihtiyac_forw'] = -1 * $firma_body['firma_ihtiyac_forw'];
}else{}													
																														  
													$toplam_tl += $oneri_rapor['kredi_tl_miktar']; $simbank_tl = $firma_body['firma_ihtiyac_tl'] - $toplam_tl;
													  $toplam_usd += $oneri_rapor['kredi_usd_miktar']; $simbank_usd = $firma_body['firma_ihtiyac_usd'] - $toplam_usd;
													  $toplam_tem += $oneri_rapor['kredi_tem_miktar']; $simbank_tem = $firma_body['firma_ihtiyac_tem'] - $toplam_tem;
													  $toplam_itha += $oneri_rapor['kredi_itha_miktar']; $simbank_itha = $firma_body['firma_ihtiyac_itha'] - $toplam_itha;
													  $toplam_forw += $oneri_rapor['kredi_forw_miktar']; $simbank_forw = $firma_body['firma_ihtiyac_forw'] - $toplam_forw;?>
													  <tr>
													  
													  <th><?php echo $oneri_rapor['oneri_kullanici_banka'];?> Bank</th>						  
													  <td><?php echo number_format($oneri_rapor['kredi_tl_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $oneri_rapor['kredi_tl_oran'];?></td>
													  <td><?php echo number_format($oneri_rapor['kredi_usd_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $oneri_rapor['kredi_usd_oran'];?></td>
														  <td><?php echo number_format($oneri_rapor['kredi_tem_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $oneri_rapor['kredi_tem_oran'];?></td>
													  <td><?php echo number_format($oneri_rapor['kredi_itha_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $oneri_rapor['kredi_itha_oran'];?></td>
													  <td><?php echo number_format($oneri_rapor['kredi_forw_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $oneri_rapor['kredi_forw_oran'];?></td>
													  
													
													  
													</tr>
													  
													<?php } ?>
													  <tr>
													  
													  <td>Diğer Banka</td>						  
													  <td><?php echo number_format($simbank_tl , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$anlik_sene.'_simbank_faiz_tl'];?></td>
													  <td><?php echo number_format($simbank_usd , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$anlik_sene.'_simbank_faiz_usd'];?></td>
														  <td><?php echo number_format($simbank_tem , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$anlik_sene.'_simbank_komisyon_tem'];?></td>
													  <td><?php echo number_format($simbank_itha , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$anlik_sene.'_simbank_komisyon_itha'];?></td>
													  <td><?php echo number_format($simbank_forw , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$anlik_sene.'_simbank_spread_forw'];?></td>
													  
													
													  
													</tr>
													  
												  </tbody>


</table>

<br>
<br>
<?php $toplam_tl = 0; $toplam_usd = 0; $toplam_tem = 0; $toplam_itha = 0; $toplam_forw = 0;$simbank_tl = 0;$simbank_usd = 0;$simbank_tem = 0;$simbank_itha = 0;$simbank_forw = 0; } ?>
<br>
<br>
		
 </div>
	

	
	<br>
	

	
	<div style="padding:40px;"class="col-12">
    	<h4 style="font-size:21px;letter-spacing:1.5px;color:#26354A;text-align:center;" class="mb-3"><?php echo $anlik_sene; ?>. SENE BANKALAR AÇISINDAN UYGULAMA ÖZETİ</h4>
		<hr>
		 <?php 
															
		$banka_body_id=1;
		$banka_body_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."' ORDER BY 				kullanici_id ASC");
		$banka_body_sorgu->execute();
		while ($banka_body=$banka_body_sorgu->fetch(PDO::FETCH_ASSOC)) { $banka_body_id++; ?>		
		<table class="table table-bordered">
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th style="font-size:20px;"colspan="7"><?php echo $banka_body['kullanici_banka_ad'];?> Bank</th>
		</tbody>
		<tbody style="background-color:white;">
		<tr style="text-align:center;">
		<td rowspan="2"></td>						  
		<td>Önerilen TL Kredi</td>
		<td>Önerilen Döviz Kredi</td>
		<td>Önerilen Teminat Mektubu</td>
		<td>Önerilen İthalat Akreditifi</td>
		<td>Önerilen Forward</td>
		</tr>
		<tr style="text-align:center;">
								  
		<td>Onaylanan TL Kredi</td>
		<td>Onaylanan Döviz Kredi</td>
		<td>Onaylanan Teminat Mektubu</td>
		<td>Onaylanan İthalat Akredifiti</td>
		<td>Onaylanan Forward</td>
		</tr>
		</tbody>
		<tbody class="thead-light">
		<tr style="text-align:center;">
		<th style="width:200px;" scope="col">Banka Adı</th>
		<th scope="col">Türk Lirası (TL)</th>
		<th scope="col">Döviz (USD $)</th>
		<th scope="col">Teminat Mektubu</th>
		<th  scope="col">İthalat Akreditifi</th>
		<th  scope="col">Forward</th>
														
													  
													</tr>
												  </tbody>
												
												
												  <tbody style="background-color:white;">
											<?php 
														$kredi_banka_id=1;
														$kredi_banka_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$banka_body['kullanici_id']."'");
														$kredi_banka_sorgu->execute();
														while ($kredi_banka=$kredi_banka_sorgu->fetch(PDO::FETCH_ASSOC)) { $kredi_banka_id++; ?>	
													  <tr>
													  
													  <th rowspan="2"><?php echo $kredi_banka['oneri_firma_ad'];?></th>						  
													  <td><?php echo number_format($kredi_banka['teklif_tl_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['teklif_tl_oran'];?></td>
													  <td><?php echo number_format($kredi_banka['teklif_usd_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['teklif_usd_oran'];?></td>
														  <td><?php echo number_format($kredi_banka['teklif_tem_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['teklif_tem_oran'];?></td>
													  <td><?php echo number_format($kredi_banka['teklif_itha_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['teklif_itha_oran'];?></td>
													  <td><?php echo number_format($kredi_banka['teklif_forw_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['teklif_forw_oran'];?></td>
													  
													
													  
													</tr>
													  <tr>
													  						  
													  <td><?php echo number_format($kredi_banka['kredi_tl_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['kredi_tl_oran'];?></td>
													  <td><?php echo number_format($kredi_banka['kredi_usd_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['kredi_usd_oran'];?></td>
														  <td><?php echo number_format($kredi_banka['kredi_tem_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['kredi_tem_oran'];?></td>
													  <td><?php echo number_format($kredi_banka['kredi_itha_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['kredi_itha_oran'];?></td>
													  <td><?php echo number_format($kredi_banka['kredi_forw_miktar'] , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $kredi_banka['kredi_forw_oran'];?></td>
													  </tr>
													  
													<?php } ?>
													  
												  </tbody>


</table>
<br>
<br>
										   <?php } ?>

		
 </div>
		  
      
<br>
		<br>
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

