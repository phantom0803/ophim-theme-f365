@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

@include('themes::themef365.inc.hearder.mobile_header')
@include('themes::themef365.inc.hearder.desktop_header')
