@extends('frontend.master')
@section('main')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img src="{{ url('frontend') }}/images/cart-page-banner.jpg" alt="banner" class="banner">
    </section>
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="index.html">Home</a></li>
                    <li>Shoping Cart</li>
                </ul>
                <h1 class="page-tit">Shoping Cart</h1>
            </div>
        </div>

    </section>
    <!-- ============ Sub-Banner-End =============== -->
    <div class="content-part  whishlist-page">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-responsive wow fadeInUp">
                    <thead>
                        <tr>
                            <th class="product">PRODUCT</th>
                            <th class="name">Name & Description</th>
                            <th class="price">Price</th>
                            <th class="quantity">product status</th>
                            <th class="total">add to cart</th>
                            <th class="cancle">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="success">
                        @foreach ($wishlist as $wh)
                            <tr id="{{ $wh->id }}">
                                <td class="cart-image-wrapper">
                                    <a href="#"><img class="cart-image"
                                            src="{{ url('uploads/product') }}/{{ $wh->getProducts->image }}" alt=""
                                            style="width:100px"></a>
                                </td>
                                <td class="product-tit"><a href="#">{{ $wh->getProducts->name }}</a></td>
                                <td class="price"><span
                                        class="money">{{ "$ " . number_format($wh->getProducts->price, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    In stock
                                </td>
                                <td class="total">
                                    <form action="">
                                        <button class="add-to-cart custom-btn btn-1">Add to cart</button>
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $wh->getProducts->id }}"><input
                                            type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="wishlist_id" value="{{ $wh->id }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ Auth::guard('customer')->user()->id }}">
                                    </form>
                                </td>
                                <td class="cancle"><a href="{{ route('san-pham-yeu-thich.destroy', $wh->id) }}"
                                        class="deleteRecord" data-id="{{ $wh->id }}"><i
                                            class="icon-cancel-music"></i></a></td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ url('frontend') }}/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deleteRecord').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
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
                        $.ajax({
                            type: "GET",
                            url: "{{ route('getTotalWishlist') }}",
                            data: {},
                            success: function(data) {
                                console.log(data);
                                $("#wishlistTotal").html(data);
                            },
                            error: function(res) {
                                console.log(res);
                            }
                        })
                    }
                })
            });
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                var product_id = $("input[name='product_id']").val();
                var id = $("input[name='wishlist_id']").val();
                var quantity = $("input[name='quantity']").val();
                var user_id = $("input[name='user_id']").val();
                var token = $("meta[name='csrf-token']").attr("content");
                var url = "{{ route('gio-hang.store') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "wishlist_id": id,
                        "product_id": product_id,
                        "user_id": user_id,
                        "_token": token,
                        "quantity":quantity
                    },
                    success: function(response) {
                        $("#" + id + "").remove();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Sản phẩm đã được thêm vào danh sách yêu thích'
                        });

                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('getTotalWishlist') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#wishlistTotal").html(data);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
            })
        });
    </script>
@stop
