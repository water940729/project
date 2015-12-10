<?php
	require_once("../../conn/conn.php");
	require_once("../inc_function.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css"/>
		<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
		<script>
			$(function(){
				$(".check").click(function(){
					var $parent=$(this).parents("tr");
					var id=$parent.attr("id");
					var state=$parent.children(".state").attr("name");
					if(state==1){
						alert("该用户已审核过");
					}else if(state==-1){
						alert("该用户已失效");
					}else{
						$.post("check_user.php",{user_id:id},function(data){
							if(data==1){
								alert("审核成功");
								location.reload();
							}else{
								alert("未知错误，请稍后再试");
							}
						});	
					}
				});
				$(".delete").click(function(){
					var $parent=$(this).parents("tr");
					var id=$parent.attr("id");
					var state=$parent.children(".state").attr("name");
					if(state==-1){
						alert("该用户已失效，不可重复删除");
					}else{
						$.post("delete_user.php",{user_id:id},function(data){
							if(data==1){
								alert("删除成功，该用户已失效");
								location.reload();
							}else{
								alert("未知错误，请稍后再试");
							}
						});
					}
				});
			});
		</script>
		<script language="javascript" type="text/javascript" src="../js/My97DatePicker/WdatePicker.js"></script>
	</head>
	<body>
		<div class="bgintor">
				<div class="tit1">
					<ul>				
						<li><a href="#">用户管理</a></li>
					</ul>		
				</div>
				<div class="listintor">
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：用户管理 －&gt;<strong>查看用户</strong></span>
				</div>
				<div class="content">
					<form action="#" method ="post" name="listForm">
						<table width="100%">
							<tr class="t1">
							    <td width="10%">序号</td>							
							    <td width="10%">账号</td>							
							    <td width="10%">状态</td>							
							    <td width="10%">上次登录时间</td>
								<td width="10%">操作</td>
							</tr>
							<?php
								$pagesize=20;							
								$select="select count(*) as page_count from user_manage";
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
								$query="select user_id,username,state,last_time from user_manage order by user_id desc limit ".$pagestart.",".$pagesize;
								$res=mysql_query($query);
								while($row=mysql_fetch_array($res)){
							?>
							<tr id="<?php echo $row["user_id"]?>">		 
								<td><?php echo $row["user_id"] ?></td>   
								<td><?php echo $row["username"] ?></td>
								<td class="state" name="<?php echo $row["state"]?>">
							<?php
								switch($row["state"]){
									case 0:
										echo "待审核";
										break;
									case 1:
										echo "活跃";
										break;
									case -1:
										echo "失效";
										break;
								}
							?>
								</td> 
								<td><?php echo date("Y-m-d H:i:s",$row["last_time"]); ?></td>
								<td><a href="#" target="mainFrame" class="delete">删除</a>|<a href="#" target="mainFrame" class="check">审核</a></td>
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
						<?php echo showPage("search_user.php",$page,$pagecount,"../images");?>
						<div class="clear"></div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</body>
</html>