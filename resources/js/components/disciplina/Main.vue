<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import Create from './Create.vue'
import List from './List.vue'
import Show from './Show.vue'

const componenteAtual = ref('list')
const disciplinas = ref([])
const disciplinaSelecionada = ref(null)

const carregarDisciplinas = async () => {
  try {
    const response = await axios.get('/disciplina-list')
    disciplinas.value = response.data
  } catch (error) {
    alert('Erro ao carregar disciplinas.')
  }
}

onMounted(carregarDisciplinas)

function novaDisciplina() {
  disciplinaSelecionada.value = {
    id_disciplina: null,
    designacao: '',
    abreviatura: '',
    area_curricular_id: '',
    nivel_ensino_id: ''
  }
  componenteAtual.value = 'form'
}

function editarDisciplina(disc) {
  disciplinaSelecionada.value = { ...disc }
  componenteAtual.value = 'form'
}

function mostrarDisciplina(disc) {
  disciplinaSelecionada.value = { ...disc }
  componenteAtual.value = 'show'
}

function salvarDisciplina(disc) {
  if (disc.id_disciplina) {
    const index = disciplinas.value.findIndex(d => d.id_disciplina === disc.id_disciplina)
    if (index !== -1) disciplinas.value[index] = { ...disc }
  } else {
    disc.id_disciplina = disciplinas.value.length + 1
    disciplinas.value.push({ ...disc })
  }
  setTimeout(() => { componenteAtual.value = 'list' }, 500)
}
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-light mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Disciplinas</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a 
              class="nav-link" 
              href="#" 
              @click.prevent="novaDisciplina" 
              :class="{ active: componenteAtual === 'form' }"
            >
              Nova Disciplina
            </a>
          </li>

          <li class="nav-item">
            <a 
              class="nav-link" 
              href="#" 
              @click.prevent="componenteAtual='list'" 
              :class="{ active: componenteAtual === 'list' }"
            >
              Listar
            </a>
          </li>

          <li class="nav-item">
            <a 
              class="nav-link"
              href="#"
              @click.prevent="componenteAtual='show'"
              :class="{ active: componenteAtual === 'show' }"
            >
              Consultar
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <List 
      v-if="componenteAtual==='list'" 
      :disciplinas="disciplinas" 
      @editar="editarDisciplina" 
      @mostrar="mostrarDisciplina"
    />

    <Create 
      v-if="componenteAtual==='form'" 
      :disciplina="disciplinaSelecionada" 
      @salvar="salvarDisciplina" 
    />

    <Show 
      v-if="componenteAtual==='show'" 
      :disciplinaId="disciplinaSelecionada.id_disciplina"
      @voltar="componenteAtual='list'"
    />
  </div>
</template>
