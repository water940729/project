<?php 
session_start();

$_SESSION['user'] = "KingKong";
$_SESSION['explain'] = "����session1��session����";
echo "���ҳ���Ѿ�ͨ��session������һЩ����";
echo '</br><a href = "session2.php">����session2.php</a>�鿴��Щ����ֵ';
?>