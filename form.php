<?php 
require_once('config.php');

// 取得所有分類
$cate_sql = "SELECT * FROM categories";
$categories = mysqli_query($con,$cate_sql);

// 取得所有歌曲
$song_sql = "SELECT * FROM songs";
$res = mysqli_query($con,$song_sql);

$songs = array();
while($row = mysqli_fetch_object($res)) {
  $tmp['id'] = $row->id;
  $tmp['name'] = $row->name;

  array_push($songs, $tmp);
}

// 取得所有歌手
$singer_sql = "SELECT * FROM singers";
$singers = mysqli_query($con,$singer_sql);

// 取得所有會員
$user_sql = "SELECT * FROM users";
$users = mysqli_query($con,$user_sql);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Music</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </head>
  <body>
    <div class="container">
      <!-- insert member start -->
      <h4>新增會員</h4>
      <form class="form-horizontal" action="create.php" method="post">
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Name...">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputSex">Sex</label>
          <div class="controls">
          <label class="radio">
            <input type="radio" name="sex" id="sex_1" value="M" checked>男
          </label>
          <label class="radio">
            <input type="radio" name="sex" id="sex_2" value="F">女
          </label>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">Email</label>
          <div class="controls">
            <input type="text" id="email" name="email" placeholder="EnterEmail">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
        <input type="hidden" name="insert_type" value="member">
      </form>
      <!-- insert member end -->
      <!-- insert category start -->
      <h4>新增分類</h4>
      <form class="form-horizontal" action="create.php" method="post">
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Name...">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
        <input type="hidden" name="insert_type" value="category">
      </form>
      <!-- insert category end -->
      <!-- insert singer start -->
      <h4>新增歌手</h4>
      <form class="form-horizontal" action="create.php" method="post">
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Name...">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputType">Type</label>
          <div class="controls">
            <label class="checkbox inline">
              <input type="checkbox" name="singers[]" id="singers_1" value="男歌手"> 男歌手
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="singers[]" id="singers_2" value="女歌手"> 女歌手
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="singers[]" id="singers_3" value="男生團體"> 男生團體
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="singers[]" id="singers_4" value="女生團體"> 女生團體
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="singers[]" id="singers_5" value="樂團"> 樂團
            </label>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputType">Location</label>
          <div class="controls">
            <label class="checkbox inline">
              <input type="checkbox" name="location[]" id="location_1" value="台灣"> 台灣
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="location[]" id="location_2" value="韓國"> 韓國
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="location[]" id="location_3" value="日本"> 日本
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="location[]" id="location_4" value="歐美"> 歐美
            </label>
            <label class="checkbox inline">
              <input type="checkbox" name="location[]" id="location_5" value="其他"> 其他
            </label>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
        <input type="hidden" name="insert_type" value="singer">
      </form>
      <!-- insert singer end -->
      <!-- insert song start -->
      <h4>新增歌曲</h4>
      <form class="form-horizontal" action="create.php" method="post" enctype="multipart/form-data">
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Name...">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputFile">File</label>
          <div class="controls">
            <input type="file" id="file" name="file">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputLyrics">Lyrics</label>
          <div class="controls">
            <textarea rows="3" name="lyrics" id="lyrics"></textarea>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
        <input type="hidden" name="insert_type" value="song">
      </form>
      <!-- insert song end -->
      <!-- insert album start -->
      <h4>新增專輯</h4>
      <form class="form-horizontal" action="create.php" method="post" enctype="multipart/form-data">
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Name...">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputCover">Cover</label>
          <div class="controls">
            <input type="file" id="cover" name="cover">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">分類</label>
          <div class="controls">
            <?php
            if($categories){
              $count=1;
              while($row = mysqli_fetch_object($categories)) {
                $br_sign='';
                if(($count%5)== 0 ){
                  $br_sign='<br>';
                }
            ?>
            <label class="radio inline">
              <input type="radio" name="cate_id" id="cate_id" value="<?php echo $row->id;?>"> <?php echo $row->name?>
            </label><?php echo $br_sign;?>
            <? 
              ++$count;
              }
            }
            ?>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">歌手</label>
          <div class="controls">
            <?php
            if($singers){
              $count=1;
              while($row = mysqli_fetch_object($singers)) {
                $br_sign='';
                if(($count%5)== 0 ){
                  $br_sign='<br>';
                }
            ?>
            <label class="checkbox inline">
              <input type="checkbox" name="singer[]" id="singer_<?php echo $row->id;?>" value="<?php echo $row->id;?>"> <?php echo $row->name?>
            </label><?php echo $br_sign;?>
            <? 
              ++$count;
              }
            }
            ?>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">歌曲</label>
          <div class="controls">
            <?php

            if($songs){
              $count=1;
              foreach ($songs as $key => $row) {
                $br_sign='';
                if(($count%5)== 0 ){
                  $br_sign='<br>';
                }
            ?>
            <label class="checkbox inline">
              <input type="checkbox" name="song[]" id="song_<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"> <?php echo $row['name']?>
            </label><?php echo $br_sign;?>
            <? 
              ++$count;
              }
            }
            ?>
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
        <input type="hidden" name="insert_type" value="album">
      </form>
      <!-- insert album end -->

      <!-- insert playlist start -->
      <h4>新增歌單</h4>
      <form class="form-horizontal" action="create.php" method="post" enctype="multipart/form-data">
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Name...">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">會員</label>
          <div class="controls">
            <?php
            if($users){
              $count=1;
              while($row = mysqli_fetch_object($users)) {
                $br_sign='';
                if(($count%5)== 0 ){
                  $br_sign='<br>';
                }
            ?>
            <label class="radio inline">
              <input type="radio" name="u_id" id="u_id" value="<?php echo $row->id;?>"> <?php echo $row->name?>
            </label><?php echo $br_sign;?>
            <? 
              ++$count;
              }
            }
            ?>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">歌曲</label>
          <div class="controls">
            <?php

            if($songs){
              $count=1;
              foreach ($songs as $key => $row) {
                $br_sign='';
                if(($count%5)== 0 ){
                  $br_sign='<br>';
                }
            ?>
            <label class="checkbox inline">
              <input type="checkbox" name="song[]" id="song_<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"> <?php echo $row['name']?>
            </label><?php echo $br_sign;?>
            <? 
              ++$count;
              }
            }
            ?>
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>
        <input type="hidden" name="insert_type" value="playlist">
      </form>
      <!-- insert playlist end -->
    </div>
  </body>
</html>