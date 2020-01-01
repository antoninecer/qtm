<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form $_POST['active'].",".$_POST['admin']
		if ($_SESSION['admin'] == 1) {
			$sql = "delete from users  where id = ".$_GET['id'];
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
      <?php if($navrat) { header('Location: adduser.php');} ?>
   </head>
   <body>   
		<?php
		include('menuadmin.php');
		?>
		<h1 align="center">Smazání uživatele / Delete user / Benutzer löschen?</h1>
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Smazání uživatele / Delete user / Benutzer löschen</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <input type = "submit" value = " Delete "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>