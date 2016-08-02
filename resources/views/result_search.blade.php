<!DOCTYPE html>
<head>
    <meta charset="utf-8">

    <title>europasex</title>
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->



    <link rel="alternate" hreflang="de" href="https://sexnord.net/" />
    <link rel="alternate" hreflang="en" href="https://en.sexnord.net/" />



    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,400' rel='stylesheet' type='text/css'>
    <link href="https://en.sexnord.net//assets/stylesheets/main.min.css" rel="stylesheet" type="text/css">
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
        .searchbox-search-multiple .searchbox-search-item {
            width: 15% !important;
            /*margin-right: 10px;*/
            /*margin-bottom: 10px;*/
            /*display: inline-table;*/
        }
    </style>
</head>
<body>
<?php $request = Request::all(); ?>
<header id="header" class="page-header">
    <div class="header-left">

        {{--<h2 class="header-logo"><a href="/"><img src="https://en.sexnord.net/assets/images/logo.svg" alt="SEXNORD.NET"></a></h2>--}}

        {{--<nav class="header-lang nav-dark">--}}
            {{--<ul>--}}


                {{--<li class="has-children"><span>EN</span>--}}
                    {{--<ul>--}}
                        {{--<li><a href="https://sexnord.net" class="" hreflang="de" rel="alternate">DE</a></li>--}}
                        {{--<li><a href="https://en.sexnord.net" class="current" hreflang="en" rel="alternate">EN</a></li>--}}
                        {{--<li><a href="https://dk.sexnord.net" class="" hreflang="en" rel="alternate">DK</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</nav>--}}
        <button id="menu_phone" class="btn-menu"></button>
    </div>
    <div class="header-main">

        <nav class="header-nav nav-dark">
            <ul>
                <li><a id="formodelsbutton" href="#"><b>Info for models </b></a></li>

                @if(Auth::user())
                    <li><a id="formodelsbutton" href="/signout"><b>Sign out</b></a></li>
                @endif
            </ul>
        </nav>



    </div>
</header>


