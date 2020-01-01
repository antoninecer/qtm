<?php
	include('session.php');
	
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1) {
		$error = "Přidání typu tasku";
	} else {
		$error = "Nejsi administrator nebo manager!";
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
	
   $sql = "insert into tasktypes(name,note,priority) values('".$_POST['nazev']."','".$_POST['popis']."',".$_POST['priorita'].")";
    if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1) {
		if ($db->query($sql) == TRUE) {
			$_SESSION['error'] =  "New record created successfully";
		} else {
			$_SESSION['error'] = "Error: ". $db->error ." ".$sql;
		}
	} else {
			$error = "Nejsi administrator! / You dont have administrator's rights / Sie sind kein Administrator";
			$_SESSION['error'] = $error;
    }
   }
?>
<html>  
   <head>
      <title>Typy úkolů / Task types / Arten von Aufgaben </title>
	  <meta charset="UTF-8">
   </head>
   <body>   
      <?php include('menuadmin.php'); ?>
	  <h2 align="center">Typy úkolů / Task types / Arten von Aufgaben</h2>
	    <?php
	   $radek = 0;
	   echo "<table align='center' border=0>";
	   echo "<tr style='background-color: #e0e0eb'><td>Priority</td><td>name</td><td>description</td><td>del</td></tr>";
   
 
  
		$sql = "SELECT name, note, priority FROM tasktypes order by priority, name";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { echo "<tr style='background-color: #f0f0f5'>"; } else {  echo "<tr style='background-color:  #ffffff'>";}
				
				echo "<tr><td>".$row["priority"]."</td>";
				echo "<td>".$row["name"]."</td><td>";
				echo $row["note"]."<a href='tasktypenote.php?nazev=".$row["name"]."'><img src='img/edit16.png' title='Popis/Note/Beschreibung' alt='Popis/Note/Beschreibung'></a></td>";
				
				echo "<td>";
				echo "<a href='deltasktype.php?nazev=".$row["name"]."'><img src='img/delete16.png' title='Smazat/Delete/Löschen'></a>";} 
				echo "</td>	</tr>";
				
				}	
	?> 
	</table>
	
	 <br>
		 <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Přidání typu úkolu / Add new task type / neuer Arten von Aufgaben</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post" id="taktype">
                  <label>Name  :<br></label><input type = "text" name = "nazev" class = "box"/><br />
				  <label>Priority  :<br></label><input type = "text" name = "priorita" class = "box"/><br />
                  <label>Note  :<br></label><textarea name="popis" form="taktype"></textarea><br />
                  <input type = "submit" value = " Submit "/>
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>
		
   </body>
   
</html>