$(document).ready(function() {

    // UPLOAD PDF FORM_ADD 
    $('#pdf_file').on('change', function() {
        var path_name = $(this).val();
        if (path_name) {
            var startIndex = (path_name.indexOf('\\') >= 0 ? path_name.lastIndexOf('\\') : path_name.lastIndexOf('/'));
            var filename = path_name.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $('#name_file').html(filename);
        }

        uploadFile();
    })

    // UPLOAD PDF FORM_EDIT 
    $('#pdf_file_edit').on('change', function() {
        var path_name = $(this).val();
        if (path_name) {
            var startIndex = (path_name.indexOf('\\') >= 0 ? path_name.lastIndexOf('\\') : path_name.lastIndexOf('/'));
            var filename = path_name.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $('#name_file_edit').html(filename);
        }
        uploadFileEdit();
    })

    // SUBMIT FORM ADD 
    $('#form_add').on('submit', function(e) {
        e.preventDefault();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        var data = {
            idindex_number: $('#idindex_number').val(),
            index_number: $('#index_number').val(),
            in_type: $('#in_type').val(),
            in_to: $('#in_to').val(),
            in_sub: $('#in_sub').val(),
            username_req: $('#username_req').val(),
            appm_section_id: $('#appm_section_id').val(),
            tel: $('#tel').val(),
            date_inbook: today
        };
        if ($('#index_number').val() != '') {
            data['date_number'] = today;
        } else {
            data['date_number'] = '';
        }

        var file = document.getElementById('pdf_file');
        if (file.value != "") {
            data['status_uploads'] = '1';
        } else {
            data['status_uploads'] = '0';
        }
        // console.log(data);
        $.ajax({
            url: "insert.php",
            method: "POST",
            data: {
                data,
            },
            beforeSend: function() {
                $('#form_add').val("Inserting");
            },
            success: function(data) {
                console.log(data);
                $('#form_add')[0].reset();
                $('#add_modal').modal('hide');
                if (data == 1) {
                    sessionStorage.setItem('add_order', '1');
                    window.location.reload();
                }
            }
        });
    })

    // SUBMIT FORM_EDIT
    $('#form_edit').on('submit', function(e) {
            e.preventDefault();
            var data = {
                idindex_number: $('#idindex_number_edit').val(),
                index_number: $('#index_number_edit').val(),
                in_type: $('#in_type_edit').val(),
                in_to: $('#in_to_edit').val(),
                in_subject: $('#in_sub_edit').val(),
                username_req: $('#username_req_edit').val(),
                appm_section_id: $('#appm_section_id_edit').val(),
                tel: $('#tel_edit').val(),
                date_number: $('#date_number_edit').val(),
                date_inbook: $('#date_inbook_edit').val()
            };
            var file = document.getElementById('pdf_file_edit');
            if (file.value != "") {
                data['status_uploads'] = '1';
            } else {
                data['status_uploads'] = '0';
            }
            $.ajax({
                url: "update.php",
                method: "POST",
                data: {
                    data,
                },
                beforeSend: function() {
                    $('#form_edit').val("Inserting");
                },
                success: function(data) {
                    $('#form_edit')[0].reset();
                    $('#edit_modal').modal('hide');
                    if (data == 1) {
                        sessionStorage.setItem('update_order', '1');
                        window.location.reload();
                    }
                }
            });
        })
        // FETCH DATA BY DEFAULT OR SEARCH 
    var year = $('#search_year').val();
    var month = $('#search_month').val();
    var type = $('#search_type').val();

    if ($('#search_year').val() != '') {
        $('#search_month').prop('disabled', false);
    } else {
        $('#search_month').prop('disabled', true);
        $('#search_month').val('');
    }

    // IF SEARCH BY MONTH : RULE -> YEAR NOT EMPTY
    $('#search_year').on('change', function() {
        if ($(this).val() != '') {
            $('#search_month').prop('disabled', false);
        } else {
            $('#search_month').prop('disabled', true);
            $('#search_month').val('');
        }
    })

    $.ajax({
            url: 'fetch.php',
            dataType: 'json',
            type: "POST",
            data: {
                year: year,
                month: month,
                in_type: type,
                table: 'index_number',
            },
            beforeSend: function() {
                // Show loading... waiting process ajax
                $("#loader").show();
            },
            success: function(data) {
                // console.log(data[data.length - 1]['status']);
                output = '';
                for (i = 0; i < data.length - 1; i++) {
                    var in_type_sc = data[i]['in_type'];
                    if (in_type_sc == '1') { in_type_sc = 'ภายใน' } else { in_type_sc = 'ภายนอก' }
                    output += '<tr>';
                    output += '<td>' + data[i]['idindex_number'] + '</td>';
                    output += '<td>' + data[i]['date_inbook'] + '</td>';
                    output += '<td>' + data[i]['index_number'] + '</td>';
                    output += '<td>' + in_type_sc + '</td>';
                    output += '<td>' + data[i]['appm_section_id']['DESCRIPTION'] + '</td>';
                    output += '<td>' + data[i]['in_subject'] + '</td>';
                    output += '<td>' + data[i]['in_to'] + '</td>';
                    output += '<td>' + '<button class = "btn btn-outline-info btn-sm" value="' + data[i]['idindex_number'] + '" onclick = "callpdf(' + "'" + data[i]['pdf_file'] + "'" + ')"><i class="fas fa-file-pdf"></i></button>';

                    if (data[data.length - 1]['status'] == '1') {
                        output += '<button class = "btn btn-outline-warning  mr-1 ml-1 btn_edit btn-sm" value = "' + data[i]['appm_section_id']['DESCRIPTION'] +
                            '" id = "' + data[i]['idindex_number'] + '"><i class="fas fa-edit"></i>' +
                            '</button>' +
                            '<button class = "btn btn-outline-danger btn_delete btn-sm" id = "btn_delete" value="' +
                            data[i][
                                'idindex_number'
                            ] + '" onclick = "deleted(' + data[i][
                                'idindex_number'
                            ] + ')"><i class="fas fa-trash-alt"></i></button>' +
                            '</td>';
                    }
                    output += '</tr>';
                }
                $('.fetch_data').html(output);
                var table = $('#dataTable').DataTable({
                    lengthChange: false,
                    buttons: ['excel'],
                    order: ['1', 'desc']
                });
                table.buttons().container()
                    .appendTo('#dataTable_wrapper .col-md-6:eq(0)');
            },
            complete: function() {
                // Hide loading after process ajax
                $("#loader").hide();
            }
        })
        // FETCH DATA BY DEFAULT OR SEARCH  ( END )

    // BTN ADD CLICK
    $('.btn_add').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'search.php',
            method: 'post',
            dataType: 'json',
            data: {
                topic: 'lastid',
            },
            success: function(data) {
                console.log(data);
                $('#idindex_number').val(data['lastid']);
            }
        })
        $.ajax({
            url: 'search.php',
            method: 'post',
            dataType: 'json',
            data: {
                topic: 'department'
            },
            success: function(data) {
                output = '';
                output += '<option value ="">' + 'เลือกหน่วยงาน ...' + '</option>';
                for (i = 0; i < data.length; i++) {
                    output += '<option value = "' + data[i]['SECTION_CODE'] + '">';
                    output += data[i]['DESCRIPTION'];
                    output += '</option>';
                }
                $('#appm_section_id').html(output);
            }
        })
    })


    new autoComplete({
        selector: '#username_req',
        minChars: 1,
        source: function(term, response) {
            $.getJSON(
                'search.php', {
                    name: term,
                    topic: 'name_req'
                },
                function(data) {
                    response(data);
                });
        }
    });
})


