<?php
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$fileName = $_FILES["pdf_file_edit"]["name"]; // The file name
$fileTmpLoc = $_FILES["pdf_file_edit"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["pdf_file_edit"]["type"]; // The type of file it is
$fileSize = $_FILES["pdf_file_edit"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["pdf_file_edit"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
if (move_uploaded_file($fileTmpLoc, "../uploads/pdf/".$_POST['reName'].".pdf")) {
    echo "$fileName upload is complete";
} else {
    echo "move_uploaded_file function failed";
}