class User {
  constructor () {
    this.loading = false
    this.prestine = true

    this.data = {
      firstname: '',
      middlename: '',
      lastname: '',
      username: '',
      email: '',
      password: '',
      password_confirmation: '',
      photo: '',
      details: {
        Gender: {key: trans('Gender'), value: '', icon: ''},
        Birthday: {key: trans('Birthday'), value: '', icon: 'mdi-cake-variant'},
        'Marital Status': {key: trans('Marital Status'), value: '', icon: ''},
        'Mobile Phone': {key: trans('Mobile Phone'), value: '', icon: 'mdi-cellphone-android'},
        'Home Address': {key: trans('Home Address'), value: '', icon: 'mdi-map-marker'},
        more: [],
      },
      roles: [],
    }

    this.gender = {
      items: [
        { color: 'gray', icon: 'mdi-help', key: 'None', value: null },
        { color: 'blue', icon: 'mdi-gender-male', key: 'Male', value: 'Male' },
        { color: 'pink', icon: 'mdi-gender-female', key: 'Female', value: 'Female' },
        { color: 'gray', icon: 'mdi-gender-male-female', key: 'Unspecified', value: 'Unspecified' },
      ],
    }

    this.maritalStatus = {
      items: [
        { icon: 'mdi-checkbox-blank-circle-outline', text: 'Unspecified', value: null },
        { icon: 'mdi-human-handsup', text: 'Single', value: 'Single' },
        { icon: 'mdi-human-male-female', text: 'Married', value: 'Married' },
        { icon: 'mdi-ring', text: 'Widowed', value: 'Widowed' },
        { icon: 'mdi-heart-broken', text: 'Separated', value: 'Separated' },
      ],
    }
  }

  changeMaritalStatusIcon (item) {
    return item && item.icon || 'mdi-checkbox-blank-circle-outline'
  }

  changeGenderIcon (item) {
    return item && item.icon || 'mdi-gender-male-female'
  }
}

export default new User()
