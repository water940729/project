﻿<?php
	require_once("../../conn/conn.php");
	$result=mysql_query("select type1_id from goods_type2 where id=$_POST[id]");
	$row=mysql_fetch_array($result);
	$type1_id=$row['type1_id'];
	$sql="update goods_type2 set name='".$_POST[goods_type]."' where id=$_POST[id]";
	if(mysql_query($sql)){
		$content="Modified goods sorting level2,sort name is:".$_POST["goods_type"];
			$url='goods_type2.php?id='.$type1_id;
			echo "<script>alert('Modify success!');window.location.href='".$url."';</script>";
			//echo $content;
	}else{
		$url="modify_shop_food.php?id=$_POST[id]";
		echo "<script>alert('Modify failed,please try again!');window.location.href='".$url."';</script>";
		echo mysql_error();
	}