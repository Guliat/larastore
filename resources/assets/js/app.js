require('./bootstrap');

window.Vue = require('vue');

import Buefy from 'buefy'
import VeeValidate from 'vee-validate';
import bg from 'vee-validate/dist/locale/bg';


import VueAgile from 'vue-agile';

Vue.use(VueAgile);

Vue.use(Buefy);

VeeValidate.Validator.addLocale(bg);
Vue.use(VeeValidate, { locale: 'bg' });
VeeValidate.Validator.setLocale('bg');



// Vue.component('example-component', require('./components/ExampleComponent.vue'));

document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
