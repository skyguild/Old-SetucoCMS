<?php

include("../../common/lib.php");

notLogin("../../login.php");

$login_name = login_name();

$row_site = site_data();

//削除が押されたら、ページIDをpage_edit.phpに送る
if(isset($_GET["delete"])){
	$_SESSION["del_sub_id"] = $_GET["delete"];
	url_get("sub_edit.php");
}

//メッセージを取得
if($_SESSION["message"]){
	$m .= $_SESSION["message"];
	$_SESSION["message"] = NULL;
	$m .= "<p><a href='index.php'>OK</a></p>";
}

//アカウントのデータを取得
$retu = "*";
$table = "user";
$rule = " ORDER BY user_name DESC";

$result = call_data($retu,$table,$rule);

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

	<title>サブアカウントの編集・削除:LegendCMS</title>

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
					<p>サブアカウントの編集・削除</p>
				</div>
				<!-- topicpath END -->
		
				<!-- section START -->
				<div class="section">
				
					<div id="topichAreaL">
					
						<div id="topichAreaR">
						
							<div id="topichArea">
							
								<h3><img src="../../images/h_subaccountEdit.jpg" width="193" height="18" alt="サブアカウントの編集・削除" /></h3>
								
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

					<form action="sub_edit.php" method="post">

						<table summary="アカウント一覧の表です。編集と、削除ができます。" cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th scope="col" width="80%" id="tableFirst">アカウント名</th>
									<th scope="col" width="10%">編集</th>
									<th scope="col" width="10%">削除</th>
								</tr>
							</thead>
								
							<tbody>
								
								<?php
									
									//偶数・奇数判定に使う変数
									$i = 0;
									
									while($row = mysql_fetch_array($result)){
										
										$user_id = $row["user_id"];
										$user_name = $row["user_name"];
										
										if($user_id != 0){
										
											//偶数だったらcheckGをつけて、CSSで背景色を入れる
											$i++;
											
											if($i%2 == 0){
												print "<tr class='checkG'>\n";
											} else {
												print "<tr>\n";
											}
										
											//アカウント名	
											tab("10");
											print "<td><a href='edit/index.php?user_id={$user_id}'>";
											print $user_name;
											print "</a></td>\n";
											
											//編集	
											tab("10");
											print "<td><a href='edit/index.php?user_id={$user_id}'><img src='../../images/btn_edit.png' alt='編集' widrh='27' height='27' /></a></td>\n";
	
											//削除	
											tab("10");
											print "<td><a href='#' onclick='flg({$user_id});'><img src='../../images/btn_delete.png' alt='削除' widrh='27' height='27' /></a></td>\n";
												
											tab("9");
											print "</tr>\n\n";
												
										}
									}
									
								?>
									
							</tbody>
							
						</table>
					
					</form>

				</div>
				<!-- section END -->
				
			</div>
			<!-- mainContentInner END -->
		
		</div>
		<!-- mainContent END -->
		
		<!-- gNav START -->
		<ul id="gNav">
		
			<li><a href="../../index.php" title="管理画面のトップに戻ります"><img src="../../images/btn_menu_top.jpg" alt="トップ" width="150" height="30" /></a></li>
			
			<li>
				<dl>
					<dt><img src="../../images/h_menu_category.jpg" alt="カテゴリー" width="150" height="30" /></dt>
						<dd title="カテゴリーの"><a href="../../category/index.php">追加・編集・削除</a></dd>
				</dl>
			</li>
			
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
						<dd><a href="../subAdd/index.php">サブアカウントの追加</a></dd>
						<dd id="active"><a href="index.php">サブアカウントの編集・削除</a></dd>
				</dl>
			</li>
			
		</ul>
		<!-- gNav END -->
		
	</div>
	<!-- content END -->
		
	<?php copyright(); ?>

</div>
<!-- container END -->

<script type="text/javascript">
	<!--
	function flg(id){
		var flg;　//真偽を入れる変数の宣言
												
		flg=confirm("本当に削除してよろしいですか？"); //真偽の代入
												
		if (flg==true){
			location.href='index.php?delete='+id;
		}
	}
	// -->
</script>

</body>
</html>