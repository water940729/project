<?php 
	session_start();
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
  })
  </script>
 </head>	
	<body id="flow">
		<div class="menu" id="me">
			<div class="menu_content">
				<div class="menu_h menu_h3">商场管理</div>
				<div class="menu_intor">
					<p><a href="mall_manage/add_mall.php" target="mainFrame">添加商场</a></p>
					<p><a href="mall_manage/check_mall.php" target="mainFrame">查看商场</a></p>
				</div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">店铺管理</div>
				<div class="menu_intor">
					<p><a href="shop_manage/add_shop.php" target="mainFrame">添加店铺</a></p>
					<p><a href="shop_manage/check_shop.php" target="mainFrame">查看店铺</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">商品管理</div>
				<div class="menu_intor">
					<p><a href="goods_manage/add_goods.php" target="mainFrame">添加商品</a></p>
					<p><a href="goods_manage/check_goods.php" target="mainFrame">查看商品</a></p>
					<p><a href="goods_manage/goods_type1.php" target="mainFrame">商品分类</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">用户管理</div>
				<div class="menu_intor">
				<p><a href="user_manage/search_user.php" target="mainFrame">查看用户</a></p>
				<?php
					if($role==4){
				?>
				<p><a href="user_manage/search_address.php" target="mainFrame">查看地址</a></p>
				<?php
					}
				?>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">订单管理</div>
				<div class="menu_intor">
				<p><a href="order_manage/orderManage.php" target="mainFrame">订单管理</a></p>
				<p><a href="order_manage/sum_order.php" target="mainFrame">订单统计</a></p>
				</div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">管理员账号管理</div>
				<div class="menu_intor">
					<p><a href="add_manage_account/add_manage_account.php" target="mainFrame">添加账号</a></p>
					<p><a href="add_manage_account/manage_account.php" target="mainFrame">查看账号</a></p>
					<p><a href="add_manage_account/edit_manage_account.php" target="mainFrame">修改密码</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">文章管理</div>
				<div class="menu_intor">
					<p><a href="articles/list.php" target="mainFrame">文章列表</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">系统设置</div>
				<div class="menu_intor">
					<p><a href="system_manage/system_info.php" target="mainFrame">系统信息</a></p>
					<p><a href="system_manage/system_log.php" target="mainFrame">系统日志</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">首页管理</div>
				<div class="menu_intor">
					<p><a href="homepage_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="homepage_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
					<p><a href="homepage_manage/keyword_manage.php" target="mainFrame">关键词管理</a></p>
					<p><a href="homepage_manage/add_keyword.php" target="mainFrame">添加关键词</a></p>
					<p><a href="homepage_manage/recommend.php" target="mainFrame">推荐管理</a></p>
					<p><a href="homepage_manage/floor_manage.php" target="mainFrame">楼层管理</a></p>
					<p><a href="homepage_manage/add_floor.php" target="mainFrame">添加楼层</a></p>
			   </div>
			</div>			
			<div class="menu_content">
				<div class="menu_h menu_h3">超市管理</div>
				<div class="menu_intor">
					<p><a href="supermarket_manage/add_goods.php" target="mainFrame">添加商品</a></p>
					<p><a href="supermarket_manage/check_goods.php" target="mainFrame">查看商品</a></p>
					<p><a href="supermarket_manage/goods_type1.php" target="mainFrame">商品分类</a></p>			
					<p><a href="supermarket_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="supermarket_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
					<p><a href="supermarket_manage/keyword_manage.php" target="mainFrame">关键词管理</a></p>
					<p><a href="supermarket_manage/add_keyword.php" target="mainFrame">添加关键词</a></p>
					<p><a href="supermarket_manage/recommend.php" target="mainFrame">热销商品管理</a></p>
					<p><a href="supermarket_manage/floor_manage.php" target="mainFrame">楼层管理</a></p>
					<p><a href="supermarket_manage/add_floor.php" target="mainFrame">添加楼层</a></p>
					<p><a href="supermarket_manage/manage_sales.php" target="mainFrame">促销公告</a></p>
					<p><a href="order_manage/orderManage.php?cat=5" target="mainFrame">订单管理</a></p>
			   </div>
			</div>			
			<div class="menu_content">
				<div class="menu_h menu_h3">秒杀管理</div>
				<div class="menu_intor">
					<p><a href="seckill_manage/add_seckill.php" target="mainFrame">添加秒杀</a></p>
					<p><a href="seckill_manage/manage_seckill.php" target="mainFrame">秒杀管理</a></p>
					<p><a href="seckill_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
					<p><a href="seckill_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="order_manage/sum_order.php?cat=2" target="mainFrame">订单统计</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">团购管理</div>
				<div class="menu_intor">
					<p><a href="teambuy_manage/add_teambuy.php" target="mainFrame">添加团购</a></p>
					<p><a href="teambuy_manage/manage_teambuy.php" target="mainFrame">团购管理</a></p>
					<p><a href="teambuy_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
					<p><a href="teambuy_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="order_manage/sum_order.php?cat=1" target="mainFrame">订单统计</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">试用管理</div>
				<div class="menu_intor">
					<p><a href="trail_manage/add_trail.php" target="mainFrame">添加试用</a></p>
					<p><a href="trail_manage/manage_trail.php" target="mainFrame">试用管理</a></p>
					<p><a href="trail_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
					<p><a href="trail_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="trail_manage/orderManage.php" target="mainFrame">订单管理</a></p>
					<p><a href="order_manage/sum_order.php?cat=3" target="mainFrame">订单统计</a></p>
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">预售管理</div>
				<div class="menu_intor">
					<p><a href="book_manage/add_book.php" target="mainFrame">添加预售</a></p>
					<p><a href="book_manage/manage_book.php" target="mainFrame">预售管理</a></p>
					<p><a href="book_manage/manage_focus.php" target="mainFrame">焦点图管理</a></p>
					<p><a href="book_manage/add_focus.php" target="mainFrame">添加焦点图</a></p>
					<p><a href="order_manage/sum_order.php?cat=4" target="mainFrame">订单统计</a></p>
			   </div>
			</div>	
			<div class="menu_content">
				<div class="menu_h menu_h3">广告管理</div>
				<div class="menu_intor">
					<p><a href="ad_manage/adManage.php" target="mainFrame">广告在线管理</a></p>
					<!--<p><a href="ad_manage/ad_order.php" target="mainFrame">广告出售订单</a></p>-->
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">商品审核</div>
				<div class="menu_intor">
					<p><a href="admin_check/check_goods.php" target="mainFrame">商品审核</a></p>
					<!--<p><a href="ad_manage/ad_order.php" target="mainFrame">广告出售订单</a></p>-->
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">消息模板</div>
				<div class="menu_intor">
					<p><a href="msg_manage/msgManage.php" target="mainFrame">消息模板管理</a></p>
					<!--<p><a href="ad_manage/ad_order.php" target="mainFrame">广告出售订单</a></p>-->
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">财务管理</div>
				<div class="menu_intor">
					<p><a href="./financialManager/finanacialManage.php" target="mainFrame">商城提现处理</a></p>
					<p><a href="./financialManager/finance.php" target="mainFrame">商城财务统计</a></p>
					<!--<p><a href="ad_manage/ad_order.php" target="mainFrame">广告出售订单</a></p>-->
			   </div>
			</div>
			<div class="menu_content">
				<div class="menu_h menu_h3">统计管理</div>
				<div class="menu_intor">
					<p><a href="./statisticsManage/orderStatistic.php" target="mainFrame">订单统计</a></p>
					<p><a href="./statisticsManage/financeStatistic.php" target="mainFrame">财务统计</a></p>
			   </div>
			</div>			
		</div>
	</body>
</html>