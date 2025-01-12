<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Manga;
use App\Models\Chapter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create sample manga entries
        $mangas = [
            [
                'title' => 'Penalidade de Morte',
                'cover' => '/images/penalidade-morte.jpg',
                'rating' => 4.6,
                'views' => 1500,
                'chapters' => [
                    ['number' => 59, 'title' => 'Capítulo 59'],
                    ['number' => 58, 'title' => 'Capítulo 58'],
                ]
            ],
            [
                'title' => 'Respawn: Usurparei o Trono',
                'cover' => '/images/respawn.jpg',
                'rating' => 4.5,
                'views' => 1200,
                'chapters' => [
                    ['number' => 21, 'title' => 'Capítulo 21'],
                    ['number' => 20, 'title' => 'Capítulo 20'],
                ]
            ],
            [
                'title' => 'Subir de Nível com Habilidades',
                'cover' => '/images/subir-nivel.jpg',
                'rating' => 4.0,
                'views' => 1000,
                'chapters' => [
                    ['number' => 87, 'title' => 'Capítulo 87'],
                    ['number' => 86, 'title' => 'Capítulo 86'],
                ]
            ],
            [
                'title' => 'O Retorno do Assassino',
                'cover' => '/images/retorno-assassino.jpg',
                'rating' => 4.2,
                'views' => 1100,
                'chapters' => [
                    ['number' => 21, 'title' => 'Capítulo 21'],
                    ['number' => 20, 'title' => 'Capítulo 20'],
                ]
            ],
            [
                'title' => 'As Aventuras de Um Herói',
                'cover' => '/images/aventuras-heroi.jpg',
                'rating' => 4.3,
                'views' => 950,
                'chapters' => [
                    ['number' => 15, 'title' => 'Capítulo 15'],
                    ['number' => 14, 'title' => 'Capítulo 14'],
                ]
            ],
            [
                'title' => 'Cultivação do Demônio',
                'cover' => '/images/cultivo-demonio.jpg',
                'rating' => 4.4,
                'views' => 1300,
                'chapters' => [
                    ['number' => 45, 'title' => 'Capítulo 45'],
                    ['number' => 44, 'title' => 'Capítulo 44'],
                ]
            ],
            [
                'title' => 'Minha Esposa é a Rainha dos Demônios',
                'cover' => '/images/rainha-demonios.jpg',
                'rating' => 4.7,
                'views' => 2000,
                'chapters' => [
                    ['number' => 460, 'title' => 'Capítulo 460'],
                    ['number' => 459, 'title' => 'Capítulo 459'],
                ]
            ],
            [
                'title' => 'Herói x Rainha dos Demônios',
                'cover' => '/images/heroi-rainha.jpg',
                'rating' => 4.5,
                'views' => 1800,
                'chapters' => [
                    ['number' => 135, 'title' => 'Capítulo 135'],
                    ['number' => 134, 'title' => 'Capítulo 134'],
                ]
            ]
        ];

        foreach ($mangas as $mangaData) {
            $chapters = $mangaData['chapters'];
            unset($mangaData['chapters']);
            
            // Create manga
            $manga = Manga::create($mangaData);
            
            // Create chapters for this manga
            foreach ($chapters as $chapter) {
                Chapter::create([
                    'manga_id' => $manga->id,
                    'number' => $chapter['number'],
                    'title' => $chapter['title']
                ]);
            }
        }
    }
}