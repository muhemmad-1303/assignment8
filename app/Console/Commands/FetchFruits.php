<?php

namespace App\Console\Commands;

use App\Models\Fruit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchFruits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fruits:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch and save fruit data from an external api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $response = Http::get('https://fruityvice.com/api/fruit/all');
            if ($response->successful()) {
                $fruitsData = $response->json();
                foreach ($fruitsData as $fruitData) {
                    Fruit::create([
                        'name' => $fruitData['name'],
                        'family' => $fruitData['family'],
                        'order' => $fruitData['order'],
                        'genus' => $fruitData['genus'],
                        'calories' => $fruitData['nutritions']['calories'],
                        'fat' => $fruitData['nutritions']['fat'],
                        'sugar' => $fruitData['nutritions']['sugar'],
                        'carbohydrates' => $fruitData['nutritions']['carbohydrates'],
                        'protein' => $fruitData['nutritions']['protein'],
                    ]);
                }

                $this->info('Fruits data has been fetched and saved to the database.');
            } else {
                $this->error('Failed to fetch fruits data from the API.');
            }
    }
}
