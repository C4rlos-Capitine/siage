<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  instituicao: {
    type: Object,
    default: () => ({
      id_instituicao: null,
      designacao: '',
      abreviatura: '',
      endereco: '',
      telefone: '',
      email: ''
    })
  }
})

const emit = defineEmits(['salvar'])

const formData = ref({ ...props.instituicao })
const mensagem = ref('')
const erros = ref([])

watch(
  () => props.instituicao,
  (novo) => {
    formData.value = { ...novo }
    mensagem.value = ''
    erros.value = []
  },
  { immediate: true }
)

async function salvar() {
  mensagem.value = ''
  erros.value = []

  // Validação básica no front
  if (!formData.value.designacao || !formData.value.abreviatura) {
    erros.value = ['Preencha os campos obrigatórios: Designação e Abreviatura!']
    return
  }

  try {
    let response
    if (formData.value.id_instituicao) {
      response = await axios.put(`/instituicao_ensino/${formData.value.id_instituicao}`, {
        designacao: formData.value.designacao,
        abreviatura: formData.value.abreviatura,
        endereco: formData.value.endereco,
        telefone: formData.value.telefone,
        email: formData.value.email
      })
    } else {
      response = await axios.post('/instituicao_ensino', {
        designacao: formData.value.designacao,
        abreviatura: formData.value.abreviatura,
        endereco: formData.value.endereco,
        telefone: formData.value.telefone,
        email: formData.value.email
      })
    }

    mensagem.value = response.data.message || 'Instituição salva com sucesso!'
    emit('salvar', formData.value)
  } catch (error) {
    console.log(error);
    if (error.response && error.response.status === 422) {
      const data = error.response.data
      erros.value = data.errors ? Object.values(data.errors).flat() : [data.message]
    } else {
      erros.value = ['Erro ao salvar instituição de ensino.']
    }
  }
}
</script>

<template>
  <div class="container mt-3">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_instituicao ? 'Editar Instituição de Ensino' : 'Nova Instituição de Ensino' }}</h2>
      </div>
      <form @submit.prevent="salvar" class="p-3">
        <div class="mb-3">
          <label>Designação:</label>
          <input type="text" class="form-control" v-model="formData.designacao" maxlength="100" />
        </div>
        <div class="mb-3">
          <label>Abreviatura:</label>
          <input type="text" class="form-control" v-model="formData.abreviatura" maxlength="20" />
        </div>
        <div class="mb-3">
          <label>Endereço:</label>
          <input type="text" class="form-control" v-model="formData.endereco" maxlength="150" />
        </div>
        <div class="mb-3">
          <label>Telefone:</label>
          <input type="text" class="form-control" v-model="formData.telefone" maxlength="15" />
        </div>
        <div class="mb-3">
          <label>Email:</label>
          <input type="email" class="form-control" v-model="formData.email" maxlength="100" />
        </div>

        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>

        <div class="mb-3">
          <button class="btn btn-primary" type="submit">
            {{ formData.id_instituicao ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </form>

      <div v-if="mensagem" class="alert alert-success m-3">{{ mensagem }}</div>
    </div>
  </div>
</template>
