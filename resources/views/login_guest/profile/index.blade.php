@extends('profile_login')

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
                {{--{{dd(Auth::user()->favorite)}}--}}
                @if(!empty(Auth::user())  &&  Auth::user()->roles[0]->name=="login")

                        @if($addfavorite)
                            <a href="#" id="favorite" class="btn btn-edit btn-white"><i class="fa fa-pencil-square"></i> {{"Add Favorite"  }}</a>
                        @endif
                @endif

                <h2 class="profile-name">{{ $profile->name }}, {{ $profile->age }}</h2>
                <h4 style="margin-top: -12px;">{!! Languages::fromArrayOrNull($profile->about_short) !!}</h4>


                <div class="profile-location"><i class="fa fa-mobile"></i> {{ $profile->cellphone }}</div>
                <div class="profile-location mb10"><i class="fa">@</i> {{ $profile->contact_email }}</div>
                <p class="mb20">
                    {!! Languages::fromArrayOrNull($profile->about_full) !!}
                </p>
            </div>

            <ul class="nav nav-tabs nav-justified nav-profile">
                <li class="active"><a href="#info" data-toggle="tab"><strong>{{ Languages::trans('admin.navigation.profile') }}</strong></a></li>
                <li><a href="#services" data-toggle="tab"><strong>{{ Languages::trans('admin.navigation.services') }}</strong></a></li>
                <li><a href="#schedule" data-toggle="tab"><strong>{{ Languages::trans('admin.navigation.schedule') }}</strong></a></li>
                <li><a href="#gallery" data-toggle="tab"><strong>{{ Languages::trans('admin.navigation.gallery') }}</strong></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="info">
                    <div class="clearfix mb15">

                    </div>
                    <div class="well">
                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <td>{{ Languages::trans('model.profile.haircolor') }}</td>
                                <td>{{ Languages::trans('model.haircolors.'.$profile->haircolor) }}</td>
                            </tr>

                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>

                            <tr>
                                <td>{{ Languages::trans('model.profile.age') }}</td>
                                <td>{{ $profile->age }}</td>
                            </tr>
                            <tr>
                                <td>{{ Languages::trans('model.profile.weight') }}</td>
                                <td>{{ $profile->weight }}</td>
                            </tr>
                            <tr>
                                <td>{{ Languages::trans('model.profile.height') }}</td>
                                <td>{{ $profile->height }}</td>
                            </tr>
                            <tr>
                                <td>{{ Languages::trans('model.profile.breast') }}</td>
                                <td>{{ $profile->breast_number }}{{ $profile->breast_letter }}</td>
                            </tr>
                            <tr>
                                <td>{{ Languages::trans('model.profile.intimicy') }}</td>
                                <td>{{ Languages::trans('model.intimicy.'.$profile->intimicy) }}</td>
                            </tr>

                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>

                            <tr>
                                <td>{{ Languages::trans('model.profile.smoke') }}</td>
                                <td>{{ $profile->smoke }}</td>
                            </tr>
                            <tr>
                                <td>{{ Languages::trans('model.profile.drink') }}</td>
                                <td>{{ $profile->drink }}</td>
                            </tr>

                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>

                            <tr>
                                <td>{{ Languages::trans('model.profile.nationality') }}</td>
                                <td>{{ $profile->nationality }}</td>
                            </tr>
                            <tr>
                                <td>{{ Languages::trans('model.profile.languages') }}</td>
                                <td>{!! $profile->printLanguages() !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="services">
                    <div class="clearfix mb15">
                        {{--<a href="{!! url('profile/'.$profile->id.'/services') !!}" class="btn btn-white pull-right"><i class="fa fa-cubes"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('model.profile.edit_services') }}</a>--}}
                    </div>
                    <div class="well">
                        @foreach(App\Service::all() as $service)
                            <div class="mb15">
                                @if($profile->hasService($service->id))
                                    <i class="text-success fa fa-check-circle"></i>
                                @else
                                    <i class="text-danger fa fa-circle"></i>
                                @endif
                                &nbsp;&nbsp;&nbsp;
                                {{ $service->printName() }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane" id="schedule">
                    <div class="clearfix mb15">
{{--                        <a href="{!! url('profile/'.$profile->id.'/schedule') !!}" class="btn btn-white pull-right"><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('model.profile.edit_schedule') }}</a>--}}
                    </div>
                    <div class="well">
                        @foreach( $profile->schedules as $schedule )
                            <div class="mb15">
                                <strong class="text-success">{{ $schedule->date_from }} - {{ $schedule->date_to }}</strong><br>
                                @foreach($schedule->days as $day)
                                    <span style="display: inline-block;width: 6em;">{{ $day['names'] }}</span>{{ $day['from'] }} - {{ $day['to'] }}<br>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane" id="gallery">
                    <div class="clearfix mb15">
{{--                        <a href="{!! url('profile/'.$profile->id.'/gallery') !!}" class="btn btn-white pull-right"><i class="fa fa-th"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('model.profile.manage_images') }}</a>--}}
                    </div>
                    <div class="gallery row">
                        @foreach($profile->images as $image)
                            <div class="col-xs-6 col-sm-4 col-md-3 mb15 image">
                                <div class="thmb" data-img="{!! $image->url !!}" data-w="{!! $image->width !!}" data-h="{!! $image->height !!}" style="background: url('{!! $image->url !!}') center center no-repeat #E4E7EA; border-radius: 5px; width: 100%; height: 120px; background-size: contain; cursor: pointer;"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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

        $('#favorite').on('click', function () {

            var url_arr = window.location.pathname.split( '/' );
            var id = url_arr[2];
            $.ajax({
                method: 'POST',
                url: '/add-favorite',
                data: {'id': id},
                success: function(response){

                   if(response.success){
                       location.reload();
                   }
                    else {
                       console.log(456);
                   }

                }
            });

        });


    </script>
@endsection