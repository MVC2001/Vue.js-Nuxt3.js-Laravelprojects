import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

// Import Font Awesome related libraries
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';

// Add Font Awesome solid icons to the library
library.add(fas);

// Register the FontAwesomeIcon component globally
const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);

// Use plugins
app.use(store).use(router).mount('#app');
