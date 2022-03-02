(window.webpackJsonp=window.webpackJsonp||[]).push([[56],{308:function(e,t,s){"use strict";s.r(t);var r={list:function(){return"/api/v1/users/permissions"},refresh:function(){return"/api/v1/users/permissions/refresh"},reset:function(){return"/api/v1/users/permissions/reset"}},i=s(109),n=s(6);function o(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function a(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var l={data:function(){return{api:r,resources:{loading:{reset:!1,refresh:!1},data:[]},search:null}},mounted:function(){this.displayPermissionsList()},methods:function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?o(Object(s),!0).forEach((function(t){a(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):o(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},Object(n.b)({loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{displayPermissionsList:function(){var e=this;axios.get(this.api.list()).then((function(t){e.resources.data=Object.assign([],e.resources.data,t.data)}))},refreshPermissionsList:function(){var e=this;this.resources.loading.refresh=!0,axios.post(this.api.refresh()).then((function(t){e.showSnackbar({text:trans("Permissions successfully refreshed")})})).finally((function(){e.resources.loading.refresh=!1}))},askUserToResetPermission:function(){var e=this;this.showDialog({color:"error",illustration:i.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"WARNING! Read before proceeding.",text:"Resetting the permissions table will break your existing users' established roles. Though the application will try to rebuild the permissions table, there is no guarantee all items will be restored. In fact, any manually added permission will not be recovered. You might need to setup the user roles manually again. Click outside the dialogbox if you don't want to proceed. Are you sure yout want to reset permissions?",buttons:{cancel:{show:!1,color:"link"},action:{text:"Reset Permissions",color:"error",callback:function(t){e.loadDialog(!0),e.resetPermissionsList()}}}})},resetPermissionsList:function(){var e=this;this.resources.loading.reset=!0,axios.post(this.api.reset()).then((function(t){e.showSnackbar({text:trans("Permissions successfully reset")}),e.loadDialog(!1),e.hideDialog()})).finally((function(){e.resources.loading.reset=!1}))}}),computed:{filter:function(){}}},c=s(0),d=s(2),u=s.n(d),f=s(615),h=s(112),p=s(277),m=s(1),v=s(609),b=s(280),g=s(98),_=s(611),y=s(5),w=s(51),k=s(629),x=Object(c.a)(l,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",[s("metatag",{attrs:{title:e.trans("All Permissions")}}),e._v(" "),s("page-header"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"5"}},[s("v-card",{staticClass:"mb-4"},[s("v-card-text",[s("v-text-field",{staticClass:"dt-text-field__search",attrs:{placeholder:e.trans("Search..."),autofocus:"","background-color":"workspace","clear-icon":"mdi-close-circle-outline",clearable:"",filled:"",flat:"","full-width":"","hide-details":"","prepend-inner-icon":"mdi-magnify","single-line":"",solo:""},model:{value:e.search,callback:function(t){e.search=t},expression:"search"}}),e._v(" "),s("v-treeview",{attrs:{filter:e.filter,items:e.resources.data,search:e.search,color:"primary",hoverable:"",ripple:"",transition:""},scopedSlots:e._u([{key:"prepend",fn:function(t){return[t.item.children?s("v-icon",{attrs:{small:"",right:""}},[e._v("\n                mdi-shield-lock\n              ")]):s("v-icon",{staticClass:"ml-n4",attrs:{small:"",left:""}},[e._v("mdi-circle-outline")])]}},{key:"label",fn:function(t){var r=t.item;return[s("div",{staticClass:"pa-3"},[r.children?s("div",{class:r.children?"":"muted--text"},[e._v("\n                  "+e._s(r.name)+"\n                ")]):s("div",[s("div",{staticClass:"mb-2"},[e._v(e._s(r.code))]),e._v(" "),s("div",{staticClass:"text-wrap muted--text body-2"},[e._v("\n                    "+e._s(r.description)+"\n                  ")])])])]}}])})],1)],1)],1),e._v(" "),s("v-col",{staticClass:"offset-md-1",attrs:{cols:"12",md:"6"}},[s("v-card",{attrs:{flat:"",color:"transparent"}},[s("h3",{staticClass:"mb-4"},[e._v(e._s(e.trans("Refresh List")))]),e._v(" "),s("p",{staticClass:"text--text"},[e._v(e._s(e.trans("Refreshing will add and/or update all new permissions specified by the modules you've installed. Outdated permissions or permissions from uninstalled modules will be removed.")))]),e._v(" "),s("v-btn",{attrs:{block:e.$vuetify.breakpoint.smAndDown,disabled:e.resources.loading.refresh,loading:e.resources.loading.refresh,color:"primary",large:""},on:{click:function(t){return e.refreshPermissionsList()}},scopedSlots:e._u([{key:"loader",fn:function(){return[s("span",[s("v-slide-x-transition",[s("v-icon",{staticClass:"mdi-spin",attrs:{small:"",left:"",dark:""}},[e._v("mdi-loading")])],1),e._v("\n              "+e._s(e.trans("Refreshing..."))+"\n            ")],1)]},proxy:!0}])},[s("v-icon",{attrs:{small:"",dark:"",left:""}},[e._v("mdi-refresh")]),e._v("\n          "+e._s(e.trans("Refresh Permission"))+"\n          ")],1)],1),e._v(" "),s("v-divider",{staticClass:"my-8"}),e._v(" "),s("v-card",{attrs:{flat:"",color:"transparent"}},[s("h3",{staticClass:"mb-4"},[e._v(e._s(e.trans("Reset List")))]),e._v(" "),s("p",{staticClass:"text--text"},[e._v(e._s(e.trans("Performing this action will completely remove all permissions data from the database before reinstalling them. Users might lose their previous privileges after this action.")))]),e._v(" "),s("v-alert",{staticClass:"mb-6",attrs:{elevation:"1",border:"top",type:"warning",color:"secondary",prominent:"",text:""}},[e._v("\n          "+e._s(e.trans("You might need to setup the user roles manually again. If you do not want to upset the order of the Cosmos, then for the love of Talos, do not proceed!"))+"\n        ")]),e._v(" "),s("v-btn",{attrs:{block:e.$vuetify.breakpoint.smAndDown,disabled:e.resources.loading.reset,loading:e.resources.loading.reset,color:"error",large:""},on:{click:function(t){return e.askUserToResetPermission()}},scopedSlots:e._u([{key:"loader",fn:function(){return[e._v("\n            "+e._s(e.trans("Resetting..."))+"\n          ")]},proxy:!0}])},[s("v-icon",{attrs:{small:"",dark:"",left:""}},[e._v("mdi-lock-reset")]),e._v("\n          "+e._s(e.trans("Reset Permission"))+"\n          ")],1)],1)],1)],1)],1)}),[],!1,null,null,null);t.default=x.exports;u()(x,{VAlert:f.a,VBtn:h.a,VCard:p.a,VCardText:m.c,VCol:v.a,VDivider:b.a,VIcon:g.a,VRow:_.a,VSlideXTransition:y.i,VTextField:w.a,VTreeview:k.a})}}]);
//# sourceMappingURL=56.js.map