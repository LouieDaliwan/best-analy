export default class Resource {
  constructor() {
    this.isFetching = true
    this.isLoading = false
    this.isFetching = true
    this.isPrestine = true
    this.isValid = true
    this.errors = []

    this.data = {

    }

    this.hasData = false
  }

  fetch(val = true) {
    this.isFetching = val
  }

  load(val = true) {
    this.isLoading = val
  }

  load(val = true) {
    this.isLoading = val
  }

  fetch(val = true) {
    this.isFetching = val
  }

  prestine(val = true) {
    this.isPrestine = val
  }

  valid(val = true) {
    this.isValid = val
  }

  setHasData(val = true) {
    this.hasData = val
  }

  setErrors(val = []) {
    this.errors = val
  }

  setData(data = []) {
    this.data = data
  }

  isDisabled() {
    return this.isLoading || this.isPrestine
  }

  parseData(elem, update = false) {
    let
      data = { ...this.data },
      formData = new FormData(elem)

    if (update) formData.append('_method', 'put')

    data = formData

    return data
  }
}