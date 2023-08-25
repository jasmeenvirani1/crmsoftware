<html>

<head>
    <title>{{ $company->name }} Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Include any CSS styling you want for the details view -->
    <style>
        /* body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin: 0 auto;
            width: 80%;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .label-image-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .label-image-container label {
            font-weight: bold;
            margin-right: 10px;
        }

        .label-image-container img {
            height: 77px;
            width: 110px;
            border: 1px solid #ccc;
            margin-left: 25px;
        }

        .details-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }

        .margin-botom {
            margin-bottom: 16px;
        }

        .detail-content {
            margin-left: 20%;
        } */

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            font-family:Arial, Helvetica, sans-serif;
        }

        .details {
            text-align: center;
            padding: 10px;
        }

        .section {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .content {
            margin-left: 10px;
        }

        .image {
            height: 130px;
            width: 190px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>

</head>

<body>
    <div class="header">
        <h1>{{ $company->name }} Details</h1>
    </div>


    <div class="details">
        <div class="section">
            <p><strong>Company Name:</strong> {{ $company->name }}</p>
        </div>
        <div class="section">
            <p><strong>Email:</strong> {{ $company->email }}</p>
        </div>
        <div class="section">
            <p><strong>Phone No:</strong> {{ $company->phonenumber }}</p>
        </div>
        <div class="section">
            <p><strong>Address:</strong> {{ $company->address }}</p>
        </div>
        <div class="section">
            <p><strong>GST:</strong> {{ $company->gst }}</p>
        </div>

        {{-- @php
            $file_path = 'D:\xampp_v8.1\htdocs\crmsoftware\public\company\logo\1691574112_2.jpg';
            //$file_path = public_path($company->logo);
           // prx($file_path);
            $fileExists = Storage::exists($file_path);
        @endphp --}}

        <div class="section">
            <p><strong>Logo:</strong></p>
            <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($company->logo))) }}"
                alt="Image" class="image">
        </div>
        {{-- @endif
        @php
            $file_path = public_path($company->pancard);
            $fileExists = Storage::exists($file_path);
        @endphp --}}
        {{-- @if ($fileExists) --}}

        @if ($company->pancard != '')
            <div class="section">
                <p><strong>Pan Card:</strong></p>
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($company->pancard))) }}"
                    alt="Image" class="image">
            </div>
        @endif

        @if ($company->cheque != '')
            <div class="section">
                <p><strong>Cheque:</strong></p>
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($company->cheque))) }}"
                    alt="Image" class="image">
            </div>
        @endif

        @if ($company->msme_certificate != '')
            <div class="section">
                <p><strong>MSME Certificate:</strong></p>
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path($company->msme_certificate))) }}"
                    alt="Image" class="image">
            </div>
        @endif


    </div>

</body>

</html>
