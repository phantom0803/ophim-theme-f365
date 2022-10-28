<div id="header" class="mobile-header">
    <div class="btn-humber">
        <i class="fa fa-bars"></i>
    </div>
    <a class="logo" href="/" title="{{$title}}">
        @if ($logo)
            {!! $logo !!}
        @else
            {!! $brand !!}
        @endif
    </a>
    <i class="fa fa-search btn-search" onclick="$('.mobile-search-bar').removeClass('hide');$('#keyword').focus();"></i>

    <div class="mobile-search-bar hide">
        <form method="GET" action="/" id="form_search">
            <input id="keyword" type="text" name="search" placeholder="Tìm kiếm phim..." value="{{ request('search') }}">
        </form>
        <i class="fa fa-search mobile-search-submit" onclick="$('#form_search_mobile').submit()"></i>
        <i class="fa fa-times close-button" onclick="$('.mobile-search-bar').addClass('hide')"></i>
    </div>
</div>
<div id="main-menu" class="mobile-main-menu" style="height: 667px; top: 50px;">
    <div class="container">
        <ul>
            @foreach ($menu as $item)
                @if (count($item['children']))
                    <li class="parent-menu">
                        <a href="javascript:void(0)" title="{{$item['name']}}">
                            <i class="fa fa-clone"></i>
                            <span>{{$item['name']}}</span>
                            <i class="fa fa-expand fa-angle-down"></i>
                        </a>
                        <ul class="sub-menu">
                            @foreach ($item['children'] as $children)
                                <li class="sub-menu-item"><a href="{{$children['link']}}">{{$children['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{$item['link']}}" title="{{$item['name']}}"><i
                                class="fa fa-film"></i><span>{{$item['name']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
