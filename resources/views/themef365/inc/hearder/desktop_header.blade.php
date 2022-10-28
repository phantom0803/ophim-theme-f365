<div id="header" class="only-pc">
    <div class="container">
        <a class="logo" href="/" title="{{$title}}">
            @if ($logo)
                {!! $logo !!}
            @else
                {!! $brand !!}
            @endif
        </a>
        <div class="search-container relative">
            <form method="GET" action="/" class="form-search">
                <input id="keyword" type="text" name="search" placeholder="Tìm kiếm phim..." value="{{ request('search') }}" />
                <i class="fa fa-search" onclick="$(this).parent().submit()" style="cursor:pointer"></i>
            </form>
        </div>
    </div>
</div>
<div id="main-menu" class="desktop">
    <div class="container">
        <ul>
            <li class="menu-home">
                <a href="/" title="Trang chủ">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            @foreach ($menu as $item)
                @if (count($item['children']))
                    <li>
                        <a href="javascript:void(0)" title="{{$item['name']}}">
                            <i class="fa fa-clone"></i> <span>{{$item['name']}} <i class="fa fa-caret-down"></i></span>
                        </a>
                        <ul class="sub-menu span-2 absolute">
                            @foreach ($item['children'] as $children)
                                <li class="sub-menu-item"><a href="{{$children['link']}}">{{$children['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{$item['link']}}" title="{{$item['name']}}">
                            <i class="fa fa-film"></i><span>{{$item['name']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
