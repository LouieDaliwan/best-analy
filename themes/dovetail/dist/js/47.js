(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[47],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/General.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vuetify-loader/lib/loader.js??ref--14-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Settings/General.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  data: function data() {\n    return {\n      settings: {\n        'formal:date': {\n          key: 'formal:date',\n          value: ''\n        },\n        'display:perpage': {\n          key: 'display:perpage',\n          value: 15\n        }\n      }\n    };\n  },\n  methods: {\n    loadSettings: function loadSettings() {// axios.get()\n    },\n    saveSettings: function saveSettings() {\n      var data = this.settings;\n      axios.post(\"/api/v1/settings\", data).then(function (response) {\n        console.log(response);\n      });\n    }\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vc3JjL21vZHVsZXMvU2V0dGluZ3MvR2VuZXJhbC52dWU/ZDhmMSJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBd0NBO0FBQ0E7QUFBQTtBQUNBO0FBQ0E7QUFDQSw0QkFEQTtBQUVBO0FBRkEsU0FEQTtBQUtBO0FBQ0EsZ0NBREE7QUFFQTtBQUZBO0FBTEE7QUFEQTtBQUFBLEdBREE7QUFjQTtBQUNBLGdCQURBLDBCQUNBLENBQ0E7QUFDQSxLQUhBO0FBS0EsZ0JBTEEsMEJBS0E7QUFDQTtBQUNBLHFDQUNBLElBREEsRUFFQSxJQUZBLENBRUE7QUFDQTtBQUNBLE9BSkE7QUFLQTtBQVpBO0FBZEEiLCJmaWxlIjoiLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8hLi9ub2RlX21vZHVsZXMvdnVldGlmeS1sb2FkZXIvbGliL2xvYWRlci5qcz8hLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/IS4vc3JjL21vZHVsZXMvU2V0dGluZ3MvR2VuZXJhbC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmLmpzIiwic291cmNlc0NvbnRlbnQiOlsiPHRlbXBsYXRlPlxuICA8YWRtaW4+XG4gICAgPHBhZ2UtaGVhZGVyPlxuICAgICAgPHRlbXBsYXRlIHYtc2xvdDp0aXRsZSB2LXRleHQ9XCJ0cmFucygnR2VuZXJhbCBTZXR0aW5ncycpXCI+PC90ZW1wbGF0ZT5cbiAgICA8L3BhZ2UtaGVhZGVyPlxuXG4gICAgPHYtcm93PlxuICAgICAgPHYtY29sIGNvbHM9XCIxMlwiIG1kPVwiOFwiPlxuICAgICAgICA8di1jYXJkPlxuICAgICAgICAgIDx2LWNhcmQtdGl0bGUgdi10ZXh0PVwidHJhbnMoJ0Rpc3BsYXlpbmcgRGF0YScpXCI+PC92LWNhcmQtdGl0bGU+XG4gICAgICAgICAgPHYtY2FyZC10ZXh0PlxuICAgICAgICAgICAgPHAgY2xhc3M9XCJtdXRlZC0tdGV4dFwiIHYtdGV4dD1cInRyYW5zKCdGb3JtYXRzJylcIj48L3A+XG4gICAgICAgICAgICA8di10ZXh0LWZpZWxkXG4gICAgICAgICAgICAgIDpsYWJlbD1cInRyYW5zKCdHbG9iYWwgRGF0ZSBGb3JtYXQnKVwiXG4gICAgICAgICAgICAgIGF1dG9mb2N1c1xuICAgICAgICAgICAgICBjbGFzcz1cIm1iLTNcIlxuICAgICAgICAgICAgICBvdXRsaW5lZFxuICAgICAgICAgICAgICB2LW1vZGVsPVwic2V0dGluZ3NbJ2Zvcm1hbDpkYXRlJ11bJ3ZhbHVlJ11cIlxuICAgICAgICAgICAgPjwvdi10ZXh0LWZpZWxkPlxuXG4gICAgICAgICAgICA8di10ZXh0LWZpZWxkXG4gICAgICAgICAgICAgIDpsYWJlbD1cInRyYW5zKCdJdGVtcyBwZXIgUGFnZScpXCJcbiAgICAgICAgICAgICAgY2xhc3M9XCJtYi0zXCJcbiAgICAgICAgICAgICAgb3V0bGluZWRcbiAgICAgICAgICAgICAgdi1tb2RlbD1cInNldHRpbmdzWydkaXNwbGF5OnBlcnBhZ2UnXVsndmFsdWUnXVwiXG4gICAgICAgICAgICA+PC92LXRleHQtZmllbGQ+XG5cbiAgICAgICAgICAgIDxsYW5ndWFnZS1zd2l0Y2hlciBjbGFzcz1cIm1iLTZcIj48L2xhbmd1YWdlLXN3aXRjaGVyPlxuXG4gICAgICAgICAgICA8IS0tIDxkaXYgY2xhc3M9XCJkLWZsZXgganVzdGlmeS1lbmRcIj5cbiAgICAgICAgICAgICAgPHYtYnRuIEBjbGljaz1cInNhdmVTZXR0aW5nc1wiIDpibG9jaz1cIiR2dWV0aWZ5LmJyZWFrcG9pbnQuc21BbmREb3duXCIgbGFyZ2UgY29sb3I9XCJwcmltYXJ5XCIgdi10ZXh0PVwidHJhbnMoJ1NhdmUgU2V0dGluZ3MnKVwiPjwvdi1idG4+XG4gICAgICAgICAgICA8L2Rpdj4gLS0+XG4gICAgICAgICAgPC92LWNhcmQtdGV4dD5cbiAgICAgICAgPC92LWNhcmQ+XG4gICAgICA8L3YtY29sPlxuICAgIDwvdi1yb3c+XG4gIDwvYWRtaW4+XG48L3RlbXBsYXRlPlxuXG48c2NyaXB0PlxuZXhwb3J0IGRlZmF1bHQge1xuICBkYXRhOiAoKSA9PiAoe1xuICAgIHNldHRpbmdzOiB7XG4gICAgICAnZm9ybWFsOmRhdGUnOiB7XG4gICAgICAgIGtleTogJ2Zvcm1hbDpkYXRlJyxcbiAgICAgICAgdmFsdWU6ICcnLFxuICAgICAgfSxcbiAgICAgICdkaXNwbGF5OnBlcnBhZ2UnOiB7XG4gICAgICAgIGtleTogJ2Rpc3BsYXk6cGVycGFnZScsXG4gICAgICAgIHZhbHVlOiAxNSxcbiAgICAgIH0sXG4gICAgfSxcbiAgfSksXG5cbiAgbWV0aG9kczoge1xuICAgIGxvYWRTZXR0aW5ncyAoKSB7XG4gICAgICAvLyBheGlvcy5nZXQoKVxuICAgIH0sXG5cbiAgICBzYXZlU2V0dGluZ3MgKCkge1xuICAgICAgbGV0IGRhdGEgPSB0aGlzLnNldHRpbmdzXG4gICAgICBheGlvcy5wb3N0KFxuICAgICAgICBgL2FwaS92MS9zZXR0aW5nc2AsIGRhdGFcbiAgICAgICkudGhlbihyZXNwb25zZSA9PiB7XG4gICAgICAgIGNvbnNvbGUubG9nKHJlc3BvbnNlKVxuICAgICAgfSlcbiAgICB9LFxuICB9LFxufVxuPC9zY3JpcHQ+XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/General.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46&":
/*!**************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vuetify-loader/lib/loader.js??ref--14-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46& ***!
  \**************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"admin\",\n    [\n      _c(\"page-header\", {\n        scopedSlots: _vm._u([\n          {\n            key: \"title\",\n            fn: function() {\n              return undefined\n            },\n            proxy: true\n          }\n        ])\n      }),\n      _vm._v(\" \"),\n      _c(\n        \"v-row\",\n        [\n          _c(\n            \"v-col\",\n            { attrs: { cols: \"12\", md: \"8\" } },\n            [\n              _c(\n                \"v-card\",\n                [\n                  _c(\"v-card-title\", {\n                    domProps: {\n                      textContent: _vm._s(_vm.trans(\"Displaying Data\"))\n                    }\n                  }),\n                  _vm._v(\" \"),\n                  _c(\n                    \"v-card-text\",\n                    [\n                      _c(\"p\", {\n                        staticClass: \"muted--text\",\n                        domProps: { textContent: _vm._s(_vm.trans(\"Formats\")) }\n                      }),\n                      _vm._v(\" \"),\n                      _c(\"v-text-field\", {\n                        staticClass: \"mb-3\",\n                        attrs: {\n                          label: _vm.trans(\"Global Date Format\"),\n                          autofocus: \"\",\n                          outlined: \"\"\n                        },\n                        model: {\n                          value: _vm.settings[\"formal:date\"][\"value\"],\n                          callback: function($$v) {\n                            _vm.$set(_vm.settings[\"formal:date\"], \"value\", $$v)\n                          },\n                          expression: \"settings['formal:date']['value']\"\n                        }\n                      }),\n                      _vm._v(\" \"),\n                      _c(\"v-text-field\", {\n                        staticClass: \"mb-3\",\n                        attrs: {\n                          label: _vm.trans(\"Items per Page\"),\n                          outlined: \"\"\n                        },\n                        model: {\n                          value: _vm.settings[\"display:perpage\"][\"value\"],\n                          callback: function($$v) {\n                            _vm.$set(\n                              _vm.settings[\"display:perpage\"],\n                              \"value\",\n                              $$v\n                            )\n                          },\n                          expression: \"settings['display:perpage']['value']\"\n                        }\n                      }),\n                      _vm._v(\" \"),\n                      _c(\"language-switcher\", { staticClass: \"mb-6\" })\n                    ],\n                    1\n                  )\n                ],\n                1\n              )\n            ],\n            1\n          )\n        ],\n        1\n      )\n    ],\n    1\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9TZXR0aW5ncy9HZW5lcmFsLnZ1ZT9iOTIyIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsYUFBYTtBQUNiO0FBQ0E7QUFDQTtBQUNBLE9BQU87QUFDUDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxhQUFhLFNBQVMsc0JBQXNCLEVBQUU7QUFDOUM7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLG1CQUFtQjtBQUNuQjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxtQ0FBbUM7QUFDbkMsdUJBQXVCO0FBQ3ZCO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EseUJBQXlCO0FBQ3pCO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsMkJBQTJCO0FBQzNCO0FBQ0E7QUFDQSx1QkFBdUI7QUFDdkI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EseUJBQXlCO0FBQ3pCO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSwyQkFBMkI7QUFDM0I7QUFDQTtBQUNBLHVCQUF1QjtBQUN2QjtBQUNBLCtDQUErQyxzQkFBc0I7QUFDckU7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwiZmlsZSI6Ii4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2xvYWRlcnMvdGVtcGxhdGVMb2FkZXIuanM/IS4vbm9kZV9tb2R1bGVzL3Z1ZXRpZnktbG9hZGVyL2xpYi9sb2FkZXIuanM/IS4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPyEuL3NyYy9tb2R1bGVzL1NldHRpbmdzL0dlbmVyYWwudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTJlYzAwZDQ2Ji5qcyIsInNvdXJjZXNDb250ZW50IjpbInZhciByZW5kZXIgPSBmdW5jdGlvbigpIHtcbiAgdmFyIF92bSA9IHRoaXNcbiAgdmFyIF9oID0gX3ZtLiRjcmVhdGVFbGVtZW50XG4gIHZhciBfYyA9IF92bS5fc2VsZi5fYyB8fCBfaFxuICByZXR1cm4gX2MoXG4gICAgXCJhZG1pblwiLFxuICAgIFtcbiAgICAgIF9jKFwicGFnZS1oZWFkZXJcIiwge1xuICAgICAgICBzY29wZWRTbG90czogX3ZtLl91KFtcbiAgICAgICAgICB7XG4gICAgICAgICAgICBrZXk6IFwidGl0bGVcIixcbiAgICAgICAgICAgIGZuOiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgcmV0dXJuIHVuZGVmaW5lZFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHByb3h5OiB0cnVlXG4gICAgICAgICAgfVxuICAgICAgICBdKVxuICAgICAgfSksXG4gICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgX2MoXG4gICAgICAgIFwidi1yb3dcIixcbiAgICAgICAgW1xuICAgICAgICAgIF9jKFxuICAgICAgICAgICAgXCJ2LWNvbFwiLFxuICAgICAgICAgICAgeyBhdHRyczogeyBjb2xzOiBcIjEyXCIsIG1kOiBcIjhcIiB9IH0sXG4gICAgICAgICAgICBbXG4gICAgICAgICAgICAgIF9jKFxuICAgICAgICAgICAgICAgIFwidi1jYXJkXCIsXG4gICAgICAgICAgICAgICAgW1xuICAgICAgICAgICAgICAgICAgX2MoXCJ2LWNhcmQtdGl0bGVcIiwge1xuICAgICAgICAgICAgICAgICAgICBkb21Qcm9wczoge1xuICAgICAgICAgICAgICAgICAgICAgIHRleHRDb250ZW50OiBfdm0uX3MoX3ZtLnRyYW5zKFwiRGlzcGxheWluZyBEYXRhXCIpKVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICB9KSxcbiAgICAgICAgICAgICAgICAgIF92bS5fdihcIiBcIiksXG4gICAgICAgICAgICAgICAgICBfYyhcbiAgICAgICAgICAgICAgICAgICAgXCJ2LWNhcmQtdGV4dFwiLFxuICAgICAgICAgICAgICAgICAgICBbXG4gICAgICAgICAgICAgICAgICAgICAgX2MoXCJwXCIsIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHN0YXRpY0NsYXNzOiBcIm11dGVkLS10ZXh0XCIsXG4gICAgICAgICAgICAgICAgICAgICAgICBkb21Qcm9wczogeyB0ZXh0Q29udGVudDogX3ZtLl9zKF92bS50cmFucyhcIkZvcm1hdHNcIikpIH1cbiAgICAgICAgICAgICAgICAgICAgICB9KSxcbiAgICAgICAgICAgICAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgICAgICAgICAgICAgIF9jKFwidi10ZXh0LWZpZWxkXCIsIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHN0YXRpY0NsYXNzOiBcIm1iLTNcIixcbiAgICAgICAgICAgICAgICAgICAgICAgIGF0dHJzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgIGxhYmVsOiBfdm0udHJhbnMoXCJHbG9iYWwgRGF0ZSBGb3JtYXRcIiksXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGF1dG9mb2N1czogXCJcIixcbiAgICAgICAgICAgICAgICAgICAgICAgICAgb3V0bGluZWQ6IFwiXCJcbiAgICAgICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgICAgICBtb2RlbDoge1xuICAgICAgICAgICAgICAgICAgICAgICAgICB2YWx1ZTogX3ZtLnNldHRpbmdzW1wiZm9ybWFsOmRhdGVcIl1bXCJ2YWx1ZVwiXSxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgY2FsbGJhY2s6IGZ1bmN0aW9uKCQkdikge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIF92bS4kc2V0KF92bS5zZXR0aW5nc1tcImZvcm1hbDpkYXRlXCJdLCBcInZhbHVlXCIsICQkdilcbiAgICAgICAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgZXhwcmVzc2lvbjogXCJzZXR0aW5nc1snZm9ybWFsOmRhdGUnXVsndmFsdWUnXVwiXG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgfSksXG4gICAgICAgICAgICAgICAgICAgICAgX3ZtLl92KFwiIFwiKSxcbiAgICAgICAgICAgICAgICAgICAgICBfYyhcInYtdGV4dC1maWVsZFwiLCB7XG4gICAgICAgICAgICAgICAgICAgICAgICBzdGF0aWNDbGFzczogXCJtYi0zXCIsXG4gICAgICAgICAgICAgICAgICAgICAgICBhdHRyczoge1xuICAgICAgICAgICAgICAgICAgICAgICAgICBsYWJlbDogX3ZtLnRyYW5zKFwiSXRlbXMgcGVyIFBhZ2VcIiksXG4gICAgICAgICAgICAgICAgICAgICAgICAgIG91dGxpbmVkOiBcIlwiXG4gICAgICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICAgICAgbW9kZWw6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgdmFsdWU6IF92bS5zZXR0aW5nc1tcImRpc3BsYXk6cGVycGFnZVwiXVtcInZhbHVlXCJdLFxuICAgICAgICAgICAgICAgICAgICAgICAgICBjYWxsYmFjazogZnVuY3Rpb24oJCR2KSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgX3ZtLiRzZXQoXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBfdm0uc2V0dGluZ3NbXCJkaXNwbGF5OnBlcnBhZ2VcIl0sXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBcInZhbHVlXCIsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkJHZcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICApXG4gICAgICAgICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGV4cHJlc3Npb246IFwic2V0dGluZ3NbJ2Rpc3BsYXk6cGVycGFnZSddWyd2YWx1ZSddXCJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICB9KSxcbiAgICAgICAgICAgICAgICAgICAgICBfdm0uX3YoXCIgXCIpLFxuICAgICAgICAgICAgICAgICAgICAgIF9jKFwibGFuZ3VhZ2Utc3dpdGNoZXJcIiwgeyBzdGF0aWNDbGFzczogXCJtYi02XCIgfSlcbiAgICAgICAgICAgICAgICAgICAgXSxcbiAgICAgICAgICAgICAgICAgICAgMVxuICAgICAgICAgICAgICAgICAgKVxuICAgICAgICAgICAgICAgIF0sXG4gICAgICAgICAgICAgICAgMVxuICAgICAgICAgICAgICApXG4gICAgICAgICAgICBdLFxuICAgICAgICAgICAgMVxuICAgICAgICAgIClcbiAgICAgICAgXSxcbiAgICAgICAgMVxuICAgICAgKVxuICAgIF0sXG4gICAgMVxuICApXG59XG52YXIgc3RhdGljUmVuZGVyRm5zID0gW11cbnJlbmRlci5fd2l0aFN0cmlwcGVkID0gdHJ1ZVxuXG5leHBvcnQgeyByZW5kZXIsIHN0YXRpY1JlbmRlckZucyB9Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46&\n");

/***/ }),

/***/ "./src/modules/Settings/General.vue":
/*!******************************************!*\
  !*** ./src/modules/Settings/General.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _General_vue_vue_type_template_id_2ec00d46___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./General.vue?vue&type=template&id=2ec00d46& */ \"./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46&\");\n/* harmony import */ var _General_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./General.vue?vue&type=script&lang=js& */ \"./src/modules/Settings/General.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vuetify-loader/lib/runtime/installComponents.js */ \"./node_modules/vuetify-loader/lib/runtime/installComponents.js\");\n/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vuetify/lib/components/VCard */ \"./node_modules/vuetify/lib/components/VCard/index.js\");\n/* harmony import */ var vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! vuetify/lib/components/VGrid */ \"./node_modules/vuetify/lib/components/VGrid/index.js\");\n/* harmony import */ var vuetify_lib_components_VTextField__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! vuetify/lib/components/VTextField */ \"./node_modules/vuetify/lib/components/VTextField/index.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _General_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _General_vue_vue_type_template_id_2ec00d46___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _General_vue_vue_type_template_id_2ec00d46___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* vuetify-loader */\n\n\n\n\n\n\n\n_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3___default()(component, {VCard: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_4__[\"VCard\"],VCardText: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_4__[\"VCardText\"],VCardTitle: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_4__[\"VCardTitle\"],VCol: vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_5__[\"VCol\"],VRow: vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_5__[\"VRow\"],VTextField: vuetify_lib_components_VTextField__WEBPACK_IMPORTED_MODULE_6__[\"VTextField\"]})\n\n\n/* hot reload */\nif (false) { var api; }\ncomponent.options.__file = \"src/modules/Settings/General.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9TZXR0aW5ncy9HZW5lcmFsLnZ1ZT8xNjAwIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFzRjtBQUMzQjtBQUNMOzs7QUFHdEQ7QUFDNkY7QUFDN0YsZ0JBQWdCLDJHQUFVO0FBQzFCLEVBQUUsNkVBQU07QUFDUixFQUFFLGtGQUFNO0FBQ1IsRUFBRSwyRkFBZTtBQUNqQjtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNzRztBQUNqRDtBQUNJO0FBQ0M7QUFDTjtBQUNBO0FBQ1c7QUFDL0Qsb0dBQWlCLGFBQWEseUVBQUssQ0FBQyxpRkFBUyxDQUFDLG1GQUFVLENBQUMsdUVBQUksQ0FBQyx1RUFBSSxDQUFDLHdGQUFVLENBQUM7OztBQUc5RTtBQUNBLElBQUksS0FBVSxFQUFFLFlBaUJmO0FBQ0Q7QUFDZSxnRiIsImZpbGUiOiIuL3NyYy9tb2R1bGVzL1NldHRpbmdzL0dlbmVyYWwudnVlLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgcmVuZGVyLCBzdGF0aWNSZW5kZXJGbnMgfSBmcm9tIFwiLi9HZW5lcmFsLnZ1ZT92dWUmdHlwZT10ZW1wbGF0ZSZpZD0yZWMwMGQ0NiZcIlxuaW1wb3J0IHNjcmlwdCBmcm9tIFwiLi9HZW5lcmFsLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIlxuZXhwb3J0ICogZnJvbSBcIi4vR2VuZXJhbC52dWU/dnVlJnR5cGU9c2NyaXB0Jmxhbmc9anMmXCJcblxuXG4vKiBub3JtYWxpemUgY29tcG9uZW50ICovXG5pbXBvcnQgbm9ybWFsaXplciBmcm9tIFwiIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9ydW50aW1lL2NvbXBvbmVudE5vcm1hbGl6ZXIuanNcIlxudmFyIGNvbXBvbmVudCA9IG5vcm1hbGl6ZXIoXG4gIHNjcmlwdCxcbiAgcmVuZGVyLFxuICBzdGF0aWNSZW5kZXJGbnMsXG4gIGZhbHNlLFxuICBudWxsLFxuICBudWxsLFxuICBudWxsXG4gIFxuKVxuXG4vKiB2dWV0aWZ5LWxvYWRlciAqL1xuaW1wb3J0IGluc3RhbGxDb21wb25lbnRzIGZyb20gXCIhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZXRpZnktbG9hZGVyL2xpYi9ydW50aW1lL2luc3RhbGxDb21wb25lbnRzLmpzXCJcbmltcG9ydCB7IFZDYXJkIH0gZnJvbSAndnVldGlmeS9saWIvY29tcG9uZW50cy9WQ2FyZCc7XG5pbXBvcnQgeyBWQ2FyZFRleHQgfSBmcm9tICd2dWV0aWZ5L2xpYi9jb21wb25lbnRzL1ZDYXJkJztcbmltcG9ydCB7IFZDYXJkVGl0bGUgfSBmcm9tICd2dWV0aWZ5L2xpYi9jb21wb25lbnRzL1ZDYXJkJztcbmltcG9ydCB7IFZDb2wgfSBmcm9tICd2dWV0aWZ5L2xpYi9jb21wb25lbnRzL1ZHcmlkJztcbmltcG9ydCB7IFZSb3cgfSBmcm9tICd2dWV0aWZ5L2xpYi9jb21wb25lbnRzL1ZHcmlkJztcbmltcG9ydCB7IFZUZXh0RmllbGQgfSBmcm9tICd2dWV0aWZ5L2xpYi9jb21wb25lbnRzL1ZUZXh0RmllbGQnO1xuaW5zdGFsbENvbXBvbmVudHMoY29tcG9uZW50LCB7VkNhcmQsVkNhcmRUZXh0LFZDYXJkVGl0bGUsVkNvbCxWUm93LFZUZXh0RmllbGR9KVxuXG5cbi8qIGhvdCByZWxvYWQgKi9cbmlmIChtb2R1bGUuaG90KSB7XG4gIHZhciBhcGkgPSByZXF1aXJlKFwiL2hvbWUvcHJpbmNlc3MvUHJvamVjdHMvYmVzdC90aGVtZXMvZG92ZXRhaWwvbm9kZV9tb2R1bGVzL3Z1ZS1ob3QtcmVsb2FkLWFwaS9kaXN0L2luZGV4LmpzXCIpXG4gIGFwaS5pbnN0YWxsKHJlcXVpcmUoJ3Z1ZScpKVxuICBpZiAoYXBpLmNvbXBhdGlibGUpIHtcbiAgICBtb2R1bGUuaG90LmFjY2VwdCgpXG4gICAgaWYgKCFhcGkuaXNSZWNvcmRlZCgnMmVjMDBkNDYnKSkge1xuICAgICAgYXBpLmNyZWF0ZVJlY29yZCgnMmVjMDBkNDYnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9IGVsc2Uge1xuICAgICAgYXBpLnJlbG9hZCgnMmVjMDBkNDYnLCBjb21wb25lbnQub3B0aW9ucylcbiAgICB9XG4gICAgbW9kdWxlLmhvdC5hY2NlcHQoXCIuL0dlbmVyYWwudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTJlYzAwZDQ2JlwiLCBmdW5jdGlvbiAoKSB7XG4gICAgICBhcGkucmVyZW5kZXIoJzJlYzAwZDQ2Jywge1xuICAgICAgICByZW5kZXI6IHJlbmRlcixcbiAgICAgICAgc3RhdGljUmVuZGVyRm5zOiBzdGF0aWNSZW5kZXJGbnNcbiAgICAgIH0pXG4gICAgfSlcbiAgfVxufVxuY29tcG9uZW50Lm9wdGlvbnMuX19maWxlID0gXCJzcmMvbW9kdWxlcy9TZXR0aW5ncy9HZW5lcmFsLnZ1ZVwiXG5leHBvcnQgZGVmYXVsdCBjb21wb25lbnQuZXhwb3J0cyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/modules/Settings/General.vue\n");

