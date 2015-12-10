<?php
/*
添加管理员


*/
	include_once("../../conn/conn.php");
	require("../system_manage/add_system_log.php");	
	$name=$_POST['name'];
	$role=$_POST['role'];
	$passwd=$_POST['password'];
	$passwd=md5($passwd);
	$time=time();
	if($role==1){
		$insert ="insert into admin_manage(name,passwd,role,time) values('$name','$passwd','$role','$time')";
		$roles="超级管理员";
	}elseif($role==2){
		$mall=$_POST['mall'];
		$insert ="insert into admin_manage(name,passwd,role,mall_id,time) values('$name','$passwd','$role','$mall','$time')";
		$roles="商场管理员，管理商城编号为".$mall;
	}else{
		$shop=$_POST['shop'];
		$select="select mall_id from shop where id='$shop'";
		$result=mysql_query($select);
		$row=mysql_fetch_array($result);
		$mall_id=$row['mall_id'];
		$insert ="insert into admin_manage(name,passwd,role,mall_id,shop_id,time) values('$name','$passwd','$role','$mall_id','$shop','$time')";
		$roles="商户管理员，管理商户编号为".$shop;
	}
	
	if(mysql_query($insert)){
		$content="添加了一个账号，账号信息：账户名".$name."，账户权限".$roles;
		if(add_system_log($content)==1){
			$url="manage_account.php";
			echo "<script>alert('添加成功!');window.location.href='".$url."';</script>";
		}else{
			echo "<script>alert('添加失败,请重新添加!');window.location.href='add_manage_account.php';</script>";
	   }
	}else{
	   echo "<script>alert('添加失败,请重新添加!');window.location.href='add_manage_account.php';</script>";
	}
?>