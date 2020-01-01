<?php
include('session.php');
	
	if (empty($_SESSION['queue'])) {
	header("location: selqueue.php"); 
	}
	
	
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['submiter'] == 1) {
		$error = "Přidání tasku";
	} else {
		$error = "Nejsi administrator nebo manager nebo submiter!";
	}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
 
 

   $sql = "insert into task(date,created,duration,queue,name,note,priority) values(now(),'".$_SESSION['login_user']."','".$_POST['duration']."','".$_SESSION['queue']."','".$_POST['nazev']."','".$_POST['popis']."',100)";
    if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['submiter'] == 1) {
		if ($db->query($sql) == TRUE) {
			$_SESSION['error'] =  "New record created successfully";
		} else {
			$_SESSION['error'] = "Error: ". $db->error ." ".$sql;
		}
	} else {
			$error = "Nemas dostatecna prava / You dont have rights / Sie sind kein Administrator";
			$_SESSION['error'] = $error;
    }
   }
   ?>
<html>  
   <head>
      <title>Submiter </title>
	  <meta charset="UTF-8">

   </head>
   <body>   
      <?php include('menuadmin.php'); ?>
	  <h2 align="center">Submiter</h2>
	
	 <br>
	 <table align='center' border=0>
	<?php
	   $radek = 0;
	   echo "<tr style='background-color: #e0e0eb'><td>ID</td><td>Priority</td><td>Date</td><td>Name</td><td>Duration</td><td>Queue</td><td>Note</td><td>Result</td><td>Reason</td></tr>";
   

		$sql = "SELECT t.id,t.priority,t.date,t.name,t.duration,q.name as qname, t.note, t.result,t.reason FROM task t inner join queue q on q.id=t.queue where t.created='".$_SESSION['login_user']."' order by t.priority, t.name";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { echo "<tr style='background-color: #f0f0f5'>"; } else {  echo "<tr style='background-color:  #ffffff'>";}
				
				echo "<tr><td>".$row["id"]."</td>";
				echo "<td>".$row["priority"]."</td>";
				echo "<td>".$row["date"]."</td>";
				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["duration"]."</td>";
				echo "<td>".$row["qname"]."</td>";
				echo "<td>".$row["note"]."</td>";
				echo "<td>".$row["result"]."</td>";
				echo "<td>".$row["reason"]."</td>";
				echo "</tr>";
				
			}	
		}
	?> 
	<h2 align="center"><?php 
$sql = 'select name from queue where id='.$_SESSION['queue'];
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$queuename=$row["name"];}	
}
echo $queuename;
?></h2>
	</table>
	<br>
		 <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Přidání úkolu / Add new task / neuer Aufgaben</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post" id="task">
                  <label>Name  :<br></label><input type = "text" name = "nazev" class = "box"/><br />
                  <label>Note  :<br></label><textarea name="popis" form="task"></textarea><br />
				  <label>Duration  :<br></label><input type = "text" name = "duration" class = "box"/><br />
                  <input type = "submit" value = " Submit "/>
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>
		

		
   </body>
   
</html>