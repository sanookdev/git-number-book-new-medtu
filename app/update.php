<?
    header("Content-type: application/json; charset=utf-8");
    include "../function.php";
    session_start();
    $update = new DB_con();
    $pdf_upload = "";
    $data_arr = array();
    $data_arr = $_POST['data'];
    unset($data_arr['status_uploads']);
    if($_POST['data']['status_uploads'] == '1'){
        $pdf_upload = $_POST['data']['idindex_number'].'.pdf';
        $data_arr['pdf_file'] = $pdf_upload;
    }
    $update_id = $_POST['data']['idindex_number'];
    $where = 'idindex_number = '."$update_id";
    $table = 'index_number';

    if($update->update($table,$data_arr,$where)){
        echo "1";
    }else{
        echo "0";
    }
    
    // echo json_encode($data_arr);
?>