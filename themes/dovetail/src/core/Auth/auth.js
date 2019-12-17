class Auth {
  constructor () {
    this.token = null;
    this.user = null;
  }

  authorize (token, user) {
    window.localStorage.setItem('token', token)
    window.localStorage.setItem('user', JSON.stringify(user))
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    this.token = token;
    this.user = user;
  }

  getUser () {
    return JSON.parse(window.localStorage.getItem('user') || '{}')
  }

  check () {
    return !! this.token;
  }
}

export default new Auth()
