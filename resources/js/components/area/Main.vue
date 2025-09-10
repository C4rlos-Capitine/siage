<script setup>
import { ref, onMounted } from 'vue'
import AreaCurricularForm from './Create.vue'
import AreaCurricularList from './List.vue'
import axios from 'axios'

const componenteAtual = ref('list')
const areas = ref([])
const areaSelecionada = ref(null)

const carregarAreas = async () => {
  try {
    const response = await axios.get('/area_curricular-list')
    areas.value = response.data
  } catch (error) {
    alert('Erro ao carregar áreas curriculares.')
  }
}

onMounted(() => carregarAreas())

function novaArea() {
  areaSelecionada.value = { id_area_curricular: null, designacao: '', abreviatura: '' }
  componenteAtual.value = 'form'
}

function editarArea(area) {
  areaSelecionada.value = { ...area }
  componenteAtual.value = 'form'
}

function salvarArea(area) {
  if (area.id_area_curricular) {
    const index = areas.value.findIndex(a => a.id_area_curricular === area.id_area_curricular)
    if (index !== -1) areas.value[index] = { ...area }
  } else {
    area.id_area_curricular = areas.value.length + 1
    areas.value.push({ ...area })
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
        <a class="navbar-brand" href="#">Áreas Curriculares</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a 
              class="nav-link" 
              href="#" 
              @click.prevent="novaArea" 
              :class="{ active: componenteAtual === 'form' }"
            >
              Nova Área
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

        </ul>
      </div>
    </nav>


    <AreaCurricularList
      v-if="componenteAtual === 'list'"
      :areas="areas"
      @editar="editarArea"
    />

    <AreaCurricularForm
      v-if="componenteAtual === 'form'"
      :area="areaSelecionada"
      @salvar="salvarArea"
    />
  </div>
</template>
