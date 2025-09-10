<script setup>
import { ref, onMounted } from 'vue'
import InstituicaoForm from './Create.vue'
import InstituicaoList from './List.vue'
import InstituicaoShow from './Show.vue'
import axios from 'axios'

const componenteAtual = ref('list')
const instituicoes = ref([])
const instituicaoSelecionada = ref(null)

const carregarInstituicoes = async () => {
  try {
    const response = await axios.get('/instituicao_ensino-list')
    instituicoes.value = response.data
  } catch (error) {
    alert('Erro ao carregar instituições de ensino.')
  }
}

onMounted(() => carregarInstituicoes())

function novaInstituicao() {
  instituicaoSelecionada.value = { 
    id_instituicao: null, 
    designacao: '', 
    abreviatura: '', 
    endereco: '', 
    telefone: '', 
    email: '' 
  }
  componenteAtual.value = 'form'
}

function editarInstituicao(inst) {
  instituicaoSelecionada.value = { ...inst }
  componenteAtual.value = 'form'
}

function mostrarInstituicao(inst) {
  instituicaoSelecionada.value = { ...inst }
  componenteAtual.value = 'show'
}

function salvarInstituicao(inst) {
  if (inst.id_instituicao) {
    const index = instituicoes.value.findIndex(i => i.id_instituicao === inst.id_instituicao)
    if (index !== -1) instituicoes.value[index] = { ...inst }
  } else {
    inst.id_instituicao = instituicoes.value.length + 1
    instituicoes.value.push({ ...inst })
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
        <a class="navbar-brand" href="#">Instituições de Ensino</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a 
              class="nav-link"
              href="#"
              @click.prevent="novaInstituicao"
              :class="{ active: componenteAtual === 'form' }"
            >
              Nova Instituição
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


    <InstituicaoList
      v-if="componenteAtual === 'list'"
      :instituicoes="instituicoes"
      @editar="editarInstituicao"
      @mostrar="mostrarInstituicao"
    />

    <InstituicaoForm
      v-if="componenteAtual === 'form'"
      :instituicao="instituicaoSelecionada"
      @salvar="salvarInstituicao"
    />

    <InstituicaoShow
      v-if="componenteAtual === 'show'"
      :instituicao="instituicaoSelecionada"
    />
  </div>
</template>
