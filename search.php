<?php
require_once('config.php');
$post_data = $_POST;

// 搜尋會員歌單
$chk_sql = "
	SELECT u.id,u.sex,u.name as u_name,p.id as p_id,p.name,p.song_info 
	FROM users as u
	INNER JOIN playlists as p ON (u.id = p.u_id)
	WHERE u.name LIKE '%{$post_data['search_name']}%'";
$res = mysqli_query($con,$chk_sql);

$num_sql = "
	SELECT u.id
	FROM users as u
	INNER JOIN playlists as p ON (u.id = p.u_id)
	WHERE u.name LIKE '%{$post_data['search_name']}%'";
$num_res = mysqli_query($con,$num_sql);
$row_num = mysqli_fetch_assoc($num_res);

$user_info = array();$html='';
// var_dump($row_num);
if($row_num){
	while($row = mysqli_fetch_object($res)) {
		$sex = ($row->sex == 'M')?'男':'女';
		$html .= "<tr>
			<td>{$row->u_name}</td>
			<td>{$sex}</td>
			<td><a href='playlist_info.php?p_id={$row->p_id}' target='_blank'>{$row->name}</a></td>
		</tr>";
	}	
}else{
	$html = "<tr><td colspan='3' style='text-align: center;'>搜尋無結果</td></tr>";	
}

echo $html;
?>