<?php 
session_start();

$user = $_SESSION['user'];
if(!empty($user))
{
	$_SESSION['user'] = $user;
	$welcom = "���ã�".$user."����¼��һ����Ϣ���ύ��</br>";
}

$gender = $_POST['gender'];
$age = $_POST['age'];
$blood = $_POST['blood_type'];
$user = $_POST['user'];

if(!empty($gender)&&!empty($age)&&!empty($blood))
{
	echo "�Ա�".$gender."</br>";
	echo "���䣺".$age."</br>";
	echo "Ѫ�ͣ�".$blood."</br>";
	echo "�û���".$user."</br>";
}
else
{
?>
<html>
<head>
	<script language = "JavaScript">
	$url = "http://112.124.3.197:8006/dxltest/testWeb/UserInput.php";
	window.location.href=$url;
	</script>
	</head>
</html> 
<?php
}
?>