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

    {{-- <link rel="stylesheet" href="{{ asset('css/print-styles.css') }}" media="print"> --}}

    <title>Document</title>
    <style>
        @media print {
            @page {
                margin: 0;
                size: A4;
            }

            * {
                -webkit-print-color-adjust: exact;
            }
        }

        * {
            font-family: "poppins", sans-serif !important;
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            background: #fff;
            font-size: 14px;
            font-family: "poppins", sans-serif !important;
        }

        .toCenter {
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .grid-container {
            margin: auto;
            width: 210mm;
            height: 297mm;
            overflow: hidden;
            /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7); */
            border: 1px solid #ebebeb;
            padding: 30px;
            position: relative;
        }

        .print_table table {
            border: 0px solid #000;
            border-left: 1px solid #000;
            border-top: 1px solid #000;
            width: 100%;
            border-spacing: 0;
        }

        .print_table table tr th {
            background-color: #b1a0c7;
            height: 35px;
            width: max-content;
        }

        .print_table table tr td,
        .print_table table tr th {
            padding: 5px;
            white-space: normal;
            line-break: anywhere;
            text-align: left;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .print_table table tr td {
            height: 28px;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            background-color: transparent;
            text-align: center;
            padding: 0px;
        }

        .logo_wrapper {
            height: calc(100vh - 41px);
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .logo_wrapper img {
            position: relative;
            z-index: 1;
        }

        .logo_wrapper::after {
            content: '';
            height: 100%;
            width: 100%;
            background-image: url(./logo.jpg);
            position: absolute;
            top: 0;
            left: 0;
            background-size: 100%;
            background-position: center;
            z-index: 0;
            opacity: 0.04;
        }

        .product_wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }

        .product_box {
            width: calc(33% - 5px);
            margin-bottom: 10px;
            border-radius: 5px;
            overflow: hidden;
            background-color: #fbfbfb;
            border: 1px solid #e7e7e7;
        }

        .pro_img {
            height: 130px;
            width: 100%;
        }

        .pro_img img {
            width: 218px;
            height: 100%;
            object-fit: cover;
        }

        .content {
            padding: 10px;
        }

        .content .name {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .content .desc {
            font-size: 12px;
            margin-top: 5px;
        }

        .header {
            width: 100%;
            /* display: flex; */
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 30px;
            padding-bottom: 99px;
            /* position: absolute; */
        }

        .header .logo {
            width: 200px;
            position: absolute;
        }

        .header .logo img {
            width: 100%;
        }

        .header .add {
            width: 50%;
            position: absolute;
            margin-left: 387px;
        }

        .product_title {
            margin-bottom: 15px;
            margin-top: 30px;
        }

        .product_title h2 {
            font-weight: 500;
            font-size: 24px;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- You can print if you see this pen in debug mode -->

    <!-- Page1 Start -->
    <div
        class=""style="margin: auto;width: 210mm;height: 297mm;overflow: hidden;/* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7); */border: 1px solid #ebebeb;padding: 30px;position: relative;">
        <div
            class=""style="width: 100%;/* display: flex; */justify-content: center;align-items: center;position: relative;/* display: inline-block; */position: absolute;justify-content: center;align-items: center;position: relative;);position: absolute;top: 16%;left: 16%;/* transform: translate(-50%, -50%); */">
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($catalog_data->logo))) }}"
                alt="Logo">
        </div>
        <div class=""
            style=" position: absolute; bottom: 66px;left: 30px;right: 30px;background-color: transparent;text-align: center;padding: 5px;">
            {{ $catalog_data->address }}&nbsp;&nbsp; <b>Mobile :</b>{{ $catalog_data->phonenumber }}
            &nbsp;&nbsp; <b>Email : </b>{{ $catalog_data->email }}
        </div>
    </div>
    <!-- Page1 End -->
    <!-- Page2 Start -->
    <div
        class=""style="margin: auto;width: 210mm;height: 297mm;overflow: hidden;/* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7); */border: 1px solid #ebebeb;padding: 30px;position: relative;">
        <div
            class=""style="width: 100%;/* display: flex; */justify-content: space-between;align-items: center;border-bottom: 1px solid #e7e7e7;margin-bottom: 30px;padding-bottom: 99px;/* position: absolute; */">
            <div class=""style="width: 200px;/* position: absolute; */">
                <img style=" width: 208px;position: absolute;"
                    src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($catalog_data->logo))) }}"
                    alt="Logo">

                <div class=""style="width: 50%;position: absolute;margin-left: 387px;">
                    <p style="width: 80%;">{{ $catalog_data->address }}</p>
                </div>
            </div>
        </div>

        @forelse ($product_data as $category)
            <div class="product_title" @if ($loop->first) style="margin-top: 113px;" @endif>
                <h2>{{ $category->name }}</h2>
            </div>
            <div style="width: 100%;">
                @forelse ($category->productIds as $product)
                    @if (!isset($product->product))
                        @continue
                    @endif
                    <div
                        style="width: 220px; margin: 0 10px 10px 0; border-radius: 5px; overflow: hidden; background-color: #fbfbfb; border: 1px solid #e7e7e7; display: inline-block;">
                        <div class="pro_img">
                            {{-- @php
                                prx($product->product->productImages[0]->name);
                            @endphp --}}
                            @if (isset($product->product->productImages[0]))
                                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($product->product->productImages[0]->name))) }}"
                                    alt="Logo">
                            @else
                                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/product1.jpg'))) }}"
                                    alt="Logo">
                            @endif
                        </div>
                        <div class="content">
                            <div class="name">{{ $product->product->product_name }}</div>
                            <div class="desc">{{ $product->product->specification }}</div>
                            <div class="desc">{{ $product->product->notes }}</div>
                        </div>
                    </div>
                @empty
                @endforelse
            @empty
        @endforelse
    </div>

    </div>
    <!-- Page2 End -->
</body>

</html>