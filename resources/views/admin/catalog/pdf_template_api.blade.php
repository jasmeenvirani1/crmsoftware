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
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);
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
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 30px;
            padding-bottom: 99px;
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
    <div style="margin: auto;width: 195mm;height: 280mm;overflow: hidden;border: 1px solid #ebebeb;position: relative;">
        <div
            style="width: 100%;position: relative;position: absolute;justify-content: center;align-items: center;position: relative;position: absolute;top: 35%;left: 16%; ">
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($catalog_data->logo))) }}"
                alt="Logo">
        </div>
        <div
            style="position: absolute; bottom: 66px;left: 30px;right: 30px; background-color: transparent;text-align: center;padding: 5px; margin-right: 18px;">
            {{ $catalog_data->address }}&nbsp;&nbsp; <b>Mobile :</b>{{ $catalog_data->phonenumber }}
            &nbsp;&nbsp; <b>Email : </b>{{ $catalog_data->email }}
        </div>
    </div>

    <div class=""
        style="margin: auto;width: 195mm;height: 280mm; border: 1px solid #ebebeb;padding: 30px;position: relative; page-break-after: always;">
        <div
            class=""style="width: 100%;/* display: flex; */justify-content: space-between;align-items: center;border-bottom: 1px solid #e7e7e7;margin-bottom: 30px;padding-bottom: 100px;/* position: absolute; */">
            <div class=""style="width: 200px;height:80px">
                <img style=" width: 208px;float: right;}"
                    src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($catalog_data->logo))) }}"
                    alt="Logo">

                <div class=""style="width: 50%;position: absolute; margin-left: 375px; float: left;">
                    <p style="margin-right: 33px;">{{ $catalog_data->address }}</p>
                </div>
            </div>
        </div>

        <div style="margin: auto;width: 195mm; border: 1px solid #ebebeb;position: relative;">
            @php
                $count = 0;
                $total_product_data = count($product_data);
            @endphp
            @foreach ($product_data as $category)
                @php
                    $count++;
                @endphp
                <div @if ($count < $total_product_data) style="page-break-after: always;" @endif>
                    @if (count($category->productIds) == 0)
                        @continue
                    @endif
                    <div style="font-size: 20px; margin: 0 0 60px 0;">
                        {{ $category->name }}
                    </div>

                    <div style="width: 100%;">
                        @foreach ($category->productIds as $product)
                            @if (!isset($product->product))
                                @continue
                            @endif
                            <div
                                style="width: 220px; display: inline-block; border-radius: 5px; overflow: hidden; background-color: #fbfbfb; border: 1px solid #e7e7e7;">
                                <div class="pro_img">
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
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
</body>

</html>
