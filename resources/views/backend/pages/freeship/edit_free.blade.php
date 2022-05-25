@extends('backend.master')
@section('title','Mã freeShip')
@section('main')
    <div class="content">
        <div class="animated fadeIn">
            <form action="{{ route('ma-free-ship.update', $freeShip->slug) }}" method="post" class="form-horizontal">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Icon/Text</strong> Groups
                            </div>
                            <div class="card-body card-block">

                                @csrf @method('PUT')
                                <input type="hidden" name='id' value="{{ $freeShip->id }}">
                                <div class="form-group"><label for="title" class=" form-control-label">Tên giảm giá</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="title" name="name" value="{{ $freeShip->name }}"
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
                                            value="{{ $freeShip->slug }}">
                                    </div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="quantity" class=" form-control-label">Số lượng mã freeship</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="number" id="quantity" name="quantity"
                                            class="form-control-success form-control" value="{{ $freeShip->quantity }}"
                                            min="1">
                                    </div>
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label class=" form-control-label">Trạng thái</label></div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="status" class="form-check-label mr-5">
                                                <input type="radio" id="status" name="status" value="1"
                                                    class="form-check-input"
                                                    {{ $freeShip->status == 1 ? ' checked' : '' }}>Hiện
                                            </label>
                                            <label for="inline-radio2" class="form-check-label">
                                                <input type="radio" id="inline-radio2" name="status" value="0"
                                                    class="form-check-input"
                                                    {{ $freeShip->status == 0 ? ' checked' : '' }}>Ẩn
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
                                <div class=" form-group"><label for="code" class=" form-control-label">Mã code freeship</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="code" name="code" class="form-control-success form-control"
                                            value="{{ $freeShip->code }}">
                                    </div>
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                    <div class=" form-group value_color"><label for="color" class=" form-control-label">Số
                                            tiền freeship (VND/$)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="number" id="color" class="form-control-success form-control"
                                                value="{{ $freeShip->discount }}">
                                        </div>
                                        @error('discount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class=" form-group"><label for="start_date" class=" form-control-label">Ngày bắt đầu</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="datetime-local" id="start_date" name="start_date"
                                            class="form-control-success form-control"
                                            value="{{ date('Y-m-d\TH:i', strtotime($freeShip->start_date)) }}">
                                    </div>
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="end_date" class=" form-control-label">Ngày kết thúc</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="datetime-local" id="end_date" name="end_date"
                                            class="form-control-success form-control"
                                            value="{{ date('Y-m-d\TH:i', strtotime($freeShip->end_date)) }}">
                                    </div>
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop
@section('js')
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="{{ url('backend') }}/js/slug.js"></script>
    <script>
        // $('#select_condition').val();
        if ($('#select_condition').val() == '0') {

            $('.value_size').show();
            $('#size').attr({
                name: 'discount'
            });
            $('.value_color').hide();
            $('#color').attr({
                name: ''
            });
        } else {
            $('.value_color').show();
            $('#size').attr({
                name: ''
            });
            $('.value_size').hide();
            $('#color').attr({
                name: 'discount'
            });
        }

        $('#select_condition').change(function(event) {
            var _iput = $('#select_condition').val();
            if (_iput == '0') {
                $('.value_size').show();
                $('#size').attr({
                    name: 'discount'
                });
                $('.value_color').hide();
                $('#color').attr({
                    name: ''
                });
            } else {
                $('.value_color').show();
                $('#size').attr({
                    name: ''
                });
                $('.value_size').hide();
                $('#color').attr({
                    name: 'discount'
                });
            }
        });
    </script>
@stop
