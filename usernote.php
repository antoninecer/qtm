<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_SESSION['admin'] == 1) {
			$hash = $_POST["popis"];
			$sql = "update users set popis = '".$hash."' where id = ".$_GET['id'];
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
      <?php if($navrat) { header('Location: adduser.php');} ?>
   </head>
   <body>   
		<?php
		include('menuadmin.php');
		?>
		<h1 align="center">Změna popisu / Change description / Ändern Sie Ihr Beschreibung</h1>
		<?php
		$sql = "SELECT id, username, active, admin, email, telefon, popis FROM users where id = ".$_GET['id'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$popis = $row["popis"];
				$user = $row["id"]. " : " . $row["username"]. " " . $row["email"]." ". $popis. " ";
				echo "<center><h2>".$user."</h2></center> <br>";
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