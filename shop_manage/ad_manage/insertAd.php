
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
	</head>
	
<style>
ul
{
list-style-type: none;
line-height : 50px;
padding: 0px;
margin: 0px;
}
</style>	
<?php
    require_once('../../conn/conn.php');
	require_once('../inc_function.php');

// 配置文件       
$typeArr = array('jame','kurry','kebe','zhangweiping','dadiao');
$directionArr[0] = '葵花商城首页';
$sql1 = 'select id,name from mall';
$res = mysql_query($sql1);
    while($row = mysql_fetch_assoc($res)){
	    $directionArr[$row['id']] = $row['name'];
	} 
	


$locationArr = array('顶部','一层','二层','三层','四层');

//$directionArr = array('jame','kurry','kebe','zhangweiping','dadiao');
?>
 <form method="post" action="insertAdControll.php" enctype="multipart/form-data" name='upload'>
<ul>
<li>广告指向：<input type="text" name='adName'/></li>
<li>开始时间: 
<select name='startYear' id='startYear'>

</select>年
<select name='startMonth' id='startMonth'>
</select>月
<select name='startDay' id='startDay'>
</select>日
</li>
<li>结束时间: 
<select name='endYear' id='endYear'>
</select>年
<select name='endMonth' id='endMonth'>
</select>月
<select name='endDay' id='endDay'>
</select>日
</li>
<li>广告类型:<select name='adType'>
<?php foreach($typeArr as $k=>$value){
    ?>
	<option value ='<?php echo $k ; ?>'><?php echo $value ; ?></option>
   <?
} ?>
</select></li>
<li>投放商城位置:<select name='adLocation'>
<?php foreach($directionArr as $k=>$value){
    ?>
	<option value ='<?php echo $k ; ?>'><?php echo $value ; ?></option>
   <?
} ?>
</select></li>
<li>投放楼层位置:<select name='adSecLocation'>
<?php foreach($locationArr as $k=>$value){
    ?>
	<option value ='<?php echo $k ; ?>'><?php echo $value ; ?></option>
   <?
} ?>
</select></li>

<li>高度: <input name="width" type="text" /> </li>
<li>宽度: <input name="height" type="text" /> </li>

<li>图片: <input name="imgfile" type="file" /> </li>
<li><input type="submit" value='提交' onclick="return check()" /></li>
<ul>
</form>
</html>
<script type="text/javascript">
function $(id){
   return document.getElementById(id);
}
for(var i=1 ; i<=12 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('startMonth').add(option);
}
for(var i=2015 ; i<=2020 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('startYear').add(option);
}
for(var i=1 ; i<=12 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('endMonth').add(option);
}
for(var i=2015 ; i<=2020 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('endYear').add(option);
}
for(var i=1 ; i<=31 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('startDay').add(option);
}
for(var i=1 ; i<=31 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('endDay').add(option);
}
/*$('startMonth').onchange = function(){
    for(var i=1 ; i<=30 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('startDay').add(option);	
}
}
$('startMonth').onchange = function(){
    for(var i=1 ; i<=31 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('endDay').add(option);	
}
}
*/
/*$('endMonth').onchange = function(){
     for(var i=1 ; i<=30 ; i++){
     var option=document.createElement("option");
     option.text=i;
	 option.value=i;
    $('endDay').add(option);	
}
}*/

function check(){
  //  alert('aaa');
	return true;
}
</script>