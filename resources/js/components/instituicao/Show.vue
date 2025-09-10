<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  instituicao: Object
})

</script>

<template>
  <div class="container mt-3">
    <h2>Detalhes da Instituição</h2>
    <div class="card p-3">
      <p><strong>ID:</strong> {{ instituicao.id_instituicao }}</p>
      <p><strong>Designação:</strong> {{ instituicao.designacao }}</p>
      <p><strong>Abreviatura:</strong> {{ instituicao.abreviatura }}</p>
      <p><strong>Endereço:</strong> {{ instituicao.endereco }}</p>
      <p><strong>Telefone:</strong> {{ instituicao.telefone }}</p>
      <p><strong>Email:</strong> {{ instituicao.email }}</p>
    </div>
  </div>
</template>
