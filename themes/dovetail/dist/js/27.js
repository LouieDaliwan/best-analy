(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[27],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/FAQ/Single.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vuetify-loader/lib/loader.js??ref--14-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/FAQ/Single.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _routes_api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./routes/api */ \"./src/modules/FAQ/routes/api.js\");\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  data: function data(vm) {\n    return {\n      videos: [],\n      video: vm.$route.query.url,\n      title: vm.$route.query.title\n    };\n  },\n  mounted: function mounted() {\n    this.displayVideos();\n  },\n  methods: {\n    displayVideos: function displayVideos() {\n      var _this = this;\n\n      axios.get(_routes_api__WEBPACK_IMPORTED_MODULE_0__[\"default\"].url()).then(function (response) {\n        _this.videos = response.data.videos;\n      });\n    }\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vc3JjL21vZHVsZXMvRkFRL1NpbmdsZS52dWU/YzViNyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBd0JBO0FBRUE7QUFDQTtBQUFBO0FBQ0EsZ0JBREE7QUFFQSxnQ0FGQTtBQUdBO0FBSEE7QUFBQSxHQURBO0FBT0EsU0FQQSxxQkFPQTtBQUNBO0FBQ0EsR0FUQTtBQVdBO0FBQ0EsaUJBREEsMkJBQ0E7QUFBQTs7QUFDQSxnQkFDQSx5REFEQSxFQUVBLElBRkEsQ0FFQTtBQUNBO0FBQ0EsT0FKQTtBQUtBO0FBUEE7QUFYQSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPyEuL25vZGVfbW9kdWxlcy92dWV0aWZ5LWxvYWRlci9saWIvbG9hZGVyLmpzPyEuL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8hLi9zcmMvbW9kdWxlcy9GQVEvU2luZ2xlLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyYuanMiLCJzb3VyY2VzQ29udGVudCI6WyI8dGVtcGxhdGU+XG4gIDxhZG1pbj5cbiAgICA8cGFnZS1oZWFkZXIgOmJhY2s9XCJ7IHRvOiB7IG5hbWU6ICdmYXEuaW5kZXgnIH0sIHRleHQ6IHRyYW5zKCdCYWNrJykgfVwiPlxuICAgICAgPHRlbXBsYXRlIHYtc2xvdDp0aXRsZT5cbiAgICAgICAgPHA+e3sgdGl0bGUgfX08L3A+XG4gICAgICA8L3RlbXBsYXRlPlxuICAgIDwvcGFnZS1oZWFkZXI+XG5cbiAgICA8di1jYXJkPlxuICAgICAgPHZpZGVvXG4gICAgICAgIHN0eWxlPVwiZGlzcGxheTogYmxvY2s7XCJcbiAgICAgICAgY29udHJvbHNcbiAgICAgICAgaGVpZ2h0PVwiMTAwJVwiXG4gICAgICAgIHdpZHRoPVwiMTAwJVwiXG4gICAgICAgID5cbiAgICAgICAge3sgdHJhbnMoJ1lvdXIgYnJvd3NlciBkb2VzIG5vdCBzdXBwb3J0IEhUTUw1IHZpZGVvLicpIH19XG4gICAgICAgIDxzb3VyY2UgOnNyYz1cInZpZGVvXCI+XG4gICAgICA8L3ZpZGVvPlxuICAgIDwvdi1jYXJkPlxuICA8L2FkbWluPlxuPC90ZW1wbGF0ZT5cblxuXG48c2NyaXB0PlxuaW1wb3J0ICRhcGkgZnJvbSAnLi9yb3V0ZXMvYXBpJ1xuXG5leHBvcnQgZGVmYXVsdCB7XG4gIGRhdGE6ICh2bSkgPT4gKHtcbiAgICB2aWRlb3M6IFtdLFxuICAgIHZpZGVvOiB2bS4kcm91dGUucXVlcnkudXJsLFxuICAgIHRpdGxlOiB2bS4kcm91dGUucXVlcnkudGl0bGUsXG4gIH0pLFxuXG4gIG1vdW50ZWQgKCkge1xuICAgIHRoaXMuZGlzcGxheVZpZGVvcygpXG4gIH0sXG5cbiAgbWV0aG9kczoge1xuICAgIGRpc3BsYXlWaWRlb3MgKCkge1xuICAgICAgYXhpb3MuZ2V0KFxuICAgICAgICAkYXBpLnVybCgpXG4gICAgICApLnRoZW4ocmVzcG9uc2UgPT4ge1xuICAgICAgICB0aGlzLnZpZGVvcyA9IHJlc3BvbnNlLmRhdGEudmlkZW9zXG4gICAgICB9KVxuICAgIH0sXG4gIH0sXG59XG48L3NjcmlwdD5cbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/FAQ/Single.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/FAQ/Single.vue?vue&type=template&id=46070042&":
/*!********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vuetify-loader/lib/loader.js??ref--14-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/FAQ/Single.vue?vue&type=template&id=46070042& ***!
  \********************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"admin\",\n    [\n      _c(\"page-header\", {\n        attrs: { back: { to: { name: \"faq.index\" }, text: _vm.trans(\"Back\") } },\n        scopedSlots: _vm._u([\n          {\n            key: \"title\",\n            fn: function() {\n              return [_c(\"p\", [_vm._v(_vm._s(_vm.title))])]\n            },\n            proxy: true\n          }\n        ])\n      }),\n      _vm._v(\" \"),\n      _c(\"v-card\", [\n        _c(\n          \"video\",\n          {\n            staticStyle: { display: \"block\" },\n            attrs: { controls: \"\", height: \"100%\", width: \"100%\" }\n          },\n          [\n            _vm._v(\n              \"\\n      \" +\n                _vm._s(\n                  _vm.trans(\"Your browser does not support HTML5 video.\")\n                ) +\n                \"\\n      \"\n            ),\n            _c(\"source\", { attrs: { src: _vm.video } })\n          ]\n        )\n      ])\n    ],\n    1\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9GQVEvU2luZ2xlLnZ1ZT8zZTcxIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxnQkFBZ0IsUUFBUSxNQUFNLG9CQUFvQiwyQkFBMkIsRUFBRTtBQUMvRTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsYUFBYTtBQUNiO0FBQ0E7QUFDQTtBQUNBLE9BQU87QUFDUDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsMEJBQTBCLG1CQUFtQjtBQUM3QyxvQkFBb0I7QUFDcEIsV0FBVztBQUNYO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSwwQkFBMEIsU0FBUyxpQkFBaUIsRUFBRTtBQUN0RDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoiLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvbG9hZGVycy90ZW1wbGF0ZUxvYWRlci5qcz8hLi9ub2RlX21vZHVsZXMvdnVldGlmeS1sb2FkZXIvbGliL2xvYWRlci5qcz8hLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/IS4vc3JjL21vZHVsZXMvRkFRL1NpbmdsZS52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9NDYwNzAwNDImLmpzIiwic291cmNlc0NvbnRlbnQiOlsidmFyIHJlbmRlciA9IGZ1bmN0aW9uKCkge1xuICB2YXIgX3ZtID0gdGhpc1xuICB2YXIgX2ggPSBfdm0uJGNyZWF0ZUVsZW1lbnRcbiAgdmFyIF9jID0gX3ZtLl9zZWxmLl9jIHx8IF9oXG4gIHJldHVybiBfYyhcbiAgICBcImFkbWluXCIsXG4gICAgW1xuICAgICAgX2MoXCJwYWdlLWhlYWRlclwiLCB7XG4gICAgICAgIGF0dHJzOiB7IGJhY2s6IHsgdG86IHsgbmFtZTogXCJmYXEuaW5kZXhcIiB9LCB0ZXh0OiBfdm0udHJhbnMoXCJCYWNrXCIpIH0gfSxcbiAgICAgICAgc2NvcGVkU2xvdHM6IF92bS5fdShbXG4gICAgICAgICAge1xuICAgICAgICAgICAga2V5OiBcInRpdGxlXCIsXG4gICAgICAgICAgICBmbjogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgIHJldHVybiBbX2MoXCJwXCIsIFtfdm0uX3YoX3ZtLl9zKF92bS50aXRsZSkpXSldXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgcHJveHk6IHRydWVcbiAgICAgICAgICB9XG4gICAgICAgIF0pXG4gICAgICB9KSxcbiAgICAgIF92bS5fdihcIiBcIiksXG4gICAgICBfYyhcInYtY2FyZFwiLCBbXG4gICAgICAgIF9jKFxuICAgICAgICAgIFwidmlkZW9cIixcbiAgICAgICAgICB7XG4gICAgICAgICAgICBzdGF0aWNTdHlsZTogeyBkaXNwbGF5OiBcImJsb2NrXCIgfSxcbiAgICAgICAgICAgIGF0dHJzOiB7IGNvbnRyb2xzOiBcIlwiLCBoZWlnaHQ6IFwiMTAwJVwiLCB3aWR0aDogXCIxMDAlXCIgfVxuICAgICAgICAgIH0sXG4gICAgICAgICAgW1xuICAgICAgICAgICAgX3ZtLl92KFxuICAgICAgICAgICAgICBcIlxcbiAgICAgIFwiICtcbiAgICAgICAgICAgICAgICBfdm0uX3MoXG4gICAgICAgICAgICAgICAgICBfdm0udHJhbnMoXCJZb3VyIGJyb3dzZXIgZG9lcyBub3Qgc3VwcG9ydCBIVE1MNSB2aWRlby5cIilcbiAgICAgICAgICAgICAgICApICtcbiAgICAgICAgICAgICAgICBcIlxcbiAgICAgIFwiXG4gICAgICAgICAgICApLFxuICAgICAgICAgICAgX2MoXCJzb3VyY2VcIiwgeyBhdHRyczogeyBzcmM6IF92bS52aWRlbyB9IH0pXG4gICAgICAgICAgXVxuICAgICAgICApXG4gICAgICBdKVxuICAgIF0sXG4gICAgMVxuICApXG59XG52YXIgc3RhdGljUmVuZGVyRm5zID0gW11cbnJlbmRlci5fd2l0aFN0cmlwcGVkID0gdHJ1ZVxuXG5leHBvcnQgeyByZW5kZXIsIHN0YXRpY1JlbmRlckZucyB9Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/FAQ/Single.vue?vue&type=template&id=46070042&\n");

/***/ }),

