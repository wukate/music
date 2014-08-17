<?php
require_once('config.php');
require_once('SimpleImage.php');

$post_data = $_POST;

switch ($post_data['insert_type']) {
	case 'member':
		$name = addslashes($post_data['name']);
		$email = addslashes($post_data['email']);
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM users WHERE email='{$email}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		if(!$row){
			// 不存在 -> 新增
			$sql = "INSERT INTO users (name, sex, email) VALUES ('{$name}', '{$post_data['sex']}','{$email}')";
			mysqli_query($con,$sql);
		}
		break;

	case 'category':
		$name = addslashes($post_data['name']);
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM categories WHERE name='{$name}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		if(!$row){
			// 不存在 -> 新增
			$sql = "INSERT INTO categories (name) VALUES ('{$name}')";
			mysqli_query($con,$sql);
		}
		break;

	case 'singer':
		$name = addslashes($post_data['name']);
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM singers WHERE name='{$post_data['name']}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		if(!$row){
			$type_array = array_merge($post_data['singers'],$post_data['location']);
			$singer_type = implode(',', $type_array);
			// 不存在 -> 新增
			$sql = "INSERT INTO singers (name,type) VALUES ('{$name}','{$singer_type}')";
			mysqli_query($con,$sql);
		}
		break;

	case 'song':
		$name = addslashes($post_data['name']);
		$lyrics = addslashes($post_data['lyrics']);
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM songs WHERE name='{$post_data['name']}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);

		if(!$row){
			// 不存在 -> 新增
			$sql = "INSERT INTO songs (name,lyrics) VALUES ('{$name}','{$lyrics}')";
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
		$name = addslashes($post_data['name']);
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM album WHERE name='{$name}'";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);

		if(!$row){
			// 不存在 -> 新增
			$singer_info = implode(',', $post_data['singer']);
			$song_info = implode(',', $post_data['song']);
			$sql = "INSERT INTO albums (name,cate_id,singer_info,song_info) VALUES ('{$name}','{$post_data['cate_id']}','{$singer_info}','{$song_info}')";
			mysqli_query($con,$sql);

			$new_res = "SELECT id FROM albums ORDER BY id desc LIMIT 1";
			$result = mysqli_query($con,$new_res);
			$res = mysqli_fetch_object($result);
			$new_id = $res->id;

			$extension = array('image/jpeg','image/jpg');
			// 判斷格式
			if(in_array($_FILES["cover"]["type"], $extension)){
				// 判斷資料夾
				if(!is_dir('./uploads/')) { 
					mkdir("./uploads/", 0777);

					if(!is_dir('./uploads/album/cover/')) { 
						mkdir("./uploads/album/cover/", 0777);
					}
				} 
				// 上傳檔案
				// $new_id = 1;
				$upload_filename = $new_id.".".pathinfo($_FILES["cover"]['name'], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["cover"]["tmp_name"],iconv("utf-8", "big5", './uploads/album/cover/'.$upload_filename));
				$new_filename = 'new_'.$new_id.".".pathinfo($_FILES["cover"]['name'], PATHINFO_EXTENSION);
				// 縮圖
				$image = new SimpleImage();
				$image->load('./uploads/album/cover/'.$upload_filename); 
				$image->resize(250,400); 
				$image->save('./uploads/album/cover/'.$new_filename);
			}
			// 更新檔案
			$update_sql = "UPDATE albums SET cover='album/cover/{$upload_filename}' WHERE id={$new_id}";
			mysqli_query($con,$update_sql);
			
		}
		break;

	case 'playlist':
		$name = addslashes($post_data['name']);
		// 判斷是否已存在
		$chk_sql = "SELECT * FROM playlists WHERE name='{$name}' AND u_id={$post_data['u_id']}";
		$res = mysqli_query($con,$chk_sql);
		$row = mysqli_fetch_assoc($res);
		if(!$row){
			$song_info = implode(',', $post_data['song']);
			// 不存在 -> 新增
			$sql = "INSERT INTO playlists (u_id,name,song_info) VALUES ({$post_data['u_id']},'{$name}','{$song_info}')";
			mysqli_query($con,$sql);
		}
		break;
	default:
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: form.php");
		break;
}
header("HTTP/1.1 301 Moved Permanently");
header("Location: form.php");
mysqli_close($con);
?>