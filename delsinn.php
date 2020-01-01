<?php
	include('session.php');
	$smazat = FALSE;
	$sql = "SELECT id,vlozil FROM hrich where id = ".$_GET['id'];
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
	if ($smazat) {
		$sql = "delete from hrich where id = ".$_GET['id'];
		if ($db->query($sql) === TRUE) {
			$_SESSION['error'] = "Record deleted successfully";
		} else {
			$_SESSION['error'] =  "Error deleting record: " . $db->error;
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