/***/ "./src/modules/FAQ/Single.vue":
/*!************************************!*\
  !*** ./src/modules/FAQ/Single.vue ***!
  \************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _Single_vue_vue_type_template_id_46070042___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Single.vue?vue&type=template&id=46070042& */ \"./src/modules/FAQ/Single.vue?vue&type=template&id=46070042&\");\n/* harmony import */ var _Single_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Single.vue?vue&type=script&lang=js& */ \"./src/modules/FAQ/Single.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vuetify-loader/lib/runtime/installComponents.js */ \"./node_modules/vuetify-loader/lib/runtime/installComponents.js\");\n/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vuetify/lib/components/VCard */ \"./node_modules/vuetify/lib/components/VCard/index.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _Single_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _Single_vue_vue_type_template_id_46070042___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _Single_vue_vue_type_template_id_46070042___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* vuetify-loader */\n\n\n_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3___default()(component, {VCard: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_4__[\"VCard\"]})\n\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"src/modules/FAQ/Single.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9GQVEvU2luZ2xlLnZ1ZT8zYmEzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQXFGO0FBQzNCO0FBQ0w7OztBQUdyRDtBQUM2RjtBQUM3RixnQkFBZ0IsMkdBQVU7QUFDMUIsRUFBRSw0RUFBTTtBQUNSLEVBQUUsaUZBQU07QUFDUixFQUFFLDBGQUFlO0FBQ2pCO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ3NHO0FBQ2pEO0FBQ3JELG9HQUFpQixhQUFhLHlFQUFLLENBQUM7OztBQUdwQztBQUNBLElBQUksS0FBVSxFQUFFLFlBaUJmO0FBQ0Q7QUFDZSxnRiIsImZpbGUiOiIuL3NyYy9tb2R1bGVzL0ZBUS9TaW5nbGUudnVlLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgcmVuZGVyLCBzdGF0aWNSZW5kZXJGbnMgfSBmcm9tIFwiLi9TaW5nbGUudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTQ2MDcwMDQyJlwiXG5pbXBvcnQgc2NyaXB0IGZyb20gXCIuL1NpbmdsZS52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCJcbmV4cG9ydCAqIGZyb20gXCIuL1NpbmdsZS52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCJcblxuXG4vKiBub3JtYWxpemUgY29tcG9uZW50ICovXG5pbXBvcnQgbm9ybWFsaXplciBmcm9tIFwiIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9ydW50aW1lL2NvbXBvbmVudE5vcm1hbGl6ZXIuanNcIlxudmFyIGNvbXBvbmVudCA9IG5vcm1hbGl6ZXIoXG4gIHNjcmlwdCxcbiAgcmVuZGVyLFxuICBzdGF0aWNSZW5kZXJGbnMsXG4gIGZhbHNlLFxuICBudWxsLFxuICBudWxsLFxuICBudWxsXG4gIFxuKVxuXG4vKiB2dWV0aWZ5LWxvYWRlciAqL1xuaW1wb3J0IGluc3RhbGxDb21wb25lbnRzIGZyb20gXCIhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZXRpZnktbG9hZGVyL2xpYi9ydW50aW1lL2luc3RhbGxDb21wb25lbnRzLmpzXCJcbmltcG9ydCB7IFZDYXJkIH0gZnJvbSAndnVldGlmeS9saWIvY29tcG9uZW50cy9WQ2FyZCc7XG5pbnN0YWxsQ29tcG9uZW50cyhjb21wb25lbnQsIHtWQ2FyZH0pXG5cblxuLyogaG90IHJlbG9hZCAqL1xuaWYgKG1vZHVsZS5ob3QpIHtcbiAgdmFyIGFwaSA9IHJlcXVpcmUoXCIvaG9tZS9wcmluY2Vzcy9Qcm9qZWN0cy9iZXN0L3RoZW1lcy9kb3ZldGFpbC9ub2RlX21vZHVsZXMvdnVlLWhvdC1yZWxvYWQtYXBpL2Rpc3QvaW5kZXguanNcIilcbiAgYXBpLmluc3RhbGwocmVxdWlyZSgndnVlJykpXG4gIGlmIChhcGkuY29tcGF0aWJsZSkge1xuICAgIG1vZHVsZS5ob3QuYWNjZXB0KClcbiAgICBpZiAoIWFwaS5pc1JlY29yZGVkKCc0NjA3MDA0MicpKSB7XG4gICAgICBhcGkuY3JlYXRlUmVjb3JkKCc0NjA3MDA0MicsIGNvbXBvbmVudC5vcHRpb25zKVxuICAgIH0gZWxzZSB7XG4gICAgICBhcGkucmVsb2FkKCc0NjA3MDA0MicsIGNvbXBvbmVudC5vcHRpb25zKVxuICAgIH1cbiAgICBtb2R1bGUuaG90LmFjY2VwdChcIi4vU2luZ2xlLnZ1ZT92dWUmdHlwZT10ZW1wbGF0ZSZpZD00NjA3MDA0MiZcIiwgZnVuY3Rpb24gKCkge1xuICAgICAgYXBpLnJlcmVuZGVyKCc0NjA3MDA0MicsIHtcbiAgICAgICAgcmVuZGVyOiByZW5kZXIsXG4gICAgICAgIHN0YXRpY1JlbmRlckZuczogc3RhdGljUmVuZGVyRm5zXG4gICAgICB9KVxuICAgIH0pXG4gIH1cbn1cbmNvbXBvbmVudC5vcHRpb25zLl9fZmlsZSA9IFwic3JjL21vZHVsZXMvRkFRL1NpbmdsZS52dWVcIlxuZXhwb3J0IGRlZmF1bHQgY29tcG9uZW50LmV4cG9ydHMiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/modules/FAQ/Single.vue\n");

