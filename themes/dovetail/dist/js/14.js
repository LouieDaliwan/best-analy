(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Email.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Settings/Email.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'Email',
  data: function data() {
    return {
      resource: {}
    };
  },
  created: function created() {
    var _this = this;

    axios.get('/api/v1/settings/email').then(function (response) {
      _this.resource = response.data;
    });
  },
  methods: {
    saveEmail: function saveEmail() {
      var _this2 = this;

      axios.post('/api/v1/settings/store', this.resource).then(function (response) {
        _this2.$router.go({
          name: 'settings.email'
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Email.vue?vue&type=template&id=e304d55e&":
/*!*****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Settings/Email.vue?vue&type=template&id=e304d55e& ***!
  \*****************************************************************************************************************************************************************************************************/
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
              return _vm.saveEmail($event)
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
                            _vm._s(_vm.__("Email Options")) +
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
            "v-card",
            { staticClass: "transparent", attrs: { flat: "" } },
            [
              _c(
                "v-card-text",
                [
                  _c(
                    "v-btn",
                    {
                      attrs: {
                        exact: "",
                        to: { name: "settings.branding.general" }
                      }
                    },
                    [_vm._v("Branding")]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("v-card"),
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
                                {
                                  staticClass:
                                    "subheading grey--text text--darken-1 mb-3 text-uppercase"
                                },
                                [
                                  _c("strong", [
                                    _vm._v(_vm._s(_vm.__("Sender")))
                                  ])
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("From Name")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_from_name",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_from_name,
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.resource,
                                      "mail_from_name",
                                      $$v
                                    )
                                  },
                                  expression: "resource.mail_from_name"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("From Email Address")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_from_address",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_from_address,
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.resource,
                                      "mail_from_address",
                                      $$v
                                    )
                                  },
                                  expression: "resource.mail_from_address"
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "v-card-text",
                            [
                              _c(
                                "h1",
                                {
                                  staticClass:
                                    "subheading grey--text text--darken-1 mb-3 text-uppercase"
                                },
                                [
                                  _c("strong", [
                                    _vm._v(_vm._s(_vm.__("Mail Setup")))
                                  ])
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Driver")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_driver",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_driver,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resource, "mail_driver", $$v)
                                  },
                                  expression: "resource.mail_driver"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Host")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_host",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_host,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resource, "mail_host", $$v)
                                  },
                                  expression: "resource.mail_host"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Port")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_port",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_port,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resource, "mail_port", $$v)
                                  },
                                  expression: "resource.mail_port"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Username")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_username",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_username,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resource, "mail_username", $$v)
                                  },
                                  expression: "resource.mail_username"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Password")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_password",
                                  "single-line": "",
                                  type: "password"
                                },
                                model: {
                                  value: _vm.resource.mail_password,
                                  callback: function($$v) {
                                    _vm.$set(_vm.resource, "mail_password", $$v)
                                  },
                                  expression: "resource.mail_password"
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Encryption")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-text-field", {
                                attrs: {
                                  box: "",
                                  name: "mail_encryption",
                                  "single-line": ""
                                },
                                model: {
                                  value: _vm.resource.mail_encryption,
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.resource,
                                      "mail_encryption",
                                      $$v
                                    )
                                  },
                                  expression: "resource.mail_encryption"
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

/***/ "./src/modules/Settings/Email.vue":
/*!****************************************!*\
  !*** ./src/modules/Settings/Email.vue ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Email_vue_vue_type_template_id_e304d55e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Email.vue?vue&type=template&id=e304d55e& */ "./src/modules/Settings/Email.vue?vue&type=template&id=e304d55e&");
/* harmony import */ var _Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Email.vue?vue&type=script&lang=js& */ "./src/modules/Settings/Email.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Email_vue_vue_type_template_id_e304d55e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Email_vue_vue_type_template_id_e304d55e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Settings/Email.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Settings/Email.vue?vue&type=script&lang=js&":
/*!*****************************************************************!*\
  !*** ./src/modules/Settings/Email.vue?vue&type=script&lang=js& ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Email.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Email.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Settings/Email.vue?vue&type=template&id=e304d55e&":
/*!***********************************************************************!*\
  !*** ./src/modules/Settings/Email.vue?vue&type=template&id=e304d55e& ***!
  \***********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_template_id_e304d55e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Email.vue?vue&type=template&id=e304d55e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/Email.vue?vue&type=template&id=e304d55e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_template_id_e304d55e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Email_vue_vue_type_template_id_e304d55e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);