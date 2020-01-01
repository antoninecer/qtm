<?php
	include('session.php');
		
	if ($_SESSION['admin'] == 1) {
		$sql = "update users set active=0 where id = ".$_GET['id'];
		if ($db->query($sql) === TRUE) {
			$_SESSION['error'] =  "Record updated successfully";
		} else {
			$_SESSION['error'] =  "Error : " . $db->error;
		}	
	}
?>
<html>  
   <head>
      <title>Smazání hříchu / Del sinn / Löschen Sünde </title>
	  <meta charset="UTF-8">
	  <?php header('Location: '.$_SERVER['HTTP_REFERER']); ?>
   </head>
   <body>   
      	  
   </body>
   
</html>