<script setup>
import { ref } from 'vue'
import CicloForm from './Create.vue'
import CicloList from './List.vue'

const componenteAtual = ref('list')
const ciclos = ref([
  { id: 1, designacao: 'Ciclo 1' },
  { id: 2, designacao: 'Ciclo 2' }
])

const cicloSelecionado = ref(null)

function novoCiclo() {
  cicloSelecionado.value = { id: null, designacao: '' }
  componenteAtual.value = 'form'
}

function editarCiclo(ciclo) {
  cicloSelecionado.value = { ...ciclo } // clona, mantém o id
  componenteAtual.value = 'form'
}


function salvarCiclo(ciclo) {
  if (ciclo.id) {
    // atualizar
    const index = ciclos.value.findIndex(c => c.id_ciclo  === ciclo.id_ciclo )
    if (index !== -1) ciclos.value[index] = { ...ciclo }
  } else {
    // novo
    ciclo.id_ciclo  = ciclos.value.length + 1
    ciclos.value.push({ ...ciclo })
  }
  //componenteAtual.value = 'list'
    setTimeout(() => {
    componenteAtual.value = 'list'
  }, 2000)
}

</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ciclos de Ensino</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" @click="novoCiclo">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" @click="novoCiclo">Novo Ciclo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" @click="componenteAtual = 'list'">Listar</a>
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>-->
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <CicloList
      v-if="componenteAtual === 'list'"
      :ciclos="ciclos"
      @editar="editarCiclo"
    />

    <CicloForm
      v-if="componenteAtual === 'form'"
      :ciclo="cicloSelecionado"
      @salvar="salvarCiclo"
    />
  </div>
</template>
