@extends('backend.master')
@section('title','Trả lời contact')
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
                                        <select name="sort" id="product" class="float-right form-control">
                                            <option value="none">Relevance</option>
                                            <option value="name_asc" data-key="name" data-sort="asc">Name (A - Z)</option>
                                            <option value="name_desc" data-key="name" data-sort="desc">Name (Z - A)</option>
                                            < </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <form action="" method="GET">
                                        <div class=" form-group">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                </div>
                                                <input type="search" id="input1-group2 search" placeholder="Username"
                                                    class="form-control search" name="keyword"><button
                                                    class="btn btn-outline-success">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table id="bootstrap-data-table " class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Tên </th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="cate">
                                    @foreach ($contact as $value)
                                        <tr id="{{ $value->id }}">
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                <a href="{{ route('phan-hoi-contact.show', $value->id) }}" class="btn">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12">
                                {!! $contact->appends(\Request::except('page'))->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop

@section('js')


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

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
    </script>
@stop
