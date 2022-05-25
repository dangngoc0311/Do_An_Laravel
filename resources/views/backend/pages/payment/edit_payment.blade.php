@extends('backend.master')
@section('title','Phương thức thanh toán')
@section('main')

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Icon/Text</strong> Groups
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('phuong-thuc-thanh-toan.update', $payment->slug) }}" method="post"
                                class="form-horizontal">
                                @csrf @method('PUT')
                                <input type="hidden" name='id' value="{{ $payment->id }}">
                                <div class="form-group"><label for="title" class=" form-control-label">Tên danh mục</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="title" name="name" value="{{ $payment->name }}"
                                            class="form-control-success form-control" onkeyup="ChangeToSlug();">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="slug" class=" form-control-label">Đường dẫn URL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="slug" name="slug" value="{{ $payment->slug }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2"><label class=" form-control-label">Status</label></div>
                                    <div class="col col-md-10">
                                        <div class="form-check-inline form-check">
                                            <label for="status" class="form-check-label mr-5">
                                                <input type="radio" id="status" name="status" value="1"
                                                    {{ $payment->status == 1 ? ' checked' : '' }}
                                                    class="form-check-input">Hiện
                                            </label>
                                            <label for="inline-radio2" class="form-check-label">
                                                <input type="radio" id="inline-radio2" name="status" value="0"
                                                    {{ $payment->status == 0 ? ' checked' : '' }}
                                                    class="form-check-input">Ẩn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body card-block">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop
@section('js')

    <script src="{{ url('backend') }}/js/slug.js"></script>
@stop
