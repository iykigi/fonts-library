<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'kurdish']);
        Category::create(['name' => 'English']);
        Category::create(['name' => 'Arabic']);
        Category::create(['name' => 'Turkish']);
        Category::create(['name' => 'farsi']);
        Category::create(['name' => 'india']);
    }
}
