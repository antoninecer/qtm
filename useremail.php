<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_SESSION['admin'] == 1) {
			$hash = $_POST["email"];
			$sql = "update users set email = '".$hash."' where id = ".$_GET['id'];
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
		<h1 align="center">Změna emailu / Change email / Ändern Sie Ihr Email</h1>
		<?php
		$sql = "SELECT id, username, active, admin, email, telefon FROM users where id = ".$_GET['id'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$email = $row["email"];
				$user = $row["id"]. " : " . $row["username"]. " " . $row["email"]." " ;
				echo "<center><h2>".$user."</h2></center> <br>";
			}
		}	
		?>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Změna emailu / Change email / Ändern Sie Ihr Email</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
					</label><input type = "text" name = "email" class = "box" value=<?php echo $email;?> /><br /><br />
					<input type = "submit" value = " Update "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>