<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeds = [
            ['name' => 'Pierścionki', 'description' => 'Okrągłe metalowe elementy bizuterii', 'slug' => 'ring', 'featured' => false, 'image' => 'ring.png'],
            ['name' => 'Naszyjniki', 'description' => 'Elementy bizuterii słuzace do noszenia na szyi', 'slug' => 'necklace', 'featured' => false, 'image' => 'necklace.png'],
            ['name' => 'Bransoletki', 'description' => 'Okrągłe części bizuterii noszone na nadgarstkach', 'slug' => 'bracelet', 'featured' => false, 'image' => 'bracelet.png'],
            ['name' => 'Okulary', 'description' => 'Okrągłe metalowe elementy bizuterii noszone na nosie', 'slug' => 'glasses', 'featured' => false, 'image' => 'glasses.png'],
        ];

        foreach ($seeds as $seed) {
            Category::updateOrCreate($seed);
        }
    }
}
