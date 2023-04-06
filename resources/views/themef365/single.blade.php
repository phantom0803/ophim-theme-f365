@extends('themes::themef365.layout')

@php
    $watchUrl = "#";
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '')
        $watchUrl = $currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server')->first()->sortByDesc('name', SORT_NATURAL)->groupBy('name')->last()->sortByDesc('type')->first()->getUrl();

@endphp

@section('content')
    <div class="film-info">
        <div class="poster">
            <a href="{{$watchUrl}}">
                <img alt="{{$currentMovie->name}}"
                    src="{{$currentMovie->getThumbUrl()}}" />
            </a>
            <ul class="buttons">
                @if ($currentMovie->trailer_url)
                    <li>
                        <a class="popup-youtube btn btn-trailer btn-success" href="{{$currentMovie->trailer_url}}">
                            <i class="fa fa-forward"></i> Trailer
                        </a>
                    </li>
                @endif
                <li>
                    <a class="btn-see btn btn-danger" href="{{$watchUrl}}">
                        <i class="fa fa-play-circle-o"></i> Xem Phim
                    </a>
                </li>
            </ul>
        </div>
        <h1 class="name"
            style="font-weight: 700; padding: 5px 0 0;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;margin: 0 0 5px;font-family: Tahoma;line-height: 1.6em; text-transform: uppercase;font: 20px utmcafetaregular; color: #ff9601;display: block;">
            {{$currentMovie->name}} </h1>
        <h2 class="real-name"
            style="font-family: inherit;font-weight: 300;line-height: 1.1;color: #ccc;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">
            {{$currentMovie->origin_name}} ({{$currentMovie->publish_year}}) </h2>

        <div class="p-2">
            <div class="tags-info"
                style="border-bottom: 1px solid rgba(255,255,255,.1);border-top: 1px solid rgba(255,255,255,.1);">
                <span class="dd1"><i class="imdb-icon"></i> N/A</span>
                <span class="tags-item-info" style="color: #fff;">
                    @foreach ($currentMovie->regions as $region)
                        <a href="{{$region->getUrl()}}" title="{{$region->name}}">{{$region->name}}</a>
                    @endforeach
                </span>
                <span class="tags-item-info" style="color: #fff;">
                    {{$currentMovie->publish_year}}
                </span>
                <span class="tags-item-info">{{ !strpos(strtolower($currentMovie->episode_total), 'tập') ? $currentMovie->episode_total . ' Tập' : $currentMovie->episode_total}}</span>
            </div>

            <ul class="meta-data" style="color: #BBB;">
                <label><i class="fa fa-check"></i> Trạng thái :</label>
                <strong
                    style="color: #fff;font-size: 11px;padding: 2px 4px 2px;color: #fff;margin-left: 3px;font-weight: 500;color: #febb00;border: 1px solid #febb00; border-radius: 5px;white-space: nowrap;">
                    <i class="fa fa-play-circle" aria-hidden="true"></i>
                    {{$currentMovie->episode_current}}
                </strong>
                </li>
                <li>
                    <label><i class="fa fa-check"></i> Chất Lượng :</label>
                    <strong>{{$currentMovie->quality}} {{$currentMovie->language}}</strong>
                </li>
                <li>
                    <label><i class="fa fa-user" aria-hidden="true"></i> Đạo diễn :</label>
                    {!! $currentMovie->directors->map(function ($director) {
                        return '<a href="' .
                            $director->getUrl() .
                            '" tite="Đạo diễn ' .
                            $director->name .
                            '">' .
                            $director->name .
                            '</a>';
                    })->implode(', ') !!}
                </li>
                <li>
                    <label><i class="fa fa-user" aria-hidden="true"></i> Diễn viên :</label>
                    {!! $currentMovie->actors->map(function ($actor) {
                        return '<a href="' .
                            $actor->getUrl() .
                            '" tite="Diễn viên ' .
                            $actor->name .
                            '">' .
                            $actor->name .
                            '</a>';
                    })->implode(', ') !!}
                </li>
                <li>
                    <label><i class="app-menu__icon fa fa-archive"></i> Thể loại : </label>
                    {!! $currentMovie->categories->map(function ($category) {
                        return '<a href="' .
                            $category->getUrl() .
                            '" tite="Đạo diễn ' .
                            $category->name .
                            '">' .
                            $category->name .
                            '</a>';
                    })->implode(', ') !!}
                </li>
                <li>
                    <label><i class="fa fa-clock-o" aria-hidden="true"></i> Thời lượng :</label>
                    <span>{{$currentMovie->episode_time ?? "N/A"}}</span>
                </li>
                <li>
                    <label><i class="fa fa-eye" aria-hidden="true"></i> Lượt xem :</label>
                    <span>{{$currentMovie->view_total}} views</span>
                </li>
                <li>
                    <div class="sbox">
                        <div class="dt_social_single"><a data-id="{{$currentMovie->id}}" rel="nofollow" href="javascript: void(0);"
                                onclick="window.open(&quot;https://facebook.com/sharer.php?u={{$currentMovie->getUrl()}}&quot;,&quot;facebook&quot;,&quot;toolbar=0, status=0, width=650, height=450&quot;)"
                                class="facebook dt_social" style="color: #fbfbfb;"><b>Facebook</b></a><a data-id="{{$currentMovie->id}}"
                                rel="nofollow" href="javascript: void(0);"
                                onclick="window.open(&quot;https://twitter.com/intent/tweet?text={{$currentMovie->name}}&amp;url={{$currentMovie->getUrl()}}&quot;,&quot;twitter&quot;,&quot;toolbar=0, status=0, width=650, height=450&quot;)"
                                data-rurl="{{$currentMovie->getUrl()}}" class="twitter dt_social"
                                style="color: #fbfbfb;"><b>Twitter</b></a><a data-id="{{$currentMovie->id}}" rel="nofollow"
                                href="javascript: void(0);"
                                onclick="window.open(&quot;https://pinterest.com/pin/create/button/?url={{$currentMovie->getUrl()}}&amp;media={{$currentMovie->getThumbUrl()}}&amp;description={{$currentMovie->name}}&quot;,&quot;pinterest&quot;,&quot;toolbar=0, status=0, width=650, height=450&quot;)"
                                class="pinterest dt_social" style="color: #fbfbfb;"><b>Pinterest</b></a><a data-id="{{$currentMovie->id}}"
                                rel="nofollow" href="javascript: void(0);"
                                onclick="window.open(&quot;https://telegram.me/share/url?url={{$currentMovie->getUrl()}}&amp;media={{$currentMovie->getThumbUrl()}}&amp;description={{$currentMovie->name}}&quot;,&quot;telegram&quot;,&quot;toolbar=0, status=0, width=650, height=450&quot;)"
                                class="telagram dt_social" style="color: #fbfbfb;"><b>Telegram</b></a></div>
                    </div>
                </li>
                <li>
                    <div class="box-rating">
                        <div class="rate-title">
                            <span class="rate-lable"></span>
                        </div>
                        <div id="star" data-score="{{$currentMovie->getRatingStar()}}" style="cursor: pointer;">
                        </div>
                        <div>
                            <div id="div_average" style="float: left; line-height: 16px; margin: 0 5px;margin-top: 5px; ">
                                <span class="average" id="average" itemprop="ratingValue">
                                    {{$currentMovie->getRatingStar()}}
                                </span>
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                <span id="rate_count" itemprop="reviewCount">{{$currentMovie->getRatingCount()}}</span> lượt đánh giá
                            </div>
                            <span id="hint"></span>
                            <meta itemprop="bestRating" content="10" />
                            <meta itemprop="worstRating" content="1" />
                            <meta itemprop="ratingValue" content="{{$currentMovie->getRatingStar()}}" />
                            <meta itemprop="ratingCount" content="{{$currentMovie->getRatingCount()}}" />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="block-film" id="film-trailer">
        <p class="caption"> <i class="app-menu__icon  fa fa-pencil-square-o" aria-hidden="true"></i> Nội dung phim
        </p>
        <div class="film-content" style="padding: 5px 8px;margin: 0px 0 5px 0;font-size: 14px;color: #BBB;">
            @if ($currentMovie->content)
                {!! $currentMovie->content !!}
            @else
                <p>Hãy xem phim để cảm nhận...</p>
            @endif
            @if ($currentMovie->poster_url)
                <p><img alt="" src="{{$currentMovie->getPosterUrl()}}" /></p>
            @endif
        </div>
    </div>
    <div class="block-film" id="film-trailer">
        <p class="caption"><i class="fa fa-facebook-square" aria-hidden="true"></i>Bình Luận Facebook</p>
        <div class="box-comment" id="tabs-facebook" style="background: linear-gradient(to right, #ffff, #ffff);">
            <div class="fb-comments" data-href="{{$currentMovie->getUrl()}}" data-width="670"
                data-numposts="10" data-order-by="reverse_time" data-colorscheme="light">
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="tags" style="margin-top: 10px;}">
        <label>
            <i class="fa fa-tags"></i> Từ khóa <i class="fa fa-caret-right"></i>
        </label>
        @foreach ($currentMovie->tags as $tag)
            <li class="tag-item">
                <h2>
                    <a href="{{$tag->getUrl()}}" rel="follow, index" title="{{$tag->name}}">{{$tag->name}}
                    </a>
                </h2>
            </li>
        @endforeach
    </div>
    <div class="clear"></div>
@endsection

@push('scripts')

    <script type="text/javascript" src="{{ asset('/themes/f365/js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/f365/js/popup.youtube.js') }}"></script>

    <script>
        var rated = false;
        $('#star').raty({
            score: {{$currentMovie->getRatingStar()}},
            number: 10,
            numberMax: 10,
            hints: ['quá tệ', 'tệ', 'không hay', 'không hay lắm', 'bình thường', 'xem được', 'có vẻ hay', 'hay',
                'rất hay', 'siêu phẩm'
            ],
            starOff: '/themes/f365/images/star-off-20.png',
            starOn: '/themes/f365/images/star-on-20.png',
            starHalf: '/themes/f365/images/star-half-20.png',
            click: function(score, evt) {
                if (rated) return
                fetch("{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]')
                            .getAttribute(
                                'content')
                    },
                    body: JSON.stringify({
                        rating: score
                    })
                }).then((response) => response.json()).then((data) => {
                    $('#rate_count').html(data.rating_count);
                    $('#average').html(data.rating_star);
                    rated = true;
                    $('#star').data('raty').readOnly(true);
                });
            }
        });
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
