(window.webpackJsonp=window.webpackJsonp||[]).push([[37],{335:function(t,e,a){"use strict";a.r(e);var s=a(17),r=a(44),o=a(6);function i(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,s)}return a}function n(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}var c={computed:{filter:function(){}},data:function(){return{api:s.a,resource:new r.a,search:null}},methods:function(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?i(Object(a),!0).forEach((function(e){n(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}({},Object(o.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{getResource:function(){var t=this;axios.get(s.a.show(this.$route.params.id)).then((function(e){t.resource.data=e.data.data,t.resource.data.users=t.resource.data.members})).finally((function(){t.resource.loading=!1}))},askUserToDestroyResource:function(t){var e=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(a.bind(null,20))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to move to trash the selected team."),text:[trans("The user will be signed out from the app. Some data related to the account like comments and files will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:t.data.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(a){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(s.a.destroy(t.data.id)).then((function(t){e.hideDialog(),e.showSnackbar({show:!0,text:trans_choice("Team successfully moved to trash",1)}),e.$router.push({name:"teams.index"})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.loading=!1}))},previewMember:function(t){this.resource.preview=t[0]}}),mounted:function(){this.getResource()}},l=a(1),d=a(2),u=a.n(d),m=a(279),v=a(288),p=a(0),h=a(587),f=a(280),_=a(93),b=a(125),w=a(589),g=a(5),y=Object(l.a)(c,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("admin",[a("metatag",{attrs:{title:t.resource.data.name}}),t._v(" "),a("page-header",{scopedSlots:t._u([{key:"back",fn:function(){return[a("div",{staticClass:"mb-2"},[a("can",{attrs:{code:"teams.index"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[a("can",{attrs:{code:"teams.owned"}},[a("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.owned"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),a("span",{domProps:{textContent:t._s(t.trans("My Team"))}})],1)],1)]},proxy:!0}])},[a("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.index"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),a("span",{domProps:{textContent:t._s(t.trans("All Teams"))}})],1)],1)],1)]},proxy:!0},{key:"title",fn:function(){return[t._v(t._s(t.resource.data.name))]},proxy:!0},{key:"utilities",fn:function(){return[a("can",{attrs:{code:"teams.show"}},[a("router-link",{staticClass:"dt-link text--decoration-none mr-6",attrs:{tag:"a",exact:"",to:{name:"teams.edit"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-pencil-outline")]),t._v("\n          "+t._s(t.trans("Edit"))+"\n        ")],1)],1),t._v(" "),a("can",{attrs:{code:"teams.destroy"}},[a("a",{staticClass:"dt-link text--decoration-none mr-6",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.askUserToDestroyResource(t.resource)}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-delete-outline")]),t._v("\n          "+t._s(t.trans("Move to Trash"))+"\n        ")],1)])]},proxy:!0}])}),t._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"12"}},[a("v-card",[a("v-card-text",[t.resource.data.description?[a("h4",{staticClass:"mb-3",domProps:{textContent:t._s(t.trans("Team Detail"))}}),t._v(" "),a("p",{staticClass:"mb-4"},[t._v(t._s(t.resource.data.description))])]:t._e(),t._v(" "),a("h4",{staticClass:"mb-3",domProps:{textContent:t._s(t.trans("Team Manager"))}}),t._v(" "),a("user-account-detail-card",{model:{value:t.resource.data.lead,callback:function(e){t.$set(t.resource.data,"lead",e)},expression:"resource.data.lead"}})],2),t._v(" "),a("div",{staticClass:"d-flex mb-4"},[a("v-divider"),t._v(" "),a("v-icon",{staticClass:"mx-3 mt-n2",attrs:{small:"",color:"muted"}},[t._v("mdi-account-settings")]),t._v(" "),a("v-divider")],1),t._v(" "),a("v-row",[a("v-col",{staticClass:"pt-0",attrs:{cols:"12",md:"6"}},[a("v-card-text",{staticClass:"pt-0"},[a("h4",{staticClass:"mb-5"},[t._v(t._s(t.trans("Team Members")))]),t._v(" "),a("treeview-pagination",{attrs:{items:t.resource.data.users,search:t.search,activatable:!0},on:{active:t.previewMember}})],1)],1),t._v(" "),a("v-divider",{attrs:{vertical:""}}),t._v(" "),a("v-col",{staticClass:"pt-0"},[a("v-scroll-y-transition",{attrs:{mode:"out-in"}},[t.resource.preview?a("div",{key:t.resource.preview.id},[a("v-row",{attrs:{justify:"center"}},[a("v-col",{staticClass:"pt-1",attrs:{cols:"auto"}},[a("div",{staticClass:" d-flex"},[a("v-avatar",{staticClass:"mr-3",attrs:{size:"32",color:"workspace"}},[a("v-img",{attrs:{src:t.resource.preview.avatar}})],1),t._v(" "),a("p",{staticClass:"font-weight-bold",domProps:{textContent:t._s(t.resource.preview.displayname)}})],1),t._v(" "),a("div",{staticClass:"mb-2"},[a("v-icon",{staticClass:"mr-2 muted--text",attrs:{small:""}},[t._v("mdi-at")]),t._v(" "),a("span",{staticClass:"muted--text"},[t._v(t._s(t.resource.preview.username))])],1),t._v(" "),a("div",{staticClass:"muted--text mb-2"},[a("v-icon",{staticClass:"mr-2 muted--text",attrs:{small:""}},[t._v("mdi-email-outline")]),t._v(" "),a("span",{staticClass:"muted--text"},[t._v(t._s(t.resource.preview.email))])],1),t._v(" "),a("div",{staticClass:"muted--text"},[a("v-icon",{staticClass:"mr-2 muted--text",attrs:{small:""}},[t._v("mdi-account-outline")]),t._v("\n                      "+t._s(t.resource.preview.role)+"\n                    ")],1)])],1)],1):a("div",[a("v-row",{attrs:{justify:"center"}},[a("v-col",{attrs:{cols:"auto"}},[a("checklist-icon",{staticClass:"primary--text",staticStyle:{filter:"grayscale(0.8) brightness(150%)"},attrs:{height:"100"}}),t._v(" "),a("p",{staticClass:"muted--text pa-3"},[t._v("\n                      "+t._s(t.trans("Select members from the list to view details"))+"\n                    ")])],1)],1)],1)])],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.default=y.exports;u()(y,{VAvatar:m.a,VCard:v.a,VCardText:p.c,VCol:h.a,VDivider:f.a,VIcon:_.a,VImg:b.a,VRow:w.a,VScrollYTransition:g.f})},44:function(t,e,a){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.users=[],this.managers=[],this.selected=[],this.preview=null,this.data={code:"",created:"",description:"",icon:"",name:"",selected:[],users:[],manager_id:"",lead:{},members:[]}}}}]);
//# sourceMappingURL=37.js.map