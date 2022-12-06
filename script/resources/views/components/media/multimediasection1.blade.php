 <a href="#" data-toggle="modal" data-target=".media-single" class="text-dark single-modal media_checkbox">
    <label for="category-image" class="custom-label text-center">
        <div>
            <img  height="100px" class="{{ $preview_class }}" src="{{ asset($preview) }}" alt="">
        </div>
        <span class="text-success">Upload </span> or a select image
    </label>
 </a>   
<div class="image-previewer-pane multi_images_preview_area">
     @foreach($value ?? [] as $key => $media)
     
     <div class="img-wrap gallery_image_area ml-1 mt-1 gallery{{ $key }}">
            <a href="javascript:void(0)" class="image_close" data-id="{{ $key }}"><span class="close " >&times;</span></a>
            <img alt="{{ $media }}" height="100" src="{{ asset($media) }}">
            <input type="hidden" value="{{ $media }}" name="multi_images[]">
          </div>
     @endforeach
 </div>
