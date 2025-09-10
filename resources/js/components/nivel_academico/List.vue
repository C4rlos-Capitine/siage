<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const niveis = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('/nivel_academico')
    niveis.value = response.data
  } catch (error) {
    alert('Erro ao carregar níveis acadêmicos.')
  }
});
</script>

<template>
  <div>
    <h2>Lista de Níveis Acadêmicos</h2>
    <ul>
      <li v-for="nivel in niveis" :key="nivel.id_nivel_academico">
        {{ nivel.designacao }} ({{ nivel.abreviatura }}) | Ordem: {{ nivel.ordem }}
      </li>
    </ul>
  </div>
</template>