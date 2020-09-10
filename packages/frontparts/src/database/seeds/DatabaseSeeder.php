<?php

namespace Dionisvl\FrontParts\database\seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            JsTestSeeder::class,
            CssTestSeeder::class
        ]);
    }
}
