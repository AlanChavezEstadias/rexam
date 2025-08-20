import './bootstrap';
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    flatpickr("[data-datepicker]", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "es"
    });
});
