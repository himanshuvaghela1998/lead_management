<div class="row mt-4 load_image">
    @foreach ($lead_attachments as $item)
        <div class="col-12 col-md-2 pl-md-0  pic_{{$item->id}}_delete">
            <div class="avatar-delete image_trash" data-value="{{$item->id}}">
                <label for="imageDelete">
                    <i class="fa fa-trash"></i>
                </label>
            </div>
            <div class="avatar-preview">
                <div id="">
                    <img width="150" height="100" src="{{url($item->url)}}">
                </div>
            </div>
        </div>
    @endforeach
</div>
