export default [
  {
    code: "indices",
    name: "indices",
    meta: {
      title: "Component",
      icon: "mdi-credit-card-outline",
      authenticatable: true,
      sort: 5,
      permission: "indices.index",
      children: [
        "indices.index",
        "indices.create",
        "indices.edit",
        "indices.trashed",
        "indices.settings"
      ]
    },
    children: [
      {
        code: "indices.index",
        name: "indices.index",
        meta: {
          title: "All Components",
          authenticatable: true,
          sort: 5,
          permission: "indices.index",
          children: ["indices.index", "indices.edit"]
        }
      },
      {
        code: "indices.create",
        name: "indices.create",
        meta: {
          title: "Add Component",
          authenticatable: true,
          sort: 6,
          permission: "indices.create"
        }
      },
      {
        code: "indices.trashed",
        name: "indices.trashed",
        meta: {
          title: "Trashed Components",
          authenticatable: true,
          sort: 5,
          permission: "indices.trashed"
        }
      },
      {
        code: "indices.settings",
        name: "indices.settings",
        meta: {
          title: "Translations",
          authenticatable: true,
          sort: 7,
          permission: "indices.settings"
        }
      }
    ]
  }
];
