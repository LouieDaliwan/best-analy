(window.webpackJsonp=window.webpackJsonp||[]).push([[50],{329:function(e,t,r){"use strict";r.r(t);var o=r(17),n=r(12),a={data:function(){return{resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{},user:{}},url:null}},methods:{getReport:function(){var e=this.$route.query.user_id||n.default.getId(),t=this.$route.params.id,r=this.$route.query.lang||this.resource.lang;this.$router.replace({query:{user_id:this.$route.query.user_id,lang:r,from:this.$route.query.from}}).catch((function(e){})),this.url="/best/preview/reports/overall?user_id=".concat(e,"&customer_id=").concat(t,"&lang=").concat(r)},getUser:function(){var e=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.reports.users.show(parseInt(this.$route.query.user_id))).then((function(t){e.resource.user=t.data.data})).finally((function(){e.resource.isPrestine=!0}))},sendToCrm:function(e){var t={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:e.value["overall:score"],FileContentBase64:e.fileContentBase64,"Lessons Learnt":e.value["overall:comment"]};axios.post(o.a.crm.save(),t).then((function(e){}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(e){var t=this.contentWindow||this.contentDocument.parentWindow;t.document.body&&(this.height=t.document.documentElement.scrollHeight||t.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",e),this.resource.lang=e,this.$router.push({name:"teams.overall",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:e,type:"overall",from:this.$route.query.from,user_id:this.$route.query.user_id}}).catch((function(e){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReport(),this.getUser()}},s=r(1),i=r(2),u=r.n(i),c=r(105),l=r(278),d=r(90),m=Object(s.a)(a,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("admin",[r("metatag",{attrs:{title:e.trans("Find Company")}}),e._v(" "),r("page-header",{attrs:{back:{to:{name:"teams.reports"},text:e.trans("Back to Reports")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.trans("Report Preview")))]},proxy:!0},{key:"utilities",fn:function(){return[r("p",{staticClass:"mb-0"},[e._v(e._s(e.trans("Generated by"))+": "),r("span",{attrs:{clas:"mr-3"}},[e._v(e._s(e.resource.user.displayname))])])]},proxy:!0},{key:"action",fn:function(){return[r("div",{staticClass:"mb-3"},["en"==e.resource.lang?r("v-btn",{attrs:{block:e.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(t){return e.goToShowPage("ar")}}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-earth")]),e._v("\n          "+e._s(e.trans("View Report in Arabic"))+"\n        ")],1):r("v-btn",{attrs:{block:e.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(t){return e.goToShowPage("en")}}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-earth")]),e._v("\n          "+e._s(e.trans("View Report in English"))+"\n        ")],1)],1),e._v(" "),r("div",[r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(t){return e.sendToCrm(e.item)}}},[r("v-icon",{attrs:{small:"",left:""}},[e._v("mdi-send")]),e._v("\n          "+e._s(e.trans("Send Report to CRM"))+"\n        ")],1)])]},proxy:!0}])}),e._v(" "),[r("v-card",{attrs:{outlined:""}},[r("iframe",{attrs:{width:"100%",id:"iframe-preview",src:e.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);t.default=m.exports;u()(m,{VBtn:c.a,VCard:l.a,VIcon:d.a})}}]);
//# sourceMappingURL=50.js.map