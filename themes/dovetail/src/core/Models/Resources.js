import Resource from './Resource'

export default class Resources extends Resource {
  constructor () {
    super()
    this.search = null,
    this.options = {
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      sortDesc: [],
      sortBy: [],
      // rowsPerPage: [5, 10, 15, 20, 50, 100],
    }
    this.meta = {}
    this.modes = {
      bulkedit: false,
    }
    this.selected = []
    this.data = []
  }
}