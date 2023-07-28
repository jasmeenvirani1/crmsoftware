<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/catalog/style.css') }}" crossorigin>

    <title>Document</title>

</head>

<body>
    <!-- You can print if you see this pen in debug mode -->

    <!-- Page1 Start -->
    <div class="grid-container">
        <div class="logo_wrapper">
            <img src="{{ asset('images/logo.jpg') }}" alt="">
        </div>
        <div class="footer">
            A-405, PNTC (Prahlad Nagar Trade Center), Times of India Press
            Road, B/H Titanium City Center, Vejalpur, Ahmedabad - 380015, &nbsp;&nbsp; <b>Mobile :</b>7897897897
            &nbsp;&nbsp; <b>Email : </b> example@mail.com
        </div>
    </div>
    <!-- Page1 End -->
    <!-- Page2 Start -->
    <div class="grid-container">
        <div class="header">
            <div class="logo"><img src="{{ asset('images/logo.jpg') }}" alt=""></div>
            <div class="add">
                <p>A-405, PNTC (Prahlad Nagar Trade Center), Times of India Press
                    Road, B/H Titanium City Center, Vejalpur, Ahmedabad - 380015</p>
            </div>
        </div>
        <div class="product_title">
            <h2>Products</h2>
        </div>
        <div class="product_wrapper">
            @foreach ($product_data as $product)
                <div class="product_box">
                    <div class="pro_img">
                        @if (isset($product->productImages[0]))
                            <img src="{{ asset($product->productImages[0]->name) }}" alt="">
                        @else
                            <img src="{{ asset('images/product1.jpg') }}" alt="">
                        @endif
                    </div>
                    <div class="content">
                        <div class="name">{{ $product->product_name }}</div>
                        <div class="desc">{{ $product->specification }}</div>
                        <div class="desc">{{ $product->notes }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Page2 End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
</body>

</html>
