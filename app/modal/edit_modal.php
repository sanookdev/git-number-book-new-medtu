<div class="container-fluid">
    <!-- The Modal For Add -->
    <div class="modal fade" id="edit_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขรายการ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="statusMsg"></div>
                <form action="" id="form_edit" method="post" class="pure-form">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="date_inbook">วันรับเอกสาร</label>
                                <input type="date" id="date_inbook_edit" name="date_inbook_edit"
                                    class="form-control form-control-sm" />
                            </div>
                            <div class="col-md-6">
                                <label for="date_number">วันออกเลขหนังสือ</label>
                                <input type="date" id="date_number_edit" name="date_number_edit"
                                    class="form-control form-control-sm" />
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md-4">
                                <label for="idindex_number_edit">
                                    เลขลำดับ
                                </label>
                                <input type="text" class="form-control form-control-sm" id="idindex_number_edit"
                                    name="idindex_number_edit" placeholder="เลขลำดับ..." readonly="readonly" />
                            </div>
                            <div class="col-md-4">
                                <label for="index_number_edit">
                                    เลขหนังสือ
                                </label>
                                <input type="text" class="form-control form-control-sm" id="index_number_edit"
                                    name="index_number_edit" placeholder="เลขหนังสือ..." />
                            </div>
                            <div class="col-md-4">
                                <label for="in_type_edit">
                                    ประเภท
                                </label>
                                <select name="in_type_edit" id="in_type_edit" class="form-control form-control-sm"
                                    required>
                                    <option value="1">ภายใน</option>
                                    <option value="2">ภายนอก</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mt-2">
                            <div class="col-md-12">
                                <label for="in_to_edit">เรียน</label>
                                <input type="text" id="in_to_edit" name="in_to_edit"
                                    class="form-control form-control-sm" placeholder="เรียน ... " required />
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <label for="in_sub_edit">
                                    เรื่อง
                                </label>
                                <input type="text" class="form-control form-control-sm" id="in_sub_edit"
                                    name="in_sub_edit" placeholder="เรื่อง..." required />
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <label for="username_req_edit">ชื่อผู้ขอเลข</label>
                                <input type="text" id="username_req_edit" name="username_req_edit"
                                    class="form-control form-control-sm" placeholder="ชื่อผู้ขอเลข ..." required />
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-8">
                                <label for="appm_section_id_edit">หน่วยงาน</label>
                                <select type="text" id="appm_section_id_edit" name="appm_section_id_edit"
                                    class="form-control form-control-sm" placeholder="หน่วยงาน" required>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tel_edit">เบอร์โทร (xxxx)</label>
                                <input type="text" id="tel_edit" maxlength="4" minlength="4" name="tel_edit"
                                    class="form-control form-control-sm" placeholder="เบอร์โทร ..." required>
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="col-md-12">
                                <label for="pdf_file_edit">อัพโหลด pdf file</label>
                                <span id="show_pdf"></span>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pdf_file_edit">
                                    <label class="custom-file-label" for="pdf_file_edit" id="pdf_file_edit">Choose
                                        file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <progress id="progressBar_edit" value="0" max="100" style="width:100%"></progress>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-12">
                                <p id="status_edit" class="success"></p>
                                <!-- <p id="loaded_n_total"></p> -->
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-success btn-block btn-sm btn_submit col-md-12">Submit</button>
                    </div>
                </form>
                <!-- <button class="btn btn-outline-info btn-sm btn_check">Check Val</button> -->
            </div>
        </div>
    </div>
</div>