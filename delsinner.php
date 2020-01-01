<?php
	include('session.php');
	$smazat = FALSE;
	$sql = "SELECT id,vlozil FROM hrisnici where id = ".$_GET['id'];
	$result = $db->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$idhrichu = $row["id"];
			$vlozil = $row["vlozil"];
			if ($vlozil == $_SESSION['login_user'] or $_SESSION['admin'] == 1) {
				$smazat = TRUE;
			}
		}
	}	
	$sql = "select id from hrich where id_hrisnika=".$_GET['id'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			$_SESSION['error'] = "Sinner has one or more Sins, this record cannot be deleted";
			$smazat = FALSE;
		}
	if ($smazat) {
		
		
		$sql = "delete from hrisnici where id = ".$_GET['id'];
		if ($db->query($sql) === TRUE) {
			echo "Record deleted successfully";
			$_SESSION['error'] = "Sinner deleted";
		} else {
			echo "Error deleting record: " . $db->error;
		}	
	}
?>
<html>  
   <head>
      <title>Smazání hříchu / Del sinn / Löschen Sünde </title>
	  <meta charset="UTF-8">
	  <?php if ($smazat) {header('Location: searchsinner.php');} else {header('Location: '.$_SERVER['HTTP_REFERER']);} ?>
   </head>
   <body>   
   </body>
</html>