// FETCH DATA TO FORM EDIT WHEN CLICK BTN_EDIT 
$(document).on('click', '.btn_edit', function(e) {
    e.preventDefault();
    var idindex_number = $(this).attr("id");
    var DESCRIPTION = $(this).attr('value');
    if (idindex_number != '') {
        $.ajax({
            url: 'search.php',
            method: 'post',
            dataType: 'json',
            data: {
                topic: 'department'
            },
            success: function(data) {
                output = '';
                output += '<option value ="">' + 'เลือกหน่วยงาน ...' + '</option>';
                for (i = 0; i < data.length; i++) {
                    msg = '';
                    if (data[i]['DESCRIPTION'] == DESCRIPTION) {
                        msg = 'selected';
                    }
                    output += '<option value = "' + data[i]['SECTION_CODE'] + '"' + msg + '>';
                    output += data[i]['DESCRIPTION'];
                    output += '</option>';
                }
                $('#appm_section_id_edit').html(output);
            }
        })
        $.ajax({
            url: "search.php",
            method: "POST",
            data: {
                idindex_number: idindex_number,
                topic: 'edit',
            },
            success: function(data) {
                // $('#showData').html(data);
                console.log(data);
                $('#date_inbook_edit').val(data[0]['date_inbook']);
                $('#date_number_edit').val(data[0]['date_number']);
                $('#idindex_number_edit').val(data[0]['idindex_number']);
                $('#index_number_edit').val(data[0]['index_number']);
                $('#in_type_edit').val(data[0]['in_type']);
                $('#in_to_edit').val(data[0]['in_to']);
                $('#in_sub_edit').val(data[0]['in_subject']);
                $('#username_req_edit').val(data[0]['username_req']);
                $('#tel_edit').val(data[0]['tel']);
                $('#edit_modal').modal('show');

                element = ' (ไม่พบไฟล์)';
                if (data[0]['pdf_file'] != '') {
                    element = '<button class = "btn btn-danger btn-sm ml-2" value="' + data[0][
                        'idindex_number'
                    ] + '" onclick = "callpdf(' + "'" + data[0]['pdf_file'] + "'" + ')" type = "button"><i class="fas fa-file-pdf"></i></button>';
                } else {
                    $('#show_pdf').css('color', 'red')
                }
                $('#show_pdf').html(element);
            }
        });
    }
});

