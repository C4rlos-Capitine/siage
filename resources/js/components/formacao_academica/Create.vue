<template>
  <form @submit.prevent="submitForm">
    <div>
      <label for="nome_curso">Nome do Curso:</label>
      <input
        type="text"
        id="nome_curso"
        v-model="nome_curso"
        maxlength="100"
        required
      />
    </div>
    <div>
      <label for="id_instituicao_ensino">Instituição de Ensino:</label>
      <select id="id_instituicao_ensino" v-model="id_instituicao_ensino" required>
        <option value="" disabled>Selecione</option>
        <option v-for="inst in instituicoes" :key="inst.id_instituicao_ensino" :value="inst.id_instituicao_ensino">
          {{ inst.nome }}
        </option>
      </select>
    </div>
    <div>
      <label for="id_nivel_academico">Nível Acadêmico:</label>
      <select id="id_nivel_academico" v-model="id_nivel_academico" required>
        <option value="" disabled>Selecione</option>
        <option v-for="nivel in niveis" :key="nivel.id_nivel_academico" :value="nivel.id_nivel_academico">
          {{ nivel.designacao }}
        </option>
      </select>
    </div>
    <button type="submit">Registrar Formação Acadêmica</button>
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const nome_curso = ref('')
const id_instituicao_ensino = ref('')
const id_nivel_academico = ref('')
const instituicoes = ref([])
const niveis = ref([])

onMounted(async () => {
  try {
    const instRes = await axios.get('/instituicao_ensino')
    instituicoes.value = instRes.data
    const nivelRes = await axios.get('/nivel_academico')
    niveis.value = nivelRes.data
  } catch (error) {
    alert('Erro ao carregar dados para o formulário.')
  }
})

const submitForm = async () => {
  try {
    await axios.post('/formacao_academica', {
      nome_curso: nome_curso.value,
      id_instituicao_ensino: id_instituicao_ensino.value,
      id_nivel_academico: id_nivel_academico.value
    })
    alert('Formação Acadêmica registrada com sucesso!')
    nome_curso.value = ''
    id_instituicao_ensino.value = ''
    id_nivel_academico.value = ''
  } catch (error) {
    alert('Erro ao registrar formação acadêmica.')
  }
}
</script>