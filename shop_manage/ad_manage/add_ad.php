<?php
	include ("../../smarty.php"); //引入配置文件
    //$smarty->assign('name',$name); //用定义的变量$name的值("OK")替换掉模版中的<{$name}>
	$result=mysql_query("select id,name from mall") or die("数据库异常");
	while($array=mysql_fetch_array($result)){
		  $shopLocation[]=$array;
	}
	mysql_free_result($result);
	
	$result=mysql_query("select * from adLocation") or die("数据库异常");
		while($array=mysql_fetch_array($result)){
		  $adLocation[]=$array;
	}

$locationArr = array('顶部','一层','二层','三层','四层');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css" />
		<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	</head>
<style>
table
{
   width:400px;
   border:1px;  
}
table,th,td{ 
 border : 1px solid black;
}
table td{
    text-align:center;
}
td{
  padding:10px;
}
</style>

<body>
		<div class="bgintor">				
			<div class="listintor">
				<div class="tit1">
					<ul>				
						<li><a href="#">广告管理</a></li>
					</ul>		
				</div>
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：广告管理 －&gt; <strong>查看广告</strong></span>
					<span style="margin-left:30px;">广告商城位置 
					<select id='direction'>
					<?php
					foreach($directionArr as $k=>$val){
					     echo "<option value=$k>$val</option>";
					}
					?> 
					</select >
					<span>广告楼层位置 
					<select id='location'>
					<?php
					foreach($locationArr as $k=>$val){
					     echo "<option value=$k>$val</option>";
					}
					?> 
					</select>
					<button onclick="searchLoc()" type='button'>查询</button>
					</span>
				</div>
				<div class="content">
					<table width="100%">
						<tr class="t1">
							<td>商城位置</td>
							<td>楼层位置</td>
							<td>广告价格/月</td>
							<td>是否在用</td>
							<td>广告链接</td>
							<td>操作</td>
						</tr>
						<?php 
	      foreach($adLocation as $val){
		  //var_dump($val);
		      echo "<tr>".
			        "<td>".$shopLocation[$val['topLocation']]['name']."</td>".
			        "<td>".$locationArr[1]."</td>".
					"<td>".$val['price']."</td>".
					"<td>".$val['price']."</td>".
					"<td>".$val['price']."</td>".
					"<td>".'<a>删除</a>'."</td>".
			        "</tr>";
		  } 
		?>
					</table>
				</div>
			</div>	
		</div>
	</body>
	
</html>