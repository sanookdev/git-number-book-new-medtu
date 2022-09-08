<?
    header("Content-type: application/json; charset=utf-8");
    include "../function.php";
    $delete = new DB_con();
    $result = $delete->delete($_POST['id'],$_POST['table']);
    echo json_encode($result);
?>