<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  ciclo: {
    type: Object,
    default: () => ({ id: null, designacao: '' })
  }
})

const emit = defineEmits(['atualizado', 'cancelar'])

const formData = ref({ ...props.ciclo })

watch(() => props.ciclo, (novo) => {
  formData.value = { ...novo }
}, { immediate: true })

async function atualizar() {
  if (!formData.value.designacao) {
    alert('Preencha a designação!');
    return;
  }
  try {
    await axios.put(`/ciclo/${formData.value.id}`, { designacao: formData.value.designacao })
    emit('atualizado')
  } catch (error) {
    alert('Erro ao atualizar ciclo.')
  }
}
</script>

<template>
  <div>
    <h2>Editar Ciclo</h2>
    <form @submit.prevent="atualizar">
      <div>
        <label>Designação:</label>
        <input v-model="formData.designacao" type="text" />
      </div>
      <button type="submit">Atualizar</button>
      <button type="button" @click="emit('cancelar')">Cancelar</button>
    </form>
  </div>
</template>