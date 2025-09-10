<script setup>
import { ref, watch, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  disciplina: {
    type: Object,
    default: () => ({
      id_disciplina: null,
      designacao: '',
      abreviatura: '',
      area_curricular_id: '',
      nivel_ensino_id: ''
    })
  }
})

const emit = defineEmits(['salvar'])
const formData = ref({ ...props.disciplina })
const mensagem = ref('')
const erros = ref([])

const areas = ref([])
const niveis = ref([])

watch(() => props.disciplina, (novo) => {
  formData.value = { ...novo }
  mensagem.value = ''
  erros.value = []
}, { immediate: true })

async function carregarSelects() {
  try {
    const resAreas = await axios.get('/area_curricular-list')
    areas.value = resAreas.data

    const resNiveis = await axios.get('/nivel_ensino-list')
    niveis.value = resNiveis.data
  } catch (e) {
    console.error('Erro ao carregar selects', e)
  }
}

onMounted(carregarSelects)

async function salvar() {
  mensagem.value = ''
  erros.value = []

  if (!formData.value.designacao || !formData.value.abreviatura || !formData.value.area_curricular_id || !formData.value.nivel_ensino_id) {
    erros.value = ['Preencha todos os campos obrigatórios!']
    return
  }

  try {
    let response
    if (formData.value.id_disciplina) {
      response = await axios.put(`/disciplina/${formData.value.id_disciplina}`, formData.value)
    } else {
      response = await axios.post('/disciplina', formData.value)
    }

    mensagem.value = response.data.message || 'Disciplina salva com sucesso!'
    emit('salvar', formData.value)
  } catch (error) {
    erros.value = ['Erro ao salvar disciplina.']
  }
}
</script>

<template>
  <div class="container mt-3">
    <div class="card">
      <div class="card-header">
        <h2>{{ formData.id_disciplina ? 'Editar Disciplina' : 'Nova Disciplina' }}</h2>
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
          <label>Área Curricular:</label>
          <select v-model="formData.area_curricular_id" class="form-control">
            <option value="">Selecione</option>
            <option v-for="a in areas" :key="a.id_area_curricular" :value="a.id_area_curricular">{{ a.designacao }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Nível de Ensino:</label>
          <select v-model="formData.nivel_ensino_id" class="form-control">
            <option value="">Selecione</option>
            <option v-for="n in niveis" :key="n.id_nivel_ensino" :value="n.id_nivel_ensino">{{ n.designacao }}</option>
          </select>
        </div>

        <div v-if="erros.length" class="alert alert-danger">
          <ul>
            <li v-for="(erro, i) in erros" :key="i">{{ erro }}</li>
          </ul>
        </div>

        <button class="btn btn-primary" type="submit">
          {{ formData.id_disciplina ? 'Atualizar' : 'Salvar' }}
        </button>
      </form>

      <div v-if="mensagem" class="alert alert-success m-3">{{ mensagem }}</div>
    </div>
  </div>
</template>
