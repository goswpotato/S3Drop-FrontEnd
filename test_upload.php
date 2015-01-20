<?php


move_uploaded_file($_FILES["file"]["tmp_name"],"server/".$_FILES["file"]["name"]);

print_r($_FILES);


?>