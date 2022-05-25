@extends('backend.master')
@section('title','Nhân viên')
@section('main')

    <div class="content">
        <div class="animated fadeIn">
            <form action="{{ route('nhan-vien.store') }}" method="post" class="form-horizontal"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Icon/Text</strong> Groups
                            </div>
                            <div class="card-body card-block">

                                @csrf
                                <div class="form-group"><label for="name" class=" form-control-label">Tên nhân viên</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group"><label for="email" class=" form-control-label">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="emzil" id="email" name="email" value="{{ old('email') }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group"><label for="phone" class=" form-control-label">Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="emzil" id="phone" name="phone" value="{{ old('phone') }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label class=" form-control-label">Trạng thái</label></div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="status" class="form-check-label mr-5">
                                                <input type="radio" id="status" name="status" value="1"
                                                    class="form-check-input" checked>Hiện
                                            </label>
                                            <label for="inline-radio2" class="form-check-label">
                                                <input type="radio" id="inline-radio2" name="status" value="0"
                                                    class="form-check-input">Ẩn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
                                <div class="form-group"><label for="address" class=" form-control-label">Địa chỉ</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group"><label for="job" class=" form-control-label">Công việc</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="job" name="job" value="{{ old('job') }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('job')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group"> <label for="" class="form-check-label mr-5"> Ảnh </label>
                                    <div class="small-12 medium-2 large-2 columns">
                                        <div class="circle">
                                            <img class="profile-pic"
                                                src="http://cdn.cutestpaw.com/wp-content/uploads/2012/07/l-Wittle-puppy-yawning.jpg">
                                        </div>
                                        <div class="p-image">
                                            <i class="fa fa-camera upload-button"></i>
                                            <input class="file-upload" type="file" accept="image/*" name="file" />
                                        </div>
                                    </div>
                                    @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop

@section('css')
    <style>
        .small-12 {
            position: relative;
        }

        .profile-pic {
            /* max-width: 200px; */
            max-height: 200px;
            display: block;
        }

        .file-upload {
            display: none;
        }

        .circle {
            /* border-radius: 1000px !important; */
            overflow: hidden;
            width: 150px;
            height: 150px;
            border: 8px solid rgba(235, 235, 235, 0.727);
            position: relative;
            /* top: 72px; */
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .p-image {
            position: absolute;
            bottom: 15px;
            left: 140px;
            color: #3d3d3d;
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }

        .p-image:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }

        .upload-button {
            font-size: 1.3em;
        }

        .upload-button:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
            color: #999;
        }

    </style>
@stop
@section('js')
<script src="{{ url('backend') }}/js/jquery-3.6.0.slim.js"></script>
    <script>
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
    <script src="{{ url('backend') }}/js/slug.js"></script>

@stop
