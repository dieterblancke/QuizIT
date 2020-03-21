<?php

use App\Models\Joke;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class JokeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://raw.githubusercontent.com/15Dkatz/official_joke_api/master/jokes/index.json');
        $jokes = $response->json();

        foreach ($jokes as $joke) {
            if ($joke['type'] === 'programming') {
                $dbJoke = new Joke();

                $dbJoke->setup = $joke['setup'];
                $dbJoke->punchline = $joke['punchline'];
                $dbJoke->save();
            }
        }
    }
}
