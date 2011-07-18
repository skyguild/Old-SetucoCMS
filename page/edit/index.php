<?php

include("../../common/lib.php");

notLogin("../../login.php");

$login_name = login_name();

$row_site = site_data();

//各々のページを選んで飛んできていなかったら、一覧へ戻す
if(!isset($_GET["page_id"])){

	url_get("../index.php");

} else {

	$page_id = $_GET["page_id"];

}

//ログインしているユーザID
$login = $_SESSION["login"];

//メッセージを表示
$m = "";

if($_SESSION["message"]){
	$m .= $_SESSION["message"];
	$_SESSION["message"] = NULL;
	$page_id = $_GET["page_id"];
	$m .= "<p><a href='index.php?page_id={$page_id}'>OK</a></p>";
}

//アップロードメッセージ表示
$up_m = "";

if(isset($_SESSION["up_img"])){
	$up_m .= $_SESSION["up_img"];
	$_SESSION["up_img"] = NULL;
	$up_m .= "<p><a href='index.php?page_id={$page_id}'>OK</a></p>";
}

//ページのデータを取得
$retu = "*";
$table = "page";
$rule = " WHERE page_id='{$page_id}'";

//カテゴリーのデータを取得
$result = call_data($retu,$table,$rule);
$row = mysql_fetch_array($result);

$retu_c = "cat_id,cat_name";
$table_c = "category";
$rule_c = " ORDER BY cat_name";

$result_c = call_data($retu_c,$table_c,$rule_c);

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

	<title>「<?php print $row["page_title"]; ?>」の編集:LegendCMS</title>

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
				<li id="utilAccount"><a href="../../account/index.php"><?php print $login_name; ?></a>でログイン中</li>
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
					<p><a href="../../index.php">トップ</a><img src="../../images/topicPath.gif" width="6" height="11" alt="の中の" /></p>
					<p><a href="../index.php">ページの編集・削除</a><img src="../../images/topicPath.gif" width="6" height="11" alt="の中の" /></p>
					<p>「<?php print $row["page_title"]; ?>」の編集</p>
				</div>
				<!-- topicpath END -->
		
				<!-- section START -->
				<div class="section">
				
					<div class="hArea">
							
						<h3 id="textType">「<?php print $row["page_title"]; ?>」の編集</h3>
						
					</div>
				
					<?php
					
						if($m != ""){
							print "<div id='messageArea'>";
							print $m; 
							print "</div>";
						}
						
					?>
					
					<form action="edit_check.php" method="post">
					
						<input type="hidden" id="user_id" name="user_id" value="<?php print $login; ?>" />
						<input type="hidden" id="page_id" name="page_id" value="<?php print $row["page_id"]; ?>" />
					
						<dl id="inputArea">
						
							<dt><label for="page_title">タイトル</label></dt>
								<dd><input type="text" id="page_title" name="page_title" value="<?php print $row['page_title']; ?>" /></dd>
								
							<dt><label for="cat_id">カテゴリー</label></dt>
								<dd>
									<select id="cat_id" name="cat_id">
										<?php 
											
											while($row_c = mysql_fetch_array($result_c)){
												$cat_id = $row["cat_id"];
												$cat_id_c = $row_c["cat_id"];
												
												if($row_c["cat_id"]=="{$cat_id}"){
													print "<option value='{$cat_id_c}' selected='selected'>{$row_c[1]}</option>";
												} else {
													print "<option value='{$cat_id_c}'>{$row_c[1]}</option>";
												}
												
											}
										?>
									</select>
								</dd>
								
							<!--<dt><label for="upload_img">画像のアップロード</label>（現在の日時でファイル名をつけます）<span class="attentionMessage">※「JPG、GIF、PNG形式のみ」</span></dt>
								<dd class="upload"><input type="file" name="upload_img" id="upload_img" size="55" /></dd>
								<dd class="upload"><input type="submit" class="upSub" id="up" name="up" value="アップロード" /></dd>-->	
				
							<?php
							
								if($up_m != ""){
									print "<div id='messageArea'>";
									print $up_m; 
									print "</div>";
								}
								
							?>
								
							<dt><label for="page_text">本文</label></dt>
								<dd><textarea id="page_text" name="page_text" rows="10"><?php print $row['page_text']; ?></textarea></dd>
								
							<dt><label for="page_next">追記</label></dt>
								<dd><textarea id="page_next" name="page_next" rows="6"><?php print $row['page_next']; ?></textarea></dd>
								
							<dt><label for="page_date">投稿日時</label></dt>
								<dd><input type="text" id="page_date" name="page_date" value="<?php print $row['page_date']; ?>" onblur="if(this.value == '') { this.value='<?php print $row['page_date']; ?>'; }" /></dd>
						
						</dl>
						
						<ul>
							<li class="inputAreaL"><input type="submit" id="sub0" name="sub0" value="下書きで保存" /></li>
							<li class="inputAreaL"><input type="submit" id="sub1" name="sub1" value="公開して保存" /></li>
						</ul>
					
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
						<dd title="ページの"><a href="../contribution/index.php">新規作成</a></dd>
						<dd id="active" title="ページの"><a href="../index.php">編集・削除</a></dd>
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
						<dd><a href="../../account/index.php">マイアカウントの編集</a></dd>
						<dd><a href="../../account/subAdd/index.php">サブアカウントの追加</a></dd>
						<dd><a href="../../account/subEdit/index.php">サブアカウントの編集・削除</a></dd>
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