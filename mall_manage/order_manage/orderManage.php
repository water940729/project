<?php

	 include ("../../conn/conn.php");
	 if($_SESSION['role'] == 1){
		$shopPage = isset($_GET['shopPage'])?$_GET['shopPage']:0;
	}else if($_SESSION['role'] == 2){
		$shopPage = $_SESSION['mall_id'];	
	}
	
	$result=mysql_query("select id,name from mall") or die("数据库异常");
	    $shopLocation[0]='葵花商城';
	 while($array=mysql_fetch_array($result)){
		  $shopLocation[$array['id']]=$array['name'];
	 }
	 
	mysql_free_result($result);
	$result=mysql_query("select * from adLocation where pageLocation =$shopPage") or die("数据库异常");
		while($array=mysql_fetch_array($result)){
		  $adLocation[]=$array;
	 }
	$mallId = isset($_SESSION['mall_id'])?$_SESSION['mall_id']:0;
	if($mallId == 0) 
	{exit();}
	
	if(isset($_GET['shopId'])){
		$shopId = $_GET['shopId'];
		$sql = 'select name from shop where id='.$shopId;
        $result = mysql_fetch_row(mysql_query($sql));
		}else{$shopId=0;}
	//$result[0] = '自营';
	
	if(isset($_GET['type'])){
		$type = $_GET['type'];
		}else{$type=-1;}
	
	if(isset($_GET['cat'])){
	$cat = $_GET['cat'];
   }else{
	$cat = 0;
    }
    $tableNameArr = array('商城','团购','秒杀','试用','预售');
	$tableArr = array('orderlist','teambuy_orderlist','seckill_orderlist','trial_orderlist','book_orderlist');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css" />
		<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		
					 
		 var type = <?php echo $type ?>;
		 var cat = <?php  echo $cat; ?>;
		 var order = 'DESC';
		 var orderBy = 'id';
		 var page = 1;
		 var currentType;
		 var currentOrder;
		 var mallId= <?php  echo $mallId; ?>;
		 var shopId= <?php  echo $shopId; ?>;
		 
		 function changeMall(){
			mallId = $("#direction").val();
			order = 'DESC';
			orderBy = 'id';
			page = 1;
			currentType='';
			currentOrder='';
			searchGoods();
		 }
		function searchGoods(){
			 
			 $.ajax({
				   type: "POST",
				   url: "orderManageController.php",
				   data: "action=search&cat="+cat+"&type="+type+"&order="+order+"&orderBy="+orderBy+"&page="+page+'&mallId='+mallId+'&shopId='+shopId,
				   success: function(msg){
					 var dataObj=eval("("+msg+")");//转换为json对象
					 if(dataObj['status'] == 1){
						 $('#pageConDiv').empty();
						 $("#pageConDiv").append(dataObj['constr']);
						 
						 $("#orderTable").empty();
						// var headStr ='<tr><td colspan=11 >'+dataObj['headStr']+'</td></tr>';
						 //$("#orderTable").append(headStr);
						 var str ='<tr><td colspan=15 >'+dataObj['headStr']+'</td></tr>'+
						    ' <tr class="t1" id="adTableLine">'+
							'<td >订单编号</td>'+
							'<td >订单用户</td>'+
							'<td >商品商城</td>'+
							'<td >商店</td>'+								
							'<td >商品名称</td>'+					
							'<td >价格</td>'+
							'<td >收件人</td>'+
							'<td >收件地址</td>'+
							'<td >订单时间</td>'+
							'<td>支付金额</td>'+
							'<td>快递名称</td>'+
							'<td>快递订单号</td>'+
							'<td >订单状态</td>'+
							'<td >删除</td>'+
							'<td >操作</td>'+
						    '</tr>';
						  $("#orderTable").append(str);
						   for(var i=0;i<dataObj['data'].length;i++){
							  str ="<tr tag='' style='background-color:' name='"+dataObj['data'][i]['id']+"'>"+
							        "<td>"+dataObj['data'][i]['ordid']+"</td>"+
									"<td>"+dataObj['data'][i]['username']+"</td>"+
									"<td>"+dataObj['data'][i]['mall']+"</td>"+
									"<td>"+dataObj['data'][i]['shop']+"</td>"+
									"<td>"+dataObj['data'][i]['productname']+"</td>"+
									"<td>"+dataObj['data'][i]['ordprice']+"</td>"+
									"<td>"+dataObj['data'][i]['recname']+"</td>"+
									"<td>"+dataObj['data'][i]['recaddress']+"</td>"+
									"<td>"+dataObj['data'][i]['ordtime']+"</td>"+
									"<td>"+dataObj['data'][i]['ordfee']+"</td>"+
									"<td>"+dataObj['data'][i]['expressName']+"</td>"+
									"<td>"+dataObj['data'][i]['expressNum']+"</td>"+
									"<td>"+dataObj['data'][i]['stausStr']+"</td>";
									
							  if(dataObj['data'][i]['right'] == 1){
								   str += "<td onclick='deleteOrder(this)' style='cursor:pointer'>删除</td>";
								 if(dataObj['data'][i]['ordstatus'] == 1){
								     str = str + '<td onclick="sendGoods(this)" style="cursor:pointer" >设置发货</td></tr>';
							     }
								 else if(dataObj['data'][i]['ordstatus'] == 4){
									  str = str + '<td onclick="sendGoods(this)" style="cursor:pointer" >设置换货</td></tr>';
								 }else if(dataObj['data'][i]['ordstatus'] == 6){
									  str = str + '<td onclick="changeStatus(this)" style="cursor:pointer" >设置退货</td></tr>';
								 }
								 else{
								     str = str+'<td onclick="" style="cursor:pointer" ></td></tr>';
							       }
							  }
						      $("#orderTable").append(str);						
					    }}
					 }
				});
		}
		window.onload = function(){
			currentOrder = $("#orginOrder");
			if(type != -1){
				currentType = $("#controllDiv span[name='"+type+"']");
				currentType.css('background-color','#87ceeb');
				$("#orginType").css('background-color','#ffc0cb');
			}else{
			    currentType = $("#orginType");
			}
			searchGoods();
		}
		function chooseStatus(ele){
			if(currentType){
				currentType.css('background-color','#ffc0cb');
			}
			currentType = $(ele);
			currentType.css('background-color','#87ceeb');
			type = $(ele).attr('name');
			page = 1;
			searchGoods();
		}
		function chooseOrder(ele){
			if(currentOrder){
				currentOrder.css('background-color','#ffc0cb');
			}
			currentOrder = $(ele);
			currentOrder.css('background-color','#87ceeb');
			order = $(ele).attr('name');
			searchGoods();
		}
		function deleteOrder(ele){
			var r=confirm("确认删除");
			if(r==false){
				return ;
			}
			$.ajax({
				   type: "POST",
				   url: "orderManageController.php",
				   data: "action=delete&cat="+cat+"&id="+$(ele).parent().attr('name'),
				   success: function(msg){
					 var dataObj=eval("("+msg+")");//转换为json对象
					  if(dataObj['status'] == 1){
                          $(ele).parent().remove();
					 } 
				   }
			 });
		}
		function changePage(ele){
			page = $(ele).attr('name');
			searchGoods();
		}
		
		function sendGoods(ele){
			if($(ele).attr('tag') == 1) return;
			$(ele).attr('tag',1);
			var str = "<tr style='background-color:#FFF5EE'><td colspan=15 >订单号：<input name='expressNum' value=''  type='text' /> ----- 快递名称：<input name='expressName' type='text' /> ---- <input type='button' onclick ='sendGoodsDo(this,"+$(ele).parent().attr('name')+")' value='确认' /><input onclick='sendGoodsCancel(this)' type='button' value='取消' /></td></tr>"
		    $(ele).parent().after(str);
		}
		function sendGoodsCancel(ele){
			$(ele).parent().parent().prev().children('td').attr('tag',0);
			$(ele).parent().parent().remove();
		}
		
		function sendGoodsDo(ele,id){
			var r=confirm("确认操作");
			if(r==false){
				return ;
			}
			var expressNum = $(ele).siblings("input[name='expressNum']").val();
			var expressName = $(ele).siblings("input[name='expressName']").val();

			$.ajax({
				   type: "POST",
				   url: "orderManageController.php",
				   data: "action=changeStatus&cat="+cat+"&id="+id+"&expressNum="+expressNum+"&expressName="+expressName,
				   success: function(msg){
					 var dataObj=eval("("+msg+")");//转换为json对象
					  if(dataObj['status'] == 1){
                         $(ele).parent().parent().remove();
						 searchGoods();	 
					 } 
				   }
			 });
		}
		
		function changeStatus(ele){
			
			var r=confirm("确认操作");
			if(r==false){
				return ;
			}
			$.ajax({
				   type: "POST",
				   url: "orderManageController.php",
				   data: "action=changeStatus&cat="+cat+"&id="+$(ele).parent().attr('name'),
				   success: function(msg){
					 var dataObj=eval("("+msg+")");//转换为json对象
					  if(dataObj['status'] == 1){
                         $(ele).parent().remove();
					 } 
				   }
			 });
			 
		}
		</script>
	</head>
