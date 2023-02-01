<div class="modal fade" id="modal-upload-file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title">@lang('Edit Invoice')</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="actions-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="upload-tab" data-toggle="pill" href="#upload" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @lang('Upload Invoice')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="change-num-tab" data-toggle="pill" href="#change-num" role="tab"
                            aria-controls="pills-profile" aria-selected="false">
                            @lang('Change Invoice No')
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="actions-tabContent">
                    <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        <form action="{{ route('user.transactions.upload.file') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="type" id="type">
                            <input type="hidden" name="id" id="id">

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="file" name="invoice_file" id="invoice_file"
                                        class="form-control focus-input100" accept=".jpg,.jpeg,.png,.pdf" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <a href="" id="link_file" target="_blank">@lang('View Document')</a>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="btn-upload" class="btn btn-primary btn-block basicbtn">
                                    @lang('Upload')
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="change-num" role="tabpanel" aria-labelledby="change-num-tab">
                        <form action="{{ route('user.transactions.update.invoice-num') }}" method="post">
                            @csrf

                            <input type="hidden" name="type" id="type">
                            <input type="hidden" name="id" id="id">

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="invoice_num" id="invoice_num"
                                        class="form-control focus-input100" required />
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="btn-change-num" class="btn btn-primary btn-block basicbtn">
                                    @lang('Save Changes')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            const modal = $('#modal-upload-file')
            const formUpload = modal.find('#upload form')
            const formNum = modal.find('#change-num form')

            $('.view-invoice-file').on('click', function() {
                const id = $(this).attr('data-idtx')
                const type = $(this).attr('data-typetx')
                const linkfile = $(this).attr('data-linkfiletx')
                const num = $(this).attr('data-numtx')

                formUpload.find('#id').val(id)
                formUpload.find('#type').val(type)
                formUpload.find('#link_file').prop('href', linkfile)
                formUpload.find('#btn-upload').prop('disabled', true)

                formNum.find('#id').val(id)
                formNum.find('#type').val(type)
                formNum.find('#invoice_num').val(num)

                if (linkfile) {
                    formUpload.find('#link_file').removeClass('d-none')
                } else {
                    formUpload.find('#link_file').addClass('d-none')
                }

                modal.modal()
            })

            formUpload.find('#invoice_file').on('change', function() {
                modal.find('#btn-upload').prop('disabled', !$(this).val())
            })

            formUpload.find('#btn-upload').on('click', function() {
                setTimeout(() => {
                    $(this).prop('disabled', true)
                }, 100)
            })

            formNum.find('#invoice_num').on('input', function() {
                modal.find('#btn-change-num').prop('disabled', !$(this).val())
            })
        })
    </script>
@endpush
