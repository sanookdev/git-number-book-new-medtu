<?
    header("Content-type: application/json; charset=utf-8");
    include "../function.php";
    $search = new DB_con();
    $topic = $_REQUEST['topic'];
    $result = array();
    // echo json_encode($_POST." ".$_GET);

    if($topic == 'lastid'){
        $table = 'index_number';
        $where = "YEAR(date_inbook) = ".date('Y'). " ORDER BY idindex_number DESC LIMIT 1";
        $sql = $search->search($table,$where);
        while($row = mysqli_fetch_assoc($sql)){
            $result[] = $row;
        }
    
        $today = ((int)date('Y')+543).date('m').date('d');
        if(is_null($result[0]['idindex_number'])){
            $lastid = 10000;
        }else{
            $lastid = '1'.substr($result[0]['idindex_number'],8,12);
        }
        $newLastid = (int)($lastid) + 1;
        $newLastid = substr($newLastid,1,4);
        $result = array();
        $result['lastid'] = $today.$newLastid;
    }else if ($topic == 'name_req'){
        $name = trim($_REQUEST['name']);
        $sql = $search->search_fullnameByreq($name);
        while($row = mysqli_fetch_assoc($sql)){
            $result[] = $row['FULLNAME'];
        } 
    }else if ($topic == 'department'){
        $sql = $search->fetch_department();
        while($row = mysqli_fetch_assoc($sql)){
            $result[] = $row;
        }
    }else if ($topic == 'edit'){
        $idindex_number = $_POST['idindex_number'];
        $table = 'index_number';
        $where = 'idindex_number = '.$idindex_number;
        $sql = $search->search($table,$where);
        while($row = mysqli_fetch_assoc($sql)){
            $result[] = $row;
        }
    }

   
    echo json_encode($result);
    // echo json_encode($newLastid);
?>