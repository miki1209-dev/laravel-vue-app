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
		//
		Category::create(['name' => '食費']);
		Category::create(['name' => '交通費']);
		Category::create(['name' => '日用品']);
		Category::create(['name' => '交際費']);
		Category::create(['name' => 'その他']);
	}
}
