<?php 
session_start();

$user = $_POST['user_name'];
if(!empty($user))
{
	$_SESSION['user'] = $user;
	$welcom = "���ã�".$user."����¼��һ����Ϣ���ύ��</br>";
}
?>
<html>
<head>
<title>�û���Ϣ����</title>
<body>
<?php 
	echo $welcom;
?>
<form name = "info" method = "POST" action = "HandleUserInfo.php">
<table>
	<tr>
	<td>�Ա�</td>
	<td><input type = "radio" name = "gender" value ="��">��
	<input type = "radio" name = "gender" value ="Ů">Ů</td>
	</tr>
	<tr>
	<td>���䣺</td>
	<td><input type = "text" name = "age" size = "3"></td>
	</tr>
	<tr>
	<td>Ѫ�ͣ�</td>
	<td><select name = "blood_type">
		<option value = "A">A��</option>
		<option value = "B">B��</option>
		<option value = "AB">AB��</option>
		<option value = "O">O��</option>
		<option value = "other">����Ѫ��</option>
	</select></td>
	</tr>
	<tr><td align = "center"><input type = "submit" value = "�ύ"></td></tr>
</table>
</form>
</body>
</head>
</html>