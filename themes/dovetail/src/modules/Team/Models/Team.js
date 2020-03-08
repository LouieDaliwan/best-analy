class Team {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []
    this.users = []
    this.managers = []
    this.selected = []

    this.data = {
      code: '',
      created: '',
      description: '',
      icon: '',
      name: '',
      selected: [],
      users: [],
      manager_id: '',
      lead: {},
      members: [],
    }
  }
}

export default Team
