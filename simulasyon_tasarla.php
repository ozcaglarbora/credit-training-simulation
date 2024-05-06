<?php ob_start() ?>
<?php session_start(); ?>
<?php 
$navbar_kimlik = "simulasyon_admin";
$navbar_baslik = "KREDİ EĞİTİM PROGRAMI - YÖNETİM SAYFASI";
$title="İDE Eğitim Danışmanlık | Yönetim Paneli";
$description="İDE EĞİTİM VE DANIŞMANLIK, kurumların insan kaynağı ve finansal danışmanlık gereksinimlerini eksiksiz karşılamak üzere kurulmuş bir firmadır.";
$keywords="egitim, danışmanlık, eğitim, kredi eğitimi, finansal danışmanlık, şirket değerleme, bilanço analizi";
if($_SESSION['kullanici_ad'] == "kredisim"){?>
				<?php include "header.php"; ?>
				<?php include "navbar_simulasyon.php"; ?>
<?php 

if (isset($_POST['simulasyon_ekle'])) {
	
	$simulasyon_ad = $_POST['simulasyon_ad'];
	$simulasyon_toplam_katilimci = $_POST['simulasyon_toplam_katilimci'];
	$simulasyon_tarih = ''.date("d.m.Y").'  '.date("H:i").'';
	$simulasyon_durum = "aktif";
	$simulasyon_anlik_sene = "1";
	$simulasyon_toplam_sene = $_POST['simulasyon_toplam_sene'];
	$simulasyon_kimlik = uniqid();
	$simulasyon_sablon_id = $_POST['simulasyon_sablon_id'];
	
 $veri_ekle = $db->prepare("INSERT INTO simulasyon SET
   simulasyon_ad = :simulasyon_ad,
   simulasyon_kimlik = :simulasyon_kimlik,
   simulasyon_sablon_id = :simulasyon_sablon_id,
   simulasyon_tarih = :simulasyon_tarih,
   simulasyon_toplam_sene = :simulasyon_toplam_sene,
   simulasyon_anlik_sene = :simulasyon_anlik_sene,
   simulasyon_button = :simulasyon_button,
   simulasyon_toplam_katilimci= :simulasyon_toplam_katilimci,
   simulasyon_bilgi = :simulasyon_bilgi,
   simulasyon_display = :simulasyon_display,
   simulasyon_display_kullanici = :simulasyon_display_kullanici
   ");
 $insert = $veri_ekle->execute(array(
   "simulasyon_toplam_sene" => htmlspecialchars($_POST['simulasyon_toplam_sene']),
   "simulasyon_sablon_id" =>($simulasyon_sablon_id),
   "simulasyon_tarih" => htmlspecialchars($simulasyon_tarih),
   "simulasyon_bilgi" => "adlı eğitimin 1. sene uygulaması başlatılmıştır. Teklifler bekleniyor..",
   "simulasyon_button" => "2. Sene'ye Geç ⏩",
   "simulasyon_display" => "",
   "simulasyon_display_kullanici" => "",
   "simulasyon_anlik_sene" => htmlspecialchars($simulasyon_anlik_sene),
   "simulasyon_kimlik" => htmlspecialchars($simulasyon_kimlik),
   "simulasyon_ad" =>  htmlspecialchars($_POST['simulasyon_ad']),
   "simulasyon_toplam_katilimci" => htmlspecialchars($_POST['simulasyon_toplam_katilimci'])
   
  
 ));
 if ( $insert ){
	 $dosya = fopen ('simulasyon_'.$simulasyon_kimlik.'.php' , 'w'); //dosya oluşturma işlemi
	 $yaz='<?php $simulasyon_kimlik="'.$simulasyon_kimlik.'"; include "simulasyon_yonet_icerik.php"; ?>'; //dosya içine ne yazmak istiyorsanız buraya yazın. $değer
	 fwrite ( $dosya , $yaz ) ;
	 fclose ($dosya);
	 $dosya2 = fopen ('simulasyon_'.$simulasyon_kimlik.'_rapor.php' , 'w'); //dosya oluşturma işlemi
	 $yaz2='<?php $simulasyon_kimlik="'.$simulasyon_kimlik.'"; include "simulasyon_rapor_icerik.php"; ?>'; //dosya içine ne yazmak istiyorsanız buraya yazın. $değer
	 fwrite ( $dosya2 , $yaz2 ) ;
	 fclose ($dosya2);
	 
	 
	 $liste = array ("A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M");
	 $tekrar = 0;
	 while($tekrar < $simulasyon_toplam_katilimci){
		 
		 $banka_ad = $liste[$tekrar];
		$rastgele_sifre = rand(1000,9999);
		$veri_ekle_kullanici = $db->prepare("INSERT INTO kullanicilar SET
		   kullanici_ad = :kullanici_ad,
		   kullanici_sifre = :kullanici_sifre,
		   kullanici_banka_ad = :kullanici_banka_ad,
		   kullanici_simulasyon_id = :kullanici_simulasyon_id
		   ");
		 $insert_kullanici = $veri_ekle_kullanici->execute(array(
		   "kullanici_ad" => $banka_ad,
		   "kullanici_sifre" => $rastgele_sifre,
		   "kullanici_banka_ad" => $banka_ad,
		   "kullanici_simulasyon_id" => $simulasyon_kimlik
 ));
		 $tekrar++;
	 }
	 
	 for($dongu_sene=1;$dongu_sene <= $simulasyon_toplam_sene; $dongu_sene++){		
	
$kullanici_list=1;
$kullanici_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."' ORDER BY kullanici_id ASC");
$kullanici_sorgu->execute();
while ($kullanici=$kullanici_sorgu->fetch(PDO::FETCH_ASSOC)) { $kullanici_list++;
											
	$firma_list=1;
	$firma_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sablon_id='".$simulasyon_sablon_id."' AND firma_sene=".$dongu_sene." ORDER BY firma_sira ASC");
	$firma_sorgu->execute();
	while ($firma=$firma_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_list++;										  
		$oneri_simulasyon_id = $simulasyon_kimlik;
		$oneri_ekle = $db->prepare("INSERT INTO oneri SET 
			oneri_simulasyon_id =:oneri_simulasyon_id,
			oneri_sene =:oneri_sene,
			oneri_kullanici_id =:oneri_kullanici_id,
			oneri_kullanici_banka =:oneri_kullanici_banka,
			oneri_firma_id =:oneri_firma_id,
			oneri_firma_ad =:oneri_firma_ad,
			oneri_firma_dosya =:oneri_firma_dosya,
			oneri_batak =:oneri_batak,
			oneri_kontrol =:oneri_kontrol,
			oneri_ihtiyac_tl =:oneri_ihtiyac_tl,
			oneri_ihtiyac_usd =:oneri_ihtiyac_usd,
			oneri_ihtiyac_tem =:oneri_ihtiyac_tem,
			oneri_ihtiyac_itha =:oneri_ihtiyac_itha,
			oneri_ihtiyac_forw =:oneri_ihtiyac_forw,
			oneri_ihtiyac_ithv =:oneri_ihtiyac_ithv,
			oneri_ihtiyac_ihra =:oneri_ihtiyac_ihra,
			oneri_ihtiyac_ihrv =:oneri_ihtiyac_ihrv,
			oneri_hacim_usd =:oneri_hacim_usd,
			oneri_hacim_senet =:oneri_hacim_senet,
			oneri_pozisyon_usd =:oneri_pozisyon_usd,
		    teklif_tl_miktar =:teklif_tl_miktar,
			teklif_tl_oran =:teklif_tl_oran,
			teklif_usd_miktar =:teklif_usd_miktar,
			teklif_usd_oran =:teklif_usd_oran,
			teklif_tem_miktar =:teklif_tem_miktar,
			teklif_tem_oran =:teklif_tem_oran,
			teklif_itha_miktar =:teklif_itha_miktar,
			teklif_itha_oran =:teklif_itha_oran,
			teklif_forw_miktar =:teklif_forw_miktar,
			teklif_forw_oran =:teklif_forw_oran,
			kredi_tl_miktar =:kredi_tl_miktar,
			kredi_tl_oran =:kredi_tl_oran,
			kredi_usd_miktar =:kredi_usd_miktar,
			kredi_usd_oran =:kredi_usd_oran,
			kredi_tem_miktar =:kredi_tem_miktar,
			kredi_tem_oran =:kredi_tem_oran,
			kredi_itha_miktar =:kredi_itha_miktar,
			kredi_itha_oran =:kredi_itha_oran,
			kredi_forw_miktar =:kredi_forw_miktar,
			kredi_forw_oran =:kredi_forw_oran
			");
			
			$insert = $oneri_ekle->execute(array(
			'oneri_simulasyon_id' => ($oneri_simulasyon_id),
			'oneri_sene' => ($dongu_sene),
			'oneri_kullanici_id' => ($kullanici['kullanici_id']),
			'oneri_kullanici_banka' => ($kullanici['kullanici_banka_ad']),
			'oneri_firma_id' => ($firma['firma_id']),
			'oneri_firma_ad' => ($firma['firma_ad']),
			'oneri_firma_dosya' => ($firma['firma_dosya']),
			'oneri_batak' => ($firma['firma_batak']),
			'oneri_kontrol' => '0',
			'oneri_ihtiyac_tl' => ($firma['firma_ihtiyac_tl']),
			'oneri_ihtiyac_usd' => ($firma['firma_ihtiyac_usd']),
			'oneri_ihtiyac_tem' => ($firma['firma_ihtiyac_tem']),
			'oneri_ihtiyac_itha' => ($firma['firma_ihtiyac_itha']),
			'oneri_ihtiyac_forw' => ($firma['firma_ihtiyac_forw']),
			'oneri_ihtiyac_ithv' => ($firma['firma_ihtiyac_ithv']),
			'oneri_ihtiyac_ihra' => ($firma['firma_ihtiyac_ihra']),
			'oneri_ihtiyac_ihrv' => ($firma['firma_ihtiyac_ihrv']),
			'oneri_hacim_usd' => ($firma['firma_hacim_usd']),
			'oneri_hacim_senet' => ($firma['firma_hacim_senet']),
			'oneri_pozisyon_usd' => ($firma['firma_pozisyon_usd']),		
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
			'kredi_tl_miktar' => 0,
			'kredi_tl_oran' => 0,
			'kredi_usd_miktar' => 0,
			'kredi_usd_oran' => 0,
			'kredi_tem_miktar' => 0,
			'kredi_tem_oran' => 0,
			'kredi_itha_miktar' => 0,
			'kredi_itha_oran' => 0,
			'kredi_forw_miktar' => 0,
			'kredi_forw_oran' => 0
			
			
			));	
	}
																		  
}												  
			
		
}
	 
	 
	 

     header("Location: simulasyon_".$simulasyon_kimlik.".php");
	
 } 
		else {
     header("Location: ".$simulasyon_kimlik.".php?durum=basarisiz");
 }
	
}



?>                		
<?php  
		
		
					$simulasyon_sorgu=$db->prepare("SELECT * FROM simulasyon ORDER BY simulasyon_id DESC LIMIT 1");
					$simulasyon_sorgu->execute();
					$simulasyon_veri=$simulasyon_sorgu->fetch(PDO::FETCH_ASSOC); ?>


                       <div style="height:100vh;padding-left:50px;padding-right:50px;padding-top:60px;background-color:#D4DCE6;" class="col-xl-12 col-md">
					    <h4 style="color:#FF6501;text-align:center;" class="mb-3">Yeni bir Simülasyon Tasarla</h4>
						   <hr>
						   <br>
						   
						   						

				
						   <div style="margin:auto;"class="row col-lg-7">
        					 <form enctype="multipart/form-data" action="" method="POST">
                             <div class="col-lg-12">
                  
								<div class="form-row">
								<div class="form-group col-md-6">
				  <label for="fname"><strong>Simülasyon Adı:</strong></label><br>
				  <input class="form-control" style="width:100%" type="text" name="simulasyon_ad" required>

								</div>
									<div class="form-group col-md-6">
				  <label for="fname"><strong>Şablon Seçiniz:</strong></label><br>
				  <select class="form-control" name="simulasyon_sablon_id" id="simulasyon_sablon_id" required>
					  <?php /*
						$sablon_poful_id=1;
						$sablon_bdk=$db->prepare("SELECT * FROM sablon ORDER BY sablon_id ASC");
						$sablon_bdk->execute();
						while ($sablon_poful=$sablon_bdk->fetch(PDO::FETCH_ASSOC)) { $sablon_poful_id++; ?>
					  <option value="<?php echo $sablon_poful['sablon_id']; ?>"><?php echo $sablon_poful['sablon_ad']; ?></option>
					
					  <?php } */?> 
					  <option value="39">Yeni Simülasyon</option>
					</select>
<br>
								</div>
									
									<div class="form-group col-md-6">
				  <label for="fname"><strong>Grup sayısı: </strong></label><br>
				  <select class="form-control" name="simulasyon_toplam_katilimci" required>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
			  	  <option value="9">9</option>
				  <option value="10">10</option>
				  </select>
								</div>
									<div class="form-group col-md-6">
										<label for="fname"><strong>Sene sayısı:</strong></label><br>
				 <select class="form-control" name="simulasyon_toplam_sene" required>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  </select>
								</div>

								</div>
								<br>

								<span><i><strong>Not:</strong><br>Eğitim adını oluştururken, verdiğiniz ismin içerisinde o günün tarihini yazmanız gerektiğine dikkat ediniz.
İsim çakışmasının engellenmesi açısından önerilir.<br><br>Örn: finansbank061222, TEB 09.11.2022</i></span>		
								
								 
                              </div>
							  
							   
				<div class="col-lg-12">
					<br>
					<div style="text-align:center;">
						<input type="submit" class="ide_button" name="simulasyon_ekle" value="Yeni bir Simülasyon Tasarla">
	 				</div>
				</div>
						   
						   </form>
			 </div>
						   
						  	
                    </div>

	   
					
                    </div>

        <?php include "footer.php"; ?>
<?php } else{
	header('location:login.php?hata=girisyapilmadi');
}
?>
<?php ob_end_flush() ?>

