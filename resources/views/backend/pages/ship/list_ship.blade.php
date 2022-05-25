@extends('backend.master')
@section('title','Phí vận chuyển')
@section('main')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <form action="">
                                            @csrf
                                            <select name="sort" id="sort" class="form-control"
                                                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                <option value="?sort_by=none">Sắp xếp theo</option>

                                                <option value="?sort_by=price_asc">Giá tăng dần</option>
                                                <option value="?sort_by=price_desc">Giá giảm dần</option>

                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>

                            </div>
                            <table id="bootstrap-data-table " class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Tên thành phố</th>
                                        <th>Tên quận huyện</th>
                                        <th>Tên xã, thị trấn</th>
                                        <th>Tiền ship</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cate">
                                    @foreach ($ship as $value)
                                        <tr id="{{ $value->id }}">
                                            <td>{{ $value->getCity->name }}</td>
                                            <td>{{ $value->getProvince->name }}</td>
                                            <td>{{ $value->getCommune->name }}</td>
                                            <td>{{ $value->price }}</td>
                                            <td>
                                                <a href="{{ route('ma-ship.edit', $value->id) }}" class="btn">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a class="deleteRecord" href="{{ route('ma-ship.destroy', $value->id) }}"
                                                    data-id="{{ $value->id }}" data-slug="{{ $value->slug }}">
                                                    <span>
                                                        <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12 d-flex">
                                <div class="col-sm-6 col-xs-12">
                                    <a href="{{ route('ma-ship.create') }}" class="btn btn-outline-success">Thêm mới
                                        </a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! $ship->appends(\Request::except('page'))->render() !!}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div>
@stop

@section('js')


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.deleteRecord').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var slug = $(this).data("slug");
                var token = $("meta[name='csrf-token']").attr("content");
                var url = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "slug": slug,
                                "_token": token,
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                $("#" + id + "").remove();
                            }
                        });
                    }
                })
            });
        })
        $('#product').change(function() {
            var data = $(this).children('option:selected').data('key');
            var sort = $(this).children('option:selected').data('sort');
            var url = '{{ route('sort') }}';
            // alert(url);
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                data: {
                    data1: data,
                    sort1: sort
                },
                success: function(response) {
                    // var html = '';
                    // var myTable = document.querySelector('#cate');
                    // for (i = 0; i < response.length; i++) {

                    //     html += `<tr>
                //         <td>  ${response[i].name}</td>
                //         <td> ${response[i].slug}</td>

                //         <td><a href="/admin/danh-muc/${response[i].slug}/edit" class="btn"><span><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i></span></a>
                //         <a><span><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></span></a></td>
                //         </tr>`;
                    // }
                    // myTable.innerHTML = html;
                    $("#cate").show(response)
                }
            });
        });

        function addTodo() {
            var tp_id = $('.tp_id').val();
            var qh_id = $('.qh_id').val();
            var xa_id = $('.xa_id').val();
            var _token = $("input[name='_token']").val();
            var price = $("input[name='price']").val();


            $.ajax({
                url: "{{ route('ma-ship.store') }}",
                type: "POST",
                data: {
                    tp_id: tp_id,
                    qh_id: qh_id,
                    xa_id: xa_id,
                    price: price,
                    _token: _token
                },
                success: function(data) {
                    todo = data
                    $('table tbody').append(`
                        <tr id="${todo.id}">
                            <td>${todo.tp_id}</td>
                            <td>${ todo.qh_id }</td>
                            <td>${ todo.xa_id}
                                <td>${todo.price}</td>
                            <td>
                                <a data-id="${ todo.id }" onclick="editTodo(${todo.id})" class="btn "> <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a></a>
                                <a data-id="${todo.id}" class="deleteRecord" onclick="deleteTodo(${todo.id})"> <span>
                                                        <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                                    </span></a>
                            </td>
                        </tr>
                    `);
                    $('.tp_id').val('');
                    $('.qh_id').val('');
                    $('.xa_id').val('');

                    $("input[name='_token']").val('');
                    $("input[name='price']").val('');

                    $('#addTodoModal').modal('hide');
                },
                error: function(response) {
                    $('#taskError').text(response.responseJSON.errors.todo);
                }
            });
        }
    </script>
@stop
