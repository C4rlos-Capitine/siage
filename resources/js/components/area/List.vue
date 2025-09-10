<script setup>
import { onMounted } from 'vue'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net-dt'

DataTable.use(DataTablesCore)

const props = defineProps({
  areas: Array
})

const emit = defineEmits(['editar'])

const columns = [
  { data: 'id_area_curricular', title: 'ID' },
  { data: 'designacao', title: 'Designação' },
  { data: 'abreviatura', title: 'Abreviatura' },
  {
    data: null,
    title: 'Ação',
    render: (data, type, row) => {
      return `<button class='btn btn-warning btn-sm' onclick='window.dispatchEvent(new CustomEvent("editarAreaCurricular", { detail: ${JSON.stringify(row)} }))'>
                <i class='fa-solid fa-pen-to-square'></i>Editar
              </button>`
    }
  }
]

onMounted(() => {
  window.addEventListener('editarAreaCurricular', (e) => {
    emit('editar', e.detail)
  })
})
</script>

<template>
  <div>
    <h2>Lista de Áreas Curriculares</h2>
    <DataTable class="table table-hover border" :data="props.areas" :columns="columns" />
  </div>
</template>