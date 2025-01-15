<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manga;
use App\Models\Chapter;

class MangaSeeder extends Seeder
{
    public function run()
    {
        $manga = Manga::create([
            'title' => 'Naruto',
            'approval_rating' => 9.5,
            'views' => 1000,
        ]);

        $manga->chapters()->create([
            'number' => 1,
            'created_at' => now(),
        ]);
    }
}