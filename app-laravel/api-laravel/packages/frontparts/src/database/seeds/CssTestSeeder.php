<?php

declare(strict_types=1);

namespace Dionisvl\FrontParts\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CssTestSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('front_parts')->insert([
            'title' => 'CSS test',
            'slug' => 'css-tag',
            'status' => 1,
            'type' => 'CSS',
            'category_name' => env('APP_URL'),
            'url' => env('APP_URL') . '/contacts/',
            'preview_text' => 'it is CSS part test',
            'detail_text' => "<style>.test-seeder-class{color: red;}</style>",
        ]);
    }
}
