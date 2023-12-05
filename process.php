<?php

    global $db;
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$db = mysqli_connect('localhost', 'root', '', 'amaterasu');
    if(isset($_POST['req']) && $_POST['req'] == 'login') {
		$id = $_POST['id'];
		$pwd = sha1($_POST['pwd']);
		$SQL = "SELECT email,password,uname from users WHERE email='$id'";
		$res = mysqli_query($db,$SQL);
		if($res) {
			//userid exists
			$row = mysqli_fetch_array($res);
			if($row['password'] == $pwd) {
				echo "OK";
				
				$_SESSION['uname'] = $row['uname'];
				$_SESSION['email'] = $row['email'];
				$SQL = "INSERT INTO online VALUES('$_SESSION[uname]')";
				$res = mysqli_query($db, $SQL);
				if(!$res) echo mysqli_error($db);
			} else if(!$row){
				echo "Invalid Email ID";
			}
		} else {
			echo "User doesn't exists";
		}
	}
	
	
	if(isset($_POST['req']) && $_POST['req'] == 'register') {
		$emailid = $_POST['id'];
		$pass = sha1($_POST['pwd']);
		$uname = $_POST['uname'];
		$SQL = "SELECT email FROM users WHERE email='$emailid'";
		$res = mysqli_query($db, $SQL);
		$row = mysqli_fetch_array($res);

		if($row) {
			if($row) echo "Email ID Already Exists!";
		} else {
			$SQLa = "INSERT INTO users VALUES('$emailid', '$uname', '$pass')";
			$resp = mysqli_query($db, $SQLa);
			if($resp) 
				echo "OK";
			else 
				echo "Registration Failed... ".mysqli_error($db);
		}
		
	}
	if(isset($_POST['logout'])) {
		$SQL = "DELETE FROM online where uname='$_SESSION[uname]'";
		$r = mysqli_query($db,$SQL);
		if(!$r) echo mysqli_error($db);
		session_destroy();
		
	}
	
	if(isset($_POST['reqType']) && $_POST['reqType'] == 'adduser') {
		$email = $_POST['email'];
		$cuser = $_SESSION['uname'];
		echo $email;
		$date = date("Y-m-d H:i:s", time());
		$SQL = "INSERT INTO chat_onetoone VALUES('$cuser', '$email', '', '')";
		if(mysqli_query($db, $SQL))
		    echo "OK";
		else echo '...'.mysqli_error($db);
	}

	if(isset($_POST['request']) && $_POST['request'] == 'changepwd') {
		$cpwd= sha1($_POST['cpwd']);
		$cnpwd= $_POST['cnpwd'];
		$npwd= $_POST['npwd'];
		if($cnpwd != $npwd) {
			echo "New password and confirm password doesn't match!";
			return false;
		}
		$SQL = "SELECT password FROM users WHERE uname='$_SESSION[uname]'";
		$res = mysqli_query($db,$SQL);
		$row = mysqli_fetch_array($res);
		$pwd = $row['password'];
		if($cpwd != $pwd) {
			echo "Enter correct Current Password";
			return false;
		} else {
			$npwd = sha1($npwd);
		    $SQL = "UPDATE users SET password = '$npwd' WHERE uname='$_SESSION[uname]'";
			$resp = mysqli_query($db, $SQL);
			if(!$resp) {
				echo mysqli_error($resp);
			} else {
				echo "Password Updated Successfully!";
			}
		}

	}
	if(isset($_POST['request']) && $_POST['request'] == 'crtgrp') {
		$grnm = $_POST['grnm'];
		$mem = array($_POST['mem1'],$_POST['mem2'],$_POST['mem3'],$_POST['mem4']);
		$flag = array(0,0,0,0);
		if($grnm!=''){
			$SQL = "SELECT * from groups where group_name='$grnm'";
			$res=mysqli_query($db,$SQL);
			$resp = mysqli_fetch_array($res);
			if(!empty($resp)) {
				echo "Group Name exists, try different name";
				return false;
			}
			else {
				for($i=0;$i<4;$i++) {
					$SQLi="Select * from users where uname='$mem[$i]'";
					$resa=mysqli_query($db,$SQLi);
					$resap = mysqli_fetch_array($resa);
					//echo "$i - OK<br>";
					if(!empty($resap)||$mem[$i]==''){
						$flag[$i]=1;
					}
					
				}
			}
			$create= true;
			for($i=0;$i<4;$i++){
				if($flag[$i]==0){
					echo "$mem[$i] doesn't exists<br>";
					$create=false;
				}
			}
			if($create){
				$SQLa="INSERT INTO groups values('$grnm','$mem[0]','$mem[1]','$mem[2]','$mem[3]')";
				$resi=mysqli_query($db,$SQLa);
				if(mysqli_affected_rows($db)>0){
					echo "Group Created!";
				}
			}
		}
		else {
			echo "Enter a Group Name";
			return false;
		}
	}
	
    if(isset($_POST['delete']) && $_POST['delete'] == 'yes') {
		$cpwd= sha1($_POST['pwd']);
		$SQL = "SELECT password FROM users WHERE uname='$_SESSION[uname]'";
		$res = mysqli_query($db,$SQL);
		$row = mysqli_fetch_array($res);
		$pwd = $row['password'];

		if($cpwd != $pwd) {
			echo "Invalid password";
			return false;
		} else {
            $SQL = "DELETE FROM users WHERE uname='$_SESSION[uname]'";
            $res = mysqli_query($db, $SQL);
            if($res) echo "OK";
            else echo mysqli_error($res);
        }
    }
	?>