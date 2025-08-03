<template>
  <form @submit.prevent="handleSubmit">
    <div>
      <label for="date">日付：</label>
      <input type="date" id="date" v-model="form.date" />
    </div>
    <div>
      <label for="description">説明：</label>
      <input type="text" id="description" v-model="form.description" />
    </div>
    <div>
      <label for="amount">金額：</label>
      <input type="number" id="amount" v-model="form.amount" />
    </div>
    <div>
      <label for="category">カテゴリ：</label>
      <select id="category" v-model="form.category_id">
        <option value="" disabled>選択してください</option>
        <option v-for="category in categories" :value="category.id" :key="category.id">
          {{ category.name }}
        </option>
      </select>
    </div>
    <button type="submit">登録</button>
  </form>
  <p v-if="errorMessage !== ''">{{ errorMessage }}</p>
</template>

<script setup>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';

  const emit = defineEmits(['add-expense']);

  const form = ref({
    date: '',
    description: '',
    amount: null,
    category_id: '',
  });

  const categories = ref([]);
  const errorMessage = ref('');

  onMounted(async () => {
    try {
      const response = await axios.get(`${import.meta.env.VITE_API_BASE_URL}/categories`);
      categories.value = response.data;
    } catch (error) {
      errorMessage.value = 'データ取得に失敗しました';
      console.error('データ取得に失敗しました', error);
    }
  });

  const handleSubmit = async () => {
    try {
      const response = await axios.post(
        `${import.meta.env.VITE_API_BASE_URL}/expenses`,
        form.value
      );

      emit('add-expense', response.data);

      //formの初期化
      form.value = {
        date: '',
        description: '',
        amount: null,
        category_id: '',
      };
    } catch (error) {
      errorMessage.value = '登録が失敗しました';
      console.error('データの登録が失敗しました', error);
    }
  };
</script>
