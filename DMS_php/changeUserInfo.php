<?php
	header("Content-type: text/html; charset=utf-8");
	$mysql_server_name='xxxxxxxxxxxxxxxxxxxx'; //改成自己的mysql数据库服务器
	$mysql_username='xxxxxxxxxxxxxxxxx'; //改成自己的mysql数据库用户名
	$mysql_password='xxxxxxxxxxxxxxx'; //改成自己的mysql数据库密码
	$mysql_database='xxxxxxxxxxxxxxxxx'; //改成自己的mysql数据库名
	$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库
	mysql_query("SET NAMES UTF8");
	mysql_select_db($mysql_database,$conn);
	$userID = $_POST["userID"];
	$countOfN1 = $_POST["countOfN1"];
	$countOfN2 = $_POST["countOfN2"];
	$countOfN3 = $_POST["countOfN3"];
	$countOfN4 = $_POST["countOfN4"];
	$countOfN5 = $_POST["countOfN5"];
	$result = mysql_query("UPDATE User SET countOfN1 = '$countOfN1',countOfN2 = '$countOfN2',countOfN3 = '$countOfN3',countOfN4 = '$countOfN4',countOfN5 = '$countOfN5' WHERE userID = '$userID'");
	$Data["result"] = $result;
	echo JSON($Data);
	mysql_close($conn);
	function arrayRecursive(&$array, $function, $apply_to_keys_also = false){  
	    static $recursive_counter = 0;  
	    if (++$recursive_counter > 1000) {  
	        die('possible deep recursion attack');  
	    }  
	    foreach ($array as $key => $value) {  
	        if (is_array($value)) {  
	            arrayRecursive($array[$key], $function, $apply_to_keys_also);  
	        } else {  
	            $array[$key] = $function($value);  
	        }  
	   
	        if ($apply_to_keys_also && is_string($key)) {  
	            $new_key = $function($key);  
	            if ($new_key != $key) {  
	                $array[$new_key] = $array[$key];  
	                unset($array[$key]);  
	            }  
	        }  
	    }  
	    $recursive_counter--;  
	}  
	function JSON($array) {  
	    arrayRecursive($array, 'urlencode', true);  
	    $json = json_encode($array);  
	    return urldecode($json);  
	}  
?>