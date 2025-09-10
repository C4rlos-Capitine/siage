<script setup>
import { onMounted } from 'vue'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const props = defineProps({
  niveis: Array
})

const emit = defineEmits(['editar'])

const columns = [
  { data: 'id_nivel_ensino', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  { data: 'abreviatura', title: 'Abreviatura' },
  { data: 'ordem', title: 'Ordem' },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `<button class='btn btn-warning btn-sm' onclick='window.dispatchEvent(new CustomEvent("editarNivelEnsino", { detail: ${JSON.stringify(row)} }))'>
                <i class='fa-solid fa-pen-to-square'></i> Editar
              </button>`
    }
  }
]

onMounted(() => {
  window.addEventListener('editarNivelEnsino', (e) => {
    emit('editar', e.detail)
  })
})
</script>

<template>
  <div>
    <h2>Lista de Níveis de Ensino</h2>
    <DataTable class="table table-hover border" :data="props.niveis" :columns="columns" />
  </div>
</template>
