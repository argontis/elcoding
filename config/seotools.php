<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => 'Elcoding - Software House & IT Training Center', // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Elcoding adalah Software House profesional dan pusat Pelatihan Coding serta Lembaga Kursus IT terpadu. Kami menyediakan jasa pembuatan aplikasi, website, dan program bootcamp IT terlengkap.', // set false to total remove
            'separator'    => ' | ',
            'keywords'     => ['Software House Tegal', 'Jasa Pembuatan Website', 'Jasa Aplikasi', 'Kursus Coding', 'Pelatihan IT', 'Bootcamp IT', 'Elcoding'],
            'canonical'    => 'current', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => 'index, follow', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Elcoding - Software House & IT Training Center', // set false to total remove
            'description' => 'Elcoding adalah Software House profesional dan pusat Pelatihan Coding serta Lembaga Kursus IT terpadu. Kami menyediakan jasa pembuatan aplikasi, website, dan program bootcamp IT terlengkap.', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'Elcoding',
            'images'      => [
                env('APP_URL', 'https://elc.my.id') . '/gambar/aset/logo.png',
            ],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Elcoding - Software House & IT Training Center', // set false to total remove
            'description' => 'Elcoding adalah Software House profesional dan Lembaga Kursus Pelatihan IT terpadu. Menyediakan jasa pembuatan aplikasi, website, dan program bootcamp IT terlengkap.', // set false to total remove
            'url'         => 'current', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [
                env('APP_URL', 'https://elc.my.id') . '/gambar/aset/logo.png',
            ],
        ],
    ],
];
