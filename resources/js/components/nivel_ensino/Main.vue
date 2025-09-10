<script setup>
import { ref, onMounted } from 'vue'
import NivelEnsinoForm from './Create.vue'
import NivelEnsinoList from './List.vue'
import axios from 'axios'

const componenteAtual = ref('list')
const niveis = ref([])
const nivelSelecionado = ref(null)

const carregarNiveis = async () => {
  try {
    const response = await axios.get('/nivel_ensino-list')
    niveis.value = response.data
  } catch (error) {
    alert('Erro ao carregar níveis de ensino.')
  }
}

onMounted(() => carregarNiveis())

function novoNivel() {
  nivelSelecionado.value = { id_nivel_ensino: null, designacao: '', abreviatura: '', ordem: '' }
  componenteAtual.value = 'form'
}

function editarNivel(nivel) {
  nivelSelecionado.value = { ...nivel }
  componenteAtual.value = 'form'
}

function salvarNivel(nivel) {
  if (nivel.id_nivel_ensino) {
    const index = niveis.value.findIndex(n => n.id_nivel_ensino === nivel.id_nivel_ensino)
    if (index !== -1) niveis.value[index] = { ...nivel }
  } else {
    nivel.id_nivel_ensino = niveis.value.length + 1
    niveis.value.push({ ...nivel })
  }
  setTimeout(() => {
    componenteAtual.value = 'list'
  }, 500)
}
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-light mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Níveis de Ensino</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#" @click="novoNivel">Novo Nível</a></li>
          <li class="nav-item"><a class="nav-link" href="#" @click="componenteAtual='list'">Listar</a></li>
        </ul>
      </div>
    </nav>

    <NivelEnsinoList
      v-if="componenteAtual === 'list'"
      :niveis="niveis"
      @editar="editarNivel"
    />

    <NivelEnsinoForm
      v-if="componenteAtual === 'form'"
      :nivel="nivelSelecionado"
      @salvar="salvarNivel"
    />
  </div>
</template>
