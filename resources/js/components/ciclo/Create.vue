<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  ciclo: {
    type: Object,
    default: () => ({ id_ciclo: null, designacao: '' })
  }
})

const emit = defineEmits(['salvar'])
const formData = ref({ ...props.ciclo })
const mensagem = ref('')
const erros = ref([])

watch(() => props.ciclo, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

async function salvar() {
  mensagem.value = ''
  erros.value = []
  if (!formData.value.designacao) {
    erros.value = ['Preencha a designação!']
    return;
  }
  try {
    let response;
    if (formData.value.id_ciclo) {
      response = await axios.put(`/ciclo/${formData.value.id_ciclo}`, { designacao: formData.value.designacao });
    } else {
      response = await axios.post('/ciclo', { designacao: formData.value.designacao });
    }
    mensagem.value = response.data.message; // Exibe mensagem do backend
    emit('salvar', formData.value)
  } catch (error) {
    // Captura erros de validação do backend
    if (error.response && error.response.status === 422) {
      const data = error.response.data;
      if (data.errors) {
        erros.value = Object.values(data.errors).flat();
      } else if (data.message) {
        erros.value = [data.message];
      }
    } else {
      erros.value = ['Erro ao salvar ciclo.'];
    }
  }
}
</script>

<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_ciclo ? 'Editar Ciclo' : 'Novo Ciclo' }}</h2>
      </div>
      <form @submit.prevent="salvar">
        <div class="mb-3">
          <label>Designação:</label>
          <input class="form-control" v-model="formData.designacao" type="text" />
        </div>
        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_ciclo ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>
      <div v-if="mensagem" class="alert alert-success">
        {{ mensagem }}
      </div>
    </div>
  </div>
</template>