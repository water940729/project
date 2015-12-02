<?php
	require_once('../../conn/conn.php');
	require_once('../inc_function.php');
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
						<li><a href="#">商场管理</a></li>
					</ul>		
				</div>
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：商场管理 －&gt; <strong>查看商场</strong></span>
				</div>
				<div class="content">
					<table width="100%">
						<tr class="t1">
							<td width="5%">商场序号</td>
							<td width="10%">商场名称</td>
							<td width="10%">省份</td>
							<td width="10%">市</td>
							<td width="10%">区</td>
							<td width="20%">详细地址</td>
							<td width="20%">商场简介</td>
							<td width="15%">操作</td>
						</tr>
						<?php
							$pagesize=20;							
							$select="select count(*) as page_count from mall";
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
							$sql1="select * from mall order by id desc limit ".$pagestart.",".$pagesize;
							$result1=mysql_query($sql1);
							while($row1=mysql_fetch_array($result1))
							{	
								$id=$row1['id'];
								$name=$row1['name'];
								$province=$row1['province'];
								$city=$row1['city'];
								$county=$row1['county'];
								$detail_address=$row1['detail_address'];
								$introduceInfo=$row1['introduceInfo'];
						?>
						<tr>
							<td><?php echo $id?></td>
							<td><?php echo $name?></td>
							<td><?php echo $province?></td>
							<td><?php echo $city?></td>
							<td><?php echo $county?></td>
							<td><?php echo $detail_address?></td>
							<td><?php echo $introduceInfo?></td>
							<td>
							<?php
								if($_SESSION["role"]==1){
									echo"<a href='../shop_manage/add_shop.php?mall_id={$id}'>添加店铺</a>";
								}
							?>
								<a href="check_mall_shop.php?mall_id=<?=$id?>&mall_name=<?=$name?>">查看店铺</a>|
								<a href="edit_mall.php?mall_id=<?=$id?>">修改商场</a>|
								<a href="javascript:void(0);" onclick="delete_mall(<?=$id?>,'<?=$name?>')">删除</a>
							</td>
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
						<?php echo showPage("check_mall.php",$page,$pagecount,"../images");?>
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
	function delete_mall(mall_id,mall_name){
		if(confirm("删除商场会同时删除商场所对应的所有店铺和商品，您确认要删除"+mall_name+"吗")){
			$.post("delete_mall_do.php",
				{
					mall_id:mall_id
				},
				function(data,status){
					if(data==1){
						alert("删除成功!");
						location.reload();
					}else{
						alert(data);
					}
				}
			);
		}
	}
</script>