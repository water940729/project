<?php
	require_once('../../conn/conn.php');
	require_once('../inc_function.php');
	require_once('function.php');
	$role=$_SESSION['role'];
	$mall_id=$_SESSION['mall_id'];
	$area=" ";
	if($role==2){
		$area=" where role=3 and mall_id='$mall_id'";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css"/>
		<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
		<script language="javascript" type="text/javascript" src="../js/My97DatePicker/WdatePicker.js"></script>
	</head>
	<body>
		<div class="bgintor">
				<div class="tit1">
					<ul>				
						<li><a href="#">账号管理</a></li>
					</ul>		
				</div>
				<div class="listintor">
				<div class="header1">
					<span>位置：账号管理 －&gt;<strong>查看账号</strong></span>
				</div>
				<div class="content">
					<form action="#" method ="post" name="listForm">
						<table width="100%">
							<tr class="t1">
							    <td width="10%">序号</td>							
							    <td width="10%">管理员账号</td>							
							    <td width="10%">权限</td>							
							    <td width="10%">管理区域</td>							
								<td width="10%">上次登录IP</td>
								<td width="10%">本次登录IP</td>
								<td width="10%">登录次数</td>								
								<td width="10%">上次登录时间</td>
								<td width="10%">操作</td>
							</tr>
							<?php
								$pagesize=20;							
								$select="select count(*) as page_count from admin_manage".$area;
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
								$query="select id,name,role,mall_id,shop_id,time,last_ip,now_ip,log_num from admin_manage".$area."order by role asc limit ".$pagestart.",".$pagesize;
								$res=mysql_query($query);
								while($row=mysql_fetch_array($res)){
							?>
							<tr>		 
								<td><?php echo $row["id"] ?></td>   
								<td><?php echo $row["name"] ?></td>   
								<td><?php echo getRole($row["role"]) ?></td>   
								<td><?php echo getRoleArea($row["role"],$row["shop_id"],$row["mall_id"]) ?></td> 
								<td><?php echo $row["last_ip"] ?></td> 
								<td><?php echo $row["now_ip"] ?></td>
								<td><?php echo $row["log_num"] ?></td>
								<td><?php echo $row["time"] ?></td>
								<td><a onclick="return check(<?=$row["id"]?>)" href="javascript:void(0)">删除</a></td> 								
							</tr>
							<?php }?>
						
						</table>
					</form>
					<?php	
						if($count==0){
							echo "<center><b>没有相关信息！</b></center>";
						}else{
					?>
					<div class="page">
						<div class="pagebefore">当前页:<?php echo $page;?>/<?php echo $pagecount;?>页 每页 <?php echo $pagesize?> 条</div>
						<div class="pageafter">
						<?php echo showPage("manage_account.php",$page,$pagecount,"../images");?>
						<div class="clear"></div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</body>
</html>
<script>
function check(admin_manager_id)
{
	var del=confirm("你确定要删除吗？");
	if(del){
		alert(admin_manager_id);
		$.post("delete_manager_account.php",
			{
				admin_manager_id:admin_manager_id
			},
			function(data,status){
				if(data==1){
					alert("删除成功");
					window.location.href="manage_account.php";
				}else{
					alert("删除失败！");
					return false;
				}
			}
		)
	}else{
		return false;
	}
}	
</script>