﻿<?php


header("Content-type:text/html;charset=utf-8");
require_once('../../conn/conn.php');
require_once('../inc_function.php');
require("../system_manage/add_system_log.php");	
/*$sql = "INSERT INTO `sunflowerMall`.`orderlist` (`id`, `userid`, `username`, `ordid`, `ordtime`, `checktime`, `productid`, `productname`, `productimage`, `producttype`, `shop_id`, `mall_id`, `mall_name`, `ordtitle`, `ordbuynum`, `ordprice`, `freight`, `cashback`, `ordfee`, `ordstatus`, `payment_type`, `payment_trade_no`, `payment_trade_status`, `payment_notify_id`, `payment_notify_time`, `payment_buyer_email`, `isused`, `usetime`, `checkuser`, `message`, `recname`, `recaddress`, `recphone`, `deliverydate`, `deliverytime`, `invoicetype`, `invoicetitle`, `invoicecontent`) VALUES (NULL, '9', '15249243295', '511435245431', '1435245431', '0', '59', 'Windtour/威迪瑞 新款冲锋衣三合一', 'http://112.124.3.197:8006/images/2015/06/upload_1434357829628.jpg', '', '1', '1', '怡丰城', NULL, '1', '199.00', '0.00', '0.00', '199.00', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '', '', '', '', '0000-00-00', '', '普通发票', '', '')";
for($i=0;$i<200;$i++){
	mysql_query($sql);
}
echo mysql_error();
exit();
*/

$result=mysql_query("select id,name from mall") or die("数据库异常");
	    $shopLocation[0]='葵花商城首页';
while($array=mysql_fetch_array($result)){
		$shopLocation[$array['id']]=$array['name'];
	 }
	 
$statusArr= array('已下单','已支付','已发货','已收货','待换货','已换货','待退货','已退货','已评价');

$controllArr = array('delete');
$tableName = 'orderlist';
$pageNum = 10;
$mallId = $_SESSION['mall_id'];
$tableNameArr = array('orderlist','teambuy_orderlist','seckill_orderlist','trial_orderlist','book_orderlist',' super_orderlist');
if(isset($_POST['cat'])){
	$tableName = $tableNameArr[$_POST['cat']];
}else{
	$tableName = 'orderlist';
}

$action = isset($_POST['action'])?$_POST['action']:'search';