/***/ }),

/***/ "./src/modules/Settings/General.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./src/modules/Settings/General.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_General_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vuetify-loader/lib/loader.js??ref--14-0!../../../node_modules/vue-loader/lib??vue-loader-options!./General.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/General.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_General_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); //# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9TZXR0aW5ncy9HZW5lcmFsLnZ1ZT82MGIyIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQSx3Q0FBcVAsQ0FBZ0Isc1NBQUcsRUFBQyIsImZpbGUiOiIuL3NyYy9tb2R1bGVzL1NldHRpbmdzL0dlbmVyYWwudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJi5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBtb2QgZnJvbSBcIi0hLi4vLi4vLi4vbm9kZV9tb2R1bGVzL2JhYmVsLWxvYWRlci9saWIvaW5kZXguanM/P3JlZi0tNC0wIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWV0aWZ5LWxvYWRlci9saWIvbG9hZGVyLmpzPz9yZWYtLTE0LTAhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZS1sb2FkZXIvbGliL2luZGV4LmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi9HZW5lcmFsLnZ1ZT92dWUmdHlwZT1zY3JpcHQmbGFuZz1qcyZcIjsgZXhwb3J0IGRlZmF1bHQgbW9kOyBleHBvcnQgKiBmcm9tIFwiLSEuLi8uLi8uLi9ub2RlX21vZHVsZXMvYmFiZWwtbG9hZGVyL2xpYi9pbmRleC5qcz8/cmVmLS00LTAhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZXRpZnktbG9hZGVyL2xpYi9sb2FkZXIuanM/P3JlZi0tMTQtMCEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL0dlbmVyYWwudnVlP3Z1ZSZ0eXBlPXNjcmlwdCZsYW5nPWpzJlwiIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/modules/Settings/General.vue?vue&type=script&lang=js&\n");

