<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_SESSION['admin'] == 1) {
			$hash = $_POST["popis"];
			$sql = "update hrichy set popis = '".$hash."' where nazev = '".$_GET['nazev']."'";
			//echo $sql;
			if ($db->query($sql) === TRUE) {
				$_SESSION['error'] =  "Record updated successfully";
			} else {
				$_SESSION['error'] =  "Error update record: " . $db->error;
			}
		$navrat=TRUE;
		}	
	}
?>
<html>  
   <head>
      <?php if($navrat) { header('Location: sinns.php');} ?>
	  <title>description </title>
   </head>
   <body>   
		<?php
		include('menuadmin.php');
		?>
		<h1 align="center">Změna popisu / Change description / Ändern Sie Ihr Beschreibung</h1>
		<?php
		$sql = "SELECT nazev, popis FROM hrichy where nazev = '".$_GET['nazev']."'";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$popis = $row["popis"];
				$hrich = $row["nazev"]." ". $popis. " ";
				echo "<center><h2>".$hrich."</h2></center> <br>";
			}
		}	
		?>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Změna popisu / Change note / Ändern Sie Ihr Beschreibung</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post"id="popis">
					Popis/Note/Beschreibung
				  <textarea name="popis" form="popis"><?php echo $popis;?></textarea>
					<input type = "submit" value = " Update "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>