(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Display.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Settings/Display.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  store: _store__WEBPACK_IMPORTED_MODULE_0__["default"],
  name: 'Display',
  data: function data() {
    return {
      resource: {}
    };
  },
  created: function created() {
    var _this = this;

    axios.get('/api/v1/settings/display').then(function (response) {
      _this.resource = response.data;
    });
  },
  methods: {
    saveDisplay: function saveDisplay() {
      var _this2 = this;

      axios.post('/api/v1/settings/store', this.resource).then(function (response) {
        _this2.$router.go({
          name: 'settings.general.display'
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Display.vue?vue&type=template&id=1a6c8c37&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Settings/Display.vue?vue&type=template&id=1a6c8c37& ***!
  \*******************************************************************************************************************************************************************************************************/
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
      _c(
        "v-form",
        {
          attrs: { method: "POST" },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.saveDisplay($event)
            }
          }
        },
        [
          _c(
            "v-card",
            {
              staticClass: "sticky emphasis--bg toolbar-mobile",
              attrs: { flat: "" }
            },
            [
              _c(
                "v-container",
                { attrs: { "grid-list-lg": "" } },
                [
                  _c(
                    "v-layout",
                    {
                      attrs: { row: "", wrap: "", "justify-space-between": "" }
                    },
                    [
                      _c("h1", { staticClass: "display-1" }, [
                        _vm._v(
                          "\n            " +
                            _vm._s(_vm.__("Displaying Data")) +
                            "\n          "
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        {
                          staticClass: "mx-0",
                          attrs: { color: "secondary", type: "submit" }
                        },
                        [
                          _vm._v(
                            "\n            " +
                              _vm._s(_vm.__("Save")) +
                              "\n          "
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
          ),
          _vm._v(" "),
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
                      _c(
                        "v-card",
                        [
                          _c(
                            "v-card-text",
                            [
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Global Date Format")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "date_format",
                                  placeholder: "Date Format",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.date_format,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resource, "date_format", $$v)
                                  },
                                  expression: "resource.date_format"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Items per Page")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "items_per_page",
                                  placeholder: "Items per Page",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.items_per_page,
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.resource,
                                      "items_per_page",
                                      $$v
                                    )
                                  },
                                  expression: "resource.items_per_page"
                                }
                              }),
                              _vm._v(" "),
                              _c("v-checkbox", {
                                attrs: {
                                  label:
                                    "Center the main content when possible."
                                },
                                model: {
                                  value: _vm.resource.center_main_content,
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.resource,
                                      "center_main_content",
                                      $$v
                                    )
                                  },
                                  expression: "resource.center_main_content"
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

/***/ "./src/modules/Settings/Display.vue":
/*!******************************************!*\
  !*** ./src/modules/Settings/Display.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Display_vue_vue_type_template_id_1a6c8c37___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Display.vue?vue&type=template&id=1a6c8c37& */ "./src/modules/Settings/Display.vue?vue&type=template&id=1a6c8c37&");
/* harmony import */ var _Display_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Display.vue?vue&type=script&lang=js& */ "./src/modules/Settings/Display.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Display_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Display_vue_vue_type_template_id_1a6c8c37___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Display_vue_vue_type_template_id_1a6c8c37___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Settings/Display.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Settings/Display.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./src/modules/Settings/Display.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Display_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Display.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Display.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Display_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Settings/Display.vue?vue&type=template&id=1a6c8c37&":
/*!*************************************************************************!*\
  !*** ./src/modules/Settings/Display.vue?vue&type=template&id=1a6c8c37& ***!
  \*************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Display_vue_vue_type_template_id_1a6c8c37___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Display.vue?vue&type=template&id=1a6c8c37& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Display.vue?vue&type=template&id=1a6c8c37&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Display_vue_vue_type_template_id_1a6c8c37___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Display_vue_vue_type_template_id_1a6c8c37___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);