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
        @csrf
        <div class="input-div">
            <span class="error-span" data-name="message" style="text-align :center;"></span>
            <input type="text" placeholder="Email" name="email">
            <span class="error-span" data-name="email"></span>
            <input type="password" placeholder="Password" name="password">
            <span class="error-span" data-name="password"></span>
        </div>

        <div class="select-div d-none">
            <select name="group_id">
                @foreach ($group as $opction)
                    <option value="{{ $opction->id }}">
                        {{ $opction->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <input class="next" type="button" value="Login">
    </form>
</div>

<!-- Add this script tag before your custom JavaScript code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Get Data from Form and send with ajax.
    $(".next").click(function(event) {
        var formData = new FormData($("#LoginForm")[0]);
        $(`[data-name]`).html("");
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
                if (response.status == '200') {
                    $(".input-div").addClass('d-none');
                    $(".select-div").removeClass('d-none');
                    $('.next').attr('type', 'submit');
                    $('.next').attr('value', 'Process');
                    $('.login-title').text('Select group');
                    var url = "{{ route('login') }}";
                    $('#LoginForm').attr('action', url);
                    $('#LoginForm').attr('method', 'post');
                } else if (response.status == '411') {
                    $('[data-name="message"]').html(response.msg);
                }
            },
            error: function(response, status, error) {
                // setting all input variables empty

                var validation = response.responseJSON.data;
                // fill up input variables with error
                $.each(validation, function(key, value) {
                    $('[data-name="' + key + '"]').html(value);
                })
            }

        });
    });
</script>
