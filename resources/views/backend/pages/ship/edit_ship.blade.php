@extends('backend.master')
@section('title','Phí vận chuyển')
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
                            <form class="form-horizontal" action="{{ route('ma-ship.update',$delivery->id) }}" method="post">
                                @csrf @method('PUT')
                                <input type="hidden" name='id' value="{{ $delivery->id}}">
                                <div class=" form-group">
                                    <label for="select" class=" form-control-label">Thành phố</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select name="tp_id" id="tp_id" class="form-control tp_id choose">
                                            <option>----- Chọn thành phố -----</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $delivery->tp_id == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('tp_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group">
                                    <label for="select" class=" form-control-label">Quận huyện</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select name="qh_id" id="qh_id" class="form-control qh_id choose">
                                            @foreach ($qh as $qhs)
                                                <option value="{{ $qhs->id }}"
                                                    {{ $delivery->qh_id == $qhs->id ? 'selected' : '' }}>
                                                    {{ $qhs->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('qh_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group">
                                    <label for="select" class=" form-control-label">Xã, thị trấn</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select name="xa_id" id="xa_id" class="form-control xa_id ">
                                            @foreach ($xa as $xaa)
                                                <option value="{{ $xaa->id }}"
                                                    {{ $delivery->xa_id == $xaa->id ? 'selected' : '' }}>
                                                    {{ $xaa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('xa_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group"><label for="price" class=" form-control-label">
                                        Giá ship</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="number" id="price" name="price" value="{{ $delivery->price }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script type="text/javascript">
        $('.choose').on('change', function(e) {
            e.preventDefault();
            var action = $(this).attr("id");
            var ma_id = $(this).val();
            var _token = $("input[name='_token']").val();
            var result = '';
            if (action == 'tp_id') {
                result = '#qh_id';
            } else if (action == 'qh_id') {
                result = '#xa_id';
            }
            $.ajax({
                url: "{{ route('admin.select.ship') }}",
                type: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    console.log(result);
                    $(result).html(data);
                }
            })
        });
    </script>
    <script src="{{ url('backend') }}/js/slug.js"></script>
@stop
