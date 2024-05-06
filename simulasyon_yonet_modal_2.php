<?php 
$iyi_toplam_tl_kredi = 0;
$iyi_toplam_usd_kredi = 0;
$iyi_toplam_tem_kredi = 0;	
$iyi_toplam_itha_kredi = 0;	
$iyi_toplam_forw_kredi = 0;	
$iyi_tl_kredi_geliri = 0;
$iyi_usd_kredi_geliri = 0;
$iyi_tem_kredi_geliri = 0;
$iyi_itha_kredi_geliri = 0;
$iyi_forw_kredi_geliri = 0;
$toplam_iyi_tl_ihtiyac = 0;
$toplam_iyi_ihtiyac_ithv = 0;
$toplam_iyi_ihtiyac_ihrv = 0;
$toplam_iyi_ihtiyac_ithv = 0;
$toplam_iyi_ihtiyac_ihra = 0;
$toplam_iyi_ihtiyac_usd_itha = 0;
$toplam_hacim = 0;
$toplam_hacim_senet = 0;
$batak_toplam_tl_kredi = 0;
$batak_toplam_usd_kredi = 0;
$batak_toplam_tem_kredi = 0;
$batak_toplam_itha_kredi = 0;
$batak_toplam_forw_kredi = 0;
$kanuni_takip_kredi = 0;
$kanuni_takip_usd_kredi = 0;
$cek_senet_kari = 0;
$ithv_kari = 0;
$ihrv_kari = 0;
$ihra_ihbar_kari = 0;
$ihra_teyit_kari = 0;
$tl_subelercari_hesabi_aktif = 0;
$birikimli_zarar = 0;
$sene_1_subelercari_tl_gider = 0;		
	$iyi_toplam_tl_kredi = 0;
