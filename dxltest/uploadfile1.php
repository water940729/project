<?php
$upload_path = "/home/chenhuanyang/local/apache/htdocs/dxltest/upload/";
echo $upload_path ;

$dest_file = $upload_path.basename($_FILES['myfile']['name']);

if(move_uploaded_file($_FILES['myfile']['tmp_name'],$dest_file))
{
	echo "�ļ��Ѿ��ϴ���������Ŀ¼��uploadĿ¼�£�";
} 
else
{
	echo "�ϴ��ļ�ʱ����һ������".$_FILES['myfile']['error'];
}
?>