<?php
$post_data = $_POST;
// $con=mysqli_connect("127.0.0.1","root","1234","demo");
// mysqli_query($con,"SET NAMES 'utf8'");
// // Check connection
// if (mysqli_connect_errno()) {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }
require_once('config.php');

switch ($post_data['insert_type']) {
	case 'member':
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM users WHERE email='{$post_data['email']}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		if(!$row){
			// 不存在 -> 新增
			$sql = "INSERT INTO users (name, sex, email) VALUES ('{$post_data['name']}', '{$post_data['sex']}','{$post_data['email']}')";
			mysqli_query($con,$sql);
		}
		break;

	case 'category':
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM categories WHERE name='{$post_data['name']}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		if(!$row){
			// 不存在 -> 新增
			$sql = "INSERT INTO categories (name) VALUES ('{$post_data['name']}')";
			mysqli_query($con,$sql);
		}
		break;

	case 'song':
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM songs WHERE name='{$post_data['name']}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);

		if(!$row){
			// 不存在 -> 新增
			$sql = "INSERT INTO songs (name,lyrics) VALUES ('{$post_data['name']}','{$post_data['lyrics']}')";
			$result = mysqli_query($con,$sql);

			$new_res = "SELECT id FROM songs ORDER BY id desc LIMIT 1";
			$result = mysqli_query($con,$new_res);
			$res = mysqli_fetch_object($result);
			$new_id = $res->id;

			$extension = array('audio/mp3','audio/mpeg');
			// 判斷格式
			if(in_array($_FILES["file"]["type"], $extension)){
				// 判斷資料夾
				if(!is_dir('./uploads/')) { 
					mkdir("./uploads/", 0777);

					if(!is_dir('./uploads/song/')) { 
						mkdir("./uploads/song/", 0777);
					}
				}
				// 上傳檔案
				$upload_filename = $new_id.".".pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["file"]["tmp_name"],iconv("utf-8", "big5", './uploads/song/'.$upload_filename));
			}
			// 更新檔案
			$update_sql = "UPDATE songs SET file='song/{$upload_filename}' WHERE id={$new_id}";
			mysqli_query($con,$update_sql);
		}
		break;

	case 'album':
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM album WHERE name='{$post_data['name']}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		echo '<pre>';
		print_r($post_data);
		echo '</pre>';

		echo '<pre>';
		print_r($_FILES);
		echo '</pre>';
		if(!$row){
			// // 不存在 -> 新增
			// $sql = "INSERT INTO album (name) VALUES ('{$post_data['name']}')";
			// mysqli_query($con,$sql);
		}
		break;
	
	default:
		# code...
		break;
}
// header("HTTP/1.1 301 Moved Permanently");
// header("Location: index.php");
mysqli_close($con);
?>