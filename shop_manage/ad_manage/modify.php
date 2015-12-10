<?php
	$ini_array = parse_ini_file("advertisement.ini", true);
	$ini_array[$_POST["select1"]."_price"][$_POST["select2"]]=$_POST["price"];
	
	$content="";
	foreach($ini_array as $key=>$row){
		$content.="[".$key."]\r\n";
		foreach($row as $k=>$v){
			$content.=$k."=".$v."\r\n";
		}
	}
	if(!$file=fopen("advertisement.tmp","w")){
		exit("不能修改");
	}
	if(!fwrite($file,$content)){
		exit("服务器异常");
	}
	fclose($file);
	if(rename("advertisement.tmp","advertisement.ini")){
		echo 1;
	}else{
		echo"修改失败，请重试";
	}