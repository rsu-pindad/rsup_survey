import './bootstrap';
// import 'preline';
import 'preline/preline.js';
import '../../node_modules/preline/dist/preline.js';
import '@preline/accordion';
import '@preline/dropdown';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import moment from '@victoryoalli/alpinejs-moment';
import timeout from '@victoryoalli/alpinejs-timeout';
import { createIcons, Menu, ArrowRight, Globe, Instagram, Twitter, Facebook, Youtube, UserPen, LogOut } from '../../node_modules/lucide';
// import spacetime from '../../node_modules/spacetime';
import { directive } from '@wireui/alpinejs-hold-directive';

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
        LogOut
    }
});

// window.spacetime = spacetime;
window.Livewire = Livewire;
window.Alpine = Alpine;
Alpine.directive('hold', directive)
Alpine.plugin(moment);
Alpine.plugin(timeout);

// window.Alpine.start();
window.Livewire.start();