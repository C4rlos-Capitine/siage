<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const emit = defineEmits(['editar'])

const ciclos = ref([])

const columns = [
  { data: 'id_ciclo', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `<button class='btn btn-warning btn-sm' onclick='window.dispatchEvent(new CustomEvent("editarCiclo", { detail: ${JSON.stringify(row)} }))'>
                <i class='fa-solid fa-pen-to-square'></i>Editar
              </button>`
    }
  }
]

onMounted(async () => {
  try {
    const response = await axios.get('/ciclo-list')
    ciclos.value = response.data
  } catch (error) {
    console.error('Erro ao buscar ciclos:', error)
  }

  window.addEventListener('editarCiclo', (e) => {
    emit('editar', e.detail)
  })
})
</script>

<template>
  <div>
    <h2>Lista de Ciclos</h2>
    <DataTable class="table table-hover" :data="ciclos" :columns="columns" />
  </div>
</template>