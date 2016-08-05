<?php

  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");

?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>登入</title>
                <link rel="stylesheet" href="css/login.css" charset="utf-8">
        </head>
        <body class="bg-info">
          <div class="container" >
                <h2 align="center">會員登入</h2>
                <form id="form" name="form" method="post" action=""  >
                  <div align="center">
                      <p>Username:</p><input  class="input" name="usr" type="text" id="usr" placeholder="Enter username">
                  </div>
                  <div align="center">
                    <p>Password:</p><input class="input" input type="password" name="pwd" type="text" id="pwd" placeholder="Enter password">
                    
                  </div>
                  <div class="customerlogin" style="text-align: center;" >
                    <a href="php_newboard.php" style="text-decoration:none;color: #3D59AB;font-family: Verdana, sans-serif;">訪客入口<?php echo "</br>"?><span style="font-weight: bold;
            font-size: 18px;
            color: #ffffff;">請點擊這裡</span></a>
                  </div>
                   <div align="center" style="padding-top:30px">
                    <input class="btn btn-primary"  name="button" id="button" type="submit" value="確認" />        
                  </div>

                  <?php if(isset($_GET['msg']))if($_GET['msg']=="error")
                  {?>
                    <div align="center" style="padding-top:30px;padding-bottom:30px;background-color:red">
                      
                        <p>沒有這個人耶，要發言要先登入唷</p>
                      
                    </div>
                  <?php } 
                    else if($_GET['msg']=="space"){?>
                      <div align="center" style="padding-top:30px;padding-bottom:30px;background-color:red">
                      
                        <p>禁止空白人進入(怒)</p>
                      
                      </div>

                  <?php }
                  ?>
                </form>
              </div>
              <p align="center">沒有帳號密碼~?來<a href="php_apply.php" style="text-decoration:none;"><button class="btn btn-primary dropdown-toggle" >申請</button></a>一個吧</p>

              <p align="center">忘記密碼了嗎~?來這裡<a href="php_warning.php" style="text-decoration:none;"><button class="btn btn-info dropdown-toggle" data-toggle="dropdown">處理 </button></a>吧！</p>
          <script type="text/javascript" src="js/login.js"></script>
        </body>
</html>
