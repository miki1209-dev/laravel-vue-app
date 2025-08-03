<template>
  <div>
    <h2>家計簿アプリ</h2>
    <ExpenseList />
  </div>
  <input type="text" v-model="name" />
  <p>{{ name }}</p>

  <input type="number" v-model="temperature" />
  <p>{{ temperature }}</p>
</template>
<script setup>
  import { ref } from 'vue';
  import ExpenseList from './components/ExpenseList.vue';
  import { watch } from 'vue';

  const name = ref('初期値');
  const temperature = ref(0);

  watch(
    () => name.value,
    (newVal, oldVal) => {
      console.log(`初期値は${oldVal}：入力後の値は${newVal}`);
    }
  );

  watch(
    () => temperature.value,
    (newVal, oldVal) => {
      if (newVal >= 30) {
        console.log('アツいよ');
      }
    }
  );
</script>
