
<!DOCTYPE html>
<html lang="en" ng-app="frontend">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="HsycvBb6clt4himAdrxjlJg6VR3fnnjC3WRpPDXu">

    <title>Orhidi</title>


    <!-- CSS -->
    <link rel="stylesheet" href="http://release.orhidi.com/assets/frontend/css/vendor.css">
    <link rel="stylesheet" href="http://release.orhidi.com/assets/frontend/css/index.css">
</head>
<body>
<main id="page" class="layout-home">

    <header class="toolbar" ng-controller="ToolbarController as ct">
        <a href="/" class="logo" target="_self">Orhidi</a>
        <nav class="hidden" ng-class="{'hidden': !ct.showToolbar}">
            <ul>
                <li>
                    <a href="http://release.orhidi.com/how-it-works" class="btn btn-clean btn-secondary" target="_self">How it works</a>
                </li>
                <li>
                    <a href="http://release.orhidi.com/pricing" class="btn btn-clean btn-secondary" target="_self">Pricing</a>
                </li>
                <li>
                    <a href="http://release.orhidi.com/rent-flat" class="btn btn-clean btn-secondary" target="_self">Rent a flat</a>
                </li>
                <li ng-hide="ct.auth.authenticated()">
                    <span class="btn btn-clean btn-secondary" ng-click="ct.auth.showForm = true">Login</span>
                </li>
                <li ng-hide="ct.auth.authenticated()">
                    <a href="http://release.orhidi.com/register" class="btn btn-primary" target="_self">Register</a>
                </li>
                <li class="user" ng-show="ct.auth.authenticated()">
                    <a href="#" class="btn btn-clean btn-secondary  dropdown-toggle" data-toggle="dropdown"><span class="material-icons">&#xE853;</span> <span ng-bind="ct.auth.user.name"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://release.orhidi.com/account" target="_self">Dashboard</a>
                        <a class="dropdown-item" href="http://release.orhidi.com/account/profile" target="_self">Profile</a>
                        <a class="dropdown-item" href="http://release.orhidi.com/account/settings" target="_self">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" ng-click="ct.logout();">Logout</a>
                    </div>
                </li>
                <li class="language">
                    <a href="#" class="btn btn-clean btn-secondary  dropdown-toggle" data-toggle="dropdown">
                        en
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://release.orhidi.com" target="_self">EN</a>
                        <a class="dropdown-item" href="http://release.orhidi.com/de" target="_self">DE</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="mobile-nav">
            <a href="#" class="btn-toggle-slideout btn btn-primary material-icons">&#xE5D2;</a>
        </div>
        <div class="search">
            <input type="text" class="form-control" placeholder="Type to Search">
            <button class="btn btn-default"><i class="material-icons">&#xE8B6;</i></button>
        </div>
    </header>

    <section class="promo">
        <div class="container promo-inner">

            <div class="promo-item pi-l">
                <a title="Diana | Berlin | $$" href="http://release.orhidi.com/berlin/diana2" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/OOZtPB6sUN/Jwp1EUJVoH-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Martine | Berlin | $$" href="http://release.orhidi.com/berlin/martine3" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/6Gw0BYKXQL/ASFRjgtfmT-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Julie | Berlin | $$" href="http://release.orhidi.com/berlin/julie1" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/c3HLTL9Thx/O7e1MkLyko-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Holly | Berlin | $$" href="http://release.orhidi.com/berlin/holly1" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/WmRvOyRNMj/Tg4PqqmbTu-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Susan | Berlin | $$" href="http://release.orhidi.com/berlin/susan1" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/gAtIcHiv1t/rf3QW7MCtm-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Ora | Berlin | $$" href="http://release.orhidi.com/berlin/ora3" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/LoAA8SKph8/5BMdb8njet-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Carmella | Berlin | $$" href="http://release.orhidi.com/berlin/carmella5" class="inner"
                   style="background-image: url('http://release.orhidi.com/profiles/Kx43hhkRZC/8RtxGbakSL-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Aditya | Berlin | $$" href="http://release.orhidi.com/berlin/aditya4" class="inner"
                   style="background-image: url('profiles/GU85aYyKww/DLLMi88BWZ-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-m">
                <a title="Cecilia | Berlin | $$" href="http://release.orhidi.com/berlin/cecilia4" class="inner"
                   style="background-image: url('profiles/I6RO9c7Gw2/AJAAK0LMcg-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Emelie | Berlin | $$" href="http://release.orhidi.com/berlin/emelie1" class="inner"
                   style="background-image: url('profiles/bEwLI3KNBO/ZAK7H6cR4V-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Shaylee | Berlin | $$" href="http://release.orhidi.com/berlin/shaylee3" class="inner"
                   style="background-image: url('profiles/oeCgmOKIx0/3A6C05htzk-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Ila | Berlin | $$" href="http://release.orhidi.com/berlin/ila2" class="inner"
                   style="background-image: url('profiles/4pyivICJ9B/U3kHehD0RS-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="May | Berlin | $$" href="http://release.orhidi.com/berlin/may2" class="inner"
                   style="background-image: url('profiles/vPuEP8KH7L/Pj4ljEnQRm-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Sandy | Berlin | $$" href="http://release.orhidi.com/berlin/sandy5" class="inner"
                   style="background-image: url('profiles/vwNjbJFgAL/qqZADcLt1n-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Zelda | Berlin | $$" href="http://release.orhidi.com/berlin/zelda4" class="inner"
                   style="background-image: url('profiles/hwX5Neq5ff/xycQgMKdJu-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Antoinette | Berlin | $$" href="http://release.orhidi.com/berlin/antoinette2" class="inner"
                   style="background-image: url('profiles/gxxZmgQIqL/50aYZ1r2kI-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Kailyn | Berlin | $$" href="http://release.orhidi.com/berlin/kailyn5" class="inner"
                   style="background-image: url('profiles/56piBGuzqa/vvHQvDRTs6-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Katherine | Berlin | $$" href="http://release.orhidi.com/berlin/katherine5" class="inner"
                   style="background-image: url('profiles/9yTdX9eWVx/wm9xG7UscI-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Karen | Berlin | $$" href="http://release.orhidi.com/berlin/karen3" class="inner"
                   style="background-image: url('profiles/c49iapi5lX/McEm7RSdhB-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Eulalia | Berlin | $$" href="http://release.orhidi.com/berlin/eulalia5" class="inner"
                   style="background-image: url('profiles/tN4AhHZRtU/2d1rbOqOUd-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Trisha | Berlin | $$" href="http://release.orhidi.com/berlin/trisha4" class="inner"
                   style="background-image: url('profiles/4wXkxPM5b8/uERMn9v7tw-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Aaliyah | Berlin | $$" href="http://release.orhidi.com/berlin/aaliyah2" class="inner"
                   style="background-image: url('profiles/kuPaIL5xAU/b1ZMDUKTw9-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Winona | Berlin | $$" href="http://release.orhidi.com/berlin/winona4" class="inner"
                   style="background-image: url('profiles/OBP3tG0HNv/WdQfIZ2xru-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Gabrielle | Berlin | $$" href="http://release.orhidi.com/berlin/gabrielle5" class="inner"
                   style="background-image: url('profiles/G0oaLS820b/bgB3HLpbOq-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Jazmyn | Berlin | $$" href="http://release.orhidi.com/berlin/jazmyn4" class="inner"
                   style="background-image: url('profiles/EXHRdliXmh/3ee61fdf9d79ea6a5020b6a47be0ea5b-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Clara | Berlin | $$" href="http://release.orhidi.com/berlin/clara3" class="inner"
                   style="background-image: url('profiles/XXhp88vfHc/qyuqIQpsbz-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Calista | Berlin | $$" href="http://release.orhidi.com/berlin/calista1" class="inner"
                   style="background-image: url('profiles/Ke7dRJHycu/Ld6IhOTRVo-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Adella | Berlin | $$" href="http://release.orhidi.com/berlin/adella3" class="inner"
                   style="background-image: url('profiles/fOKAuUEIrV/TvPCtX1yF1-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Nora | Berlin | $$" href="http://release.orhidi.com/berlin/nora1" class="inner"
                   style="background-image: url('profiles/uW1wJ64KEj/0jz9FdMZZJ-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Gilda | Berlin | $$" href="http://release.orhidi.com/berlin/gilda3" class="inner"
                   style="background-image: url('profiles/GXdNwHXggX/27iBK0kw1i-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Shea | Berlin | $$" href="http://release.orhidi.com/berlin/shea4" class="inner"
                   style="background-image: url('profiles/1VaVHqzoAc/ZEHYr3DSck-320.jpg');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="Fulda Testa | Hamburg | $$" href="http://release.orhidi.com/hamburg/fulda-testa" class="inner"
                   style="background-image: url('profiles//0d529543941581b0373f8cf0c0dcc7f0-320.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>


            <div class="promo-item pi-s">
                <a title="GET THIS PLACE" href="http://release.orhidi.com/show-on-main" class="inner"
                   style="background-image: url('http://www.arcanemarketing.com/wp-content/uploads/2013/05/placeholder.png');" target="_self">
                </a>
            </div>

        </div>
    </section>

    <section class="promo-under">
        <div class="promo-under-container">
            <h1 class="title">Welcome to orhidi.com!</h1>
            <h3 class="subtitle">Orhidi - is the most secure, complete and loyal site about hookers and for hookers.</h3>

            <div class="form-search-wrap">
                <form class="form-search">
                    <select id="city-select-box" class="city-select-box selectivity-input" data-placeholder="Select city ..." name="city">
                        <option value="berlin">Berlin</option>
                        <option value="hamburg">Hamburg</option>
                    </select>
                    <button type="submit" class="btn-search btn btn-primary">Search</button>
                </form>
            </div>
            <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
        </div>
    </section>


    <footer class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste ea earum, cupiditate suscipit et corporis cum tempora a sed voluptatibus? Magnam expedita, officia nihil vero dolorum. Dolores veritatis, dicta magni.
                </div>
                <div class="col-xs-12 col-sm-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste ea earum, cupiditate suscipit et corporis cum tempora a sed voluptatibus? Magnam expedita, officia nihil vero dolorum. Dolores veritatis, dicta magni.
                </div>
                <div class="col-xs-12 col-sm-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste ea earum, cupiditate suscipit et corporis cum tempora a sed voluptatibus? Magnam expedita, officia nihil vero dolorum. Dolores veritatis, dicta magni.
                </div>
                <div class="col-xs-12 col-sm-3">
                    <h5>West coast:</h5>
                    <ul class="unstyled">
                        <li><a href="#">Girls in Berlin</a></li>
                        <li><a href="#">Girls in Munchen</a></li>
                        <li><a href="#">Girls in Dortmund</a></li>
                        <li><a href="#">Girls in Berlin</a></li>
                        <li><a href="#">Girls in Munchen</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            Copyright © 2016 Orhidi
        </div>
    </footer>
