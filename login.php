<?php
?>
    <html>
	    <head>
		    <title>Amaterasu</title>
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"/>
		    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
			<script type="text/javascript">
			    
			    $(document).ready(function() {
					$("#log").click(function() {
						id = $("#pid").val();
					    pwd = $("#pwd").val();
					    if(id=='' || pwd== '') {
							alert("Enter all the fields");
						} else {
							$.ajax({
								url: "process.php",
								type: "POST",
								data: "req=login&id="+id+"&pwd="+pwd,
								success: function(data) {
									if(data == 'OK') {
										window.location = 'welcome.php';
									} else {
										alert(data);
									    $("#pwd").effect("shake");

									}
								}
							});
						}
					});
					$("#siup").click(function() {
						$("#loginpanel").slideUp("slow");
						document.getElementById("regpanel").display='block';
						$("#regpanel").slideDown("slow");
					});	
					$("#signin").click(function() {
						$("#regpanel").slideUp("slow");
						$("#rid").val('');
					    $("#rpwd").val('');
						$("#rcpwd").val(''); 
						$("#runame").val('');

						//document.getElementById("regpanel").display='block';
						$("#loginpanel").slideDown("slow");
					});
					$("#register").click(function() {
						id = $("#rid").val();
					    pwd = $("#rpwd").val();
						cpwd = $("#rcpwd").val(); 
						uname = $("#runame").val();
						
					    if(id=='' || pwd== '' || cpwd == '' || uname=='') {
							alert("Enter all the fields");
						} else {
							$.ajax({
								url: "process.php",
								type: "POST",
								data: "req=register&id="+id+"&pwd="+pwd+"&uname="+uname,
								success: function(data) {
									if(data == "OK") {
										alert("Successfully Registered");
									} else {
										alert(data);
									}
								}
							});
						}
					});
					//kotha experiment
					
					$("#rcpwd").change(function() {
						pwd = $("#rpwd").val();
						cpwd = $("#rcpwd").val(); 
						if(pwd==cpwd)
							("#Match").html("<font color='red'>Passwords don't match</font>");
						else
							("#Match").html("<font color='green'>Passwordsw match</font>");
					});
				});
			</script>
		</head>
		<body style="background-color: black"><br><br>
		    <div class="container">
			    <div class="col-md-4"></div>
				<div class="col-md-4" style="border-radius: 10px;">
                    <div id="loginpanel"  class="panel panel-default" style="border: solid #808080;">
                        <div align="center" style="background-color: #808080; color: white;"class="panel-heading">login</div>
                        <div class="panel-body">
						    <input type="text" placeholder="Username" class="form-control" value="" id="pid"/><br/>
						    <input type="password" placeholder="Password" class="form-control"  value="" id="pwd"/><br/>
							
							<center>
							    <input type="button" class="btn btn-info" 
								style="background-color: #3385ff;; border: solid #cce0ff;" value="Login" id="log">
							<center>
							
							<hr>
							<div class ="container-fluid">
							  <div class ="row">
								<div class ="col-md-6 col-sm-6" >
									<a id="siup">Sign up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
								<div class ="col-md-6 col-sm-6">
								 </div>
							  </div>
							</div>
							<div class ="container-fluid">
							  <div class ="row">
								<div class ="col-md-6 col-sm-6" >
									<a>Need Help?</a>
								</div>
								<div class ="col-md-6 col-sm-6">
									<a target="_blank" href="forgotpwd.php">Forgot password?</a>
								 </div>
							  </div>
							</div>
						</div>
						
                        <div align="center" class="panel-footer"></div>
                    </div>
					
					<!------------ registration page ------------------>
					
					
                    <div id="regpanel"  style="display:none;" class="panel panel-default" style="border: solid #808080;">
                        <div align="center" style="background-color: #808080; color: white;"class="panel-heading">Register</div>
                        <div class="panel-body">
						    <input type="text" placeholder="Email Id" class="form-control" value="" id="rid"/><br/>
						    <input type="text" placeholder="Username" class="form-control" value="" id="runame"/><br/>
							Gender: <input type="radio" name="g">&nbsp;Male&emsp;&nbsp;<input type="radio" name="g">&nbsp;Female<br/><br/>
						    <input type="password" placeholder="Password" class="form-control"  value="" id="rpwd"/><br/>
							<div id="Match"></div>
						    <input type="password" placeholder="Confirm password" class="form-control"  value="" id="rcpwd"/><br/>
							
							<center>
							    <input type="button" class="btn btn-info" style="background-color: #3385ff;; border: solid #cce0ff;"
								value="Register" id="register">
							<center>
							
							<hr>
							<div class ="container-fluid">
							  <div class ="row">
								<div class ="col-md-6 col-sm-6" >
									<a id="signin">Sign in</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
								<div class ="col-md-6 col-sm-6">
									<a >Need help?</a>
								 </div>
							  </div>
							</div>
						</div>
						
                        <div align="center" class="panel-footer"></div>
                    </div>

				</div>
			    <div class="col-md-4"></div>
            </div>
		</body>
	</html>
	