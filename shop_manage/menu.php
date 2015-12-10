<?php 
	session_start();
	//$role=$_SESSION['role'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 菜单 </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="css/style2.css" type="text/css"/>
  <style>
  .menu_h3{cursor:pointer;}
  </style>
  <script src="js/jquery-1.6.min.js">
  </script>
  <script>
  $(function(){
	$(".menu_intor").hide();
	$(".menu_h3").click(function(){
		if($(this).siblings(".menu_intor").is(":hidden")){
			$(this).siblings(".menu_intor").show();
		}else{
			$(this).siblings(".menu_intor").hide();
		}
		
	})
	$(".menu_content").hover(function(){
		$(this).find(".menu_h3").addClass("spec");
	},function(){
		$(this).find(".menu_h3").removeClass("spec");
	})
	
	$(".menu_intor").find("p").hover(function(){
		$(this).find("a").css("color","orange");
	},function(){
		$(this).find("a").css("color","#353535");
	})
  })
  </script>
 </head>	
	<body id="flow">
		<div class="menu" id="me">
			<div class="menu_content">
				<div class="menu_h menu_h3">商户信息</div>
				<div class="menu_intor">
					<p><a href="info_manage/info.php" target="mainFrame">商户信息</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">文章管理</div>
				<div class="menu_intor">
					<p><a href="articles/list.php" target="mainFrame">文章列表</a></p>
			   </div>
			</div>				
			<div class="menu_content">
				<div class="menu_h menu_h3">商铺管理</div>
				<div class="menu_intor">
					<p><a href="homepage_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="homepage_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">商品管理</div>
				<div class="menu_intor">
					<p><a href="goods_manage/add_goods.php" target="mainFrame">添加商品</a></p>
					<p><a href="goods_manage/check_goods.php" target="mainFrame">查看商品</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">订单管理</div>
				<div class="menu_intor">
				<p><a href="order_manage/orderManage.php?cat=0" target="mainFrame">商城订单</a></p>
				<p><a href="order_manage/orderManage.php?cat=1" target="mainFrame">团购订单</a></p>
				<p><a href="order_manage/orderManage.php?cat=2" target="mainFrame">秒杀订单</a></p>
				<p><a href="order_manage/orderManage.php?cat=3" target="mainFrame">试用订单</a></p>
				<p><a href="order_manage/orderManage.php?cat=4" target="mainFrame">预售订单</a></p>
				</div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">账号管理</div>
				<div class="menu_intor">
					<p><a href="add_manage_account/edit_manage_account.php" target="mainFrame">修改密码</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">财务管理</div>
				<div class="menu_intor">
					<p><a href="financeManage/finance.php" target="mainFrame">提现处理</a></p>
			   </div>
			</div>
		</div>
	</body>
</html>