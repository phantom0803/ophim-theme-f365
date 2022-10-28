<?php

namespace Ophim\ThemeF365;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeF365ServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/f365')
        ], 'f365-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'f365' => [
                'name' => 'Theme F365',
                'author' => 'opdlnf01@gmail.com',
                'package_name' => 'ophimcms/theme-f365',
                'publishes' => ['f365-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommendations Limit',
                        'type' => 'number',
                        'hint' => 'Number',
                        'value' => 10,
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (block_thumb|block_slider)',
                        'value' => "Phim bộ mới||type|series|8|/danh-sach/phim-bo|block_thumb\r\nPhim lẻ mới||type|single|8|/danh-sach/phim-bo|block_slider\r\nPhim lẻ mới||type|single|8|/danh-sach/phim-bo|block_thumb\r\nPhim lẻ mới||type|single|8|/danh-sach/phim-bo|block_slider",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit',
                        'value' => "Top phim lẻ||type|single|view_total|desc|9\r\nTop phim bộ||type|series|view_total|desc|9",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div id="footer" style="margin-top: 25px;">
                            <div class="container">
                                <div class="content">
                                    <div class="views-row views-row-1" style="width: 100%;text-align: center;">
                                        <div class="logo-footer">
                                            <a href=""><img alt="logo" style="width: 146px;"
                                                    src="/themes/f365/images/logo.svg" /></a>
                                        </div>
                                        <div class="copy-right">
                                            <p>Copyright ® 2021 OPHIMCMS All Rights Reserved.</p>
                                            <p><a href="/sitemap.xml">Sitemap</a> | <a href="{{ route('post.contact')}}">Liên hệ</a> | <a
                                                    href="/danh-sach/phim-moi.html">Phim Mới </a> | <a href="" target="_blank"
                                                    title="">Phim Hay </a></p><br>
                                        </div>
                                        <div class="hidden-sm hidden-xs">
                                            <ul class="tags" style="list-style: none;">
                                                <li class="tag-item"><a href="/tag/diep-van.html" rel="nofollow"
                                                        title="Diệp Vấn">Diệp Vấn</a></li>
                                                <li class="tag-item"><a href="/tag/spider-man.html" rel="nofollow"
                                                        title="Spider-Man">Spider-Man</a></li>
                                                <li class="tag-item"><a href="/tag/tvb-sctv9.html" rel="nofollow"
                                                        title="TVB-SCTV9">TVB-SCTV9</a></li>
                                                <li class="tag-item"><a href="/tag/marvel.html" rel="nofollow"
                                                        title="Marvel">Marvel</a></li>
                                                <li class="tag-item"><a href="/tag/di-nhan.html" rel="nofollow"
                                                        title="Dị Nhân">Dị Nhân</a></li>
                                                <li class="tag-item"><a href="/tag/x-men.html" rel="nofollow"
                                                        title="X Men">X Men</a></li>
                                                <li class="tag-item"><a href="/tag/one-piece.html" rel="nofollow"
                                                        title="One Piece">One Piece</a></li>
                                                <li class="tag-item"><a href="/tag/friday-the-13th.html" rel="nofollow"
                                                        title="Friday The 13th">Friday The 13th</a></li>
                                                <li class="tag-item"><a href="/tag/paranormal-activity.html"
                                                        rel="nofollow" title="Paranormal Activity">Paranormal Activity</a></li>
                                                <li class="tag-item"><a href="/tag/luoi-cua.html" rel="nofollow"
                                                        title="Lưỡi Cưa">Lưỡi Cưa</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
