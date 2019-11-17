(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Dashboard/Dashboard.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/store */ "./src/store/index.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vue_carousel__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-carousel */ "./node_modules/vue-carousel/dist/vue-carousel.min.js");
/* harmony import */ var vue_carousel__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_carousel__WEBPACK_IMPORTED_MODULE_2__);
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



/* harmony default export */ __webpack_exports__["default"] = ({
  // mounted() {
  //   let token = window.localStorage.getItem('jwt');
  //   window.axios.defaults.headers.common['Content-Type'] = 'application/json'
  //   window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
  //   window.axios.get('/api/v1/users/all').then(response => {
  //     // console.log(response);
  //   });
  // }
  store: _store__WEBPACK_IMPORTED_MODULE_0__["default"],
  name: 'Dashboard',
  components: {
    Carousel: vue_carousel__WEBPACK_IMPORTED_MODULE_2__["Carousel"],
    Slide: vue_carousel__WEBPACK_IMPORTED_MODULE_2__["Slide"]
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])({
    app: 'app/app'
  })),
  data: function data() {
    return {
      test: {
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
          title: 'Develop Personal Effectiveness at Operations Level',
          thumbnail: '//preview.ibb.co/cMCYYz/card_Media.png',
          category: 'DPE OPS',
          timestamp: '2 hours ago',
          description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
          part: '6',
          status: 'enrolled'
        }, {
          id: '2',
          title: 'Solve Problems and Make Decisions at Supervisory Level',
          thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
          category: 'DPE OPS',
          timestamp: '2 hours ago',
          description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
          part: '6'
        }, {
          id: '3',
          title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
          thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
          category: 'DPE OPS',
          timestamp: '2 hours ago',
          description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
          part: '6'
        }, {
          id: '4',
          title: 'Develop Personal Effectiveness at Supervisory Level',
          thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
          category: 'DPE OPS',
          timestamp: '2 hours ago',
          description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
          part: '6'
        }]
      },
      course: {
        snackbar: true,
        snackbarTimeout: 0
      },
      carousel: {
        items: [{
          thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
          title: 'My Carousel Card',
          description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ut maiores enim magnam, commodi quis autem blanditiis, eligendi facere, atque optio natus animi quas repellat tempora fugit rem unde eaque ! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, maxime. A similique repellat eligendi asperiores excepturi obcaecati repudiandae dicta? Voluptatem ex ducimus placeat eius magnam debitis minus saepe. Ex, veniam? ',
          link: 'https://www.google.com/',
          category: 'DPE SUP'
        }, {
          thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
          title: 'My Carousel Card',
          description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ut maiores enim magnam, commodi quis autem blanditiis, eligendi facere, atque optio natus animi quas repellat tempora fugit rem unde eaque!',
          link: 'https://www.pinterest.com/',
          category: 'PSDM SUP'
        }, {
          thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
          title: 'My Carousel Card',
          description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ut maiores enim magnam, commodi quis autem blanditiis, eligendi facere, atque optio natus animi quas repellat tempora fugit rem unde eaque!',
          link: 'https://www.medium.com/',
          category: 'PSDM SUP'
        }]
      }
    };
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--10-2!../../../node_modules/stylus-loader!../../../node_modules/vue-loader/lib??vue-loader-options!./Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark&":
/*!*********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Dashboard/Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************/
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
          _c(
            "v-flex",
            { attrs: { md4: "", sm6: "", xs12: "" } },
            [
              _c(
                "v-card",
                { staticClass: "mb-3", attrs: { hover: "" } },
                [
                  _c(
                    "carousel",
                    {
                      attrs: {
                        autoplayTimeout: 1000,
                        paginationActiveColor: _vm.app.dark
                          ? "#38a3ee"
                          : "#0c5689",
                        paginationColor: "grey",
                        perPage: 1,
                        autoplay: ""
                      }
                    },
                    [
                      _vm._l(_vm.carousel.items, function(item, i) {
                        return [
                          _c(
                            "slide",
                            { key: i },
                            [
                              _c(
                                "v-card",
                                { attrs: { flat: "", href: item.link } },
                                [
                                  _c("v-img", {
                                    attrs: {
                                      height: "160",
                                      src: item.thumbnail
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c(
                                    "v-card-text",
                                    [
                                      _c(
                                        "p",
                                        {
                                          staticClass:
                                            "caption mb-2 primary--text"
                                        },
                                        [
                                          _c("strong", {
                                            domProps: {
                                              innerHTML: _vm._s(
                                                _vm.trans(item.category)
                                              )
                                            }
                                          })
                                        ]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-tooltip",
                                        { attrs: { bottom: "" } },
                                        [
                                          _c("h3", {
                                            staticClass:
                                              "subheading font-weight-bold mb-2 title__text--ellipsis",
                                            attrs: { slot: "activator" },
                                            domProps: {
                                              innerHTML: _vm._s(
                                                _vm.trans(item.title)
                                              )
                                            },
                                            slot: "activator"
                                          }),
                                          _vm._v(" "),
                                          _c("span", {
                                            domProps: {
                                              innerHTML: _vm._s(
                                                _vm.trans(item.title)
                                              )
                                            }
                                          })
                                        ]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "div",
                                        { staticClass: "mb-3" },
                                        [
                                          _c(
                                            "v-icon",
                                            {
                                              attrs: {
                                                color: "secondary",
                                                small: ""
                                              }
                                            },
                                            [_vm._v("star")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "v-icon",
                                            {
                                              attrs: {
                                                color: "secondary",
                                                small: ""
                                              }
                                            },
                                            [_vm._v("star")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "v-icon",
                                            {
                                              attrs: {
                                                color: "secondary",
                                                small: ""
                                              }
                                            },
                                            [_vm._v("star")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "v-icon",
                                            {
                                              attrs: {
                                                color: "secondary",
                                                small: ""
                                              }
                                            },
                                            [_vm._v("star_half")]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "v-icon",
                                            {
                                              attrs: {
                                                color: "secondary",
                                                small: ""
                                              }
                                            },
                                            [_vm._v("star_border")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c("p", [
                                        _c("span", {
                                          staticClass: "text--ellipsis",
                                          domProps: {
                                            innerHTML: _vm._s(
                                              _vm.trans(item.description)
                                            )
                                          }
                                        })
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
                        ]
                      })
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
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./src/modules/Dashboard/Dashboard.vue":
/*!*********************************************!*\
  !*** ./src/modules/Dashboard/Dashboard.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Dashboard_vue_vue_type_template_id_06d1bc48_scoped_true_3Adark_24store_getters_5B_app_2Fapp_5D_dark___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark& */ "./src/modules/Dashboard/Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark&");
/* harmony import */ var _Dashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Dashboard.vue?vue&type=script&lang=js& */ "./src/modules/Dashboard/Dashboard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true& */ "./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Dashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Dashboard_vue_vue_type_template_id_06d1bc48_scoped_true_3Adark_24store_getters_5B_app_2Fapp_5D_dark___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Dashboard_vue_vue_type_template_id_06d1bc48_scoped_true_3Adark_24store_getters_5B_app_2Fapp_5D_dark___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "06d1bc48",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Dashboard/Dashboard.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Dashboard/Dashboard.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./src/modules/Dashboard/Dashboard.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Dashboard.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true& ***!
  \*********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--10-2!../../../node_modules/stylus-loader!../../../node_modules/vue-loader/lib??vue-loader-options!./Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=style&index=0&id=06d1bc48&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_style_index_0_id_06d1bc48_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./src/modules/Dashboard/Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark&":
/*!***************************************************************************************************************************************!*\
  !*** ./src/modules/Dashboard/Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark& ***!
  \***************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_template_id_06d1bc48_scoped_true_3Adark_24store_getters_5B_app_2Fapp_5D_dark___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Dashboard/Dashboard.vue?vue&type=template&id=06d1bc48&scoped=true&%3Adark=%24store.getters%5B'app%2Fapp'%5D.dark&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_template_id_06d1bc48_scoped_true_3Adark_24store_getters_5B_app_2Fapp_5D_dark___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Dashboard_vue_vue_type_template_id_06d1bc48_scoped_true_3Adark_24store_getters_5B_app_2Fapp_5D_dark___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);