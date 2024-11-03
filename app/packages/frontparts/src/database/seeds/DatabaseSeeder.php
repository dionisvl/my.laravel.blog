<?php

declare(strict_types=1);

namespace Dionisvl\FrontParts\database\seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            JsTestSeeder::class,
            CssTestSeeder::class,
        ]);
    }
}
