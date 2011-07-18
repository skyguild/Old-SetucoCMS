<?php

include("../common/lib.php");

notLogin("../login.php");
notPost("index.php");

$login_name = login_name();

//ログインしているアカウントのIDとパスをもってくる
$retu = "user_name,user_pass";
$table = "user";
$login = $_SESSION['login'];
$rule = " WHERE user_id = '{$login}'";

$result = call_data($retu,$table,$rule);
$row = mysql_fetch_array($result);

$m = "";
$set = "";

if($_POST["edit_type"] == "name"){

	//入力したものと、今のが同じだったらエラー
	if ($_POST["user_name"] == $row["user_name"]){
		$m .= "<p>新しいユーザ名を入力してください。</p>";
	} 

	if($m != ""){
		$_SESSION["retry_u"] = $m;
		url_get("index.php");
	}
	
	$set = htmlspecialchars($_POST["user_name"],ENT_QUOTES,"UTF-8");

}

if($_POST["edit_type"] == "pass"){

	if ($_POST["pass_old"] == ""){
		$m .= "<p class='nonF'>現在のパスワードを入力してください。</p>";
	} else {
		if(sha1($_POST["pass_old"]) != $row["user_pass"]){
			$m .= "<p class='nonF'>現在のパスワードが一致しません。</p>";
		}
	}
	if ($_POST["user_pass"] == ""){
		$m .= "<p class='nonF'>新しいパスワードを入力してください。</p>";
		
		if($_POST["pass_check"] == ""){
			$m .= "<p class='nonF'>パスワード確認を入力してください。</p>";
		}
		
	} else if($_POST["pass_check"] == ""){
		$m .= "<p class='nonF'>パスワード確認を入力してください。</p>";
	} else {
		if ($_POST["user_pass"] != $_POST["pass_check"]){
			$m .= "<p class='nonF'>新しいパスワードとパスワード確認が一致しません。</p>";
		}
	}

	if($m != ""){
		$_SESSION["retry_p"] = $m;
		url_get("index.php");
	}
	
	$set = sha1(trim(htmlspecialchars($_POST["user_pass"],ENT_QUOTES,"UTF-8")));

}

$table = "user"; 
$value = "user_{$_POST['edit_type']} = '{$set}'";
$rule = " WHERE user_id = '{$login}'";

$result = update($table,$value,$rule);

$re = "";

if(isset($result)){
	$_SESSION["message"] = "<p>マイアカウントの情報を変更しました。</p>";
} else {
	$_SESSION["message"] = "<p>マイアカウントの情報の変更に失敗しました。</p>";
}

url_get("index.php");

?>