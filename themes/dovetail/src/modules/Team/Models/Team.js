class Team {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []
    this.users = []
    this.selected = []

    this.data = {
      name: '',
      code: '',
      description: '',
      icon: '',
      created: '',
      users: [],
      selected: [],
    }
  }
}

export default Team
