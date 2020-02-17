import $api from '@/routes/api'

export default function tokenVerifier(to, from, next) {
  window.axios.post(
    $api.validate.token
  ).then(response => {
    next();
  }).catch(error => {
    next({name: 'login', query: { from: window.location.pathname }})
  });
}
