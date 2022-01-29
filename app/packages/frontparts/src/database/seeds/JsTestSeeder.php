<?php


namespace Dionisvl\FrontParts\database\seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JsTestSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('front_parts')->insert([
            'title' => 'JS test',
            'slug' => 'js-tag',
            'status' => 1,
            'type' => 'JS',
            'category_name' => env('APP_URL'),
            'url' => env('APP_URL') . '/contacts/',
            'preview_text' => 'it is JS part test',
            'detail_text' => "<script>console.log(`hello its JS me`)</script>",
        ]);
        DB::table('front_parts')->insert([
            'title' => 'Yandex.Metrika counter',
            'slug' => 'ym-tag',
            'status' => 1,
            'type' => 'JS',
            'category_name' => env('APP_URL'),
            'url' => env('APP_URL') . '/contacts/',
            'preview_text' => 'Yandex.Metrika counter',
            'detail_text' => "<!-- Yandex.Metrika counter --><script></script><noscript></noscript>",
        ]);
        DB::table('front_parts')->insert([
            'title' => 'Jivosite',
            'slug' => 'jivosite-tag',
            'status' => 1,
            'type' => 'JS',
            'category_name' => env('APP_URL'),
            'url' => env('APP_URL') . '/contacts/',
            'preview_text' => 'Jivosite',
            'detail_text' => "<!-- Jivosite --><script></script>",
        ]);
        DB::table('front_parts')->insert([
            'title' => 'Global site tag (gtag.js) - Google Analytics',
            'slug' => 'google-tag',
            'status' => 1,
            'type' => 'JS',
            'category_name' => env('APP_URL'),
            'url' => env('APP_URL') . '/contacts/',
            'preview_text' => 'Global site tag (gtag.js) - Google Analytics',
            'detail_text' => "<!-- Global site tag (gtag.js) - Google Analytics --><script async></script><script></script>",
        ]);
    }
}
