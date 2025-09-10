<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const formacoes = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('/formacao_academica')
    formacoes.value = response.data
  } catch (error) {
    alert('Erro ao carregar formações acadêmicas.')
  }
})
</script>

<template>
  <div>
    <h2>Lista de Formações Acadêmicas</h2>
    <ul>
      <li v-for="formacao in formacoes" :key="formacao.id_formacao_academica">
        {{ formacao.nome_curso }} | Instituição: {{ formacao.id_instituicao_ensino }} | Nível: {{ formacao.id_nivel_academico }}
      </li>
    </ul>
  </div>
</template>