<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });
    </script>
    <style>
        .flag {
            width: 15px !important;
            height: auto !important;
            margin-top: -3px !important;
            margin-right: 5px !important;
        }
    </style>
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
            <li class="dropdown" id="nationlity">

                @if($locate=="en")
                    <a href="#" class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/gb.svg" class="flag" alt="">EN&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>

                @elseif($locate=="it")
                    <a href="#" class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/it.svg" class="flag" alt="">IT&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>

                @elseif($locate=="pl")
                    <a href="#" class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/pl.svg" class="flag" alt="">PL&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>

                @elseif($locate=="ua")
                    <a href="#" class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/ua.svg" class="flag" alt="">UA&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>


                @elseif($locate=="ru")
                    <a href="#" class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/ru.svg" class="flag" alt="">RU&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>
                @else
                    <a href="#"  class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/de.svg" class="flag" alt="">DE&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>
                @endif

                <ul class="dropdown-menu">
                    <li><a href="{{URL::to('/signin')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/de.svg" class="flag" alt="">DE</a></li>
                    <li><a href="{{URL::to('/signin/en')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/gb.svg" class="flag" alt="">EN</a></li>
                    <li><a href="{{URL::to('/signin/it')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/it.svg" class="flag" alt="">IT</a></li>
                    <li><a href="{{URL::to('/signin/pl')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/pl.svg" class="flag" alt="">PL</a></li>
                    <li><a href="{{URL::to('/signin/ua')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/ua.svg" class="flag" alt="">UA</a></li>
                    <li><a href="{{URL::to('/signin/ru')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/ru.svg" class="flag" alt="">RU</a></li>
                </ul>
            </li>
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="col-md-5">
                <form method="POST" action="/signin" accept-charset="UTF-8" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h4 class="nomargin">{{trans('authorization.sign_in')}}</h4>
                        <p class="mt5 mb20">{{trans('authorization.login_access_account')}}</p>
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input class="form-control uname" placeholder="Username" value="{{ old('email') }}" name="email" type="text" >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{trans("validation." . $errors->first('email')  )}} </strong>
                                    </span>
                        @endif
                        </div>

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input class="form-control pword" placeholder="Password" name="password" type="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{trans("validation." . $errors->first('password')  )}}</strong>
                                    </span>
                            @endif
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember">{{trans('authorization.remember_me')}}
                        </label>
                    </div>
                    <a href="{{ url('/password/email') }}"><small>{{trans('authorization.forgot_password')}}</small></a>
                    <input class="btn btn-success btn-block" type="submit" value="Sign In">

                </form>

            </div>

        </div>

        </div>

    </section>
    <script src="{{ elixir('assets/admin/js/admin.min.js') }}"></script>
</body>
</html>