@foreach ($cart as $ct)
<div class="box">
    <div class="img-part"> <img
            src="{{ url('uploads/product') }}/{{ $ct->getProducts->image }}"
            alt="product" class="img-responsive" style='width:80px'> </div>
    <div class="text-part">
        <p><a class="product-name"> {{ $ct->getProducts->name }}</a></p>
    </div>
    <div class="text-part">
        <p>
        <div class="quantity-and-price">
            {{ $ct->quantity }} x
            {{  number_format($ct->getProducts->sale_price > 0 ? $ct->getProducts->sale_price : $ct->getProducts->price , 0, ',', '.') .'VND' }}
        </div>
        </p>
    </div>

</div>
@endforeach
