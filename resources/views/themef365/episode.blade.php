@extends('themes::themef365.layout')

@section('content')
    <div class="">
        <div class="box-player" id="box-player" style="margin-top: 10px;">
            <div id="player_message" style="display:none;"></div>
            <div id="media-player">
            </div>
        </div>
        <span class="button-watch" id="btn_report" title="Báo lỗi phim" style="float: left;"> <i class="fa fa-bug"></i> Báo lỗi
            phim</span>

        <span class="button-watch" id="btn_lightbulb" title="Chế Độ Rạp Phim"> <i class="fa fa-lightbulb-o"
                style="margin-right: 5px;"></i></span>

        <div class="button-watch  btn-report">
            <span><i class="fa fa-eye" aria-hidden="true"></i> {{ $currentMovie->view_total }} Lượt xem </span>
        </div>

        <div class="clear"></div>
        <div class="list-server" id="list-server">
            <div class="server-item">
                <div class="name col-lg-2 col-md-2 col-sm-4 col-xs-4 " style="max-width: 60px;">
                    <span class="tags-item-info"><i class="fa fa-database"></i> Server</span>
                </div>
                <span style="padding:0px;">
                    @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                        <span onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}"
                            data-id="{{ $server->id }}" data-link="{{ $server->link }}"
                            class="streaming-server btn btn-sm btn-success" data-index="0">
                            <span class="link_playing" style="display: none;">
                                <i class="fa fa-cog fa-spin fa-3x fa-fw margin-bottom"
                                    style="font-size: 13px;margin-left: -3px;"></i>
                            </span>
                            VIP #{{ $loop->index + 1 }}
                        </span>
                    @endforeach
                </span>
            </div>
        </div>
        <div class="clear"></div>

        <!-- xx -->
        <div class="details">
            <div class="control-box">
                <div class="box">
                    <div class="box-body">
                        <li class="list-item" style="padding: 0;">

                            <div class="col-xs-12 col-sm-10 p-a-0 ">
                                <a href="{{ $currentMovie->getUrl() }}" class="text-primary">
                                    <h1 class="film-title text-uppercase" style="margin-bottom: 0">{{ $currentMovie->name }}
                                    </h1>
                                </a>
                                <h2 class="text-muted film-title" style="color: #B3B3B3;">{{ $currentMovie->origin_name }}
                                    ({{ $currentMovie->publish_year }})</h2>
                                <div class="p-2">
                                    <div class="tags-info"
                                        style="margin-top: 10px;border-bottom: 1px solid rgba(255,255,255,.1);border-top: 1px solid rgba(255,255,255,.1);">
                                        <span class="dd1"><i class="imdb-icon"></i> N/A</span>
                                        <span class="tags-item-info" style="color: #fff;">
                                            @foreach ($currentMovie->regions as $region)
                                                <a href="{{ $region->getUrl() }}"
                                                    title="{{ $region->name }}">{{ $region->name }}</a>
                                            @endforeach
                                        </span>
                                        <span class="tags-item-info" style="color: #fff;">
                                            {{ $currentMovie->publish_year }}
                                        </span>
                                        <span
                                            class="tags-item-info">{{ !strpos(strtolower($episode->name), 'tập') ? 'Tập ' . $episode->name : $episode->name }}</span>
                                    </div>
                                </div>


                                <div class="review-body limit"
                                    style="box-shadow: 0px 3px 20px 2px rgb(14 51 82);padding: 5px 8px;/* margin: 5px 0 20px 0; */line-height: 24px;font-size: 14px;color: #BBB;">
                                    <p>
                                    <p>
                                        {!! $currentMovie->content !!}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>
                <div class="box-rating">
                    <div class="rate-title">
                        <span class="rate-lable"></span>
                    </div>
                    <div id="star" data-score="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"
                        style="cursor: pointer;">
                    </div><br />
                    <div>
                        <div id="div_average" style="float: left; line-height: 16px; margin: 0 5px;margin-top: 5px; ">
                            <span class="average" id="average" itemprop="ratingValue">
                                {{ number_format($currentMovie->rating_star ?? 0, 1) }}
                            </span>
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <span id="rate_count" itemprop="reviewCount">{{ $currentMovie->rating_count ?? 0 }}</span> lượt
                            đánh giá
                        </div>
                        <span id="hint"></span>
                        <meta itemprop="bestRating" content="10" />
                        <meta itemprop="worstRating" content="1" />
                        <meta itemprop="ratingValue" content="{{ number_format($currentMovie->rating_star ?? 0, 1) }}" />
                        <meta itemprop="ratingCount" content="{{ $currentMovie->rating_count ?? 0 }}" />
                    </div>
                </div>
            </div>

            <div class="control-box clear">
                <div class="clear"></div>
                @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                    <div class="episodes" style="padding: 5px 2px;margin: 5px 0 10px 0;">
                        <div class="caption">
                            <span style="margin-top: 20px;border-bottom: 1px solid rgba(255,255,255,.1);line-height: 25px;padding: 10px 0;text-transform: uppercase;background: rgba(54, 71, 86, 0.13);">
                            <i class="fa fa-youtube-play"></i> DANH SÁCH TẬP: {{$server}} <i class="fa fa-angle-down"></i> </span>
                        </div>
                        <ul class="list-episode" id="list_episodes">
                            @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
									<li><a href="{{ $item->sortByDesc('type')->first()->getUrl() }}"
											title="{{ $name }}" class="@if ($item->contains($episode)) current @endif">{{ $name }}</a></li>
							@endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="clear"></div>
        </div>
        <!-- xx -->

        <div class="bottom-content" style="margin-top: 5px;">
            <div class="block-film" id="film-trailer">
                <p class="caption"><i class="fa fa-facebook-square" aria-hidden="true"></i>Bình
                    Luận Facebook</p>
                <div class="box-comment" id="tabs-facebook" style="background: linear-gradient(to right, #ffff, #ffff);">
                    <div class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="670"
                        data-numposts="10" data-order-by="reverse_time" data-colorscheme="light">
                    </div>
                </div>
            </div>
        </div>
        <!-- xx -->

        <div class="block-film " style="margin-top: 10px;">
            <h2 class="caption"><span>Có Thể Bạn Thích</span> </h2>
            <ul id="film_related" class="list-film block_slider">
                @foreach ($movie_related as $movie)
                    @include('themes::themef365.inc.block_film.block_thumb_item')
                @endforeach
            </ul>
        </div>
        <style>
            .tags1,
            .keywords1 {
                display: none;
            }
        </style>
        <div class="clear"></div>
        <div class="tags" style="margin-top: 10px;}">
            <label>
                <i class="fa fa-tags"></i> Từ khóa <i class="fa fa-caret-right"></i>
            </label>
            @foreach ($currentMovie->tags as $tag)
                <li class="tag-item">
                    <h2>
                        <a href="{{ $tag->getUrl() }}" rel="follow, index"
                            title="{{ $tag->name }}">{{ $tag->name }}
                        </a>
                    </h2>
                </li>
            @endforeach
        </div>
        <div class="clear"></div>
    </div>
@endsection

@push('scripts')
    <script src="/themes/f365/js/owl.carousel.js"></script>
    <script src="{{ asset('/themes/f365/js/customize.js') }}"></script>

    <script src="/themes/f365/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/f365/player/js/p2p-media-loader-hlsjs.min.js"></script>
    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('#box-player').offset().top
            }, 'slow');
        });
    </script>

    <script>
        var episode_id = {{$episode->id}};
        const wrapper = document.getElementById('media-player');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('disabled');
                server.classList.remove('btn-danger');
                server.getElementsByClassName('link_playing')[0].style.display = "none";
            })
            el.classList.add('disabled');
            el.classList.add('btn-danger');
            el.getElementsByClassName('link_playing')[0].style.display = "inline-block";

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        height: "100%",
                        file: "/themes/bptv/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    height: "100%",
                    image: "{{ $currentMovie->poster_url ?: $currentMovie->thumb_url }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{$episode->id}}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

    <script>
        $("#btn_report").click(() => {
            fetch("{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    message: ''
                })
            });
            $("#btn_report").remove();
        })
    </script>

    <script>
        var rated = false;
        $('#star').raty({
            score: {{ number_format($currentMovie->rating_star ?? 0, 1) }},
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
