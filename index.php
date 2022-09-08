<?
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    include "function.php";
    $search = new DB_con;
    $_SESSION['DESCRIPTION'] = $search->search_department($_SESSION['userLOG'][4]);
    $_SESSION['medcode'] = $_SESSION['_USER'];
    $_SESSION['SECTION_CODE'] = $_SESSION['userLOG'][4];
    if($_SESSION['user'] == ""){
        echo "<script>window.location = '../../'</script>";
    } else {
        $id_card = $_SESSION['_IDCARD'];
        require_once "config/userPassDb.php";
        $conn2 = new mysqli(DB_SERVER, DB_USER, DB_PASS, 'menu_handle'); mysqli_set_charset($conn2,"utf8");
            if($conn2->connect_error) {
                    // echo "<script> console.log('Cannot connect DB') </script>";
            } else {
            // echo "<script> console.log('db2 Connect') </script>" ;
            }
        $sql = "SELECT am.*,mhd.mhd_name FROM active_menu AS am 
                    JOIN mhd_sys_sub AS mhd ON am.active_mhd_id = mhd.mhd_id
                        WHERE am.active_authorise_id = '$id_card' AND mhd.mhd_name = 'ระบบสารบัญ' LIMIT 1";
        $result = $conn2->query($sql);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $_SESSION['report'] = $row['active_report'];
                $_SESSION['write'] = $row['active_write'];
            }
        }
        else if($_SESSION['_LOGIN'] == 'admin'){
            $_SESSION['report'] = 1;
            $_SESSION['write'] = 1;
        }

        if($_SESSION['report'] == '1'){
            echo "<script>window.location = 'app'</script>";
        }
    }

?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    กำลังปรับปรุงระบบ ....
</body>

</html> -->