/***/ }),

/***/ "./src/modules/FAQ/Single.vue?vue&type=script&lang=js&":
/*!*************************************************************!*\
  !*** ./src/modules/FAQ/Single.vue?vue&type=script&lang=js& ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Single_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vuetify-loader/lib/loader.js??ref--14-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Single.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/FAQ/Single.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Single_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); //# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9GQVEvU2luZ2xlLnZ1ZT8zMzUzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQSx3Q0FBb1AsQ0FBZ0IscVNBQUcsRUFBQyIsImZpbGUiOiIuL3NyYy9tb2R1bGVzL0ZBUS9TaW5nbGUudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJi5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBtb2QgZnJvbSBcIi0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL2JhYmVsLWxvYWRlci9saWIvaW5kZXguanM/P3JlZi0tNC0wIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWV0aWZ5LWxvYWRlci9saWIvbG9hZGVyLmpzPz9yZWYtLTE0LTAhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9TaW5nbGUudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiOyBleHBvcnQgZGVmYXVsdCBtb2Q7IGV4cG9ydCAqIGZyb20gXCItIS4uLy4uLy4uL25vZGVfbW9kdWxlcy9iYWJlbC1sb2FkZXIvbGliL2luZGV4LmpzPz9yZWYtLTQtMCEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVldGlmeS1sb2FkZXIvbGliL2xvYWRlci5qcz8/cmVmLS0xNC0wIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9pbmRleC5qcz8/dnVlLWxvYWRlci1vcHRpb25zIS4vU2luZ2xlLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/modules/FAQ/Single.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./src/modules/FAQ/Single.vue?vue&type=template&id=46070042&":
/*!*******************************************************************!*\
  !*** ./src/modules/FAQ/Single.vue?vue&type=template&id=46070042& ***!
  \*******************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Single_vue_vue_type_template_id_46070042___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vuetify-loader/lib/loader.js??ref--14-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Single.vue?vue&type=template&id=46070042& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/FAQ/Single.vue?vue&type=template&id=46070042&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Single_vue_vue_type_template_id_46070042___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Single_vue_vue_type_template_id_46070042___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9GQVEvU2luZ2xlLnZ1ZT9iZDUwIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSIsImZpbGUiOiIuL3NyYy9tb2R1bGVzL0ZBUS9TaW5nbGUudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTQ2MDcwMDQyJi5qcyIsInNvdXJjZXNDb250ZW50IjpbImV4cG9ydCAqIGZyb20gXCItIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9sb2FkZXJzL3RlbXBsYXRlTG9hZGVyLmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZXRpZnktbG9hZGVyL2xpYi9sb2FkZXIuanM/P3JlZi0tMTQtMCEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL1NpbmdsZS52dWU/dnVlJnR5cGU9dGVtcGxhdGUmaWQ9NDYwNzAwNDImXCIiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/modules/FAQ/Single.vue?vue&type=template&id=46070042&\n");

/***/ }),

/***/ "./src/modules/FAQ/routes/api.js":
/*!***************************************!*\
  !*** ./src/modules/FAQ/routes/api.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  url: function url() {\n    return '/api/v1/faqs/contents';\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9GQVEvcm91dGVzL2FwaS5qcz84MTU0Il0sIm5hbWVzIjpbInVybCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFBZTtBQUNiQSxLQUFHLEVBQUUsZUFBWTtBQUNmLFdBQU8sdUJBQVA7QUFDRDtBQUhZLENBQWYiLCJmaWxlIjoiLi9zcmMvbW9kdWxlcy9GQVEvcm91dGVzL2FwaS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImV4cG9ydCBkZWZhdWx0IHtcbiAgdXJsOiBmdW5jdGlvbiAoKSB7XG4gICAgcmV0dXJuICcvYXBpL3YxL2ZhcXMvY29udGVudHMnXG4gIH0sXG59XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/modules/FAQ/routes/api.js\n");

/***/ })

}]);