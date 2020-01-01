<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Menur</title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li ><?php echo "<b><i>".$_SESSION['login_user'];?></b></i></li>

   <li><a href='welcome.php'> Domů/Home/Hause </a></li>
   <?php 
   if ($_SESSION['admin'] == 1) {
		echo "<li>"."<a href='adduser.php'> Uživatelé / Users / Nutzer </a></li>";  
	} else { 
		echo "<a href='userpwd.php?id=".$_SESSION['user_id']."'><img src='img/settings16.png' title='Heslo/Password/Passwort' alt='Heslo/Password/Passwort'></a>"; 
	}
?>
   <li><a href='addsinner.php'> Přidání hříšníka/Add Sinner/Neuer Sünder </a></li>
   <li><a href='searchsinner.php'> Hledání/Find/Suchen </a></li>
   
   <li><a href = "logout.php"> Odhlášení/Sign Out/Abmelden </a></li>
</ul>
</div>
<?php
if (isset($_SESSION['error'])) {echo $_SESSION['error'];
$_SESSION['error'] = ""; }
?>
</body>
<html>