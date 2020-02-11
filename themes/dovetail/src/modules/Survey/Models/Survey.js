class Survey {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []

    this.data = {
      title: '',
      code: '',
      body: '',
      metadata: '',
      type: '',
      user_id: '',
      created: '',
      indices: [],
      answer: '',
      fields: [
        {
          group: '',
          type: '',
          children: [],
        }
      ]
    }
  }
}

export default Survey
