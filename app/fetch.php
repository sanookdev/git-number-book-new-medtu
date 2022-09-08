<?
    header("Content-type: application/json; charset=utf-8");
    session_start();
    include "../function.php";
    $fetch = new DB_con();
    if($_POST['year'] != '' || $_POST['month'] != '' || $_POST['in_type'] != ''){
        $year = $_POST['year'];
        $month = $_POST['month'];
        $table = $_POST['table'];
        $in_type = $_POST['in_type'];
        if($year != ''){
            $where .= "YEAR(date_inbook) = '$year'";
            if($month != null){
                $where .= " AND MONTH(date_inbook) = '$month'";
            }
        }
        if($in_type != ''){
            if($year != ''){
                $where .= " AND ";
            }
            $where .= "in_type = '$in_type'";
        }

        $where .= " ORDER BY idindex_number DESC ";
        if($year == ''){
            $where .= " LIMIT 500";
        }
        $sql = $fetch->search($table,$where);
    }else{
        $sql = $fetch->fetch_data();
    }
    $result = array();
    while($row = mysqli_fetch_assoc($sql)){
        $result[] = $row;
    }
    for($i = 0 ; $i < count($result) ; $i++){
        $result[$i]['appm_section_id'] = $fetch->search_department($result[$i]['appm_section_id']);
    }
    if($_SESSION['write'] == '1'){
        $result[]['status'] = 1;
    }else{
        $result[]['status'] = 0;
    }

    echo json_encode($result);
?>