/***/ }),

/***/ "./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46&":
/*!*************************************************************************!*\
  !*** ./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46& ***!
  \*************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_General_vue_vue_type_template_id_2ec00d46___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vuetify-loader/lib/loader.js??ref--14-0!../../../node_modules/vue-loader/lib??vue-loader-options!./General.vue?vue&type=template&id=2ec00d46& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_General_vue_vue_type_template_id_2ec00d46___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_14_0_node_modules_vue_loader_lib_index_js_vue_loader_options_General_vue_vue_type_template_id_2ec00d46___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvbW9kdWxlcy9TZXR0aW5ncy9HZW5lcmFsLnZ1ZT9jY2U5Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSIsImZpbGUiOiIuL3NyYy9tb2R1bGVzL1NldHRpbmdzL0dlbmVyYWwudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTJlYzAwZDQ2Ji5qcyIsInNvdXJjZXNDb250ZW50IjpbImV4cG9ydCAqIGZyb20gXCItIS4uLy4uLy4uL25vZGVfbW9kdWxlcy92dWUtbG9hZGVyL2xpYi9sb2FkZXJzL3RlbXBsYXRlTG9hZGVyLmpzPz92dWUtbG9hZGVyLW9wdGlvbnMhLi4vLi4vLi4vbm9kZV9tb2R1bGVzL3Z1ZXRpZnktbG9hZGVyL2xpYi9sb2FkZXIuanM/P3JlZi0tMTQtMCEuLi8uLi8uLi9ub2RlX21vZHVsZXMvdnVlLWxvYWRlci9saWIvaW5kZXguanM/P3Z1ZS1sb2FkZXItb3B0aW9ucyEuL0dlbmVyYWwudnVlP3Z1ZSZ0eXBlPXRlbXBsYXRlJmlkPTJlYzAwZDQ2JlwiIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/modules/Settings/General.vue?vue&type=template&id=2ec00d46&\n");

/***/ })

}]);