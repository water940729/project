<?php
	require_once("../../conn/conn.php");
	require_once("../inc_function.php");
	
	 if($_SESSION['role'] == 1){
		$shopPage = isset($_GET['shopPage'])?$_GET['shopPage']:0;
	}else if($_SESSION['role'] == 2){
		$shopPage = $_SESSION['mall_id'];	
	}
	if(isset($_GET['cat'])){
	$cat = $_GET['cat'];
   }else{
	$cat = 0;
    }
    $tableNameArr = array('商城','团购','秒杀','试用','预售');
	$tableArr = array('orderlist','teambuy_orderlist','seckill_orderlist','trial_orderlist','book_orderlist');
	
	$result=mysql_query("select id,name from mall") or die("数据库异常");
	    $shopLocation[0]='葵花商城';
	 while($array=mysql_fetch_array($result)){
		  $shopLocation[$array['id']]=$array['name'];
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
	<style>
	.conSpan{
		float:right;
		margin-right:100px;
		font-size:14px;
	}
	.conSpan>span{
		font-size:14px;
		float:right;
		margin-left:20px;
	}
	
	</style>
	<body>
		<div class="bgintor">
				<div class="tit1">
					<ul>				
					<li><a href="#">按商城分类</a></li>
					<!--
					<li class="l1" ><a href="sum_order_shop.php" target="mainFrame">按商铺分类</a></li>
					<li class="l1" ><a href="sum_order_good.php" target="mainFrame">按商品分类</a></li>
					-->
					</ul>		
				</div>
				<div class="listintor">
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：订单管理 －&gt;<strong>商品统计列表-------<?php echo $tableNameArr[$cat]; ?></strong></span>
					<!-- <span class='conSpan'>选择 : <span '><a href='./sum_order.php?cat=0'>商城</a ></span><span '><a href='./sum_order.php?cat=1' >团购</a></span><span ><a href='./sum_order.php?cat=2' >秒杀</a></span></span> -->
				</div>
				<div class="content">
					<form action="#" method ="post" name="listForm">
						<table width="100%">
							<tr class="t1">
							    <td width="15%">商城编号</td>
								<td width="40%">统计信息</td>
								<td width="10%">操作</td>	
							</tr>
<?php
/*
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
$query="select id from mall limit ".$pagestart.",".$pagesize;
$res=mysql_query($query);
$tableName = 'orderlist';
*/
$tableName = $tableArr[$cat];
$sql = "SELECT count(id) as sum , mall_id , ordstatus  FROM  `$tableName`  group by ordstatus,mall_id ORDER BY mall_id ";

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res)){
	$data[$row['mall_id']][$row['ordstatus']] = $row['sum'];
}
foreach($shopLocation as $key=>$val){
	
?>
							<tr>
								<td><?php echo $val;?></td>   
								<td width='80%'><a href="./orderManage.php?id=<?php echo $key; ?>&type=0&cat=<?php echo $cat;?>">已下单
									<?php
										echo isset($data[$key][0])?$data[$key][0]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=1&cat=<?php echo $cat;?>">已支付
									<?php
										echo isset($data[$key][1])?$data[$key][1]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=2&cat=<?php echo $cat;?>">已发货：
									<?php
										echo isset($data[$key][2])?$data[$key][2]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=3&cat=<?php echo $cat;?>">已收货
									<?php
										echo isset($data[$key][3])?$data[$key][3]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=4&cat=<?php echo $cat;?>">待换货
									<?php
										echo isset($data[$key][4])?$data[$key][4]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=5&cat=<?php echo $cat;?>">已换货
									<?php
										echo isset($data[$key][5])?$data[$key][5]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=6&cat=<?php echo $cat;?>">待退货
									<?php
										echo isset($data[$key][6])?$data[$key][6]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=7&cat=<?php echo $cat;?>">已退货
									<?php
										echo isset($data[$key][7])?$data[$key][7]:0;
								    ?>件</a>&nbsp;|&nbsp;<a href="./orderManage.php?id=<?php echo $key; ?>&type=8&cat=<?php echo $cat;?>">已评价
									<?php
										echo isset($data[$key][8])?$data[$key][8]:0;
								    ?>件</a>
								</td>
								<td>
								     <a href="./orderManage.php?id=<?php echo $key; ?>&cat=<?php echo $cat;?>">查看</a>
								</td>
								</tr>
							<?php }?>
						</table>
					</form>

				</div>
			</div>
		</div>
	</body>
</html>