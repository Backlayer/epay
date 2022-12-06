<h5> <a href="#" data-toggle="modal" data-target=".media-single" class="text-dark single-modal media_radio" data-inputid="{{ $input_id }}" data-previewclass="{{ $preview_class }}">{{ $title }}</a></h5>
<hr>
<a href="#" data-toggle="modal" data-target=".media-single" class="text-dark single-modal media_radio" data-inputid="{{ $input_id }}" data-previewclass="{{ $preview_class }}">
    <img  height="100" class="{{ $preview_class }}" src="{{ asset(empty($preview) ? 'admin/img/img/placeholder.png' : $preview) }}" alt="">
    <input type="hidden" name="{{ $input_name }}"  id="{{ $input_id }}" value="{{ $value }}">
</a>
