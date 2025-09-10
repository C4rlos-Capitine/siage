<script setup>
import { onMounted } from 'vue'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const props = defineProps({
  disciplinas: Array
})

const emit = defineEmits(['editar', 'mostrar'])

const columns = [
  { data: 'designacao', title: 'Designação' },
  { data: 'abreviatura', title: 'Abreviatura' },
  { data: 'area_curricular_designacao', title: 'Área Curricular' },
  { data: 'nivel_ensino_designacao', title: 'Nível de Ensino' },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `
        <button class='btn btn-warning btn-sm me-2' 
          onclick='window.dispatchEvent(new CustomEvent("editarDisciplina", { detail: ${JSON.stringify(row)} }))'>
          <i class='fa-solid fa-pen-to-square'></i> Editar
        </button>
        <button class='btn btn-info btn-sm' 
          onclick='window.dispatchEvent(new CustomEvent("mostrarDisciplina", { detail: ${JSON.stringify(row)} }))'>
          <i class='fa-solid fa-eye'></i> Consultar
        </button>
      `
    }
  }
]

onMounted(() => {
  window.addEventListener('editarDisciplina', (e) => emit('editar', e.detail))
  window.addEventListener('mostrarDisciplina', (e) => emit('mostrar', e.detail))
})
</script>

<template>
  <div>
    <h2>Lista de Disciplinas</h2>
    <DataTable class="table table-hover border" :data="props.disciplinas" :columns="columns" />
  </div>
</template>
