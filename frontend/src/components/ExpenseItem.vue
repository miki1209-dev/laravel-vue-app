<template>
  <li class="expense-list__item">
    <span class="index">{{ index + 1 }}. </span>
    <span class="date">{{ formatData(expense.date) }} - </span>
    <span class="description">{{ expense.description }} - </span>
    <span class="amount">{{ formatAmount(expense.amount) }} - </span>
    <span class="category">{{ expense.category.name }} - </span>
    <button @click="handleEdit">編集</button>
    <span> - </span>
    <button @click="handleDelete">削除</button>
  </li>
</template>

<script setup>
  import { format } from 'date-fns';

  const props = defineProps({
    expense: {
      type: Object,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
  });

  const emit = defineEmits(['delete-expense', 'edit-expense']);

  //日付のフォーマット
  const formatData = (dateStr) => {
    const data = new Date(dateStr);
    return format(data, 'yyyy年M月d日');
  };

  //金額のフォーマット
  const formatAmount = (amount) => {
    return Number(amount).toLocaleString() + '円';
  };

  //編集イベント
  const handleEdit = () => {
    emit('expense', props.expense);
  };

  //削除イベント
  const handleDelete = async () => {
    emit('delete-expense', props.expense.id);
  };
</script>
