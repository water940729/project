<?
	require("../../conn/conn.php");
	require_once("../inc_function.php");
	//print_r($_SESSION);
	$area="";
//( [wii_imgcode] => 3358 [name] => water [role] => 1 [role_area] => 超级管理员 [id] => 10 [shop_id] => 0 [mall_id] => 0 )
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>系统管理</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css" />
		<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="bgintor">				
			<div class="listintor">
				<div class="tit1">
					<ul>				
						<li><a href="#">系统管理</a></li>
					</ul>		
				</div>
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：系统管理 －&gt; <strong>系统日志</strong></span>
				</div>
				<div class="content">
					<table width="100%">
						<tr class="t1">
							<td width="5%">日志序号</td>
							<td width="5%">管理员名字</td>
							<td width="40%">内容</td>
							<td width="5%">时间</td>
							<!--<td width="10%">操作</td>-->
						</tr>
						<?php
							$pagesize=20;							
							$select="select count(*) as page_count from system_log".$area;
							$rest=mysql_query($select);
							$rs=mysql_fetch_array($rest);
							$count=$rs['page_count'];						
							if($count%$pagesize){
							$pagecount = intval($count/$pagesize)+1;
							}else{
								$pagecount = intval($count/$pagesize);
							}
							if(isset($_GET['page'])){
								$page=intval($_GET['page']);
							}else{
								$page=1;
							}
							$pagestart = ($page-1)*$pagesize;
							$sql1="select * from system_log".$area." order by time desc limit ".$pagestart.",".$pagesize;
							$result1=mysql_query($sql1);
							while($row1=mysql_fetch_array($result1))
							{	
								$id=$row1['id'];
								$name=$row1['admin_name'];
								$content=$row1["content"];
								$time=$row1["time"];
						?>
						<tr>
							<td><?php echo $id?></td>
							<td><?php echo $name?></td>
							<td><?php echo $content?></td>
							<td><?php echo date("Y-m-d	 H:i:s",$time);?></td>
							<!--
							<td>
								<a href="../homepage_manage/recommend.php?goods_id=<?=$id?>">推荐到首页</a>|
								<a href="edit_goods.php?goods_id=<?=$id?>&from=goods">修改商品</a>|
								<a href="javascript:void(0);" onclick="delete_goods(<?=$id?>)">删除</a>
							</td>
							-->
						</tr>
						<?php
							}	
						?>
					</table>
					<?php	
						if($count==0){
							echo "<center><b>没有相关信息！</b></center>";
						}else{
					?>
					<div class="page">
						<div class="pagebefore">当前页:<?php echo $page;?>/<?php echo $pagecount;?>页 每页 <?php echo $pagesize?> 条</div>
						<div class="pageafter">
						<?php echo showPage("system_log.php",$page,$pagecount,"../images");?>
						<div class="clear"></div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>	
		</div>
	</body>
</html>