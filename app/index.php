<?
    session_start();
    if($_SESSION['report'] == ''){
        echo "<script>window.location.href='../'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ระบบสารบัญ คณะแพทยศาสตร์ มหาวิทยาลัยธรรมศาสตร์</title>

    <!-- LINK CSS  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">


    <!-- FONT CSS LINK -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/0.6.2/pure-min.css">



    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/alertify.min.css">
    <link rel="stylesheet" href="../css/themes/semantic.min.css">
    <link rel="stylesheet" href="css/auto-complete.css">


    <!-- PHP FUNCTION -->
    <? include "../function.php"; ?>

    <style>
    .pure-form input,
    .pure-form select,
    .pure-form button {
        border-radius: 0 !important;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <? include "nav.php" ;?>
        <div id="layoutSidenav_content">
            <? include "sidebar.php" ;?>
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-3">
                        <li class="breadcrumb-item active"> - จัดการข้อมูลหนังสือ / สารบัญ</li>
                    </ol>
                    <fieldset class="add">
                        <legend class="add">ค้นหา</legend>
                        <form id="form_search" method="post" action="">
                            <div class="form-row mt-2">
                                <div class="col-md-1">
                                    <select class="form-control form-control-sm mb-2" name="search_year"
                                        id="search_year">
                                        <option value="">เลือกปี</option>
                                        <?for($i = 0 ; $i < 10 ; $i++){?>
                                        <option value="<?= (int)(date('Y') - $i);?>"
                                            <?= (((int)(date('Y') - $i)) == $_POST['search_year']) ? "selected" : '' ;?>>
                                            <?= (int)(date('Y')+543) - (int)($i);?>
                                        </option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control form-control-sm mb-2" name="search_month"
                                        id="search_month" disabled>
                                        <option value=""> เลือกเดือน</option>
                                        <?for($i = 1 ; $i <= 12 ; $i++){?>
                                        <?= $_POST['search_month'] . " : " . convert_month($i) ;?>
                                        <option value="<?= ($i > 9 )? $i : '0'.$i;?>"
                                            <?= (($i == $_POST['search_month'])) ? "selected" : '' ;?>>
                                            <?= convert_month($i);?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control form-control-sm mb-2" name="search_type"
                                        id="search_type">
                                        <option value=""> เลือกประเภท</option>
                                        <option value="1" <?= ($_POST['search_type'] == '1')? "selected" : '' ;?>>ภายใน
                                        </option>
                                        <option value="2" <?= ($_POST['search_type'] == '2')? "selected" : '' ;?>>ภายนอก
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-sm btn-block btn-info btn_search">
                                        <i class="fas fa-search"></i> ค้นหา
                                    </button>
                                </div>
                                <? if($_SESSION['write'] == '1'){?>

                                <div class="col-md-7">
                                    <button class="btn btn-success btn_add float-right" data-toggle="modal"
                                        data-target="#add_modal">
                                        <i class="fas fa-plus"></i>
                                        เพิ่มรายการ
                                    </button>
                                </div>
                                <?}?>

                            </div>
                        </form>
                    </fieldset>
                    <div class="card mb-2 mt-4">
                        <div class="card-header">
                            <div class="form-row">
                                <div class="col-md-1 ">
                                    <i class="fas fa-book mr-1"></i> รายชื่อหนังสือ
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center" id="dataTable"
                                    width="100%" cellspacing="0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="9%">ลำดับ</th>
                                            <th width="8%">วันที่</th>
                                            <th width="7%">เลขหนังสือ</th>
                                            <th width="6%">ประเภท</th>
                                            <th width="15%">หน่วยงาน</th>
                                            <th width="30%">เรื่อง</th>
                                            <th width="15%">ถึง</th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fetch_data"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div id='loader' style='display: none;'>
                                <img src='../img/reload.gif' width='35px' height='auto'> กำลังทำการค้นหา ...
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <? include "../footer.html" ;?>
        </div>
    </div>

    <? include "modal/add_modal.php"; ?>
    <? include "modal/edit_modal.php"; ?>

    <!-- jQuery Link  -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>


    <!-- DATATABLE JS  -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>


    <!-- CUSTM JS  -->
    <script src="../js/scripts.js"></script>
    <script src="../js/alertify.min.js"></script>

    <!-- EVENT ADMIN JS -->
    <script src="js/event.js"></script>

    <!-- AUTOCOMPLETE JS  -->
    <script src="js/auto-complete.js"></script>


</body>

</html>