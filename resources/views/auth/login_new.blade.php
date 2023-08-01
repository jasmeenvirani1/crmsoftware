<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="{{ asset('front-login/login.css') }}" rel="stylesheet" type="text/css" />
</head>
<div class="container">
    <h1 class="login-title">Login</h1>
    <form class="form" id="LoginForm" action="javascript:void(0);">
        <input type="text" placeholder="Email">
        <input type="password" placeholder="Password">
        {{-- <select>
            @foreach ($group as $opction)
                <option value="{{ $opction->id }}">
                    {{ $opction->name }}
                </option>
            @endforeach
        </select> --}}
        <input class="next" type="submit" value="Next">
    </form>
</div>

<!-- Add this script tag before your custom JavaScript code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Get Data from Form and send with ajax.
    $("#LoginForm").submit(function(event) {
        alert(12);
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            type: "POST",
            url: "{{ route('login') }}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            },
            error: function(response, status, error) {
                // manageErrors(response.responseText, "edit" + ucword_modual_name + "Form", 'edit');
            }

        });
    });
</script>
