<?php

include("../../common/lib.php");

notLogin("../../login.php");

$m = "";

if(isset($_SESSION["del_sub_id"])){
	$user_no = $_SESSION["del_sub_id"];
	$_SESSION["del_sub_id"] = NULL;

	$result_d = call_data("user_name","user"," WHERE user_id='{$user_no}'");
	$row_d = mysql_fetch_array($result_d);
		
	$r = delete("user","user_id='{$user_no}'");
		
	if($r == ok){
		$m .= "<p>「{$row_d[0]}」を削除しました。</p>"; 
	} else if($r == ng){
		$m .= "<p>失敗しました。</p>"; 
	}
}
	
$_SESSION["message"] = $m;
url_get("index.php");

?>