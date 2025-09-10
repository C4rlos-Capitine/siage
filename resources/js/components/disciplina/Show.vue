<script setup>
import { ref, onMounted } from "vue"
import axios from "axios"

const props = defineProps({
  disciplinaId: {
    type: Number,
    required: true
  }
})

const disciplina = ref(null)
const loading = ref(true)
const erro = ref("")

onMounted(async () => {
  try {
    const response = await axios.get(`/disciplina/${props.disciplinaId}`)
    disciplina.value = response.data
  } catch (err) {
    erro.value = "Erro ao carregar detalhes da disciplina."
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <div class="container mt-3">
    <div v-if="loading" class="alert alert-info">Carregando...</div>
    <div v-else-if="erro" class="alert alert-danger">{{ erro }}</div>
    <div v-else-if="disciplina" class="card shadow">
      <div class="card-header">
        <h3>{{ disciplina.designacao }} ({{ disciplina.abreviatura }})</h3>
      </div>
      <div class="card-body">
        <p><strong>ID:</strong> {{ disciplina.id_disciplina }}</p>
        <p><strong>Área Curricular:</strong> {{ disciplina.area_curricular }}</p>
        <p><strong>Nível de Ensino:</strong> {{ disciplina.nivel_ensino }}</p>
      </div>
      <div class="card-footer">
        <button class="btn btn-secondary" @click="$emit('voltar')">
          Voltar
        </button>
      </div>
    </div>
  </div>
</template>
