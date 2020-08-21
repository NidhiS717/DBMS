<html>
	<?php
	session_start();
	?>
<head>
	<title> Page 3 - PHP Sessions </title>
</head>
<body>

	<?php
		$_SESSION["player"] = $_POST['Player'];
		print("<table style = 'border : solid'> <tr> <td> Favorite Team </td> <td> " . $_SESSION["team"] . "</td> </tr>");
		print("<tr> <td>Favorite Player</td> <td> " . $_SESSION["player"] . "</td> </tr> </table> ");
	?>
	<?php
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
	?>
</body>
</html>
