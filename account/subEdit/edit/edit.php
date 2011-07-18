<?php

include("../../../common/lib.php");

notLogin("../../../login.php");
notPost("../index.php");

$user_id = $_POST["user_id"];


$m = "";
$set = "";

//アカウント名の変更
if($_POST["edit_type"] == "name"){

	if ($_POST["user_name"] == ""){
		$m .= "<p class='nonF'>アカウント名を入力してください。</p>";
	}

	if($m != ""){
		$_SESSION["retry_u"] = $m;
		url_get("index.php?user_id={$user_id}");
	}
	
	$set = htmlspecialchars($_POST["user_name"],ENT_QUOTES,"UTF-8");

}

//現在のパスをもってくる
$retu = "user_pass";
$table = "user";
$rule = " WHERE user_id = '{$user_id}'";

$result = call_data($retu,$table,$rule);
$row = mysql_fetch_array($result);

//パスワードの変更
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
		
		url_get("index.php?user_id={$user_id}");
	}
	
	$set = sha1(trim(htmlspecialchars($_POST["user_pass"],ENT_QUOTES,"UTF-8")));

}

//アカウント名、パスワードのどちらかを編集
$table = "user"; 
$value = "user_{$_POST['edit_type']} = '{$set}'";
$rule = " WHERE user_id = '{$user_id}'";

$result = update($table,$value,$rule);

$re = "";

if(isset($result)){
	$_SESSION["message"] = "<p>サブアカウントの情報を変更しました。</p>";
} else {
	$_SESSION["message"] = "<p>サブアカウントの情報の変更に失敗しました。</p>";
}

url_get("index.php?user_id={$user_id}");

?>