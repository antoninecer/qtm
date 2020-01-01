<?php
	include('session.php');
		
	if ($_SESSION['admin'] == 1) {
		$sql = "update users set admin=1 where id = ".$_GET['id'];
		if ($db->query($sql) === TRUE) {
			$_SESSION['error'] =  "Record updated successfully";
			
		} else {
			$_SESSION['error'] =  "Error : " . $db->error;
		}	
	}
?>
<html>  
   <head>
      <?php header('Location: '.$_SERVER['HTTP_REFERER']); ?>
   </head>
   <body>   
      	  
   </body>
   
</html>