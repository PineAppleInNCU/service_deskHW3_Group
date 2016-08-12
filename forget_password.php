<?php

	session_start();
	
	$link=mysql_connect("localhost","root","tommy522588");
	mysql_query("set names utf8");
	mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");

	



	$msg="";
	if(isset($_POST["send"])){
		
		$to=$_POST["to"];
		$data=mysql_query("SELECT * FROM admin WHERE email='$to' ");
		$record=mysql_fetch_assoc($data);
		
		if(mysql_num_rows($data)==0){
			echo "<script>alert('並未有人使用該信箱創建帳號!');</script>";			
		}
		else{	
			$subject = "您的帳號密碼：";
			$body = "您的帳號為：".$record['username']."\n您的密碼為：".$record['password'];
			//送出郵件
			if(mail($to,$subject,$body))
				$msg .="郵件已經成功寄出! <br/>";
			else
				$msg .="郵件寄送失敗! <br/>";
		}
	}	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>forget_password</title>
	</head>
	<body>
		<h1>忘記帳號密碼</h1>
		<form method="post" action="">
			<div>
				<label for="to">請輸入您的電子郵件</label>
				<input type="text" name="to" id="to" />
			</div><br/>
			<input type="submit" name="send" value="送出" ></input>
		</form> 
	
		<?php
			if(!empty($msg)){
				echo "<p>".$msg."</p>";
			}
		?>

	</body>
</html>
<!-- 目前只有奇摩有用 -->
<!-- 應該要寄出修改密碼頁面會比較合理且安全 -->

