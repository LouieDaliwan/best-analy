(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{12:function(t,e,r){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},284:function(t,e,r){"use strict";r.r(e);var n=r(12),o=r(36),s=r(72),a=r(6);function i(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function c(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var l={props:["items"],computed:{resourcesAreNotYetFinished:function(){return this.items.filter((function(t){return t["is:finished"]})).length!==this.items.length}},methods:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?i(Object(r),!0).forEach((function(e){c(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(a.b)({showDialog:"dialog/show",hideDialog:"dialog/hide"}),{getDialogOptions:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return Object.assign({illustration:function(){return Promise.resolve().then(r.bind(null,529))},title:trans("Generating :name Report",{name:t.data.name}),text:['<i class="mdi mdi-spin mdi-loading mr-3"></i> Retrieving performance index submission...'],persistent:!0,color:"primary",buttons:{cancel:{show:!1},action:{show:!1}}},t)},exportOverall:function(){var t=this;this.showDialog(this.getDialogOptions({data:{name:"Overall"}}));var e={customer_id:this.$route.params.id};axios.post("/api/v1/reports/1/generate",e).then((function(e){t.showDialog(t.getDialogOptions({data:index,text:['<i class="mdi mdi-spin mdi-loading mr-3"></i> Crunching survey data...']})),t.serveOverallFileToBrowser(e.data,index)}))},exportReport:function(t){var e={customer_id:this.$route.params.id,taxonomy_id:t.id};axios.post(n.a.reports.generate(t.survey.id),e).then((function(t){console.log(t)}))},serveFileToBrowser:function(t,e){var r=this;t=Object.assign(t,{pcode:e.alias}),axios.post("/reports/download",t,{responseType:"arraybuffer"}).then((function(t){var n=new Blob([t.data],{type:"application/pdf"}),o=document.createElement("a");o.href=window.URL.createObjectURL(n),o.download="".concat(e.name," Report.pdf"),o.click(),r.hideDialog()}))},serveOverallFileToBrowser:function(t){t=Object.assign(t),axios.post("/reports/download",t,{responseType:"arraybuffer"}).then((function(t){console.log(t)}))}})},u=r(0),d=r(2),p=r.n(d),v=r(104),m=r(91),f=r(266),h=r(106),g=r(14),y=r(271),_=Object(u.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("v-menu",{attrs:{"open-on-hover":"","offset-y":"",bottom:"",transition:"slide-y-transition"},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on;return[r("v-btn",t._g({attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"}},n),[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-download")]),t._v("\n      "+t._s(t.trans("Preview latest Report"))+"\n    ")],1)]}}])},[t._v(" "),r("v-list",{attrs:{dense:""}},[[t._l(t.items,(function(e,n){return r("v-list-item",{key:n,attrs:{disabled:!e["is:finished"]},on:{click:function(r){return t.exportReport(e)}}},[r("v-list-item-content",[r("v-list-item-title",{domProps:{textContent:t._s(e.name)}})],1)],1)})),t._v(" "),r("v-list-item",{attrs:{disabled:t.resourcesAreNotYetFinished},on:{click:function(e){return t.exportOverall()}}},[r("v-list-item-content",[r("v-list-item-title",[t._v(t._s(t.trans("Overall Reports")))])],1)],1)]],2)],1)}),[],!1,null,null,null),b=_.exports;p()(_,{VBtn:v.a,VIcon:m.a,VList:f.a,VListItem:h.a,VListItemContent:g.a,VListItemTitle:g.b,VMenu:y.a});var w={components:{ExportReportButton:b,SkeletonShow:s.a},computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resource.data)&&!this.resource.loading},resourcesHasReport:function(){return this.resource.data.indices.filter((function(t){return t["is:finished"]})).length>=1}},data:function(){return{api:n.a,resource:new o.a,resources:{reports:[],data:[],gradients:["linear-gradient(to top, #cc208e 0%, #6713d2 100%)","linear-gradient(to top, #ff0844 0%, #ffb199 100%)","linear-gradient(0deg, #53b8dc 0%, #7aefb9 100%)","linear-gradient(to top, #00c6fb 0%, #005bea 100%)"]}}},methods:{getResource:function(){var t=this;this.resource.loading=!0,axios.get(n.a.show(this.$route.params.id)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.resource.loading=!1}))},getResourceReport:function(){var t=this;this.resource.loading=!0,axios.get(n.a.reports.list(this.$route.params.id)).then((function(e){t.resources.reports=e.data.data})).finally((function(){t.resource.loading=!1}))},goToCompanySurveyPage:function(t){return{name:"companies.survey",params:{id:this.$route.params.id,taxonomy:t.code,survey:t.survey&&t.survey.id||null}}}},mounted:function(){this.getResource(),this.getResourceReport()}},x=r(262),k=r(1),O=r(579),C=r(581),R=r(582),j=r(587),V=r(47),P=r.n(V),S=r(35),$=Object(u.a)(w,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.resource.data.name}}),t._v(" "),t.resource.loading?[r("skeleton-show")]:[r("page-header",{attrs:{back:{to:{name:"companies.owned"},text:t.trans("Back")}},scopedSlots:t._u([{key:"title",fn:function(){return[r("span",{staticClass:"mb-3",class:t.$vuetify.breakpoint.smAndUp?"":"title font-weight-bold"},[t._v(t._s(t.resource.data.name))])]},proxy:!0},{key:"action",fn:function(){return[r("can",{attrs:{code:"customers.reports"}},[t.resourcesHasReport?r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,to:{name:"companies.reports",params:{id:t.$route.params.id}},color:"primary",exact:"",large:""}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-chart-outline")]),t._v("\n            "+t._s(t.__("View Reports"))+"\n          ")],1):t._e()],1)]},proxy:!0}])}),t._v(" "),r("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[r("div",{staticClass:"mb-6"},[r("v-row",[r("v-col",{staticClass:"py-0",attrs:{cols:"4",md:"2"}},[r("p",{staticClass:"mb-0 font-weight-bold"},[t._v(t._s(t.trans("Staff Strength"))+":")])]),t._v(" "),r("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[r("p",{staticClass:"mb-0 font-weight-regular"},[t._v(" "+t._s(t.resource.data.metadata&&t.resource.data.metadata.staffstrength||null))])])],1),t._v(" "),r("v-row",[r("v-col",{staticClass:"py-0",attrs:{cols:"4",md:"2"}},[r("p",{staticClass:"mb-0 font-weight-bold"},[t._v(t._s(t.trans("Industry"))+":")])]),t._v(" "),r("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[r("p",{staticClass:"mb-0 font-weight-regular"},[t._v(" "+t._s(t.resource.data.metadata&&t.resource.data.metadata.industry||null))])])],1)],1),t._v(" "),r("p",{staticClass:"font-weight-regular"},[t._v("\n        "+t._s(t.trans("Please select the type of survey evaluation that you would like to do for :name",{name:t.resource.data.name}))+":\n      ")]),t._v(" "),r("v-row",t._l(t.resource.data.indices||[],(function(e,n){return r("v-col",{key:n,attrs:{cols:"12",md:"6"}},[r("v-card",{directives:[{name:"ripple",rawName:"v-ripple",value:t.$vuetify.breakpoint.smAndUp?{class:"primary--text"}:null,expression:"$vuetify.breakpoint.smAndUp ? { class: 'primary--text' } : null"}],staticClass:"card-carded",attrs:{hover:t.$vuetify.breakpoint.smAndUp,to:t.$vuetify.breakpoint.smAndUp?t.goToCompanySurveyPage(e):null,exact:"",height:"100%"}},[r("v-card-text",[r("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(n){var o=n.on;return[e["is:finished"]?r("div",t._g({staticStyle:{position:"absolute"}},o),[r("v-icon",{attrs:{color:"success"}},[t._v("mdi-check-circle")])],1):t._e()]}}],null,!0)},[t._v(" "),r("span",[t._v(t._s(t.trans("You can now export the report")))])]),t._v(" "),r("v-row",{attrs:{justify:"space-between",align:"center"}},[r("v-col",[r("h3",{staticClass:"mt-5 font-weight-bold text-uppercase mb-2 mt-2 text-md-left text-center",domProps:{textContent:t._s(e.name)}}),t._v(" "),r("h4",{staticClass:"text-uppercase muted--text mb-0 text-md-left text-center",domProps:{textContent:t._s("Performance Index")}}),t._v(" "),e.report?r("small",{staticClass:"overlines"},[t._v("\n                    "+t._s(t.__("Modified"))+": "+t._s(e.report.modified)+"\n                  ")]):t._e()]),t._v(" "),r("v-col",{staticClass:"text-md-right text-center"},[r("img",{attrs:{height:"80",src:e.icon,alt:e.name}})])],1)],1),t._v(" "),t.$vuetify.breakpoint.xsOnly?r("v-card-actions",[r("v-spacer"),t._v(" "),r("v-btn",{attrs:{block:"",large:"",text:"",color:"primary",to:t.goToCompanySurveyPage(e),exact:""}},[t._v(t._s(t.__("Start Survey")))]),t._v(" "),r("v-spacer")],1):t._e()],1)],1)})),1)],1),t._v(" "),t.resourcesIsEmpty?r("div",[r("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[r("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"indices.create"}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-plus-outline")]),t._v("\n            "+t._s(t.trans("Add Index"))+"\n          ")],1)]},proxy:!0}],null,!1,455405267)})],1):t._e()]],2)}),[],!1,null,null,null);e.default=$.exports;p()($,{VBtn:v.a,VCard:x.a,VCardActions:k.a,VCardText:k.c,VCol:O.a,VIcon:m.a,VRow:C.a,VSpacer:R.a,VTooltip:j.a}),P()($,{Ripple:S.a})},36:function(t,e,r){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={title:"",title_arabic:"",code:"",body:"",body_arabic:"",metadata:{title_arabic:"",body_arabic:""},type:"",user_id:"",created:"",indices:[],answer:"",fields:[{group:"",group_arabic:"",type:"",children:[]}]}}},72:function(t,e,r){"use strict";var n=r(0),o=r(2),s=r.n(o),a=r(579),i=r(581),c=r(594),l=Object(n.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("section",[e("page-header",{attrs:{back:{to:{name:"companies.index"},text:this.trans("Companies")}},scopedSlots:this._u([{key:"title",fn:function(){return[e("v-skeleton-loader",{attrs:{type:"text"}})]},proxy:!0},{key:"action",fn:function(){return[e("v-skeleton-loader",{attrs:{type:"button",height:"50"}})]},proxy:!0}])}),this._v(" "),e("v-row",[e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1)],1)],1)}),[],!1,null,null,null);e.a=l.exports;s()(l,{VCol:a.a,VRow:i.a,VSkeletonLoader:c.a})}}]);
//# sourceMappingURL=6.js.map