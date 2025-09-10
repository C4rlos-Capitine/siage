<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  ano: {
    type: Object,
    default: () => ({
      id_ano_academico: null,
      designacao: '',
      data_inicio: '',
      data_fim: '',
      estado: true
    })
  }
})

const emit = defineEmits(['salvar'])
const formData = ref({ ...props.ano })
const mensagem = ref('')
const erros = ref([])

watch(() => props.ano, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

async function salvar() {
  mensagem.value = ''
  erros.value = []

  // Validações simples
  if (!formData.value.designacao) erros.value.push('Preencha a designação!')
  if (!formData.value.data_inicio) erros.value.push('Preencha a data de início!')
  if (!formData.value.data_fim) erros.value.push('Preencha a data de fim!')

  if (erros.value.length) return

  try {
    let response
    if (formData.value.id_ano_academico) {
      response = await axios.put(`/ano_academico/${formData.value.id_ano_academico}`, {
        designacao: formData.value.designacao,
        data_inicio: formData.value.data_inicio,
        data_fim: formData.value.data_fim,
        estado: formData.value.estado
      })
    } else {
      response = await axios.post('/ano_academico', {
        designacao: formData.value.designacao,
        data_inicio: formData.value.data_inicio,
        data_fim: formData.value.data_fim,
        estado: formData.value.estado
      })
    }
    console.log(response);
    mensagem.value = response.data.message || 'Ano Acadêmico salvo com sucesso!'
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
      erros.value = ['Erro ao salvar Ano Acadêmico.']
    }
  }
}
</script>

<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_ano_academico ? 'Editar Ano Acadêmico' : 'Novo Ano Acadêmico' }}</h2>
      </div>

      <form @submit.prevent="salvar" class="p-3">
        <div class="mb-3">
          <label>Designação:</label>
          <input class="form-control" v-model="formData.designacao" type="text" maxlength="45" />
        </div>

        <div class="mb-3">
          <label>Data Início:</label>
          <input class="form-control" v-model="formData.data_inicio" type="date" />
        </div>

        <div class="mb-3">
          <label>Data Fim:</label>
          <input class="form-control" v-model="formData.data_fim" type="date" />
        </div>

        <div class="mb-3">
          <label>Estado:</label>
          <select class="form-select" v-model="formData.estado">
            <option :value="1">Ativo</option>
            <option :value="0">Inativo</option>
          </select>

        </div>

        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>

        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_ano_academico ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>

      <div v-if="mensagem" class="alert alert-success">
        {{ mensagem }}
      </div>
    </div>
  </div>
</template>
