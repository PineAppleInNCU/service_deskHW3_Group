<?php

  session_start();




  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");

  $username=$_SESSION['username'];

  if(isset($_POST['button'])){

	$password=$_POST['password'];

	if($password==''){
		echo "<script>alert('請輸入您的新密碼!');</script>";
	}
	else{
		$data=mysql_query("UPDATE admin  SET  password='$password'  WHERE  username ='$username'");	
		header("location:login.php");
	}
   //  mysql_query("insert into admin value('','$username','$password','$email')  ");//let username and password store in database
   // header("location:login.php");//頁面跳轉
  }


?>
<!DOCTYPE html>
<html>
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <title>修改密碼</title>
        </head>
        <body >
          <div >

          </div>
          <div >
            <h2 >會員申請</h2>
            <form id="form1" method="post" action="">
              <div>
                <p>Password:</p><input class="input" input type="password" name="password" type="text" id="password" placeholder="Enter password">
              </div>
              <div>
                  <input name="button" id="button" type="submit" value="確認" />
              </div>
            </form> 
            <?php if(isset($_GET['msg']))if($_GET['msg']=="emailError")
              {?>
                <div>
                    <p>email的格式錯誤了</p>
                </div>
            <?php } ?>
            <?php if(isset($_GET['msg']))if($_GET['msg']=="usernameError")
              {?>
                <div>
                    <p>這個帳號有人用過囉</p>
                </div>
            <?php } ?>
            <?php if(isset($_GET['msg']))if($_GET['msg']=="doubleEmailError")
              {?>
                <div>
                    <p>這個電子信箱有人用過囉</p>
                </div>
            <?php } ?>
            <?php if(isset($_GET['msg']))if($_GET['msg']=="space")
              {?>
                <div>
                  
                    <p>這裡不歡迎卑劣的空白人 : (</p>
                  
                </div>
            <?php } ?>
            <?php if(isset($_GET['msg']))if($_GET['msg']=="wrongWord")
              {?>
                <div>
                    <p>帳密只能用字母與數字表示(一定要字母+數字)  : )</p>
                </div>
            <?php } ?>
          </div>
          <p><a href="login.php" style="text-decoration:none;">返回主頁</a></p>
        </body>
</html>
