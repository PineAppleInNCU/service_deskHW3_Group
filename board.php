<?php
  session_start();//重要，沒有這行的話，session不會記錄上一個頁面的session給這個頁面


  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");


//取得使用者名稱
  $username=$_SESSION['username'];
//取得使用者名稱//
//將留言放到資料庫裡
  if(isset($_POST['guestContent'])){
	$guestContent=$_POST['guestContent'];//將由留言者的回覆儲存到guestContent裡
	$guestTime=date("Y:m:d H:i:s",time()+28800);
	$newData=mysql_query("insert into guest value('','$username','$guestTime','$guestContent')  ");//將資料存入guest的資料表裡
	header("location:board.php");
  }
//將留言放到資料庫裡
//判斷有無登入
  if(isset($_SESSION['v'])){//若有登入，不做動作

  }
  else{	
	$_SESSION['v']='';//若無登入，隨便設一個值

  }
//判斷有無登入//
//判斷是沒有點擊登出按鈕
  if(isset($_GET['msg']))
  {
    if($_GET['msg']=="logout")
    {

       echo $_SESSION['v'];
       $_SESSION['v']='logout!';//點下logout鈕，將會把session變成空值
       echo $_SESSION['v'];
       header("location:login.php");     
    }
  }
//判斷是沒有點擊登出按鈕//
//抓取資料
  $data=mysql_query("select * from guest order by guestTime desc");//從資料庫裡抓資料
//抓取資料//

?>
<!DOCTYPE html>
<html>
        <head>
		<title>留言板</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/board.css" charset="utf-8">

        </head>
        <body class="bg-info">
          <?php
            echo "Hello world!";
          ?>
          <!-- 輸入留言 -->
          <?php if(isset($_SESSION['v']))if($_SESSION['v']=="yes"){ ?>

            <div><?php //確定是使用者，才顯示這一個區塊?>
              <P><font><?php echo "$username" ?></font>來說點甚麼吧</P>
              <div>
                <form id="form1" name="form1" method="post" action="">
                  <textarea class="post" rows="8" id="guestContent" name="guestContent"></textarea>
                  <?php echo "</br>"?>
                  <input type="submit" name="button" id="button" value="確認" />
                </form>
                <div>
                  <a href="board.php?msg=logout"><span>登出</span></a>
                </div>
                <div >
                  <a href="php_adminfix.php"><span>帳密修改</span></a>
                </div>
              </div>
            </div>
          <?php }?>
          <!-- 輸入留言 -->
	  <!-- 留言板  -->
          <?php
	  	for($i=1;$i<=mysql_num_rows($data);$i++){
			$rs=mysql_fetch_assoc($data);

          ?>

	  <table height="300"  border="1px" style="margin:auto;">
		<thead>
			<?php if($_SESSION['v']=="yes" ){//登入才顯示此列 ?>
				<tr> <!-- 回覆、刪除、修改欄位 -->
					<td>			
						<a href="php_newreply.php?replyID=''&guestID=<?php echo htmlentities($rs['guestID']) ?>">回覆</a><!-- 前往id為guestID的回覆頁面 -->			
					</td>
					<td>
						<?php if($_SESSION['v']!="yes"){?>
							<a href="php_replyerror.php?msg='notlogin'">刪除</a>		
						<?php }else if($guestName!=$rs['username']){ ?>
							<a href="php_replyerror.php?msg=''">刪除</a>
						<?php }else{ ?>
							<a href="php_postDelete.php?id=<?php echo htmlentities($rs['id']) ?>">刪除</a>
						<?php } ?>		
					</td>
					<td>
						<?php if($_SESSION['v']!="yes"){?>
							<a href="php_replyerror.php?msg='notlogin'">修改</a>
						<?php }else if($guestName!=$rs['username']){ ?>
							<a href="php_replyerror.php?msg=''">修改</a>
						<?php }else{ ?>
							<a href="php_fixpost.php?id=<?php echo htmlentities($rs['id']) ?>">修改</a>
						<?php } ?>			
					</td>

				</tr>
						<?php } ?>
		</thead>
				<tr>
					<td>username</td>
					<td colspan="2"  width="500" ><?php echo htmlentities($rs['username']);?></td>
				</tr>
				<tr>
					<td>留言時刻</td>
					<td colspan="2"  width="500"><?php echo $rs['guestTime'];?></td>
				</tr>
				<tr>
					<td>留言內容</td>
					<td colspan="2"  width="500" height="300px" >
					<p style="word-break:break-all"><?php echo htmlentities($rs['content']) ;?></td>
					</p>
				</tr>


			<?php 
					$result=mysql_query("select * from reply");
					while($row_result=mysql_fetch_assoc($result)){//將留言內容從資料表{reply}抓出
						if($row_result['id']==htmlentities($rs['id'])){
							//if($rs['replyer']!=''){ 
			?>
				<tr>
					<td colspan="3" ><?php echo  $row_result['replyer'] ?>回覆</td><?php //變成假如沒有人回應，就隱藏此欄位  可以用資料儲存replyer的欄位  if replyer 存在 再顯示此欄位?>
				</tr>
				<tr>
					<td>回覆時刻</td>
					<td colspan="2"  width="500">
						<?php echo $row_result['guestReplyTime'];?>
					</td>
				</tr>
				<tr>
					<td colspan="3"	width="500">
						<p style="word-break:break-all"><?php echo htmlentities($row_result['guestReply']);?></p>
					</td>
				</tr>

			<?php if($_SESSION['v']=="yes" ){//登入才顯示此列 ?>
				<tr><!-- 修改回覆欄位 -->
					<td colspan="3"	width="500">
					<?php if($_SESSION['v']!="yes"){?>
						<a href="php_replyerror.php?msg=''">修改回覆</a>				
					<?php }else if($guestName!=$row_result['replyer']){ ?>
						<a href="php_replyerror.php?msg=''">修改回覆</a>
					<?php }else{ ?>
						<a href="php_newreply.php?replyID=<?php echo $row_result['replyID'] ?>&guestID=<?php echo htmlentities($rs['guestID']) ?> ">修改回覆</a>
					</td>		
				</tr>
					<?php } ?>
					<?php if($_SESSION['v']=="yes" ){//登入才顯示此列 ?>
						<tr><!-- 刪除回覆欄位 -->
							<td colspan="3">
								<?php if($_SESSION['v']!="yes"){?>
										<a href="php_replyerror.php?msg=''">刪除回覆</a>
									
								<?php }else if($guestName!=$row_result['replyer']){ ?>										
										<a href="php_replyerror.php?msg=''">刪除回覆</a>

								<?php }else{ ?>
										<a href="php_replyDelete.php?replyID=<?php echo $row_result['replyID'] ?>&guestID=<?php echo htmlentities($rs['guestID']) ?> ">刪除回覆</a>
								<?php } ?>

								<?php }
									} ?><!--  end of 抓取replyer的資料  -->


							</td>
						</tr>
						<?php } ?>

					<?php } ?>


				</table>
				<?php echo "</br>" ?>
			<?php
				}
			?>	
	  <!-- 留言板  -->


                <a href="board.php?msg=logout"><button>登出</button></a>

        </body>
</html>

<!-- 接下來做留言功能，先做好資料表，再寫php  done -->
<!-- 這部分做好後，開始做回覆頁面，更改密碼頁面 刪除留言-->
<!-- 帳密部分還沒有防各種注入 -->
