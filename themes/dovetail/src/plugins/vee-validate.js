import Vue from 'vue';
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'The {_field_} field is required'
});

Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);
