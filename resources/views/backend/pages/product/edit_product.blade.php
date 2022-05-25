@extends('backend.master')
@section('title', 'Sản phẩm')
@section('main')

    <div class="content">
        <div class="animated fadeIn">
            <form action="{{ route('san-pham.update', $product->slug) }}" method="post" class="horizontal"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Icon/Text</strong> Groups
                            </div>
                            <div class="card-body card-block">
                                @csrf @method('PUT')
                                <input type="hidden" name='id' value="{{ $product->id }}">
                                <div class="form-group"><label for="title" class=" form-control-label">Tên sản phẩm</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="title" name="name" value="{{ $product->name }}"
                                            class="form-control-success form-control" onkeyup="ChangeToSlug();">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="slug" class=" form-control-label">Đường dẫn URL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="slug" name="slug" class="form-control-success form-control"
                                            value="{{ $product->slug }}">
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group">
                                    <label for="select" class=" form-control-label">Danh mục sản phẩm</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select name="category_id" id="select" class="form-control">
                                            <option value="0">----- Chọn danh mục sản phẩm -----</option>
                                            @foreach ($category as $cate)
                                                <option value="{{ $cate->id }}"
                                                    {{ $product->category_id == $cate->id ? ' selected' : '' }}>
                                                    {{ $cate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group">
                                    <label for="select1" class=" form-control-label">Nhà cung cấp sản phẩm</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select name="brand_id" id="select1" class="form-control">
                                            <option value="0">----- Chọn nhà cung cấp sản phẩm -----</option>
                                            @foreach ($brand as $brands)
                                                <option value="{{ $brands->id }}"
                                                    {{ $product->brand_id == $brands->id ? ' selected' : '' }}>
                                                    {{ $brands->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('brand_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group"><label for="import_quantity" class=" form-control-label">Số lượng
                                        sản phẩm nhập kho</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="number" id="import_quantity" name="import_quantity"
                                            value="{{ $product->import_quantity }}"
                                            class="form-control-success form-control" min="1">
                                    </div>
                                    @error('import_quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group"><label for="price" class=" form-control-label">Gía sản phẩm</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="number" id="price" name="price" value="{{ $product->price }}"
                                            class="form-control-success form-control" min="1">
                                    </div>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Mô tả sản phẩm</label>
                                    <textarea name="description" value="{{ $product->description }}" id="description"
                                        rows="12" placeholder="Content..."
                                        class="form-control">{{ $product->description }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('description');
                                    </script>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4"><label class=" form-control-label">Status</label></div>
                                    <div class="col col-md-8">
                                        <div class="form-check-inline form-check">
                                            <label for="status" class="form-check-label mr-5">
                                                <input type="radio" id="status" name="status" value="1"
                                                    {{ $product->status == 1 ? ' checked' : '' }}
                                                    class="form-check-input">Hiện
                                            </label>
                                            <label for="inline-radio2" class="form-check-label">
                                                <input type="radio" id="inline-radio2" name="status" value="0"
                                                    {{ $product->status == 0 ? ' checked' : '' }}
                                                    class="form-check-input">Ẩn
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
                                <div class="row form-group">
                                    <div class="col col-md-4"><label class=" form-control-label">Sản phẩm nổi bật</label>
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="form-check-inline form-check">
                                            <label for="status3" class="form-check-label mr-5">
                                                <input type="radio" id="status3" name="isHot" value="1"
                                                    {{ $product->isHot == 1 ? 'checked' : '' }}
                                                    class="form-check-input">Nổi bật
                                            </label>
                                            <label for="status4" class="form-check-label">
                                                <input type="radio" id="status4" name="isHot" value="0"
                                                    class="form-check-input"
                                                    {{ $product->isHot == 0 ? 'checked' : '' }}>Bình thường
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="sale_price" class=" form-control-label">Giá khuyến
                                        mãi</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="number" id="sale_price" name="sale_price"
                                            value="{{ $product->sale_price }}" class="form-control-success form-control">
                                    </div>
                                    @error('sale_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);"
                                            accept="image/*" name="file">
                                        <div class="drag-text">
                                            <h5>Drag and drop a file or select add Image</h5>
                                        </div>
                                    </div>
                                    @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    <img src="{{ url('uploads') }}/{{ $product->image }}" alt="" srcset=""
                                        class="img-thumbnail w-25">
                                </div>
                                <div class="field" align="left">
                                    <input type="file" id="files" name="files[]" multiple />
                                </div>
                                @error('files')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    @foreach ($product->getImageProduct as $img)
                                        <img src="{{ url('uploads') }}/{{ $img->image }}" alt="" srcset=""
                                            class="img-thumbnail w-25">
                                    @endforeach
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

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class=\"menu-icon fa fa-cogs\"></i></span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>

    <script src="{{ url('backend') }}/js/slug.js"></script>
@stop
@section('css')
    <style>
        input[type="file"] {
            display: block;
        }

        input#files {
            display: inline-block;
            width: 100%;
            padding: 70px 0 0 0;
            height: 60px;
            overflow: hidden;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            background: url('https://cdn1.iconfinder.com/data/icons/hawcons/32/698394-icon-130-cloud-upload-512.png') center center no-repeat #e4e4e4;
            border-radius: 20px;
            background-size: 60px 60px;
        }

        .imageThumb {
            width: 100px;
            border: 1px solid;
            padding: 1px;
            cursor: pointer;
            /* position: absolute; */
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
            position: relative;
        }

        .remove {
            opacity: 0;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .pip:hover .remove {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
            opacity: 1;
        }

        .remove:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }

        /* .remove:hover {
                                    background: white;
                                    color: black;
                                } */


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
