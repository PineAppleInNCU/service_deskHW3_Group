<?php
	session_start();
	if($_SESSION['v']!="yes"){
		header("location:php_board_3.php");
	}

	mysql_connect("localhost","root","tommy522588");//最後一欄要輸入密碼
	mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");
	mysql_query("set names utf8");


	$username=$_SESSION['username'];//目前登入的人


	if(isset($_GET['messageID'])){//這裡的id，指的是messageBoard的id
		$id=$_GET['messageID'];

		//normal mode
		if($_GET['msg']=="normal"){
			if(isset($_POST['guestReply'])){
				$guestReply=$_POST['guestReply'];
				$time=date("Y:m:d H:i:s",time()+28800);
				mysql_query("INSERT INTO reply VALUE('','$username','$id','$time','$guestReply') ");
				header("location:board.php");
			}
		}
		//normal mode//
		//fix mode
		else if($_GET['msg']=="fix"){
			$replyID=$_GET['replyID'];
			$data=mysql_query("SELECT * FROM reply WHERE id='$replyID'");
			$record=mysql_fetch_assoc($data);
			if(isset($_POST['guestReply'])){
				$guestReply=$_POST['guestReply'];
				$time=date("Y:m:d H:i:s",time()+28800);
				mysql_query("UPDATE reply SET content='$guestReply',replyTime='$time' WHERE id='$replyID'  ") or die(mysql_error());//將資料存入reply的資料表
				header("location:board.php");
			}
		}
		//fix mode//
		//fix message
		else if($_GET['msg']=="fix_message"){
			echo "TEST";
		}
		//fix message//


		
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>回覆</title>
	</head>
	<body>
		
				<table>
					<thead>
					</thead>
					<tr>
						<td>username：</td>
						<td><?php  echo $username;  ?></td>
					</tr>

						<td>狀態：<?php 
								if($_GET['msg']=="normal"){
									echo "回覆";
								}
								else if($_GET['msg']=="fix"){
									echo "修改回覆";
								}
								else if($_GET['msg']=="fix_message"){
									echo "修改留言";
								}
								
							  ?>
					        </td>
						<!-- 顯示是否為修改回覆  -->
					</tr>
					<tr>
					</tr>
				</table>
			<div>
				<div class="container">
					<form id="form1" name="form1" method="post" action="">
						<label for="guestReply">回覆內容</label>
						<textarea style="width:600px" rows="8" id="guestReply" name="guestReply">
							<?php 
								if($_GET['msg']=="normal"){
									
								}
								else if($_GET['msg']=="fix"){
									echo $record['content'];
								}
								
							  ?>
						</textarea>
						<input type="submit" name="button" id="button" value="回覆" />
					</form>
				</div>
			</div>
	</body>
</html>
<!-- 寫到修改回覆 的 資料庫操作(update) -->
