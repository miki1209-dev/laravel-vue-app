<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Expense::create([
			'amount' => 1200,
			'category_id' => 1,
			'description' => 'スーパー買い物',
			'date' => '2025-07-10',
		]);
		Expense::create([
			'amount' => 500,
			'category_id' => 2,
			'description' => '電車代',
			'date' => '2025-07-21',
		]);
		Expense::create([
			'amount' => 980,
			'category_id' => 3,
			'description' => 'ドラックストア',
			'date' => '2025-07-22',
		]);
		Expense::create([
			'amount' => 3500,
			'category_id' => 4,
			'description' => '友人と飲み会',
			'date' => '2025-07-23',
		]);
		Expense::create([
			'amount' => 1000,
			'category_id' => 5,
			'description' => '本の購入',
			'date' => '2025-07-24',
		]);
	}
}
