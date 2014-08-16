<?php 
require_once('config.php');

$pid = $_GET['p_id'];

$sql = "SELECT song_info FROM playlists WHERE id = {$pid}";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_object($res);
if(empty($row)){
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: index.php");
}
$song_sql = "SELECT * FROM songs WHERE id IN({$row->song_info})";
$res = mysqli_query($con,$song_sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Music</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </head>
  <body>
    <div class="container">
      <table class="table table-striped" style="width:700px;">
        <thead>
          <tr>
            <th><i class="icon-music"></i>Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="list">
          <?
          while ($row = mysqli_fetch_object($res)) {
            // 取得專輯名稱
            $album = "SELECT singer_info,name FROM albums WHERE song_info IN ({$row->id})";
            $album_res = mysqli_query($con,$album);
            $album_row = mysqli_fetch_object($album_res);
            // 取得歌手
            $singer = "SELECT name FROM singers WHERE id IN ({$album_row->singer_info})";
            $singer_res = mysqli_query($con,$singer);
            $singer_row = mysqli_fetch_object($singer_res);
            $album_name = '無專輯名稱';
            if($album_row->name){
              $album_name = $album_row->name;
            }
            $singer_name = '無歌手';
            if($singer_row->name){
              $singer_name = $singer_row->name;
            }
            echo "<tr><td>{$row->name}</td><td style='text-align:right;'><span id='album_info'>{$singer_name}-{$album_name}</span></td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php mysqli_close($con);?>
  </body>
</html>