<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  provincia: {
    type: Object,
    default: () => ({ id_provincia: null, designacao: '', abreviatura: '' })
  }
})

const emit = defineEmits(['salvar'])
const formData = ref({ ...props.provincia })
const mensagem = ref('')
const erros = ref([])

watch(() => props.provincia, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

async function salvar() {
  mensagem.value = ''
  erros.value = []

  // Validação simples no frontend
  if (!formData.value.designacao) {
    erros.value.push('Preencha a designação!')
  }
  if (!formData.value.abreviatura) {
    erros.value.push('Preencha a abreviatura!')
  }
  if (erros.value.length) return

  try {
    let response
    if (formData.value.id_provincia) {
      response = await axios.put(`/provincia/${formData.value.id_provincia}`, {
        designacao: formData.value.designacao,
        abreviatura: formData.value.abreviatura
      })
    } else {
      response = await axios.post('/provincia', {
        designacao: formData.value.designacao,
        abreviatura: formData.value.abreviatura
      })
    }

    mensagem.value = response.data.message || 'Província salva com sucesso!'
    emit('salvar', formData.value)
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const data = error.response.data
      if (data.errors) {
        erros.value = Object.values(data.errors).flat()
      } else if (data.message) {
        erros.value = [data.message]
      }
    } else {
      erros.value = ['Erro ao salvar província.']
    }
  }
}
</script>

<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_provincia ? 'Editar Província' : 'Nova Província' }}</h2>
      </div>

      <form @submit.prevent="salvar">
        <div class="mb-3">
          <label>Designação:</label>
          <input
            class="form-control"
            v-model="formData.designacao"
            type="text"
            maxlength="45"
          />
        </div>

        <div class="mb-3">
          <label>Abreviatura:</label>
          <input
            class="form-control"
            v-model="formData.abreviatura"
            type="text"
            maxlength="10"
          />
        </div>

        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>

        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_provincia ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>

      <div v-if="mensagem" class="alert alert-success">
        {{ mensagem }}
      </div>
    </div>
  </div>
</template>
