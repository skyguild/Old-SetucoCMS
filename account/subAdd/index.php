<?php

include("../../common/lib.php");

notLogin("../../login.php");

$login_name = login_name();
$admin_role = login_role();

$row_site = site_data();

$m = "";

if($_SESSION["message"]){
	$m .= $_SESSION["message"];
	$_SESSION["message"] = NULL;
	$m .= "<p><a href='index.php'>OK</a></p>";
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

	<link href="../../css/base.css" rel="stylesheet" type="text/css" media="screen" />

	<title>サブアカウントの追加:LegendCMS</title>

</head>

<body>

<!-- container START -->
<div id="container">

	<!-- header START -->
	<div id="header">

		<div>

			<h1><a href="../../index.php" title="管理画面のトップに戻ります"><img src="../../images/logo.jpg" alt="レジェンドCMS"  width="157" height="39" /></a></h1>

			<h2><a href="<?php print $row_site["site_url"]; ?>" title="サイトのトップページを表示します" target="_blank"><?php print $row_site["site_name"]; ?></a></h2>

			<p><a href="<?php print $row_site["site_url"]; ?>" title="サイトのトップページを表示します" target="_blank"><img src="../../images/btn_watchSite.jpg" alt="サイトを確認する" width="108" height="29" /></a></p>

		</div>

		<form action="../../logout.php" method="post">
			<ul>
				<li id="utilManual"><a href="#">ヘルプ</a></li>
				<li id="utilLogout"><input onmouseover="this.className='logoutOver'"onmouseout="this.className='logoutNormal'" type="submit" id="sub" name="sub" value="" /></li>
				<li id="utilAccount"><a href="../index.php"><?php print $login_name; ?></a>でログイン中</li>
			</ul>
		</form>

	</div>
	<!-- header END -->

	<!-- content START -->
	<div id="content">

		<!-- mainContent START -->
		<div id="mainContent">

			<!-- mainContentInner START -->
			<div id="mainContentInner">

				<!-- topicPath START -->
				<div id="topicPath">
					<p><a href="../../../../index.php">トップ</a><img src="../../images/topicPath.gif" width="6" height="11" alt="の中の" /></p>
					<p>サブアカウントの追加</p>
				</div>
				<!-- topicpath END -->

				<!-- section START -->
				<div class="section">

					<div id="topichAreaL">

						<div id="topichAreaR">

							<div id="topichArea">

								<h3><img src="../../images/h_subaccountAdd.jpg" width="149" height="18" alt="サブアカウントの追加" /></h3>

							</div>

						</div>

					</div>

					<?php

						if($m != ""){
							print "<div id='messageArea'>";
							print $m;
							print "</div>";
						}

					?>

					<form action="sub_add.php" method="post">

						<dl class="editArea">

							<dt><label for="user_name">アカウント名</label></dt>
								<dd><input type="text" id="user_name" name="user_name" value="" /></dd>

							<dt><label for="user_pass">パスワード</label></dt>
								<dd><input type="password" id="user_pass" name="user_pass" value="" /></dd>

							<dt><label for="pass_check">パスワード確認</label></dt>
								<dd><input type="password" id="pass_check" name="pass_check" value="" /></dd>

						</dl>

						<p class="editAreaP"><input type="submit" id="sub" name="sub" value="新規追加" /></p>

					</form>

				</div>
				<!-- section END -->

			</div>
			<!-- mainContentInner END -->

		</div>
		<!-- mainContent END -->

		<!-- gNav START -->
		<ul id="gNav">
			<li><a href='../../index.php' title='管理画面のトップに戻ります'><img src='../../images/btn_menu_top.jpg' alt='トップ' width='150' height='30' /></a></li>
		<?php
			if($admin_role==true){
				print "
			<li>
				<dl>
					<dt><img src='../../images/h_menu_category.jpg' alt='カテゴリー' width='150' height='30' /></dt>
						<dd title='カテゴリーの'><a href='../../category/index.php'>追加・編集・削除</a></dd>
				</dl>
			</li>";
			}
		?>

			<li>
				<dl>
					<dt><img src="../../images/h_menu_page.jpg" alt="ページ" width="150" height="30" /></dt>
						<dd title="ページの"><a href="../../page/contribution/index.php">新規作成</a></dd>
						<dd title="ページの"><a href="../../page/index.php">編集・削除</a></dd>
				</dl>
			</li>

			<li>
				<dl>
					<dt><img src="../../images/h_menu_site.jpg" alt="サイト全般" width="150" height="30" /></dt>
						<dd title="サイトの"><a href="../../site/index.php">サイト情報の編集</a></dd>
				</dl>
			</li>

			<li>
				<dl>
					<dt><img src="../../images/h_menu_account.jpg" alt="アカウント" width="150" height="30" /></dt>
						<dd><a href="../index.php">マイアカウントの編集</a></dd>
						<dd id="active"><a href="index.php">サブアカウントの追加</a></dd>
						<dd><a href="../subEdit/index.php">サブアカウントの編集・削除</a></dd>
				</dl>
			</li>

		</ul>
		<!-- gNav END -->

	</div>
	<!-- content END -->

	<?php copyright(); ?>

</div>
<!-- container END -->

</body>
</html>