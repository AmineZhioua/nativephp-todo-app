import './bootstrap';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import LoginForm from './components/LoginForm.vue';
import RegisterForm from './components/RegisterForm.vue';
import TodoSection from './components/TodoSection.vue';

const app = createApp({});

app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);
app.component("todo-section", TodoSection);

app.mount('#app');
