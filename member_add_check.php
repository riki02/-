<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href=".css" rel="stylesheet" type="text/css" media="all">
<title>一言掲示板</title>
</head>
<body>

<?php
    
$member_name=$_POST['name'];
$member_pass=$_POST['pass'];
$member_pass2=$_POST['pass2'];

$memer_neme=htmlspecialchars($member_name,ENT_QUOTES,'UTF-8');
$memer_pass=htmlspecialchars($member_pass,ENT_QUOTES,'UTF-8');
$memer_pass2=htmlspecialchars($member_pass2,ENT_QUOTES,'UTF-8');

if($member_name=='')
{
	print'名前が入力されていません。<br />';
}
else
{
	print'会員名:';
	print $member_name;
	print'<br />';
}

if($member_pass=='')
{
	print'パスワードが入力されていません。<br />';
}

if($member_pass!=$member_pass2)
{
	print'パスワードが一致しません。<br />';
}

if($member_name==''||$member_pass==''||$member_pass!=$member_pass2)
{
	print'<form>';
	print'<input type="button" onclick="history.back()"value="戻る">';
	print'</form>';
}
else
{
	$member_pass=md5($member_pass);
	print'<form method="post"action="member_add_done.php">';
	print'<input type="hidden"name="name"value="'.$member_name.'">';
	print'<input type="hidden"name="pass"value="'.$member_pass.'">';
	print'<br />';
	print'<input type="button"onclick="history.back()"value="戻る">';
	print'<input type="submit"value="ＯＫ">';
	print'</form>';
}

?>

</body>
</html>
