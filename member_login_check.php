<?php

try
{

$member_code=$_POST['code'];
$member_pass=$_POST['pass'];

$member_code=htmlspecialchars($member_code,ENT_QUOTES,'UTF-8');
$member_pass=htmlspecialchars($member_pass,ENT_QUOTES,'UTF-8');

$member_pass=md5($member_pass);

$dsn="mysql:dbname=keijiban;host=localhost;charset=utf8";
$user='root';
$password = '';
$dbh = new PDO($dsn,$user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
$sql='SELECT name FROM staff WHERE code=? AND password=?';
$stmt =$dbh->prepare($sql);
$data[]=$member_code;
$data[]=$member_pass;
$stmt->execute($data);
    
$dbh = null;
    
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
if($rec==false)
{
    print'スタッフコードかパスワードが間違っています。<br />';
    print'<a href="index.html">戻る</a>';
}
else
{
  header('Location:keijiban.php');
  exit();
}
