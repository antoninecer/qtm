<?php
	include('session.php');
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_SESSION['admin'] == 1) {
			$hash = $_POST["telefon"];
			$sql = "update users set telefon = '".$hash."' where id = ".$_GET['id'];
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
      <?php if($navrat) { header('Location: adduser.php');} ?>
   </head>
   <body>   
		<?php
		if ($_SESSION['admin'] == 1) { 
		include('menuadmin.php'); } else {include('menu.php');}
		?>
		<h1 align="center">Změna telefonu / Change phone / Ändern Sie Ihr Telefon</h1>
		<?php
		$sql = "SELECT id, username, active, admin, email, telefon FROM users where id = ".$_GET['id'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$tel=$row["telefon"];	
			$user = $row["id"]. " : " . $row["username"]. " " . $row["email"]." " . $row["telefon"];
			echo "<center><h2>".$user."</h2></center> <br>";
			}
		}	
		?>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Telefon/Phone/Telefon</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
					<input type = "text" name = "telefon" value = "<?php echo $tel;?>" class = "box"/><br /><br />
					<input type = "submit" value = " Update "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>