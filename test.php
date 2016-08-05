<?php
	mysql_connect("localhost","root","1234");//最後一欄要輸入密碼
	mysql_select_db("Service_deskHW3");//guest為資料庫名稱
	mysql_query("set names utf8");//將資料設為utf8格式（才能讀取中文）
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body class="bg-info">
		<?php
			echo "Hello world!";
		?>
	</body>
</html>