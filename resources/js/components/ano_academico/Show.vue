<script setup>
const props = defineProps({
  ano: Object
})
</script>

<template>
  <div class="card mt-4">
    <div class="card-header">
      <h4>Detalhes do Ano Acadêmico</h4>
    </div>
    <div class="card-body">
      <p><strong>ID:</strong> {{ ano.id_ano_academico }}</p>
      <p><strong>Designação:</strong> {{ ano.designacao }}</p>
      <p><strong>Data de Início:</strong> {{ ano.data_inicio }}</p>
      <p><strong>Data de Fim:</strong> {{ ano.data_fim }}</p>
      <p>
        <strong>Estado:</strong>
        <span :class="ano.estado ? 'text-success' : 'text-danger'">
          {{ ano.estado ? 'Ativo' : 'Inativo' }}
        </span>
      </p>
            <div class="card-footer">
        <button class="btn btn-secondary" @click="$emit('voltar')">
          Voltar
        </button>
      </div>
    </div>
  </div>
</template>
