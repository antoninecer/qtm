<?php
include('session.php');
	
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['tester'] == 1) {
		$error = "Vykonání tasku";
	} else {
		$error = "Nejsi administrator nebo manager nebo tester!";
	}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
 		
		
	if ($_POST["action"]=="start"){
		$sql = "update task set started=now(),solver='".$_SESSION["login_user"]."' where id=".$_POST['rowid'];
		if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['tester'] == 1) {
			if ($db->query($sql) == TRUE) {
				$_SESSION['error'] =  "Record updated successfully";
			} else {
				$_SESSION['error'] = "Error: ". $db->error ." ".$sql;
			}
		} else {
		$error = "Nemas dostatecna prava / You dont have rights / Sie sind kein Administrator";
		$_SESSION['error'] = $error;
		}
	}
	if ($_POST["action"]=="finish"){
		$sql = "update task set finished=now(),result='OK', reason='DONE' , active=0 where id=".$_POST['rowid'];
		if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['tester'] == 1) {
			if ($db->query($sql) == TRUE) {
				$_SESSION['error'] =  "Record updated successfully";
			} else {
				$_SESSION['error'] = "Error: ". $db->error ." ".$sql;
			}
		} else {
		$error = "Nemas dostatecna prava / You dont have rights / Sie sind kein Administrator";
		$_SESSION['error'] = $error;
		}
	}
	if ($_POST["action"]=="trabl"){
		$sql = "update task set finished=now(),result='NOT OK', reason='".$_POST["popis"]."' , active=0 where id=".$_POST['rowid'];
		if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['tester'] == 1) {
			if ($db->query($sql) == TRUE) {
				$_SESSION['error'] =  "Record updated successfully";
			} else {
				$_SESSION['error'] = "Error: ". $db->error ." ".$sql;
			}
		} else {
		$error = "Nemas dostatecna prava / You dont have rights / Sie sind kein Administrator";
		$_SESSION['error'] = $error;
		}
	}
   }
   ?>
<html>  
   <head>
      <title>tester </title>
	  <meta charset="UTF-8">
   </head>
   <body>   
      <?php include('menuadmin.php'); ?>
	  <h2 align="center">Tester</h2>
	  
	
	 <br>
	 <table align='center' border=0>
	<?php
	echo (new \DateTime())->format('Y-m-d H:i:s');
	   $radek = 0;
	   echo "<tr style='background-color: #e0e0eb'><td>ID</td><td>Date</td><td>Name</td><td>Duration</td><td>Queue</td><td>Note</td><td>Result</td><td>Reason</td><td>Started</td><td>Finished</td></tr>";
		$sql = "SELECT * FROM task where queue=".$_SESSION['queue']." and active=1 and (solver is null or solver='".$_SESSION["login_user"]."') order by priority, id limit 1";
		//print($sql);
		
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { echo "<tr style='background-color: #f0f0f5'>"; } else {  echo "<tr style='background-color:  #ffffff'>";}
				$rowid = $row["id"];
				echo "<tr><td>".$row["id"]."</td>";
				
				echo "<td>".$row["date"]."</td>";
				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["duration"]."</td>";
				echo "<td>".$row["queue"]."</td>";
				echo "<td>".$row["note"]."</td>";
				echo "<td>".$row["result"]."</td>";
				echo "<td>".$row["reason"]."</td>";
				echo "<td>".$row["started"]."</td>";
				$start = $row["started"];
				echo "<td>".$row["finished"]."</td>";
				echo "</tr>";
				
			}	
		}
	?> 
	</table>
	<?php
	if (empty($start)) {
		echo "<form action = '' method = 'post' id ='start'>";
        echo "<input type='hidden' id='start' name='rowid' value='".$rowid."'>";
		echo "<input type='hidden' id='start' name='action' value='start'>";
		echo "<input type = 'submit' value = ' Start '/></form>";
		
		}
	else{
		echo "<form action = '' method = 'post' id ='finish'>";
        echo "<input type='hidden' id='finish' name='rowid' value='".$rowid."'>";
		echo "<input type='hidden' id='finish' name='action' value='finish'>";
		echo "<input type = 'submit' value = ' Passed OK '/></form>";
		
		echo "<form action = '' method = 'post' id ='trabl'>";
        echo "<input type='hidden' id='trabl' name='rowid' value='".$rowid."'>";
		echo "<input type='hidden' id='trabl' name='action' value='trabl'>";
		echo "<label>Problem  :<br></label><textarea name='popis' form='trabl'></textarea><br/>";
		echo "<input type = 'submit' value = ' Not OK '/></form>";
		
		}

	
   ?>
   </body>
   
</html>