if($action == 'search'){
	

	$order = isset($_POST['order'])?$_POST['order']:'DESC';
	$orderBy = isset($_POST['orderBy'])?$_POST['orderBy']:'id';
	$page = isset($_POST['page'])?intval($_POST['page']):1;
	$type = isset($_POST['type'])||!empty($_POST['type'])?$_POST['type']:-1;
    $mallId = isset($_POST['mallId'])||!empty($_POST['mallId'])?$_POST['mallId']:'';
	
	$condition = ' where 1=1 ';
	if($mallId !== ''){
		$condition.= ' and mall_id = '.$mallId.' ';
	}
	if($type != -1){
		$condition.= ' and ordstatus = '.$type.' ';
	}
	
	$sql ='select count(*) as number from '.$tableName.$condition;
	if($res = mysql_query($sql)){
		$row = mysql_fetch_assoc($res);
		$total = $row['number'];
	}else{
		 echo json_encode(array('status'=>0));
		 exit();
	}
	$pageTotal = ceil($total/$pageNum);
	
	$pageNumber = $pageTotal<=$page?$total%$pageNum:$pageNum;
	$pageShow = 5;
	
	$startPage = 0;
	$endPage = 0;
	
	if( floor($pageShow/2) >= $page  ){
		$startPage = 1; 
	}else{
		$startPage = $page-2;
	}
	
	if( floor($pageShow/2) > ($pageTotal-$page) ){
		$endPage = $pageTotal; 
		if(($endPage + 1 - $startPage) < $pageShow){
			$startPage = ($startPage-floor($pageShow/2))>0?($startPage-floor($pageShow/2)) : 1;
		}
	}else{
		$endPage = $page+2;
		if(($endPage + 1 - $startPage) < $pageShow){
			$endPage = $startPage + 4;
		}
	}
    

	if($page>1){
		$conStr.='<div onclick="changePage(this)"  name="'.($page-1).'">上一页</div>';
	}
	for($i=$startPage;$i<=$endPage;$i++){
		if($page==$i){$color='#87ceeb';}else{$color='#ffc0cb';}
		$conStr.='<span onclick="changePage(this)" style="background-color:'.$color.'" name="'.$i.'">'.$i.'</span>';
	}
	if($page<$pageTotal){
		$conStr.='<div onclick="changePage(this)"  name="'.($page+1).'">下一页</div>';
	}

	
	//echo $conStr;exit();
	//echo $startPage.'----',$endPage;exit();
	
	$sql= 'select id,ordid,mall_id,shop_id,username,ordtime,productname,ordbuynum,ordprice,freight,ordfee,ordstatus,recname,recaddress,expressName,expressNum from '.$tableName.$condition.' order by '.$orderBy.' '.$order.' limit '.(-1+$page)*$pageNum.','.$pageNumber;
	if($res = mysql_query($sql)){
		while($row = mysql_fetch_assoc($res)){
			$row['ordtime'] = date('Y-m-d',$row['ordtime']);
			$row['stausStr'] = $statusArr[$row['ordstatus']];
			$row['mall'] = $shopLocation[$row['mall_id']];
			$row['shop'] = $row['shop_id']==0?'自营':'商店编号'.$row['shop_id'];
			$row['right'] = $row['mall_id']==$_SESSION['mall_id'] && $row['shop_id']==0 ?1:0; 
			$data[] = $row;
		}
		echo json_encode(array('status'=>1,'data'=>$data,'constr'=>$conStr,'headStr'=>'此分类下 总计: '.$total.'个订单'));
	}else{
		echo json_encode(array('status'=>0));
		exit();
	}
	
}else if($action == 'delete'){
	
	if(isset($_POST['id'])){
		     $id=$_POST['id'];
		 }else{
			   exit(json_encode(array('status'=>0)));
	     }
	$sql = "delete from $tableName where id=".$id;
	
	if(mysql_query($sql)){
		echo json_encode(array('status'=>1));
		add_system_log('删除了订单 ID='.$id);
	}else{
		echo json_encode(array('status'=>0));
	}
	
}else if($action == 'changeStatus'){
	if(isset($_POST['id'])){
		      $id=$_POST['id'];
		 }else{
			exit(json_encode(array('status'=>0)));
	   }
	$sql = "select ordstatus,mall_id,shop_id from $tableName where id=$id";
	$res = mysql_fetch_row(mysql_query($sql));
	if($res[1]!=$mallId || $res[2]!=0 ){exit(json_encode(array('status'=>0)));}
	$status = $res[0];
	if($res[0] == 4){
	     $expressName = $_POST['expressName'];
		 $expressNum = $_POST['expressNum'];
		 $status = $status + 1 ;
	     $sql = "update $tableName set ordstatus = $status,expressName='$expressName',expressNum='$expressNum',handletime=".time()." where id=".$id;
		 if(mysql_query($sql)){
			exit(json_encode(array('status'=>1)));
		}else{
			exit(son_encode(array('status'=>0)));
		}
	}
	if($res[0] == 1){
	     $expressName = $_POST['expressName'];
		 $expressNum = $_POST['expressNum'];
		 $status = $status + 1 ;
	     $sql = "update $tableName set ordstatus = $status,expressName='$expressName',expressNum='$expressNum' where id=".$id;
		 if(mysql_query($sql)){
			exit(json_encode(array('status'=>1)));
		}else{
			exit(son_encode(array('status'=>0)));
		}
	}
	
	if ($res[0] == 6){
		 $status = $status + 1 ;
	     $sql = "update $tableName set ordstatus = $status,handletime=".time()." where id=".$id;
		if(mysql_query($sql)){
			//将钱换回去;
			/*$sql = "select shop_id,mall_id,ordfee from $tableName where id=".$id;
			$res = mysql_fetch_row(mysql_query($sql));
			$sql = 'update system_info set balanceMoney=balanceMoney-$res[2],useMoney=useMoney-$res[2] where id=0';
			mysql_query($sql);*/
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>0));
		}
	}else{
		echo json_encode(array('status'=>0));
	}
}


?>