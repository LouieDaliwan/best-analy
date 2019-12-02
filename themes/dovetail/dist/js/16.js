(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[16],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Test/Index.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Test/Index.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************/
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


/* harmony default export */ __webpack_exports__["default"] = ({
  store: _store__WEBPACK_IMPORTED_MODULE_0__["default"],
  name: 'Index',
  data: function data() {
    return {
      toolbar: {
        title: 'All Courses'
      },
      iconmenu: {
        model: '',
        label: 'Choose Icon Menu'
      },
      cta: {
        label: 'Test Submit'
      },
      courses: {
        timestamp: false,
        slug: false,
        author: false,
        created: false,
        modified: false,
        selected: [],
        bulkDestroy: false,
        selectAll: true,
        search: '',
        cardLink: '/admin/courses/show',
        chip: true,
        hover: true,
        lg3: false,
        showMimetype: false,
        showToolbar: false,
        headers: [{
          text: 'ID',
          value: 'id'
        }, {
          text: 'Featured',
          value: 'thumbnail'
        }, {
          text: 'Title',
          value: 'title'
        }, {
          text: 'Category',
          value: 'category'
        }, {
          text: 'Part',
          value: 'part'
        }, {
          text: 'Status',
          value: 'status'
        }, {
          text: 'Actions',
          value: 'actions',
          sortable: false,
          align: 'center'
        }],
        items: [{
          id: '1',
          title: 'Vue',
          thumbnail: '//preview.ibb.co/cMCYYz/card_Media.png',
          category: 'javascript',
          timestamp: '2 hours ago',
          description: 'Popular Javascript Framework',
          part: '6',
          status: 'enrolled'
        }, {
          id: '2',
          title: 'React',
          thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
          category: 'javascript',
          timestamp: '2 hours ago',
          description: 'Popular Javascript Framework',
          part: '6'
        }, {
          id: '3',
          title: 'Angular',
          thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
          category: 'javascript',
          timestamp: '2 hours ago',
          description: 'Popular Javascript Framework',
          part: '6'
        }, {
          id: '4',
          title: 'Meteor',
          thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
          category: 'javascript',
          timestamp: '2 hours ago',
          description: 'Popular Javascript Framework',
          part: '6'
        }]
      }
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])({
    dialogbox: 'dialogbox/dialogbox',
    modal: 'modal/modal',
    toggletoolbar: 'toolbar/toolbar'
  }), {
    empty: function empty() {
      return true; // this.dataset.items.length === 0
    },
    page: function page() {
      return this.$route.meta;
    }
  }),
  methods: {
    openDialogbox: function openDialogbox() {
      this.$store.dispatch('dialogbox/PROMPT_DIALOG', Object.assign(this.dialogbox, {
        model: true,
        // icon: 'add',
        // iconColor: 'success--text',
        image: '//img.stackshare.io/stack/26394/laravel_logo-circle-tp-xs.png',
        title: 'Delete Resources',
        text: 'You are about to permanently delete those resources.This action is irreversible. Do you want to proceed?',
        persistent: true,
        width: '100%',
        alignedCenter: true,
        actionText: 'Delete',
        actionColor: 'error',
        actionCallback: function actionCallback() {
          this.model = false; // store.dispatch.saveUserOrSomeShitLikeThat
          // then...
        },
        discard: false
      }));
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Test/Index.vue?vue&type=template&id=75532494&":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Test/Index.vue?vue&type=template&id=75532494& ***!
  \*************************************************************************************************************************************************************************************************/
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
      _c("toolbar-menu", {
        staticClass: "mb-3",
        attrs: { items: _vm.toolbar }
      }),
      _vm._v(" "),
      _c(
        "v-container",
        { attrs: { fluid: "", "grid-list-lg": "" } },
        [
          _c(
            "v-layout",
            { attrs: { row: "", wrap: "" } },
            [
              _c(
                "v-flex",
                { attrs: { sm6: "", xs12: "" } },
                [
                  _c(
                    "v-card",
                    { staticClass: "mb-3" },
                    [
                      _c("v-card-title", { staticClass: "emphasis--medium" }, [
                        _vm._v(
                          "\n            " +
                            _vm._s(_vm.trans("Icon Menu")) +
                            "\n          "
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-card-text",
                        [_c("cta", { attrs: { items: _vm.cta } })],
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
                { attrs: { sm6: "", xs12: "" } },
                [
                  _c(
                    "v-card",
                    { staticClass: "mb-3 text-xs-center", attrs: { flat: "" } },
                    [
                      _c("v-card-title", { staticClass: "emphasis--medium" }, [
                        _vm._v(
                          "\n            " +
                            _vm._s(_vm.trans("Dialogbox")) +
                            "\n          "
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-card-text",
                        [
                          _c("dialogbox"),
                          _vm._v(" "),
                          _c("v-btn", { on: { click: _vm.openDialogbox } }, [
                            _vm._v(
                              "\n              " +
                                _vm._s(_vm.trans("Open Dialog Test")) +
                                "\n            "
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
              ),
              _vm._v(" "),
              _c(
                "v-flex",
                { attrs: { xs12: "" } },
                [
                  _vm.toggletoolbar.toggleview
                    ? [_c("data-table", { attrs: { items: _vm.courses } })]
                    : [_c("data-iterator", { attrs: { items: _vm.courses } })]
                ],
                2
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

/***/ "./src/modules/Test/Index.vue":
/*!************************************!*\
  !*** ./src/modules/Test/Index.vue ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_75532494___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=75532494& */ "./src/modules/Test/Index.vue?vue&type=template&id=75532494&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./src/modules/Test/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_75532494___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_75532494___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Test/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Test/Index.vue?vue&type=script&lang=js&":
/*!*************************************************************!*\
  !*** ./src/modules/Test/Index.vue?vue&type=script&lang=js& ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Test/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Test/Index.vue?vue&type=template&id=75532494&":
/*!*******************************************************************!*\
  !*** ./src/modules/Test/Index.vue?vue&type=template&id=75532494& ***!
  \*******************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_75532494___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=75532494& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Test/Index.vue?vue&type=template&id=75532494&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_75532494___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_75532494___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);