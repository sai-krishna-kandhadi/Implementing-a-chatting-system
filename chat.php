<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	if(isset($_POST['name'])){
		$db = mysqli_connect('localhost', 'root', '', 'amaterasu');
		if(!strpos($_POST['name'],'-->group')){
			$SQLi = "SELECT * FROM chat_onetoone WHERE sender='$_SESSION[uname]' AND receiver='$_POST[name]' ORDER BY time;";
			$SQLi .= "SELECT * FROM chat_onetoone WHERE sender='$_POST[name]' AND receiver='$_SESSION[uname]' ORDER BY time";
				if (mysqli_multi_query($db,$SQLi))
				{
					do{
						// Store first result set
						if ($data=mysqli_store_result($db)){
							// Fetch one and one row
							while ($row=mysqli_fetch_array($data)) {
								$msgs[$row['time']] = $row['message'].'-->'.$row['sender'];
							}
							// Free result setup
							mysqli_free_result($data);
						}
					} while (mysqli_next_result($db));
					if(!empty($msgs)) {
						ksort($msgs);
						foreach($msgs as $key=>$value) {
							list($text, $person) = explode('-->', $value);
							if($text == '') continue;
							if($person==$_POST['name']){
								?><p align="left"><?php echo $text.'&nbsp;&nbsp;&nbsp;'.$key.'<br>';?></p><?php
							}
							else{
								?><p align="right"><?php echo $text.'&nbsp;&nbsp;&nbsp;'.$key.'<br>';?></p><?php
							}
						}
					} else {
						echo "No messages to display";
					}
				}
		}
		else{
			$_POST['name']=str_replace("-->group", "", $_POST['name']);
			$SQL = "SELECT * FROM chat_onetomany WHERE group_name='$_POST[name]' ORDER BY time;";
			$resu = mysqli_query($db, $SQL);
			if(!empty($resu)){
				while($row = mysqli_fetch_array($resu)) {
					$text = $row['msg'];
					$key = $row['time'];
					$sender = $row['sender'];
					if($row['sender']==$_SESSION['uname']){?>
						<p align="right" style="color:red;"><?=$sender.'<br><font color="black">'.$text.'&nbsp;&nbsp;&nbsp;'.$key.'</font><br>';?></p></div></div><?php
					}
					else{
						?><p align="left" style="color:blue;"><?=$sender.'<br><font color="black">'.$text.'&nbsp;&nbsp;&nbsp;'.$key.'</font><br>';?></p><?php
					}
				}
			}
		
			else
				echo "No messages to display";
		}
	}
	$db = mysqli_connect('localhost', 'root', '', 'amaterasu');
	if(isset($_POST['msg'])&&!strpos($_POST['to'],'-->group')) {
		$msg = $_POST['msg'];
		$to = $_POST['to'];
		$from = $_SESSION['uname'];
		$date = date("y-m-d H:i:s", time());
		$SQLi= "SELECT uname from users where uname='$to'";
		$re=mysqli_query($db,$SQLi);
		if(count(mysqli_fetch_array($re)) > 0) {
			$SQL = "INSERT INTO chat_onetoone VALUES('$from', '$to', '$msg', '$date')";
			$res = mysqli_query($db,$SQL);
		}
		else 
			echo $to.' has deleted the account';
	}
	else if(isset($_POST['msg'])) {
		$to=str_replace("-->group", "", $_POST['to']);
		$msg = $_POST['msg'];
		$from = $_SESSION['uname'];
		$date = date("y-m-d H:i:s", time());
		$SQL = "INSERT INTO chat_onetomany VALUES('$from','$to', '$msg', '$date')";
		$res = mysqli_query($db,$SQL);
	}
?>