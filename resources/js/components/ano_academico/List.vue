<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const anos = ref([])
const emit = defineEmits(['editar', 'consultar'])

const columns = [
  { data: 'id_ano_academico', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  { data: 'data_inicio', title: 'Início' },
  { data: 'data_fim', title: 'Fim' },
  {
    data: 'estado',
    title: 'Estado',
    render: (data) => `<span style="color:${data ? 'green' : 'red'}">${data ? 'Ativo' : 'Inativo'}</span>`
  },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `
        <button class='btn btn-warning btn-sm me-1'
          onclick='window.dispatchEvent(new CustomEvent("editarAno", { detail: ${JSON.stringify(row)} }))'>
          <i class='fa-solid fa-pen-to-square'></i> Editar
        </button>
        <button class='btn btn-info btn-sm'
          onclick='window.dispatchEvent(new CustomEvent("consultarAno", { detail: ${JSON.stringify(row)} }))'>
          <i class='fa-solid fa-eye'></i> Consultar
        </button>
      `;
    }
  }
]

onMounted(async () => {
  try {
    const response = await axios.get('/ano_academico-list')
    anos.value = response.data
  } catch (err) {
    console.error('Erro ao carregar anos:', err)
  }

  window.addEventListener('editarAno', (e) => emit('editar', e.detail))
  window.addEventListener('consultarAno', (e) => emit('consultar', e.detail))
})
</script>

<template>
  <div class="container mt-4">
    <h2>Lista de Anos Acadêmicos</h2>
    <DataTable class="table table-hover" :data="anos" :columns="columns" />
  </div>
</template>
