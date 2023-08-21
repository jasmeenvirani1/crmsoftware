<html>

<head>
    <title>{{ $company->name }} Details</title>
    <!-- Include any CSS styling you want for the details view -->
    <style>
        body {
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
        }
    </style>

</head>

<body>
    <div class="header">
        <h1>{{ $company->name }} Details</h1>
    </div>
    <div class="details">
        <p><strong>Company Name:</strong> {{ $company->name }}</p>
        <p><strong>Email:</strong> {{ $company->email }}</p>
        <p><strong>Phone Number:</strong> {{ $company->phonenumber }}</p>
        <p><strong>Address:</strong> {{ $company->address }}</p>
        <p><strong>GST:</strong> {{ $company->gst }}</p>

        <div class="label-image-container">
            <label>Logo:</label>
            <img src="{{ asset($company->logo) }}" alt="Logo">
        </div>
        
        <div class="label-image-container">
            <label>Pan Card:</label>
            <img src="{{ asset($company->pancard) }}" alt="Pan Card">
        </div>
        
        <div class="label-image-container">
            <label>Cheque:</label>
            <img src="{{ asset($company->cheque) }}" alt="Cheque">
        </div>
        
        <div class="label-image-container">
            <label>MSME Certificate:</label>
            <img src="{{ asset($company->msme_certificate) }}" alt="MSME Certificate">
        </div>
    </div>
</body>
</html>
