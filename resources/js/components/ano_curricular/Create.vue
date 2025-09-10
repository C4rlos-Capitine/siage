<script setup>
import { ref, watch, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  ano: {
    type: Object,
    default: () => ({ id_ano_curricular: null, designacao: '', ordem: '', ciclo_id: '' })
  }
})

const emit = defineEmits(['salvar'])
const formData = ref({ ...props.ano })
const mensagem = ref('')
const erros = ref([])
const ciclos = ref([])

watch(() => props.ano, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

onMounted(async () => {
  try {
    const response = await axios.get('/ciclo-list')
    ciclos.value = response.data
  } catch (error) {
    erros.value = ['Erro ao carregar ciclos.']
  }
})

async function salvar() {
  mensagem.value = ''
  erros.value = []

  if (!formData.value.designacao) {
    erros.value.push('Preencha a designação!')
  }
  if (!formData.value.ordem) {
    erros.value.push('Preencha a ordem!')
  }
  if (!formData.value.ciclo_id) {
    erros.value.push('Selecione um ciclo!')
  }

  if (erros.value.length) return

  try {
    let response
    if (formData.value.id_ano_curricular) {
      response = await axios.put(`/ano_curricular/${formData.value.id_ano_curricular}`, {
        designacao: formData.value.designacao,
        ordem: formData.value.ordem,
        ciclo_id: formData.value.ciclo_id
      })
    } else {
      response = await axios.post('/ano_curricular', {
        designacao: formData.value.designacao,
        ordem: formData.value.ordem,
        ciclo_id: formData.value.ciclo_id
      })
    }

    mensagem.value = response.data.message || 'Ano Curricular salvo com sucesso!'
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
      erros.value = ['Erro ao salvar Ano Curricular.']
    }
  }
}
</script>

<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_ano_curricular ? 'Editar Ano Curricular' : 'Novo Ano Curricular' }}</h2>
      </div>

      <form @submit.prevent="salvar">
        <div class="mb-3">
          <label>Designação:</label>
          <input class="form-control" v-model="formData.designacao" type="text" maxlength="45" />
        </div>

        <div class="mb-3">
          <label>Ordem:</label>
          <input class="form-control" v-model="formData.ordem" type="number" />
        </div>

        <div class="mb-3">
          <label>Ciclo:</label>
          <select class="form-select" v-model="formData.ciclo_id">
            <option value="" disabled>Selecione o ciclo</option>
            <option v-for="ciclo in ciclos" :key="ciclo.id_ciclo" :value="ciclo.id_ciclo">
              {{ ciclo.designacao }}
            </option>
          </select>
        </div>

        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>

        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_ano_curricular ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>

      <div v-if="mensagem" class="alert alert-success">
        {{ mensagem }}
      </div>
    </div>
  </div>
</template>
