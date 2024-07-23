import axios from 'axios';
import Alpine from 'alpinejs';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (typeof(window.Alpine) === 'undefined') {
    // Manually start up Alpine so it works on cached pages when Livewire doesn't load
    window.Alpine = Alpine;

    Alpine.start();
}
