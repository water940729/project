<?php
	//添加焦点图
	require("../../conn/conn.php");
	$sql="select qq,wangwang,shop_display from shop where id=$_SESSION[shop_id]";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>首页管理</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css" />
		<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="../js/upload.js"></script>
	</head>
	<body>
		<div class="bgintor">				
			<div class="listintor">
				<div class="tit1">
					<ul>				
						<li><a href="#">首页管理</a></li>
					</ul>		
				</div>
				<div class="header1">
					<span>位置：商户信息 －&gt; <strong>信息管理</strong></span>
				</div>
				<div class="content">
					<form action="add_info.php" method="post" id="doForm">
						<p>客服QQ:<input class="in1" type="text" name="qq" value="<?php echo $row["qq"]?>"/></p><br/>
						<p>客服旺旺:<input class="in1" type="text" name="wangwang" value="<?php echo $row["wangwang"]?>"/></p><br/>
                        <p>店铺的样式选择:<input class="in1" type="text" name="shop_display" value="<?php 
                            if($row["shop_display"] == 1){
                                echo "样式表1";
                            } else {
                                echo "样式表2";
                            }
                        ?>" /></p>
                        <br />
						<input type="submit" value="修改" class="confirm"></p>
					</form>
				</div>
			</div>	
		</div>
	</body>
</html>
