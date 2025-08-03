<template>
  <v-dialog v-model="isOpen" max-width="500px">
    <v-card>
      <v-card-title>支出の編集</v-card-title>
      <v-card-text>
        <!-- ここに編集フォームと追加予定 -->
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn color="grey" @click="handleCancel">キャンセル</v-btn>
        <v-btn color="primary" @click="handleSave">追加</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
  import { ref, watch } from 'vue';

  // Step1-1: propsとemitの宣言（まだ中身は仮）
  const props = defineProps({
    modelValue: Boolean,
    expense: Object,
    categories: Array,
  });

  const emit = defineEmits(['update:modelValue', 'save']);

  const isOpen = ref(false);

  const handleCancel = () => {
    emit('update:modelValue', false);
  };

  const handleSave = () => {
    emit('save', {});
    emit('update:modelValue', false);
  };

  watch(
    () => props.modelValue,
    (newVal) => {
      isOpen.value = newVal;
    }
  );
</script>
