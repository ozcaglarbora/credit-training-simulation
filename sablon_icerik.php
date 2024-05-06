<?php ob_start(); ?>
<?php session_start(); ?>
<?php 
$url_id = $sablon_kimlik;
$navbar_kimlik = "simulasyon_admin";
$navbar_baslik = "YÖNETİM PANELİ";
$title="İDE Eğitim Danışmanlık | Yönetim Paneli";
$description="İDE EĞİTİM VE DANIŞMANLIK, kurumların insan kaynağı ve finansal danışmanlık gereksinimlerini eksiksiz karşılamak üzere kurulmuş bir firmadır.";
$keywords="egitim, danışmanlık, eğitim, kredi eğitimi, finansal danışmanlık, şirket değerleme, bilanço analizi";
if($_SESSION['kullanici_ad'] == "kredisim"){?>
<?php 
 include "header.php"; 
 include "navbar_simulasyon.php"; 

	$sablon_sorgu=$db->prepare("SELECT * FROM sablon WHERE sablon_id='".$sablon_kimlik."'");
	$sablon_sorgu->execute();
	$sablon_exe=$sablon_sorgu->fetch(PDO::FETCH_ASSOC);
	
?>
<?php 
	
	if (isset($_POST['sablon_duzenle'])) {
	$parametre_sene_1_faiz_tl_ort = ($_POST['parametre_sene_1_faiz_tl_bas'] + $_POST['parametre_sene_1_faiz_tl_son'])/2;
	$parametre_sene_2_faiz_tl_ort = ($_POST['parametre_sene_2_faiz_tl_bas'] + $_POST['parametre_sene_2_faiz_tl_son'])/2;
	$parametre_sene_3_faiz_tl_ort = ($_POST['parametre_sene_3_faiz_tl_bas'] + $_POST['parametre_sene_3_faiz_tl_son'])/2;
	$parametre_sene_4_faiz_tl_ort = ($_POST['parametre_sene_4_faiz_tl_bas'] + $_POST['parametre_sene_4_faiz_tl_son'])/2;
	
	$parametre_sene_1_faiz_usd_ort = ($_POST['parametre_sene_1_faiz_usd_bas'] + $_POST['parametre_sene_1_faiz_usd_son'])/2;
	$parametre_sene_2_faiz_usd_ort = ($_POST['parametre_sene_2_faiz_usd_bas'] + $_POST['parametre_sene_2_faiz_usd_son'])/2;
	$parametre_sene_3_faiz_usd_ort = ($_POST['parametre_sene_3_faiz_usd_bas'] + $_POST['parametre_sene_3_faiz_usd_son'])/2;
	$parametre_sene_4_faiz_usd_ort = ($_POST['parametre_sene_4_faiz_usd_bas'] + $_POST['parametre_sene_4_faiz_usd_son'])/2;
	
	$parametre_sene_1_kur_ort = ($_POST['parametre_sene_1_kur_bas'] + $_POST['parametre_sene_1_kur_son'])/2;
	$parametre_sene_2_kur_ort = ($_POST['parametre_sene_2_kur_bas'] + $_POST['parametre_sene_2_kur_son'])/2;
	$parametre_sene_3_kur_ort = ($_POST['parametre_sene_3_kur_bas'] + $_POST['parametre_sene_3_kur_son'])/2;
	$parametre_sene_4_kur_ort = ($_POST['parametre_sene_4_kur_bas'] + $_POST['parametre_sene_4_kur_son'])/2;
	
     $veri_ekle = $db->prepare("UPDATE sablon SET
   parametre_sene_1_faiz_tl_bas = :parametre_sene_1_faiz_tl_bas,
   parametre_sene_2_faiz_tl_bas = :parametre_sene_2_faiz_tl_bas,
   parametre_sene_3_faiz_tl_bas = :parametre_sene_3_faiz_tl_bas,
   parametre_sene_4_faiz_tl_bas = :parametre_sene_4_faiz_tl_bas,
   
   parametre_sene_1_faiz_tl_son = :parametre_sene_1_faiz_tl_son,
   parametre_sene_2_faiz_tl_son = :parametre_sene_2_faiz_tl_son,
   parametre_sene_3_faiz_tl_son = :parametre_sene_3_faiz_tl_son,
   parametre_sene_4_faiz_tl_son = :parametre_sene_4_faiz_tl_son,
   
   parametre_sene_1_faiz_tl_ort = :parametre_sene_1_faiz_tl_ort,
   parametre_sene_2_faiz_tl_ort = :parametre_sene_2_faiz_tl_ort,
   parametre_sene_3_faiz_tl_ort = :parametre_sene_3_faiz_tl_ort,
   parametre_sene_4_faiz_tl_ort = :parametre_sene_4_faiz_tl_ort,
   
   parametre_sene_1_faiz_usd_bas = :parametre_sene_1_faiz_usd_bas,
   parametre_sene_2_faiz_usd_bas = :parametre_sene_2_faiz_usd_bas,
   parametre_sene_3_faiz_usd_bas = :parametre_sene_3_faiz_usd_bas,
   parametre_sene_4_faiz_usd_bas = :parametre_sene_4_faiz_usd_bas,
   
   parametre_sene_1_faiz_usd_son = :parametre_sene_1_faiz_usd_son,
   parametre_sene_2_faiz_usd_son = :parametre_sene_2_faiz_usd_son,
   parametre_sene_3_faiz_usd_son = :parametre_sene_3_faiz_usd_son,
   parametre_sene_4_faiz_usd_son = :parametre_sene_4_faiz_usd_son,
   
   parametre_sene_1_faiz_usd_ort = :parametre_sene_1_faiz_usd_ort,
   parametre_sene_2_faiz_usd_ort = :parametre_sene_2_faiz_usd_ort,
   parametre_sene_3_faiz_usd_ort = :parametre_sene_3_faiz_usd_ort,
   parametre_sene_4_faiz_usd_ort = :parametre_sene_4_faiz_usd_ort,
   
   parametre_sene_1_kur_bas = :parametre_sene_1_kur_bas,
   parametre_sene_2_kur_bas = :parametre_sene_2_kur_bas,
   parametre_sene_3_kur_bas = :parametre_sene_3_kur_bas,
   parametre_sene_4_kur_bas = :parametre_sene_4_kur_bas,
   
   parametre_sene_1_kur_son = :parametre_sene_1_kur_son,
   parametre_sene_2_kur_son = :parametre_sene_2_kur_son,
   parametre_sene_3_kur_son = :parametre_sene_3_kur_son,
   parametre_sene_4_kur_son = :parametre_sene_4_kur_son,
   
   parametre_sene_1_kur_ort = :parametre_sene_1_kur_ort,
   parametre_sene_2_kur_ort = :parametre_sene_2_kur_ort,
   parametre_sene_3_kur_ort = :parametre_sene_3_kur_ort,
   parametre_sene_4_kur_ort = :parametre_sene_4_kur_ort,
   
   parametre_sene_1_spread_alsat = :parametre_sene_1_spread_alsat,
   parametre_sene_2_spread_alsat = :parametre_sene_2_spread_alsat,
   parametre_sene_3_spread_alsat = :parametre_sene_3_spread_alsat,
   parametre_sene_4_spread_alsat = :parametre_sene_4_spread_alsat,
   
   parametre_sene_1_spread_faiz_tl = :parametre_sene_1_spread_faiz_tl,
   parametre_sene_2_spread_faiz_tl = :parametre_sene_2_spread_faiz_tl,
   parametre_sene_3_spread_faiz_tl = :parametre_sene_3_spread_faiz_tl,
   parametre_sene_4_spread_faiz_tl = :parametre_sene_4_spread_faiz_tl,
  
   parametre_sene_1_spread_faiz_usd = :parametre_sene_1_spread_faiz_usd,
   parametre_sene_2_spread_faiz_usd = :parametre_sene_2_spread_faiz_usd,
   parametre_sene_3_spread_faiz_usd = :parametre_sene_3_spread_faiz_usd,
   parametre_sene_4_spread_faiz_usd = :parametre_sene_4_spread_faiz_usd,
   
   parametre_sene_1_komisyon_ithv = :parametre_sene_1_komisyon_ithv,
   parametre_sene_2_komisyon_ithv = :parametre_sene_2_komisyon_ithv,
   parametre_sene_3_komisyon_ithv = :parametre_sene_3_komisyon_ithv,
   parametre_sene_4_komisyon_ithv = :parametre_sene_4_komisyon_ithv,
   
   parametre_sene_1_komisyon_ihrv = :parametre_sene_1_komisyon_ihrv,
   parametre_sene_2_komisyon_ihrv = :parametre_sene_2_komisyon_ihrv,
   parametre_sene_3_komisyon_ihrv = :parametre_sene_3_komisyon_ihrv,
   parametre_sene_4_komisyon_ihrv = :parametre_sene_4_komisyon_ihrv,
   
   parametre_sene_1_komisyon_ihra_ihbar = :parametre_sene_1_komisyon_ihra_ihbar,
   parametre_sene_2_komisyon_ihra_ihbar = :parametre_sene_2_komisyon_ihra_ihbar,
   parametre_sene_3_komisyon_ihra_ihbar = :parametre_sene_3_komisyon_ihra_ihbar,
   parametre_sene_4_komisyon_ihra_ihbar = :parametre_sene_4_komisyon_ihra_ihbar,
   
   parametre_sene_1_komisyon_ihra_teyit = :parametre_sene_1_komisyon_ihra_teyit,
   parametre_sene_2_komisyon_ihra_teyit = :parametre_sene_2_komisyon_ihra_teyit,
   parametre_sene_3_komisyon_ihra_teyit = :parametre_sene_3_komisyon_ihra_teyit,
   parametre_sene_4_komisyon_ihra_teyit = :parametre_sene_4_komisyon_ihra_teyit,
   
   parametre_sene_1_komisyon_senet = :parametre_sene_1_komisyon_senet,
   parametre_sene_2_komisyon_senet = :parametre_sene_2_komisyon_senet,
   parametre_sene_3_komisyon_senet = :parametre_sene_3_komisyon_senet,
   parametre_sene_4_komisyon_senet = :parametre_sene_4_komisyon_senet,
   
   parametre_sene_1_simbank_faiz_tl = :parametre_sene_1_simbank_faiz_tl,
   parametre_sene_2_simbank_faiz_tl = :parametre_sene_2_simbank_faiz_tl,
   parametre_sene_3_simbank_faiz_tl = :parametre_sene_3_simbank_faiz_tl,
   parametre_sene_4_simbank_faiz_tl = :parametre_sene_4_simbank_faiz_tl,
   
   parametre_sene_1_simbank_faiz_usd = :parametre_sene_1_simbank_faiz_usd,
   parametre_sene_2_simbank_faiz_usd = :parametre_sene_2_simbank_faiz_usd,
   parametre_sene_3_simbank_faiz_usd = :parametre_sene_3_simbank_faiz_usd,
   parametre_sene_4_simbank_faiz_usd = :parametre_sene_4_simbank_faiz_usd,
   
   parametre_sene_1_simbank_komisyon_tem = :parametre_sene_1_simbank_komisyon_tem,
   parametre_sene_2_simbank_komisyon_tem = :parametre_sene_2_simbank_komisyon_tem,
   parametre_sene_3_simbank_komisyon_tem = :parametre_sene_3_simbank_komisyon_tem,
   parametre_sene_4_simbank_komisyon_tem = :parametre_sene_4_simbank_komisyon_tem,
   
   parametre_sene_1_simbank_komisyon_itha = :parametre_sene_1_simbank_komisyon_itha,
   parametre_sene_2_simbank_komisyon_itha = :parametre_sene_2_simbank_komisyon_itha,
   parametre_sene_3_simbank_komisyon_itha = :parametre_sene_3_simbank_komisyon_itha,
   parametre_sene_4_simbank_komisyon_itha = :parametre_sene_4_simbank_komisyon_itha,
   
   parametre_sene_1_simbank_spread_forw = :parametre_sene_1_simbank_spread_forw,
   parametre_sene_2_simbank_spread_forw = :parametre_sene_2_simbank_spread_forw,
   parametre_sene_3_simbank_spread_forw = :parametre_sene_3_simbank_spread_forw,
   parametre_sene_4_simbank_spread_forw = :parametre_sene_4_simbank_spread_forw,
   parametre_sene_1_ust_limit = :parametre_sene_1_ust_limit,
   parametre_sene_2_ust_limit = :parametre_sene_2_ust_limit,
   parametre_sene_3_ust_limit = :parametre_sene_3_ust_limit,
   parametre_sene_4_ust_limit = :parametre_sene_4_ust_limit,
   
   parametre_sene_1_kasa =:parametre_sene_1_kasa,
   parametre_sene_2_kasa =:parametre_sene_2_kasa,
   parametre_sene_3_kasa =:parametre_sene_3_kasa,
   parametre_sene_4_kasa =:parametre_sene_4_kasa,
   
   parametre_sene_1_portfoy_maaslari =:parametre_sene_1_portfoy_maaslari,
   parametre_sene_2_portfoy_maaslari =:parametre_sene_2_portfoy_maaslari,
   parametre_sene_3_portfoy_maaslari =:parametre_sene_3_portfoy_maaslari,
   parametre_sene_4_portfoy_maaslari =:parametre_sene_4_portfoy_maaslari,
   
   parametre_sene_1_kira =:parametre_sene_1_kira,
   parametre_sene_2_kira =:parametre_sene_2_kira,
   parametre_sene_3_kira =:parametre_sene_3_kira,
   parametre_sene_4_kira =:parametre_sene_4_kira
  
   
  WHERE sablon_id={$_POST['sablon_id']}");
   
  
   

	
 $insert = $veri_ekle->execute(array(
   'parametre_sene_1_faiz_tl_bas' =>htmlspecialchars($_POST['parametre_sene_1_faiz_tl_bas']),
   'parametre_sene_2_faiz_tl_bas' =>htmlspecialchars($_POST['parametre_sene_2_faiz_tl_bas']),
   'parametre_sene_3_faiz_tl_bas' =>htmlspecialchars($_POST['parametre_sene_3_faiz_tl_bas']),
   'parametre_sene_4_faiz_tl_bas' =>htmlspecialchars($_POST['parametre_sene_4_faiz_tl_bas']),
   
   'parametre_sene_1_faiz_tl_son' =>htmlspecialchars($_POST['parametre_sene_1_faiz_tl_son']),
   'parametre_sene_2_faiz_tl_son' =>htmlspecialchars($_POST['parametre_sene_2_faiz_tl_son']),
   'parametre_sene_3_faiz_tl_son' =>htmlspecialchars($_POST['parametre_sene_3_faiz_tl_son']),
   'parametre_sene_4_faiz_tl_son' =>htmlspecialchars($_POST['parametre_sene_4_faiz_tl_son']),
   
   'parametre_sene_1_faiz_tl_ort' =>htmlspecialchars($parametre_sene_1_faiz_tl_ort),
   'parametre_sene_2_faiz_tl_ort' =>htmlspecialchars($parametre_sene_2_faiz_tl_ort),
   'parametre_sene_3_faiz_tl_ort' =>htmlspecialchars($parametre_sene_3_faiz_tl_ort),
   'parametre_sene_4_faiz_tl_ort' =>htmlspecialchars($parametre_sene_4_faiz_tl_ort),
   
   'parametre_sene_1_faiz_usd_bas' =>htmlspecialchars($_POST['parametre_sene_1_faiz_usd_bas']),
   'parametre_sene_2_faiz_usd_bas' =>htmlspecialchars($_POST['parametre_sene_2_faiz_usd_bas']),
   'parametre_sene_3_faiz_usd_bas' =>htmlspecialchars($_POST['parametre_sene_3_faiz_usd_bas']),
   'parametre_sene_4_faiz_usd_bas' =>htmlspecialchars($_POST['parametre_sene_4_faiz_usd_bas']),
   
   'parametre_sene_1_faiz_usd_son' =>htmlspecialchars($_POST['parametre_sene_1_faiz_usd_son']),
   'parametre_sene_2_faiz_usd_son' =>htmlspecialchars($_POST['parametre_sene_2_faiz_usd_son']),
   'parametre_sene_3_faiz_usd_son' =>htmlspecialchars($_POST['parametre_sene_3_faiz_usd_son']),
   'parametre_sene_4_faiz_usd_son' =>htmlspecialchars($_POST['parametre_sene_4_faiz_usd_son']),
   
   'parametre_sene_1_faiz_usd_ort' =>htmlspecialchars($parametre_sene_1_faiz_usd_ort),
   'parametre_sene_2_faiz_usd_ort' =>htmlspecialchars($parametre_sene_2_faiz_usd_ort),
   'parametre_sene_3_faiz_usd_ort' =>htmlspecialchars($parametre_sene_3_faiz_usd_ort),
   'parametre_sene_4_faiz_usd_ort' =>htmlspecialchars($parametre_sene_4_faiz_usd_ort),
   
   'parametre_sene_1_kur_bas' =>htmlspecialchars($_POST['parametre_sene_1_kur_bas']),
   'parametre_sene_2_kur_bas' =>htmlspecialchars($_POST['parametre_sene_2_kur_bas']),
   'parametre_sene_3_kur_bas' =>htmlspecialchars($_POST['parametre_sene_3_kur_bas']),
   'parametre_sene_4_kur_bas' =>htmlspecialchars($_POST['parametre_sene_4_kur_bas']),
   
   'parametre_sene_1_kur_son' =>htmlspecialchars($_POST['parametre_sene_1_kur_son']),
   'parametre_sene_2_kur_son' =>htmlspecialchars($_POST['parametre_sene_2_kur_son']),
   'parametre_sene_3_kur_son' =>htmlspecialchars($_POST['parametre_sene_3_kur_son']),
   'parametre_sene_4_kur_son' =>htmlspecialchars($_POST['parametre_sene_4_kur_son']),
   
   'parametre_sene_1_kur_ort' =>htmlspecialchars($parametre_sene_1_kur_ort),
   'parametre_sene_2_kur_ort' =>htmlspecialchars($parametre_sene_2_kur_ort),
   'parametre_sene_3_kur_ort' =>htmlspecialchars($parametre_sene_3_kur_ort),
   'parametre_sene_4_kur_ort' =>htmlspecialchars($parametre_sene_4_kur_ort),
   
   'parametre_sene_1_spread_alsat' =>htmlspecialchars($_POST['parametre_sene_1_spread_alsat']),
   'parametre_sene_2_spread_alsat' =>htmlspecialchars($_POST['parametre_sene_2_spread_alsat']),
   'parametre_sene_3_spread_alsat' =>htmlspecialchars($_POST['parametre_sene_3_spread_alsat']),
   'parametre_sene_4_spread_alsat' =>htmlspecialchars($_POST['parametre_sene_4_spread_alsat']),
   
   'parametre_sene_1_spread_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_1_spread_faiz_tl']),
   'parametre_sene_2_spread_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_2_spread_faiz_tl']),
   'parametre_sene_3_spread_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_3_spread_faiz_tl']),
   'parametre_sene_4_spread_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_4_spread_faiz_tl']),
  
   'parametre_sene_1_spread_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_1_spread_faiz_usd']),
   'parametre_sene_2_spread_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_2_spread_faiz_usd']),
   'parametre_sene_3_spread_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_3_spread_faiz_usd']),
   'parametre_sene_4_spread_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_4_spread_faiz_usd']),
   
   'parametre_sene_1_komisyon_ithv' =>htmlspecialchars($_POST['parametre_sene_1_komisyon_ithv']),
   'parametre_sene_2_komisyon_ithv' =>htmlspecialchars($_POST['parametre_sene_2_komisyon_ithv']),
   'parametre_sene_3_komisyon_ithv' =>htmlspecialchars($_POST['parametre_sene_3_komisyon_ithv']),
   'parametre_sene_4_komisyon_ithv' =>htmlspecialchars($_POST['parametre_sene_4_komisyon_ithv']),
   
   'parametre_sene_1_komisyon_ihrv' =>htmlspecialchars($_POST['parametre_sene_1_komisyon_ihrv']),
   'parametre_sene_2_komisyon_ihrv' =>htmlspecialchars($_POST['parametre_sene_2_komisyon_ihrv']),
   'parametre_sene_3_komisyon_ihrv' =>htmlspecialchars($_POST['parametre_sene_3_komisyon_ihrv']),
   'parametre_sene_4_komisyon_ihrv' =>htmlspecialchars($_POST['parametre_sene_4_komisyon_ihrv']),
   
   'parametre_sene_1_komisyon_ihra_ihbar' =>htmlspecialchars($_POST['parametre_sene_1_komisyon_ihra_ihbar']),
   'parametre_sene_2_komisyon_ihra_ihbar' =>htmlspecialchars($_POST['parametre_sene_2_komisyon_ihra_ihbar']),
   'parametre_sene_3_komisyon_ihra_ihbar' =>htmlspecialchars($_POST['parametre_sene_3_komisyon_ihra_ihbar']),
   'parametre_sene_4_komisyon_ihra_ihbar' =>htmlspecialchars($_POST['parametre_sene_4_komisyon_ihra_ihbar']),
   
   'parametre_sene_1_komisyon_ihra_teyit' =>htmlspecialchars($_POST['parametre_sene_1_komisyon_ihra_teyit']),
   'parametre_sene_2_komisyon_ihra_teyit' =>htmlspecialchars($_POST['parametre_sene_2_komisyon_ihra_teyit']),
   'parametre_sene_3_komisyon_ihra_teyit' =>htmlspecialchars($_POST['parametre_sene_3_komisyon_ihra_teyit']),
   'parametre_sene_4_komisyon_ihra_teyit' =>htmlspecialchars($_POST['parametre_sene_4_komisyon_ihra_teyit']),
   
   'parametre_sene_1_komisyon_senet' =>htmlspecialchars($_POST['parametre_sene_1_komisyon_senet']),
   'parametre_sene_2_komisyon_senet' =>htmlspecialchars($_POST['parametre_sene_2_komisyon_senet']),
   'parametre_sene_3_komisyon_senet' =>htmlspecialchars($_POST['parametre_sene_3_komisyon_senet']),
   'parametre_sene_4_komisyon_senet' =>htmlspecialchars($_POST['parametre_sene_4_komisyon_senet']),
   
   'parametre_sene_1_simbank_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_1_simbank_faiz_tl']),
   'parametre_sene_2_simbank_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_2_simbank_faiz_tl']),
   'parametre_sene_3_simbank_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_3_simbank_faiz_tl']),
   'parametre_sene_4_simbank_faiz_tl' =>htmlspecialchars($_POST['parametre_sene_4_simbank_faiz_tl']),
   
   'parametre_sene_1_simbank_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_1_simbank_faiz_usd']),
   'parametre_sene_2_simbank_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_2_simbank_faiz_usd']),
   'parametre_sene_3_simbank_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_3_simbank_faiz_usd']),
   'parametre_sene_4_simbank_faiz_usd' =>htmlspecialchars($_POST['parametre_sene_4_simbank_faiz_usd']),
   
   'parametre_sene_1_simbank_komisyon_tem' =>htmlspecialchars($_POST['parametre_sene_1_simbank_komisyon_tem']),
   'parametre_sene_2_simbank_komisyon_tem' =>htmlspecialchars($_POST['parametre_sene_2_simbank_komisyon_tem']),
   'parametre_sene_3_simbank_komisyon_tem' =>htmlspecialchars($_POST['parametre_sene_3_simbank_komisyon_tem']),
   'parametre_sene_4_simbank_komisyon_tem' =>htmlspecialchars($_POST['parametre_sene_4_simbank_komisyon_tem']),
   
   'parametre_sene_1_simbank_komisyon_itha' =>htmlspecialchars($_POST['parametre_sene_1_simbank_komisyon_itha']),
   'parametre_sene_2_simbank_komisyon_itha' =>htmlspecialchars($_POST['parametre_sene_2_simbank_komisyon_itha']),
   'parametre_sene_3_simbank_komisyon_itha' =>htmlspecialchars($_POST['parametre_sene_3_simbank_komisyon_itha']),
   'parametre_sene_4_simbank_komisyon_itha' =>htmlspecialchars($_POST['parametre_sene_4_simbank_komisyon_itha']),
   
   'parametre_sene_1_simbank_spread_forw' =>htmlspecialchars($_POST['parametre_sene_1_simbank_spread_forw']),
   'parametre_sene_2_simbank_spread_forw' =>htmlspecialchars($_POST['parametre_sene_2_simbank_spread_forw']),
   'parametre_sene_3_simbank_spread_forw' =>htmlspecialchars($_POST['parametre_sene_3_simbank_spread_forw']),
   'parametre_sene_4_simbank_spread_forw' =>htmlspecialchars($_POST['parametre_sene_4_simbank_spread_forw']),
	 
   'parametre_sene_1_ust_limit' =>htmlspecialchars($_POST['parametre_sene_1_ust_limit']),
   'parametre_sene_2_ust_limit' =>htmlspecialchars($_POST['parametre_sene_2_ust_limit']),
   'parametre_sene_3_ust_limit' =>htmlspecialchars($_POST['parametre_sene_3_ust_limit']),
   'parametre_sene_4_ust_limit' =>htmlspecialchars($_POST['parametre_sene_4_ust_limit']),
	 
   'parametre_sene_1_kasa' =>htmlspecialchars($_POST['parametre_sene_1_kasa']),
   'parametre_sene_2_kasa' =>htmlspecialchars($_POST['parametre_sene_2_kasa']),
   'parametre_sene_3_kasa' =>htmlspecialchars($_POST['parametre_sene_3_kasa']),
   'parametre_sene_4_kasa' =>htmlspecialchars($_POST['parametre_sene_4_kasa']),
	 
   'parametre_sene_1_portfoy_maaslari' =>htmlspecialchars($_POST['parametre_sene_1_portfoy_maaslari']),
   'parametre_sene_2_portfoy_maaslari' =>htmlspecialchars($_POST['parametre_sene_2_portfoy_maaslari']),
   'parametre_sene_3_portfoy_maaslari' =>htmlspecialchars($_POST['parametre_sene_3_portfoy_maaslari']),
   'parametre_sene_4_portfoy_maaslari' =>htmlspecialchars($_POST['parametre_sene_4_portfoy_maaslari']),
	 
   'parametre_sene_1_kira' =>htmlspecialchars($_POST['parametre_sene_1_kira']),
   'parametre_sene_2_kira' =>htmlspecialchars($_POST['parametre_sene_2_kira']),
   'parametre_sene_3_kira' =>htmlspecialchars($_POST['parametre_sene_3_kira']),
   'parametre_sene_4_kira' =>htmlspecialchars($_POST['parametre_sene_4_kira'])
	 
	

 ));
	if ( $insert ){
   header("Location: sablon_".$url_id.".php?parametre=guncelle");
 } else {
   header("Location: sablon_".$url_id.".php?durum=basarisiz");
 }
	}
	
	
	
	
	
