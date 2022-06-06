(window.webpackJsonp=window.webpackJsonp||[]).push([[14],{11:function(t,e,n){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e,n){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e,"?month=").concat(n)},financialRatio:function(t){return"/api/v1/customer/".concat(t,"/financial-ratios")},financialRatioDelete:function(t){return"/api/v1/customers/".concat(t.customer_id,"/ratios/").concat(t.id,"/delete")},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"},sendUpdateVisit:function(){return"/api/v1/crm/visit-update/send"},sendAddFinancialsByFileNo:function(){return"/api/v1/crm/financial-file-no/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)},financialRatio:function(t,e){return"/api/v1/reports/financial-ratio/customers/".concat(t,"/users/").concat(e,"/financial-ratio")}}}},315:function(t,e,n){"use strict";n.r(e);var r=n(73),a=n(11);function i(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){if(!(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t)))return;var n=[],r=!0,a=!1,i=void 0;try{for(var o,c=t[Symbol.iterator]();!(r=(o=c.next()).done)&&(n.push(o.value),!e||n.length!==e);r=!0);}catch(t){a=!0,i=t}finally{try{r||null==c.return||c.return()}finally{if(a)throw i}}return n}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}var o={props:["value"],components:{GeneralInformation:function(){return n.e(50).then(n.bind(null,378))},SmeRating:function(){return Promise.all([n.e(48),n.e(52)]).then(n.bind(null,379))},KeyFinancialRatio:function(){return n.e(51).then(n.bind(null,380))},LatestReport:function(){return Promise.all([n.e(0),n.e(16)]).then(n.bind(null,381))}},data:function(){return{resource:new r.a,keyFinRation:{}}},methods:{getResource:function(){var t=this;Promise.all([axios.get(a.a.show(this.$route.params.id)),axios.get(a.a.financialRatio(this.$route.params.id))]).then((function(e){var n=i(e,2),r=n[0],a=n[1];t.resource.setData(r.data.data),t.keyFinRation=a.data,console.log(t.resource)})).finally((function(){t.resource.fetch(!1)}))}},created:function(){this.getResource()}},c=n(0),s=n(2),u=n.n(s),l=n(622),v=n(114),d=n(616),f=n(618),p=Object(c.a)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("admin",[n("metatag",{attrs:{title:t.resource.data.name}}),t._v(" "),n("back-to-top"),t._v(" "),n("page-header",{attrs:{back:{to:{name:"companies.index"},text:t.trans("Companies")}},scopedSlots:t._u([{key:"title",fn:function(){return[n("span",{domProps:{textContent:t._s(t.trans(":name's Dashboard",{name:""+t.resource.data.name}))}})]},proxy:!0}])}),t._v(" "),t.resource.isFetching?void 0:[t.resource.data.details.metadata.project_type?t._e():n("v-row",[n("v-col",[n("v-alert",{attrs:{type:"warning",text:"",icon:"mdi-exclamation",prominent:""}},[n("v-row",{attrs:{align:"center"}},[n("v-col",{staticClass:"grow"},[t._v("\n                Update the "),n("strong",[t._v("Project Type")]),t._v(" in the Project Information.\n              ")]),t._v(" "),n("v-col",{staticClass:"shrink"},[n("v-btn",{attrs:{color:"accent",large:"",to:{name:"companies.edit",params:{id:t.resource.data.id},query:{tab:0}}}},[t._v("Update")])],1)],1)],1)],1)],1),t._v(" "),n("v-row",[n("v-col",{attrs:{cols:"12",lg:"4"}},[n("general-information",{model:{value:t.resource.data,callback:function(e){t.$set(t.resource,"data",e)},expression:"resource.data"}})],1),t._v(" "),n("v-col",{attrs:{cols:"12",lg:"8"}},[n("sme-rating",{staticClass:"mb-5",model:{value:t.resource.data,callback:function(e){t.$set(t.resource,"data",e)},expression:"resource.data"}}),t._v(" "),n("key-financial-ratio",{staticClass:"mb-5",attrs:{customer:t.resource.data},model:{value:t.keyFinRation,callback:function(e){t.keyFinRation=e},expression:"keyFinRation"}}),t._v(" "),n("latest-report")],1)],1)]],2)}),[],!1,null,null,null);e.default=p.exports;u()(p,{VAlert:l.a,VBtn:v.a,VCol:d.a,VRow:f.a})},73:function(t,e,n){"use strict";function r(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function a(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?r(Object(n),!0).forEach((function(e){i(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function i(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function o(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}n.d(e,"a",(function(){return c}));var c=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.isFetching=!0,this.isLoading=!1,this.isFetching=!0,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={},this.hasData=!1}var e,n,r;return e=t,(n=[{key:"fetch",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isFetching=t}},{key:"load",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isLoading=t}},{key:"load",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isLoading=t}},{key:"fetch",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isFetching=t}},{key:"prestine",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isPrestine=t}},{key:"valid",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.isValid=t}},{key:"setHasData",value:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.hasData=t}},{key:"setErrors",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.errors=t}},{key:"setData",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.data=t}},{key:"isDisabled",value:function(){return this.isLoading||this.isPrestine}},{key:"parseData",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=(a({},this.data),new FormData(t));return e&&n.append("_method","put"),n}}])&&o(e.prototype,n),r&&o(e,r),t}()}}]);
//# sourceMappingURL=14.js.map