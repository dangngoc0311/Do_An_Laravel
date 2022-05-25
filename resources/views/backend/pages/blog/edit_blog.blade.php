@extends('backend.master')
@section('title','Blog')
@section('main')

    <div class="content">
        <div class="animated fadeIn">
            <form action="{{ route('bai-viet.update', $blog->slug) }}" method="post" class="horizontal"
                enctype="multipart/form-data">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Icon/Text</strong> Groups
                            </div>
                            <div class="card-body card-block">
                                <input type="hidden" name='id' value="{{ $blog->id }}">
                                @csrf @method('PUT')
                                <div class="form-group"><label for="title" class=" form-control-label">Tiêu đề bài viết
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="title" name="title" value="{{ $blog->title }}"
                                            class="form-control-success form-control" onkeyup="ChangeToSlug();">
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="slug" class=" form-control-label">Đường dẫn URL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="slug" name="slug" class="form-control-success form-control"
                                            value="{{ $blog->slug }}">
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group">
                                    <label for="select1" class=" form-control-label">Danh mục bài viết</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select name="category_blogs_id" id="select1" class="form-control">
                                            <option>----- Chọn danh mục bài viết -----</option>
                                            @foreach ($categoryBlog as $cates)
                                                <option value="{{ $cates->id }}"
                                                    {{$blog->category_blogs_id == $cates->id ? 'selected' : '' }}>
                                                    {{ $cates->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_blogs_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);"
                                            accept="image/*" name="file">
                                        <div class="drag-text">
                                            <h5>Drag and drop a file or select add Image</h5>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()"
                                                class="remove- btn btn-danger btn-sm">Remove <span
                                                    class="image-title">Uploaded
                                                    Image</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img src="{{ url('uploads') }}/{{ $blog->cover_image }}" alt="" srcset=""
                                        class="img-thumbnail w-25">
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label class=" form-control-label">Trạng thái</label></div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="status" class="form-check-label mr-5">
                                                <input type="radio" id="status" name="status" value="1"
                                                    class="form-check-input"
                                                    {{ $blog->status == 1 ? ' checked' : '' }}>Hiện
                                            </label>
                                            <label for="inline-radio2" class="form-check-label">
                                                <input type="radio" id="inline-radio2" name="status" value="0"
                                                    class="form-check-input"
                                                    {{ $blog->status == 0 ? ' checked' : '' }}>Ẩn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong> &nbsp;</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="content" class="form-control-label">Nội dung bài viết</label>
                                    <textarea name="content" id="content" rows="12" placeholder="Content..."
                                        class="form-control">{{ $blog->content }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('content', {
                                            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                                            filebrowserUploadMethod: 'form',
                                            filebrowserBrowseUrl: "{{ route('ckeditor.browse', ['_token' => csrf_token()]) }}"

                                        });
                                    </script>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div><!-- .animated -->
@stop
@section('js')
<script src="{{ url('backend') }}/js/jquery-3.6.0.slim.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });



        Resources
    </script>
    <script src="{{ url('backend') }}/js/slug.js"></script>
@stop
@section('css')
    <style>
        .file-upload {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
        }



        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #1FB264;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #1fb264a2;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h5 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 15px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 15px;
        }

    </style>
@stop
