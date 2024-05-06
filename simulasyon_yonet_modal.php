

<div class="modal fade" id="tablo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div style="width:100%;height:100vh;padding:0;max-width:100%;margin:0;" class="modal-dialog">
    <div style="height:100%;border-radius:0;background-color:#D4DCE6;" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">❌</button>
      </div>
      <div style="overflow-y:auto;height:100vh;" class="modal-body">
        <div style="padding:40px;padding-top:0;"class="col-12">
		<br>
    	<h4 style="font-size:21px;letter-spacing:1.5px;color:#26354A;text-align:center;" class="mb-3">FİRMALAR AÇISINDAN UYGULAMA ÖZETİ</h4>
		<hr>
		 <?php 
															
		$firma_body_id=1;
		$firma_body_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sene='".$rapor_sene."' AND firma_sablon_id='".$simulasyon_sablon_id."' ORDER BY firma_sira ASC");
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
														$oneri_rapor_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$rapor_sene."' AND oneri_firma_id='".$firma_body['firma_id']."'");
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
													  <td><?php echo number_format($simbank_tl , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_faiz_tl'];?></td>
													  <td><?php echo number_format($simbank_usd , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_faiz_usd'];?></td>
														  <td><?php echo number_format($simbank_tem , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_komisyon_tem'];?></td>
													  <td><?php echo number_format($simbank_itha , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_komisyon_itha'];?></td>
													  <td><?php echo number_format($simbank_forw , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_spread_forw'];?></td>
													  
													
													  
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
    	<h4 style="font-size:21px;letter-spacing:1.5px;color:#26354A;text-align:center;" class="mb-3">BANKALAR AÇISINDAN UYGULAMA ÖZETİ</h4>
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
														$kredi_banka_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$rapor_sene."' AND oneri_kullanici_id='".$banka_body['kullanici_id']."'");
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
		  
      </div>
      
    </div>
  </div>
</div>







<div class="modal fade" id="teklifler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div style="width:100%;height:100vh;padding:0;max-width:100%;margin:0;" class="modal-dialog">
    <div style="height:100%;border-radius:0;background-color:#D4DCE6;" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">❌</button>
      </div>
      <div style="overflow-y:auto;height:100vh;" class="modal-body">
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
      
    </div>
  </div>
</div>











<div class="modal fade" id="rapor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div style="width:100%;height:100vh;padding:0;max-width:100%;margin:0;" class="modal-dialog">
    <div style="height:100%;border-radius:0;background-color:#D4DCE6;" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">❌</button>
      </div>
      <div style="overflow-y:auto;height:100vh;" class="modal-body">
		<?php  for($dongu_rapor=1;$dongu_rapor<5; $dongu_rapor++){ ?>
        <div style="padding:40px;padding-top:0;"class="col-12">
		
		<br>
    	<h4 style="font-size:21px;letter-spacing:1.5px;color:#26354A;text-align:center;" class="mb-3"><?php echo $dongu_rapor;?>. SENE FİRMALAR AÇISINDAN UYGULAMA ÖZETİ</h4>
		<hr>
		 <?php 
															
		$firma_body_id=1;
		$firma_body_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sene='".$dongu_rapor."' AND firma_sablon_id='".$simulasyon_sablon_id."' ORDER BY firma_id ASC");
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
														$oneri_rapor_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$dongu_rapor."' AND oneri_firma_id='".$firma_body['firma_id']."'");
														$oneri_rapor_sorgu->execute();
														while ($oneri_rapor=$oneri_rapor_sorgu->fetch(PDO::FETCH_ASSOC)) { $oneri_rapor_id++; ?>	
													 <?php $toplam_tl += $oneri_rapor['kredi_tl_miktar']; $simbank_tl = $firma_body['firma_ihtiyac_tl'] - $toplam_tl;
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
													  <td><?php echo number_format($simbank_tl , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_faiz_tl'];?></td>
													  <td><?php echo number_format($simbank_usd , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_faiz_usd'];?></td>
														  <td><?php echo number_format($simbank_tem , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_komisyon_tem'];?></td>
													  <td><?php echo number_format($simbank_itha , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_komisyon_itha'];?></td>
													  <td><?php echo number_format($simbank_forw , 0, ',', '.');?> <span style="color:grey">-</span> % <?php echo $sablon['parametre_sene_'.$rapor_sene.'_simbank_spread_forw'];?></td>
													  
													
													  
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
    	<h4 style="font-size:21px;letter-spacing:1.5px;color:#26354A;text-align:center;" class="mb-3"><?php echo $dongu_rapor;?>. SENE BANKALAR AÇISINDAN UYGULAMA ÖZETİ</h4>
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
														$kredi_banka_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$dongu_rapor."' AND oneri_kullanici_id='".$banka_body['kullanici_id']."'");
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
		 <?php } ?>
		  
      </div>
      
    </div>
  </div>
</div>
