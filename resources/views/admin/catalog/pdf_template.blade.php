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
    <style>
        .logo_wrapper::after {
            content: '';
            height: 100%;
            width: 100%;
            background-image: url('{{ asset($catalog_data->logo) }}');
            position: absolute;
            top: 0;
            left: 0;
            background-size: 100%;
            background-position: center;
            z-index: 0;
            opacity: 0.04;
        }
    </style>
</head>

<body>
    <!-- You can print if you see this pen in debug mode -->

    <!-- Page1 Start -->
    <div class="grid-container">
        <div class="logo_wrapper">
            <img src="{{ asset($catalog_data->logo) }}" alt="Logo">
        </div>
        <div class="footer">
            {{ $catalog_data->address }}&nbsp;&nbsp; <b>Mobile :</b>{{ $catalog_data->phonenumber }}
            &nbsp;&nbsp; <b>Email : </b>{{ $catalog_data->email }}
        </div>
    </div>
    <!-- Page1 End -->
    <!-- Page2 Start -->
    <div class="grid-container">
        <div class="header">
            <div class="logo"><img src="{{ asset($catalog_data->logo) }}" alt=""></div>
            <div class="add">
                <p>{{ $catalog_data->address }}</p>
            </div>
        </div>
        @foreach ($product_data as $category)
            <div class="product_title">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="product_wrapper">
                @foreach ($category->product as $product)
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
        @endforeach
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
