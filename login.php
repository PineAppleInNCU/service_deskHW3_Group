<?php

  session_start();//開始啟用session，一定要擺在網頁最上方

  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");

  if(isset($_SESSION['v'])){
    if($_SESSION['v']=="yes"){//session['v']=="yes"表示有登入，且帳密正確
    	echo $_SESSION['v'];
      header("location:board.php");
    }
  }

  if(isset($_POST['usr'])){//已輸入帳密並且按下確認，才會進入該if結構
    $login_username=$_POST['usr'];
    $login_password=$_POST['pwd'];
    $servername='localhost';
    $usr='root';
    $pass='tommy522588';
    $dbname='Service_deskHW3';
    $conn = new mysqli($servername, $usr, $pass, $dbname);
    //建立連線
    $data = $conn->prepare("SELECT * FROM admin "); 
    //Prepare語句，把可能會被SQL Injection的資料欄位值先以”?”代替
    //把資料欄位值綁定到prepare 語句中
    $data->execute(); //執行SQL指令


    echo "in the first if";
    ///debuging
    //$result=$data->get_result();
    $data->bind_result($id,$username, $password);
    while ($data->fetch()){
      echo "in the first while";
      printf(" %s %s\n", $username, $password);
       /* Use $username and $password */
      if($username==$login_username){

          echo "HELLO!";

          $_SESSION['v']="yes";
          $_SESSION['username']=$login_username;
          //我想要用session紀錄帳密，到下一頁使用
          header("location:board.php");
        }
        //else if($row['username']!=$username){
        //  $_SESSION['v']="not";
          //header("location:php_login.php?msg=error");//疑問，為什麼沒辦法跑到這行??
      //}

    }
  }


    //疑問，$data->execute()   與  $data=mysql_query........的$data變數的性質相同嗎?
    //$data=mysql_query("select * from admin where username ='$username' and password='$password'");
    /*while($row=$result->fetch_assoc()){
        if($row['username']==$username){
          $_SESSION['v']="yes";
          $_SESSION['username']=$username;
          //我想要用session紀錄帳密，到下一頁使用
          header("location:board.php");
        }
        //else if($row['username']!=$username){
        //  $_SESSION['v']="not";
          //header("location:php_login.php?msg=error");//疑問，為什麼沒辦法跑到這行??
      //}
    }
    header("location:login.php?msg=error");//若沒找到帳密，則顯示訊息
  }*/

   //debuging

?>
<!DOCTYPE html>
<html>
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <title>登入</title>
          <link rel="stylesheet" href="css/login.css" charset="utf-8">
        </head>
        <body >
          <div class="container" >
            <h2 >會員登入</h2>
            <form id="form" name="form" method="post" action=""  >
              <div >
                <p>Username:</p><input  class="input" name="usr" type="text" id="usr" placeholder="Enter username">
              </div>
                <div >
                  <p>Password:</p><input class="input" input type="password" name="pwd" type="text" id="pwd" placeholder="Enter password">
                </div>
                <div class="customerlogin">
                    <a href="board.php" style="text-decoration:none;color: #3D59AB;font-family: Verdana, sans-serif;">訪客入口<?php echo "</br>"?><span style="font-weight: bold;
            font-size: 18px;
            color: #ffffff;">請點擊這裡</span></a>
                </div>
                  <div>
                    <input class="btn btn-primary"  name="button" id="button" type="submit" value="確認" />        
                  </div>

                  <?php if(isset($_GET['msg']))if($_GET['msg']=="error")
                  {?>
                  <div >
                      
                        <p>沒有這個人耶，要發言要先登入唷</p>
                      
                  </div>
                  <?php } 
                  else if($_GET['msg']=="space"){?>
                    <div>
                      <p>禁止空白人進入(怒)</p>
                    </div>
                  <?php }
                  ?>
                </form>
          </div>
          <p>沒有帳號密碼~?來<a href="establish_password.php" style="text-decoration:none;"><button>申請</button></a>一個吧</p>

          <p>忘記密碼了嗎~?來這裡<a href="php_warning.php" style="text-decoration:none;"><button data-toggle="dropdown">處理 </button></a>吧！</p>
          <script type="text/javascript" src="js/login.js"></script>
        </body>
</html>
