<div class="container-fluid">
    <!-- The Modal For Add -->
    <div class="modal fade" id="add_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มรายการ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="statusMsg"></div>
                <form action="" id="form_add" method="post" class="pure-form">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="idindex_number">
                                    เลขลำดับ
                                </label>
                                <input type="text" class="form-control form-control-sm" id="idindex_number"
                                    name="idindex_number" placeholder="เลขลำดับ..." readonly="readonly" />
                            </div>
                            <div class="col-md-4">
                                <label for="index_number">
                                    เลขหนังสือ
                                </label>
                                <input type="text" class="form-control form-control-sm" id="index_number"
                                    name="index_number" placeholder="เลขหนังสือ..." />
                            </div>
                            <div class="col-md-4">
                                <label for="in_type">
                                    ประเภท
                                </label>
                                <select name="in_type" id="in_type" class="form-control form-control-sm" required>
                                    <option value="1">ภายใน</option>
                                    <option value="2">ภายนอก</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mt-2">
                            <div class="col-md-12">
                                <label for="in_to">เรียน</label>
                                <input type="text" id="in_to" name="in_to" class="form-control form-control-sm"
                                    placeholder="เรียน ... " required />
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <label for="in_sub">
                                    เรื่อง
                                </label>
                                <input type="text" class="form-control form-control-sm" id="in_sub" name="in_sub"
                                    placeholder="เรื่อง..." required />
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <label for="username_req">ชื่อผู้ขอเลข</label>
                                <input type="text" id="username_req" name="username_req"
                                    class="form-control form-control-sm" placeholder="ชื่อผู้ขอเลข ..." required />
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-8">
                                <label for="appm_section_id">หน่วยงาน</label>
                                <select type="text" id="appm_section_id" name="appm_section_id"
                                    class="form-control form-control-sm" placeholder="หน่วยงาน" required>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tel">เบอร์โทร (xxxx)</label>
                                <input type="text" id="tel" maxlength="4" minlength="4" name="tel"
                                    class="form-control form-control-sm" placeholder="เบอร์โทร ..." required>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <label for="pdf_file">อัพโหลด pdf file</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pdf_file">
                                    <label class="custom-file-label" for="pdf_file" id="name_file">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <progress id="progressBar" value="0" max="100" style="width:100%"></progress>
                            </div>
                        </div>
                        <div class="form-row mt-1">
                            <div class="col-md-12">
                                <p id="status" class="success"></p>
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