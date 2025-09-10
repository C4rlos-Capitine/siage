/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import CicloForm from './components/ciclo/Create.vue';
import CicloList from './components/ciclo/List.vue';
import MainCiclo from './components/ciclo/Main.vue';
import MainProvincia from './components/provincia/Main.vue';
import MainAnoCurricular from './components/ano_curricular/Main.vue';
import MainAnoAcademico from './components/ano_academico/Main.vue';
import MainAreaCurricular from './components/area/Main.vue';
import MainInstituicaoEnsino from './components/instituicao/Main.vue';
import MainNivelEnsino from './components/nivel_ensino/Main.vue';
import MainDisciplina from './components/disciplina/Main.vue';
import MainApp from './components/Main.vue';

app.component('main-app', MainApp);

//app.component('example-component', ExampleComponent);
app.component('ciclo-form', CicloForm);
app.component('ciclo-list', CicloList);
app.component('main-ciclo', MainCiclo);
app.component('main-provincia', MainProvincia);
app.component('main-ano_curricular', MainAnoCurricular)
app.component('main-ano_cademico', MainAnoAcademico);
app.component('main-area_curricular',MainAreaCurricular)
app.component('main-instituicao_ensino', MainInstituicaoEnsino);
app.component('main-nivel_ensino', MainNivelEnsino);
app.component('main-instituicao_ensino', MainInstituicaoEnsino);
app.component('main-disciplina', MainDisciplina)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
