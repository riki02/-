<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href=".css" rel="stylesheet" type="text/css" media="all">
<title>一言掲示板</title>
</head>
<body>

<?php
       
try
{

$member_name=$_POST['name'];
$member_pass=$_POST['pass'];

$member_neme=htmlspecialchars($member_name,ENT_QUOTES,'UTF-8');
$member_pass=htmlspecialchars($member_pass,ENT_QUOTES,'UTF-8');

$dsn='mysql:dbname=keijiban;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='INSERT INTO staff(name,password)VALUES(?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$member_name;
$data[]=$member_pass;
$stmt->execute($data);

$dbh=null;

print$member_name;
print'さんを追加しました。<br />';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
