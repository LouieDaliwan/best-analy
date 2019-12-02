(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/store */ "./src/store/index.js");
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
  name: 'Index',
  data: function data() {
    return {
      resources: {
        items: []
      },
      resource: {}
    };
  },
  created: function created() {
    var _this = this;

    axios.get('/api/v1/themes/all').then(function (response) {
      _this.resources.items = response.data;
    });
  },
  methods: {
    saveTheme: function saveTheme(data) {
      var _this2 = this;

      axios.post('/api/v1/settings/store', data).then(function (response) {
        if (response.data == 'success') {
          _this2.$router.go({
            name: 'appearance.themes'
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=template&id=84515344&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=template&id=84515344& ***!
  \************************************************************************************************************************************************************************************************************************/
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
    { attrs: { fluid: "", "grid-list-lg": "" } },
    [
      _c(
        "v-layout",
        { attrs: { row: "", wrap: "" } },
        [
          _c("v-flex", { attrs: { xs12: "" } }, [
            _c("div", { staticClass: "mb-4" }, [
              _c("h1", { staticClass: "headline font-weight-bold" }, [
                _vm._v("\n          " + _vm._s(_vm.__("Themes")) + "\n        ")
              ])
            ])
          ]),
          _vm._v(" "),
          _vm._l(_vm.resources.items, function(resource, i) {
            return [
              _c(
                "v-flex",
                { key: i, attrs: { md4: "", sm6: "", xs12: "" } },
                [
                  _c(
                    "v-card",
                    { attrs: { id: resource.code } },
                    [
                      _c(
                        "v-img",
                        {
                          attrs: {
                            height: "300",
                            src: resource.thumbnail,
                            gradient:
                              "to top right, rgba(100,115,201,.45), rgba(25,32,72,.3)"
                          }
                        },
                        [
                          _c(
                            "v-container",
                            { attrs: { fluid: "", "fill-height": "" } },
                            [
                              _c(
                                "v-layout",
                                {
                                  attrs: {
                                    row: "",
                                    wrap: "",
                                    "justify-center": "",
                                    "align-start": ""
                                  }
                                },
                                [
                                  _c(
                                    "v-card-text",
                                    { staticClass: "white--text" },
                                    [
                                      _c("h3", {
                                        staticClass: "mb-2",
                                        domProps: {
                                          innerHTML: _vm._s(resource.name)
                                        }
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "p",
                                        {
                                          staticClass:
                                            "caption font-weight-bold"
                                        },
                                        [
                                          _c("span", [
                                            _vm._v(
                                              _vm._s(_vm.__("Theme by: ")) +
                                                " " +
                                                _vm._s(resource.author.name)
                                            )
                                          ])
                                        ]
                                      ),
                                      _vm._v(" "),
                                      _c("p", {
                                        domProps: {
                                          innerHTML: _vm._s(
                                            resource.description
                                          )
                                        }
                                      })
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
                      ),
                      _vm._v(" "),
                      _c(
                        "v-card-actions",
                        { staticClass: "pa-3" },
                        [
                          resource.active
                            ? [
                                _c(
                                  "v-btn",
                                  {
                                    attrs: {
                                      flat: "",
                                      disabled: "",
                                      color: "secondary"
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                " +
                                        _vm._s(_vm.__("Currently Active")) +
                                        "\n              "
                                    )
                                  ]
                                )
                              ]
                            : [
                                _c(
                                  "v-form",
                                  {
                                    attrs: { method: "POST" },
                                    on: {
                                      submit: function($event) {
                                        $event.preventDefault()
                                        _vm.saveTheme({
                                          active_theme: resource.code
                                        })
                                      }
                                    }
                                  },
                                  [
                                    _c("input", {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: resource.code,
                                          expression: "resource.code"
                                        }
                                      ],
                                      attrs: {
                                        type: "hidden",
                                        name: "active_theme"
                                      },
                                      domProps: { value: resource.code },
                                      on: {
                                        input: function($event) {
                                          if ($event.target.composing) {
                                            return
                                          }
                                          _vm.$set(
                                            resource,
                                            "code",
                                            $event.target.value
                                          )
                                        }
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c(
                                      "v-btn",
                                      {
                                        attrs: {
                                          color: "secondary",
                                          flat: "",
                                          type: "submit"
                                        }
                                      },
                                      [
                                        _vm._v(
                                          "\n                  " +
                                            _vm._s(_vm.__("Activate")) +
                                            "\n                "
                                        )
                                      ]
                                    )
                                  ],
                                  1
                                )
                              ],
                          _vm._v(" "),
                          _c("v-spacer"),
                          _vm._v(" "),
                          _c("v-btn", { attrs: { flat: "" } }, [
                            _vm._v(
                              "\n              " +
                                _vm._s(_vm.__("Details")) +
                                "\n            "
                            )
                          ])
                        ],
                        2
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ]
          })
        ],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./src/modules/Appearance/submodules/Theme/Index.vue":
/*!***********************************************************!*\
  !*** ./src/modules/Appearance/submodules/Theme/Index.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_84515344___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=84515344& */ "./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=template&id=84515344&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_84515344___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_84515344___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Appearance/submodules/Theme/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=template&id=84515344&":
/*!******************************************************************************************!*\
  !*** ./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=template&id=84515344& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_84515344___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=84515344& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Theme/Index.vue?vue&type=template&id=84515344&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_84515344___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_84515344___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);