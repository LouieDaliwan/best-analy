(window.webpackJsonp=window.webpackJsonp||[]).push([[51],{322:function(t,e,r){"use strict";r.r(e);var o=r(15),n=r(9),a={data:function(){return{resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{report:{month:""}},user:{}},url:null}},methods:{getReportData:function(){var t=this,e=this.$route.params.id,r=this.$route.query.user_id||n.default.getId();axios.get("/api/v1/reports/overall/customer/".concat(e,"/user/").concat(r)).then((function(e){console.log(e.data),t.resource.data=e.data}))},getReport:function(){var t=this.$route.query.user_id||n.default.getId(),e=this.$route.params.id,r=this.$route.query.lang||this.resource.lang;this.$router.replace({query:{user_id:this.$route.query.user_id,lang:r,from:this.$route.query.from}}).catch((function(t){})),this.url="/best/preview/reports/overall?user_id=".concat(t,"&customer_id=").concat(e,"&lang=").concat(r)},getUser:function(){var t=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.reports.users.show(parseInt(this.$route.query.user_id))).then((function(e){t.resource.user=e.data.data})).finally((function(){t.resource.isPrestine=!0}))},previewPDFOverallReport:function(t){var e=this.$route.query.lang||this.resource.lang;window.open("/best/reports/pdf/preview?report_id=".concat(t.id,"&type=overall&lang=").concat(e),"_blank")},sendToCrm:function(t){var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post(o.a.crm.save(),e).then((function(t){}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"teams.overall",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t,type:"overall",from:this.$route.query.from,user_id:this.$route.query.user_id}}).catch((function(t){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReportData(),this.getReport(),this.getUser()}},s=r(0),i=r(2),u=r.n(i),c=r(104),l=r(262),d=r(91),p=Object(s.a)(a,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.trans("Find Company")}}),t._v(" "),r("page-header",{attrs:{back:{to:{name:"teams.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"utilities",fn:function(){return[t.resource.data.report?r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return e.preventDefault(),t.previewPDFOverallReport(t.resource.data.report)}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-pdf")]),t._v("\n        "+t._s(t.trans("Preview PDF Report"))+"\n      ")],1):t._e(),t._v(" "),r("can",{attrs:{code:"reports.comment"}},[r("add-overall-comment",{attrs:{month:t.resource.data.report.month},on:{"update:month":function(e){return t.$set(t.resource.data.report,"month",e)}}})],1)]},proxy:!0},{key:"action",fn:function(){return[r("div",{staticClass:"mb-3"},["en"==t.resource.lang?r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("ar")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n          "+t._s(t.trans("View Report in Arabic"))+"\n        ")],1):r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("en")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n          "+t._s(t.trans("View Report in English"))+"\n        ")],1)],1),t._v(" "),r("div",[r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.sendToCrm(t.item)}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-send")]),t._v("\n          "+t._s(t.trans("Send Overall Report to CRM"))+"\n        ")],1)])]},proxy:!0}])}),t._v(" "),[r("v-card",{attrs:{outlined:""}},[r("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=p.exports;u()(p,{VBtn:c.a,VCard:l.a,VIcon:d.a})}}]);
//# sourceMappingURL=51.js.map