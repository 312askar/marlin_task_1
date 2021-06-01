<?php
function upload_user_avatar($img_src){

	if ($_FILES && $_FILES[$img_src]['error'] == UPLOAD_ERR_OK) {

		$uploaddir = "uploads/";
		$origin_name = $_FILES[$img_src]['name'];
		$ext = substr($origin_name, strpos($origin_name,'.'), strlen($origin_name)-1);
		$move_name = $uploaddir .uniqid('avatar-').$ext;
		move_uploaded_file($_FILES[$img_src]['tmp_name'], $move_name);

		$pdo = new PDO("mysql:host=localhost; dbname=marlindev_tasks; charset=utf8;", "root", "root");

	    $sql = "INSERT INTO images (img_src) VALUES (:move_name)";

	    $statement = $pdo->prepare($sql);
	    $statement->execute(['move_name' => $move_name]);

	    $added_image_id = $pdo->lastInsertId();

	}

	return $added_image_id;

}

function get_uploaded_image($imageId){

	$pdo = new PDO("mysql:host=localhost; dbname=marlindev_tasks; charset=utf8;", "root", "root");

	$sql = "SELECT img_src FROM images WHERE id=:imageId";

	$statement = $pdo->prepare($sql);
	$statement->execute(['imageId' => $imageId]);

	$file = $statement->fetch(PDO::FETCH_ASSOC);

	return $file['img_src'];

}

function redirect_to($path){

	header("Location: $path");

	exit;

}