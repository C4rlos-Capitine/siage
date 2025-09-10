<script setup>
import { ref, watch, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  area: {
    type: Object,
    default: () => ({ id_area_curricular: null, designacao: '', abreviatura: '' })
  }
})

const emit = defineEmits(['salvar'])

const formData = ref({ ...props.area })
const mensagem = ref('')
const erros = ref([])

watch(() => props.area, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

async function salvar() {
  mensagem.value = ''
  erros.value = []

  if (!formData.value.designacao || !formData.value.abreviatura) {
    erros.value = ['Preencha todos os campos!']
    return
  }

  try {
    let response
    if (formData.value.id_area_curricular) {
      response = await axios.put(`/area_curricular/${formData.value.id_area_curricular}`, {
        designacao: formData.value.designacao,
        abreviatura: formData.value.abreviatura
      })
    } else {
      response = await axios.post('/area_curricular', {
        designacao: formData.value.designacao,
        abreviatura: formData.value.abreviatura
      })
    }

    mensagem.value = response.data.message || 'Registro salvo com sucesso!'
    emit('salvar', formData.value)
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const data = error.response.data
      erros.value = data.errors ? Object.values(data.errors).flat() : [data.message]
    } else {
      erros.value = ['Erro ao salvar área curricular.']
    }
  }
}
</script>

<template>
  <div class="container mt-3">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_area_curricular ? 'Editar Área Curricular' : 'Nova Área Curricular' }}</h2>
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
        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_area_curricular ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>
      <div v-if="mensagem" class="alert alert-success m-3">{{ mensagem }}</div>
    </div>
  </div>
</template>
