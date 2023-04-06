@extends('themes::themef365.layout')

@php
    use Ophim\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(get_theme_option('recommendations_limit', 10))
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $limit, $link, $template] = array_merge($list, ['Phim mới cập nhật', '', 'type', 'series', 8, '/', 'block_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->limit($limit)
                            ->orderBy('updated_at', 'desc')
                            ->get(),
                        'link' => $link ?: '#',
                    ];
                } catch (\Exception $e) {
                }
            }
        }
        return $data;
    });

@endphp

@section('slider_recommended')
    @include('themes::themef365.inc.slider_recommended')
@endsection

@section('content')
    <div style="box-shadow: 0px 3px 20px 2px rgb(18 24 29);">
        <ul id="top-slide" class="owl-carousel owl-theme" style="opacity: 1; display: block; margin-top: 10px;">
            @foreach ($recommendations as $movie)
                <li>
                    <a title="{{$movie->name}}" href="{{$movie->getUrl()}}">
                        <div class="title">
                            <p class="effect-text"
                                style="text-transform: uppercase!important;color: #fff;font-size: 11px;padding: 2px 4px 2px;color: #fff;margin-left: 3px;font-weight: 500;color: #fff;background: linear-gradient( 81.43deg , #c11e1b -26.81%, #6f0c0b 87.89%);box-shadow: 2px 2px 3px 0px rgb(0 0 0 / 75%);border: 0px solid #febb00; border-radius: 2px;white-space: nowrap;">
                                <i class="fa fa-play-circle" aria-hidden="true"></i> {{$movie->episode_current}} {{$movie->language}} {{$movie->quality}}
                            </p>
                            <p class="name" style="text-transform: uppercase!important;">{{$movie->name}}</p>
                            <p class="real-name">{{$movie->origin_name}} {{$movie->publish_year}}</p>
                        </div>
                        <img src="{{$movie->getPosterUrl()}}"
                            alt="{{$movie->name}}">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @foreach ($data as $item)
        @include('themes::themef365.inc.block_film.' . $item['template'])
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('/themes/f365/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('/themes/f365/js/customize.js') }}"></script>
@endpush
