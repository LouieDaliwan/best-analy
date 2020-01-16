import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate'
import { required, email, min, confirmed } from 'vee-validate/dist/rules'

extend('required', {
  ...required,
  message: trans('The {_field_} field is required', {
    _field_: '{_field_}',
  }),
})

extend('email', {
  ...email,
  message: trans('The {_field_} field is not valid', {
    _field_: '{_field_}',
  }),
})

extend('min', {
  ...min,
  message: trans('The {_field_} field must be at least {length} characters long', {
    _field_: '{_field_}',
    length: '{length}',
  }),
})

extend('confirmed', {
  ...confirmed,
  message: trans('The {_field_} must match with the {target} field', {
    _field_: '{_field_}',
    target: '{target}',
  }),
})

Vue.component('validation-provider', ValidationProvider)
Vue.component('validation-observer', ValidationObserver)
