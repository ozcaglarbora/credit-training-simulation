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
		Daha önceden oluşturulmuş simülasyonlar bu tablodadır. Aktif bir eğitime devam etmek için tablodaki "Yönet" butonunu kullanınız.</div>
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
								
				
			
							
							
							
                    <div class="col-xl-12 col-wd-12gdot5">
                        <table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Simulasyon Adı</th>
		<th scope="col">Tarih</th>
		<th scope="col">Şablon Adı</th>
      <th scope="col">Şu anki Sene</th>
		<th scope="col">Toplam Sene</th>
		
	  
	  <th style="width:120px;"scope="col">İşlemler</th>
    </tr>
  </thead>
  <tbody style="background-color:white;">
	  <?php
					$simulasyon_id=1;
					$simulasyon=$db->prepare("SELECT * FROM simulasyon ORDER BY simulasyon_id DESC");
					$simulasyon->execute();
					while ($simulasyon_exe=$simulasyon->fetch(PDO::FETCH_ASSOC)) { $simulasyon_id++;
	  
	
					$sablon_cek_id=1;
					$sablon_cek=$db->prepare("SELECT * FROM sablon WHERE sablon_id='".$simulasyon_exe["simulasyon_sablon_id"]."'");
					$sablon_cek->execute();
					$sablon_cek_exe=$sablon_cek->fetch(PDO::FETCH_ASSOC); 	?>	
    <tr>
		
      <th scope="row"><?php echo $simulasyon_exe["simulasyon_id"]; ?></th>
      <td><?php echo $simulasyon_exe["simulasyon_ad"]; ?></td>
		<td><?php echo $simulasyon_exe["simulasyon_tarih"]; ?></td>
		<td><?php echo $sablon_cek_exe["sablon_ad"]; ?></td>
      <td><?php echo $simulasyon_exe["simulasyon_anlik_sene"]; ?></td>
		 <td><?php echo $simulasyon_exe["simulasyon_toplam_sene"]; ?></td>
		
	 
		
		<td>
			<div class="d-flex">
                                                               <a href="simulasyon_<?php echo $simulasyon_exe['simulasyon_kimlik']?>.php">
                                                                    <input type="hidden" name="simulasyon_id" value="<?php echo $simulasyon_exe['simulasyon_id'] ?>">
                                                                    <button type="submit" name="simulasyon_yonet_id" class="btn btn-warning btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Yönet
                                                                    </span>
                                                                    </button>
				</a>
                                                                <form class="mx-1" action="" method="POST" onSubmit="return confirm('Bu veriyi silmek istediğinizden emin misiniz ?');">
                                                                    <input type="hidden" name="simulasyon_kimlik" value="<?php echo $simulasyon_exe['simulasyon_kimlik']; ?>">
                                                                   
                                                                    <button type="submit" name="simulasyon_sil" class="btn btn-danger btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Sil
                                                                    </span>
                                                                    </button>
                                                                </form>
                                                            </div>
		</td>
		
    </tr>
    <?php } ?>
  </tbody>
</table>
                       <br>
						<br>
						<br>
						
                    </div>
										
						
                </div>
	  <div id="firmalar" style="margin:auto;">
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/solar_4.php">Solar Enerji A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/mdf_2.php">MDF Üretim A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/kagitsan_1.php">Kağıtsan LTD ŞTİ</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/oto_sanayi_4.php">Otomativ Sanayi A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/kimya_sanayi_2.php">Kimya Sanayi A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank"href="simulasyon_dosya/pilka_4.php">Pilka Plastik A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/gida_dagitim_4.php">Gıda Dağıtım LTD ŞTİ</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/seramik_sanayi_4.php">Seramik Sanayi A.Ş</a></button>
	<button type="button" class="btn btn-secondary"><a target="_blank" href="simulasyon_dosya/hazir_giyim_4.php">Hazır Giyim A.Ş</a></button>
	</div>				
					
                    
                    
                    
                </div>
	   
					
                    </div>

        <?php include "footer.php"; ?>
<?php } else{
	header('location:login.php?hata=girisyapilmadi');
}
?>
<?php ob_end_flush() ?>

