<div class="block-film">
    <h2 class="caption">
        <i class="fa fa-plus-square" aria-hidden="true"></i> <span>{{$item['label']}}</span>
        <i class="fa fa-caret-right" aria-hidden="true"></i>
        <a class="view-all" title="{{$item['label']}}" href="{{$item['link']}}">Xem tất cả <i
                class="fa fa-angle-double-right"></i>
        </a>
    </h2>

    <ul class="list-film">
        @foreach ($item['data'] as $movie)
            @include('themes::themef365.inc.block_film.block_thumb_item')
        @endforeach
    </ul>
</div>

