(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{257:function(t,e,a){"use strict";a.r(e);var r=a(9);function o(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,r)}return a}function n(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}var s={name:"TestIndex",computed:function(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?o(Object(a),!0).forEach((function(e){n(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):o(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}({},Object(r.c)({toggletoolbar:"toolbar/toolbar"})),data:function(){return{permissions:[],text:"Move to Trash",repeaters:[],widgets:[],staffs:[{title:"Staff",count:"0",icon:"mdi-account-outline",badge:!0,deactivated:"3"},{title:"Department",count:"0",icon:"mdi-door-closed"},{title:"Designation",count:"0",icon:"mdi-folder-account-outline"},{title:"User",count:"10",icon:"mdi-account-multiple-outline"}],courses:{hover:!0,url:"www.google.com",items:[{thumbnail:"//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png",title:"Far far away, behind the word mountains",description:"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.",category:"Taxonomy"}]},headers:[{text:"Account Name",align:"left",value:"name"},{text:"Email",value:"email"},{text:"Role",value:"role",sortable:!1},{text:"Date Created",value:"created"},{text:"Actions",value:"action",sortable:!1,class:"muted--text"}],desserts:[{name:"Princess Ellen Alto",email:"ellen@ssagroup.com",role:"Super Administrator",created:"2 months ago"}]}},methods:{openExport:function(){this.$store.dispatch("export/prompt",{show:!0,items:[{icon:"mdi-file-pdf",color:"error",name:"Portable Documment Format (.pdf)"},{icon:"mdi-google-spreadsheet",color:"green",name:"Microsoft Excel (.xlsx)"},{icon:"mdi-file-document",color:"blue",name:"Open Document Format (.ods)"}]})},changeLocale:function(t){this.$store.dispatch("app/locale",t),localStorage.setItem("app:rtl","ar"==t),this.$vuetify.rtl="ar"==t,this.$router.currentRoute.params.lang!==t&&this.$router.push({name:this.$router.currentRoute.name,params:{lang:t}})},runSnackbar:function(){this.$store.dispatch("snackbar/toggle",{show:!0,text:"This is a sample toast message"})},getPermissions:function(){var t=this;axios.get("/api/v1/users/permissions").then((function(e){t.permissions=e.data}))}},mounted:function(){this.getPermissions()}},i=a(1),c=a(3),l=a.n(c),v=a(471),d=a(77),m=a(241),u=a(2),_=a(466),p=a(478),b=a(234),h=a(63),f=a(467),g=a(472),x=Object(i.a)(s,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("admin",[a("h3",{attrs:{clas:"mb-3"}},[t._v("Glance widget")]),t._v(" "),a("v-row",t._l(t.staffs,(function(t,e){return a("v-col",{key:e,attrs:{md:"3",sm:"6",cols:"12"}},[a("glance",{attrs:{items:t}})],1)})),1),t._v(" "),a("h3",{staticClass:"mt-9 mb-3"},[t._v("Icon Picker")]),t._v(" "),a("v-row",[a("v-col",{attrs:{md:"3",cols:"12"}},[a("icon-picker")],1)],1),t._v(" "),a("v-row",[a("v-col",{attrs:{md:"3",cols:"12"}},[a("find-or-new")],1)],1),t._v(" "),a("h3",{staticClass:"mt-9 mb-3"},[t._v("Toast/Snackbar")]),t._v(" "),a("p",[t._v("Click the button to run a sample toast.")]),t._v(" "),a("v-badge",{attrs:{color:"dark",overlap:"",transition:"fade-transition"},scopedSlots:t._u([{key:"badge",fn:function(){return[a("div",{staticClass:"small",attrs:{attr:"font-size: 10px"}},[t._v("ctrl+b")])]},proxy:!0}]),model:{value:t.$store.getters["app/app"].dark,callback:function(e){t.$set(t.$store.getters["app/app"],"dark",e)},expression:"$store.getters['app/app'].dark"}},[t._v(" "),a("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","b"],expression:"['ctrl', 'b']",modifiers:{once:!0}}],on:{shortkey:t.runSnackbar,click:t.runSnackbar}},[t._v("Run Toast")])],1),t._v(" "),a("snackbar"),t._v(" "),a("h3",{staticClass:"mt-9 mb-3"},[t._v("Export")]),t._v(" "),a("export"),t._v(" "),a("v-btn",{attrs:{color:"primary"},on:{click:t.openExport}},[t._v("\n    "+t._s(t.trans("Open Export"))+"\n  ")]),t._v(" "),a("h3",{staticClass:"mt-9 mb-3"},[t._v("Can and Cannot permission")]),t._v(" "),a("v-card",[a("v-card-text",[a("cannot",{attrs:{code:"unexisting.permission"}},[a("div",[t._v("You are not permitted to 'unexisting.permission'")])]),t._v(" "),a("can",{attrs:{code:"libraries.delete"}},[a("div",[t._v("you can delete library entries")])])],1)],1),t._v(" "),a("h3",{staticClass:"mt-9 mb-3"},[t._v("Grid/List view")]),t._v(" "),t.toggletoolbar.toggleview?[a("v-card",[a("toolbar-menu"),t._v(" "),a("v-divider"),t._v(" "),a("v-data-table",{attrs:{headers:t.headers,items:t.desserts,"sort-by":"calories"},scopedSlots:t._u([{key:"item.action",fn:function(e){e.item;return[a("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[a("v-btn",t._g({attrs:{small:"",icon:""}},r),[a("v-icon",{attrs:{small:""}},[t._v("\n                  mdi-pencil-outline\n                ")])],1)]}}],null,!0)},[t._v(" "),a("span",[t._v(t._s(t.__("Edit")))])]),t._v(" "),a("v-btn",{attrs:{small:"",icon:""}},[a("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[a("v-btn",t._g({attrs:{small:"",icon:""}},r),[a("v-icon",{attrs:{small:""}},[t._v("\n                    mdi-delete-outline\n                  ")])],1)]}}],null,!0)},[t._v(" "),a("span",[t._v(t._s(t.__("Move to Trash")))])])],1)]}}],null,!1,778208270)})],1)]:[a("v-card",[a("toolbar-menu")],1),t._v(" "),a("data-iterator",{attrs:{items:t.courses}})],t._v(" "),a("h3",{staticClass:"mb-3 mt-9"},[t._v("Repeater")]),t._v(" "),a("v-card",{staticClass:"mt-3"},[a("v-card-title",{staticClass:"pb-0"},[t._v("Metadata")]),t._v(" "),a("v-card-text",[a("repeater",{attrs:{autofocus:"",fields:2},model:{value:t.repeaters,callback:function(e){t.repeaters=e},expression:"repeaters"}})],1)],1),t._v(" "),a("h3",{staticClass:"mb-3 mt-9"},[t._v("Translation")]),t._v(" "),a("v-card",{staticClass:"mt-3"},[a("v-card-actions",[a("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale("ja")}}},[t._v("Change locale to "),a("code",[t._v("ja")])]),t._v(" "),a("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale("ar")}}},[t._v("Change locale to "),a("code",[t._v("ar")])]),t._v(" "),a("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale("fil")}}},[t._v("Change locale to "),a("code",[t._v("fil")])]),t._v(" "),a("v-btn",{attrs:{text:""},on:{click:function(e){return t.changeLocale()}}},[t._v("Change locale to "),a("code",[t._v("en")])])],1),t._v(" "),a("v-card-text",[a("div",[t._v("Remember me: "),a("span",{domProps:{innerHTML:t._s(t.$t("Remember me"))}})]),t._v(" "),a("div",[t._v(t._s(t.$t("Don't have account yet?")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Remember me")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Sign in with your %s account")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Sign in")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Sign up")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Name")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Role")))]),t._v(" "),a("div",[t._v(t._s(t.$t("Cancel")))]),t._v(" "),a("div",{directives:[{name:"t",rawName:"v-t",value:"Edit",expression:"'Edit'"}]}),t._v(" "),a("div",{directives:[{name:"t",rawName:"v-t",value:t.text,expression:"text"}]})])],1),t._v(" "),a("h3",{staticClass:"mb-3 mt-9"},[t._v("Language Switcher")]),t._v("\n  TODO\n  "),a("language-switcher"),t._v(" "),a("h3",{staticClass:"mb-3 mt-9"},[t._v("Widgets")]),t._v(" "),t._l(t.widgets,(function(e,r){return[a("div",{key:r,domProps:{innerHTML:t._s(e.render)}})]})),t._v(" "),a("h3",{staticClass:"mb-3 mt-9"},[t._v("Permissions")]),t._v(" "),t._l(t.permissions,(function(e,r){return a("div",{key:r},[a("div",{staticClass:"font-weight-bold",domProps:{textContent:t._s(r)}}),t._v(" "),a("ul",{staticClass:"ml-6"},t._l(e,(function(e,r){return a("li",{key:r,domProps:{innerHTML:t._s(e.name+": <em>"+e.description+"</em>")}})})),0)])}))],2)}),[],!1,null,null,null);e.default=x.exports;l()(x,{VBadge:v.a,VBtn:d.a,VCard:m.a,VCardActions:u.a,VCardText:u.c,VCardTitle:u.d,VCol:_.a,VDataTable:p.a,VDivider:b.a,VIcon:h.a,VRow:f.a,VTooltip:g.a})}}]);
//# sourceMappingURL=18.js.map