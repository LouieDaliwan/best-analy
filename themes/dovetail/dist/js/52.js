(window.webpackJsonp=window.webpackJsonp||[]).push([[52],{297:function(t,e,r){"use strict";r.r(e);var o=r(9),n=r(0),a=r(2),i=r.n(a),s=r(602),u=Object(n.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("section",[e("page-header",{attrs:{back:{to:{name:"companies.index"},text:this.trans("Companies")}},scopedSlots:this._u([{key:"title",fn:function(){return[e("v-skeleton-loader",{attrs:{type:"text"}})]},proxy:!0},{key:"action",fn:function(){return[e("v-skeleton-loader",{attrs:{type:"button",height:"50"}})]},proxy:!0}])}),this._v(" "),e("div",{staticClass:"text-center"},[e("v-skeleton-loader",{staticClass:"mb-4",attrs:{type:"image"}})],1)],1)}),[],!1,null,null,null),c=u.exports;i()(u,{VSkeletonLoader:s.a});var l={computed:{isFetchingResource:function(){return this.resource.loading},isFinishedFetchingResource:function(){return!this.resource.loading}},components:{SkeletonShow:c},data:function(){return{resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{},file:{}},url:null}},methods:{getReportData:function(){var t=this,e=this.$route.params.id,r=this.$route.query.user_id||o.default.getId();axios.get("/api/v1/reports/overall/team/".concat(e,"/user/").concat(r)).then((function(e){t.resource.file=e.data}))},previewPDFReport:function(t){var e=this.$route.query.lang||this.resource.lang;window.open("/best/reports/pdf/preview?report_id=".concat(t.id,"&month=").concat(t.month,"&lang=").concat(e),"_blank")},getReport:function(){var t=this;this.resource.loading=!0;var e=this.$route.query.lang||this.resource.lang;this.$router.push({query:{from:this.$route.query.from,lang:e}}).catch((function(t){})),axios.get("/api/v1/reports/".concat(this.$route.params.report),{params:{lang:e}}).then((function(r){t.resource.data=r.data.data;var o=t.resource.data.value["current:index"].taxonomy.id||null,n=t.$route.query.type||"index";t.url="/best/preview/reports/".concat(t.$route.params.report,"?type=").concat(n,"&taxonomy_id=").concat(o,"&lang=").concat(e)})).finally((function(){t.resource.loading=!1}))},goToSurveyPage:function(t){this.$router.push({name:"companies.response",query:{month:t.remarks},params:{id:this.$route.params.id,taxonomy:t.value["current:index"].taxonomy.id||null,survey:t.value["survey:id"]}})},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"teams.report",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t,from:this.$route.query.from,user_id:this.$route.query.user_id}}).catch((function(t){})),this.$router.go()},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)})),this.resource.loading=!1}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport()}},d=r(109),p=r(271),h=r(93),m=Object(n.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.trans("Find Company")}}),t._v(" "),r("page-header",{attrs:{back:{to:{name:"teams.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v(t._s(t.trans("Report Preview")))]},proxy:!0},{key:"action",fn:function(){return["en"==t.resource.lang?r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("ar")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in Arabic"))+"\n      ")],1):r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("en")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in English"))+"\n      ")],1)]},proxy:!0},{key:"utilities",fn:function(){return[r("p",{staticClass:"mb-0"},[t._v(t._s(t.trans("Generated by"))+": "),r("span",{attrs:{clas:"mr-3"}},[t._v(t._s(t.resource.data.author))])]),t._v(" "),t.resource.data?r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return e.preventDefault(),t.previewPDFReport(t.resource.data)}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-pdf")]),t._v("\n        "+t._s(t.trans("Preview PDF Report"))+"\n      ")],1):t._e()]},proxy:!0}])}),t._v(" "),[r("v-card",{attrs:{outlined:""}},[r("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=m.exports;i()(m,{VBtn:d.a,VCard:p.a,VIcon:h.a})}}]);
//# sourceMappingURL=52.js.map