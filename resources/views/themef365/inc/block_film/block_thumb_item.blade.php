<li class="film-item no-margin-right">
    <span class="current-status" style="text-transform: uppercase;font-weight: 500;"><i
            class="fa fa-play-circle" aria-hidden="true"></i> {{ $movie->episode_current }}</span>
    <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}">
        <img alt="{{ $movie->name }}" src="{{ $movie->thumb_url }}" />
        <div class="title">
            <div class="post-title">
                <span class="label-quality">{{ $movie->language }}</span>
                <p class="name">{{ $movie->name }}</p>
                <p class="real-name">{{ $movie->origin_name }} ({{ $movie->publish_year }})</p>
            </div>
        </div>
    </a>
</li>
