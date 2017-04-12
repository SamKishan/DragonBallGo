<?php 
isset($_REQUEST['s'])?$s=strip_tags($_REQUEST['s']):$s="";
isset($_REQUEST['series_id'])?$series_id=strip_tags($_REQUEST['series_id']):$series_id="";
isset($_REQUEST['char_id'])?$char_id=strip_tags($_REQUEST['char_id']):$char_id="";
	include_once("/var/www/html/project/header.php");
	include_once("/var/www/html/project/connect.php");
	connect($db);
	#echo "<center>";
	switch($s)
	{

		case 10:
				$query="SELECT character_name,character_pic,character_desc,character_id from  DBZ.characters";
				$result=mysqli_query($db,$query);
				echo "<table border=\"1\"> <tr><th>Name of character</th> <th> Image</th><th>Short description</th> </tr>"; 
				
				while($row=mysqli_fetch_row($result))
				{
					echo "<tr><th><a href=/project/index.php?s=11&char_id=$row[3]>  $row[0]</th> <th><img src= $row[1]> </th> <th>$row[2]</th> </tr>";
				}
				echo "</table>";
				break;
	
		case 11:	
			$query="select distinct(saga_name) from saga, appears, characters  where  appears.saga_id=saga.saga_id and appears.character_id=$char_id";
			echo "<html><body><center><table border=\"+1\">";
			echo "<tr><th>Saga appearances</th></tr>";
			if($stmt=mysqli_prepare($db,"select distinct(saga_name) from DBZ.saga, DBZ.appears, DBZ.characters  where  DBZ.appears.saga_id=DBZ.saga.saga_id and DBZ.appears.character_id=?"))
			{
				mysqli_stmt_bind_param($stmt,"s",$char_id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt,$saga_name);
				while(mysqli_stmt_fetch($stmt))
				{
					echo"<tr><th>  $saga_name</th></tr>" ;
				}

				mysqli_stmt_close($stmt);
			}					
			echo "</center></body></html>";

				break;
		case 1:
				#SERIES PAGE
				$query="SELECT  series_name,series_id from DBZ.series";
				echo "<table border=\"1\">  <tr><th> <font size=\"+3\">Names of the series</font> </th></tr> ";
				$result=mysqli_query($db,$query);
				while($row=mysqli_fetch_row($result))
				{
			
						echo "<tr><th><a href=/project/index.php?s=2&series_id=$row[1]> $row[0]</a> </th></tr>";
				}
					
			
				break;
	

		case 2:		#SAGA page.
				
				#echo "Series id is $series_id";
				$query="SELECT saga_name from DBZ.saga where saga.series_id=$series_id";
				$result=mysqli_query($db,$query);
				echo "<table border=\"+1\"> <tr><th> <font size=\"+3\">Names of sagas </font> </th></tr>";
				while($row=mysqli_fetch_row($result))
				{ 
					echo "<tr><th> $row[0]</th></tr> ";
				
				}
				break;

		case 50:
				echo "<center> <form method=\"post\" action=/project/add.php>";
				echo "Enter name: <input type=\"text\" name=\"user_name\"> <br>";
				echo "Enter password: <input type=\"password\" name=\"user_password\"> <br>";
				echo "<input type=\"Submit\" name=\"Submit\" value=\"Submit\">";

			

				break;


		case 51:
                                echo "<center> <form method=\"post\" action=/project/add.php>";
                                echo "Enter name: <input type=\"text\" name=\"user_name\"> <br>";
                                echo "Enter password: <input type=\"password\" name=\"user_password\"> <br>";
                                echo "<input type=\"Submit\" name=\"Submit\" value=\"Submit\">";



                                break;
	
		default: 
				echo " <br><br><br><br><font size=\"+5\"> <center>  DragonBallGo </center> </font>";
				break;
	}

	echo "</body></html>";
?>
