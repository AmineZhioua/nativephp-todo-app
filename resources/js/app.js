import './bootstrap';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import TodoSection from './components/TodoSection.vue';
import { ToastService } from 'primevue';

const app = createApp({});

app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

app.use(ToastService);

app.component("todo-section", TodoSection);

app.mount('#app');
