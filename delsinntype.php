<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form $_POST['active'].",".$_POST['admin']
		if ($_SESSION['admin'] == 1) {
			$sql = "delete from hrichy  where nazev = '".$_GET['nazev']."'";
			if ($db->query($sql) === TRUE) {
				$_SESSION['error'] =  "Record deleted successfully";
			} else {
				$_SESSION['error'] =  "Error : " . $db->error;
			}
		$navrat=TRUE;
		}	
	}
?>
<html>  
   <head>
      <?php if($navrat) { header('Location: sinns.php');} ?>
   </head>
   <body>   
		<?php
		include('menuadmin.php');
		?>
		<h1 align="center"> Smazání typy hříchu / Delete Type of sins / Benutzer Arten von Sünden</h1>
		<?php
		$sql = "SELECT nazev,popis FROM hrichy where nazev = '".$_GET['nazev']."'";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$hrich = $row["nazev"]. " : " . $row["popis"];
			echo "<center><h2>".$hrich."</h2></center> <br>";
			}
		}	
		?>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Smazání typy hříchu / Delete Type of sins / Benutzer Arten von Sünden</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <input type = "submit" value = " Delete "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>