<style>
.mytable
{
   width:1200px;
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

.myUl
{
list-style-type: none;
line-height : 50px;
padding: 0px;
margin: 0px;
}
ul
{
list-style-type: none;
line-height : 50px;
padding: 0px;
margin: 0px;
}
.adAdLocationUl{
	list-style-type: none;
	line-height : 50px;
	padding: 0px;
	margin: 0px;
	background-color:#F5FFFA;
}
.adAdLocationUl>li{
	text-align:center;
	width:300px;
}
.controllDiv{
	width:1200px;
	height:40px;
	float:left;
}
.controllDiv span{
   float:left;
   margin-left:10px;
   background-color:#ffc0cb;
   padding:5px 5px 5px 5px;
   cursor:pointer;
}
.pageConDiv span{
	width:20px;
	text-align:center;
}
.pageConDiv div{
	float:left;
	margin-left:10px;
    background-color:#ffc0cb;
    padding:5px 5px 5px 5px;
	cursor:pointer;
	
}
</style>

<body>
		<div class="bgintor" style='height:800px'>	
	<div class="tit1">
					<ul>				
						<li style='text-align:center;padding-top:10px;height:22px;'></li>
					</ul>		

				</div>
				<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
					<span>位置：订单管理 ----  <strong><?php echo  $shopLocation[$mallId] ;?></strong>------<strong><?php echo $result[0] ;?></strong><strong>------<?php echo $tableNameArr[$cat] ;?></strong></span>	

				</div>		
			<div class="listintor">
			

				<div class="content" style='height:1000px'>
				<div class='controllDiv' id='controllDiv'>
				<span id='orginOrder' name='DESC' onclick='chooseOrder(this)' style='background-color:#87ceeb;'>按时间降序</span>
				<span name='ASC' onclick='chooseOrder(this)'>按时间升序</span>
				
				<span  name=-1 id='orginType' style='margin-left:40px; background-color:#87ceeb;' onclick='chooseStatus(this)' name='' >全部</span>
				<span name=0 onclick='chooseStatus(this)'>已下单</span>
				<span name=1 onclick='chooseStatus(this)'>已支付</span>
				<span name=2 onclick='chooseStatus(this)'>已发货</span>
				<span name=3 onclick='chooseStatus(this)'>已收货</span>
				<span name=4 onclick='chooseStatus(this)'>待换货</span>
				<span name=4 onclick='chooseStatus(this)'>已换货</span>
				<span name=6 onclick='chooseStatus(this)'>待退货</span>
				<span name=7 onclick='chooseStatus(this)'>已退货</span>
				<span name=8 onclick='chooseStatus(this)'>已评价</span>
				<div class='pageConDiv' id='pageConDiv' style='float:right'>

				</div>
				</div>
				<table class='mytable' width="100%" style="float:left;" id='orderTable'>
				
			
				</table>
	
			</div>	
		
		</div>
		</div>
	</body>
	
<script type="text/javascript">

</script>

</html>