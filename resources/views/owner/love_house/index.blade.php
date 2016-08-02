@extends('profile')

@section('page-title')
    <span>{{ Languages::trans('admin.breadcrumbs.my_profile') }}</span>
@endsection

@section('breadcrumbs')
    <li class="active">{{ Languages::trans('admin.breadcrumbs.my_profile') }}</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-3">
            @if($profile_image)

                <img src="{!! $profile_image->url !!}" class="thumbnail img-responsive" alt="" />

            @endif
        </div>
        <div class="col-sm-9">
            <div class="mb15"></div>
            <div class="profile-header">

                {{--<a href="/{{Auth::user()->roles[0]->name}}/profile/{{ $profile->id }}/edit" class="btn btn-edit btn-white"><i class="fa fa-pencil-square"></i> {{ Languages::trans('model.profile.edit_profile') }}</a>--}}

                <h2 class="profile-name">{{ Auth::user()->lovehouse->name}} </h2>
                <h4 style="margin-top: -12px;">{!! Languages::fromArrayOrNull($profile->about_short) !!}</h4>


                <div class="profile-location"><i class="fa fa-mobile"></i> {{ $profile->cellphone }}</div>
                <div class="profile-location mb10"><i class="fa">@</i> {{ $profile->contact_email }}</div>
                <p class="mb20">
                    {!! Languages::fromArrayOrNull($profile->about_full) !!}
                </p>
            </div>
        </div>
    </div>



    <link href="https://en.sexnord.net//assets/stylesheets/main.min.css" rel="stylesheet" type="text/css">

    <div class="profil-list view-list" style="margin-top: 70px" data-config="config" data-profiles="profiles" data-loved-only="lovesFilterActive" data-show-all="showAllProfiles" data-view="view" data-refresh-list-view="refreshListView" data-snm-profiles-list="" data-ng-class="{'map': sidebarState.left}">
        @foreach ($models as $key => $model)

            <article data-id="{{ $model->profile->user_id }}" class="profil visible-y" style="height: 320px;">
                <span id="SNPI{{ $model->profile->user_id }}" class="PLanchor"></span>
                <div>
                    <div class="thumbs-slide-wrap slider-fade slider-wrapper profile-slide-wrap">
                        {{--{{dd($value)}}--}}
                        <a class="carousel-slide hide-overflow profile-main-link" href="/owner/profile/{{ $model->profile->id }}" style="height: 320px;">
                            <div class="placeholder"></div>
                            <div style="background-image: url({{ "/uploads/profiles/test/avatar/" . $model->profile->id . '.jpg'}}); background-size: cover;" class="slide-image slide-item b-lazy active b-loaded"></div>
                        </a>
                    </div>
                </div>
                <button class="heart clickable">79</button>

                <div class="profil-short">
                    <div class="profil-tags">
                        <span class="vip">VIP</span>
                        <span class="tag">New</span>
                    </div>
                    <a href="tel:{{ $model->profile->cellphone }}" class="btn-phone btn-small" data-id="{{ $model->profile->user_id }}"></a>
                    <h3>{{ $model->profile->name }}, {{ $model->profile->age }}</h3>
                    <h4><a href="/profile/"></a></h4>
                    <div class="bell-info-wrap">
                        <button class="bell-info blink">Close</button>
                        <p>
                            <a href="/profile/{{ $model->profile->user_id }}/map">Klosterbergestraße 17 39104&nbsp;Magdeburg</a><br>
                            <span></span>
                            <span class="working-hours">Non Stop</span>
                        </p>
                    </div>
                </div>

            </article>
        @endforeach
    </div>


    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer-scripts')

    <link rel="stylesheet" type="text/css" href="{!! url('assets/vendor/photoswipe/photoswipe.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! url('assets/vendor/photoswipe/default-skin/default-skin.css') !!}">

    <script type="text/javascript" src="{!! url('assets/vendor/photoswipe/photoswipe.min.js') !!}"></script>
    <script type="text/javascript" src="{!! url('assets/vendor/photoswipe/photoswipe-ui-default.min.js') !!}"></script>

    <script type="text/javascript">
        var pswpElement = document.querySelectorAll('.pswp')[0];

        $('.gallery .thmb').click(function(){
            var items = new Array();
            var start_index = 0;
            var clicked = $(this);
            $('.gallery .thmb').each(function(i, e){
                items.push({
                    src: $(e).attr('data-img'),
                    w: $(e).attr('data-w'),
                    h: $(e).attr('data-h')
                });
                if($(e).attr('data-img') == clicked.attr('data-img')){
                    start_index = i;
                }
            });
            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, {index: start_index});
            gallery.init();
        });

    </script>
@endsection 