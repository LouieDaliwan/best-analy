(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{142:function(t,e,n){"use strict";var r=n(71);n.n(r).a},143:function(t,e,n){(e=n(89)(!1)).push([t.i,"\n.text-right input {\n  text-align: right;\n}\n",""]),t.exports=e},380:function(t,e,n){"use strict";n.r(e);function r(t){return(r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function i(t,e){return!e||"object"!==r(e)&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function o(t){return(o=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function a(t,e){return(a=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}var s=function(t){function e(){var t;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,e),(t=i(this,o(e).call(this))).search=null,t.options={page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},t.meta={},t.modes={bulkedit:!1},t.selected=[],t.data=[],t}return function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&a(t,e)}(e,t),e}(n(55).a),c={components:{PeriodForm:function(){return Promise.all([n.e(4),n.e(52)]).then(n.bind(null,381))}},data:function(){return{resources:new s,period:{}}},methods:{getResources:function(){this.resources.data=[{id:1,description:"Q1 2018",sales:"15000",raw:"7600"},{id:2,description:"Q2 2018",sales:"2500",raw:"1500"},{id:3,description:"Q3 2018",sales:"12000",raw:"5100"},{id:4,description:"Q4 2018",sales:"50000",raw:"16099"}]},setPeriod:function(t){this.period=0===t?{}:this.resources.data[t-1]}},mounted:function(){this.getResources()}},u=(n(142),n(0)),l=n(2),f=n.n(l),v=n(116),d=n(280),p=n(1),h=n(612),y=n(102),b=n(284),m=n(118),g=n(285),w=n(287),O=n(8),_=n(288),P=n(614),j=n(615),k=n(290),V=Object(u.a)(c,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-card",[n("v-card-text",[n("v-row",[n("v-col",{attrs:{cols:"12",md:"3"}},[n("v-card",[n("v-list",[n("v-subheader",{staticClass:"d-flex"},[n("h3",[t._v("Periods")]),t._v(" "),n("v-spacer")],1),t._v(" "),n("v-list-item-group",{attrs:{color:"primary",mandatory:""},on:{change:t.setPeriod}},[n("v-list-item",[n("v-list-item-avatar",[n("v-icon",{attrs:{small:""}},[t._v("mdi-plus")])],1),t._v(" "),n("v-list-item-content",[n("v-list-item-title",[t._v("\n                    Add\n                  ")])],1)],1),t._v(" "),t._l(t.resources.data,(function(e,r){return n("v-list-item",{key:r},[n("v-list-item-content",[n("v-list-item-subtitle",[t._v("\n                    "+t._s(r+1)+" -\n                    "+t._s(e.period)+"\n                  ")])],1),t._v(" "),n("v-list-item-action",[n("v-btn",{attrs:{icon:"",small:"",color:"error"}},[n("v-icon",{attrs:{small:""}},[t._v("mdi-delete")])],1)],1)],1)}))],2)],1)],1)],1),t._v(" "),n("v-col",{attrs:{cols:"12",md:"9"}},[n("period-form",{model:{value:t.period,callback:function(e){t.period=e},expression:"period"}})],1)],1)],1)],1)}),[],!1,null,null,null);e.default=V.exports;f()(V,{VBtn:v.a,VCard:d.a,VCardText:p.c,VCol:h.a,VIcon:y.a,VList:b.a,VListItem:m.a,VListItemAction:g.a,VListItemAvatar:w.a,VListItemContent:O.a,VListItemGroup:_.a,VListItemSubtitle:O.b,VListItemTitle:O.c,VRow:P.a,VSpacer:j.a,VSubheader:k.a})},55:function(t,e,n){"use strict";function r(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function i(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?r(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function o(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function a(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}n.d(e,"a",(function(){return s}));var s=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.isFetching=!0,this.isLoading=!1,this.isFetching=!0,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={},this.hasData=!1}var e,n,r;return e=t,(n=[{key:"fetch",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isFetching=t}},{key:"load",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isLoading=t}},{key:"load",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isLoading=t}},{key:"fetch",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isFetching=t}},{key:"prestine",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isPrestine=t}},{key:"valid",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isValid=t}},{key:"setHasData",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.hasData=t}},{key:"setErrors",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.errors=t}},{key:"setData",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.data=t}},{key:"isDisabled",value:function(){return this.isLoading||this.isPrestine}},{key:"parseData",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=(i({},this.data),new FormData(t));return e&&n.append("_method","put"),n}}])&&a(e.prototype,n),r&&a(e,r),t}()},71:function(t,e,n){var r=n(143);"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n(90)(r,i);r.locals&&(t.exports=r.locals)}}]);
//# sourceMappingURL=5.js.map