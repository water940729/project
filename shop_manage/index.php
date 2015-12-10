<!DOCTYPE html>
<html lang="en">
<?php   
	$PUBLIC = 'http://'.$_SERVER['HTTP_HOST'].'/Public';
?>
<head>
	<meta charset="UTF-8">
	<title>商户登陆</title>
	<script src="<?php echo $PUBLIC ;?>/Js/jquery/jquery.js"></script>
	<link href="<?php echo $PUBLIC ;?>/Css/shop_login.css" type="text/css" rel="stylesheet">
	<script src="<?php echo $PUBLIC ;?>/Js/shop_login/index.js"></script>
	<script>

		$(function(){
			$(".login").click(function(){
				var value1=$("#buss_name").val();
				var value2=$("#buss_psd").val();
				$.ajax({
					type:"POST",
					data:"name="+value1+"&pwd="+value2,
					url:"login.php",
					success:function(msg){
					var dataObj=eval("("+msg+")");//转换为json对象
					if(dataObj['status'] == 1){
						 window.location.href="./admin_center.php";
					}else{
						alert("用户名密码错误");
					}
				   }
				});
			})
			
			$(".form_contain div input").keydown(function(ev){
			if(ev.keyCode==13){
				$(".login").click();
			}
		});
		})
	</script>
</head>
<body>
<div class="out_con">
	<div class="logo_name">
		<div class="logo"><img src="<?php echo $PUBLIC ;?>/image/shop_login/logo.jpg" /></div>
		<div class="name"><img src="<?php echo $PUBLIC ;?>/image/shop_login/name.jpg" /></div>
	</div>
	<div class="container">
	<div class="inner_con">
		<div class="form_contain">
			<div>
				<label for="buss_name">商户名称</label>
				<input type="text" id="buss_name" />
			</div>
			<div>
				<label for="buss_psd">登录密码</label>
				<input type="password" id="buss_psd" />
			</div>
			<div>
				<input type="checkbox" id="auto" />
				<label for="auto" id="auto_login">自动登录</label>
				<a onclick="javascript:alert('请联系商场管理员')">忘记密码?</a>
			</div>
			<input type="submit" class="login" value="登录">
		</div>
		</div>
	</div>
</div>
</body>
</html>
<script>

</script>
