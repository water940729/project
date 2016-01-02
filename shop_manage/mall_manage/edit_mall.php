﻿<?php
	require_once('../../conn/conn.php');
	require_once('../../conn/sqlHelper.php');
	$sqlhelper = new sqlHelper();
	$role=$_SESSION["role"];
	$mall_id=$_GET["mall_id"];
	
	$select="select * from mall where id='$mall_id'";
	$result=mysql_query($select);
	$row=mysql_fetch_array($result);
	$province=$row["province"];
	$city=$row["city"];
	$county=$row["county"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> Mall Management</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="liuxiao@WiiPu -- http://www.wiipu.com" />
		<link rel="stylesheet" href="../css/style2.css" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/>
		<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/upload.js"></script>
	
	</head>
	<body>
	<div class="bgintor">
		<div class="tit1">
			<ul>				
				<li><a href="#">Mall Management</a> </li>
			</ul>		
		</div>
	<div class="listintor">
		<div class="header1"><img src="../images/square.gif" width="6" height="6" alt="" />
			<span>Location: mall management －&gt; <strong>Modify malls</strong></span>
		</div>		
		<div class="fromcontent">
			<form action="edit_mall_do.php" method="post" id="doForm">
				<input type="hidden" name="mall_id" value="<?=$mall_id?>" />
				<p>Mall's name:<input class="in1" type="text" name="name" id="name" value="<?=$row['name']?>"/></p>	
				<p>Mall's logo:
				<?php 
					$sql3="select * from mall where id='$mall_id'";
					$result3=mysql_query($sql3);
					while($row3=mysql_fetch_array($result3)){
						//$mp_id=$row3["mp_id"];
						$pic_url=$row3["image_url"];
				?>
						<img src="<?=$pic_url?>" width="100" ><input type='checkbox' checked name='pics[]' value="<?=$mp_id?>"/> 
				<?php
					}
				?>
				</p>
				<p>Continue to upload: 
				 <input type="hidden" name="img_url" id="image_url">
				 <span id="upd_pics" name=""></span>
				 <input type="file" name="file" id="file_image"/>
				 	<span id="loading_image" style="display:none;">
				 	<img src="../images/loading.gif" alt="loading...">
				 	</span>
				 	<span id="logo_image"></span>
                    <input type="button" value="上传" onclick="return ajaxFileUpload('image');" 
                    class="btn btn-large btn-primary" />(*The poster size: Less then 500*500)
				</p>	
				<br>
				Mall address:		
				    <select name="province" id="province" onchange="obtain_city(this.value)">
						<?php
							$sql = "select province_name from county group by province_name";
							$provinces = $sqlhelper->execute_more($sql);
						  
							for($i=0;$i<count($provinces);$i++)
							{					
						?>
							<option value="<?php echo $provinces[$i]['province_name']?>" <?php echo ($province==$provinces[$i]['province_name']?"selected":"")?> ><?php echo $provinces[$i]['province_name']?></option>
						<?php
							}
						?>							
					</select>
					City:							
				    <select name="city" id="city" onchange="obtain_county(this.value)">
						<?php
							$sql2 = "select city_name from county where province_name='$province' group by city_name";
							$cities = $sqlhelper->execute_more($sql2);
					
							for($i=0;$i<count($cities);$i++)
							{					
						?>
							<option value="<?php echo $cities[$i]['city_name']?>" <?php echo ($city==$cities[$i]['city_name']?"selected":"")?> ><?php echo $cities[$i]['city_name']?></option>
						<?php
							}
						?>	
					</select>	
					District:
					<select name="county" id="county" >	
						<?php
							$sql3 = "select county_name from county where city_name='$city' group by county_name";
							$counties = $sqlhelper->execute_more($sql3);
					
							for($i=0;$i<count($counties);$i++)
							{					
						?>
							<option value="<?php echo $counties[$i]['county_name']?>" <?php echo ($county==$counties[$i]['county_name']?"selected":"")?> ><?php echo $counties[$i]['county_name']?></option>
						<?php
							}
						?>	
					</select>	
				</p>
				<p>Detailed address:
					<textarea rows="3" name="detailAddressInfo" cols="100" id="detailAddressInfo" placeholder="Don't need to repeat to fill in provinces, must be greater than five characters, less than 120 characters">
						<?=$row["detail_address"]?>
					</textarea>
				</p>
				<p>Merchant's brief introduction:
					<textarea  id="introduceInfo" name="introduceInfo" rows="10" >
						<?=$row["introduceInfo"]?>
					</textarea>
				</p>
				<p><input type="button" value="Confirm" onclick="return check()"/></p>
			</form>
		</div>
	</div>
  </div>
 </body>
</html>
<script>
form=document.getElementById("doForm");
/*function checkAddress()
{
	var add=$("textarea[name='detailAddressInfo']").val();
	if(add!=""){
		var provice="贵州省";
		var city=$("select[name='city']").val();
		var county=$("select[name='county']").val();
		flag=0;
		add=""+provice+city+county+add;
		$.post("check_address_do.php",
		{
			address:add
		},
		function(data,status){
			if(data==0){
				alert("您输入的地址有误请重新填写");
				//doForm.detailAddressInfo.focus();
			}else if(data==1){
				flag=1;
			}
		}
		)
	}
	else
	{
		return false;
	}
}
*/
function check()
{
	if(form.name.value=="")
	{
		alert('Please fill in the Merchant name!');
		form.name.focus();
		return false;
	}
	/*var mobie=form.phone;
	var a = /^((\(\d{3}\))|(\d{3}\-))?13\d{9}|14[57]\d{8}|15\d{9}|18\d{9}$/ ; 
	 if(mobie.value.length!=11||!mobie.value.match(a)&&mobie.value!="")  
	{            
		alert("请输入正确的手机号码!");
		mobie.focus();
		return false;
							 
	}
	*/
	if(form.province.value=="")
	{
		alert('Please fill out the mall province!');
		form.province.focus();
		return false;
	} 
	if(form.city.value=="")
	{
		alert('Please fill in the shopping mall in city!');
		form.city.focus();
		return false;
	}
	if(form.county.value=="")
	{
		alert('Please fill out the shopping district.');
		form.county.focus();
		return false;
	}
	if(form.detailAddressInfo.value=="")
	{
		alert('Please fill out the stores detailed address!');
		form.detailAddressInfo.focus();
		return false;
	}
	
	if(form.introduceInfo.value=="")
	{
		alert("Please fill out the profile");
		form.introduceInfo.focus();
		return false;
	}
	/*if(flag==0){
		alert('您输入的地址有误，请重新填写详细地址！');
		return false;
	}*/
	form.submit();
}

function disableCheckBox() { 
var obj=document.getElementsByName("taste[]");
for(var i=0;i<obj.length;i++) 
{ 
if ( !obj[i].checked ) 
obj[i].disabled = true; 
} 
} 
function ableCheckBox() { 
var obj=document.getElementsByName("taste[]"); 
for(var i=0;i<obj.length;i++) 
obj[i].disabled = false; 
} 

function checkCheckBox() 
{ 
	var obj=document.getElementsByName("taste[]");
	var sun=0; 

	for(var i=0;i<obj.length;i++) 
	{ 
	if(obj[i].type=="checkbox" && obj[i].checked) 
		sun++; 
	if( sun< 3 ) 
	{ 
		ableCheckBox(); 
	} 
	else if(sun == 3 ) 
	{ 
		disableCheckBox(); 
		event.srcElement.checked=true; 
		break; 
	} 
	else if(sun > 3 ) 
	{ 
	event.srcElement.checked=false; 
	break; 
	} 
	} 
} 

function ajaxFileUpload(file_type)
{
	var doing = '';
	$("#loading"+"_"+file_type).ajaxStart(function()
	{
		$(this).show();
		$("#logo"+"_"+file_type).html("Uploading...");
	})
	.ajaxComplete(function(){
		$(this).hide();
		$("#logo"+"_"+file_type).html("");
	});
	$.ajaxFileUpload
	(
		{
		url:'../shop_manage/upload_image.php?type=' + file_type,
		secureuri:false,
		fileElementId:'file'+'_'+file_type,
		dataType: 'json',
		data:{},
		success: function (data, status)
		{
			data=data.replace('<pre>','');
			data=data.replace('</pre>','');
			var info=data.split('|');
			if(info[0]=="E")
			{
				alert(info[1]);
			}
			else
			{
				$.post("add_mall_pictures_do.php",
					{
						mall_id:<?=$mall_id?>,
						pic_url:info[1]
					},
					function(data,status){
						data=eval('('+data+')');
						if(data['result']==1){
							var c = document.getElementById('upd_pics').innerHTML;
							document.getElementById('upd_pics').innerHTML= c + 
								"<p><img src='"+ info[1] +"' width='100'> <input type='checkbox' checked name='addpics[]' value="+info[1]+" /></p>";
						}else{
							alert("Add images failure");
						}
					}
				);
			}
			
		},
		error: function (data, status, e)
		{
			 alert(e);
		}
	});
	return false;
}
function obtain_city(value)
{
	var city=$('#city');
	city.html("");
	$.post('ajax_obtain_city.php',
	{
		province_name:value,
	},
	function(data,status)
	{
        data=eval('('+data+')');
		for (var i=0;i<data.length ;i++ )
		{
			var div="<option value='"+data[i].city_name+"'>"+data[i].city_name+"</option>";
			city.append(div);
		}
	});
}


function obtain_county(value)
{
	var province_name=$("#province").val();
	var county=$('#county');

	
	county.html("");
	$.post('ajax_obtain_county.php',
	{
		province_name:province_name,
		city_name:value,
	},
	function(data,status)
	{
			//alert(data);
        data=eval('('+data+')');
		for (var i=0;i<data.length ;i++ )
		{
			var div="<option value='"+data[i].county_name+"'>"+data[i].county_name+"</option>";
			county.append(div);
		}
		
	});
}
</script>