<template>
  <div>
    <nav>
      <button @click="componenteAtual = 'ciclo-form'">Ciclo Form</button>
      <button @click="componenteAtual = 'ciclo-list'">Ciclo List</button>
      <button @click="componenteAtual = 'provincia-form'">Província Form</button>
      <button @click="componenteAtual = 'provincia-list'">Província List</button>
      <!-- Adicione outros botões conforme necessário -->
       <button @click="componenteAtual = 'ano-curricular-form'">Ano Curricular Form</button>
      <button @click="componenteAtual = 'ano-curricular-list'">Ano Curricular List</button>
      <button @click="componenteAtual = 'ano-academico-form'">Ano Académico Form</button>
      <button @click="componenteAtual = 'ano-academico-list'">Ano Académico List</button>
      <button @click="componenteAtual = 'nivel-ensino-form'">Nível de ensino</button>
        <button @click="componenteAtual = 'nivel-ensino-list'">Nível de ensino List</button>
        <button @click="componenteAtual = 'disciplina-form'">Disciplina Form</button>
        <button @click="componenteAtual = 'disciplina-list'">Disciplina List</button>
        <button @click="componenteAtual = 'nivel-academico-form'">Nível Académico Form</button>
        <button @click="componenteAtual = 'nivel-academico-list'">Nível Académico List</button>

    </nav>
    <component :is="componenteAtual" />
  </div>
</template>

<script setup>
import { ref } from 'vue'

const componenteAtual = ref('ciclo-form')
</script>