<script setup>
import { ref } from 'vue'
import AnoAcademicoForm from './Create.vue'
import AnoAcademicoList from './List.vue'
import AnoAcademicoShow from './Show.vue'

const componenteAtual = ref('list')
const anos = ref([])

const anoSelecionado = ref(null)

function novoAno() {
  anoSelecionado.value = { id_ano_academico: null, designacao: '', data_inicio: '', data_fim: '', estado: true }
  componenteAtual.value = 'form'
}

function editarAno(ano) {
  anoSelecionado.value = { ...ano }
  componenteAtual.value = 'form'
}

function consultarAno(ano) {
  anoSelecionado.value = { ...ano }
  componenteAtual.value = 'show'
}

function salvarAno(ano) {
  if (ano.id_ano_academico) {
    const index = anos.value.findIndex(a => a.id_ano_academico === ano.id_ano_academico)
    if (index !== -1) anos.value[index] = { ...ano }
  } else {
    ano.id_ano_academico = anos.value.length + 1
    anos.value.push({ ...ano })
  }
  setTimeout(() => {
    componenteAtual.value = 'list'
  }, 2000)
}
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Anos Acadêmicos</a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a 
                class="nav-link" 
                href="#" 
                @click.prevent="novoAno"
                :class="{ active: componenteAtual === 'form' }"
              >
                Novo Ano Acadêmico
              </a>
            </li>

            <li class="nav-item">
              <a 
                class="nav-link" 
                href="#" 
                @click.prevent="componenteAtual = 'list'"
                :class="{ active: componenteAtual === 'list' }"
              >
                Listar
              </a>
            </li>
            <li class="nav-item">
            <a 
              class="nav-link"
              href="#"
              @click.prevent="componenteAtual='show'"
              :class="{ active: componenteAtual === 'show' }"
            >
              Consultar
            </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <AnoAcademicoList
      v-if="componenteAtual === 'list'"
      :anos="anos"
      @editar="editarAno"
      @consultar="consultarAno"
    />

    <AnoAcademicoForm
      v-if="componenteAtual === 'form'"
      :ano="anoSelecionado"
      @salvar="salvarAno"
    />

    <AnoAcademicoShow
      v-if="componenteAtual === 'show'"
      :ano="anoSelecionado"
    />
  </div>
</template>
