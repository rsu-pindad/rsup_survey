import './bootstrap';
import 'preline';
import "../../node_modules/quill/dist/quill.core.css";
import '@preline/accordion';
import '@preline/dropdown';
import {
    Livewire,
    Alpine
} from '../../vendor/livewire/livewire/dist/livewire.esm';
import moment from '@victoryoalli/alpinejs-moment';
import timeout from '@victoryoalli/alpinejs-timeout';
import {
    createIcons,
    Menu,
    ArrowRight,
    Globe,
    Instagram,
    Twitter,
    Facebook,
    Youtube,
    UserPen,
    LogOut,
    FileChartColumn
} from '../../node_modules/lucide';
import {
    directive
} from '@wireui/alpinejs-hold-directive';
// import ApexCharts from 'apexcharts';
import AsyncAlpine from '../../node_modules/async-alpine';
import Quill from 'quill';
import flatpickr from 'flatpickr';
import './../../vendor/power-components/livewire-powergrid/dist/powergrid';
import './../../vendor/power-components/livewire-powergrid/dist/tailwind.css';
import "flatpickr/dist/flatpickr.min.css";
// import persist from '@alpinejs/persist';

createIcons({
    icons: {
        Menu,
        ArrowRight,
        Globe,
        Instagram,
        Twitter,
        Facebook,
        Youtube,
        UserPen,
        LogOut,
        FileChartColumn
    }
});

window.flatpickr = flatpickr;
window.Livewire = Livewire;
// window.ApexCharts = ApexCharts;
window.Alpine = Alpine;
window.Quill = Quill;
Alpine.directive('hold', directive)
// Alpine.plugin(persist);
Alpine.plugin(AsyncAlpine);
Alpine.plugin(moment);
Alpine.plugin(timeout);

// window.Alpine.start();
window.Livewire.start();
