<?php
session_start();
function connect(&$db)
{
                $mycnf="/etc/hw5-mysql.conf";
                if(!file_exists($mycnf))
                {
                        echo "ERROR: DB config file not: $mycnf";
                        exit;
                }
        $mysql_ini_array=parse_ini_file($mycnf);
        $db_host=$mysql_ini_array["host"];
        $db_user=$mysql_ini_array["user"];
        $db_pass=$mysql_ini_array["pass"];
        $db_port=$mysql_ini_array["port"];
        $db_name=$mysql_ini_array["dbName"];
        $db=mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
        if(!$db) {
                print " Error Connecting to DB: ".mysqli_connect_error();
                print " <br>Try again later! :D";

                exit;
        }
}


function authenticate($db,$log_user_name,$log_user_password)

{
				 $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];

                                #echo "username =$log_user_name";
                                $login_check=0;
                                if($stmt=mysqli_prepare($db,"SELECT user_salt,user_pass,user_id from DBZ.users where DBZ.users.user_name=?"))
                                {
                                        mysqli_stmt_bind_param($stmt,"s",$log_user_name);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt,$user_salt,$user_pass,$user_id);

                                        while(mysqli_stmt_fetch($stmt))
                                        {
                                                $user_salt=$user_salt;
                                                $user_pass=$user_pass;
                                                $log_user_password=hash('sha256',$log_user_password.$user_salt);
                                                #echo "<br><br> user_salt=$user_salt";
                                                #echo "<br>log_user_password=";
                                                #echo substr($log_user_password,0,-4);
                                                #echo "<br>user_pass=$user_pass";

                                                if(substr($log_user_password,0,-4)==$user_pass)
                                                {
                                                        $login_check=1;
					#		$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
							$_SESSION['authenicated']="yes";
							$_SESSION['userid']=$user_id;
                                                        break;
                                                }

                                        }



                                        mysqli_stmt_close($stmt);
                                }

				$ip=$_SESSION['ip'];

			#	echo "<br> first ip is $ip";
				connect($db);
                                if($login_check==1)
                                {
					/*echo "<br> Userid =$user_id <br>";
					echo "<br> Your IP is" ;
					#$ip=$_SESSION['ip'];
					echo "$ip";i */
					$time=date("Y-m-d H:i:s");
                                        #Let's insert this into the table
					#connect($db);	
					if($stmt=mysqli_prepare($db,"INSERT INTO DBZ.login set DBZ.login.login_id='',DBZ.login.ip=?,DBZ.login.status=?,DBZ.login.date=?,DBZ.login.user_id=?"))
					{
						#echo " <br> ....  ";
						$status="pass";
						#echo "pass";
						mysqli_stmt_bind_param($stmt,"ssss",$ip,$status,$time,$user_id);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);

				
					}
					


					


					echo " <center>You have logged in successfully";
					echo "<br><br><br> <a href=/project/add.php?s=111> Wanna log out? </a>"; 
					if($user_id!=1) {
					echo "<br> <a href=/project/game.php> Let's play? </a></center> ";
                               		}
					else 
					{
						header ("Location: /project/admin.php");
			
					}
				 }

                                else
                                {
#					echo "<br> second ip is $ip";
#                                        echo "<br><br>Wrong password/username";
				
#					 $ip=$_SESSION['ip'];
                                        echo "<br> ip is $ip";
                                        $time=date("Y-m-d H:i:s");
	
                                        if($stmt=mysqli_prepare($db,"INSERT INTO DBZ.login set DBZ.login.login_id='',DBZ.login.ip=?,DBZ.login.status=?,DBZ.login.date=?,DBZ.login.user_id=?"))
                                        {
                                                echo " <br> ....  ";
                                               $status="fail";
                                                echo "fail";
                                                mysqli_stmt_bind_param($stmt,"ssss",$ip,$status,$time,$user_id);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_close($stmt);


                                        }


					
					if(session_id()!=''){
						session_destroy();
                                       	}
					error_log("----------------ERROR------: DBZ App has failed login from ".$_SERVER['REMOTE_ADDR'],0);
					 header("Location:/project/add.php?s=51&fail=1");
                                }


}


function logout()
{

		if(session_id()!='')
		{
			session_destroy();
		}
		header("Location:/project/add.php?s=51");



}
?>
