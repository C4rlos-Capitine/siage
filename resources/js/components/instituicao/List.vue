<script setup>
import { onMounted } from 'vue'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const props = defineProps({
  instituicoes: Array
})

const emit = defineEmits(['editar', 'mostrar'])

const columns = [
  //{ data: 'id_instituicao', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  { data: 'abreviatura', title: 'Abreviatura' },
  { data: 'endereco', title: 'Endereço' },
  { data: 'telefone', title: 'Telefone' },
  { data: 'email', title: 'Email' },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `
        <button class='btn btn-info btn-sm me-1' onclick='window.dispatchEvent(new CustomEvent("mostrarInstituicao", { detail: ${JSON.stringify(row)} }))'>
          <i class='fa-solid fa-eye'></i> Visualizar
        </button>
        <button class='btn btn-warning btn-sm' onclick='window.dispatchEvent(new CustomEvent("editarInstituicao", { detail: ${JSON.stringify(row)} }))'>
          <i class='fa-solid fa-pen-to-square'></i> Editar
        </button>
      `
    }
  }
]

onMounted(() => {
  window.addEventListener('editarInstituicao', (e) => emit('editar', e.detail))
  window.addEventListener('mostrarInstituicao', (e) => emit('mostrar', e.detail))
})
</script>

<template>
  <div>
    <h2>Lista de Instituições de Ensino</h2>
    <DataTable class="table table-hover border" :data="props.instituicoes" :columns="columns" />
  </div>
</template>
