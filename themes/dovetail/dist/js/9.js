(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Create.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/store */ "./src/store/index.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; var ownKeys = Object.keys(source); if (typeof Object.getOwnPropertySymbols === 'function') { ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) { return Object.getOwnPropertyDescriptor(source, sym).enumerable; })); } ownKeys.forEach(function (key) { _defineProperty(target, key, source[key]); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'Create',
  $_veeValidate: {
    validator: 'new'
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])({
    snackbar: 'snackbar/snackbar',
    dialogbox: 'dialogbox/dialogbox'
  }), {
    slug: function slug() {
      var slug = this.sanitizeTitle(this.resource.title);
      return slug;
    }
  }),
  data: function data() {
    return {
      resource: {
        lockSlug: false,
        viewSlug: false,
        title: ''
      }
    };
  },
  mounted: function mounted() {
    this.ckEditor();
  },
  methods: {
    sanitizeTitle: function sanitizeTitle(title) {
      var slug = ""; // Change to lower case

      var titleLower = title.toLowerCase(); // Letter "e"

      slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e'); // Letter "a"

      slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a'); // Letter "o"

      slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o'); // Letter "u"

      slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u'); // Letter "d"

      slug = slug.replace(/đ/gi, 'd'); // Trim the last whitespace

      slug = slug.replace(/\s*$/g, ''); // Change whitespace to "-"

      slug = slug.replace(/\s+/g, '-');
      return slug;
    },
    slugify: function slugify($value) {// if (!this.resource.lockSlug) {
      //   if (typeof $value === 'undefined') {
      //     this.resource.slug = this.$options.filters.slugify(this.resource.title)
      //   } else {
      //     this.resource.slug = this.$options.filters.slugify($value)
      //   }
      // }
    },
    ckEditor: function ckEditor() {
      ClassicEditor.create(document.querySelector('#editor')).catch(function (error) {
        console.error(error);
      });
    },
    beforeFormSubmit: function beforeFormSubmit() {
      var _this = this;

      this.$validator.reset();
      this.$validator.validateAll().then(function (ok) {
        if (ok) {
          _this.storeData();
        }
      });
    },
    storeData: function storeData() {
      var _this2 = this;

      axios.post('/api/v1/pages/store', this.resource).then(function (response) {
        // console.log(this.resource, 'data')
        _this2.$router.push({
          name: 'pages.index'
        });

        _this2.$store.dispatch('snackbar/TOGGLE_TOAST', Object.assign(_this2.snackbar, {
          model: true,
          // icon: 'add',
          // iconColor: 'success--text',
          text: 'Delete Resources'
        })); // push to Create.vue view

      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab& ***!
  \**************************************************************************************************************************************************************************************************/
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
              return _vm.storeData($event)
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
                    { attrs: { row: "", wrap: "" } },
                    [
                      _c(
                        "v-icon",
                        { staticClass: "primary--text", attrs: { size: "16" } },
                        [_vm._v("mdi-arrow-left")]
                      ),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        {
                          staticClass: "transparent",
                          attrs: {
                            flat: "",
                            exact: "",
                            to: { name: "pages.index" }
                          }
                        },
                        [
                          _c(
                            "span",
                            { staticClass: "subheading primary--text" },
                            [
                              _vm._v(
                                "\n              " +
                                  _vm._s(_vm.__("All Pages")) +
                                  "\n            "
                              )
                            ]
                          )
                        ]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "v-layout",
                    {
                      attrs: { row: "", wrap: "", "justify-space-between": "" }
                    },
                    [
                      _c("h1", { staticClass: "display-1" }, [
                        _vm._v(
                          "\n            " +
                            _vm._s(_vm.__("Create Page")) +
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
                    { attrs: { md9: "", xs12: "" } },
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
                                      _vm._s(_vm.__("Page Title")) +
                                      "\n              "
                                  )
                                ]
                              ),
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
                                  "data-vv-as": _vm.trans("Title"),
                                  "error-messages": _vm.errors.collect("title"),
                                  hint: _vm.trans(
                                    "Tap the icon to edit this page's slug"
                                  ),
                                  "append-icon": "mdi-circle-edit-outline",
                                  autofocus: "",
                                  placeholder: "e.g. My First Page",
                                  box: "",
                                  name: "title",
                                  "single-line": ""
                                },
                                on: {
                                  "click:append": function($event) {
                                    _vm.resource.viewSlug = !_vm.resource
                                      .viewSlug
                                  },
                                  input: _vm.slugify
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
                              _c(
                                "v-slide-y-transition",
                                { attrs: { mode: "out-in" } },
                                [
                                  _vm.resource.viewSlug
                                    ? _c("v-text-field", {
                                        directives: [
                                          { name: "focus", rawName: "v-focus" },
                                          {
                                            name: "validate",
                                            rawName: "v-validate",
                                            value: "required",
                                            expression: "'required'"
                                          }
                                        ],
                                        staticClass: "mb-2",
                                        attrs: {
                                          "append-icon": _vm.resource.lockSlug
                                            ? "lock"
                                            : "lock_open",
                                          "error-messages": _vm.errors.collect(
                                            "slug"
                                          ),
                                          hint: _vm.trans(
                                            "Locking this field will prevent the title field from overriding this current value"
                                          ),
                                          label: _vm.trans("Slug"),
                                          placeholder: _vm.trans(
                                            "app://your-custom-url-here"
                                          ),
                                          readonly: _vm.resource.lockSlug,
                                          outline: "",
                                          name: "slug",
                                          "persistent-hint": ""
                                        },
                                        on: {
                                          blur: function($event) {
                                            _vm.resource.lockSlug = true
                                          },
                                          "click:append": function($event) {
                                            _vm.resource.lockSlug = !_vm
                                              .resource.lockSlug
                                          }
                                        },
                                        model: {
                                          value: _vm.resource.slug,
                                          callback: function($$v) {
                                            _vm.$set(
                                              _vm.resource,
                                              "slug",
                                              typeof $$v === "string"
                                                ? $$v.trim()
                                                : $$v
                                            )
                                          },
                                          expression: "resource.slug"
                                        }
                                      })
                                    : _vm._e()
                                ],
                                1
                              ),
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
                                on: {
                                  "click:append": function() {
                                    _vm.resource.lockSlug = !_vm.resource
                                      .lockSlug
                                  }
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
                              _c(
                                "h1",
                                { staticClass: "body-2 font-weight-bold mb-2" },
                                [
                                  _vm._v(
                                    "\n                " +
                                      _vm._s(_vm.__("Page Content")) +
                                      "\n              "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("v-textarea", {
                                attrs: {
                                  "data-vv-as": _vm.trans("Page Content"),
                                  box: "",
                                  autofocus: "",
                                  "single-line": "",
                                  name: "body",
                                  placeholder: "Describe Content",
                                  row: "9"
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
                          )
                        ],
                        1
                      )
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
                            "transparent upload-image emphasis--border mb-3",
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
                                    [_vm._v("mdi-google-photos")]
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
      ),
      _vm._v(" "),
      _c("dialogbox")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./src/modules/Page/Create.vue":
/*!*************************************!*\
  !*** ./src/modules/Page/Create.vue ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create.vue?vue&type=template&id=7cb9c5ab& */ "./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&");
/* harmony import */ var _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create.vue?vue&type=script&lang=js& */ "./src/modules/Page/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Page/Create.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Page/Create.vue?vue&type=script&lang=js&":
/*!**************************************************************!*\
  !*** ./src/modules/Page/Create.vue?vue&type=script&lang=js& ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&":
/*!********************************************************************!*\
  !*** ./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab& ***!
  \********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=template&id=7cb9c5ab& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);