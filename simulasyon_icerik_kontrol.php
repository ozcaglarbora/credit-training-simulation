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
										   									   
if (isset($_POST['simulasyon_sil'])){
 $simulasyon_sil_sorgu = $db->prepare("DELETE FROM simulasyon WHERE simulasyon_kimlik = :kimlik");
 $simulasyon_sil = $simulasyon_sil_sorgu->execute(array(
    'kimlik' => htmlspecialchars($_POST['simulasyon_kimlik'])
 ));
 
 $kullanici_sil_sorgu = $db->prepare("DELETE FROM kullanicilar WHERE kullanici_simulasyon_id = :kimlikv");
 $kullanici_sil = $kullanici_sil_sorgu->execute(array(
    'kimlikv' => htmlspecialchars($_POST['simulasyon_kimlik'])
 ));
	
 $oneri_sil_sorgu = $db->prepare("DELETE FROM oneri WHERE oneri_simulasyon_id = :kimlikvv");
 $oneri_sil = $oneri_sil_sorgu->execute(array(
    'kimlikvv' => htmlspecialchars($_POST['simulasyon_kimlik'])
 ));
	
 $dosya_sil = "simulasyon_".$_POST['simulasyon_kimlik'].".php";
 unlink($dosya_sil);
$dosya_sil2 = "simulasyon_".$_POST['simulasyon_kimlik']."_rapor.php";
 unlink($dosya_sil2);

 if ($simulasyon_sil) {
   header("Location: simulasyon_genelbakis.php?durum=basarili");
 } else {
     header("Location: simulasyon_genelbakis.php?durum=basarisiz");
 }
}


?>
    <div style="background-color:#D4DCE6;"class="col-12">	
	<br>	
        <br>
					    <h4 style="color:#FF6501;text-align:center;" class="mb-3">Kredi Eğitim Simülasyonu</h4>

						   <hr>
						   <br>
						   					
	
	<h6 style="text-align:center;" class="mb-3">Sisteme yönetici olarak giriş yapmış bulunmaktasınız.</h6>
	<div style="text-align:center" class="col-12">

	<a class="ide_button" href="simulasyon_tasarla.php">Yeni Bir Eğitim Tasarla</a>
	<br>
	<br>
	</div>				 
					
                </div>              		
<div style="background-color:#D4DCE6;"class="col-12">	
	
				<div style="text-align:center;font-size:16px;">
		Aşağıdaki menüyü kullanarak firmaların içerik bilgilerini kontrol edebilirsiniz.</div>
	<hr>
						 <div style="font-weight:600;text-align:center;margin:auto;" class="col-4">
		<?php
		
			if(isset($_GET["durum"]))
			{
				if($_GET["durum"] == 'olusturuldu')
				{
					echo '
					<div class="alert alert-success">
					<i class="fa fa-times-circle-o"></i> Yeni bir simülasyon oluşturuldu !
				</div>
				
					';
				}
				if($_GET["durum"] == 'basarisiz')
				{
					echo '
					<div class="alert alert-danger">
					<i class="fa fa-times-circle-o"></i>İşlem Başarısız !
				</div>
				
					';
				}
				
			}
			
			
			?>
		</div>
						<div class="row mb-8">
								
				 <div id="firmalar" style="width:1000px;height:30vh;margin:auto; text-align:center;">
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/solar_4.php">Solar Enerji A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/mdf_2.php">MDF Üretim A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/kagitsan_1.php">Kağıtsan LTD ŞTİ</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/oto_sanayi_4.php">Otomativ Sanayi A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/kimya_sanayi_2.php">Kimya Sanayi A.Ş</a></button>
					 <br><br>
	<button type="button" class="btn btn-secondary"><a target="_blank"href="simulasyon_dosya/pilka_4.php">Pilka Plastik A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/gida_dagitim_4.php">Gıda Dağıtım LTD ŞTİ</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/seramik_sanayi_4.php">Seramik Sanayi A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/hazir_giyim_4.php">Hazır Giyim A.Ş</a></button>
	</div>				
					
                
			
							
					
						
                </div>
	     
                    
                    
                </div>
	   
					
                    </div>

        <?php include "footer.php"; ?>
<?php } else{
	header('location:login.php?hata=girisyapilmadi');
}
?>
<?php ob_end_flush() ?>

