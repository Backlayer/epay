<a href="#" data-toggle="modal" data-target=".media-single" class="text-dark single-modal media_radio" data-inputid="{{ $input_id }}" data-previewclass="{{ $preview_class }}">
    <label for="category-image" class="custom-label text-center">
        <div>
            <img height="100px" class="{{ $preview_class }}" src="{{ asset(empty($preview) ? 'admin/img/img/placeholder.png' : $preview) }}" alt="">
        </div>
        <span class="text-success">Upload </span> or a select image
    </label>
    <div class="image-previewer-pane">
        <input type="hidden" name="{{ $input_name }}"  id="{{ $input_id }}" value="{{ $value }}">
    </div>
</a>
