<?php
$fp = fopen("/home/chenhuanyang/local/apache/htdocs/dxltest/data/info.dat",'r');
if(!fp)
{
	echo "<b>Error�����ļ���������Ŀ¼�Ƿ���ȷ�����Ժ����ԣ�</b>";
	exit;
}
while(!feof($fp))
{
	$line = fgets($fp);
	echo $line;
	echo "<br/><br/>";
}

echo "����ϵͳ����ȡ�õĸ�Ŀ¼·����".$_SERVER['DOCUMENT_ROOT'];
#  /home/chenhuanyang/local/apache/htdocs
echo "<br/><br/>";

$file  = "data.txt";
$content = "���ݱ���\r\n���ݵ�һ��\r\n���ݵڶ���\r\n";
if(!fp == fopen($file,'a+'))
{
echo "��ʧ��";
exit;
}

if(fputs($fp,$content) === false)
{
echo "д��ʧ�ܣ�";
exit;
}

echo "д���ļ��ɹ���";
$getcontent = file($file);
echo "�ļ����ݣ�\r\n";
print_r($getcontent);
fclose($fp);
echo "�ļ���С��".filesize($file);
?>