$iyi_toplam_usd_kredi = 0;
$iyi_toplam_tem_kredi = 0;	
$iyi_toplam_itha_kredi = 0;	
$iyi_toplam_forw_kredi = 0;	
$iyi_tl_kredi_geliri = 0;
$iyi_usd_kredi_geliri = 0;
$iyi_tem_kredi_geliri = 0;
$iyi_itha_kredi_geliri = 0;
$iyi_forw_kredi_geliri = 0;
$toplam_iyi_tl_ihtiyac = 0;
$toplam_iyi_ihtiyac_ithv = 0;
$toplam_iyi_ihtiyac_ihrv = 0;
$toplam_iyi_ihtiyac_ithv = 0;
$toplam_iyi_ihtiyac_ihra = 0;
$toplam_iyi_ihtiyac_usd_itha = 0;
$toplam_hacim = 0;
$toplam_hacim_senet = 0;
$batak_toplam_tl_kredi = 0;
$batak_toplam_usd_kredi = 0;
$batak_toplam_tem_kredi = 0;
$batak_toplam_itha_kredi = 0;
$batak_toplam_forw_kredi = 0;
$kanuni_takip_kredi = 0;
$kanuni_takip_usd_kredi = 0;
$cek_senet_kari = 0;
$ithv_kari = 0;
$ihrv_kari = 0;
$ihra_ihbar_kari = 0;
$ihra_teyit_kari = 0;
$tl_subelercari_hesabi_aktif = 0;
$birikimli_zarar = 0;
$sene_1_subelercari_tl_gider = 0;	
		
			
			$kullanici_durum_id=1;
		$kullanici_durum_sorgu=$db->prepare("SELECT * FROM kullanicilar WHERE kullanici_simulasyon_id='".$simulasyon_kimlik."'");
		$kullanici_durum_sorgu->execute();
		while ($kullanici_durum=$kullanici_durum_sorgu->fetch(PDO::FETCH_ASSOC)) { $kullanici_durum_id++;
																				  
			for($dongu_sene=1;$dongu_sene<5; $dongu_sene++){
																				  												 
			
		$bilanco_id=1;
		$bilanco_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."'
		AND oneri_sene='".$dongu_sene."' AND oneri_batak='0' AND oneri_kullanici_id='".$kullanici_durum['kullanici_id']."'");
		$bilanco_sorgu->execute();
		while ($bilanco=$bilanco_sorgu->fetch(PDO::FETCH_ASSOC)) { $bilanco_id++; 
			  $iyi_toplam_tl_kredi += $bilanco['kredi_tl_miktar'];
			  $iyi_toplam_usd_kredi += $bilanco['kredi_usd_miktar'];
			  $iyi_toplam_tem_kredi += $bilanco['kredi_tem_miktar'];
			  $iyi_toplam_itha_kredi += $bilanco['kredi_itha_miktar'];
			  $iyi_toplam_forw_kredi += $bilanco['kredi_forw_miktar'];												  
			  $iyi_tl_kredi_geliri += $bilanco['kredi_tl_miktar'] * $bilanco['kredi_tl_oran'] * 1/100;
			  $iyi_usd_kredi_geliri += $bilanco['kredi_usd_miktar'] * $bilanco['kredi_usd_oran'] * 1/100 * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];
			  $iyi_tem_kredi_geliri += $bilanco['kredi_tem_miktar'] * $bilanco['kredi_tem_oran'] * 1/100;
			  $iyi_itha_kredi_geliri += $bilanco['kredi_itha_miktar'] * $bilanco['kredi_itha_oran'] * 1/100 * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];								  
			  $iyi_forw_kredi_geliri += $bilanco['kredi_forw_miktar'] * $bilanco['kredi_forw_oran'] * 1/100 * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];
			  $toplam_iyi_tl_ihtiyac += $bilanco['oneri_ihtiyac_tl'];												 
			  $toplam_iyi_ihtiyac_ithv += $bilanco['oneri_ihtiyac_ithv'];	
			  $toplam_iyi_ihtiyac_ihrv += $bilanco['oneri_ihtiyac_ihrv'];
			  $toplam_iyi_ihtiyac_ihra += $bilanco['oneri_ihtiyac_ihra'];													  
			  $toplam_iyi_ihtiyac_usd_itha += $bilanco['oneri_ihtiyac_usd'] + $bilanco['oneri_ihtiyac_itha'];
			  $toplam_hacim += $bilanco['oneri_hacim_usd'];	
			  $toplam_hacim_senet += $bilanco['oneri_hacim_senet'];
																  
														  
			  	
			  													 
			  													  
			
			  
																  
																  
			  }
		$bilanco_batak_id=1;
		$bilanco_batak_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."'
		AND oneri_sene='".$dongu_sene."' AND oneri_batak='1' AND oneri_kullanici_id='".$kullanici_durum['kullanici_id']."'");
		$bilanco_batak_sorgu->execute();
		while ($bilanco_batak=$bilanco_batak_sorgu->fetch(PDO::FETCH_ASSOC)) { $bilanco_batak_id++; 
			  $batak_toplam_tl_kredi += $bilanco_batak['kredi_tl_miktar'];
			  $batak_toplam_usd_kredi += $bilanco_batak['kredi_usd_miktar'];	
			  $batak_toplam_tem_kredi += $bilanco_batak['kredi_tem_miktar'];																			  $batak_toplam_itha_kredi += $bilanco_batak['kredi_itha_miktar'];
			  $batak_toplam_forw_kredi += $bilanco_batak['kredi_itha_miktar'];														  
			  
			  $kanuni_takip_kredi += 
				  $bilanco_batak['kredi_tl_miktar'] +
				  $bilanco_batak['kredi_usd_miktar'] * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'] +
				  $bilanco_batak['kredi_tem_miktar'] +
				  $bilanco_batak['kredi_itha_miktar'] * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort']; 
																			  
			  $kanuni_takip_usd_kredi += $bilanco_batak['kredi_usd_miktar'];														  
			  }
				
				if($toplam_iyi_tl_ihtiyac == 0){
				 $bilanco['oneri_ihtiyac_tl'] = 1; 
			  }else{
				$yuzde_tl = $iyi_toplam_tl_kredi / $toplam_iyi_tl_ihtiyac;  
				$cek_senet_kari += $sablon['parametre_sene_'.$dongu_sene.'_komisyon_senet'] * $toplam_hacim_senet *  $yuzde_tl;
			  }
			if($toplam_iyi_ihtiyac_usd_itha == 0){
				$toplam_iyi_ihtiyac_usd_itha = 0.00001;
			}
			else{}
			$yuzde = ($iyi_toplam_usd_kredi + $iyi_toplam_itha_kredi) / $toplam_iyi_ihtiyac_usd_itha;
			
			$alsat_kambiyo_kari = $sablon['parametre_sene_'.$dongu_sene.'_spread_alsat'] * $toplam_hacim * $yuzde * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];	
				
				$ithv_kari += $sablon['parametre_sene_'.$dongu_sene.'_komisyon_ithv'] * $toplam_iyi_ihtiyac_ithv *  $yuzde * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];
			  $ihrv_kari += $sablon['parametre_sene_'.$dongu_sene.'_komisyon_ihrv'] * $toplam_iyi_ihtiyac_ihrv *  $yuzde * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];
			  
			  $ihra_ihbar_kari += $sablon['parametre_sene_'.$dongu_sene.'_komisyon_ihra_ihbar'] * $toplam_iyi_ihtiyac_ihra * $yuzde * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];
			  $ihra_teyit_kari += 1/2 * $sablon['parametre_sene_'.$dongu_sene.'_komisyon_ihra_teyit'] * $toplam_iyi_ihtiyac_ihra *  $yuzde * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];	
				
			  
			
			  $vadesiz_tl_mevduat = $iyi_toplam_tl_kredi * 5/100;
			  $vadeli_tl_mevduat = $vadesiz_tl_mevduat / 2;	
			  $vadesiz_usd_mevduat = $iyi_toplam_usd_kredi * 5/100;
			  $vadeli_usd_mevduat = $vadesiz_usd_mevduat / 2;
			  $vadeli_tl_mevduat_spread_geliri=  $vadeli_tl_mevduat * $sablon['parametre_sene_'.$dongu_sene.'_spread_faiz_tl'];
			  $vadeli_usd_mevduat_spread_geliri=  $vadeli_usd_mevduat * $sablon['parametre_sene_'.$dongu_sene.'_spread_faiz_usd'] * $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'];
			
			  
		   	  $tl_subeler_cari_hesabi = $iyi_toplam_tl_kredi + $kanuni_takip_kredi + $sablon['parametre_sene_'.$dongu_sene.'_kasa'] - $vadesiz_tl_mevduat - $vadeli_tl_mevduat;	
			  $tl_subeler_cari_gider =  $tl_subeler_cari_hesabi * $sablon['parametre_sene_'.$dongu_sene.'_faiz_tl_ort'] / 100;
			
			  $usd_subeler_cari_hesabi = $iyi_toplam_usd_kredi - $vadesiz_usd_mevduat - $vadeli_usd_mevduat;	
			  $usd_subeler_cari_gider =  $sablon['parametre_sene_'.$dongu_sene.'_kur_ort'] * $usd_subeler_cari_hesabi * $sablon['parametre_sene_'.$dongu_sene.'_faiz_usd_ort'] * 1 / 100;
			
			
			
		
		 $gelir_toplam = $iyi_tl_kredi_geliri + $iyi_usd_kredi_geliri + $iyi_tem_kredi_geliri + $iyi_itha_kredi_geliri + $iyi_forw_kredi_geliri + $alsat_kambiyo_kari + $vadeli_tl_mevduat_spread_geliri + $vadeli_usd_mevduat_spread_geliri + $cek_senet_kari + $ithv_kari + $ihrv_kari + $ihra_ihbar_kari + $ihra_teyit_kari;
			
		$gider_toplam = $sablon['parametre_sene_'.$dongu_sene.'_portfoy_maaslari'] + $sablon['parametre_sene_'.$dongu_sene.'_kira'] + $tl_subeler_cari_gider + $usd_subeler_cari_gider;
			
		$grup_donem_kari = $gelir_toplam - $gider_toplam;
		
			
			
		
		$aktif_tl_kontrol = $sablon['parametre_sene_'.$dongu_sene.'_kasa'] + $iyi_toplam_tl_kredi + $kanuni_takip_kredi;
			
		$pasif_tl_kontrol = $vadesiz_tl_mevduat + $vadeli_tl_mevduat + $grup_donem_kari;
		 
		if($aktif_tl_kontrol < $pasif_tl_kontrol){
				$tl_subelercari_hesabi_aktif = $pasif_tl_kontrol - $aktif_tl_kontrol;
		}elseif($pasif_tl_kontrol < $aktif_tl_kontrol){
				$tl_subelercari_hesabi_pasif = $aktif_tl_kontrol - $pasif_tl_kontrol;
		}else{
				$tl_subelercari_hesabi_aktif= 0;
				$tl_subelercari_hesabi_pasif = 0;
		}
		
		
		
																				  
		
		
		$aktif_toplam_usd =  $iyi_toplam_usd_kredi;
		$pasif_toplam_usd = $vadesiz_usd_mevduat + $vadeli_usd_mevduat + $usd_subeler_cari_hesabi;																		  
			
			
		$aktif_toplam = $tl_subelercari_hesabi_aktif + $sablon['parametre_sene_'.$dongu_sene.'_kasa'] + $iyi_toplam_tl_kredi + $kanuni_takip_kredi;
			
		$pasif_toplam = $tl_subelercari_hesabi_pasif + $vadesiz_tl_mevduat + $vadeli_tl_mevduat + $grup_donem_kari;
		$birikimli_zarar += $grup_donem_kari;	
				
				
		
		
	?>


