<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const emit = defineEmits(['editar'])

const provincias = ref([])

const columns = [
  { data: 'id_provincia', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  { data: 'abreviatura', title: 'Abreviatura' },
  {
    data: null,
    title: 'Ações',
    render: (data, type, row) => {
      return `<button class='btn btn-warning btn-sm' onclick='window.dispatchEvent(new CustomEvent("editarProvincia", { detail: ${JSON.stringify(row)} }))'>
                <i class='fa-solid fa-pen-to-square'></i>Editar
              </button>`
    }
  }
]

onMounted(async () => {
  try {
    const response = await axios.get('/provincia-list')
    provincias.value = response.data
  } catch (error) {
    console.error('Erro ao carregar províncias:', error)
  }

  window.addEventListener('editarProvincia', (e) => {
    emit('editar', e.detail)
  })
})
</script>

<template>
  <div>
    <h2>Lista de Províncias</h2>
    <DataTable class="table table-hover" :data="provincias" :columns="columns" />
  </div>
</template>