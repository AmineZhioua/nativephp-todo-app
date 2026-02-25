import './bootstrap';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import TestComp from './components/TestComp.vue';

const app = createApp({});

app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

app.component("test-comp", TestComp);

app.mount('#app');
