(window.webpackJsonp=window.webpackJsonp||[]).push([[34],{28:function(t,e,a){"use strict";e.a={list:function(){return"/api/v1/users"},store:function(){return"/api/v1/users"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/restore/".concat(t)},trashed:function(){return"/api/v1/users/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(t)}}},321:function(t,e,a){"use strict";a.r(e);var n=a(28),r=a(10),o=a(6);function s(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function i(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}var c={data:function(){return{api:n.a,auth:r.default.getUser(),resource:{loading:!1,data:{displayname:"",username:""}}}},computed:{backgroundDetailsIsEmpty:function(){return window._.isEmpty(this.resource.data["details:common"])},backgroundDetailsIsNotEmpty:function(){return!this.backgroundDetailsIsEmpty},additionalBackgroundDetailsIsEmpty:function(){return window._.isEmpty(this.resource.data["details:others"])},additionalBackgroundDetailsIsNotEmpty:function(){return!this.additionalBackgroundDetailsIsEmpty}},methods:function(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?s(Object(a),!0).forEach((function(e){i(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):s(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}({},Object(o.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{getResource:function(){var t=this;axios.get(n.a.show(this.$route.params.id)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.resource.loading=!1}))},askUserToDestroyResource:function(t){var e=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(a.bind(null,18))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to deactivate the selected user."),text:[trans("The user will be signed out from the app. Some data related to the account like comments and files will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:t.data.displayname})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(a){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(n.a.destroy(t.data.id)).then((function(t){e.hideDialog(),e.showSnackbar({show:!0,text:trans_choice("User successfully deactivated",1)}),e.$router.push({name:"users.index"})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.loading=!1}))}}),mounted:function(){this.getResource()}},l=a(0),u=a(2),d=a.n(u),p=a(265),v=a(1),f=a(257),m=a(88),h=a(343),g=Object(l.a)(c,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("admin",[a("metatag",{attrs:{title:t.resource.data.displayname}}),t._v(" "),a("page-header",{attrs:{back:{to:{name:"users.index"},text:t.trans("Users")}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v(t._s(t.resource.data.displayname))]},proxy:!0},{key:"utilities",fn:function(){return[a("can",{attrs:{code:"users.show"}},[a("router-link",{staticClass:"dt-link text--decoration-none mr-6",attrs:{tag:"a",exact:"",to:{name:"users.edit"}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-pencil-outline")]),t._v("\n          "+t._s(t.trans("Edit"))+"\n        ")],1)],1),t._v(" "),a("can",{attrs:{code:"users.destroy"}},[a("a",{staticClass:"dt-link text--decoration-none mr-6",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.askUserToDestroyResource(t.resource)}}},[a("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi-delete-outline")]),t._v("\n          "+t._s(t.trans("Deactivate"))+"\n        ")],1)])]},proxy:!0}])}),t._v(" "),a("v-card",[a("v-card-text",[a("user-account-detail-card",{model:{value:t.resource.data,callback:function(e){t.$set(t.resource,"data",e)},expression:"resource.data"}})],1),t._v(" "),a("v-divider"),t._v(" "),a("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[a("thead",[a("tr",[a("th",{staticClass:"text-left",attrs:{colspan:"100%"},domProps:{textContent:t._s(t.trans("Background Details"))}})])]),t._v(" "),a("tbody",{directives:[{name:"show",rawName:"v-show",value:t.backgroundDetailsIsNotEmpty,expression:"backgroundDetailsIsNotEmpty"}]},t._l(t.resource.data["details:common"],(function(e,n){return a("tr",[a("td",{staticClass:"font-weight-bold"},["null"==e.icon?a("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-square-edit-outline")]):a("v-icon",{attrs:{small:"",left:""},domProps:{textContent:t._s(e.icon)}}),t._v(" "),a("span",{domProps:{textContent:t._s(t.trans(e.key))}})],1),t._v(" "),a("td",{domProps:{textContent:t._s(t.trans(e.text))}})])})),0),t._v(" "),t.backgroundDetailsIsEmpty?a("tbody",[a("tr",[a("td",{staticClass:"muted--text font-italic"},[t._v(t._s(t.trans("No resource found")))])])]):t._e()]},proxy:!0}])}),t._v(" "),a("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[a("thead",[a("tr",[a("th",{staticClass:"text-left",attrs:{colspan:"100%"},domProps:{textContent:t._s(t.trans("Additional Background Details"))}})])]),t._v(" "),a("tbody",{directives:[{name:"show",rawName:"v-show",value:t.additionalBackgroundDetailsIsNotEmpty,expression:"additionalBackgroundDetailsIsNotEmpty"}]},t._l(t.resource.data["details:others"],(function(e,n){return a("tr",[a("td",{staticClass:"font-weight-bold"},[a("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-square-edit-outline")]),t._v(" "),a("span",{domProps:{textContent:t._s(t.trans(e.key))}})],1),t._v(" "),a("td",{domProps:{textContent:t._s(t.trans(e.text))}})])})),0),t._v(" "),t.additionalBackgroundDetailsIsEmpty?a("tbody",[a("tr",[a("td",{staticClass:"muted--text font-italic"},[t._v(t._s(t.trans("No resource found")))])])]):t._e()]},proxy:!0}])})],1)],1)}),[],!1,null,null,null);e.default=g.exports;d()(g,{VCard:p.a,VCardText:v.c,VDivider:f.a,VIcon:m.a,VSimpleTable:h.a})}}]);
//# sourceMappingURL=34.js.map