(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{12:function(t,e,r){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e,r){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e,"?month=").concat(r)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},327:function(t,e,r){"use strict";r.r(e);var n=r(9),o=r(12),a={computed:{isFetchingResource:function(){return this.resource.loading},isFinishedFetchingResource:function(){return!this.resource.loading}},components:{SkeletonShow:r(75).a},data:function(){return{api:o.a,resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,file:{},data:{}},url:null}},methods:{getReportData:function(){var t=this,e=this.$route.params.id,r=this.$route.query.user_id||n.default.getId();axios.get(o.a.overall(e,r)).then((function(e){t.resource.file=e.data}))},previewPDFReport:function(t){var e=this.$route.query.lang||this.resource.lang;window.open("/best/reports/pdf/preview?report_id=".concat(t.id,"&month=").concat(t.month,"&lang=").concat(e),"_blank")},getReport:function(){var t=this;this.resource.loading=!0;var e=this.$route.query.lang||this.resource.lang;this.$router.push({query:{lang:e}}).catch((function(t){})),axios.get("/api/v1/reports/".concat(this.$route.params.report),{params:{lang:e}}).then((function(r){t.resource.data=r.data.data;var n=t.resource.data.value["current:index"].taxonomy.id||null,o=t.$route.query.type||"index";t.url="/best/preview/reports/".concat(t.$route.params.report,"?type=").concat(o,"&taxonomy_id=").concat(n,"&lang=").concat(e)})).finally((function(){t.resource.loading=!1}))},goToSurveyPage:function(t){this.$router.push({name:"companies.response",query:{month:t.remarks},params:{id:this.$route.params.id,taxonomy:t.value["current:index"].taxonomy.id||null,survey:t.value["survey:id"]}})},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"reports.show",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t}}).catch((function(t){})),this.$router.go()},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){document.querySelector("#iframe-preview").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)}))}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport()}},i=r(0),s=r(2),c=r.n(s),u=r(106),l=r(271),p=r(93),d=Object(i.a)(a,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.trans("Find Company")}}),t._v(" "),r("page-header",{attrs:{back:{to:{name:"companies.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v(t._s(t.trans("Report Preview")))]},proxy:!0},{key:"utilities",fn:function(){return[t.resource.data?r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return e.preventDefault(),t.previewPDFReport(t.resource.data)}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-pdf")]),t._v("\n        "+t._s(t.trans("Preview PDF Report"))+"\n      ")],1):t._e()]},proxy:!0},{key:"action",fn:function(){return["en"==t.resource.lang?r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("ar")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in Arabic"))+"\n      ")],1):r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("en")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in English"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),[r("v-card",{attrs:{outlined:""}},[r("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=d.exports;c()(d,{VBtn:u.a,VCard:l.a,VIcon:p.a})},75:function(t,e,r){"use strict";var n=r(0),o=r(2),a=r.n(o),i=r(590),s=r(592),c=r(605),u=Object(n.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("section",[e("page-header",{attrs:{back:{to:{name:"companies.index"},text:this.trans("Companies")}},scopedSlots:this._u([{key:"title",fn:function(){return[e("v-skeleton-loader",{attrs:{type:"text"}})]},proxy:!0},{key:"action",fn:function(){return[e("v-skeleton-loader",{attrs:{type:"button",height:"50"}})]},proxy:!0}])}),this._v(" "),e("v-row",[e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12",md:"6"}},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1)],1)],1)}),[],!1,null,null,null);e.a=u.exports;a()(u,{VCol:i.a,VRow:s.a,VSkeletonLoader:c.a})}}]);
//# sourceMappingURL=15.js.map