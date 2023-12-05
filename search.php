    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript">
	    function chat(name) {
		    $.ajax({
				type: "POST",
				url: "process.php",
				data: "reqType=adduser&email="+name,
				success: function(data) {
					window.location = 'welcome.php';
				}
			});
		}	
	</script>

<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "amaterasu");
    if(isset($_POST['txt'])) {
		$txt = $_POST['txt'];
		if($txt==$_SESSION['uname'])
			echo "can't search yourself";
		else{
			$SQL = "SELECT email,uname FROM users WHERE uname ='$txt'";
			$res = mysqli_query($db, $SQL);
			if(!$res) {
				echo mysqli_error($db);
				return;
			}
			$m = false;
			while($row = mysqli_fetch_array($res)) {
				?>
				Email Id: <?=$row['email'];?><br>Username: <?=$row['uname'];?>
				<span align="right"><button onclick="chat('<?=$row['uname']?>');" class="btn btn-info">Chat</button></span><hr>

				<?php
				$m = true;
			}
			if(!$m) 
				echo "No Match Found!";
		}
	}
	
