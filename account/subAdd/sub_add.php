<?php

include("../../common/lib.php");

notLogin("../../login.php");

$m = "";

notPost("index.php");

//アカウント名が入力されてるか
if($_POST["user_name"]==""){
	$m .= "<p class='nonF'>アカウント名を入力してください。</p>";
}

//パスワードが入力されてるか
if($_POST["user_pass"]==""){
	$m .= "<p class='nonF'>パスワードを入力してください。</p>";
}

//パスワード確認が入力されてるか
if($_POST["pass_check"]==""){
	$m .= "<p class='nonF'>パスワード確認を入力してください。</p>";
}

//パスワードとパスワード確認が一致するか
if ($_POST["user_pass"] != $_POST["pass_check"]){
	$m .= "<p class='nonF'>パスワードとパスワード確認が一致しません。</p>";
}

//エラー項目があったら戻す
if($m != ""){
	$_SESSION["message"] = $m;
	url_get("index.php");
}

//新規追加
$table = "user";

$retu = "user_name,user_pass";

$user_name = strip_tags(trim($_POST["user_name"]));
$user_pass = strip_tags(sha1(trim($_POST["user_pass"])));

$value = "'{$user_name}','{$user_pass}'";

$result = add_data($table,$retu,$value);

if($result){
	$m = "<p>「{$user_name}」を作成しました。<a href='../subEdit/index.php'>サブアカウント一覧へ</a></p>";
} else {
	$m =  "<p>失敗しました。同じアカウント名が存在する可能性があります。</p>";
}

$_SESSION["message"] = $m;
url_get("index.php");

?>