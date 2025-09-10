<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const anos = ref([])
const emit = defineEmits(['editar'])

const columns = [
  { data: 'id_ano_curricular', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  { data: 'ordem', title: 'Ordem' },
  { data: 'ciclo_designacao', title: 'Ciclo' },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `<button class='btn btn-warning btn-sm' onclick='window.dispatchEvent(new CustomEvent("editarAnoCurricular", { detail: ${JSON.stringify(row)} }))'>
                <i class='fa-solid fa-pen-to-square'></i> Editar
              </button>`
    }
  }
]

onMounted(async () => {
  try {
    const response = await axios.get('/ano_curricular-list')
    anos.value = response.data
  } catch (error) {
    console.error('Erro ao carregar anos curriculares:', error)
  }

  window.addEventListener('editarAnoCurricular', (e) => {
    emit('editar', e.detail)
  })
})
</script>

<template>
  <div class="container mt-4">
    <h2>Lista de Anos Curriculares</h2>
    <DataTable class="table table-hover" :data="anos" :columns="columns" />
  </div>
</template>