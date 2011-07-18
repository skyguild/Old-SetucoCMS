<?php

include("common/lib.php");

if(isset($_SESSION["login"])){
	url_get("index.php");
}

$m= "";

if(isset($_SESSION["message"])){
	if($_SESSION["message"] == "true"){
		$m .= "<p>ログイン名か、パスワードが間違っています。<br />もう一度やり直してください。</p>";
	} else {
		$m .= $_SESSION["message"];
	}
	$_SESSION["message"] = NULL;
	$m .= "<p><a href='login.php'>OK</a></p>";
}

xml();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta http-equiv="content-script-type" content="text/jascript" />
	<meta http-equiv="content-style-type" content="text/css" />
	
	<meta name="description" content="LegendCMSは、電設部の電設部による電設部のためのCMSです。" />
	<meta name="keywords" content="電設部,CMS,サイト制作,オープンソース" />
	
	<meta name="author" content="ErinaMikami" />
	<meta name="copyright" content="LegendCMS" />
	<meta http-equiv="imagetoolbar" content="no" />
	
	<link href="css/base.css" rel="stylesheet" type="text/css" media="screen" />

	<title>ログイン画面:LegendCMS</title>

</head>

<body id="loginBoad">

<div id="tenjikai">
	<h2>展示会用アカウント名とパスワード</h2>
		
	<dl class="straight">
	
		<dt>アカウント名</dt>
			<dd>admin</dd>
			
		<dt>パスワード</dt>
			<dd>connect</dd>
	
	</dl>
	
</div>

<!-- container START -->
<div id="container">

	<h1><img src="images/loginLogo.gif" width="281" height="58" alt="レジェンドCMS" /></h1>
	
	<p id="catch"><img src="images/catch.gif" width="301" height="14" alt="電設部の電設部による電設部のための唯一のCMS" /></p>

	<?php
					 
		if($m != ""){
			print "<div id='messageArea'>";
			print $m; 
			print "</div>";
		}
					
	?>

	<form action="login_check.php" method="post">
	
		<dl class="straight">
			<dt><label for="user_name">アカウント名</label></dt>
				<dd><input type="text" id="user_name" name="user_name" value="" /></dd>
			<dt><label for="user_pass">パスワード</label></dt>
				<dd><input type="password" id="user_pass" name="user_pass" value="" /></dd>
		</dl>
		
		<p><input type="submit" id="sub" name="sub" value="ログイン" /></p>
	
	</form>
	
	<?php copyright(); ?>

</div>
<!-- container END -->

</body>

</html>
