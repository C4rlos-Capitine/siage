<template>
  <form @submit.prevent="submitForm">
    <div>
      <label for="designacao">Designação:</label>
      <input
        type="text"
        id="designacao"
        v-model="designacao"
        maxlength="45"
        required
      />
    </div>
    <div>
      <label for="abreviatura">Abreviatura:</label>
      <input
        type="text"
        id="abreviatura"
        v-model="abreviatura"
        maxlength="10"
        required
      />
    </div>
    <div>
      <label for="ordem">Ordem:</label>
      <input
        type="number"
        id="ordem"
        v-model="ordem"
        required
      />
    </div>
    <button type="submit">Registrar Nível Acadêmico</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const designacao = ref('')
const abreviatura = ref('')
const ordem = ref('')

const submitForm = async () => {
  try {
    await axios.post('/nivel_academico', {
      designacao: designacao.value,
      abreviatura: abreviatura.value,
      ordem: ordem.value
    })
    alert('Nível Acadêmico registrado com sucesso!')
    designacao.value = ''
    abreviatura.value = ''
    ordem.value = ''
  } catch (error) {
    alert('Erro ao registrar nível acadêmico.')
  }
}
</script>