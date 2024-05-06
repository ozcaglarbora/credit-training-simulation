<?php ob_start() ?>
<?php session_start(); ?>
<?php 
$title="İDE Eğitim Danışmanlık | Kredi Simülasyonu";
$description="İDE EĞİTİM VE DANIŞMANLIK, kurumların insan kaynağı ve finansal danışmanlık gereksinimlerini eksiksiz karşılamak üzere kurulmuş bir firmadır.";
$keywords="egitim, danışmanlık, eğitim, kredi eğitimi, finansal danışmanlık, şirket değerleme, bilanço analizi";
include "header.php"; 											  
?>

<nav style="background-color:#26354A;"class="mobile_margin navbar navbar-light">
	
		<div style="width:100%;"class="row justify-content-between">
			<div style="padding-left:30px;padding-top:10px;padding-bottom:10px;"class="col-12 col-md-9">
				<span style="font-family: 'Besley', serif;font-size:24px;color:#FFBA00;letter-spacing:4px;">İDE EĞİTİM DANIŞMANLIK</span><br>
				<span style="font-family: 'Besley', serif;font-size:12px;color:whitesmoke;letter-spacing:5px;">KREDİ EĞİTİM PROGRAMI</span>
				
			</div>
			
		</div>
	
</nav>

<div style="background-color:#D4DCE6;"class="col-12">	



<div class="row" style="height:82vh">
	
	
	
	<div style="text-align:center;" class="col-12">
	<br>
	<br>
		<br>
		<h5 style="color:#black;text-align:center;">İDE EĞİTİM DANIŞMANLIK | KREDİ SİMÜLASYONU</h5>
		<hr>
		<div style="text-align:center;font-size:17px;color:#171717
;"> <span style="font-weight:500">İDE Eğitim Danışmanlık tarafından hazırlanmış olan kredi eğitim simülasyon programına hoş geldiniz.</span> <br><br><span style="color:red;">LÜTFEN, program boyunca karşınıza çıkan sayfalardaki <ins> yönlendirmeleri okumaktan</ins> kaçınmayınız.</span>
		</div>
		<br>
		<div style="margin:auto;" class="col-4">
		<?php
			if(isset($_GET["logout"]))
			{
				if($_GET["logout"] == 'basarili')
				{
					echo '
					<div class="alert alert-success">
					<i class="fa fa-check-circle"></i> Çıkış Yaptınız ! <br> Yönlendiriliyorsunuz..	
				</div>';
					header("Refresh: 2; url=index.php"); 
				}
			}
			
			if(isset($_GET["hata"]))
			{
				if($_GET["hata"] == 'yanlissifre')
				{
					echo '
					<div class="alert alert-danger">
					<i class="fa fa-times-circle-o"></i> Girdiğiniz şifre hatalı !
				</div>
				
					';
				}
				if($_GET["hata"] == 'emailbulunamadi')
				{
					echo '
					<div class="alert alert-danger">
					<i class="fa fa-times-circle-o"></i> Girdiğiniz ID kayıtlı değil !
				</div>
				
					';
				}
				if($_GET["hata"] == 'eksikbilgi')
				{
					echo '
					<div class="alert alert-danger">
					<i class="fa fa-times-circle-o"></i> Giriş bilgileri boş bırakılamaz !
				</div>
			
					';
				}
				if($_GET["hata"] == 'girisyapilmadi')
				{
					echo '
					<div class="alert alert-warning">
					 Lütfen Giriş Yapınız !
				</div>
			
					';
				}
			}
			
			
			?>
		</div>
		<br>
		
		<div style="text-align:center;font-size:17px;color:#171717
;"> Programa devam etmek için lütfen giriş yapınız.<br><i style="font-size:15px;">Giriş bilgileri size yönetici tarafından paylaşılacaktır.</i>
			<br>
			<br>
			<br>
			<div class="col-3" style="text-align:left;margin:auto;font-size:17px;color:#171717;">
			<form action="process.php" method="POST">
				<span style="text-align:left">Kullanıcı Adı:</span><input type="text" name="kullanici_ad" class="form-control" placeholder="Kullanıcı ID" required autofocus="">
				<br>
		<span style="text-align:left">Şifre:</span>
      <input type="password" name="kullanici_sifre" class="form-control" placeholder="Şifre" required>
	<br>
		<div class="col-6" style="text-align:center;margin:auto;font-size:17px;color:#171717;">
      <button style="text-align:center;" class="btn btn-primary" type="submit" name="login">Giriş Yap</button>
				</div>
    </form>
			</div>
			<br>
			<br>
</div>
		</div>
		
	</div>

</div>
  

                  

        <?php include "footer.php"; ?>
<?php ob_end_flush() ?>

