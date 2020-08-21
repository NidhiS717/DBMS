<html>
	<?php
		session_start();
	?>
<head>
	<title> Page 2 - PHP Sessions </title>
</head>
<body>

	<form method = "post" action = "Page3.php">
		Enter the Name of your favorite Player : <input name = "Player" />
		<br>
		<br>
		<button>Submit </button>
	<?php
		$_SESSION["team"] = $_POST['Team'];
	?>
</body>
</html>
		
