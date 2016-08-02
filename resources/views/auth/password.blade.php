<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });
    </script>

    <title>Login page</title>

    <link rel="stylesheet" href="{{ elixir('assets/admin/css/admin.min.css') }}">
</head>
<body>
<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="signinpanel">

        <div class="row">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="col-md-10">
                <form method="post" class="lost_reset_password" role="form" action="password/email">

                {!! csrf_field() !!}

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                        <p>Lost your password? Please enter your  email address. You will receive a link to create a new password via email.</p>
                    <div class="form-group ">
                        <label for="exampleInputEmail1">Email address</label>
                        {{--<input type="email" class="form-control" id="InputEmail1" placeholder="Email">--}}
                        <p class="form-row form-row-first">
                            {{--<label for="user_login">Username or email</label>--}}
                            <input class="form-control" name="email" value="" id="InputEmail1" type="text"></p>
                    </div>
                    <div class="">
                        <p class="form-row">
                            <input class="button btn btn-success" value="Reset Password" type="submit">
                        </p>
                    </div>
                    </form>
            </div>

        </div>

    </div>

</section>
<script src="{{ elixir('assets/admin/js/admin.min.js') }}"></script>
</body>
</html>


