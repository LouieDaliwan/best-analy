(window.webpackJsonp=window.webpackJsonp||[]).push([[66],{338:function(t,e,s){"use strict";s.r(e);var i=s(6);function o(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,i)}return s}function r(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var n={name:"TestIndex",computed:function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?o(Object(s),!0).forEach((function(e){r(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):o(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(i.c)({toggletoolbar:"toolbar/toolbar"})),data:function(){return{permissions:[],text:"Move to Trash",repeaters:[],widgets:[],staffs:[{title:"Staff",count:"0",icon:"mdi-account-outline",badge:!0,deactivated:"3"},{title:"Department",count:"0",icon:"mdi-door-closed"},{title:"Designation",count:"0",icon:"mdi-folder-account-outline"},{title:"User",count:"10",icon:"mdi-account-multiple-outline"}],courses:{hover:!0,url:"www.google.com",items:[{thumbnail:"//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png",title:"Far far away, behind the word mountains",description:"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.",category:"Taxonomy"}]},headers:[{text:"Account Name",align:"left",value:"name"},{text:"Email",value:"email"},{text:"Role",value:"role",sortable:!1},{text:"Date Created",value:"created"},{text:"Actions",value:"action",sortable:!1,class:"muted--text"}],desserts:[{name:"Princess Ellen Alto",email:"ellen@ssagroup.com",role:"Super Administrator",created:"2 months ago"}]}},methods:{openExport:function(){this.$store.dispatch("export/prompt",{show:!0,items:[{icon:"mdi-file-pdf",color:"error",name:"Portable Documment Format (.pdf)"},{icon:"mdi-google-spreadsheet",color:"green",name:"Microsoft Excel (.xlsx)"},{icon:"mdi-file-document",color:"blue",name:"Open Document Format (.ods)"}]})},changeLocale:function(t){this.$store.dispatch("app/locale",t),localStorage.setItem("app:rtl","ar"==t),this.$vuetify.rtl="ar"==t,this.$router.currentRoute.params.lang!==t&&this.$router.push({name:this.$router.currentRoute.name,params:{lang:t}})},runSnackbar:function(){this.$store.dispatch("snackbar/toggle",{show:!0,text:"This is a sample toast message"})},getPermissions:function(){var t=this;axios.get("/api/v1/users/permissions").then((function(e){t.permissions=e.data}))},submitToCRM:function(){var t=this;axios.post("/api/v1/crm/customers/save",{OverallScore:"80.0",FileNo:"19136",Id:"c63e0f9b-2b9b-e911-80db-00155d6597fc",FileContentBase64:"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",Comments:"This is a test comment."}).then((function(e){t.$store.dispatch("snackbar/show",{text:trans("Successfully saved to remote CRM")})})).catch((function(e){e.response.status==Response.HTTP_INTERNAL_SERVER_ERROR&&t.$store.dispatch("dialog/show",{illustration:function(){return Promise.resolve().then(s.bind(null,278))},color:"error",title:trans("Save to Remote CRM Failed"),text:[trans("An error occured while trying to save the report to the CRM app."),trans("Please make sure you are connected to the designated VPN in order to access the remote CRM."),trans("Contact your administrator for help. After resolving the issue, try again.")]})}))},getReport:function(){axios.post("/api/v1/reports/1/generate",{customer_id:1,taxonomy_id:1},{responseType:"arraybuffer"}).then((function(t){console.log(t)}))},getSubmissions:function(){axios.post("/api/v1/surveys/1/submit",{fields:[{id:1,submission:{user_id:41,results:4,customer_id:1,submissible_id:null,submissible_type:null}},{id:2,submission:{user_id:41,results:3,customer_id:1,submissible_id:null,submissible_type:null}},{id:3,submission:{user_id:41,results:1,customer_id:1,submissible_id:null,submissible_type:null}},{id:4,submission:{user_id:41,results:5,customer_id:1,submissible_id:null,submissible_type:null}},{id:5,submission:{user_id:41,results:3,customer_id:1,submissible_id:null,submissible_type:null}},{id:6,submission:{user_id:41,results:2,customer_id:1,submissible_id:null,submissible_type:null}},{id:7,submission:{user_id:41,results:4,customer_id:1,submissible_id:null,submissible_type:null}},{id:8,submission:{user_id:41,results:4,customer_id:1,submissible_id:null,submissible_type:null}},{id:9,submission:{user_id:41,results:6,customer_id:1,submissible_id:null,submissible_type:null}},{id:10,submission:{user_id:41,results:6,customer_id:1,submissible_id:null,submissible_type:null}}]}).then((function(t){console.log(t)}))}},mounted:function(){this.getPermissions()}},a=s(0),l=s(2),c=s.n(l),u=s(619),m=s(116),d=s(280),v=s(1),_=s(612),b=s(630),p=s(283),h=s(102),f=s(614),g=s(620),y=Object(a.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("h3",{attrs:{clas:"mb-3"}},[t._v("Glance widget")]),t._v(" "),s("v-row",t._l(t.staffs,(function(t,e){return s("v-col",{key:e,attrs:{md:"3",sm:"6",cols:"12"}},[s("glance",{attrs:{items:t}})],1)})),1),t._v(" "),s("v-btn",{on:{click:t.getSubmissions}},[t._v("Submit Sample Submission")]),t._v(" "),s("v-btn",{on:{click:t.getReport}},[t._v("Generate Sample's Report")]),t._v(" "),s("v-btn",{on:{click:t.submitToCRM}},[t._v("Submit To CRM API")]),t._v(" "),s("h3",{staticClass:"mt-9 mb-3"},[t._v("Icon Picker")]),t._v(" "),s("v-row",[s("v-col",{attrs:{md:"3",cols:"12"}},[s("icon-picker")],1)],1),t._v(" "),s("v-row",[s("v-col",{attrs:{md:"3",cols:"12"}},[s("find-or-new")],1)],1),t._v(" "),s("h3",{staticClass:"mt-9 mb-3"},[t._v("Toast/Snackbar")]),t._v(" "),s("p",[t._v("Click the button to run a sample toast.")]),t._v(" "),s("v-badge",{attrs:{color:"dark",overlap:"",transition:"fade-transition"},scopedSlots:t._u([{key:"badge",fn:function(){return[s("div",{staticClass:"small",attrs:{attr:"font-size: 10px"}},[t._v("ctrl+b")])]},proxy:!0}]),model:{value:t.$store.getters["app/app"].dark,callback:function(e){t.$set(t.$store.getters["app/app"],"dark",e)},expression:"$store.getters['app/app'].dark"}},[t._v(" "),s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","b"],expression:"['ctrl', 'b']",modifiers:{once:!0}}],on:{shortkey:t.runSnackbar,click:t.runSnackbar}},[t._v("Run Toast")])],1),t._v(" "),s("snackbar"),t._v(" "),s("h3",{staticClass:"mt-9 mb-3"},[t._v("Export")]),t._v(" "),s("export"),t._v(" "),s("v-btn",{attrs:{color:"primary"},on:{click:t.openExport}},[t._v("\n    "+t._s(t.trans("Open Export"))+"\n  ")]),t._v(" "),s("h3",{staticClass:"mt-9 mb-3"},[t._v("Can and Cannot permission")]),t._v(" "),s("v-card",[s("v-card-text",[s("cannot",{attrs:{code:"unexisting.permission"}},[s("div",[t._v("You are not permitted to 'unexisting.permission'")])]),t._v(" "),s("can",{attrs:{code:"libraries.delete"}},[s("div",[t._v("you can delete library entries")])])],1)],1),t._v(" "),s("h3",{staticClass:"mt-9 mb-3"},[t._v("Grid/List view")]),t._v(" "),t.toggletoolbar.toggleview?[s("v-card",[s("toolbar-menu"),t._v(" "),s("v-divider"),t._v(" "),s("v-data-table",{attrs:{headers:t.headers,items:t.desserts,"sort-by":"calories"},scopedSlots:t._u([{key:"item.action",fn:function(e){e.item;return[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[s("v-btn",t._g({attrs:{small:"",icon:""}},i),[s("v-icon",{attrs:{small:""}},[t._v("\n                  mdi-pencil-outline\n                ")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.__("Edit")))])]),t._v(" "),s("v-btn",{attrs:{small:"",icon:""}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[s("v-btn",t._g({attrs:{small:"",icon:""}},i),[s("v-icon",{attrs:{small:""}},[t._v("\n                    mdi-delete-outline\n                  ")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.__("Move to Trash")))])])],1)]}}],null,!1,778208270)})],1)]:[s("v-card",[s("toolbar-menu")],1),t._v(" "),s("data-iterator",{attrs:{items:t.courses}})],t._v(" "),s("h3",{staticClass:"mb-3 mt-9"},[t._v("Repeater")]),t._v(" "),s("v-card",{staticClass:"mt-3"},[s("v-card-title",{staticClass:"pb-0"},[t._v("Metadata")]),t._v(" "),s("v-card-text",[s("repeater",{attrs:{autofocus:"",fields:2},model:{value:t.repeaters,callback:function(e){t.repeaters=e},expression:"repeaters"}})],1)],1),t._v(" "),s("h3",{staticClass:"mb-3 mt-9"},[t._v("Translation")]),t._v(" "),s("v-card",{staticClass:"mt-3"},[s("v-card-actions",[s("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale("ja")}}},[t._v("Change locale to "),s("code",[t._v("ja")])]),t._v(" "),s("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale("ar")}}},[t._v("Change locale to "),s("code",[t._v("ar")])]),t._v(" "),s("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale("fil")}}},[t._v("Change locale to "),s("code",[t._v("fil")])]),t._v(" "),s("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale()}}},[t._v("Change locale to "),s("code",[t._v("en")])])],1),t._v(" "),s("v-card-text",[s("div",[t._v("Remember me: "),s("span",{domProps:{innerHTML:t._s(t.$t("Remember me"))}})]),t._v(" "),s("div",[t._v(t._s(t.$t("Don't have account yet?")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Remember me")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Sign in with your %s account")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Sign in")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Sign up")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Name")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Role")))]),t._v(" "),s("div",[t._v(t._s(t.$t("Cancel")))]),t._v(" "),s("div",{directives:[{name:"t",rawName:"v-t",value:"Edit",expression:"'Edit'"}]}),t._v(" "),s("div",{directives:[{name:"t",rawName:"v-t",value:t.text,expression:"text"}]})])],1),t._v(" "),s("h3",{staticClass:"mb-3 mt-9"},[t._v("Language Switcher")]),t._v("\n  TODO\n  "),s("language-switcher"),t._v(" "),s("h3",{staticClass:"mb-3 mt-9"},[t._v("Widgets")]),t._v(" "),t._l(t.widgets,(function(e,i){return[s("div",{key:i,domProps:{innerHTML:t._s(e.render)}})]})),t._v(" "),s("h3",{staticClass:"mb-3 mt-9"},[t._v("Permissions")]),t._v(" "),t._l(t.permissions,(function(e,i){return s("div",{key:i},[s("div",{staticClass:"font-weight-bold",domProps:{textContent:t._s(i)}}),t._v(" "),s("ul",{staticClass:"ml-6"},t._l(e,(function(e,i){return s("li",{key:i,domProps:{innerHTML:t._s(e.name+": <em>"+e.description+"</em>")}})})),0)])}))],2)}),[],!1,null,null,null);e.default=y.exports;c()(y,{VBadge:u.a,VBtn:m.a,VCard:d.a,VCardActions:v.a,VCardText:v.c,VCardTitle:v.d,VCol:_.a,VDataTable:b.a,VDivider:p.a,VIcon:h.a,VRow:f.a,VTooltip:g.a})}}]);
//# sourceMappingURL=66.js.map