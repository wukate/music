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
        <div class="control-group">
          <div class="controls">
            Name:<input type="text" id="name" name="name" placeholder="Enter Name...">
            <button type="button" id="sub_btn" class="btn btn-primary btn-lg">Submit</button>
          </div>
        </div>

        <thead>
          <tr>
            <th><i class="icon-user"></i>Name</th>
            <th><i class="icon-user"></i>Sex</th>
            <th><i class="icon-list"></i>Playlist</th>
          </tr>
        </thead>
        <tbody id="list">
          <tr><td colspan="3" style="text-align: center;">搜尋無結果</td></tr>
        </tbody>
      </table>
    </div>
  </body>
</html>