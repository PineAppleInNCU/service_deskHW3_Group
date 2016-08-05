<?php
	mysql_connect("localhost","root","tommy522588");//最後一欄要輸入密碼
	mysql_select_db("test");
	mysql_query("set names utf8");

	$data=mysql_query('select * from test order by number desc');//從guest_2抓取資料
	echo $data;

	echo "<br>";

	$total=mysql_num_rows($data);
	echo $total;

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