//  DELAY EVENT FUNCTION 
function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
            callback.apply(context, args);
        }, ms || 0);
    };
}

// DELETE FUNCTION
var deleted = function(id) {
        alertify.confirm("ท่านต้องการลบข้อมูลลำดับที่ : " + id,
            function() {
                $.ajax({
                    url: 'delete.php',
                    dataType: 'json',
                    type: "POST",
                    data: {
                        id: id,
                        table: 'index_number',
                    },
                    success: function(status) { // status :  1 = deleted  , 0 = can't delete
                        if (status == '1') {
                            sessionStorage.setItem('delete_status', "1");
                            window.location.reload();
                        } else {
                            sessionStorage.setItem('delete_status', "0");
                        }
                    }
                })
            },
            function() {
                alertify.error('ยกเลิก');
            }).set({
            title: "ยืนยันการลบข้อมูล ?"
        });
    }
    // DELETE FUNCTION ( END )


function edit(id) {
    $('#idindex_number_edit').val(id);

    // $.ajax({
    //         url: 'search.php',
    //         method: 'post',
    //         dataType: 'json',
    //         data: {
    //             topic: 'edit',
    //             idindex_number: idindex_number,
    //         },
    //         success: function(data) {
    //             console.log(data);
    //         }
    //     })
    // console.log(id);
}
// VIEW PDF FILE     
function callpdf(namefile) {
    if (namefile != '') {
        window.open('../uploads/pdf/' + namefile);
    } else {
        alertify.alert("file not uploaded.", function() {}).set({ title: "ไม่พบไฟล์ !" });
        window.location.href = '#'
    }
}
// POPUP STATUS AFTER ACTIVE EVENT
if (sessionStorage.getItem('delete_status') == '1') {
    sessionStorage.setItem('delete_status', "0");
    alertify.success('ลบข้อมูลเรียบร้อยแล้ว');
}
if (sessionStorage.getItem('add_order') == '1') {
    sessionStorage.setItem('add_order', "0");
    alertify.success('เพิ่มข้อมูลเรียบร้อยแล้ว');
}
if (sessionStorage.getItem('update_order') == '1') {
    sessionStorage.setItem('update_order', "0");
    alertify.success('อัพเดตข้อมูลเรียบร้อยแล้ว');
}


// ***************************************** FUNCTION UPLOAD FILE AND STATUS UPLOADING ******************************** 
function _(el) {
    return document.getElementById(el);
}

function uploadFile() {
    var file = _("pdf_file").files[0];
    var reName = _("idindex_number").value;
    var formdata = new FormData();
    formdata.append("pdf_file", file);
    formdata.append("reName", reName);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "file_upload_parser.php");
    ajax.send(formdata);
}

function uploadFileEdit() {
    var file = _("pdf_file_edit").files[0];
    var reName = _("idindex_number_edit").value;
    var formdata = new FormData();
    formdata.append("pdf_file_edit", file);
    formdata.append("reName", reName);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "file_upload_edit.php");
    ajax.send(formdata);
}

function progressHandler(event) {
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent) + "% uploading... please wait";
    _("progressBar_edit").value = Math.round(percent);
    _("status_edit").innerHTML = Math.round(percent) + "% uploading... please wait";
}

function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 100;
    _("status_edit").innerHTML = event.target.responseText;
    _("progressBar_edit").value = 100;
}

function errorHandler(event) {
    _("status").innerHTML = "Upload Failed";
    _("status_edit").innerHTML = "Upload Failed";
}

function abortHandler(event) {
    _("status").innerHTML = "Upload Aborted";
    _("status_edit").innerHTML = "Upload Aborted";
}
// ***************************************** FUNCTION UPLOAD FILE AND STATUS UPLOADING ( END ) ******************************** 

(function($) {
    $.fn.serializeAllArray = function() {
        var obj = {};

        $('input', this).each(function() {
            obj[this.name] = $(this).val();
        });
        return $.param(obj);
    }
})(jQuery);