<div id="home2" class="home2 page-cont visible" style="padding-right: 0;">
    <header class="page-heading">
        <div class="heading-main">
            <div class="wrapper">
                {{--<h1>Girls, Escorts, Prostitutes, Trans, Sex contacts<br> free erotic guide for Germany</h1>--}}
                {{--<h2>Find Escort Models, Callgirls, Trans Ladies, Mistresses and Nightclubs in Germany</h2>--}}
            </div>
        </div>
        <div class="heading-main">
        </div>
        <div class="searchbox wrapper">
            <div class="searchbox-help">
                <a id="howToSearchButton" href="#" onclick=";">How to search girls?</a>
            </div>
            <div class="searchbox-tabs">
                <ul>
                    <li class="selected"><a id="findbyquerytab" href="#search" >Search</a></li>
                    <li><a id="findnearyoutab" href="#find-near-you">Find near you</a></li>
                </ul>
            </div>
            <div class="searchbox-main visible" data-searchbox="#search">
                <div class="searchbox-search">
                        <div id="searchbox_city" class="searchbox-search-item city">
                            <div class="searchbox-city __active __active-sub">
                                <span id="searchbox-city-label" class="searchbox-city-label">Select city</span>
                            </div>
                        </div>
                        <div id="searchbox_or" class="searchbox-search-item or">
                            <span>oder <em>nutze unsere Suchmaschine</em></span>
                        </div>
                    <form action="/search" id="searchbox_wrap" class="searchbox-search-wrap">
                        <div class="searchbox-search-item multiple">
                            <div class="searchbox-search-multiple">
                                <div class="searchbox-search-item search">
                                    {{--<input id="search" type="text" name="name" placeholder="name" class="medium white block" autocomplete="off">--}}
                                    <input  type="text" name="name" id="autocomplete" class="medium white block" value="{{  $request['name'] }}"/>
                                </div>
                                <div class="searchbox-search-item nationality">
                                    <div class="form-group mb15">
                                        <div class="col-sm-4">
                                            <select class="white medium block" name="nationality">
                                                <option value="">nationality</option>
                                                @foreach($profile->availableNationality() as $item)
                                                        <option class="level-0" value="{{$item}}"
                                                        @if(!empty($request['nationality']) && isset($request['nationality']) )
                                                            {{ ($request['nationality'] == $item) ? 'selected' : '' }}@endif>
                                                            {{$item}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchbox-search-item nationality">
                                <div class="form-group mb15">
                                        <div class="col-sm-6">
                                            <?php $age = $request['age'] ?>
                                            <input class="white medium block" min="18" placeholder="Age" max="80" name="age" type="number" value="{{$request['age']}}">
                                       </div>
                                    </div>
                                  </div>
                                    <div class="searchbox-search-item nationality">
                                        <div class="form-group mb15">
                                            <div class="col-sm-4">
                                                <div class="searchbox-search-item nationality">
                                                    <div class="form-group mb15">
                                                        <div class="col-sm-4">
                                                            <select class="white medium block" name="breast_number">
                                                                <option value="">brest_number</option>
                                                                    @foreach($profile->availableBNumber() as $breast_number)
                                                                    <option class="level-0" value="{{$breast_number}}"
                                                                    @if(!empty($request['breast_number']) && isset($request['breast_number']) )
                                                                        {{ ($request['breast_number'] == $breast_number) ? 'selected' : '' }}@endif>
                                                                        {{$breast_number}}</option>
                                                                     @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                <div class="searchbox-search-item nationality">
                                    <div class="form-group mb15">
                                        <div class="col-sm-4">
                                            <select class="white medium block" name="breast_letter">
                                                <option value="">Brest Letter</option>

                                                @foreach($profile->availableBLetter() as $item)

                                                        <option class="level-0" value="{{$item}}"
                                                        @if(!empty($request['breast_letter']) && isset($request['breast_letter']) )
                                                            {{ ($request['breast_letter'] == $item) ? 'selected' : '' }}@endif>
                                                            {{$item}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchbox-search-item hair">
                                    <div class="form-group mb15">
                                        <div class="col-sm-4">
                                            <select class="white medium block" name="haircolor">
                                                <option value="">Hair color</option>
                                                @foreach($profile->availableHaircolors() as $key=>$item)
                                                        <option class="level-0" value="{{$item}}"
                                                        @if(!empty($request['haircolor']) && isset($request['haircolor']) )
                                                            {{ ($request['haircolor'] == $item) ? 'selected' : '' }}@endif>
                                                            {{$item}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchbox-search-item submit">
                                    <button type="submit" id="searchbutton" class="btn btn-primary btn-medium">Search</button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </header>
</div>
<main class="page-main slideMain">
    <div data-snm-profiles-empty-info="">
    </div>

            <div class="profil-list-options">
                <div class="profil-list-sort-count">
                    <div class="profil-list-sort">
                        <label for="sort_by" class="ng-binding">Sortieren nach</label>
                        <div class="select-wrap">
                            <select class="small ng-pristine ng-untouched ng-valid" ng-model="sort" ng-change="changeSortMode(sort)">
                                <option value="default" class="ng-binding">Sort - standard</option>
                                <option value="myfavs" class="ng-binding">Meine Favoriten</option>
                                <option value="allfavs" class="ng-binding">Favoriten </option>
                                <option value="new" class="ng-binding">Neue</option>
                            </select>
                            <div class="select-arrow"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{--{{dd($search_profile[0]->images)}}--}}

    <div id="advertisements" class="adverts ng-isolate-scope view-list" data-snm-profiles-list-adverts="" data-ng-class="'view-' + view"><!-- ngRepeat: advert in adverts | filter: { advertisementType: 'PROFILE_LIST' } -->
    </div>
    <div class="profil-list view-list" style="margin-top: 70px" data-config="config" data-profiles="profiles" data-loved-only="lovesFilterActive" data-show-all="showAllProfiles" data-view="view" data-refresh-list-view="refreshListView" data-snm-profiles-list="" data-ng-class="{'map': sidebarState.left}">
        @foreach ($search_profile as $key => $value)
            {{--{{dd($value)}}--}}

            <article data-id="{{ $value->user_id }}" class="profil visible-y" style="height: 320px;">
                    <span id="SNPI{{ $value->user_id }}" class="PLanchor"></span>
                    <div>
                        <div class="thumbs-slide-wrap slider-fade slider-wrapper profile-slide-wrap">
                            {{--{{dd($value)}}--}}
                            <a class="carousel-slide hide-overflow profile-main-link" href="/profile-model/{{ $value->id }}" style="height: 320px;">
                                <div class="placeholder"></div>
                                        <div style="background-image: url({{ "uploads/profiles/test/avatar/" . $value->id . '.jpg'}}); background-size: cover;" class="slide-image slide-item b-lazy active b-loaded"></div>
                            </a>
                        </div>
                    </div>
                    <button class="heart clickable">79</button>

                    <div class="profil-short">
                        <div class="profil-tags">
                            <span class="vip">VIP</span>
                            <span class="tag">New</span>
                        </div>
                        <a href="tel:{{ $value->cellphone }}" class="btn-phone btn-small" data-id="{{ $value->user_id }}"></a>
                        <h3>{{ $value->name }}, {{ $value->age }}</h3>
                        <h4><a href="/profile/"></a></h4>
                        <div class="bell-info-wrap">
                            <button class="bell-info blink">Close</button>
                            <p>
                                <a href="/profile/{{ $value->user_id }}/map">Klosterbergestraße 17 39104&nbsp;Magdeburg</a><br>
                                <span></span>
                                <span class="working-hours">Non Stop</span>
                            </p>
                        </div>
                    </div>

                </article>
        @endforeach
    </div>
 </main>
<?php $search_profile->appends( Input::only('name', 'nationality', 'age', 'breast_number', 'breast_letter', 'haircolor') ); ?>

{!! $search_profile->render() !!}


{{--<script async type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyA7PxkTu0F6uUjTFrhd8eElzEKYuP6eiK8&callbackcallback=mapsLoaded"></script>--}}


<script src="<?php echo url('assets/js/jquery/autocompleate.js'); ?>"></script>

<script src="https://sexnord.net/static/lib/js/snstat/stat.js"></script>

<script>
    $('.location').append()
    //    $(document).ready(function () {
    var names = [];
    $.ajax({
        url: '/find-model',
        type: 'POST',
        success: function (data) {
            if (data.auth == 'success') {
                $.each(data.fields, function (key, val) {
                    var arr =
                    {
                        "value" :  val
                    };
                    names.push(arr);
                });
                console.log(names);
            } else {
            }
        },
        error: function (data) {

        }

    });

    $(".check_picture").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {


            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = $(this).closest('.searchbox-search');
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
//                $(group).prop("checked", false);
            group.find('.check_picture').prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });


    $('#autocomplete').autocomplete({
        lookup: names,
        onSelect: function (suggestion) {
        }
    });

</script>


</body>
</html>

