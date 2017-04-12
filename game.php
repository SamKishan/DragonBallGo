<?php 
session_start();

isset($_REQUEST['s2'])?$s2=strip_tags($_REQUEST['s2']):$s2="";
isset($_REQUEST['select'])?$select=strip_tags($_REQUEST['select']):$select="";
isset($_REQUEST['sel2'])?$sel2=strip_tags($_REQUEST['sel2']):$sel2="";
isset($_REQUEST['attack_id'])?$attack_id=strip_tags($_REQUEST['attack_id']):$attack_id="";
isset($_REQUEST['bot_id'])?$bot_id=strip_tags($_REQUEST['bot_id']):$bot_id="";
isset($_REQUEST['user_id'])?$user_id=strip_tags($_REQUEST['user_id']):$user_id="";


include_once("/var/www/html/project/header.php");
include_once("/var/www/html/project/connect.php");
connect($db);
$user_id=$_SESSION['userid'];
switch ($s2)
{	
	default:
			echo "<center> Welcome to the DBZ game.";
			if($user_id==1)
			{
				echo " <br> Admin privileges";
				header ("Location: /project/admin.php");
			}
			else
			{
				$user_id=$_SESSION['userid'];
				echo "Choose your character";
				$query="SELECT DBZ.characters.character_id,DBZ.characters.character_name from DBZ.characters";
				$result=mysqli_query($db,$query);
			
				echo "<form method=post action=/project/game.php> <select id=\"select\" name=\"select\">";
				while($row=mysqli_fetch_row($result))
				{
					echo "<option value=$row[0]>$row[1]</option>";

					
				}
				echo "</select>";
				echo "<input type=\"hidden\" name=\"s2\" value=2>";
				echo "<input type=\"hidden\" name=\"user_id\" value=$user_id>";
				echo "<input type=\"Submit\" name=\"Submit\" value=\"Submit\">";
			
			}

			echo " </center>";
			break;

	case 2: 	echo "<center> Here now ";
			echo "<br> select is $select";
			$query="select DBZ.attacks.attack_id,DBZ.attacks.attack_name from DBZ.attacks where DBZ.attacks.char_id=$select";
			$result=mysqli_query($db,$query);
			echo "<form method=post action=/project/game.php> <select id=\"sel2\" name=\"sel2\">";
			while($row=mysqli_fetch_row($result))
			{
				echo "<option value=$row[0]> $row[1] </option>";

			}
			echo "</select>
				<input type=\"hidden\" name=\"s2\" value=3>
				<input type=\"hidden\" name=\"user_id\" value=$user_id>

				<input type=\"hidden\" name=\"select\" value=$select>
				<input type=\"Submit\" name=\"Submit\" value=\"Submit\">";
			echo "</center>";
			break;


	case 3:
			echo "<br> Select is $select";
			echo "<br> Sel2 is $sel2";
			                        $query="SELECT count(DBZ.characters.character_id) from DBZ.characters";
                        $result=mysqli_query($db,$query);
                        while($row=mysqli_fetch_row($result))
                        {
                                $count=$row[0];
                                break;

                        }
                        $bot_id=rand(0,$count);
			echo "<br> bot id is $bot_id";
                        echo "<form method=post action=/project/game.php>
                                <input type=\"hidden\" name=\"s2\" value=4>
                                <input type=\"hidden\" name=\"select\" value=$select>
                                <input type=\"hidden\" name=\"bot_id\" value=$bot_id> 
				<input type=\"hidden\" name=\"sel2\" value=$sel2>
				<input type=\"hidden\" name=\"user_id\" value=$user_id>

				<input type=\"Submit\" name=\"Submit\" value=\"Submit\"> </form>";


                        break;

        case 4:
			echo "<center> <br> s2= $s2 <br>";
                        echo "<br> bot_id =$bot_id";
			$query="select count(DBZ.attacks.attack_name) from DBZ.attacks where DBZ.attacks.char_id=$bot_id";
                        $result=mysqli_query($db,$query);
                        while($row=mysqli_fetch_row($result))
                        {
                                $count=$row[0];
                                break;
                        }
                        echo "<br> count is $count";
			$attack_id=rand(1,count);
                        $query="select DBZ.attacks.attack_id,DBZ.attacks.attack_name from DBZ.attacks where DBZ.attacks.char_id=$bot_id";
			$result="";
			$row="";
			echo "<br> part 1 attack id =$attack_id";
			$result=mysqli_query($db,$query);
			$i=0;
			while($row=mysqli_fetch_row($result) and $i!=$count)
			{
					$attack_id=$row[0];
			}
			echo "<br> part 2 attack id=$attack_id";
                        echo "<form method=post action=/project/game.php>
                                <input type=\"hidden\" name=\"s2\" value=5>
                                <input type=\"hidden\" name=\"select\" value=$select>
                                <input type=\"hidden\" name=\"bot_id\" value=$bot_id> 
                   		<input type=\"hidden\" name=\"attack_id\" value=$attack_id> 
				<input type=\"hidden\" name=\"sel2\" value=$sel2>
				<input type=\"hidden\" name=\"user_id\" value=$user_id>

				<input type=\"Submit\" name=\"Submit\" value=\"Submit\">
				</form></center> ";

                        break;

	case 5:
			echo "<br> bot attack id is $attack_id";
			echo "<br> bot id is $bot_id";
			echo "<br> your character id is $select";
			echo "<br> your character's attack id is $sel2";
			#Let's get BOT's damage
			$query="SELECT DBZ.attacks.damage from DBZ.attacks where DBZ.attacks.char_id=$bot_id and DBZ.attacks.attack_id=$attack_id";
			$result=mysqli_query($db,$query);
			while($row=mysqli_fetch_row($result))
			{
				echo "<br>Bot's damage is $row[0]";
				$bot_damage=$row[0];
			}

			#let's get user's damage
			$query="";
			$query="SELECT DBZ.attacks.damage from DBZ.attacks where DBZ.attacks.char_id=$select and DBZ.attacks.attack_id=$sel2";
			$result="";
			$result=mysqli_query($db,$query);
			while($row=mysqli_fetch_row($result))
			{
				echo "<br> User's damage is $row[0]";
				$user_damage=$row[0];

			}
			if($user_damage>=$bot_damage)
			{

				if($user_damage==$bot_damage)
				{
					echo "It's a draw";

				}
				else
				{
					echo "<br> user damage=$user_damage <br> bot damage=$bot_damage"; 
					$user_score=$user_damage-$bot_damage;
					$query="SELECT DBZ.users.user_score from DBZ.users WHERE DBZ.users.user_id=$user_id";
					$result=mysqli_query($db,$query);
					$original_score=0;
					while($row=mysqli_fetch_row($result))
					{
						$original_score=$row[0];
					}
					$user_score=$original_score + $user_score;
					$query="";
					$query="UPDATE DBZ.users SET DBZ.users.user_score=$user_score WHERE DBZ.users.user_id=$user_id";
					mysqli_query($db,$query);	
					header("Location: /project/victory.php?user_score=$user_score&s2=6");
				}


			}
			else
			{
				$user_score=$bot_damage-$user_damage;
				header("Location: /project/failure.php?user_score=$user_score&s2=6");
			}
			break;












}








?>
