<?php 

	$firma_list=1;
		$firma_sorgu=$db->prepare("SELECT * FROM firma WHERE firma_sablon_id='".$simulasyon_sablon_id."' AND firma_sene='".$anlik_sene."' ORDER BY firma_id ASC");
		$firma_sorgu->execute();
		while ($firma=$firma_sorgu->fetch(PDO::FETCH_ASSOC)) { $firma_list++;
												  
			$teklif_tl = [];
			$teklif_usd = [];	
			$teklif_tem = [];	
			$teklif_itha = [];
			$teklif_forw = [];
			$oneri_cek_list=1;
			$oneri_sorgu=$db->prepare("SELECT * FROM oneri WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_firma_id='".$firma['firma_id']."' ORDER BY oneri_id ASC");
			$oneri_sorgu->execute();
			while ($oneri_exe=$oneri_sorgu->fetch(PDO::FETCH_ASSOC)) { $oneri_cek_list++; 
																	
				$teklif_tl[]=[
					'teklif_kullanici_id' => ''.$oneri_exe["oneri_kullanici_id"].'',
					'teklif_firma_id' => ''.$oneri_exe["oneri_firma_id"].'', 
					'teklif_tl_miktar' => ''.$oneri_exe["teklif_tl_miktar"].'',
					'teklif_tl_oran' => ''.$oneri_exe["teklif_tl_oran"].''
								];
				$teklif_usd[]=[
					'teklif_kullanici_id' => ''.$oneri_exe["oneri_kullanici_id"].'',
					'teklif_firma_id' => ''.$oneri_exe["oneri_firma_id"].'', 
					'teklif_usd_miktar' => ''.$oneri_exe["teklif_usd_miktar"].'',
					'teklif_usd_oran' => ''.$oneri_exe["teklif_usd_oran"].''
								];
				$teklif_tem[]=[
					'teklif_kullanici_id' => ''.$oneri_exe["oneri_kullanici_id"].'',
					'teklif_firma_id' => ''.$oneri_exe["oneri_firma_id"].'', 
					'teklif_tem_miktar' => ''.$oneri_exe["teklif_tem_miktar"].'',
					'teklif_tem_oran' => ''.$oneri_exe["teklif_tem_oran"].''
								];
				$teklif_itha[]=[
					'teklif_kullanici_id' => ''.$oneri_exe["oneri_kullanici_id"].'',
					'teklif_firma_id' => ''.$oneri_exe["oneri_firma_id"].'', 
					'teklif_itha_miktar' => ''.$oneri_exe["teklif_itha_miktar"].'',
					'teklif_itha_oran' => ''.$oneri_exe["teklif_itha_oran"].''
								];
				$teklif_forw[]=[
					'teklif_kullanici_id' => ''.$oneri_exe["oneri_kullanici_id"].'',
					'teklif_firma_id' => ''.$oneri_exe["oneri_firma_id"].'', 
					'teklif_forw_miktar' => ''.$oneri_exe["teklif_forw_miktar"].'',
					'teklif_forw_oran' => ''.$oneri_exe["teklif_forw_oran"].''
								];
			  }
	
	
	// ***************************************** tl İHTİYAÇ BAŞLANGIÇ *************************************************
if($sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] == 0){
$limit_hesap = 999999999;
}else{
$limit_hesap = $sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] / 100;
} 																													  
$ust_limit_tl = ($firma['firma_ihtiyac_tl'] + $firma['firma_ihtiyac_tl'] * $limit_hesap);
$simbank_limit = $sablon['parametre_sene_'.$anlik_sene.'_simbank_faiz_tl'];	
$num_dagitim_tl = $firma['firma_ihtiyac_tl'];								  
usort($teklif_tl, function($a_dagitim_tl, $b_dagitim_tl){
if($a_dagitim_tl['teklif_tl_oran'] == $b_dagitim_tl['teklif_tl_oran'])
return $a_dagitim_tl['teklif_tl_miktar'] < $b_dagitim_tl['teklif_tl_miktar'];
return $a_dagitim_tl['teklif_tl_oran'] > $b_dagitim_tl['teklif_tl_oran'];
});

