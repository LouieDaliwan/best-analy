class Survey {
  constructor () {
    this.loading = false
    this.isPrestine = true
    this.isValid = true
    this.errors = []

    this.data = {
      title: '',
      title_arabic: '',
      code: '',
      body: '',
      body_arabic: '',
      metadata: {
        title_arabic: '',
        body_arabic: '',
      },
      type: '',
      user_id: '',
      created: '',
      indices: [],
      answer: '',
      fields: [
        {
          group: '',
          group_arabic: '',
          type: '',
          children: [],
        }
      ],
    }
  }
}

export default Survey
