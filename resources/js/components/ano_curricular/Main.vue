<script setup>
import { ref } from 'vue'
import AnoCurricularForm from './Create.vue'
import AnoCurricularList from './List.vue'

const componenteAtual = ref('list')

// Dados fictícios só para testar (substituir depois pela API)
const anosCurriculares = ref([
  { id_ano_curricular: 1, designacao: '1º Ano', ordem: 1, ciclo_id: 1 },
  { id_ano_curricular: 2, designacao: '2º Ano', ordem: 2, ciclo_id: 1 }
])

const anoSelecionado = ref(null)

function novoAno() {
  anoSelecionado.value = { id_ano_curricular: null, designacao: '', ordem: '', ciclo_id: '' }
  componenteAtual.value = 'form'
}

function editarAno(ano) {
  anoSelecionado.value = { ...ano }
  componenteAtual.value = 'form'
}

function salvarAno(ano) {
  if (ano.id_ano_curricular) {
    // Atualizar
    const index = anosCurriculares.value.findIndex(a => a.id_ano_curricular === ano.id_ano_curricular)
    if (index !== -1) anosCurriculares.value[index] = { ...ano }
  } else {
    // Criar novo
    ano.id_ano_curricular = anosCurriculares.value.length + 1
    anosCurriculares.value.push({ ...ano })
  }
  setTimeout(() => {
    componenteAtual.value = 'list'
  }, 2000)
}
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Ano Curricular</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="#" @click="novoAno">Novo Ano Curricular</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" @click="componenteAtual = 'list'">Listar</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- LISTA -->
    <AnoCurricularList
      v-if="componenteAtual === 'list'"
      :anos-curriculares="anosCurriculares"
      @editar="editarAno"
    />

    <!-- FORMULÁRIO -->
    <AnoCurricularForm
      v-if="componenteAtual === 'form'"
      :ano="anoSelecionado"
      @salvar="salvarAno"
    />
  </div>
</template>
