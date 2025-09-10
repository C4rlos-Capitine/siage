<script setup>
import { ref } from 'vue'
import ProvinciaForm from './Create.vue'
import ProvinciaList from './List.vue'

const componenteAtual = ref('list')
const provincias = ref([
  { id_provincia: 1, designacao: 'Luanda', abreviatura: 'LDA' },
  { id_provincia: 2, designacao: 'Benguela', abreviatura: 'BNG' }
])

const provinciaSelecionada = ref(null)

function novaProvincia() {
  provinciaSelecionada.value = { id_provincia: null, designacao: '', abreviatura: '' }
  componenteAtual.value = 'form'
}

function editarProvincia(provincia) {
  provinciaSelecionada.value = { ...provincia }
  componenteAtual.value = 'form'
}

function salvarProvincia(provincia) {
  if (provincia.id_provincia) {
    const index = provincias.value.findIndex(p => p.id_provincia === provincia.id_provincia)
    if (index !== -1) provincias.value[index] = { ...provincia }
  } else {
    provincia.id_provincia = provincias.value.length + 1
    provincias.value.push({ ...provincia })
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
        <a class="navbar-brand" href="#">Províncias</a>
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
              <a 
                class="nav-link" 
                href="#" 
                @click.prevent="novaProvincia" 
                :class="{ active: componenteAtual === 'form' }"
              >
                Nova Província
              </a>
            </li>

            <li class="nav-item">
              <a 
                class="nav-link" 
                href="#" 
                @click.prevent="componenteAtual = 'list'" 
                :class="{ active: componenteAtual === 'list' }"
              >
                Listar
              </a>
            </li>

          </ul>

          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search"/>
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </nav>
  </div>


    <ProvinciaList
      v-if="componenteAtual === 'list'"
      :provincias="provincias"
      @editar="editarProvincia"
    />

    <ProvinciaForm
      v-if="componenteAtual === 'form'"
      :provincia="provinciaSelecionada"
      @salvar="salvarProvincia"
    />

</template>