@extends('themes::themef365.layout')

@php
$years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
    return \Ophim\Core\Models\Movie::select('publish_year')
        ->distinct()
        ->pluck('publish_year')
        ->sortDesc();
});
@endphp

@section('breadcrumb')
@endsection

@section('content')
    <div class="block-film">
        <h2 class="caption">
            <i class="fa fa-plus-square" aria-hidden="true"></i> <span>{{$section_name}}</span>
            <i class="fa fa-caret-right" aria-hidden="true"></i>
            </a>
        </h2>
        @include('themes::themef365.inc.catalog_filter')
        <ul class="list-film">
            @foreach ($data as $movie)
                @include('themes::themef365.inc.block_film.block_thumb_item')
            @endforeach
        </ul>
        <div class="clear"></div>
        {{ $data->appends(request()->all())->links("themes::themef365.inc.pagination") }}
    </div>
@endsection
