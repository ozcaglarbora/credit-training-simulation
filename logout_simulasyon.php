<?php

//logout.php

session_start();

session_destroy();

header("location:simulasyon_anasayfa.php");

?>