(window.webpackJsonp=window.webpackJsonp||[]).push([[31],{310:function(e,t,r){"use strict";r.r(t);var o=r(21),s=r(47),a=r(6);function n(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function i(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var c={computed:{filter:function(){},isFetchingResource:function(){return this.resource.loading},isFinishedFetchingResource:function(){return!this.resource.loading}},data:function(){return{api:o.a,resource:new s.a,search:null}},methods:function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?n(Object(r),!0).forEach((function(t){i(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},Object(a.b)({showDialog:"dialog/show",hideDialog:"dialog/hide",errorDialog:"dialog/error",showSnackbar:"snackbar/show",loadDialog:"dialog/loading"}),{getResource:function(){var e=this;this.resource.loading=!0,axios.get(o.a.show(this.$route.params.id)).then((function(t){e.resource.data=t.data.data,e.resource.data.permissions=_(t.data.data.permissions).groupBy("group").map((function(e,t){return{name:_(t).startCase(),id:t,children:e.map((function(e){return _.merge(e,{id:e.code})}))}})).value()})).finally((function(){e.resource.loading=!1}))},askUserToDestroyResource:function(e){var t=this;this.showDialog({color:"warning",illustration:function(){return Promise.resolve().then(r.bind(null,19))},illustrationWidth:200,illustrationHeight:160,width:"420",title:trans("You are about to move to trash the selected role."),text:[trans("The user will be signed out from the app. Some data related to the account like comments and files will still remain."),trans("Are you sure you want to deactivate and move :name to Trash?",{name:e.data.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:trans("Move to Trash"),color:"warning",callback:function(r){t.loadDialog(!0),t.destroyResource(e)}}}})},destroyResource:function(e){var t=this;e.loading=!0,axios.delete(o.a.destroy(e.data.id)).then((function(e){t.hideDialog(),t.showSnackbar({show:!0,text:trans_choice("Role successfully moved to trash",1)}),t.$router.push({name:"roles.index"})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.loading=!1}))}}),mounted:function(){this.getResource()}},l=r(1),u=r(2),d=r.n(u),h=r(273),v=r(0),m=r(562),f=r(265),p=r(86),g=r(564),w=Object(l.a)(c,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("admin",[r("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),r("page-header",{attrs:{back:{to:{name:"roles.index"},text:e.trans("Roles")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.resource.data.name))]},proxy:!0},{key:"utilities",fn:function(){return[r("can",{attrs:{code:"roles.show"}},[r("router-link",{staticClass:"dt-link text--decoration-none mr-6",attrs:{tag:"a",exact:"",to:{name:"roles.edit"}}},[r("v-icon",{staticClass:"mb-1",attrs:{small:""}},[e._v("mdi-pencil-outline")]),e._v("\n          "+e._s(e.trans("Edit"))+"\n        ")],1)],1),e._v(" "),r("can",{attrs:{code:"roles.destroy"}},[r("a",{staticClass:"dt-link text--decoration-none mr-6",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.askUserToDestroyResource(e.resource)}}},[r("v-icon",{staticClass:"mb-1",attrs:{small:""}},[e._v("mdi-delete-outline")]),e._v("\n          "+e._s(e.trans("Move to Trash"))+"\n        ")],1)])]},proxy:!0}])}),e._v(" "),e.isFetchingResource?[r("skeleton-edit")]:e._e(),e._v(" "),r("v-row",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}]},[r("v-col",{attrs:{cols:"12",md:"7"}},[r("v-card",[r("v-card-text",[r("h2",[e._v(e._s(e.resource.data.name))]),e._v(" "),r("p",[e._v(e._s(e.resource.data.code))]),e._v(" "),r("p",[e._v(e._s(e.resource.data.description))])]),e._v(" "),r("div",{staticClass:"d-flex"},[r("v-divider"),e._v(" "),r("v-icon",{staticClass:"mx-3 mt-n2",attrs:{small:"",color:"muted"}},[e._v("mdi-shield-lock")]),e._v(" "),r("v-divider")],1),e._v(" "),r("v-card-text",[r("h4",{staticClass:"mb-5"},[e._v(e._s(e.trans("Permissions")))]),e._v(" "),r("treeview-field",{model:{value:e.search,callback:function(t){e.search=t},expression:"search"}}),e._v(" "),r("treeview",{attrs:{items:e.resource.data.permissions,search:e.search}})],1)],1)],1)],1)],2)}),[],!1,null,null,null);t.default=w.exports;d()(w,{VCard:h.a,VCardText:v.c,VCol:m.a,VDivider:f.a,VIcon:p.a,VRow:g.a})},47:function(e,t,r){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.permissions=[],this.selected=[],this.data={name:"",alias:"",code:"",description:"",created:"",permissions:[],selected:[]}}}}]);
//# sourceMappingURL=31.js.map