<div class="modal fade" id="kullanici_<?php echo $kullanici_durum['kullanici_id'];?>_<?php echo $dongu_sene; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div style="width:100%;height:100vh;padding:0;max-width:100%;margin:0;" class="modal-dialog">
    <div style="height:100%;border-radius:0;" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">❌</button>
      </div>
      <div style="overflow-y:auto;height:100vh;" class="modal-body">
        
       <div style="padding:0;background-color:#FFFFFF;max-width:10000px;"class="container">
		 
		   
           <div class="row justify-content-around">		

	<div style="text-align:center;"class="col-12 col-md-12">
		<br>
		<h5 style="text-align:center;"><?php echo $kullanici_durum['kullanici_banka_ad']; ?> Bank Genel Durum - <?php echo $dongu_sene;?>. Sene</h5>
		<hr>
		
		<br>
	 </div>

	<div style="font-size:15px;"class="col-12 col-md-6">
		<table style="max-width:100%;"class="table table-hover table-sm table-light table-bordered"> 
		<tbody class="thead-light">
	
		<th colspan="2" style="text-align:center;padding:15px;font-size:16px;">Türk Lirası Bilanço</th>
			
		</tbody>	
						
		<tbody style="width:100%;">


		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Aktif Toplam</strong></td>
		<td><strong><?php echo number_format($aktif_toplam, 0, ',', '.'); ?></strong></td>
		</tr>
		<tr>
		<td style="width:50%;">Kasa</td>
		<td><?php echo number_format($sablon['parametre_sene_'.$dongu_sene.'_kasa'], 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Türk Lirası Nakdi Krediler</td>
		<td><?php echo number_format($iyi_toplam_tl_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Kanuni Takipteki Krediler (TL Cinsinden)</td>
		<td><?php echo number_format($kanuni_takip_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Genel Müdürlük TL Şubeler Cari Hesabı</td>
		<td><?php echo number_format($tl_subelercari_hesabi_aktif, 0, ',', '.'); ?></td>
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Pasif Toplam</strong></td>
		<td><strong><?php echo number_format($pasif_toplam, 0, ',', '.'); ?></strong></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadesiz TL Mevduat</td>
		<td><?php echo number_format($vadesiz_tl_mevduat, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli TL Mevduat</td>
		<td><?php echo number_format($vadeli_tl_mevduat, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Genel Müdürlük TL Şubeler Cari Hesabı</td>
		<td><?php echo number_format($tl_subelercari_hesabi_pasif, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Grup Dönem Kârı (Gn.Md.'e Devir)</td>
		<td><?php echo number_format($grup_donem_kari, 0, ',', '.'); ?></td>
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Nâzım Hesaplar</strong></td>
		<td> </td>
		</tr>
		<tr>
		<td style="width:50%;">TL Teminat Mektubundan Alacaklar</td>
		<td><?php echo number_format($iyi_toplam_tem_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">TL Teminat Mektubundan Borçlar</td>
		<td ><?php echo number_format($iyi_toplam_tem_kredi, 0, ',', '.'); ?></td>
		</tr>
		
		</tbody>
		</table>

		<table style="max-width:100%;" class="table table-hover table-sm table-light table-bordered"> 
		<tbody class="thead-light">
		<th colspan="2" style="text-align:center;padding:15px;font-size:16px;">Döviz Bilanço</th>
		</tbody>	
						
		<tbody style="width:100%;">


		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Aktif Toplam</strong></td>
		<td><strong><?php echo number_format($aktif_toplam_usd, 0, ',', '.'); ?></strong></td>
		</tr>
		<tr>
		<td style="width:50%;">USD Nakdi Krediler</td>
		<td><?php echo number_format($iyi_toplam_usd_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Genel Müdürlük USD Şubeler Cari Hesabı</td>
		<td><?php echo number_format(0, 0, ',', '.'); ?></td>
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Pasif Toplam</strong></td>
		<td><strong><?php echo number_format($pasif_toplam_usd, 0, ',', '.'); ?></strong></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadesiz USD Mevduat</td>
		<td><?php echo number_format($vadesiz_usd_mevduat, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli USD Mevduat</td>
		<td><?php echo number_format($vadeli_usd_mevduat, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Genel Müdürlük USD Şubeler Cari Hesabı</td>
		<td><?php echo number_format($usd_subeler_cari_hesabi, 0, ',', '.'); ?></td>
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Nâzım Hesaplar</strong></td>
		<td></td>
		</tr>
		<tr>
		<td style="width:50%;">İthalat Akreditifinden Alacaklar USD</td>
		<td><?php echo number_format($iyi_toplam_itha_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">İthalat Akreditifinden Borçlar USD</td>
		<td><?php echo number_format($iyi_toplam_itha_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli Döviz İşlemlerinden Alacaklar FORWARD - USD</td>
		<td><?php echo number_format($iyi_toplam_forw_kredi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli Döviz İşlemlerinden Borçlar FORWARD - USD</td>
		<td><?php echo number_format($iyi_toplam_forw_kredi, 0, ',', '.'); ?></td>
		</tr>
		</tbody>
		</table>
		
	</div>
	<div style="font-size:15px;" class="col-12 col-md-6">
		<table style="max-width:100%;" class="table table-hover table-sm table-light table-bordered"> 
		<tbody class="thead-light">
		<th colspan="2" style="text-align:center;padding:15px;font-size:16px;">Gelir - Gider Tablosu</th>	
		</tbody>	
						
		<tbody style="width:100%;">


		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Gelir Toplamı</strong></td>
		<td><strong><?php echo number_format($gelir_toplam, 0, ',', '.');?></strong></td>
		</tr>
		<tr>
		<td style="width:50%;">Türk Lirası Kredi Faiz Gelirleri</td>
		<td><?php echo number_format($iyi_tl_kredi_geliri, 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">USD Kredi Faiz Gelirleri (TL Cinsinden)</td>
		<td><?php echo number_format($iyi_usd_kredi_geliri , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Teminat Mektubu Komisyon Getirisi (TL)</td>
		<td><?php echo number_format($iyi_tem_kredi_geliri , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">İthalat Akreditifi Komisyon Gelirleri</td>
		<td><?php echo number_format($iyi_itha_kredi_geliri , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Döviz Alım & Satım Kambiyo Kârları (Top.Döv.Hacmi Üzerinden)</td>
		<td><?php echo number_format($alsat_kambiyo_kari , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli TL Mevduat Faiz Spread'i Getirisi</td>
		<td><?php echo number_format($vadeli_tl_mevduat_spread_geliri , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli USD Mevduat Faiz Spread'i Getirisi (TL)</td>
		<td><?php echo number_format($vadeli_usd_mevduat_spread_geliri , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Vadeli Döviz İşlemleri FORWARD Kur Farkı Getirisi</td>
		<td><?php echo number_format($iyi_forw_kredi_geliri , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Kredi Bonusu Çek Senet Tahsil Komisyonu Getirisi</td>
		<td><?php echo number_format($cek_senet_kari , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Akreditif Dışı İthalat Hacmi (Tahsil Vesaiki) Komisyon Getirisi</td>
		<td><?php echo number_format($ithv_kari , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Akreditif Dışı İhracat Hacmi Komisyon Getirisi</td>
		<td><?php echo number_format($ihrv_kari , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">İhracat Akreditifi İhbar Komisyonu Getirisi </td>
		<td><?php echo number_format($ihra_ihbar_kari , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">İhracat Akreditifi Teyit Komisyonu Getirisi (L/C Dışı Yarısı Teyitli)</td>
		<td><?php echo number_format($ihra_teyit_kari , 0, ',', '.');?></td>
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>Gider Toplamı</strong></td>
			<td><strong><?php echo number_format($gider_toplam, 0, ',', '.');?></strong></td>
		</tr>
		<tr>
		<td style="width:50%;">Portföy Çalışan Maaşları</td>
		<td><?php echo number_format($sablon['parametre_sene_'.$dongu_sene.'_portfoy_maaslari'], 0, ',', '.'); ?></td>
		</tr>
		<tr>
		<td style="width:50%;">Kanuni Takipteki Kredi Fonlama Zararları (TL)</td>
		<td>0</td>
		</tr>
		<tr>
		<td style="width:50%;">Kanuni Takipteki Kredi Fonlama Zararları USD (TL Cinsinden)</td>
		<td>0</td>
		</tr>
		<tr>
		<td style="width:50%;">Şubeler Cari Faiz Giderleri (TL)</td>
		<td><?php echo number_format($tl_subeler_cari_gider , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Şubeler Cari Faiz Giderleri USD (TL Cinsinden)</td>
		<td><?php echo number_format($usd_subeler_cari_gider , 0, ',', '.');?></td>
		</tr>
		<tr>
		<td style="width:50%;">Döviz Alım Satım Kur Zararları</td>
		<td>0</td>
		</tr>
		<tr>
		<td style="width:50%;">Şube Binası Kira Gideri</td>
		<td><?php echo number_format($sablon['parametre_sene_'.$dongu_sene.'_kira'], 0, ',', '.'); ?></td>
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>GRUP DÖNEM KÂR / ZARARI</strong></td>
		<td><?php echo number_format($grup_donem_kari, 0, ',', '.');?></td>	
		</tr>
		<tr style="background-color:#E9ECEF;">
		<td style="width:50%;"><strong>GRUP DÖNEM KÂR / ZARARI (BİRİKİMLİ)</strong></td>
		<td><?php echo number_format($birikimli_zarar, 0, ',', '.');?></td>
		</tr>
		
		</tbody>
		</table>
			
	</div>
	   
			   
               
    
               
           </div>
       </div>
		  
      </div>
      
    </div>
  </div>
</div>

  <?php
$aktif_toplam = 0;
$pasif_toplam = 0;
$aktif_toplam_usd = 0;
$pasif_toplam_usd = 0;
$aktif_toplam_kontrol = 0;
$pasif_toplam_kontrol = 0;

$tl_subeler_cari_hesabi = 0;
$usd_subeler_cari_hesabi = 0;

$tl_subelercari_hesabi_aktif = 0;
$tl_subelercari_hesabi_pasif = 0;
	
$tl_subeler_cari_gider = 0;
$usd_subeler_cari_gider = 0;
			
																				  
$iyi_toplam_tl_kredi = 0;
$iyi_toplam_usd_kredi = 0;
$iyi_toplam_tem_kredi = 0;
$iyi_toplam_itha_kredi = 0;
$iyi_toplam_forw_kredi = 0;
																				  
$iyi_tl_kredi_geliri = 0;
$iyi_usd_kredi_geliri = 0;																				
$iyi_tem_kredi_geliri = 0;
$iyi_itha_kredi_geliri = 0;
$iyi_forw_kredi_geliri = 0;
																				  
$yuzde = 0;
$yuzde_alsat = 0;				
$alsat_kambiyo_kari = 0;
$cek_senet_kari = 0;
$vadeli_tl_mevduat_spread_geliri = 0;
$vadeli_usd_mevduat_spread_geliri = 0;
$ithv_kari = 0;
$ihrv_kari = 0;			  
$ihra_ihbar_kari  = 0;
$ihra_teyit_kari = 0;
$grup_donem_kari = 0;
$toplam_iyi_ihtiyac_usd_itha = 0;
$toplam_hacim = 0;
$toplam_hacim_senet = 0;
$toplam_iyi_tl_ihtiyac = 0;
$toplam_iyi_ihtiyac_ithv = 0;
$toplam_iyi_ihtiyac_ihra = 0;
$toplam_iyi_ihtiyac_ihrv = 0;
 } 
																				  
$birikimli_zarar = 0;																				  
$kanuni_takip_kredi = 0;
$kanuni_takip_usd_kredi = 0;																				 
$aktif_toplam = 0;
$pasif_toplam = 0;
$aktif_toplam_usd = 0;
$pasif_toplam_usd = 0;
$aktif_toplam_kontrol = 0;
$pasif_toplam_kontrol = 0;

$tl_subeler_cari_hesabi = 0;
$usd_subeler_cari_hesabi = 0;

$tl_subelercari_hesabi_aktif = 0;
$tl_subelercari_hesabi_pasif = 0;
	
$tl_subeler_cari_gider = 0;
$usd_subeler_cari_gider = 0;
			
																				  
$iyi_toplam_tl_kredi = 0;
$iyi_toplam_usd_kredi = 0;
$iyi_toplam_tem_kredi = 0;
$iyi_toplam_itha_kredi = 0;
$iyi_toplam_forw_kredi = 0;
																				  
$iyi_tl_kredi_geliri = 0;
$iyi_usd_kredi_geliri = 0;																				
$iyi_tem_kredi_geliri = 0;
$iyi_itha_kredi_geliri = 0;
$iyi_forw_kredi_geliri = 0;
																				  
$yuzde = 0;
$yuzde_alsat = 0;																				 
$alsat_kambiyo_kari = 0;
$cek_senet_kari = 0;
$vadeli_tl_mevduat_spread_geliri = 0;
$vadeli_usd_mevduat_spread_geliri = 0;
$ithv_kari = 0;
$ihrv_kari = 0;			  
$ihra_ihbar_kari  = 0;
$ihra_teyit_kari = 0;
$grup_donem_kari = 0;	
$toplam_iyi_ihtiyac_usd_itha = 0;
$toplam_hacim = 0;
$toplam_hacim_senet = 0;																				 
$toplam_iyi_tl_ihtiyac = 0;	
$toplam_iyi_ihtiyac_ithv = 0;
$toplam_iyi_ihtiyac_ihra = 0;
$toplam_iyi_ihtiyac_ihrv = 0;																				
 }

?>