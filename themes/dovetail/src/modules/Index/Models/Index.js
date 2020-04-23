class Index {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []

    this.data = {
      name: '',
      alias: '',
      code: '',
      description: '',
      type: '',
      icon: '',
      metadata: {
        weightage: '',
        color: '',
        name_arabic: '',
        description_arabic: '',
      },
      created: '',
    }
  }
}

export default Index
