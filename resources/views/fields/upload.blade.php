<div class="row photo-upload-holder">
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100" style="min-height: 200px">
            <div class="card-body d-flex justify-content-center">
                <label class="btn btn-outline-primary photo-upload-label align-self-center" for="{{'upload_'.$name}}"><i class="fa fa-file"></i>  @lang('choose file')
                    <input name="{{$name}}" type="file" id="{{'upload_'.$name}}" accept="image/*" onchange="readURL(this);">
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100 photo-upload-preview"  style="background-image: url({{$value ?? 'http://placehold.it/180'}})">
        </div>
    </div>
</div>



@push('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).closest('.photo-upload-holder')
                        .find('.photo-upload-preview')
                        .css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
@push('style')
    <style>
        img{
            max-width:180px;
        }
        .photo-upload-label {
            cursor: pointer;
        }
        .photo-upload-label input[type=file]{
            position: absolute;
            bottom: -100px;
            visibility: hidden;
        }
        .photo-upload-preview {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>

@endpush