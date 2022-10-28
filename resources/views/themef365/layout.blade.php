@extends('themes::layout')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4, 'top_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/f365/css/bootstrap.minmod.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css?v=16661691001.1" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/f365/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/f365/css/updet.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/f365/css/responsivemod.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/f365/css/owl.carouselmod.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/f365/css/magnific-popup.css') }}">
@endpush

@section('body')
    @include('themes::themef365.inc.header')
    <div id="main-content">
        <div id="content">
            <div class="container ">
                @yield('slider_recommended')
                <div class="container " id="wrapper">
                    <div class="left-content" style="padding-left: 10px;padding-right: 10px;">
                        @yield('content')
                    </div>
                    <div class="right-content" style="padding-left: 10px;padding-right: 10px;">
                        @include('themes::themef365.inc.aside')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.aside_star').raty({
                readOnly: true,
                numberMax: 5,
                half: true,
                starOff: '/themes/f365/images/star-off-20.png',
                starOn: '/themes/f365/images/star-on-20.png',
                starHalf: '/themes/f365/images/star-half-20.png',
                score: function() {
                    return $(this).attr('data-rating');
                },
                space: false
            });
        });

        var $menu = $("#main-menu");
        var $over_lay = $('#overlay_menu');
        var hw = $(window).height();

        function set_height_menu() {
            var w_scroll_top = $(window).scrollTop();
            if (w_scroll_top >= 50) {
                pos_top_menu = 0;
            } else {
                pos_top_menu = 50 - w_scroll_top;
            }
            $menu.css('top', pos_top_menu + 'px');
            $("#overlay_menu").css('top', pos_top_menu + 'px');
        }

        function open_menu() {
            $menu.height(hw);
            $menu.addClass('expanded');
            set_height_menu();
            $("#overlay_menu").removeClass('hide');
            $('body,html').addClass('overlow-hidden');
            $(".btn-humber").addClass('active');

        }

        function close_menu() {
            $menu.removeClass('expanded');
            var w_scroll_top = $(window).scrollTop();
            if (w_scroll_top >= 50) {
                pos_top_menu = 0;
            } else {
                pos_top_menu = w_scroll_top;
            }
            set_height_menu();
            $("#overlay_menu").addClass('hide');
            $('body,html').removeClass('overlow-hidden');
            $(".btn-humber").removeClass('active');
        }

        $(document).ready(function() {
            //Xử lý khi ấn vào nút menu
            $(".btn-humber").click(function() {
                if ($menu.hasClass('expanded')) {
                    close_menu();
                } else {
                    open_menu();
                }
            });


            //Xu ly khi vuot tren man hinh
            /*
            $("#content").swipe({
                swipeRight:function(event, direction, distance, duration, fingerCount){
                    open_menu();
                },
                threshold:20,
                fingers:'all',
            });
            $("#overlay_menu").swipe({
                swipeLeft:function(event, direction, distance, duration, fingerCount){
                    close_menu();
                },
                threshold:10,
                fingers:'all',
            });
            */

            $(window).scroll(function() {
                set_height_menu();
            });

            $(".parent-menu").click(function() {
                $this = $(this);
                $arrow = $this.find('.fa-expand');
                if ($arrow.hasClass('fa-angle-down')) {
                    $arrow.removeClass('fa-angle-down').addClass('fa-angle-up');
                } else {
                    $arrow.addClass('fa-angle-down').removeClass('fa-angle-up');
                }
                $this.find('.sub-menu').toggle();
            });

        });
    </script>
@endpush

@section('footer')
    {!! get_theme_option('footer') !!}

    <script type="text/javascript" src="{{ asset('/themes/f365/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/f365/js/jquery.lazyload.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/f365/js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/f365/js/actions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/f365/plugins/jquery-raty/jquery.raty.js') }}"></script>

    {!! setting('site_scripts_google_analytics') !!}
@endsection
