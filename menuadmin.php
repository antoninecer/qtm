<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles1.css">
   <script src="jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Menur</title>
</head>
<body>
<?php 
$sql = 'select name from queue where id='.$_SESSION['queue'];
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$queuename=$row["name"];}	
}

?>
<div id='cssmenu'>
<ul>
   <li ><b><i><?php echo $_SESSION['login_user']." <a href='selqueue.php' > [".$queuename."]</a>";?></b></i></li>

   <li><a href='welcome.php'> Domů/Home/Hause </a></li>
   <?php 
	if ($_SESSION['admin'] == 1) {
		echo "<li>"."<a href='adduser.php'> Uživatelé / Users / Nutzer </a></li>"; 
	}
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1) {
		echo "<li>"."<a href='queue.php'> nové fronty / New Queue / NeueWarteschlange </a></li>";
		echo "<li>"."<a href='showqueue.php'> Fronty / Queue / Warteschlange </a></li>";
		echo "<li>"."<a href='tasktypes.php'> Typy úkolů / Task types / Arten von Aufgaben </a></li>";
	}
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['submiter'] == 1) {
		echo "<li>"."<a href='submiter.php'> Vklad úlohy / Insert task / Job einfügen </a></li>";
	}
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1 or $_SESSION['tester'] == 1) {
		echo "<li>"."<a href='tester.php'> Řešení úloh / Solving task / Problemlösung </a></li>";
	}
?>
   <li><a href = "selqueue.php"> Assign queue </a></li>
   <li><a href = "logout.php"> Odhlášení/Sign Out/Abmelden </a></li>
   
</ul>
</div>
<?php
if (isset($_SESSION['error'])) {echo $_SESSION['error'];
$_SESSION['error'] = ""; }
?>
</body>
<html>