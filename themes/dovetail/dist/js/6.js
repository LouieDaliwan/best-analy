(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
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
  name: 'Edit',
  data: function data() {
    return {
      resource: {}
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=template&id=2fbcf468&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=template&id=2fbcf468& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
      _c("div", { staticClass: "mb-4" }, [
        _c("h1", { staticClass: "title font-weight-bold" }, [
          _vm._v(_vm._s(_vm.__("Edit Main Menu")))
        ])
      ]),
      _vm._v(" "),
      _c(
        "v-layout",
        { attrs: { row: "", wrap: "" } },
        [
          _c("v-flex", { attrs: { sm4: "", xs12: "" } }, [
            _c("div", { staticClass: "mb-4" }, [
              _c("h4", { staticClass: "mb-2" }, [
                _vm._v(
                  "\n          " +
                    _vm._s(_vm.__("Menus Toolbox")) +
                    "\n        "
                )
              ]),
              _vm._v(" "),
              _c("p", { staticClass: "caption" }, [
                _vm._v(
                  "\n          " +
                    _vm._s(
                      _vm.__(
                        "To activate a widget, drag it to a sidebar and click on it."
                      )
                    ) +
                    "\n        "
                )
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              [
                _c(
                  "v-card",
                  { staticClass: "mb-3", attrs: { hover: "" } },
                  [
                    _c(
                      "v-card-text",
                      [
                        _c(
                          "v-flex",
                          [
                            _c(
                              "v-layout",
                              {
                                attrs: {
                                  row: "",
                                  wrap: "",
                                  "justify-center": "",
                                  "align-center": ""
                                }
                              },
                              [
                                _c("h5", [_vm._v(_vm._s(_vm.__("Archive")))]),
                                _vm._v(" "),
                                _c("v-spacer"),
                                _vm._v(" "),
                                _c("v-icon", [_vm._v("mdi-drag-vertical")])
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
                ),
                _vm._v(" "),
                _c("div", { staticClass: "px-3" }, [
                  _c("p", { staticClass: "caption grey--text" }, [
                    _vm._v(
                      "\n            " +
                        _vm._s(
                          _vm.__("Monthly archive of your site's posts.")
                        ) +
                        "\n          "
                    )
                  ])
                ])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              [
                _c(
                  "v-card",
                  { staticClass: "mb-3", attrs: { hover: "" } },
                  [
                    _c(
                      "v-card-text",
                      [
                        _c(
                          "v-flex",
                          [
                            _c(
                              "v-layout",
                              {
                                attrs: {
                                  row: "",
                                  wrap: "",
                                  "justify-center": "",
                                  "align-center": ""
                                }
                              },
                              [
                                _c("h5", [_vm._v(_vm._s(_vm.__("Main Menu")))]),
                                _vm._v(" "),
                                _c("v-spacer"),
                                _vm._v(" "),
                                _c("v-icon", [_vm._v("mdi-drag-vertical")])
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
                ),
                _vm._v(" "),
                _c("div", { staticClass: "px-3" }, [
                  _c("p", { staticClass: "caption grey--text" }, [
                    _vm._v(
                      "\n            " +
                        _vm._s(_vm.__("Monthly arvice")) +
                        "\n          "
                    )
                  ])
                ])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              [
                _c(
                  "v-card",
                  { staticClass: "mb-3", attrs: { hover: "" } },
                  [
                    _c(
                      "v-card-text",
                      [
                        _c(
                          "v-flex",
                          [
                            _c(
                              "v-layout",
                              {
                                attrs: {
                                  row: "",
                                  wrap: "",
                                  "justify-center": "",
                                  "align-center": ""
                                }
                              },
                              [
                                _c("h5", [_vm._v(_vm._s(_vm.__("Calendar")))]),
                                _vm._v(" "),
                                _c("v-spacer"),
                                _vm._v(" "),
                                _c("v-icon", [_vm._v("mdi-drag-vertical")])
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
                ),
                _vm._v(" "),
                _c("div", { staticClass: "px-3" }, [
                  _c("p", { staticClass: "caption grey--text" }, [
                    _vm._v(
                      "\n            " +
                        _vm._s(
                          _vm.__("Monthly calendar of your site's posts.")
                        ) +
                        "\n          "
                    )
                  ])
                ])
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c(
            "v-flex",
            { attrs: { sm7: "", xs12: "", "offset-sm1": "" } },
            [
              _c(
                "v-card",
                { attrs: { flat: "" } },
                [
                  _c("v-card-text", [
                    _vm._v(
                      "\n          " +
                        _vm._s(_vm.__("Menu Structure")) +
                        "\n        "
                    )
                  ])
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
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./src/modules/Appearance/submodules/Menu/Edit.vue":
/*!*********************************************************!*\
  !*** ./src/modules/Appearance/submodules/Menu/Edit.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Edit_vue_vue_type_template_id_2fbcf468___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Edit.vue?vue&type=template&id=2fbcf468& */ "./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=template&id=2fbcf468&");
/* harmony import */ var _Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Edit.vue?vue&type=script&lang=js& */ "./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Edit_vue_vue_type_template_id_2fbcf468___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Edit_vue_vue_type_template_id_2fbcf468___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Appearance/submodules/Menu/Edit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Edit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=template&id=2fbcf468&":
/*!****************************************************************************************!*\
  !*** ./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=template&id=2fbcf468& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_template_id_2fbcf468___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Edit.vue?vue&type=template&id=2fbcf468& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Appearance/submodules/Menu/Edit.vue?vue&type=template&id=2fbcf468&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_template_id_2fbcf468___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_template_id_2fbcf468___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);