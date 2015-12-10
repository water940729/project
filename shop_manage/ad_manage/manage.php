<?php
	require_once('../../conn/conn.php');
	//require_once('../inc_function.php');
	$ini_array = parse_ini_file("advertisement.ini", true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
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
						<li><a href="#">广告管理</a></li>
					</ul>		
				</div>
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：广告管理 －&gt; <strong>广告位管理</strong></span>
				</div>
				<div class="content">
					<table width="100%">
						<tr class="t1">
							<td width="40%">广告页面</td>
							<td width="40%">摆放位置</td>
							<td width="40%">广告价位</td>
						</tr>
						<?php
							foreach($ini_array as $key=>$row){
								if(preg_match("/price/", $key))continue;
								foreach ($row as $key1 => $value) {
						?>
						<tr>
							<td><?php echo $key;?></td>
							<td><?php echo $value;?></td>
							<td><?php echo $ini_array[$key."_price"][$value];?></td>
						</tr>
						<?php
								}
							}
						?>
					</table>
					<div class="page">
						<div class="pagebefore">当前页:<?php echo $page;?>/<?php echo $pagecount;?>页 每页 <?php echo $pagesize?> 条</div>
						<div class="pageafter">
						<?php echo showPage("ad_manage.php",$page,$pagecount,"../images");?>
						<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>