<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .coupon {
            border: 3px dotted #bbb;
            width: 90%;
            border-radius: 12px;
            margin: 0 auto;
            max-width: 690px;
        }

        .container {
            padding: 8px 20px;
            background-color: #f1f1f1;
        }

        .promo {
            background: #ccc;
            padding: 3px;
        }

        .expire {
            color: red;
        }

    </style>
</head>

<body>

    <div class="coupon">
        <div class="container">
            <h5>Khuyến mãi từ shop <a target="_blank" style="color:red"
                    href="https://www.w3schools.com">ngoc123456789@gmail.com</a></h5>
        </div>
        <div class="container">
            <h5 class="note"><i></i></h5>
            <h5>Rất cảm ơn quý khách đã tin tưởng và lựa chọn sản phẩm Organic của chúng tôi. </>
                <p>Để tri ân những tình cảm của bạn, chúng tôi xin dành tặng bạn mã ưu đãi cho đơn hàng tiếp theo
                    tại tất cả các cơ sở .
                </p>
                <div class="container">
                    <p>Use Promo Code: <span class="promo">{{ $code }}</span></p>
                    <p class="expire">Start : {{ date('Y-m-d', strtotime($start)) }} - End : {{ date('Y-m-d', strtotime($end))}}</p>
                </div>
                <h5> Mời bạn click tại đây để nhận thêm mã và mua sắm cùng chúng tôi nhé!<a target="_blank"
                        href="https://www.w3schools.com" style="color: red"></a></h5>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
