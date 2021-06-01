<?php
require "functions.php";

$imageId = upload_user_avatar('img_src');

redirect_to('page_upload_image.php?id='.$imageId);


// var_dump(get_uploaded_image($imageId));
