(window.webpackJsonp=window.webpackJsonp||[]).push([[43],{307:function(t,e,r){"use strict";r.r(e);var n=r(12),o={data:function(){return{resource:{lang:window.localStorage.getItem("report:lang")||"en",loading:!1,data:{}},url:null}},methods:{getReport:function(){var t=this.$route.query.user_id||n.default.getId(),e=this.$route.params.id,r=this.$route.query.lang||this.resource.lang;this.$router.replace({query:{lang:r}}).catch((function(t){})),this.url="/best/preview/reports/overall?user_id=".concat(t,"&customer_id=").concat(e,"&lang=").concat(r)},sendToCrm:function(t){var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post($api.crm.save(),e).then((function(t){console.log(t)}))},downloadReport:function(){window.location.href="/reports/".concat(this.$route.params.report,"/download")},setIframeHeight:function(){this.resource.loading=!0,document.querySelector("iframe").addEventListener("load",(function(t){var e=this.contentWindow||this.contentDocument.parentWindow;e.document.body&&(this.height=e.document.documentElement.scrollHeight||e.document.body.scrollHeight)})),this.resource.loading=!1},goToShowPage:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"en";window.localStorage.setItem("report:lang",t),this.resource.lang=t,this.$router.push({name:"reports.overall",params:{id:this.$route.params.id,report:this.$route.params.report},query:{lang:t,type:"overall"}}).catch((function(t){})),this.$router.go()}},mounted:function(){this.setIframeHeight(),this.getReport()}},a=r(1),i=r(2),s=r.n(i),c=r(105),l=r(279),u=r(90),d=Object(a.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("admin",[r("metatag",{attrs:{title:t.trans("Find Company")}}),t._v(" "),r("page-header",{attrs:{back:{to:{name:"companies.reports"},text:t.trans("Back to Reports")}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v(t._s(t.trans("Report Preview")))]},proxy:!0},{key:"utilities",fn:function(){return[r("a",{staticClass:"dt-link text--decoration-none mr-4",on:{click:function(e){return t.sendToCrm(t.item)}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-send")]),t._v("\n        "+t._s(t.trans("Send Report to CRM"))+"\n      ")],1)]},proxy:!0},{key:"action",fn:function(){return["en"==t.resource.lang?r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("ar")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in Arabic"))+"\n      ")],1):r("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary"},on:{click:function(e){return t.goToShowPage("en")}}},[r("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-earth")]),t._v("\n        "+t._s(t.trans("View Report in English"))+"\n      ")],1)]},proxy:!0}])}),t._v(" "),[r("v-card",{attrs:{outlined:""}},[r("iframe",{attrs:{width:"100%",id:"iframe-preview",src:t.url,frameborder:"0"}})])]],2)}),[],!1,null,null,null);e.default=d.exports;s()(d,{VBtn:c.a,VCard:l.a,VIcon:u.a})}}]);
//# sourceMappingURL=43.js.map