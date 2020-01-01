<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$stranka = 'adduser.php';
		if ($_SESSION['admin'] == 1) {
			$hash = md5($_POST["password"]);
			$sql = "update users set passcode ='".$_POST["password"]."' where id = ".$_GET['id'];
			if ($db->query($sql) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error update record: " . $db->error;
			}
		$navrat=TRUE;
		} else {
			$stranka='welcome.php';
			$hash = md5($_POST["password"]);
			$sql = "update users set passcode ='".$_POST["password"]."' where id = ".$_GET['id'];
			if ($db->query($sql) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error update record: " . $db->error;
			}
		$navrat=TRUE;
		
		}
	}
?>
<html>  
   <head>
      <?php if($navrat) { header('Location: '.$stranka);} ?>
   </head>
   <body>   
		<?php
		include('menuadmin.php');
		?>
		<h1 align="center">Změna hesla / Change password / Ändern Sie Ihr Passwort</h1>
		<?php
		$sql = "SELECT id, username, active, admin, email, telefon FROM users where id = ".$_GET['id'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$user = $row["id"]. " : " . $row["username"]. " " . $row["email"]." " . $row["telefon"];
			echo "<center><h2>".$user."</h2></center> <br>";
			}
		}	
		?>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Změna hesla / Change password / Ändern Sie Ihr Passwort</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
					<label>Nové heslo / New Password / Neues Passwort :</label><input type = "password" name = "password" class = "box"/><br /><br />
					<input type = "submit" value = " Update "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>