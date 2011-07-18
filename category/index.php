<?php

include("../common/lib.php");

notLogin("../login.php");

$login_name = login_name();

$row_site = site_data();

$m = "";

if(isset($_GET["delete"])){
	$_SESSION["del_cat_id"] = $_GET["delete"];
	url_get("cat_edit.php");
}

if($_SESSION["message"]){
	$m .= $_SESSION["message"];
	$_SESSION["message"] = NULL;
	$m .= "<p><a href='index.php'>OK</a></p>";
}

$retu = "*";
$table = "category";
$rule = " ORDER BY cat_name";

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
	
	<link href="../css/base.css" rel="stylesheet" type="text/css" media="screen" />

	<title>カテゴリーの追加・編集・削除:LegendCMS</title>

</head>

<body>

<!-- container START -->
<div id="container">

	<!-- header START -->
	<div id="header">
	
		<div>
		
			<h1><a href="../index.php" title="管理画面のトップに戻ります"><img src="../images/logo.jpg" alt="レジェンドCMS"  width="157" height="39" /></a></h1>
			
			<h2><a href="<?php print $row_site["site_url"]; ?>" title="サイトのトップページを表示します" target="_blank"><?php print $row_site["site_name"]; ?></a></h2>
			
			<p><a href="<?php print $row_site["site_url"]; ?>" title="サイトのトップページを表示します" target="_blank"><img src="../images/btn_watchSite.jpg" alt="サイトを確認する" width="108" height="29" /></a></p>
			
		</div>
		
		<form action="../logout.php" method="post">
			<ul>
				<li id="utilManual"><a href="#">ヘルプ</a></li>
				<li id="utilLogout"><input onmouseover="this.className='logoutOver'"onmouseout="this.className='logoutNormal'" type="submit" id="sub" name="sub" value="" /></li>
				<li id="utilAccount"><a href="../account/index.php"><?php print $login_name; ?></a>でログイン中</li>
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
					<p><a href="../index.php">トップ</a><img src="../images/topicPath.gif" width="6" height="11" alt="の中の" /></p>
					<p>カテゴリーの追加・編集・削除</p>
				</div>
				<!-- topicpath END -->
		
				<!-- section START -->
				<div class="section">
				
					<div id="topichAreaL">
					
						<div id="topichAreaR">
						
							<div id="topichArea">
							
								<h3><img src="../images/h_catAll.jpg" width="208" height="18" alt="カテゴリーの追加・編集・削除" /></h3>
								
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

					<form action="cat_edit.php" method="post">

						<table summary="カテゴリー一覧の表です。カテゴリーの追加・編集・削除ができます。" cellpadding="0" cellspacing="0">
						
							<thead>
								<tr>
									<th scope="col" width="80%" id="tableFirst">カテゴリー名</th>
									<th scope="col" width="10%">編集</th>
									<th scope="col" width="10%">削除</th>
								</tr>
							</thead>
						
							<tbody>
							
								<?php
								
									//偶数・奇数判定に使うための変数
									$i = 0;
								
									//カテゴリーの数だtrを繰り返す
									while($row = mysql_fetch_array($result)){
									
										//取得したデータを変数に入れておく
										$cat_id = $row["cat_id"];
										$cat_name = $row["cat_name"];
										
										if($row["cat_parent_id"]==NULL){
										
											//偶数の場合は、checkGをつけてCSSで背景色を変える
											$i++;
										
											if($i%2 == 0){
												print "<tr class='checkG'>\n";
											} else {
												print "<tr>\n";
											}
											
											print "<td>";
												
											//編集ボタンが押されたときの処理
											if(isset($_GET["edit"])&&$cat_id==$_GET["edit"]){
												
												$edit_no = $_GET["edit"];
												
												print "<input type='text' id='cat_new' name='cat_new' value='{$cat_name}' />";
												print '<input type="submit" id="sub" name="sub" value="保存" />';
												print '<input type="submit" id="sub" name="sub" value="キャンセル" />';
						
											} else {
												
												//カテゴリー未選択時のカテゴリー
												if($cat_id == 0){
													print $cat_name."<span id='autoCatMessage'>（※カテゴリー未選択時に自動選択されるカテゴリーです）</span>";
												} else {
													print $cat_name;
												}
													
											}
												
											print "</td>";
												
											print "<td>";
											print "<a href='index.php?edit={$cat_id}'><img src='../images/btn_edit.png' alt='編集' widrh='27' height='27' /></a>";
											print "</td>";
											
											//カテゴリー未選択時のカテゴリー以外には、削除も出す
											if($cat_id != 0){
											
												print "<input type='hidden' id='cat_id' name='cat_id' value='{$cat_id}' />";
												print "<input type='hidden' id='cat_no' name='cat_no' value='{$edit_no}' />";
	
												print "<td><a href='#' onclick='flg({$cat_id});'><img src='../images/btn_delete.png' alt='削除' widrh='27' height='27' /></a></td>";
													
											}
											
											print "</tr>\r";
											
										}
										
										//このカテゴリーを親に持つカテゴリーを取得
										$retu_pa = "*";
										$table_pa = "category";
										$rule_pa = " WHERE cat_parent_id='{$cat_id}'";
										
										$result_pa = call_data($retu_pa,$table_pa,$rule_pa);
										
										//カテゴリーの数だtrを繰り返す
										while($row_pa = mysql_fetch_array($result_pa)){
										
											//取得したデータを変数に入れておく
											$cat_id = $row_pa["cat_id"];
											$cat_name = $row_pa["cat_name"];
											
											//偶数の場合は、checkGをつけてCSSで背景色を変える
											$i++;
										
											if($i%2 == 0){
												print "<tr class='checkG'>\n";
											} else {
												print "<tr>\n";
											}
											
											print "<td>";
											
											//編集ボタンが押されたときの処理
											if(isset($_GET["edit"])&&$cat_id==$_GET["edit"]){
												
												$edit_no = $_GET["edit"];
												
												print "<input type='text' id='cat_new' name='cat_new' value='{$cat_name}' />";
												print '<input type="submit" id="sub" name="sub" value="保存" />';
												print '<input type="submit" id="sub" name="sub" value="キャンセル" />';
						
											} else {
											
												print $cat_name;
													
											}
												
											print "</td>";
												
											print "<td>";
											print "<a href='index.php?edit={$cat_id}'><img src='../images/btn_edit.png' alt='編集' widrh='27' height='27' /></a>";
											print "</td>";
											
											
											print "<input type='hidden' id='cat_id' name='cat_id' value='{$cat_id}' />";
											print "<input type='hidden' id='cat_no' name='cat_no' value='{$edit_no}' />";
	
											print "<td><a href='#' onclick='flg({$cat_id});'><img src='../images/btn_delete.png' alt='削除' widrh='27' height='27' /></a></td>";
											
										}
										
									}	
								
								?>
							
								
								
								<tr>
								
									<td colspan="3">
									
									<?php
									
										//新規カテゴリー追加が押された時の処理
										if($_GET["new"]==true){
										
											print '<input type="text" id="cat_name" name="cat_name" value="新規カテゴリー" /><input type="submit" id="sub" name="sub" value="追加" /><input type="submit" id="sub" name="sub" value="キャンセル" />';
										
										} else {
										
											print "<a href='index.php?new=true'>新規カテゴリーを追加する</a>";
										
										}
										
									?>
									
									</td>
									
								</tr>
							
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
		
			<li><a href="../index.php" title="管理画面のトップに戻ります"><img src="../images/btn_menu_top.jpg" alt="トップ" width="150" height="30" /></a></li>
			
			<li>
				<dl>
					<dt><img src="../images/h_menu_category.jpg" alt="カテゴリー" width="150" height="30" /></dt>
						<dd id="active" title="カテゴリーの"><a href="index.php">追加・編集・削除</a></dd>
				</dl>
			</li>
			
			<li>
				<dl>
					<dt><img src="../images/h_menu_page.jpg" alt="ページ" width="150" height="30" /></dt>
						<dd title="ページの"><a href="../page/contribution/index.php">新規作成</a></dd>
						<dd title="ページの"><a href="../page/index.php">編集・削除</a></dd>
				</dl>
			</li>
			
			<li>
				<dl>
					<dt><img src="../images/h_menu_site.jpg" alt="サイト全般" width="150" height="30" /></dt>
						<dd title="サイトの"><a href="../site/index.php">サイト情報の編集</a></dd>
				</dl>
			</li>
			
			<li>
				<dl>
					<dt><img src="../images/h_menu_account.jpg" alt="アカウント" width="150" height="30" /></dt>
						<dd><a href="../account/index.php">マイアカウントの編集</a></dd>
						<dd><a href="../account/subAdd/index.php">サブアカウントの追加</a></dd>
						<dd><a href="../account/subEdit/index.php">サブアカウントの編集・削除</a></dd>
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