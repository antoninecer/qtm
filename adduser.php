<?php
	include('session.php');
	
	if ($_SESSION['admin'] == 1) {
		$error = "Přidání uživatele";
	} else {
		$error = "Nejsi administrator!";
	}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
   if (isset($_POST['active'])) {
		$active = 1;
	}	
	else { 
		$active = 0;
	}
	if (isset($_POST['admin'])) {
		$admin = 1;
	}
	else { 
		$admin = 0;
	}
	if (isset($_POST['manager'])) {
		$manager = 1;
	}
	else { 
		$manager = 0;
	}
	if (isset($_POST['submiter'])) {
		$submiter = 1;
	}
	else { 
		$submiter = 0;
	}
		if (isset($_POST['tester'])) {
		$tester = 1;
	}
	else { 
		$tester = 0;
	}
    $sql = "insert into users(username,passcode,popis,active,admin,manager,submiter,tester,email,telefon,inserted,date) values('".$_POST['username']."','".$_POST['passcode']."','".$_POST['popis']."',".$active.",".$admin.",".$manager.",".$submiter.",".$tester.",'".$_POST['email']."','".$_POST['telefon']."','".$_SESSION['login_user']."',now())";
    if ($_SESSION['admin'] == 1) {
		if ($db->query($sql) == TRUE) {
			$_SESSION['error'] =  "New record created successfully";
		} else {
			$_SESSION['error'] = "Error: ". $db->error;
		}
	} else {
			$error = "Nejsi administrator! / You dont have administrator's rights / Sie sind kein Administrator";
			$_SESSION['error'] = $error;
    }
   }
?>
<html>  
   <head>
      <title>Přidání uživatele / Add new user / neuer Nutzer </title>
	  <meta charset="UTF-8">
   </head>
   <body>   
      <?php include('menuadmin.php'); ?>
	  <h2 align="center">Uživatelé / Users / Benutzer </h2>
	    <?php
	   $radek = 0;
	   echo "<table align='center' border=0>";
	   echo "<tr style='background-color: #e0e0eb'><td>login</td><td>note</td><td>active</td><td>admin</td><td>manager</td><td>submiter</td><td>tester</td><td>Phone</td><td>Email</td><td>del</td><td>pwd</td><td>queue</td></tr>";
   
	
		$sql = "SELECT id, username, active, admin, manager, submiter, tester, email, telefon, popis, queue FROM users order by username";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { echo "<tr style='background-color: #f0f0f5'>"; } else {  echo "<tr style='background-color:  #ffffff'>";}
				
				echo "<tr><td>".$row["username"]."</td><td>";
				
				echo $row["popis"]."<a href='usernote.php?id=".$row["id"]."'><img src='img/edit16.png' title='Popis/Note/Beschreibung' alt='Popis/Note/Beschreibung'></a></td><td>";
				if ($row["username"] == $_SESSION['login_user']) {echo "<img src='img/user16.png'>";} else {
				if ($row["active"] == 1) { echo "<a href='deactivateuser.php?id=".$row["id"]."'><img src='img/check16.png' title='Deaktivace/Deactive/Deaktivieren' alt='Deaktivace/Deactive/Deaktivieren'></a>";} 
					else {echo "<a href='activateuser.php?id=".$row["id"]."'><img src='img/cancel16.png' title='Aktivace/Active/Aktivieren' alt='Aktivace/Active/Aktivieren'></a>";}
				}
				echo "</td><td>";
				if ($row["username"] == $_SESSION['login_user']) {echo "<img src='img/user16.png' title='NO' alt='NO'>";} else {
					if ($row["admin"] == 1) { echo "<a href='deadminuser.php?id=".$row["id"]."'><img src='img/check16.png' title='Deaktivace/Deactive/Deaktivieren' alt='Deaktivace/Deactive/Deaktivieren'></a>";} 
					else {echo "<a href='adminuser.php?id=".$row["id"]."'><img src='img/cancel16.png' title='Aktivace/Active/Aktivieren' alt='Aktivace/Active/Aktivieren'></a>";}
				}
				echo "</td><td>";
				if ($row["manager"] == 1) { echo "<a href='demanageruser.php?id=".$row["id"]."'><img src='img/check16.png' title='Deaktivace/Deactive/Deaktivieren' alt='Deaktivace/Deactive/Deaktivieren'></a>";} 
					else {echo "<a href='manageruser.php?id=".$row["id"]."'><img src='img/cancel16.png' title='Aktivace/Active/Aktivieren' alt='Aktivace/Active/Aktivieren'></a>";}
				echo "</td><td>";
				if ($row["submiter"] == 1) { echo "<a href='desubmiteruser.php?id=".$row["id"]."'><img src='img/check16.png' title='Deaktivace/Deactive/Deaktivieren' alt='Deaktivace/Deactive/Deaktivieren'></a>";} 
					else {echo "<a href='submiteruser.php?id=".$row["id"]."'><img src='img/cancel16.png' title='Aktivace/Active/Aktivieren' alt='Aktivace/Active/Aktivieren'></a>";}
				echo "</td><td>";
				if ($row["tester"] == 1) { echo "<a href='detesteruser.php?id=".$row["id"]."'><img src='img/check16.png' title='Deaktivace/Deactive/Deaktivieren' alt='Deaktivace/Deactive/Deaktivieren'></a>";} 
					else {echo "<a href='testeruser.php?id=".$row["id"]."'><img src='img/cancel16.png' title='Aktivace/Active/Aktivieren' alt='Aktivace/Active/Aktivieren'></a>";}	
				echo "</td><td>".$row["telefon"]."<a href='usertel.php?id=".$row["id"]."'><img src='img/edit16.png' title='Telefon/Phone/Telefon' alt='Telefon/Phone/Telefon'></a>";
				echo "</td><td>".$row["email"]."<a href='useremail.php?id=".$row["id"]."'><img src='img/edit16.png' title='Email' title='Email'></a></td>";
				echo "<td>";
				if ($row["username"] == $_SESSION['login_user']) {echo "<img src='img/user16.png' title='NO' alt='NO'>";} else { echo "<a href='deluser.php?id=".$row["id"]."'><img src='img/delete16.png' title='Smazat/Delete/Löschen'></a>";} 
				echo "</td>";
				
				echo "<td><a href='userpwd.php?id=".$row["id"]."'><img src='img/edit16.png' title='Heslo/Password/Passwort'></a></td>";
				echo "<td>".$row['queue']."</td></tr>";
				}	
		}
	?> 
	</table>
	  <h2 align="center">Přidání uživatele / Add new user / neuer Nutzer </h2>
	  
		 <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Přidání uživatele / Add new user / neuer Nutzer</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Login  :</label><input type = "text" name = "username" class = "box"/><br />
                  <label>Heslo  :</label><input type = "text" name = "passcode" class = "box" /><br />
                  <label>Popis  :</label><input type = "text" name = "popis" class = "box" /><br />
                  <label>Active :</label><input type = "checkbox" name = "active" class = "box" checked /><br />
                  <label>Admin :</label><input type = "checkbox" name = "admin" class = "box" /><br />
				  <label>Manager :</label><input type = "checkbox" name = "manager" class = "box" /><br />
				  <label>Submiter :</label><input type = "checkbox" name = "submiter" class = "box" /><br />
				  <label>Tester :</label><input type = "checkbox" name = "tester" class = "box" /><br />
                  <label>Email  :</label><input type = "text" name = "email" class = "box" /><br />
                  <label>Telefon  :</label><input type = "text" name = "telefon" class = "box" /><br />
                  <input type = "submit" value = " Submit "/>
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>	  
   </body>
   
</html>