</main>


<nav id="menu" ng-controller="ToolbarController as ct">
    <ul class="mobile-menu-account" ng-if="ct.auth.authenticated()">
        <li class="avatar" ng-if="ct.auth.profile_image">
            {{--<div class="avatar-image" style="background-image: url(/{{ct.auth.profile_image}});"></div>--}}
        </li>
        {{--<li class="title">{{ct.auth.user.name}}</li>--}}
        <li><a class="btn btn-clean btn-secondary" href="http://release.orhidi.com/account" target="_self">Dashboard</a></li>
        <li><a class="btn btn-clean btn-secondary" href="http://release.orhidi.com/account/profile" target="_self">Profile</a></li>
        <li><a class="btn btn-clean btn-secondary" href="http://release.orhidi.com/account/settings" target="_self">Settings</a></li>
        <li>
            <span class="btn btn-clean btn-secondary" ng-click="ct.logout();">Logout</span>
        </li>
    </ul>
    <ul>
        <li class="title">Menu</li>
        <li>
            <a href="http://release.orhidi.com/how-it-works" class="btn btn-clean btn-secondary" target="_self">How it work's</a>
        </li>
        <li>
            <a href="http://release.orhidi.com/pricing" class="btn btn-clean btn-secondary" target="_self">Pricing</a>
        </li>
        <li>
            <a href="http://release.orhidi.com/rent-flat" class="btn btn-clean btn-secondary" target="_self">Rent a flat</a>
        </li>
        <li ng-if="!ct.auth.authenticated()">
            <span class="btn btn-clean btn-secondary" ng-click="ct.auth.showForm = true">Login</span>
        </li>
        <li ng-if="!ct.auth.authenticated()">
            <a href="/" class="btn btn-clean btn-secondary">Sign Up</a>
        </li>
    </ul>
</nav>

<ng-include src="'components/loginbox/loginbox.html'"></ng-include>

<!-- jQuery first, then Bootstrap JS. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
<script src="http://release.orhidi.com/assets/frontend/js/vendor.js"></script>
<script src="http://release.orhidi.com/assets/frontend/js/templates.js"></script>
<script src="http://release.orhidi.com/assets/frontend/js/application.js"></script>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>
    (function ()
    {
        window.localization = {};
    })();
</script>

<script>
    (function ()
    {
        window.user = null;
        window.locale = 'en';
        window.defaultLocale = 'en';
    })();
</script>


<!-- Temporary -->
<script type="text/javascript" src="http://feather.aviary.com/imaging/v3/editor.js"></script>
</body>
</html>