if (isset($_POST['sablon_ad_guncelle'])) {
     $sablon_ad_guncelle = $db->prepare("UPDATE sablon SET
   sablon_ad = :sablon_ad
  	WHERE sablon_id={$_POST['sablon_id']}");
 $insert = $sablon_ad_guncelle->execute(array(
   "sablon_ad" => ($_POST['sablon_ad'])
 ));
 if ( $insert ){
   header("Location: sablon_".$url_id.".php?ad=guncelle");
 } else {
   header("Location: sablon_".$url_id.".php?durum=basarisiz");
 }


}





if (isset($_POST['sablon_firma_ekle'])) {
	if(!empty($_FILES['firma_dosya']))
	{
	$path = basename( $_FILES['firma_dosya']['name']);
	if(move_uploaded_file($_FILES['firma_dosya']['tmp_name'], "simulasyon_dosya/".$path))
	{
	 $firma_zaman = ''.date("d.m.Y").'  '.date("H:i").'';
     $veri_ekle = $db->prepare("INSERT INTO firma SET
	 firma_sablon_id = :firma_sablon_id,
	 firma_sira = :firma_sira,
	 firma_dosya =:firma_dosya,
	 firma_zaman = :firma_zaman,
	 firma_ad = :firma_ad,
	 firma_sene =:firma_sene,
	 firma_batak =:firma_batak,
	 firma_ihtiyac_tl =:firma_ihtiyac_tl,
	 firma_ihtiyac_usd =:firma_ihtiyac_usd,
	 firma_ihtiyac_tem =:firma_ihtiyac_tem,
	 firma_ihtiyac_itha =:firma_ihtiyac_itha,
	 firma_ihtiyac_forw =:firma_ihtiyac_forw,
	 firma_ihtiyac_ithv =:firma_ihtiyac_ithv,
	 firma_ihtiyac_ihra =:firma_ihtiyac_ihra,
	 firma_ihtiyac_ihrv =:firma_ihtiyac_ihrv,
	 firma_hacim_senet =:firma_hacim_senet,
	 firma_hacim_usd =:firma_hacim_usd,
	 firma_pozisyon_usd =:firma_pozisyon_usd
   
  ");
   
  
 $insert = $veri_ekle->execute(array(
	 'firma_sablon_id' => ($_POST['firma_sablon_id']),
	 'firma_sira' => ($_POST['firma_sira']),
	 'firma_dosya' => ($path),
	 'firma_zaman' => ($firma_zaman),
     'firma_ad' => ($_POST['firma_ad']),
	 'firma_sene' => ($_POST['firma_sene']),
	 'firma_batak' => ($_POST['firma_batak']),
	 'firma_ihtiyac_tl' => str_replace(".", "", $_POST['firma_ihtiyac_tl']),
	 'firma_ihtiyac_usd' => str_replace(".", "", $_POST['firma_ihtiyac_usd']),
	 'firma_ihtiyac_tem' => str_replace(".", "", $_POST['firma_ihtiyac_tem']),
	 'firma_ihtiyac_itha' => str_replace(".", "", $_POST['firma_ihtiyac_itha']),
	 'firma_ihtiyac_forw' => str_replace(".", "", $_POST['firma_ihtiyac_forw']),
	 'firma_ihtiyac_ithv' => str_replace(".", "", $_POST['firma_ihtiyac_ithv']),
	 'firma_ihtiyac_ihra' => str_replace(".", "", $_POST['firma_ihtiyac_ihra']),
	 'firma_ihtiyac_ihrv' => str_replace(".", "", $_POST['firma_ihtiyac_ihrv']),
	 'firma_hacim_senet' => str_replace(".", "", $_POST['firma_hacim_senet']),
	 'firma_hacim_usd' => str_replace(".", "", $_POST['firma_hacim_usd']),
	 'firma_pozisyon_usd' => str_replace(".", "", $_POST['firma_pozisyon_usd']),

 ));
 if ( $insert ){
     header("Location: sablon_".$url_id.".php?firma=eklendi");
 } else {
     header("Location: sablon_".$url_id.".php?durum=basarisiz");
 }
 }else{
 header("Location: sablon_".$url_id.".php?durum=basarisiz");
 }
 }

}
	
	
	

if (isset($_POST['firma_duzenle'])) {
	$firma_sorgu=$db->prepare("SELECT * FROM firma where firma_id=:id");
	$firma_sorgu->execute(array(
		'id' => $_POST['firma_id']
	));
	$firma_duzenle=$firma_sorgu->fetch(PDO::FETCH_ASSOC);
	
} 



	
	
	if (isset($_POST['bulten_guncelle'])) {
     $bulten_guncelle = $db->prepare("UPDATE sablon SET
    bulten_sene_1 = :bulten_sene_1,
	bulten_sene_2 = :bulten_sene_2,
	bulten_sene_3 = :bulten_sene_3,
	bulten_sene_4 = :bulten_sene_4
  	WHERE sablon_id={$_POST['sablon_id']}");
 $insert = $bulten_guncelle->execute(array(
   "bulten_sene_1" => ($_POST['bulten_sene_1']),
   "bulten_sene_2" => ($_POST['bulten_sene_2']),
   "bulten_sene_3" => ($_POST['bulten_sene_3']),
   "bulten_sene_4" => ($_POST['bulten_sene_4'])
 ));
 if ( $insert ){
   header("Location: sablon_".$url_id.".php?bulten=guncelle");
 } else {
   header("Location: sablon_".$url_id.".php?durum=basarisiz");
 }


}
	
?>
 <div id="firma_duzenle_popup" class="overlay">
	<div style="width:70%;" class="popup">
		<h5>Firma Verilerini Düzenle</h5>
		<br>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<form enctype="multipart/form-data" action="process.php" method="POST" class="row g-3">
  
	 <div class="col-md-3">
    <label class="form-label">Firma Adı</label>
    <input type="text" name="firma_ad" class="form-control" value="<?php echo $firma_duzenle['firma_ad']?>" required>
  </div>
	 <div class="col-md-3">
    <label class="form-label">Firma Mali Durum Özeti</label>
    <input class="form-control" style="padding:2.5px;" name="firma_dosya" type="file">
  </div>
  <div class="col-md-2">
    <label for="inputEmail4" class="form-label">Sene</label>
    <select style="width:100%" class="form-control" type="text" name="firma_sene" required>
						<option <?php if($firma_duzenle['firma_sene'] == 1){echo "selected";}else{} ?> value="1">1</option>
						<option <?php if($firma_duzenle['firma_sene'] == 2){echo "selected";}else{} ?> value="2">2</option>
	 				    <option <?php if($firma_duzenle['firma_sene'] == 3){echo "selected";}else{} ?> value="3">3</option>
						<option <?php if($firma_duzenle['firma_sene'] == 4){echo "selected";}else{} ?> value="4">4</option>
	  </select>
  </div>
  <div class="col-md-2">
    <label class="form-label">Firma Sıra</label>
    <input type="text" name="firma_sira" class="form-control" value="<?php echo $firma_duzenle['firma_sira']?>" required>
  </div>			
  <div class="col-md-2">
    <label for="inputPassword4" class="form-label">Durum</label>
    <select style="width:100%" class="form-control" type="text" name="firma_batak" required>
						<option <?php if($firma_duzenle['firma_batak'] == 0){echo "selected";}else{} ?> value="0">İyi Firma</option>
						<option <?php if($firma_duzenle['firma_batak'] == 1){echo "selected";}else{} ?> value="1">Batak</option>
	  </select>
	  
		<br>
  </div>
<div class="col-md-4">
    <label for="inputPassword4" class="form-label">Türk Lirası</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_tl" value="<?php echo $firma_duzenle['firma_ihtiyac_tl']?>">
  </div>
  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Döviz (USD)</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_usd" value="<?php echo $firma_duzenle['firma_ihtiyac_usd']?>">
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Teminat Mektubu</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_tem" value="<?php echo $firma_duzenle['firma_ihtiyac_tem']?>">
	  
		<br>
  </div>
<div class="col-md-4">
    <label for="inputPassword4" class="form-label">İthalat Akreditifi</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_itha" value="<?php echo $firma_duzenle['firma_ihtiyac_itha']?>">
  </div>
  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Forward</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_forw" value="<?php echo $firma_duzenle['firma_ihtiyac_forw']?>">
	</div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">İthalat Vesaiki</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_ithv" value="<?php echo $firma_duzenle['firma_ihtiyac_ithv']?>">
	  
		<br>
  </div>
											
	 <div class="col-md-4">
    <label for="inputPassword4" class="form-label">İhracat Akreditifi</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_ihra" value="<?php echo $firma_duzenle['firma_ihtiyac_ihra']?>">
  </div>
	<div class="col-md-4">
    <label for="inputEmail4" class="form-label">İhracat Tahsil Vesaiki</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_ihtiyac_ihrv" value="<?php echo $firma_duzenle['firma_ihtiyac_ihrv']?>">
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Çek Senet Tahsil Hacmi</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_hacim_senet" value="<?php echo $firma_duzenle['firma_hacim_senet']?>">
	  <br>
  </div>
	 <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Döviz (USD) İşlem Hacmi</label>
   <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_hacim_usd" value="<?php echo $firma_duzenle['firma_hacim_usd']?>">
  </div>
	<div class="col-md-6">
    <label for="inputPassword4" class="form-label">Döviz (USD) Pozisyonu</label>
    <input style="width:100%" type="text" class="user_input form-control number-separator" name="firma_pozisyon_usd" value="<?php echo $firma_duzenle['firma_pozisyon_usd']?>">
  </div>
  
  <div class="col-12">
	  <br>
   <input type="hidden" name="firma_id" value="<?php echo $firma_duzenle['firma_id']; ?>">
	<input type="hidden" name="post_url_id" value="<?php echo $url_id; ?>">
	  <input type="hidden" name="firma_sablon_id" value="<?php echo $sablon_kimlik; ?>">
											<div style="width:100%;text-align:center;">
				<button class="btn btn-primary" style="text-align:center;"type="submit" name="sablon_firma_duzenle">Firma Verilerini Güncelle</button>
												
												
												
											</div>
	  
	  
	  
  </div>
  
</form>
			<form class="mx-1" action="process.php" method="POST" onSubmit="return confirm('Bu veriyi silmek istediğinizden emin misiniz ?');">
                 <input type="hidden" name="firma_id" value="<?php echo $firma_duzenle['firma_id']; ?>">
				<input type="hidden" name="post_url_id" value="<?php echo $url_id; ?>">
			  <input type="hidden" name="firma_sablon_id" value="<?php echo $sablon_kimlik; ?>">
                                                                   
                                                                    <button type="submit" name="sablon_firma_sil" class="btn btn-danger btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Sil
                                                                    </span>
                                                                    </button>
                                                                </form>
		</div>
	</div>
</div>



<div style="background-color:#D4DCE6;"class="col-12">
<br>
<br>
<h4 style="color:#FF6501;text-align:center;" class="mb-3">
	<div style="margin:auto;width:500px;">
	Şablon Tasarla
	</div>
</h4>
	
	<div style="text-align:center;margin:auto;width:500px;">
		<?php 
											
				if ($_GET['durum']=="basarili") {?>

				<div style="width:100%;"class="alert alert-success">
					<strong>Başarılı !</strong> İşlem başarıyla tamamlandı.
				</div>
					
				<?php } elseif ($_GET['firma']=="eklendi") {?>

				<div style="width:100%;" class="alert alert-success">
					<strong>Başarılı !</strong> Şablon, firma bilgileri güncellendi.
				</div>
					
				<?php } elseif ($_GET['firma']=="sil") { ?>
					<div style="width:100%;" class="alert alert-warning">
					<strong>Başarılı !</strong> Firma silindi .
				</div>
				<?php }elseif ($_GET['durum']=="basarisiz") { ?>
				<div style="width:100%;" class="alert alert-danger">
					<strong>Hata!</strong> Bir sorun var, Bora Özçağlar ile iletişime geçiniz.
				</div>
				<?php } elseif ($_GET['firma']=="ad") { ?>
						<div style="width:100%;" class="alert alert-danger">
							<strong>Hata!</strong> Bir sorun var, Bora Özçağlar ile iletişime geçiniz.
						</div>

				<?php } elseif ($_GET['parametre']=="guncelle") { ?>
						<div style="width:100%;" class="alert alert-success">
							<strong>Başarılı !</strong> Parametreler Güncellendi.
						</div>
		
				<?php  }elseif($_GET['ad']=="guncelle") {  ?>
					<div style="width:100%;" class="alert alert-success">
							<strong>Başarılı !</strong> Şablon adı güncellendi.
						</div>
		
		<?php }elseif($_GET['bulten']=="guncelle") {  ?>
					<div style="width:100%;" class="alert alert-success">
							<strong>Başarılı !</strong> Bülten güncellendi.
						</div> 
		<?php } ?>
		
						   <form enctype="multipart/form-data" action="" method="POST">	
							 <input type="text" class="form-control" name="sablon_ad" value="<?php echo $sablon_exe['sablon_ad'];?>">
							   <input type="hidden" name="sablon_id" value="<?php echo $sablon_kimlik; ?>">
							   <br>
							   <button style="text-align:center;" name="sablon_ad_guncelle" class="btn btn-light">Şablon Adını Güncelle</button>
							   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Firma Ekle
</button>		
							  <br>
	</form>
	</div>
	<br>
	<br>
	

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style="max-width:1000px;width:100%;" class="modal-dialog">
    <div style="height:80vh;overflow-y:auto;"class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Firma Ekle</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">✖</button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="" method="POST" class="row g-3">
  
	 <div class="col-md-3">
    <label class="form-label">Firma Adı</label>
    <input type="text" name="firma_ad" class="form-control" required>
  </div>
	 <div class="col-md-3">
    <label class="form-label">Firma Mali Durum Özeti</label>
    <input class="form-control" style="padding:2.5px;" name="firma_dosya" type="file" required>
  </div>
  <div class="col-md-2">
    <label for="inputEmail4" class="form-label">Sene</label>
    <select style="width:100%" class="form-control" type="text" name="firma_sene" required>
						<option value="1">1</option>
						<option value="2">2</option>
	 				    <option value="3">3</option>
						<option value="4">4</option>
	  </select>
  </div>
<div class="col-md-2">
    <label class="form-label">Firma Sıra</label>
    <input type="text" name="firma_sira" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label for="inputPassword4" class="form-label">Durum</label>
    <select style="width:100%" class="form-control" type="text" name="firma_batak" required>
						<option value="0">İyi Firma</option>
						<option value="1">Batak</option>
	  </select>
	  
		<br>
  </div>
<div class="col-md-4">
    <label for="inputPassword4" class="form-label">Türk Lirası</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_tl" value="">
  </div>
  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Döviz (USD)</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_usd" value="">
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Teminat Mektubu</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_tem" value="">
	  
		<br>
  </div>
<div class="col-md-4">
    <label for="inputPassword4" class="form-label">İthalat Akreditifi</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_itha" value="">
  </div>
  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Forward</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_forw" value="">
	</div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">İthalat Vesaiki</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_ithv" value="">
	  
		<br>
  </div>
											
	 <div class="col-md-4">
    <label for="inputPassword4" class="form-label">İhracat Akreditifi</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_ihra" value="">
  </div>
	<div class="col-md-4">
    <label for="inputEmail4" class="form-label">İhracat Tahsil Vesaiki</label>
    <input style="width:100%" type="text" class="form-control" name="firma_ihtiyac_ihrv" value="">
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Çek Senet Tahsil Hacmi</label>
    <input style="width:100%" type="text" class="form-control" name="firma_hacim_senet" value="">
	  <br>
  </div>
	 <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Döviz (USD) İşlem Hacmi</label>
   <input style="width:100%" type="text" class="form-control" name="firma_hacim_usd" value="">
  </div>
	<div class="col-md-6">
    <label for="inputPassword4" class="form-label">Döviz (USD) Pozisyonu</label>
    <input style="width:100%" type="text" class="form-control" name="firma_pozisyon_usd" value="">
  </div>
  
  <div class="col-12">
	  <br>
   <input type="hidden" name="firma_sablon_id" value="<?php echo $sablon_kimlik; ?>">
											<div style="width:100%;text-align:center;">
				<button class="btn btn-primary" style="text-align:center;"type="submit" name="sablon_firma_ekle">Firma Ekle</button>
											</div>
  </div>
  
</form>
      </div>
    </div>
  </div>
</div>

							    <div class="row">
									<div class="row justify-content-between">
								
                                    <div style="padding-left:20px;padding-right:20px;" class="col-lg-12">
									
										<h4 style="color:#26354A;text-align:center;" class="mb-3">1. Senenin Firmaları</h4>
										<hr>
											<div class="table-responsive"> 
											<table class="table-bordered table">
  
												
												<thead class="thead-light ">
    <tr>
		<th scope="col">Firma Adı</th>
      <th style="text-align:center;width:40px;" scope="col">Durum</th>
      <th style="text-align:center;" scope="col">Türk Lirası</th>
      <th style="text-align:center;" scope="col">Döviz (USD)</th>
	  <th style="text-align:center;"  scope="col">Teminat M.</th>
		<th style="text-align:center;" scope="col">İthalat Akr.</th>
	<th style="text-align:center;" scope="col">Forward</th>
      <th style="text-align:center;" scope="col">İthalat V.</th>
      <th style="text-align:center;" scope="col">İhracat Akr.</th>
	  <th style="text-align:center;"  scope="col">İhracat Tahsil V.</th>
		<th style="text-align:center;" scope="col">Senet Hacim</th>
	  <th style="text-align:center;"  scope="col">USD Hacim</th>
		<th style="text-align:center;" scope="col">USD Pozisyon</th>
		<th style="text-align:center;" scope="col">İşlemler</th>
		
	 
    </tr>
  </thead>
												
  <tbody style="background-color:white;">
	  <?php
					$firma_liste_id=1;
					$firma_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sablon_id='".$sablon_kimlik."' AND firma_sene=1 ORDER BY firma_sira ASC");
					$firma_sorgu->execute();
					while ($firma=$firma_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_liste_id++; ?>	
	  
	  <tr>
      <th style="padding-top:11px; width:240px;"class="th_width"><?php echo $firma['firma_ad'] ?></th>
      <td style="width:100px;"><?php if($firma['firma_batak'] == 1) {echo "Batak";}elseif($firma['firma_batak'] == 0){echo "İyi Firma";} ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_tl'] , 0, ',', '.');?></td>
		  
	  <td><?php echo number_format($firma['firma_ihtiyac_usd'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_tem'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_itha'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_forw'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_ithv'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_ihra'] , 0, ',', '.'); ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_ihrv'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_senet'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_usd'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_pozisyon_usd'] , 0, ',', '.'); ?></td>
		  	 <td>
			<div class="d-flex">
													 
                                                                <form class="mx-1" action="#firma_duzenle_popup" method="POST">
                                                                    <input type="hidden" name="firma_id" value="<?php echo $firma['firma_id']; ?>">
                                                                   
                                                                    <button type="submit" name="firma_duzenle" class="btn btn-warning btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Düzenle
                                                                    </span>
                                                                    </button>
                                                                </form>
                                                            </div>
		</td> 
		  
    </tr>
	  
	  
	  
	  <?php } ?>
    
	  
  </tbody>
												
</table>
											</div>

										
										
										
										<br>
										<br>
										<br>
										<h4 style="color:#26354A;text-align:center;" class="mb-3">2. Senenin Firmaları</h4>
										<hr>
											<div class="table-responsive"> 
											<table class="table-bordered table">
  
												
												<thead class="thead-light ">
    <tr>
		<th scope="col">Firma Adı</th>
      <th style="text-align:center;width:40px;" scope="col">Durum</th>
      <th style="text-align:center;" scope="col">Türk Lirası</th>
      <th style="text-align:center;" scope="col">Döviz (USD)</th>
	  <th style="text-align:center;"  scope="col">Teminat M.</th>
		<th style="text-align:center;" scope="col">İthalat Akr.</th>
	<th style="text-align:center;" scope="col">Forward</th>
      <th style="text-align:center;" scope="col">İthalat V.</th>
      <th style="text-align:center;" scope="col">İhracat Akr.</th>
	  <th style="text-align:center;"  scope="col">İhracat Tahsil V.</th>
		<th style="text-align:center;" scope="col">Senet Hacim</th>
	  <th style="text-align:center;"  scope="col">USD Hacim</th>
		<th style="text-align:center;" scope="col">USD Pozisyon</th>
		<th style="text-align:center;" scope="col">İşlemler</th>
	 
    </tr>
  </thead>
												
  <tbody style="background-color:white;">
	  <?php
					$firma_liste_id=1;
					$firma_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sablon_id='".$sablon_kimlik."' AND firma_sene=2 ORDER BY firma_sira ASC");
					$firma_sorgu->execute();
					while ($firma=$firma_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_liste_id++; ?>	
	  
	  <tr>
      <th style="padding-top:11px; width:240px;"class="th_width"><?php echo $firma['firma_ad'] ?></th>
      <td style="width:100px;"><?php if($firma['firma_batak'] == 1) {echo "Batak";}elseif($firma['firma_batak'] == 0){echo "İyi Firma";} ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_tl'] , 0, ',', '.');?></td>
		  
	  <td><?php echo number_format($firma['firma_ihtiyac_usd'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_tem'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_itha'] , 0, ',', '.'); ?></td>
		 <td><?php echo number_format($firma['firma_ihtiyac_forw'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_ithv'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_ihra'] , 0, ',', '.'); ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_ihrv'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_senet'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_usd'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_pozisyon_usd'] , 0, ',', '.'); ?></td>
		  
		  <td>
			<div class="d-flex">
													 
                                                                <form class="mx-1" action="#firma_duzenle_popup" method="POST">
                                                                    <input type="hidden" name="firma_id" value="<?php echo $firma['firma_id']; ?>">
                                                                   
                                                                    <button type="submit" name="firma_duzenle" class="btn btn-warning btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Düzenle
                                                                    </span>
                                                                    </button>
                                                                </form>
                                                            </div>
		</td> 
    </tr>
	  
	  
	  
	  <?php } ?>
    
	  
  </tbody>
												
</table>
											</div>
										
										<br>
										<br>
										<br>
										<h4 style="color:#26354A;text-align:center;" class="mb-3">3. Senenin Firmaları</h4>
										<hr>
											<div class="table-responsive"> 
											<table class="table-bordered table">
  
												
												<thead class="thead-light ">
    <tr>
		<th scope="col">Firma Adı</th>
      <th style="text-align:center;width:40px;" scope="col">Durum</th>
      <th style="text-align:center;" scope="col">Türk Lirası</th>
      <th style="text-align:center;" scope="col">Döviz (USD)</th>
	  <th style="text-align:center;"  scope="col">Teminat M.</th>
		<th style="text-align:center;" scope="col">İthalat Akr.</th>
	<th style="text-align:center;" scope="col">Forward</th>
      <th style="text-align:center;" scope="col">İthalat V.</th>
      <th style="text-align:center;" scope="col">İhracat Akr.</th>
	  <th style="text-align:center;"  scope="col">İhracat Tahsil V.</th>
		<th style="text-align:center;" scope="col">Senet Hacim</th>
	  <th style="text-align:center;"  scope="col">USD Hacim</th>
		<th style="text-align:center;" scope="col">USD Pozisyon</th>
		<th style="text-align:center;" scope="col">İşlemler</th>
	 
    </tr>
  </thead>
												
  <tbody style="background-color:white;">
	  <?php
					$firma_liste_id=1;
					$firma_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sablon_id='".$sablon_kimlik."' AND firma_sene=3 ORDER BY firma_sira ASC");
					$firma_sorgu->execute();
					while ($firma=$firma_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_liste_id++; ?>	
	  
	  <tr>
      <th style="padding-top:11px; width:240px;"class="th_width"><?php echo $firma['firma_ad'] ?></th>
      <td style="width:100px;"><?php if($firma['firma_batak'] == 1) {echo "Batak";}elseif($firma['firma_batak'] == 0){echo "İyi Firma";} ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_tl'] , 0, ',', '.');?></td>
		  
	  <td><?php echo number_format($firma['firma_ihtiyac_usd'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_tem'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_itha'] , 0, ',', '.'); ?></td>
		  <td><?php echo number_format($firma['firma_ihtiyac_forw'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_ithv'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_ihra'] , 0, ',', '.'); ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_ihrv'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_senet'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_usd'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_pozisyon_usd'] , 0, ',', '.'); ?></td>
		  
		 <td>
			<div class="d-flex">
													 
                                                                <form class="mx-1" action="#firma_duzenle_popup" method="POST">
                                                                    <input type="hidden" name="firma_id" value="<?php echo $firma['firma_id']; ?>">
                                                                   
                                                                    <button type="submit" name="firma_duzenle" class="btn btn-warning btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Düzenle
                                                                    </span>
                                                                    </button>
                                                                </form>
                                                            </div>
		</td> 
    </tr>
	  
	  
	  
	  <?php } ?>
    
	  
  </tbody>
												
</table>
											</div>
										
										<br>
										<br>
										<br>
										<h4 style="color:#26354A;text-align:center;" class="mb-3">4. Senenin Firmaları</h4>
										<hr>
											<div class="table-responsive"> 
											<table class="table-bordered table">
  
												
												<thead class="thead-light ">
    <tr>
		<th scope="col">Firma Adı</th>
      <th style="text-align:center;width:40px;" scope="col">Durum</th>
      <th style="text-align:center;" scope="col">Türk Lirası</th>
      <th style="text-align:center;" scope="col">Döviz (USD)</th>
	  <th style="text-align:center;"  scope="col">Teminat M.</th>
		<th style="text-align:center;" scope="col">İthalat Akr.</th>
	<th style="text-align:center;" scope="col">Forward</th>
      <th style="text-align:center;" scope="col">İthalat V.</th>
      <th style="text-align:center;" scope="col">İhracat Akr.</th>
	  <th style="text-align:center;"  scope="col">İhracat Tahsil V.</th>
		<th style="text-align:center;" scope="col">Senet Hacim</th>
	  <th style="text-align:center;"  scope="col">USD Hacim</th>
		<th style="text-align:center;" scope="col">USD Pozisyon</th>
		<th style="text-align:center;" scope="col">İşemler</th>
	 
    </tr>
  </thead>
												
  <tbody style="background-color:white;">
	  <?php
					$firma_liste_id=1;
					$firma_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sablon_id='".$sablon_kimlik."' AND firma_sene=4 ORDER BY firma_sira ASC");
					$firma_sorgu->execute();
					while ($firma=$firma_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_liste_id++; ?>	
	  
	  <tr>
      <th style="padding-top:11px; width:240px;"class="th_width"><?php echo $firma['firma_ad'] ?></th>
      <td style="width:100px;"><?php if($firma['firma_batak'] == 1) {echo "Batak";}elseif($firma['firma_batak'] == 0){echo "İyi Firma";} ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_tl'] , 0, ',', '.');?></td>
		  
	  <td><?php echo number_format($firma['firma_ihtiyac_usd'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_tem'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_itha'] , 0, ',', '.'); ?></td>
		  <td><?php echo number_format($firma['firma_ihtiyac_forw'] , 0, ',', '.'); ?></td>
	  <td><?php echo number_format($firma['firma_ihtiyac_ithv'] , 0, ',', '.'); ?></td>
		  
      <td><?php echo number_format($firma['firma_ihtiyac_ihra'] , 0, ',', '.'); ?></td>
      <td><?php echo number_format($firma['firma_ihtiyac_ihrv'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_senet'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_hacim_usd'] , 0, ',', '.'); ?></td>
		     <td><?php echo number_format($firma['firma_pozisyon_usd'] , 0, ',', '.'); ?></td>
		  
		
		  
		  <td>
			<div class="d-flex">
													 
                                                                <form class="mx-1" action="#firma_duzenle_popup" method="POST">
                                                                    <input type="hidden" name="firma_id" value="<?php echo $firma['firma_id']; ?>">
                                                                   
                                                                    <button type="submit" name="firma_duzenle" class="btn btn-warning btn-sm btn-icon-split">
                                                                    <span class="icon text-white-60">
                                                                        Düzenle
                                                                    </span>
                                                                    </button>
                                                                </form>
                                                            </div>
		</td> 
    </tr>
	  
	  
	  
	  <?php } ?>
    
	  
  </tbody>
												
</table>
											</div>
										</div>
										
								
											<div style="padding:40px;"class="col-12">
                                       <form enctype="multipart/form-data" action="" method="POST">
			
 <br>
										  

	 <h4 style="color:#26354A;text-align:center;" class="mb-3">Parametreler</h4>
										<hr>
											<table class="table-bordered table">
  <thead class="thead-dark ">
    <tr>
      <th scope="col">Parametre Adı:</th>
      <th style="text-align:center;" colspan="2" scope="col">I.Sene</th>
      <th style="text-align:center;" colspan="2" scope="col">II.Sene</th>
      <th style="text-align:center;" colspan="2" scope="col">III.Sene</th>
	  <th style="text-align:center;" colspan="2" scope="col">IV.Sene</th>
    </tr>
  </thead>
												
												<thead class="thead-light ">
    <tr>
		<th scope="col"></th>
      <th style="text-align:center;" scope="col">Sene Başı</th>
      <th style="text-align:center;" scope="col">Sene Sonu</th>
      <th style="text-align:center;" scope="col">Sene Başı</th>
	  <th style="text-align:center;"  scope="col">Sene Sonu</th>
		<th style="text-align:center;" scope="col">Sene Başı</th>
      <th style="text-align:center;" scope="col">Sene Sonu</th>
      <th style="text-align:center;" scope="col">Sene Başı</th>
	  <th style="text-align:center;"  scope="col">Sene Sonu</th>
    </tr>
  </thead>
												
  <tbody style="background-color:white;">
	  
	  <tr>
      <th style="padding-top:11px;"class="th_width">Türk Lirası Şubeler Cari Faiz Oranı %</th>
      <td><input style="width:100%" type="text" name="parametre_sene_1_faiz_tl_bas" value="<?php echo $sablon_exe["parametre_sene_1_faiz_tl_bas"]?>"></td>
      <td><input style="width:100%" type="text" name="parametre_sene_1_faiz_tl_son" value="<?php echo $sablon_exe["parametre_sene_1_faiz_tl_son"]?>"></td>
		  
	  <td><input style="width:100%" type="text" name="parametre_sene_2_faiz_tl_bas" value="<?php echo $sablon_exe["parametre_sene_2_faiz_tl_bas"]?>" ></td>
	  <td><input style="width:100%" type="text" name="parametre_sene_2_faiz_tl_son" value="<?php echo $sablon_exe["parametre_sene_2_faiz_tl_son"]?>" ></td>
		  
      <td><input style="width:100%" type="text" name="parametre_sene_3_faiz_tl_bas" value="<?php echo $sablon_exe["parametre_sene_3_faiz_tl_bas"]?>" ></td>
	  <td><input style="width:100%" type="text" name="parametre_sene_3_faiz_tl_son" value="<?php echo $sablon_exe["parametre_sene_3_faiz_tl_son"]?>"></td>
		  
      <td><input style="width:100%" type="text" name="parametre_sene_4_faiz_tl_bas" value="<?php echo $sablon_exe["parametre_sene_4_faiz_tl_bas"]?>"></td>
      <td><input style="width:100%" type="text" name="parametre_sene_4_faiz_tl_son" value="<?php echo $sablon_exe["parametre_sene_4_faiz_tl_son"]?>"></td>
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Döviz Şubeler Cari Faiz Ortalaması %</th>
      <td><input style="width:100%" type="text" name="parametre_sene_1_faiz_usd_bas" value="<?php echo $sablon_exe['parametre_sene_1_faiz_usd_bas'] ?>"></td>
      <td><input style="width:100%" type="text" name="parametre_sene_1_faiz_usd_son" value="<?php echo $sablon_exe["parametre_sene_1_faiz_usd_son"]?>"></td>
		  
	  <td><input style="width:100%" type="text" name="parametre_sene_2_faiz_usd_bas" value="<?php echo $sablon_exe["parametre_sene_2_faiz_usd_bas"]?>"></td>
	  <td><input style="width:100%" type="text" name="parametre_sene_2_faiz_usd_son" value="<?php echo $sablon_exe["parametre_sene_2_faiz_usd_son"]?>"></td>
		  
      <td><input style="width:100%" type="text" name="parametre_sene_3_faiz_usd_bas" value="<?php echo $sablon_exe["parametre_sene_3_faiz_usd_bas"]?>"></td>
	  <td><input style="width:100%" type="text" name="parametre_sene_3_faiz_usd_son" value="<?php echo $sablon_exe["parametre_sene_3_faiz_usd_son"]?>"></td>
		  
      <td><input style="width:100%" type="text" name="parametre_sene_4_faiz_usd_bas" value="<?php echo $sablon_exe["parametre_sene_4_faiz_usd_bas"]?>"></td>
      <td><input style="width:100%" type="text" name="parametre_sene_4_faiz_usd_son" value="<?php echo $sablon_exe["parametre_sene_4_faiz_usd_son"]?>"></td>
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">USD/TRY Döviz Kurları</th>
      <td><input style="width:100%" type="text" name="parametre_sene_1_kur_bas" value="<?php echo $sablon_exe["parametre_sene_1_kur_bas"]?>"></td>
      <td><input style="width:100%" type="text" name="parametre_sene_1_kur_son" value="<?php echo $sablon_exe["parametre_sene_1_kur_son"]?>"></td>
		  
	  <td><input style="width:100%" type="text" name="parametre_sene_2_kur_bas" value="<?php echo $sablon_exe["parametre_sene_2_kur_bas"]?>"></td>
	  <td><input style="width:100%" type="text" name="parametre_sene_2_kur_son" value="<?php echo $sablon_exe["parametre_sene_2_kur_son"]?>"></td>      
		  
      <td><input style="width:100%" type="text" name="parametre_sene_3_kur_bas" value="<?php echo $sablon_exe["parametre_sene_3_kur_bas"]?>"></td>
	  <td><input style="width:100%" type="text" name="parametre_sene_3_kur_son" value="<?php echo $sablon_exe["parametre_sene_3_kur_son"]?>"></td>	  
		  
      <td><input style="width:100%" type="text" name="parametre_sene_4_kur_bas" value="<?php echo $sablon_exe["parametre_sene_4_kur_bas"]?>"></td>
      <td><input style="width:100%" type="text" name="parametre_sene_4_kur_son" value="<?php echo $sablon_exe["parametre_sene_4_kur_son"]?>"></td>
	 
    </tr>
	   <tr>
      <th style="padding-top:11px;"class="th_width">Döviz Alım Satım Kambiyo Kârı Spread'i</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_spread_alsat" value="<?php echo $sablon_exe["parametre_sene_1_spread_alsat"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_spread_alsat" value="<?php echo $sablon_exe["parametre_sene_2_spread_alsat"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_spread_alsat" value="<?php echo $sablon_exe["parametre_sene_3_spread_alsat"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_spread_alsat" value="<?php echo $sablon_exe["parametre_sene_4_spread_alsat"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Vadeli TL Mevduat Faiz Spread'i</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_spread_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_1_spread_faiz_tl"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_spread_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_2_spread_faiz_tl"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_spread_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_3_spread_faiz_tl"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_spread_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_4_spread_faiz_tl"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Vadeli USD Mevduat Faiz Spread'i</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_spread_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_1_spread_faiz_usd"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_spread_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_2_spread_faiz_usd"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_spread_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_3_spread_faiz_usd"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_spread_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_4_spread_faiz_usd"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">İthalat Tahsil Vesaiki Komisyon Oranı</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_komisyon_ithv" value="<?php echo $sablon_exe["parametre_sene_1_komisyon_ithv"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_komisyon_ithv" value="<?php echo $sablon_exe["parametre_sene_2_komisyon_ithv"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_komisyon_ithv" value="<?php echo $sablon_exe["parametre_sene_3_komisyon_ithv"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_komisyon_ithv" value="<?php echo $sablon_exe["parametre_sene_4_komisyon_ithv"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">İhracat Tahsil Vesaiki Komisyon Oranı</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_komisyon_ihrv" value="<?php echo $sablon_exe["parametre_sene_1_komisyon_ihrv"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_komisyon_ihrv" value="<?php echo $sablon_exe["parametre_sene_2_komisyon_ihrv"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_komisyon_ihrv" value="<?php echo $sablon_exe["parametre_sene_3_komisyon_ihrv"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_komisyon_ihrv" value="<?php echo $sablon_exe["parametre_sene_4_komisyon_ihrv"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">İhracat Akreditifi İhbar Komisyonu</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_komisyon_ihra_ihbar" value="<?php echo $sablon_exe["parametre_sene_1_komisyon_ihra_ihbar"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_komisyon_ihra_ihbar" value="<?php echo $sablon_exe["parametre_sene_2_komisyon_ihra_ihbar"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_komisyon_ihra_ihbar" value="<?php echo $sablon_exe["parametre_sene_3_komisyon_ihra_ihbar"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_komisyon_ihra_ihbar" value="<?php echo $sablon_exe["parametre_sene_4_komisyon_ihra_ihbar"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">İhracat Akreditifi Teyit Komisyonu<br> (İhracat L/C yarısı teyitli)</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_komisyon_ihra_teyit" value="<?php echo $sablon_exe["parametre_sene_1_komisyon_ihra_teyit"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_komisyon_ihra_teyit" value="<?php echo $sablon_exe["parametre_sene_2_komisyon_ihra_teyit"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_komisyon_ihra_teyit" value="<?php echo $sablon_exe["parametre_sene_3_komisyon_ihra_teyit"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_komisyon_ihra_teyit" value="<?php echo $sablon_exe["parametre_sene_4_komisyon_ihra_teyit"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Çek Senet Tahsil Komisyonu Oranı</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_komisyon_senet" value="<?php echo $sablon_exe["parametre_sene_1_komisyon_senet"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_komisyon_senet" value="<?php echo $sablon_exe["parametre_sene_2_komisyon_senet"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_komisyon_senet" value="<?php echo $sablon_exe["parametre_sene_3_komisyon_senet"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_komisyon_senet" value="<?php echo $sablon_exe["parametre_sene_4_komisyon_senet"]?>"></td>
	
    </tr>
	  
	  <tr>
      <th style="padding-top:11px;"class="th_width">Simülasyon Bankası<br> TL  Faizi Nakdi Kredi %</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_simbank_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_1_simbank_faiz_tl"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_simbank_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_2_simbank_faiz_tl"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_simbank_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_3_simbank_faiz_tl"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_simbank_faiz_tl" value="<?php echo $sablon_exe["parametre_sene_4_simbank_faiz_tl"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Simülasyon Bankası<br> USD Faizi Nakdi Kredi %</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_simbank_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_1_simbank_faiz_usd"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_simbank_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_2_simbank_faiz_usd"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_simbank_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_3_simbank_faiz_usd"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_simbank_faiz_usd" value="<?php echo $sablon_exe["parametre_sene_4_simbank_faiz_usd"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Simülasyon Bankası<br> İthalat Akreditifi Komisyon Oranı %</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_simbank_komisyon_itha" value="<?php echo $sablon_exe["parametre_sene_1_simbank_komisyon_itha"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_simbank_komisyon_itha" value="<?php echo $sablon_exe["parametre_sene_2_simbank_komisyon_itha"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_simbank_komisyon_itha" value="<?php echo $sablon_exe["parametre_sene_3_simbank_komisyon_itha"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_simbank_komisyon_itha" value="<?php echo $sablon_exe["parametre_sene_4_simbank_komisyon_itha"]?>"></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Simülasyon Bankası<br> Teminat Mektubu Komisyon Oranı %</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_simbank_komisyon_tem" value="<?php echo $sablon_exe["parametre_sene_1_simbank_komisyon_tem"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_simbank_komisyon_tem" value="<?php echo $sablon_exe["parametre_sene_2_simbank_komisyon_tem"]?>"></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_simbank_komisyon_tem" value="<?php echo $sablon_exe["parametre_sene_3_simbank_komisyon_tem"]?>"></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_simbank_komisyon_tem" value="<?php echo $sablon_exe["parametre_sene_4_simbank_komisyon_tem"]?>"></td>
	
    </tr>
	   <tr>
      <th style="padding-top:11px;"class="th_width">Simülasyon Bankası<br> Forward Kur Kotasyon Spread'i %</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_simbank_spread_forw" value="<?php echo $sablon_exe["parametre_sene_1_simbank_spread_forw"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_simbank_spread_forw" value="<?php echo $sablon_exe["parametre_sene_2_simbank_spread_forw"]?>" ></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_simbank_spread_forw" value="<?php echo $sablon_exe["parametre_sene_3_simbank_spread_forw"]?>" ></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_simbank_spread_forw" value="<?php echo $sablon_exe["parametre_sene_4_simbank_spread_forw"]?>" ></td>
	
    </tr>
	  
	 
	  <tr>	   
      <th style="padding-top:11px;"class="th_width">Kasa</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_kasa" value="<?php echo $sablon_exe["parametre_sene_1_kasa"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_kasa" value="<?php echo $sablon_exe["parametre_sene_2_kasa"]?>" ></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_kasa" value="<?php echo $sablon_exe["parametre_sene_3_kasa"]?>" ></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_kasa" value="<?php echo $sablon_exe["parametre_sene_4_kasa"]?>" ></td>
	
    </tr>
	  <tr>	   
      <th style="padding-top:11px;"class="th_width">Portföy Çalışan Maaşları</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_portfoy_maaslari" value="<?php echo $sablon_exe["parametre_sene_1_portfoy_maaslari"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_portfoy_maaslari" value="<?php echo $sablon_exe["parametre_sene_2_portfoy_maaslari"]?>" ></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_portfoy_maaslari" value="<?php echo $sablon_exe["parametre_sene_3_portfoy_maaslari"]?>" ></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_portfoy_maaslari" value="<?php echo $sablon_exe["parametre_sene_4_portfoy_maaslari"]?>" ></td>
	
    </tr>
	  <tr>	   
      <th style="padding-top:11px;"class="th_width">Şube Binası Kira</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_kira" value="<?php echo $sablon_exe["parametre_sene_1_kira"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_kira" value="<?php echo $sablon_exe["parametre_sene_2_kira"]?>" ></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_kira" value="<?php echo $sablon_exe["parametre_sene_3_kira"]?>" ></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_kira" value="<?php echo $sablon_exe["parametre_sene_4_kira"]?>" ></td>
	
    </tr>
	  <tr>
      <th style="padding-top:11px;"class="th_width">Teklif Üst Limit</th>
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_1_ust_limit" value="<?php echo $sablon_exe["parametre_sene_1_ust_limit"]?>"></td>
		  
	  <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_2_ust_limit" value="<?php echo $sablon_exe["parametre_sene_2_ust_limit"]?>" ></td>
     		  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_3_ust_limit" value="<?php echo $sablon_exe["parametre_sene_3_ust_limit"]?>" ></td>
	  	  
      <td colspan="2"><input style="width:100%" type="text" name="parametre_sene_4_ust_limit" value="<?php echo $sablon_exe["parametre_sene_4_ust_limit"]?>" ></td>
	
    </tr>
	  
	  
	  
	  
    
	  
  </tbody>
</table>
<br>
<br>
										
	 <input style="width:100%" type="hidden" name="sablon_id" value="<?php echo $sablon_exe['sablon_id'];?>">
	 
	 <div style="text-align:center;">
		
				<input class="ide_button" type="submit" name="sablon_duzenle" value="Parametreleri Güncelle">
	 </div>
	</form>
										
			
									
										<br>
										<br>
										<br>
		
												
<form enctype="multipart/form-data" action="" method="POST">
										<h4 style="color:#26354A;text-align:center;" class="mb-3">Bülten</h4>
										<hr>
<div class="form-group">
	<label for="exampleFormControlTextarea1"><strong style="font-size:17px;">1. Sene Bülten</strong></label>
						<textarea name="bulten_sene_1" id="editor1" name="bulten_sene_1"><?php echo $sablon_exe['bulten_sene_1']; ?> </textarea>
  </div>		
<div class="form-group">
    <label for="exampleFormControlTextarea1"><strong style="font-size:17px;">2. Sene Bülten</strong></label>
						<textarea name="bulten_sene_2" id="editor2"><?php echo $sablon_exe['bulten_sene_2']; ?> </textarea>
  </div>		
<div class="form-group">
    <label for="exampleFormControlTextarea1"><strong style="font-size:17px;">3. Sene Bülten</strong></label>
						<textarea name="bulten_sene_3" id="editor3"><?php echo $sablon_exe['bulten_sene_3']; ?> </textarea>
  </div>		
<div class="form-group">
    <label for="exampleFormControlTextarea1"><strong style="font-size:17px;">4. Sene Bülten</strong></label>
						<textarea name="bulten_sene_4" id="editor4"><?php echo $sablon_exe['bulten_sene_4']; ?> </textarea>
  </div>		
										
										
	 <input style="width:100%" type="hidden" name="sablon_id" value="<?php echo $sablon_exe['sablon_id'];?>">
	 
	 <div style="text-align:center;">
		
				<input class="ide_button" type="submit" name="bulten_guncelle" value="Bülten Güncelle">
	 </div>
	</form>
	 <hr>
												


										
                                    </div>
									
									
	</div>
                                </div>
	   
			
                    
                </div>

	
 
					
                    </div>

        <?php include "footer.php"; ?>
<?php } else{
	header('location:simulasyon_anasayfa.php?hata=girisyapilmadi');
}
?>
<?php ob_end_flush() ?>

