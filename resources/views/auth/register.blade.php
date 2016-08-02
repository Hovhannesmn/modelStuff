<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>SignUp page</title>
    <style>
        .flag {
            width: 15px !important;
            height: auto !important;
            margin-top: -3px !important;
            margin-right: 5px !important;
        }
    </style>
</head>
  <link rel="stylesheet" href="{{ elixir('assets/admin/css/admin.min.css') }}">

    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

</head>
<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="signuppanel">
        
        <div class="row">
            <div class="col-xs-12">
                @include('admin.partial.errors')
            </div>
            <div class="col-md-6">
                
                <div class="signup-info">
                    <div class="logopanel">
                        <h1><span>[</span> Modelle Luneburg <span>]</span></h1>
                    </div>
                    <div class="mb20"></div>
                
                    <h5><strong>Join us to get rain of new clients!</strong></h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae ante turpis. Integer semper congue odio, at pretium enim iaculis a.</p>
                    <p>Below are some of the benefits you can have when join our club:</p>
                    <div class="mb20"></div>
                    
                    <div class="feat-list">
                        <i class="fa fa-male" style="width: 35px;height: 35px;text-align: center;padding-top: 7px; font-size: 18px"></i>
                        <h4 class="text-success">Show yourself to our clients</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae ante turpis. Integer semper congue odio, at pretium enim iaculis a.</p>
                    </div>
                    
                    <div class="feat-list mb20">
                        <i class="fa fa-area-chart"  style="width: 35px;height: 35px;text-align: center;padding-top: 7px; font-size: 18px"></i>
                        <h4 class="text-success">Access to your profile stats</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae ante turpis. Integer semper congue odio, at pretium enim iaculis a. </p>
                    </div>
                    
                    <p class="mb20">and bla bla bla ...</p>
                
                </div>
            
            </div>

            <div class="col-md-6">
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
                        <li><a href="{{URL::to('/signup')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/de.svg" class="flag" alt="">DE</a></li>
                        <li><a href="{{URL::to('/signup/en')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/gb.svg" class="flag" alt="">EN</a></li>
                        <li><a href="{{URL::to('/signup/it')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/it.svg" class="flag" alt="">IT</a></li>
                        <li><a href="{{URL::to('/signup/pl')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/pl.svg" class="flag" alt="">PL</a></li>
                        <li><a href="{{URL::to('/signup/ua')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/ua.svg" class="flag" alt="">UA</a></li>
                        <li><a href="{{URL::to('/signup/ru')}}"><img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/ru.svg" class="flag" alt="">RU</a></li>
                    </ul>
                </li>
                {!! Form::open(['method'=>'POST', 'url'=>'/signup']) !!}
                    <h3 class="nomargin"> {{trans('registration.Sign Up')}}</h3>
                    <p class="mt5 mb20">{{trans('registration.Already a member?')}} <a class="text-success" href="/signin">Sign In</a></p>
                <div class="mb10">
                    <select class="form-control" id="user_type" name="user_type">
                        <option value="login" selected="selected">{{trans('registration.Normal user')}}</option>
                        <option value="model"> {{trans('registration.Prostitutes/Models')}}</option>
                        <option value="owner">{{trans('authorization.Lovehouse owner')}}</option>
                    </select>
                </div>

                <div class="mb10">
                        <label class="control-label">{{trans('authorization.Full name')}}</label>
                        {!! Form::text('name', null , ['class'=>'form-control', 'placeholder'=>'Name Surname']) !!}
                    </div>
                    
                    <div class="mb10">
                        <label class="control-label">{{trans('authorization.Username(email)')}}</label>
                        {!! Form::text('email', null , ['class'=>'form-control', 'placeholder'=>'example@email.com']) !!}
                    </div>

                    <div class="mb10" id="inputs">
                    </div>

                <div class="mb10">
                        <label class="control-label">{{trans('authorization.Password')}}</label>
                        {!! Form::input('password', 'password', null , ['class'=>'form-control', 'placeholder'=>'******']) !!}
                    </div>
                    <div class="mb10">
                        <label class="control-label">{{trans('authorization.Retype Password')}}</label>
                        {!! Form::input('password', 'password_confirmation', null , ['class'=>'form-control', 'placeholder'=>'******']) !!}
                    </div>
                    <br />
                    
                    <button class="btn btn-success btn-block">{{trans('authorization.Sign Up')}}</button>
                </form>
            </div>
            
        </div>
        
        <div class="signup-footer">
            <div class="text-center">

                {{trans('authorization.&copy; 2015. All Rights Reserved. Modelle Luneburg')}}
            </div>
        </div>
        
    </div><!-- signuppanel -->
  
</section>


<script src="{{ elixir('assets/admin/js/admin.min.js') }}"></script>
<script>
    $(document).ready(function(){
        getflags();
        function getflags(){
            var path = window.location.pathname.split( '/' )[2];

//            switch (path) {
//                case "en":
////                    $( ".removeable" ).remove();
//                    $('#nationality').append(
//                    '<a href="#"  class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'
//                    +'<img src="http://sexyeuropa.com/build/assets/admin/flags/4x3/de.svg" class="flag" alt="">'
//                    +'DE&nbsp;&nbsp;&nbsp;' + '<span class="caret"></span></a>'
//
//                     );
//
//
//                    break;
//                case "it":
//                    alert( 'В точку!' );
//                    break;
//                case "ue":
//                    alert( 'Перебор' );
//                    break;
//                default:
//                    $('#nationality').append(
//                            '<a href="#"  class="dropdown-toggle removeable" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'
//                            +"sdsadsadas" + '</a>'
//
//                    );
//            }
        }
        // Chosen Select
        $(".chosen-select").chosen({
            'width':'100%',
            'white-space':'nowrap',
            disable_search_threshold: 10
        });
        var type =     '<?php echo  (Request::session()->get("type_user")) ?>';
        if(type){
            $("#user_type").val(type).prop('selected', true);
        }

usertype();

        $('#user_type').change(function () {
            usertype();
        });

function usertype () {
    switch ($('#user_type').val()) {
        case "login":
            $("#inputs").empty();
            break;
        case "model":
            $("#inputs").empty();
            $("#inputs").append(
                '<label class="control-label">' + "Phone number" + '</label>' +
                '<input class="form-control" placeholder="Name Surname" name="phonenumber" type="tel">'
            );
            break;
        case "owner":
            $("#inputs").empty();
            $("#inputs").append(
                    '<label class="control-label">' + "Name of Lovehouse" + '</label>' +
                    '<input class="form-control" placeholder="Name Surname" name="love_house" type="tel">'
            );
            break;

    }
};
        
    });
</script>
<link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css">
</body>

</html>
