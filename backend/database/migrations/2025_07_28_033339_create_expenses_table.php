<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('expenses', function (Blueprint $table) {
			$table->id();
			$table->integer('amount');
			$table->unsignedBigInteger('category_id');
			$table->text('description')->nullable();
			$table->date('date');
			$table->timestamps();

			//外部キーの制約
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('expenses');
	}
};
