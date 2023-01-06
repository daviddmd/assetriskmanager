import './bootstrap';
import 'flowbite';
import 'flowbite/dist/datepicker';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

window.Alpine = Alpine;
Alpine.plugin(focus);


Alpine.start();
