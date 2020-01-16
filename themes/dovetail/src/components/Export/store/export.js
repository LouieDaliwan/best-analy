export const state = () => ({
  export: {
    show: true,
    color: 'primary',
    title: 'Sample',
    items: [
      {
        icon: 'mdi-file-pdf',
        color: 'error',
        name: 'Portable Documment Format (.pdf)',
        value: 'pdf',
      },
      {
        icon: 'mdi-google-spreadsheet',
        color: 'green',
        name: 'Microsoft Excel (.xlsx)',
        value: 'xlsx',
      },
      {
        icon: 'mdi-file-document',
        color: 'blue',
        name: 'Open Document Format (.ods)',
        value: 'ods',
      }
    ]
  }
})

export const getters = {
  export: state => state.export
}

export const mutations = {
  emptyState () {
    this.replaceState({ header: null })
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations
}
