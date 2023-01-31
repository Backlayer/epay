<div class="modal fade" id="modal-upload-file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title">@lang('Upload Invoice')</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.transactions.upload.file') }}" method="post" enctype="multipart/form-data">
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
                        <div class="col-lg-12">
                            <a href="" id="link_file" target="_blank">@lang('View Document')</a>
                        </div>
                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary btn-block basicbtn">@lang('Upload')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ asset('admin/custom/form.js') }}"></script>
    <script>
        $('.view-invoice-file').on('click', function() {
            const modal = $('#modal-upload-file')

            modal.find('#id').val($(this).attr('data-idtx'))
            modal.find('#type').val($(this).attr('data-typetx'))
            modal.find('#link_file').prop('href', $(this).attr('data-linkfiletx'))

            if ($(this).attr('data-linkfiletx')) {
                modal.find('#link_file').removeClass('d-none')
            } else {
                modal.find('#link_file').addClass('d-none')
            }

            modal.modal()
        })
    </script>
@endpush
