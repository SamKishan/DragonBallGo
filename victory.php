<?php
session_start(); 
isset($_REQUEST['user_score'])?$user_score=strip_tags($_REQUEST['user_score']):$user_score="";
isset($_REQUEST['s2'])?$s2=strip_tags($_REQUEST['s2']):$s2="";

        include_once("/var/www/html/project/header.php");
        include_once("/var/www/html/project/connect.php");
	if($s2==6)
	{
		echo "<html>
			<body>
				<center>
					<font size=\"+8\"> YAY! You won <br> You gained $user_score points 
					<a href=/project/game.php?s2=1> Wanna play again?  </a> </font>
				</center>
			</body>
			</html>";
	}
	else
	{
		header("Location: /project/index.php");
	}
?>	
