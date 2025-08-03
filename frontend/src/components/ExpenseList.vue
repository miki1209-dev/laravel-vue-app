<template>
  <div class="expense-list">
    <h2>支出の一覧</h2>

    <ExpenseForm @add-expense="addExpense" />

    <ul>
      <ExpenseItem
        v-for="(expense, index) in expenses"
        :key="expense.id"
        :index="index"
        :expense="expense"
        @edit-expense="removeExpense"
        @delete-expense="removeExpense"
      />
    </ul>
    <p v-if="errorMessage !== ''" class="expense-list__error">
      {{ errorMessage }}
    </p>
  </div>
</template>

<script setup>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  import ExpenseItem from './ExpenseItem.vue';
  import ExpenseForm from './ExpenseForm.vue';

  //支出を格納する配列を準備
  const expenses = ref([]);
  const errorMessage = ref('');

  //画面読み込み時に処理を実行
  onMounted(async () => {
    try {
      const response = await axios.get(`${import.meta.env.VITE_API_BASE_URL}/expenses`);

      //日付を新しい順に並び替え
      const sortedExpenses = response.data.sort((a, b) => {
        return new Date(b.date) - new Date(a.date);
      });
      expenses.value = sortedExpenses;
    } catch (error) {
      errorMessage.value = 'データ取得に失敗しました';
      console.error('データ取得に失敗しました', error);
    }
  });

  const addExpense = (newExpense) => {
    expenses.value.unshift(newExpense);
  };

  const removeExpense = async (expenseId) => {
    try {
      await axios.delete(`${import.meta.env.VITE_API_BASE_URL}/expenses/${expenseId}`);
      expenses.value = expenses.value.filter((expense) => expense.id !== expenseId);
    } catch (error) {
      errorMessage.value = 'データ削除に失敗しました';
      console.error('データ削除に失敗しました', error);
    }
  };
</script>

<style scoped src="@/assets/components/_expense-list.scss"></style>
