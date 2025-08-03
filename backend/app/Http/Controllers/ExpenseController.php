<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$expenses = Expense::with('category')->get();
		return response()->json($expenses);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'date' => 'required|date',
			'description' => 'required|string',
			'amount' => 'required|numeric',
			'category_id' => 'required|exists:categories,id',
		]);

		try {
			$expense = new Expense;
			$expense->date = $request->input('date');
			$expense->description = $request->input('description');
			$expense->amount = $request->input('amount');
			$expense->category_id = $request->input('category_id');

			$expense->save();

			$expense->load('category');

			return response()->json($expense, 201);
		} catch (QueryException $e) {
			Log::error('Database Error' . $e->getMessage());
			return response()->json(['message' => '登録に失敗しました。時間をおいて再度お試しください。'], 500);
		} catch (Exception $e) {
			Log::error('General Error' . $e->getMessage());
			return response()->json(['message' => '予期せぬエラーが発生しました。'], 500);
		}
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Expense $expense)
	{
		$request->validate([
			'date' => 'required|date',
			'description' => 'required|string',
			'amount' => 'required|numeric',
			'category_id' => 'required|exists:categories,id',
		]);

		try {
			$expense->date = $request->input('date');
			$expense->description = $request->input('description');
			$expense->amount = $request->input('amount');
			$expense->category_id = $request->input('category_id');
			$expense->save();
			$expense->load('category');

			return response()->json($expense, 200);
		} catch (QueryException $e) {
			Log::error('Database Error' . $e->getMessage());
			return response()->json(['message' => 'データの更新に失敗しました'], 500);
		} catch (Exception $e) {
			Log::error("General Error" . $e->getMessage());
			return response()->json(['message' => '予期せぬエラーが発生しました。'], 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, Expense $expense)
	{
		try {
			$expense->delete();
			return response(['message' => 'データの削除に成功しました'], 200);
		} catch (QueryException $e) {
			Log::error('Database Error' . $e->getMessage());
			return response()->json(['message' => 'データの削除に失敗しました'], 500);
		} catch (Exception $e) {
			Log::error('General Error' . $e->getMessage());
			return response()->json(['message' => '予期せぬエラーが発生しました。'], 500);
		}
	}
}
