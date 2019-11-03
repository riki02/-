<?php

// メッセージを保存するファイルのパス設定
define( 'FILENAME', './message.txt');

// タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

// 変数の初期化
$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();


if( !empty($_POST['btn_submit']) ) {

  if( $file_handle = fopen( FILENAME, "a") ) {

// 書き込み日時を取得
		$now_date = date("Y-m-d H:i:s");
	
		// 書き込むデータを作成
		$data = "'".$_POST['view_name']."','".$_POST['message']."','".$now_date."'\n";
	
		// 書き込み
		fwrite( $file_handle, $data);
	
	
		// ファイルを閉じる
		fclose( $file_handle);
	}
}

if( $file_handle = fopen( FILENAME,'r') ) {
	while( $data = fgets($file_handle) ){

	$split_data = preg_split( '/\'/', $data);

        $message = array(
            'view_name' => $split_data[1],
            'message' => $split_data[3],
            'post_date' => $split_data[5]
        );
        array_unshift( $message_array, $message);
       
    }

    // ファイルを閉じる
    fclose( $file_handle);
}

session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)    
{
    setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();

?>

<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href=".css" rel="stylesheet" type="text/css" media="all">
<title>掲示板</title>
</head>
<body>
 	<h1>掲示板</h1>
	<form action=""method="post">
<div>
		<label for="view_name">表示名</label>
		<input id="view_name" type="text" name="view_name" value="">
	</div>
	<div>
		<label for="message">ひと言</label>
		<textarea id="message" name="message"></textarea>
	</div>
	<input type="submit" name="btn_submit" value="書き込む"><br/><br/>

<p style="text-align: center">
<a href="index.html">ログアウト</a>
</p>

</form>
	<h2>投稿一覧</h2>
<hr>
<section>
<?php if( !empty($message_array) ): ?>
<?php foreach( $message_array as $value ): ?>
<article>
    <div class="info">
        <h2><?php echo $value['view_name']; ?></h2>
        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
    </div>
    <p><?php  echo $value['message']; ?></p>

<hr>		
</article>
<?php endforeach; ?>
<?php endif; ?>
</section>
</body>
</html>

