<div class="row my-4 load_image">
    @foreach ($lead_attachments as $item)
        <div class="col-12 col-md-2 d-flex pic_{{$item->id}}_delete">
            <div class="avatar-preview">
                <img width="140" height="100" src="{{url($item->url)}}">
            </div>
            <div class="image_trash" data-value="{{$item->id}}">
                <label for="imageDelete">
                    <i class="fa fa-trash avatar-delete"></i>
                </label>
            </div>
        </div>
    @endforeach
</div>
