<?php
	$msg="";
	if(isset($_POST["send"])){
		$to=$_POST["to"];
		$subject = $_POST["subject"];
		$body = $_POST["content"];
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
		<title>test_email</title>
	</head>
	<body>
		<h1>電子郵件處理</h1>
		<form method="post" action="">
			<div>
				<label for="to">收件者:</label>
				<input type="text" name="to" id="to" />
			</div><br/>
			<div>
				<label for="subject">郵件主旨:</label>
				<input type="text" name="subject" id="subject" ></input>
			</div><br/>
			<div>
				<label for="content">郵件內容:</label>
				<textarea name="content" id="content" rows="5" ></textarea>
			</div><br/>
			<input type="submit" name="send" value="送出"></input>
		</form> 
	
		<?php
			if(!empty($msg)){
				echo "<p>".$msg."</p>";
			}
		?>

	</body>
</html>

