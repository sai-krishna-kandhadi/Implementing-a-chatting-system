<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	if(!$_SESSION) {
	   header("Location: login.php");	
	}
	
	function isOnline($name) {
	    $db = mysqli_connect("localhost", "root", "", "amaterasu");
		$SQL = "SELECT * FROM online WHERE uname='$name'";
		$re = mysqli_query($db, $SQL);
		if(!$re) {
			echo mysqli_error($db);
			return false;
		}
		$row = mysqli_fetch_array($re);
		if(!$row) return false;
		else return true;
	}	
?>	
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="incl/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="incl/bootbox.min.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Amaterasu</title>
		<script type="Text/javascript">
		/*	window.onbeforeunload = function (event) {
				if (typeof event == 'closeWindow') {
				return logout();
					
				}
				if (event) {
					event.returnValue ='1';
				}
				//alert(typeof event);
				return logout();
				
			};*/
			function show(type,id) {
				$.ajax({
					type: "POST",
					url: "tabs_process.php",
					data: "show="+type,
					success: function(data) {
						$("#"+id).html(data);
					}
				});
			}
			function loadMessage(name) {
				c_name = name;
				aname = name;
				r = aname.split("--");
				$("#n").html(r[0]);
				$.ajax({
					type: "POST",
					url: "chat.php",
					data: "name="+name,
					success: function(data) {
						if(data) {
							$("#cont").html(data);
							//st = setTimeout(loadMessage(c_name),2000);
						} else {
							$("#cont").html("");
						}
					}
				});
			}
			function logout() {
				$.ajax({
					type: "POST",
					url: "process.php",
					data: "logout=yes",
					success: function(data){
						window.location='login.php';
					}
				});
			}
			function sendMsg() {
				var msg = $("#msg_s").val();
				if(msg=='') {
					alert('Enter text to be sent');
				} else {
					$.ajax({
						url: "chat.php",
						data: "msg="+msg+"&to="+c_name,
						type: "POST",
						success: function(data) {
							if(data== 'OK') {
								alert(data);
							} else {
								$("#msg_s").val('');
								loadMessage(c_name);
							}
						}
					});

				}
			}
			function search() {
				var txt = $("#searchtxt").val();
				$.ajax({
					type: "POST",
					url: "search.php",
					data: "txt="+txt,
					success: function(data) {
						var dialog = bootbox.dialog({
							title: 'Showing Results for: '+txt,
							message: data,
							buttons: {
								cancel: {
									label: "Close",
									className: 'btn-info',
									callback: function(result){
										return result;
									}
								},
								
							}
						});
					}
				});
			}
			
			function chPass() {
				var dialog = bootbox.dialog({
					size: "small",
					title: 'Change Password',
					message: "<center>"+createPBox('cpwd', 'Confirm&nbsp;Current&nbsp;Password')+"<br><br>"+createPBox('npwd', 'Enter&nbsp;New&nbsp;Password')+"<br><br>"+createPBox('cnpwd', 'Confirm&nbsp;New&nbsp;Password')+"<br><br>"+createButt('c','Change&nbsp;Password', 'chgpass()')+"<br><div id='pdiv'></div>",
					buttons: {
						cancel: {
							label: "Close",
							className: 'btn-info',
							callback: function(result){
								return result;
							}
						},
						
					}
				});		
			}
			function chgpass() {
				cpwd = $("#cpwd").val();
				npwd = $("#npwd").val();
				cnpwd = $("#cnpwd").val();
				
				
				$.ajax({
					type: "POST",
					url: "process.php",
					data: "request=changepwd&cpwd="+cpwd+"&npwd="+npwd+"&cnpwd="+cnpwd,
					success: function(data) {
						$("#pdiv").html(data);
					}
				});
			}
            function delAcc() {
                var dialog = bootbox.dialog({
                    size: "medium ",
                    title: 'delete account',
                    message: "Enter your Password to continue<br><br><center>"+createPBox('pwd', 'enter&nbsp;Password')+"<br>",
                    buttons: {
                        cancel: {
                            label: "delete",
                            className: 'btn-info',
                            callback: function(result){
                                $.ajax({
                                    type: "POST",
                                    url: "process.php",
                                    data: "delete=yes&pwd="+$("#pwd").val(),
                                    success: function(data) {
                                        alert(data);
                                        if(data=="OK")
                                            window.location="login.php";
                                    }
                                });
                            }
                        },

                    }
                });		
            }
			
			function createBox(id,place) {
				return "<input type='text' value='' placeholder="+place+" id="+id+">";
				
			}
			function createPBox(id,place) {
				return "<input type='password' value='' placeholder="+place+" id="+id+">";
				
			}

			function createButt(id,value, callback) {
				return "<input type='button' value="+value+" id="+id+" onclick="+callback+">";
				
			}
			
			function crtGrp() {
				var grnm = $("#grnm").val();
				var mem1 = $("#m1").val();
				var mem2 = $("#m2").val();
				var mem3 = $("#m3").val();
				var mem4 = $("#m4").val();
				$.ajax({
					type: "POST",
					url: "process.php",
					data: "request=crtgrp&grnm="+grnm+"&mem1="+mem1+"&mem2="+mem2+"&mem3="+mem3+"&mem4="+mem4,
					success: function(data) {
						$("#gdiv").html(data);
						$("#grnm").val('');
						$("#m1").val('');
						$("#m2").val('');
						$("#m3").val('');
						$("#m4").val('');
						alert(data);
						//window.location='welcome.php';
					}
				});
			}
			function createGroup() {
				var dialog = bootbox.dialog({
					size: "small",
					title: 'Create New Group',
					message: createBox('grnm', 'Unique&nbsp;Group&nbsp;Name')+"<br><br>"+createBox('m1', 'Member&nbsp;1')+"<br><br>"+createBox('m2', 'Member&nbsp;2')+"<br><br>"+createBox('m3', 'Member&nbsp;3')+"<br><br>"+createBox('m4', 'Member&nbsp;4')+"<br><br>"+createButt('crgp','Create&nbsp;Group', 'crtGrp()')+"<div id='gdiv'></div>",
					buttons: {
						cancel: {
							label: "Close",
							className: 'btn-info',
							callback: function(result){
								return result;
							}
						},
						
					}
				});

			}	
		</script>
	</head>
	<body style="background-image:url('lol.jpg');">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" >Amaterasu</a>
				</div>
				<div class="navbar-form navbar-left" action="">
					<div class="form-group">
						<input type="text" class="form-control" id="searchtxt" placeholder="Search for users" name="search">
					</div>
					<button type="button" id="search" onclick="search();" class="btn btn-default">Search</button>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" onclick="createGroup();"><span  class="glyphicon glyphicon-plus"></span> Create Group</a></li>
					  <li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Settings
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						  <li><a href="#" onclick="chPass();">Change Password</a></li>
						  <li><a href="#" onclick="delAcc();">Delete Account</a></li>
						</ul>
					  </li>

					<li><a href="#" onclick="logout();"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				</ul>
			</div>
		</nav>
		<div id="search_div"></div>

		<div class="container container-fluid-1" style="">
			<div class="row parent" >
				<div class="col-md-4">
					<div class="panel panel-info">
						<div class="panel-heading" style="">
						    <Span class="glyphicon glyphicon-home"></span>&nbsp;Welcome <?=$_SESSION['uname'];?>
						</div>
							<?php
								$db = mysqli_connect('localhost', 'root', '', 'amaterasu');
								$SQL = "SELECT DISTINCT receiver,sender FROM chat_onetoone where 1 ORDER BY time";
                                $SQLa = "SELECT group_name FROM groups WHERE member1='$_SESSION[uname]' OR member2='$_SESSION[uname]' OR member3='$_SESSION[uname]' OR member4='$_SESSION[uname]'";
								$resa = mysqli_query($db,$SQLa);
								$names = array();
								$res = mysqli_query($db, $SQL);
								if($res) {
									while($row = mysqli_fetch_array($res)) {
										if($row['receiver'] == $_SESSION['uname'])
											$names[] = $row['sender'];
										else if($row['sender'] == $_SESSION['uname'])
											$names[]=$row['receiver'];
									}
								}
								while($resp = mysqli_fetch_array($resa)) {
								    if($resp['group_name']) $names[] = $resp['group_name']."-->group";
								}
								$names=array_unique($names);
								?>
    							<div class="tab">
									<?php
									foreach($names as $key=>$value) {
											$status = (isOnline($value)) ? "Online" : "";
										
									?>
										<button style="text-align:left;" class="tablinks" onclick="loadMessage('<?=$value;?>');"
										id="defaultOpen"><?=(strpos($value, "-->group")) ? '<span class="glyphicon glyphicon-link">' :'<span class="glyphicon glyphicon-user">'?>									
										<?=(strpos($value, "-->group")) ? str_replace("-->group", "", $value) : $value; ?>
										<span align="right " style="color: green;"><?=($status) ? "Active" : "";?></span></span>
										    

										
										</button>
							  <?php }?>
							    </div>
							<div class="panel-footer" style="text-align:right; text-color:grey;">
							All Rights <span class="glyphicon glyphicon-registration-mark"></span> Reserved.
							</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-info">
						<div class="panel-heading" id="n">Inactive</div>
						<div id="cont" class="panel-body fixed-panel">
                        </div>
						<div class="panel-footer" >
							<div style=""class="input-group">
								<input type="text" class="form-control" id="msg_s" placeholder="Enter Message" />
								<span class="input-group-btn">
									<button class="btn btn-info" id="sendmsg" onclick="sendMsg()" type="button">SEND</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</body>
</html>