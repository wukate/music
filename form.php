<?php 
require_once('config.php');

// 取得所有歌曲
$sql = "SELECT * FROM songs";
$res = mysqli_query($con,$sql);
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
          <label class="control-label" for="inputEmail">Email</label>
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
          <label class="control-label" for="inputEmail">歌曲</label>
          <div class="controls">
            <?php
            if($res){
              while($row = mysqli_fetch_object($res)) {
            ?>
            <label class="checkbox inline">
              <input type="checkbox" name="song[]" id="song_<?php echo $row->id;?>" value="<?php echo $row->id;?>"> <?php echo $row->name;?>
            </label>
            <? 
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
    </div>
  </body>
</html>