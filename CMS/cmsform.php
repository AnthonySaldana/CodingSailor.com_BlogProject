<?php
$tag="cms";
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root . "/loginform/secure/logindb.php");
include_once($root . "/header.php");
session_start();
echo"<title>CMS</title>
<meta name='description' content='The CMS for the coding sailor blog'>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
if(isset($_SESSION['username']))
	{
		
				$username = $_SESSION['username'];
				$password = $_SESSION['password'];
				$email = $_SESSION['email'];
				
			//check if login is admin
		if($username == "admin")
			{
		echo<<<_sqltesthtml
<div class="container">
    <div class="row">
    <div class="col-md-12">
    <h2>Post Entry</h2>
    <form action="mainprocess.php" method="post">
<!-- fill in category here -->
    <div class="row">
    <div class="form-group col-sm-3">
        <label for="category"> Category </label>
        <select name="category" class="form-control">
        <option name="tech" value="1">Tech</option>
        <option name="web" value="2">Web</option>
        <option name="life" value="3">Life</option>
        <option name="selfdev" value="4">Self Development</option>
        </select>
    </div>

     <div class="form-group col-sm-3">
        <label for="title"> Title </label>
        <input class="form-control" type="text" name="title" placeholder="title here">
     </div>
    </div>
<!-- blog content goes into this part of the form -->
    <div class="row">
        <div class="form-group col-sm-10">
            <label for="content"> Content </label>
            <textarea rows="10" class="form-control" name="content" placeholder="Blog Post goes here!"></textarea>
        </div>
    </div>
<!-- submit data -->
        <input type="submit" value="submit"/>
    </form>
        </div>
    </div>
</div>
_sqltesthtml;

		$db_server = mysql_connect($db_hostname, $db_username, $db_password);
		if (!$db_server) die("couldn't connect: " . mysql_error());

		mysql_select_db($db_database, $db_server)
			or die("unable to select database" . mysql_error());
			
		$query="SELECT * FROM blogpost ORDER BY id DESC";
		$result = mysql_query($query);

		if(!$result) die("couldnt establish query");
		$rows=mysql_num_rows($result);


		for($j=0; $j < $rows; ++$j)
		{
			
			
			$row = mysql_fetch_row($result);
			echo<<<_format
			<div class='container'>
			<div class='row'>
			<div class='col-md-12' style="border-top:2px solid black">
			<div class='list-group'>
			
			<a href='#' class='list-group-item'>
			<h2 Class='list-group-item-heading'>$row[1] Post Details</h2>
_format;
                        $limitpost = substr($row[2],0, 600) . "...";
			echo<<<_blogpostquery
				Category: $row[0] </br>
				$limitpost </br>
				ID: $row[3] </br>
				Date: $row[4] </br>
			<!--excuse my half-fast presentation here. -->
			<form action="mainprocess.php" method="POST" style = "display:inline-block; vertical-align:top;">
				<input type="hidden" name="delete" value="yes" "/>
				<input type="hidden" name="id" value="$row[3]"/>
			<input type="submit" name="delete" value="DELETE"/>
			</form>
			<form action="editpost.php" method="POST" style = "display:inline-block; vertical-align:top;">
			<input type = "hidden" name ="id" value = "$row[3]"/>
			<input type = "hidden" name = "content" value = "$row[2]"/>
			<input type = "hidden" name = "title" value = "$row[1]"/>
			<input type = "submit" name="edit" value="EDIT"/>
			</form>
_blogpostquery;

echo<<<_finishformat
</a>
			
			</div>
			</div>
			</div>
			</div>
_finishformat;
		}

		mysql_close($db_server);
}

else die("only admin allowed");
}


?>