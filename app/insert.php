<?
    header("Content-type: application/json; charset=utf-8");
    include "../function.php";
    session_start();
    $err = false;
    $insert = new DB_con();
    $table = "index_number(idindex_number,index_number,
                date_inbook,date_number,appm_section_id,
                    in_to,in_subject,in_type,pdf_file,username_req,tel,medcode)";
    $pdf_upload = "";
    if($_POST['data']['status_uploads'] == '1'){
        $pdf_upload = $_POST['data']['idindex_number'].'.pdf';
    }
    $value = array();
    $value[] = @"'".$_POST['data']['idindex_number']."'";
    $value[] = @"'".$_POST['data']['index_number']."'";
    $value[] = @"'".$_POST['data']['date_inbook']."'";
    $value[] = @"'".$_POST['data']['date_number']."'";
    $value[] = @"'".$_POST['data']['appm_section_id']."'";
    $value[] = @"'".$_POST['data']['in_to']."'";
    $value[] = @"'".$_POST['data']['in_sub']."'";
    $value[] = @"'".$_POST['data']['in_type']."'";
    $value[] = @"'".$pdf_upload."'";
    $value[] = @"'".$_POST['data']['username_req']."'";
    $value[] = @"'".$_POST['data']['tel']."'";
    $value[] = @"'".$_SESSION['medcode']."'";

    // echo json_encode($value);
    if($insert->insert($value)){
        echo '1';
    }else{
        echo '0';
    }


?>