(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Trashed.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Trashed.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/store */ "./src/store/index.js");
/* harmony import */ var _partials_EmptyState__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./partials/EmptyState */ "./src/modules/Page/partials/EmptyState.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  store: _store__WEBPACK_IMPORTED_MODULE_0__["default"],
  name: 'Trashed',
  components: {
    EmptyState: _partials_EmptyState__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  data: function data() {
    return {
      dataset: {
        loaded: true
      },
      bulk: {
        destroy: {
          model: false
        }
      },
      toolbar: {
        homeBtn: {
          name: 'pages.index'
        },
        title: 'Trashed Pages',
        color: '',
        listGridView: false,
        createBtn: {
          name: 'pages.create'
        },
        tooltipName: 'All Pages'
      },
      resources: {
        items: [],
        selected: [],
        data: null,
        showBulk: false,
        pagination: {
          sortBy: 'title'
        },
        headers: [{
          text: 'ID',
          align: 'left',
          value: 'id'
        }, {
          text: 'Title',
          align: 'left',
          value: 'title'
        }, {
          text: 'Code',
          align: 'left',
          value: 'code'
        }, {
          text: 'Author',
          align: 'left',
          value: 'user_id'
        }, {
          text: 'Created',
          align: 'left',
          value: 'created_at'
        }, {
          text: 'Modified',
          align: 'left',
          value: 'updated_at'
        }, {
          text: 'Actions',
          align: 'center',
          sortable: false
        }]
      }
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/api/v1/pages/trashed').then(function (response) {
      _this.resources.items = response.data.data;
    });
  },
  methods: {
    toggleAll: function toggleAll() {
      if (this.resources.selected.length) this.resources.selected = [];else this.resources.selected = this.items.slice();
    },
    changeSort: function changeSort(column) {
      if (this.resources.pagination.sortBy === column) {
        this.resources.pagination.descending = !this.resources.pagination.descending;
      } else {
        this.resources.pagination.sortBy = column;
        this.resources.pagination.descending = false;
      }
    },
    restoreData: function restoreData(id) {
      var _this2 = this;

      return axios.get("/api/v1/pages/restore/".concat(id)).then(function (response) {
        _this2.resources.items = response.data;
      });
    },
    deleteData: function deleteData(id) {
      var _this3 = this;

      axios.delete("/api/v1/pages/delete/".concat(id)).then(function (response) {
        _this3.resources.items.splice(_this3.resources.items.indexOf(id), 1);

        console.log('deleted');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/partials/EmptyState.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_Icons_ManOnLaptop__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/components/Icons/ManOnLaptop */ "./src/components/Icons/ManOnLaptop.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'EmptyState',
  components: {
    ManOnLaptop: _components_Icons_ManOnLaptop__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.icon--disabled {\n  -webkit-filter: grayscale(0.8);\n          filter: grayscale(0.8);\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmptyState.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Trashed.vue?vue&type=template&id=fb009890&":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Trashed.vue?vue&type=template&id=fb009890& ***!
  \***************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "section",
    [
      _vm.dataset.loaded
        ? [
            _c(
              "v-container",
              { attrs: { "grid-list-lg": "" } },
              [
                _c(
                  "v-layout",
                  { attrs: { row: "", wrap: "" } },
                  [
                    _c(
                      "v-flex",
                      { attrs: { xs12: "" } },
                      [
                        _c("toolbar-trashed", {
                          attrs: { items: _vm.toolbar }
                        }),
                        _vm._v(" "),
                        _c(
                          "v-toolbar",
                          [
                            _c("v-spacer"),
                            _vm._v(" "),
                            _c(
                              "v-btn",
                              {
                                attrs: { icon: "" },
                                nativeOn: {
                                  click: function($event) {
                                    _vm.resources.showBulk = !_vm.resources
                                      .showBulk
                                  }
                                },
                                model: {
                                  value: _vm.resources.showBulk,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resources, "showBulk", $$v)
                                  },
                                  expression: "resources.showBulk"
                                }
                              },
                              [
                                _c("v-icon", [
                                  _vm._v(
                                    "mdi-checkbox-multiple-marked-circle-outline"
                                  )
                                ])
                              ],
                              1
                            )
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "v-card",
                          { staticClass: "sticky" },
                          [
                            _c("v-data-table", {
                              staticClass: "elevation-1",
                              attrs: {
                                headers: _vm.resources.headers,
                                items: _vm.resources.items,
                                pagination: _vm.resources.pagination,
                                "item-key": "title",
                                "select-all": ""
                              },
                              on: {
                                "update:pagination": function($event) {
                                  _vm.$set(_vm.resources, "pagination", $event)
                                }
                              },
                              scopedSlots: _vm._u([
                                {
                                  key: "headers",
                                  fn: function(props) {
                                    return [
                                      _c(
                                        "tr",
                                        [
                                          _c(
                                            "th",
                                            {
                                              directives: [
                                                {
                                                  name: "show",
                                                  rawName: "v-show",
                                                  value: _vm.resources.showBulk,
                                                  expression:
                                                    "resources.showBulk"
                                                }
                                              ]
                                            },
                                            [
                                              _c("v-checkbox", {
                                                attrs: {
                                                  indeterminate:
                                                    props.indeterminate,
                                                  "input-value": props.all,
                                                  "hide-details": "",
                                                  primary: ""
                                                },
                                                on: {
                                                  click: function($event) {
                                                    $event.stopPropagation()
                                                    return _vm.toggleAll($event)
                                                  }
                                                }
                                              })
                                            ],
                                            1
                                          ),
                                          _vm._v(" "),
                                          _vm._l(props.headers, function(
                                            header
                                          ) {
                                            return _c(
                                              "th",
                                              {
                                                key: header.text,
                                                class: [
                                                  "column sortable",
                                                  _vm.resources.pagination
                                                    .descending
                                                    ? "desc"
                                                    : "asc",
                                                  header.value ===
                                                  _vm.resources.pagination
                                                    .sortBy
                                                    ? "active"
                                                    : ""
                                                ],
                                                on: {
                                                  click: function($event) {
                                                    _vm.changeSort(header.value)
                                                  }
                                                }
                                              },
                                              [
                                                _c(
                                                  "v-icon",
                                                  { attrs: { small: "" } },
                                                  [_vm._v("arrow_upward")]
                                                ),
                                                _vm._v(
                                                  "\n                    " +
                                                    _vm._s(header.text) +
                                                    "\n                  "
                                                )
                                              ],
                                              1
                                            )
                                          })
                                        ],
                                        2
                                      )
                                    ]
                                  }
                                },
                                {
                                  key: "items",
                                  fn: function(props) {
                                    return [
                                      _c(
                                        "tr",
                                        {
                                          attrs: { active: props.selected },
                                          on: {
                                            click: function($event) {
                                              props.selected = !props.selected
                                            }
                                          }
                                        },
                                        [
                                          _c(
                                            "td",
                                            {
                                              directives: [
                                                {
                                                  name: "show",
                                                  rawName: "v-show",
                                                  value: _vm.resources.showBulk,
                                                  expression:
                                                    "resources.showBulk"
                                                }
                                              ]
                                            },
                                            [
                                              _c("v-checkbox", {
                                                attrs: {
                                                  "input-value": props.selected,
                                                  primary: "",
                                                  "hide-details": ""
                                                }
                                              })
                                            ],
                                            1
                                          ),
                                          _vm._v(" "),
                                          _c("td", {
                                            domProps: {
                                              innerHTML: _vm._s(props.item.id)
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            { staticClass: "table--ellipsis" },
                                            [
                                              _c(
                                                "v-tooltip",
                                                {
                                                  attrs: {
                                                    "max-width": "300",
                                                    bottom: ""
                                                  }
                                                },
                                                [
                                                  _c("span", {
                                                    attrs: {
                                                      slot: "activator"
                                                    },
                                                    domProps: {
                                                      innerHTML: _vm._s(
                                                        _vm.trans(
                                                          props.item.title
                                                        )
                                                      )
                                                    },
                                                    slot: "activator"
                                                  }),
                                                  _vm._v(" "),
                                                  _c("span", {
                                                    domProps: {
                                                      innerHTML: _vm._s(
                                                        _vm.trans(
                                                          props.item.title
                                                        )
                                                      )
                                                    }
                                                  })
                                                ]
                                              )
                                            ],
                                            1
                                          ),
                                          _vm._v(" "),
                                          _c("td", {
                                            domProps: {
                                              innerHTML: _vm._s(props.item.code)
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("td", {
                                            domProps: {
                                              innerHTML: _vm._s(
                                                props.item.author
                                              )
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("td", {
                                            domProps: {
                                              innerHTML: _vm._s(
                                                props.item.created
                                              )
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c("td", {
                                            domProps: {
                                              innerHTML: _vm._s(
                                                props.item.modified
                                              )
                                            }
                                          }),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            {
                                              staticClass:
                                                "layout mx-0 justify-center"
                                            },
                                            [
                                              _c(
                                                "v-tooltip",
                                                { attrs: { bottom: "" } },
                                                [
                                                  _c(
                                                    "v-btn",
                                                    {
                                                      attrs: {
                                                        slot: "activator",
                                                        icon: ""
                                                      },
                                                      on: {
                                                        click: function(
                                                          $event
                                                        ) {
                                                          $event.preventDefault()
                                                          _vm.restoreData(
                                                            props.item.id
                                                          )
                                                        }
                                                      },
                                                      slot: "activator"
                                                    },
                                                    [
                                                      _c(
                                                        "v-icon",
                                                        {
                                                          staticClass: "mx-3",
                                                          attrs: { small: "" }
                                                        },
                                                        [
                                                          _vm._v(
                                                            "\n                          restore\n                        "
                                                          )
                                                        ]
                                                      )
                                                    ],
                                                    1
                                                  ),
                                                  _vm._v(" "),
                                                  _c("span", [
                                                    _vm._v(
                                                      _vm._s(
                                                        _vm.trans(
                                                          "Restore Page"
                                                        )
                                                      )
                                                    )
                                                  ])
                                                ],
                                                1
                                              ),
                                              _vm._v(" "),
                                              _c(
                                                "v-tooltip",
                                                { attrs: { bottom: "" } },
                                                [
                                                  _c(
                                                    "v-btn",
                                                    {
                                                      attrs: {
                                                        slot: "activator",
                                                        icon: ""
                                                      },
                                                      slot: "activator"
                                                    },
                                                    [
                                                      _c(
                                                        "v-icon",
                                                        {
                                                          staticClass: "mx-3",
                                                          attrs: { small: "" },
                                                          on: {
                                                            click: function(
                                                              $event
                                                            ) {
                                                              $event.preventDefault()
                                                              _vm.deleteData(
                                                                props.item.id
                                                              )
                                                            }
                                                          }
                                                        },
                                                        [
                                                          _vm._v(
                                                            "\n                          mdi-delete-outline\n                        "
                                                          )
                                                        ]
                                                      )
                                                    ],
                                                    1
                                                  ),
                                                  _vm._v(" "),
                                                  _c("span", [
                                                    _vm._v(
                                                      "\n                        " +
                                                        _vm._s(
                                                          _vm.trans(
                                                            "Permanently Delete"
                                                          )
                                                        ) +
                                                        "\n                      "
                                                    )
                                                  ])
                                                ],
                                                1
                                              )
                                            ],
                                            1
                                          )
                                        ]
                                      )
                                    ]
                                  }
                                }
                              ]),
                              model: {
                                value: _vm.resources.selected,
                                callback: function($$v) {
                                  _vm.$set(_vm.resources, "selected", $$v)
                                },
                                expression: "resources.selected"
                              }
                            })
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            )
          ]
        : [
            _c(
              "v-card",
              { staticClass: "transparent", attrs: { flat: "" } },
              [_c("v-card-text", [_c("empty-state")], 1)],
              1
            )
          ]
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=template&id=36d49e02&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/partials/EmptyState.vue?vue&type=template&id=36d49e02& ***!
  \***************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-container",
    { attrs: { fluid: "", "align-center": "", "justify-center": "" } },
    [
      _c(
        "v-layout",
        {
          attrs: { row: "", wrap: "", "align-center": "", "justify-center": "" }
        },
        [
          _c(
            "v-card",
            {
              staticClass: "text-xs-center text--disabled",
              attrs: { flat: "", color: "transparent" }
            },
            [
              _c("man-on-laptop", {
                staticClass: "icon--disabled",
                attrs: { width: "25em", height: "25em" }
              }),
              _vm._v(" "),
              _c("h1", { staticClass: "headline mb-2" }, [
                _c("strong", [
                  _vm._v(_vm._s(_vm.trans("Time to tell great stories!")))
                ])
              ]),
              _vm._v(" "),
              _c("p", { staticClass: "subheading mb-4" }, [
                _vm._v(
                  _vm._s(
                    _vm.trans(
                      "Start by choosing what page to write. We recommend starting with a home page."
                    )
                  )
                )
              ]),
              _vm._v(" "),
              _c(
                "v-btn",
                {
                  attrs: {
                    large: "",
                    dark: "",
                    depressed: "",
                    color: "secondary",
                    round: "",
                    exact: "",
                    to: { name: "pages.create" }
                  }
                },
                [
                  _vm._v(
                    "\n        " +
                      _vm._s(_vm.trans("Create New Page")) +
                      "\n      "
                  )
                ]
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./src/modules/Page/Trashed.vue":
/*!**************************************!*\
  !*** ./src/modules/Page/Trashed.vue ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Trashed_vue_vue_type_template_id_fb009890___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Trashed.vue?vue&type=template&id=fb009890& */ "./src/modules/Page/Trashed.vue?vue&type=template&id=fb009890&");
/* harmony import */ var _Trashed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Trashed.vue?vue&type=script&lang=js& */ "./src/modules/Page/Trashed.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Trashed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Trashed_vue_vue_type_template_id_fb009890___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Trashed_vue_vue_type_template_id_fb009890___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Page/Trashed.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Page/Trashed.vue?vue&type=script&lang=js&":
/*!***************************************************************!*\
  !*** ./src/modules/Page/Trashed.vue?vue&type=script&lang=js& ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Trashed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Trashed.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Trashed.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Trashed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Page/Trashed.vue?vue&type=template&id=fb009890&":
/*!*********************************************************************!*\
  !*** ./src/modules/Page/Trashed.vue?vue&type=template&id=fb009890& ***!
  \*********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Trashed_vue_vue_type_template_id_fb009890___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Trashed.vue?vue&type=template&id=fb009890& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Trashed.vue?vue&type=template&id=fb009890&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Trashed_vue_vue_type_template_id_fb009890___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Trashed_vue_vue_type_template_id_fb009890___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./src/modules/Page/partials/EmptyState.vue":
/*!**************************************************!*\
  !*** ./src/modules/Page/partials/EmptyState.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _EmptyState_vue_vue_type_template_id_36d49e02___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EmptyState.vue?vue&type=template&id=36d49e02& */ "./src/modules/Page/partials/EmptyState.vue?vue&type=template&id=36d49e02&");
/* harmony import */ var _EmptyState_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EmptyState.vue?vue&type=script&lang=js& */ "./src/modules/Page/partials/EmptyState.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./EmptyState.vue?vue&type=style&index=0&lang=css& */ "./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _EmptyState_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _EmptyState_vue_vue_type_template_id_36d49e02___WEBPACK_IMPORTED_MODULE_0__["render"],
  _EmptyState_vue_vue_type_template_id_36d49e02___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Page/partials/EmptyState.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Page/partials/EmptyState.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./src/modules/Page/partials/EmptyState.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmptyState.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************************!*\
  !*** ./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmptyState.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./src/modules/Page/partials/EmptyState.vue?vue&type=template&id=36d49e02&":
/*!*********************************************************************************!*\
  !*** ./src/modules/Page/partials/EmptyState.vue?vue&type=template&id=36d49e02& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_template_id_36d49e02___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./EmptyState.vue?vue&type=template&id=36d49e02& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/partials/EmptyState.vue?vue&type=template&id=36d49e02&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_template_id_36d49e02___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EmptyState_vue_vue_type_template_id_36d49e02___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);