$teklif_tl = array_map(function($i_dagitim_tl) use($teklif_tl){
$f_dagitim_tl = array_filter($teklif_tl, function($a_dagitim_tl) use($i_dagitim_tl){
return $a_dagitim_tl['teklif_tl_miktar'] == $i_dagitim_tl['teklif_tl_miktar'] && $a_dagitim_tl['teklif_tl_oran'] == $i_dagitim_tl['teklif_tl_oran'];
});
return count($f_dagitim_tl) > 1 ? array_merge($i_dagitim_tl, ['esit' => count($f_dagitim_tl), 'varsay' => $i_dagitim_tl['teklif_tl_miktar']/count($f_dagitim_tl)]) : $i_dagitim_tl;
}, $teklif_tl);
$end_dagitim_tl = false;

foreach ($teklif_tl as $k => $a_dagitim_tl) {
$prev_dagitim_tl = $num_dagitim_tl;
if(
$a_dagitim_tl['teklif_tl_miktar'] > $ust_limit_tl || 
$a_dagitim_tl['teklif_tl_oran'] >= $simbank_limit 
){			
$kredi_kabul_edilmedi_tl = $db->prepare("UPDATE oneri SET
			
kredi_tl_miktar =:kredi_tl_miktar,
kredi_tl_oran =:kredi_tl_oran,
oneri_batak =:oneri_batak

WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_tl['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_tl['teklif_firma_id']."' ");
$insert = $kredi_kabul_edilmedi_tl->execute(array(					 
'kredi_tl_miktar' => '0',
'kredi_tl_oran' => '0',
'oneri_batak' => ($firma['firma_batak'])
));						
}else{
if($end_dagitim_tl){
$calc_dagitim_tl = $end_dagitim_tl;
}else{
if(isset($a_dagitim_tl['esit'])){
if($num_dagitim_tl < ($a_dagitim_tl['teklif_tl_miktar'] * $a_dagitim_tl['esit'])){
$calc_dagitim_tl = $end_dagitim_tl = $num_dagitim_tl/$a_dagitim_tl['esit'];
}else{
$calc_dagitim_tl = $a_dagitim_tl['teklif_tl_miktar'];
}
}else{
$calc_dagitim_tl = $num_dagitim_tl < $a_dagitim_tl['teklif_tl_miktar'] ? $num_dagitim_tl : $a_dagitim_tl['teklif_tl_miktar'];
}
}
	
	
	
	
	
$num_dagitim_tl -= $calc_dagitim_tl;
if($num_dagitim_tl < 0) break;
$kredi_ekle_tl = $db->prepare("UPDATE oneri SET
kredi_tl_miktar =:kredi_tl_miktar,
kredi_tl_oran =:kredi_tl_oran,
oneri_batak =:oneri_batak
WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_tl['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_tl['teklif_firma_id']."' ");
$insert = $kredi_ekle_tl->execute(array(
'kredi_tl_miktar' => ($calc_dagitim_tl),
'kredi_tl_oran' => ($a_dagitim_tl['teklif_tl_oran']),
'oneri_batak' => ($firma['firma_batak'])
));
}	
}
// ***************************************** tl İHTİYAÇ SON *************************************************	
		// ***************************************** usd İHTİYAÇ BAŞLANGIÇ *************************************************
			if($sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] == 0){
$limit_hesap = 999999999;
}else{
$limit_hesap = $sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] / 100;
}										 
			$ust_limit_usd = ($firma['firma_ihtiyac_usd'] + ($firma['firma_ihtiyac_usd'] * $limit_hesap));
			$simbank_limit = $sablon['parametre_sene_'.$anlik_sene.'_simbank_faiz_usd'];	
			
							
			$num_dagitim_usd = $firma['firma_ihtiyac_usd'];								  
			usort($teklif_usd, function($a_dagitim_usd, $b_dagitim_usd){
				if($a_dagitim_usd['teklif_usd_oran'] == $b_dagitim_usd['teklif_usd_oran'])
					return $a_dagitim_usd['teklif_usd_miktar'] < $b_dagitim_usd['teklif_usd_miktar'];
				return $a_dagitim_usd['teklif_usd_oran'] > $b_dagitim_usd['teklif_usd_oran'];
			});



$teklif_usd = array_map(function($i_dagitim_usd) use($teklif_usd){
				$f_dagitim_usd = array_filter($teklif_usd, function($a_dagitim_usd) use($i_dagitim_usd){
					return $a_dagitim_usd['teklif_usd_miktar'] == $i_dagitim_usd['teklif_usd_miktar'] && $a_dagitim_usd['teklif_usd_oran'] == $i_dagitim_usd['teklif_usd_oran'];
				});
				return count($f_dagitim_usd) > 1 ? array_merge($i_dagitim_usd, ['esit' => count($f_dagitim_usd), 'varsay' => $i_dagitim_usd['teklif_usd_miktar']/count($f_dagitim_usd)]) : $i_dagitim_usd;
			}, $teklif_usd);
		    										  
			$end_dagitim_usd = false;







foreach ($teklif_usd as $k => $a_dagitim_usd) {

$prev_dagitim_usd = $num_dagitim_usd;
if(
$a_dagitim_usd['teklif_usd_miktar'] > $ust_limit_usd || 
$a_dagitim_usd['teklif_usd_oran'] >= $simbank_limit 
){
				
$kredi_kabul_edilmedi_usd = $db->prepare("UPDATE oneri SET
			
kredi_usd_miktar =:kredi_usd_miktar,
kredi_usd_oran =:kredi_usd_oran,
oneri_batak =:oneri_batak

WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_usd['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_usd['teklif_firma_id']."' ");

$insert = $kredi_kabul_edilmedi_usd->execute(array(
						 
'kredi_usd_miktar' => '0',
'kredi_usd_oran' => '0',
'oneri_batak' => ($firma['firma_batak'])

					 ));		
					
}else{
				if($end_dagitim_usd){
						$calc_dagitim_usd = $end_dagitim_usd;
					} else{
						if(isset($a_dagitim_usd['esit'])){
if($num_dagitim_usd < ($a_dagitim_usd['teklif_usd_miktar'] * $a_dagitim_usd['esit'])){
$calc_dagitim_usd = $end_dagitim_usd = $num_dagitim_usd/$a_dagitim_usd['esit'];
}else{
$calc_dagitim_usd = $a_dagitim_usd['teklif_usd_miktar'];
}
}else{
$calc_dagitim_usd = $num_dagitim_usd < $a_dagitim_usd['teklif_usd_miktar'] ? $num_dagitim_usd : $a_dagitim_usd['teklif_usd_miktar'];
}
					}

						$num_dagitim_usd -= $calc_dagitim_usd;
						if($num_dagitim_usd < 0) break;
	
						
						 $kredi_ekle_usd = $db->prepare("UPDATE oneri SET
			
						 kredi_usd_miktar =:kredi_usd_miktar,
						 kredi_usd_oran =:kredi_usd_oran,
						 oneri_batak =:oneri_batak

					 WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_usd['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_usd['teklif_firma_id']."' ");


					 $insert = $kredi_ekle_usd->execute(array(
						 
						 'kredi_usd_miktar' => ($calc_dagitim_usd),
						 'kredi_usd_oran' => ($a_dagitim_usd['teklif_usd_oran']),
						 'oneri_batak' => ($firma['firma_batak'])

					 ));
			
				}
	
}
// ***************************************** usd İHTİYAÇ SON *************************************************								// ***************************************** tem İHTİYAÇ BAŞLANGIÇ *************************************************
			if($sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] == 0){
$limit_hesap = 999999999;
}else{
$limit_hesap = $sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] / 100;
}								 
			$ust_limit_tem = ($firma['firma_ihtiyac_tem'] + $firma['firma_ihtiyac_tem'] * $limit_hesap);
			$simbank_limit = $sablon['parametre_sene_'.$anlik_sene.'_simbank_komisyon_tem'];	
			
							
			$num_dagitim_tem = $firma['firma_ihtiyac_tem'];								  
			usort($teklif_tem, function($a_dagitim_tem, $b_dagitim_tem){
				if($a_dagitim_tem['teklif_tem_oran'] == $b_dagitim_tem['teklif_tem_oran'])
					return $a_dagitim_tem['teklif_tem_miktar'] < $b_dagitim_tem['teklif_tem_miktar'];
				return $a_dagitim_tem['teklif_tem_oran'] > $b_dagitim_tem['teklif_tem_oran'];
			});



$teklif_tem = array_map(function($i_dagitim_tem) use($teklif_tem){
				$f_dagitim_tem = array_filter($teklif_tem, function($a_dagitim_tem) use($i_dagitim_tem){
					return $a_dagitim_tem['teklif_tem_miktar'] == $i_dagitim_tem['teklif_tem_miktar'] && $a_dagitim_tem['teklif_tem_oran'] == $i_dagitim_tem['teklif_tem_oran'];
				});
				return count($f_dagitim_tem) > 1 ? array_merge($i_dagitim_tem, ['esit' => count($f_dagitim_tem), 'varsay' => $i_dagitim_tem['teklif_tem_miktar']/count($f_dagitim_tem)]) : $i_dagitim_tem;
			}, $teklif_tem);
		    										  
			$end_dagitim_tem = false;







foreach ($teklif_tem as $k => $a_dagitim_tem) {

$prev_dagitim_tem = $num_dagitim_tem;
if(
$a_dagitim_tem['teklif_tem_miktar'] > $ust_limit_tem || 
$a_dagitim_tem['teklif_tem_oran'] >= $simbank_limit 
){
				
$kredi_kabul_edilmedi_tem = $db->prepare("UPDATE oneri SET
			
kredi_tem_miktar =:kredi_tem_miktar,
kredi_tem_oran =:kredi_tem_oran,
oneri_batak =:oneri_batak

WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_tem['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_tem['teklif_firma_id']."' ");

$insert = $kredi_kabul_edilmedi_tem->execute(array(
						 
'kredi_tem_miktar' => '0',
'kredi_tem_oran' => '0',
'oneri_batak' => ($firma['firma_batak'])

					 ));		
					
}else{
				if($end_dagitim_tem){
						$calc_dagitim_tem = $end_dagitim_tem;
					} else{
						if(isset($a_dagitim_tem['esit'])){
if($num_dagitim_tem < ($a_dagitim_tem['teklif_tem_miktar'] * $a_dagitim_tem['esit'])){
$calc_dagitim_tem = $end_dagitim_tem = $num_dagitim_tem/$a_dagitim_tem['esit'];
}else{
$calc_dagitim_tem = $a_dagitim_tem['teklif_tem_miktar'];
}
}else{
$calc_dagitim_tem = $num_dagitim_tem < $a_dagitim_tem['teklif_tem_miktar'] ? $num_dagitim_tem : $a_dagitim_tem['teklif_tem_miktar'];
}
					}

						$num_dagitim_tem -= $calc_dagitim_tem;
						if($num_dagitim_tem < 0) break;
	
						
						 $kredi_ekle_tem = $db->prepare("UPDATE oneri SET
			
						 kredi_tem_miktar =:kredi_tem_miktar,
						 kredi_tem_oran =:kredi_tem_oran,
						 oneri_batak =:oneri_batak

					 WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_tem['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_tem['teklif_firma_id']."' ");


					 $insert = $kredi_ekle_tem->execute(array(
						 
						 'kredi_tem_miktar' => ($calc_dagitim_tem),
						 'kredi_tem_oran' => ($a_dagitim_tem['teklif_tem_oran']),
						 'oneri_batak' => ($firma['firma_batak'])

					 ));
			
				}
	
}
// ***************************************** tem İHTİYAÇ SON *************************************************						 
// ***************************************** itha İHTİYAÇ BAŞLANGIÇ *************************************************
			if($sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] == 0){
$limit_hesap = 999999999;
}else{
$limit_hesap = $sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] / 100;
}											  
			$ust_limit_itha = ($firma['firma_ihtiyac_itha'] + $firma['firma_ihtiyac_itha'] * $limit_hesap);
			$simbank_limit = $sablon['parametre_sene_'.$anlik_sene.'_simbank_komisyon_itha'];	
			
							
			$num_dagitim_itha = $firma['firma_ihtiyac_itha'];								  
			usort($teklif_itha, function($a_dagitim_itha, $b_dagitim_itha){
				if($a_dagitim_itha['teklif_itha_oran'] == $b_dagitim_itha['teklif_itha_oran'])
					return $a_dagitim_itha['teklif_itha_miktar'] < $b_dagitim_itha['teklif_itha_miktar'];
				return $a_dagitim_itha['teklif_itha_oran'] > $b_dagitim_itha['teklif_itha_oran'];
			});



$teklif_itha = array_map(function($i_dagitim_itha) use($teklif_itha){
				$f_dagitim_itha = array_filter($teklif_itha, function($a_dagitim_itha) use($i_dagitim_itha){
					return $a_dagitim_itha['teklif_itha_miktar'] == $i_dagitim_itha['teklif_itha_miktar'] && $a_dagitim_itha['teklif_itha_oran'] == $i_dagitim_itha['teklif_itha_oran'];
				});
				return count($f_dagitim_itha) > 1 ? array_merge($i_dagitim_itha, ['esit' => count($f_dagitim_itha), 'varsay' => $i_dagitim_itha['teklif_itha_miktar']/count($f_dagitim_itha)]) : $i_dagitim_itha;
			}, $teklif_itha);
		    										  
			$end_dagitim_itha = false;







foreach ($teklif_itha as $k => $a_dagitim_itha) {

$prev_dagitim_itha = $num_dagitim_itha;
if(
$a_dagitim_itha['teklif_itha_miktar'] > $ust_limit_itha || 
$a_dagitim_itha['teklif_itha_oran'] >= $simbank_limit 
){
				
$kredi_kabul_edilmedi_itha = $db->prepare("UPDATE oneri SET
			
kredi_itha_miktar =:kredi_itha_miktar,
kredi_itha_oran =:kredi_itha_oran,
oneri_batak =:oneri_batak

WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_itha['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_itha['teklif_firma_id']."' ");

$insert = $kredi_kabul_edilmedi_itha->execute(array(
						 
'kredi_itha_miktar' => '0',
'kredi_itha_oran' => '0',
'oneri_batak' => ($firma['firma_batak'])

					 ));		
					
}else{
				if($end_dagitim_itha){
						$calc_dagitim_itha = $end_dagitim_itha;
					} else{
						if(isset($a_dagitim_itha['esit'])){
if($num_dagitim_itha < ($a_dagitim_itha['teklif_itha_miktar'] * $a_dagitim_itha['esit'])){
$calc_dagitim_itha = $end_dagitim_itha = $num_dagitim_itha/$a_dagitim_itha['esit'];
}else{
$calc_dagitim_itha = $a_dagitim_itha['teklif_itha_miktar'];
}
}else{
$calc_dagitim_itha = $num_dagitim_itha < $a_dagitim_itha['teklif_itha_miktar'] ? $num_dagitim_itha : $a_dagitim_itha['teklif_itha_miktar'];
}
					}

						$num_dagitim_itha -= $calc_dagitim_itha;
						if($num_dagitim_itha < 0) break;
	
						
						 $kredi_ekle_itha = $db->prepare("UPDATE oneri SET
			
						 kredi_itha_miktar =:kredi_itha_miktar,
						 kredi_itha_oran =:kredi_itha_oran,
						 oneri_batak =:oneri_batak

					 WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_itha['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_itha['teklif_firma_id']."' ");


					 $insert = $kredi_ekle_itha->execute(array(
						 
						 'kredi_itha_miktar' => ($calc_dagitim_itha),
						 'kredi_itha_oran' => ($a_dagitim_itha['teklif_itha_oran']),
						 'oneri_batak' => ($firma['firma_batak'])

					 ));
			
				}
	
}
// ***************************************** itha İHTİYAÇ SON *************************************************								// ***************************************** forw İHTİYAÇ BAŞLANGIÇ *************************************************
			if($sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] == 0){
$limit_hesap = 999999999;
}else{
$limit_hesap = $sablon['parametre_sene_'.$anlik_sene.'_ust_limit'] / 100;
}
if($firma['firma_ihtiyac_forw'] < 0){
	$firma['firma_ihtiyac_forw'] = -1 * $firma['firma_ihtiyac_forw'];
}else{}
			$ust_limit_forw = ($firma['firma_ihtiyac_forw'] + $firma['firma_ihtiyac_forw'] * $limit_hesap);
			$simbank_limit = $sablon['parametre_sene_'.$anlik_sene.'_simbank_spread_forw'];	
			
							
			$num_dagitim_forw = $firma['firma_ihtiyac_forw'];								  
			usort($teklif_forw, function($a_dagitim_forw, $b_dagitim_forw){
				if($a_dagitim_forw['teklif_forw_oran'] == $b_dagitim_forw['teklif_forw_oran'])
					return $a_dagitim_forw['teklif_forw_miktar'] < $b_dagitim_forw['teklif_forw_miktar'];
				return $a_dagitim_forw['teklif_forw_oran'] > $b_dagitim_forw['teklif_forw_oran'];
			});



$teklif_forw = array_map(function($i_dagitim_forw) use($teklif_forw){
				$f_dagitim_forw = array_filter($teklif_forw, function($a_dagitim_forw) use($i_dagitim_forw){
					return $a_dagitim_forw['teklif_forw_miktar'] == $i_dagitim_forw['teklif_forw_miktar'] && $a_dagitim_forw['teklif_forw_oran'] == $i_dagitim_forw['teklif_forw_oran'];
				});
				return count($f_dagitim_forw) > 1 ? array_merge($i_dagitim_forw, ['esit' => count($f_dagitim_forw), 'varsay' => $i_dagitim_forw['teklif_forw_miktar']/count($f_dagitim_forw)]) : $i_dagitim_forw;
			}, $teklif_forw);
		    										  
			$end_dagitim_forw = false;







foreach ($teklif_forw as $k => $a_dagitim_forw) {

$prev_dagitim_forw = $num_dagitim_forw;
if(
$a_dagitim_forw['teklif_forw_miktar'] > $ust_limit_forw || 
$a_dagitim_forw['teklif_forw_oran'] >= $simbank_limit 
){
				
$kredi_kabul_edilmedi_forw = $db->prepare("UPDATE oneri SET
			
kredi_forw_miktar =:kredi_forw_miktar,
kredi_forw_oran =:kredi_forw_oran,
oneri_batak =:oneri_batak

WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_forw['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_forw['teklif_firma_id']."' ");

$insert = $kredi_kabul_edilmedi_forw->execute(array(
						 
'kredi_forw_miktar' => '0',
'kredi_forw_oran' => '0',
'oneri_batak' => ($firma['firma_batak'])

					 ));		
					
}else{
				if($end_dagitim_forw){
						$calc_dagitim_forw = $end_dagitim_forw;
					} else{
						if(isset($a_dagitim_forw['esit'])){
if($num_dagitim_forw < ($a_dagitim_forw['teklif_forw_miktar'] * $a_dagitim_forw['esit'])){
$calc_dagitim_forw = $end_dagitim_forw = $num_dagitim_forw/$a_dagitim_forw['esit'];
}else{
$calc_dagitim_forw = $a_dagitim_forw['teklif_forw_miktar'];
}
}else{
$calc_dagitim_forw = $num_dagitim_forw < $a_dagitim_forw['teklif_forw_miktar'] ? $num_dagitim_forw : $a_dagitim_forw['teklif_forw_miktar'];
}
					}

						$num_dagitim_forw -= $calc_dagitim_forw;
						if($num_dagitim_forw < 0) break;
	
						
						 $kredi_ekle_forw = $db->prepare("UPDATE oneri SET
			
						 kredi_forw_miktar =:kredi_forw_miktar,
						 kredi_forw_oran =:kredi_forw_oran,
						 oneri_batak =:oneri_batak

					 WHERE oneri_simulasyon_id='".$simulasyon_kimlik."' AND oneri_sene='".$anlik_sene."' AND oneri_kullanici_id='".$a_dagitim_forw['teklif_kullanici_id']."' AND oneri_firma_id= '".$a_dagitim_forw['teklif_firma_id']."' ");


					 $insert = $kredi_ekle_forw->execute(array(
						 
						 'kredi_forw_miktar' => ($calc_dagitim_forw),
						 'kredi_forw_oran' => ($a_dagitim_forw['teklif_forw_oran']),
						 'oneri_batak' => ($firma['firma_batak'])

					 ));
			
				}
	
}
// ***************************************** forw İHTİYAÇ SON *************************************************								 
															 
	}

		
?>