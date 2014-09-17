<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include_once($root . "/loginform/loginform.php");
session_start();
if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$email = $_SESSION['email'];
}
echo<<<_headerhtml
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- bootstrap -->
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- my css-->
<link href="../styles/header.css" rel="stylesheet">

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel='apple-touch-icon' href='images/iosicon.png'/>
</head>

<body>
<div class="navbar navbar-default navbar-static-top">
<div class="container" >
	
	<button id="headercontainer" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand">Coding Sailor</a>
	<div class="collapse navbar-collapse">
	<ul class="nav navbar-nav navbar-right">
_headerhtml;

if ($tag == "home")
{ echo "<li class='active'><a href = '/index.php'>Home</a></li>"; }
else { echo "<li><a href = '/index.php'>Home</a></li>"; }

if ($tag == "about")
{ echo "<li class='active'><a href = '/about.php/'> About Me</a></li>"; }
else { echo "<li><a href = '/about.php'>About Me</a></li>"; }

if ($tag == "posts")
{ echo "<li class='active'><a href = '/posts/'> Blog Posts</a></li>"; }
else { echo "<li><a href = '/posts'>Blog Posts</a></li>"; }

session_start();
if(isset($_SESSION['username']))
{	
	if($username == "admin")
	{
		if ($tag == "cms")
			{ echo "<li class='active'><a href= '../CMS/cmsform.php'>CMS</a></li>"; }
			else { echo"<li><a href= '../CMS/cmsform.php'>CMS</a></li>"; }
	}
	if ($tag == "user")
			{ echo "<li class='active'><a href= '../user/index.php'>profile</a></li>"; }
			else { echo"<li><a href= '../user/index.php'>profile</a></li>"; }
	echo"<li><a>Hello $username ,</a></li>";
	echo"<li><a href='../loginform/logout.php' id='logout'>Logout</a></li>";
}	
else
{
echo<<<_loginformhtml
          <li class="divider-vertical"></li>
          <li class="dropdown">
		  <a class="dropdown-toggle" href="#" data-toggle="dropdown">Register <strong class="caret"></strong></a>
          <div class="dropdown-menu" style="min-width:auto; padding: 15px; padding-bottom: 0px;">
		  <form  id="login" name="login" action="../loginform/processlogin.php" method="POST" />
		</br>Username: <input type="text" name="username"/>
		</br>Password: <input type="password" name="pwd"/>
		</br>Email:<input type="text" name="email" id="emailsec"/>
		<input type="submit" name="signup" value="register" id="signupbutton"/>
		</form>
		<li class="divider-vertical"></li>
          <li class="dropdown">
          <a class="dropdown-toggle" href="#" data-toggle="dropdown">Login<strong class="caret"></strong></a>
          <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
              <!-- Login form here -->
	<form  id="login" name="login" action="../loginform/processlogin.php" method="POST" />
		</br>Username: <input type="text" name="username"/>
		</br>Password: <input type="password" name="pwd"/>
		<input type="submit" name="signin" value="Login" id="signinbutton"/>
	</form>
</div>
_loginformhtml;
}
	
echo<<<_headerhtml2
</ul>
</div>
</div>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">
    window._idl = {};
    _idl.variant = "modal";
    (function() {
        var idl = document.createElement('script');
        idl.type = 'text/javascript';
        idl.async = true;
        idl.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'members.internetdefenseleague.org/include/?url=' + (_idl.url || '') + '&campaign=' + (_idl.campaign || '') + '&variant=' + (_idl.variant || 'modal');
        document.getElementsByTagName('body')[0].appendChild(idl);
    })();
</script>


</body>
</html>
_headerhtml2;

?>