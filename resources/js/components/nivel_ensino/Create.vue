<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  nivel: {
    type: Object,
    default: () => ({ id_nivel_ensino: null, designacao: '', abreviatura: '', ordem: '' })
  }
})

const emit = defineEmits(['salvar'])

const formData = ref({ ...props.nivel })
const mensagem = ref('')
const erros = ref([])

watch(() => props.nivel, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

async function salvar() {
  mensagem.value = ''
  erros.value = []

  if (!formData.value.designacao || !formData.value.abreviatura || !formData.value.ordem) {
    erros.value = ['Preencha todos os campos!']
    return
  }

  try {
    let response
    if (formData.value.id_nivel_ensino) {
      response = await axios.put(`/nivel_ensino/${formData.value.id_nivel_ensino}`, formData.value)
    } else {
      response = await axios.post('/nivel_ensino', formData.value)
    }

    mensagem.value = response.data.message || 'Registro salvo com sucesso!'
    emit('salvar', formData.value)
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const data = error.response.data
      erros.value = data.errors ? Object.values(data.errors).flat() : [data.message]
    } else {
      erros.value = ['Erro ao salvar nível de ensino.']
    }
  }
}
</script>

<template>
  <div class="container mt-3">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_nivel_ensino ? 'Editar Nível de Ensino' : 'Novo Nível de Ensino' }}</h2>
      </div>
      <form @submit.prevent="salvar" class="p-3">
        <div class="mb-3">
          <label>Designação:</label>
          <input type="text" class="form-control" v-model="formData.designacao" maxlength="45" />
        </div>
        <div class="mb-3">
          <label>Abreviatura:</label>
          <input type="text" class="form-control" v-model="formData.abreviatura" maxlength="10" />
        </div>
        <div class="mb-3">
          <label>Ordem:</label>
          <input type="number" class="form-control" v-model="formData.ordem" />
        </div>
        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_nivel_ensino ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>
      <div v-if="mensagem" class="alert alert-success m-3">{{ mensagem }}</div>
    </div>
  </div>
</template>
