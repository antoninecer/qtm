<?php
   include('session.php');
   $_SESSION['id_hrisnik'] = $_GET['id'];
   $_SESSION['volano'] = $_SERVER['HTTP_REFERER'];
   $error = "Přidání hříchu";
$sql = "SELECT popis from hrichy order by nazev";
$stupnice = $db->query($sql);
$hrich = array();
$i = 0;
while($hr = mysqli_fetch_array($stupnice))
{
    $hrich[$i] = $hr['popis'];
	$i = $i + 1;
	}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST['h1'])) { $h1 = 1; } else { $h1=0; } 
     if (isset($_POST['h2'])) { $h2 = 1; } else { $h2=0; } 
     if (isset($_POST['h3'])) { $h3 = 1; } else { $h3=0; } 
     if (isset($_POST['h4'])) { $h4 = 1; } else { $h4=0; } 
     if (isset($_POST['h5'])) { $h5 = 1; } else { $h5=0; } 
     if (isset($_POST['h6'])) { $h6 = 1; } else { $h6=0; } 
     if (isset($_POST['h7'])) { $h7 = 1; } else { $h7=0; } 
     if (isset($_POST['h8'])) { $h8 = 1; } else { $h8=0; } 
     if (isset($_POST['h9'])) { $h9 = 1; } else { $h9=0; } 
     if (isset($_POST['h10'])) { $h10 = 1; } else { $h10=0; } 

   // username and password sent from form 
	  //SELECT ifnull(max(id),0) as id FROM `hrich` WHERE id_hrisnika = 1 
      $sql = "insert into hrich(id_hrisnika,h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,popis,vlozil,datum) values(".$_POST['id'];
	  $sql = $sql.",".$h1.",".$h2.",".$h3.",".$h4.",".$h5.",".$h6.",".$h7.",".$h8.",".$h9.",".$h10.",'";
	  $sql = $sql.$_POST['popis']."','".$_SESSION['login_user']."',now())";
	    
		  if ($db->query($sql) == TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $db->error;
				}
	  
   }
   
?>
<html>
   
   <head>
      <title>Sinner </title>
	  <meta charset="UTF-8">
   </head>
   
   <body>
   <?php include('menu.php'); ?>
	  <h1>Hříšník / Sinner / Sünder</h1>
	  <?php
		$sql = "SELECT id, jmeno, prijmeni, narozeni, vlozil,overeni FROM hrisnici where id=".$_GET['id'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$hrisnik = $row["jmeno"]. " " . $row["prijmeni"]." ". date("d-m-Y", strtotime($row["narozeni"]));
				$vlozil = $row["vlozil"];
				echo "<b><big>".$hrisnik."</big> </b><i>"."  Checked: ".$row["overeni"]." : </i>";
				if ($vlozil == $_SESSION['login_user'] or $_SESSION['admin'] == 1) {
					echo "<a href='delsinner.php?id=".$_GET["id"]."'><img src='img/delete16.png' alt='Smazáni hříšníka / Delete sinner / Löschen Sünder '></a><br><br>";  
				}
			echo "<br>";
			} 
		}
		$sql = "SELECT id,vlozil, datum, h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,popis FROM hrich where id_hrisnika = ".$_GET['id']." order by id desc";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idhrichu = $row["id"];
				$vlozil = $row["vlozil"];
				$datum = $row["datum"];
				$h1 = $row["h1"];
				$h2 = $row["h2"];
				$h3 = $row["h3"];
				$h4 = $row["h4"];
				$h5 = $row["h5"];
				$h6 = $row["h6"];
				$h7 = $row["h7"];
				$h8 = $row["h8"];
				$h9 = $row["h9"];
				$h10 = $row["h10"];
				$popis = $row["popis"];
				echo "<big><i>Vložil/Inserted/Eingereicht : <b>".$vlozil." </b> </big>".date("d-m-Y", strtotime($datum))."</i>";
				
				if ($vlozil == $_SESSION['login_user'] or $_SESSION['admin'] == 1) {
					//echo " <a href='delsinn.php?id=".$idhrichu."'>Smazáni hříchu / Delete sinn / Löschen Sünde </a>";  
					echo "<a href='delsinn.php?id=".$idhrichu."' ><img src='img/delete16.png' alt='Smazáni hříchu / Delete sinn / Löschen Sünde'></a>";  
				}
				echo "<br>";
				if ($h1 == 1) { echo $hrich[0]."<br>";}
				if ($h2 == 1) { echo $hrich[1]."<br>";}
				if ($h3 == 1) { echo $hrich[2]."<br>";}
				if ($h4 == 1) { echo $hrich[3]."<br>";}
				if ($h5 == 1) { echo $hrich[4]."<br>";}
				if ($h6 == 1) { echo $hrich[5]."<br>";}
				if ($h7 == 1) { echo $hrich[6]."<br>";}
				if ($h8 == 1) { echo $hrich[7]."<br>";}
				if ($h9 == 1) { echo $hrich[8]."<br>";}
				if ($h10 == 1) { echo $hrich[9]."<br>";}
				echo $popis."<br><hr>";
		}
}
?>
 <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Nový hřích/new sinn/eine neue Sünde</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post" id="hrich">
				  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
				  <label><?php echo $hrich[0]; ?> :</label><input type = "checkbox" name = "h1" class = "box"  /><br/><br />
				  <label><?php echo $hrich[1]; ?> :</label><input type = "checkbox" name = "h2" class = "box"  /><br/><br />
				  <label><?php echo $hrich[2]; ?> :</label><input type = "checkbox" name = "h3" class = "box"  /><br/><br />
				  <label><?php echo $hrich[3]; ?> :</label><input type = "checkbox" name = "h4" class = "box"  /><br/><br />
				  <label><?php echo $hrich[4]; ?> :</label><input type = "checkbox" name = "h5" class = "box"  /><br/><br />
				  <label><?php echo $hrich[5]; ?> :</label><input type = "checkbox" name = "h6" class = "box"  /><br/><br />
				  <label><?php echo $hrich[6]; ?> :</label><input type = "checkbox" name = "h7" class = "box"  /><br/><br />
				  <label><?php echo $hrich[7]; ?> :</label><input type = "checkbox" name = "h8" class = "box"  /><br/><br />
				  <label><?php echo $hrich[8]; ?> :</label><input type = "checkbox" name = "h9" class = "box"  /><br/><br />
                  <!-- //
					<label>Jiný  :</label><input type = "text" name = "popis" class = "box" /><br/><br />
					// -->
					Popis/Note/Beschreibung
				  <textarea name="popis" form="hrich"></textarea>
                  <input type = "submit" value = " Submit "/><br />
               </form>
			   
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>	  
<hr>
   </body>
   
</html>