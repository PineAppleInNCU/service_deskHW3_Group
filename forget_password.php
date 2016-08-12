<?php
	$msg="";
	if(isset($_POST["send"])){
		$to=$_POST["to"];
		$subject = "您的帳號密碼：";
		$body = "XDD";
		//送出郵件
		if(mail($to,$subject,$body))
			$msg .="郵件已經成功寄出! <br/>";
		else
			$msg .="郵件寄送失敗! <br/>";
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

