<?php

include("../common/lib.php");

notLogin("../login.php");

$login_name = login_name();

$row_site = site_data();

$m = "";

//削除が押されたら、ページIDをpage_edit.phpに送る
if(isset($_GET["delete"])){
	$_SESSION["del_page_id"] = $_GET["delete"];
	url_get("page_edit.php");
}

//メッセージを取得
if($_SESSION["message"]){
	$m .= $_SESSION["message"];
	$_SESSION["message"] = NULL;
	$m .= "<p><a href='index.php'>OK</a></p>";
}

//ページのデータを取得
$retu = "*";
$table = "page";
$rule = " ORDER BY page_date DESC";

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

	<title>ページの編集・削除:LegendCMS</title>

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
				<li id="utilAccount"><a href="account/index.php"><?php print $login_name; ?></a>でログイン中</li>
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
					<p>ページの編集・削除</p>
				</div>
				<!-- topicpath END -->

				<!-- section START -->
				<div class="section">

					<div id="topichAreaL">

						<div id="topichAreaR">

							<div id="topichArea">

								<h3><img src="../images/h_pageAll.jpg" width="135" height="18" alt="ページの編集・削除" /></h3>

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

					<form action="page_edit.php" method="post" name="form">

						<table summary="ページ一覧の表です。タイトルのリンクと編集ボタンから、ページの編集ができます。削除ボタンから削除ができます。" cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th scope="col" width="7%" id="tableFirst">表示</th>
									<th scope="col" width="38%">タイトル</th>
									<th scope="col" width="13%">制作日</th>
									<th scope="col" width="10%">制作者</th>
									<th scope="col" width="15%">カテゴリー</th>
									<th scope="col" width="10%">状態</th>
									<th scope="col" width="7%">削除</th>
								</tr>
							</thead>

							<tbody>

								<?php

									//偶数・奇数判定に使う変数
									$i = 0;

									while($row = mysql_fetch_array($result)){

										//ページIDの取得
										$page_id = $row["page_id"];

										//サイトURLの取得
										$site_url = $row_site["site_url"];

										//ページタイトルの取得
										$page_title = $row["page_title"];

										//ページの投稿日の取得
										$page_date_r = $row["page_date"];
										$page_date_array = str_replace("-","/",$page_date_r);
										$page_date = substr($page_date_array,0,10);

										//投稿者名の取得
										$retu_u = "user_name";
										$table_u = "user";

										$user_id = $row["user_id"];
										$rule_u = " WHERE user_id='{$user_id}'";

										$result_u = call_data($retu_u,$table_u,$rule_u);

										$row_u = mysql_fetch_array($result_u);

										//カテゴリー名の取得
										$retu_cn = "cat_name";
										$table_cn = "category";

										$cat_id = $row["cat_id"];
										$rule_cn = " WHERE cat_id='{$cat_id}'";

										$result_cn = call_data($retu_cn,$table_cn,$rule_cn);

										$row_cn = mysql_fetch_array($result_cn);

										//偶数だったらcheckGをつけて、CSSで背景色を入れる
										$i++;

										if($i%2 == 0){
											print "<tr class='checkG'>\n";
										} else {
											print "<tr>\n";
										}


										//ページの表示
										tab("10");
										print "<td><a href='{$site_url}/page.php?page_id={$page_id}' target='_blank'><img src='../images/btn_check.png' alt='表示' widrh='27' height='27' /></a></td>\n";

										//ページタイトル
										tab("10");
										print "<td><a href='edit/index.php?page_id={$page_id}'>";
										print $page_title;
										print "</a></td>\n";

										//ページの投稿日
										tab("10");
										print "<td>";
										print $page_date;
										print "</td>\n";

										//投稿者名
										tab("10");
										print "<td>";
										print $row_u["user_name"];
										print "</td>\n";


										//カテゴリー名
										tab("10");
										print "<td>";

										$retu_c = "cat_id,cat_name";
										$table_c = "category";
										$rule_c = " ORDER BY cat_name";

										$result_c = call_data($retu_c,$table_c,$rule_c);

										// 編集するページ（onchangeでGETを送ったページ）だったらidをstate_newにする
										if($_GET["cat_edit"] == $row['page_id']){

											$selectid = "cat_new";

										} else {

											$selectid = "not_cat";

										}

										print '<select id="' . $selectid . '" name="' . $selectid . '"';

										if(!isset($_GET["cat_edit_id"])){

											//selectをチェンジしたら編集するページのIDを送る
											//selectで選択したカテゴリーのIDを送る
										?>

											onchange="location.href='index.php?cat_edit=<?php print $page_id; ?>&selected=' + (this.options[this.selectedIndex].value);"

										<?

										}

										print '>';

										//GETが送られてきたら、
										if($row["page_id"]==$_GET["cat_edit"]){

											//カテゴリー全部を出力
											while($row_c = mysql_fetch_array($result_c)){

												$cat_id = $row["cat_id"];
												$cat_id_c = $row_c["cat_id"];

												//onchageで選択したのをデフォルト選択
												if($cat_id_c==$_GET['selected']){
													print "<option value='{$cat_id_c}' selected='selected'>{$row_c[1]}</option>";
												} else {
													print "<option value='{$cat_id_c}'>{$row_c[1]}</option>";
												}

											}

											//送られてきたページ番号をhiddenで送る
											$page_id = $_GET["cat_edit"];

											print "<input type='hidden' id='page_id' name='page_id' value='{$page_id}' />";

											//変更・キャンセルを表示
											print '<br />';
											print '<input type="submit" id="sub" name="sub" value="変更" />';
											print '<input type="submit" id="sub" name="sub" value="キャンセル" />';

										} else {

											//カテゴリー全部を出力
											while($row_c = mysql_fetch_array($result_c)){

												$cat_id = $row["cat_id"];
												$cat_id_c = $row_c["cat_id"];

												//該当するカテゴリーをデフォルト選択
												if($cat_id_c==$cat_id){
													print "<option value='{$cat_id_c}' selected='selected'>{$row_c[1]}</option>";
												} else {
													print "<option value='{$cat_id_c}'>{$row_c[1]}</option>";
												}

											}

										}

										print "</select>";

										print "</td>\n";


										//公開状態
										tab("10");
										$page_state = $row["page_state"];

										print "<td>";

										// 編集するページ（onchangeでGETを送ったページ）だったらidをstate_newにする
										if($_GET["state_edit"] == $row['page_id']){

											$selectid = "state_new";

										} else {

											$selectid = "not_this";

										}

										print '<select id="' . $selectid . '" name="' . $selectid . '"';

										if(!isset($_GET["state_edit"])){

											//selectをチェンジしたら編集するページのIDを送る
											print 'onchange="'."location.href='index.php?state_edit={$row['page_id']}'".'"';
										}

										print '>';

										if($_GET["state_edit"] == $row['page_id']){

											//GETが送られてきたら、現在の公開状態と逆をデフォルト表示
											if($page_state==0){

												print "<option value='0'>下書き</option>\n";
												print "<option value='1' selected>公開</option>\n";

											} else if($page_state==1) {

												print "<option value='0' selected>下書き</option>\n";
												print "<option value='1'>公開</option>\n";

											}

											$edit_page_id = $_GET["state_edit"];

											print "<input type='hidden' id='edit_page_id' name='edit_page_id' value='{$edit_page_id}' />";

											print '<br />';
											print '<input type="submit" id="sub" name="sub" value="保存" />';
											print '<input type="submit" id="sub" name="sub" value="キャンセル" />';

										} else {

											if($page_state==0){

												print "<option value='0' selected>下書き</option>\n";
												print "<option value='1'>公開</option>\n";

											} else if($page_state==1) {

												print "<option value='0'>下書き</option>\n";
												print "<option value='1' selected>公開</option>\n";

											}

										}

										print "</select>";

										print "</td>\n";

										tab("10");
										print "\n";?>

										<?php
										//削除
										tab("10");
										print "<td><a href='#' onclick='flg({$page_id});'><img src='../images/btn_delete.png' alt='削除' widrh='27' height='27' /></a></td>\n";

										tab("9");
										print "</tr>\n\n";

										tab("9");
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

			<li><a href="../index.php" title="管理画面のトップに戻ります"><img src="../images/btn_menu_top.jpg" alt="トップ" width="150" height="30" /></a></li>

			<li>
				<dl>
					<dt><img src="../images/h_menu_category.jpg" alt="カテゴリー" width="150" height="30" /></dt>
						<dd title="カテゴリーの"><a href="../category/index.php">追加・編集・削除</a></dd>
				</dl>
			</li>

			<li>
				<dl>
					<dt><img src="../images/h_menu_page.jpg" alt="ページ" width="150" height="30" /></dt>
						<dd title="ページの"><a href="../page/contribution/index.php">新規作成</a></dd>
						<dd id="active" title="ページの"><a href="../page/index.php">編集・削除</a></dd>
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