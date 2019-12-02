(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Edit.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Edit.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************/
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

/* harmony default export */ __webpack_exports__["default"] = ({
  store: _store__WEBPACK_IMPORTED_MODULE_0__["default"],
  name: 'Edit',
  $_veeValidate: {
    validator: 'new'
  },
  data: function data() {
    return {
      resource: {}
    };
  },
  created: function created() {
    var _this = this;

    axios.get("/api/v1/pages/edit/".concat(this.$route.params.id)).then(function (response) {
      _this.resource = response.data;
    });
  },
  methods: {
    beforeFormSubmit: function beforeFormSubmit() {
      var _this2 = this;

      this.$validator.reset();
      this.$validator.validateAll().then(function (ok) {
        if (ok) {
          _this2.updateData();
        }
      });
    },
    updateData: function updateData() {
      var _this3 = this;

      axios.post('/api/v1/pages/update/' + this.$route.params.id, this.resource).then(function (response) {
        _this3.$router.go({
          name: 'pages.edit'
        });

        alert('submitted');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Edit.vue?vue&type=template&id=7d4d7579&":
/*!************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Edit.vue?vue&type=template&id=7d4d7579& ***!
  \************************************************************************************************************************************************************************************************/
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
              return _vm.updateData($event)
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
                            _vm._s(_vm.__("Edit Page")) +
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
                    { attrs: { md8: "", xs12: "" } },
                    [
                      _c("v-text-field", {
                        directives: [
                          {
                            name: "validate",
                            rawName: "v-validate",
                            value: "required",
                            expression: "'required'"
                          }
                        ],
                        attrs: {
                          "data-vv-as": _vm.trans("Title"),
                          "error-messages": _vm.errors.collect("title"),
                          box: "",
                          autofocus: "",
                          label: "Title",
                          name: "title"
                        },
                        model: {
                          value: _vm.resource.title,
                          callback: function($$v) {
                            _vm.$set(_vm.resource, "title", $$v)
                          },
                          expression: "resource.title"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        directives: [
                          {
                            name: "validate",
                            rawName: "v-validate",
                            value: "required",
                            expression: "'required'"
                          }
                        ],
                        attrs: {
                          "data-vv-as": _vm.trans("Code"),
                          "error-messages": _vm.errors.collect("code"),
                          box: "",
                          autofocus: "",
                          label: "Code",
                          name: "code"
                        },
                        model: {
                          value: _vm.resource.code,
                          callback: function($$v) {
                            _vm.$set(_vm.resource, "code", $$v)
                          },
                          expression: "resource.code"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-textarea", {
                        attrs: {
                          "data-vv-as": _vm.trans("Body"),
                          box: "",
                          autofocus: "",
                          label: "Body",
                          name: "body"
                        },
                        model: {
                          value: _vm.resource.body,
                          callback: function($$v) {
                            _vm.$set(_vm.resource, "body", $$v)
                          },
                          expression: "resource.body"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "v-flex",
                    { attrs: { md3: "", xs12: "" } },
                    [
                      _c(
                        "v-card",
                        {
                          staticClass:
                            "transparent upload-image emphasis--border",
                          attrs: { height: "200", hover: "" }
                        },
                        [
                          _c(
                            "v-layout",
                            {
                              attrs: {
                                row: "",
                                wrap: "",
                                "justify-center": "",
                                "align-center": "",
                                "fill-height": ""
                              }
                            },
                            [
                              _c(
                                "v-card-text",
                                { staticClass: "text-xs-center grey--text" },
                                [
                                  _c(
                                    "v-icon",
                                    {
                                      staticClass: "text--lighten-1 grey--text",
                                      attrs: { size: "50" }
                                    },
                                    [
                                      _vm._v(
                                        "\n                  mdi-google-photos\n                "
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c("p", [
                                    _vm._v(
                                      "\n                  " +
                                        _vm._s(
                                          _vm.__("Click to upload photo")
                                        ) +
                                        "\n                "
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

/***/ "./src/modules/Page/Edit.vue":
/*!***********************************!*\
  !*** ./src/modules/Page/Edit.vue ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Edit_vue_vue_type_template_id_7d4d7579___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Edit.vue?vue&type=template&id=7d4d7579& */ "./src/modules/Page/Edit.vue?vue&type=template&id=7d4d7579&");
/* harmony import */ var _Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Edit.vue?vue&type=script&lang=js& */ "./src/modules/Page/Edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Edit_vue_vue_type_template_id_7d4d7579___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Edit_vue_vue_type_template_id_7d4d7579___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Page/Edit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Page/Edit.vue?vue&type=script&lang=js&":
/*!************************************************************!*\
  !*** ./src/modules/Page/Edit.vue?vue&type=script&lang=js& ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Edit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Page/Edit.vue?vue&type=template&id=7d4d7579&":
/*!******************************************************************!*\
  !*** ./src/modules/Page/Edit.vue?vue&type=template&id=7d4d7579& ***!
  \******************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_template_id_7d4d7579___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Edit.vue?vue&type=template&id=7d4d7579& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Edit.vue?vue&type=template&id=7d4d7579&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_template_id_7d4d7579___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Edit_vue_vue_type_template_id_7d4d7579___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);