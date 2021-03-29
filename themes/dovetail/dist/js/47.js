(window.webpackJsonp=window.webpackJsonp||[]).push([[47],{301:function(e,t,s){"use strict";s.r(t);var o,r=s(25),a=s(17),n=s(6);function i(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,o)}return s}function c(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var l=(c(o={computed:{resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(e){return e.id}))}},data:function(){return{api:r.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Role Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("Code"),align:"left",value:"code",class:"text-no-wrap"},{text:trans("Permissions"),value:"status",class:"text-no-wrap"},{text:trans("Date Deleted"),value:"deleted_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}}},"computed",{resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(e){return e.id}))}}),c(o,"mounted",(function(){this.changeOptionsFromRouterQueries()})),c(o,"methods",function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?i(Object(s),!0).forEach((function(t){c(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(e){this.getPaginatedData(this.options)},getPaginatedData:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;t=Object.assign(t||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.trashed(),{params:t}).then((function(s){e.resources=Object.assign({},e.resources,s.data),e.resources.options=Object.assign(e.resources.options,s.data.meta,t),e.resources.loading=!1,e.$router.push({query:Object.assign({},e.$route.query,t)}).catch((function(e){}))})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){e.resources.data.map((function(e){return Object.assign(e,{loading:!1})}))}))},search:_.debounce((function(e){this.resources.search=e.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkRestoreResources:function(){var e=this,t=this.selected;axios.patch(r.a.restore(null),{id:t}).then((function(t){e.getPaginatedData(null),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Role successfully restored",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},bulkDeleteResources:function(){var e=this,t=this.selected;axios.delete(r.a.delete(null),{data:{id:t}}).then((function(t){e.getPaginatedData(null),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Items permanently deleted",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},restoreResource:function(e){var t=this;e.loading=!0,axios.patch(r.a.restore(e.id)).then((function(e){t.getPaginatedData(null),t.showSnackbar({text:trans_choice("Role successfully restored",1)})}))},askUserToPermanentlyDeleteResource:function(e){var t=this;this.showDialog({color:"error",illustration:a.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to permanently delete the selected role.",text:["The role will be signed out from the app. Some data related to the account like comments and files will still remain.",trans("Are you sure you want to permanently delete?",{name:e.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Permanently delete",color:"error",callback:function(s){t.loadDialog(!0),t.deleteResource(e)}}}})},deleteResource:function(e){var t=this;e.loading=!0,axios.delete(r.a.delete(e.id)).then((function(s){e.active=!1,t.getPaginatedData(null),t.hideDialog(),t.showSnackbar({text:trans_choice("Role successfully deleted",1)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.active=!1,e.loading=!1}))}})),c(o,"mounted",(function(){this.changeOptionsFromRouterQueries()})),c(o,"watch",{"resources.search":function(e){this.resources.searching=!0},"resources.selected":function(e){this.tabletoolbar.bulkCount=e.length},"tabletoolbar.toggleBulkEdit":function(e){e||(this.resources.selected=[])}}),o),u=s(0),d=s(2),h=s.n(d),p=s(104),g=s(262),m=s(596),b=s(91),f=s(5),v=s(587),y=Object(u.a)(l,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",[s("metatag",{attrs:{title:e.trans("Trashed Roles")}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"roles.index"},text:e.trans("Roles")}}}),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:e.tabletoolbar,bulk:"",deletable:"",restorable:""},on:{"update:items":function(t){e.tabletoolbar=t},"update:delete":e.bulkDeleteResources,"update:restore":e.bulkRestoreResources,"update:search":e.search}}),e._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:e.resources.headers,items:e.resources.data,loading:e.resources.loading,"mobile-breakpoint":NaN,options:e.resources.options,"server-items-length":e.resources.meta.total,"show-select":e.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(t){return e.$set(e.resources,"options",t)},e.optionsChanged]},scopedSlots:e._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",e._l(e.resources.options.itemsPerPage,(function(e,t){return s("div",{key:t},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(t){var o=t.item;return[s("span",{staticClass:"muted--text",attrs:{title:o.name}},[e._v(e._s(e.trans(o.name)))])]}},{key:"item.code",fn:function(t){var o=t.item;return[s("span",{staticClass:"muted--text",attrs:{title:o.code}},[e._v(e._s(e.trans(o.code)))])]}},{key:"item.status",fn:function(t){var o=t.item;return[s("span",{staticClass:"muted--text",attrs:{title:o.status}},[e._v(e._s(e.trans(o.status)))])]}},{key:"item.deleted_at",fn:function(t){var o=t.item;return[s("span",{staticClass:"text-no-wrap muted--text",attrs:{title:o.deleted_at}},[e._v(e._s(e.trans(o.deleted)))])]}},{key:"item.action",fn:function(t){var o=t.item;return[s("div",{staticClass:"text-no-wrap"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var r=t.on;return[s("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.restoreResource(o)}}},r),[o.loading?s("v-icon",{staticClass:"mdi-spin",attrs:{small:""}},[e._v("mdi-loading")]):s("v-icon",{attrs:{small:""}},[e._v("mdi-restore")])],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans_choice("Restore this role",1)))])]),e._v(" "),s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var r=t.on;return[s("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.askUserToPermanentlyDeleteResource(o)}}},r),[s("v-icon",{attrs:{small:""}},[e._v("mdi-delete-forever-outline")])],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans_choice("Permanently delete this role",1)))])])],1)]}}]),model:{value:e.resources.selected,callback:function(t){e.$set(e.resources,"selected",t)},expression:"resources.selected"}})],1)],1)],1),e._v(" "),e.resourcesIsEmpty?s("div",[s("empty-state",{scopedSlots:e._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{to:{name:"roles.index"},color:"primary",exact:"",large:""}},[e._v("\n          "+e._s(e.trans("Go back to all roles"))+"\n        ")])]},proxy:!0}],null,!1,2679457862)})],1):e._e()],1)}),[],!1,null,null,null);t.default=y.exports;h()(y,{VBtn:p.a,VCard:g.a,VDataTable:m.a,VIcon:b.a,VSlideYReverseTransition:f.i,VSlideYTransition:f.j,VTooltip:v.a})}}]);
//# sourceMappingURL=47.js.map