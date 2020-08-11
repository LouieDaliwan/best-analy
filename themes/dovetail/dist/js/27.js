(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{26:function(t,e,s){"use strict";e.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(t)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},301:function(t,e,s){"use strict";s.r(e);var r=s(26),o=s(17),n=s(6);function a(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function i(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var c={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(t){return t.id}))}},data:function(){return{api:r.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("Weightage"),align:"center",value:"metadata[weightage]",class:"text-no-wrap"},{text:trans("Description"),align:"left",value:"description",class:"text-no-wrap"},{text:trans("Last Modified"),value:"updated_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},mounted:function(){this.changeOptionsFromRouterQueries()},methods:function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?a(Object(s),!0).forEach((function(e){i(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):a(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({},Object(n.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.list(),{params:e}).then((function(s){t.resources=Object.assign({},t.resources,s.data),t.resources.options=Object.assign(t.resources.options,s.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(r.a.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Index successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))},askUserToDestroyIndex:function(t){var e=this;this.showDialog({color:"warning",illustration:o.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected index.",text:["Some data related to index will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"warning",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},destroyResource:function(t){var e=this;t.loading=!0,axios.delete(r.a.destroy(t.id)).then((function(s){t.active=!1,e.getPaginatedData(null,"destroyResource"),e.showSnackbar({text:trans_choice("Index successfully moved to trash",1)}),e.hideDialog()})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){t.active=!1,t.loading=!1}))}}),watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},l=s(0),u=s(2),d=s.n(u),h=s(261),p=s(104),g=s(259),v=s(592),f=s(90),m=s(122),b=s(4),y=s(583),w=Object(l.a)(c,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.trans("All Index")}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[s("router-link",{staticClass:"dt-link text--decoration-none mr-4",attrs:{tag:"a",exact:"",to:{name:"indices.trashed"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-delete-outline")]),t._v("\n        "+t._s(t.trans("Trashed Index"))+"\n      ")],1)]},proxy:!0},{key:"action",fn:function(){return[s("can",{attrs:{code:"indices.create"}},[s("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,large:"",color:"primary",exact:"",to:{name:"indices.create"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-credit-card-plus-outline")]),t._v("\n          "+t._s(t.trans("Add Index"))+"\n        ")],1)],1)]},proxy:!0}])}),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:t.tabletoolbar,bulk:"",downloadable:"",trashable:""},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search,"update:trash":t.bulkTrashResource}}),t._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return s("div",{key:e},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(e){var r=e.item;return[s("div",{staticClass:"d-flex align-center"},[s("v-avatar",{staticClass:"mr-6",attrs:{size:"32",tile:""}},[s("v-img",{attrs:{src:r.icon}})],1),t._v(" "),s("span",{staticClass:"text-no-wrap"},[t._v(t._s(t.trans(r.name)))])],1)]}},{key:"item.description",fn:function(e){var r=e.item;return[s("v-tooltip",{attrs:{bottom:"",transition:"scroll-y-transition","max-width":"300"},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("span",t._g({staticClass:"text--ellipsis-1"},o),[t._v(t._s(t.trans(r.description)))])]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans(r.description)))])])]}},{key:"item.updated_at",fn:function(e){var r=e.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:r.updated_at}},[t._v(t._s(t.trans(r.modified)))])]}},{key:"item.action",fn:function(e){var r=e.item;return[s("div",{staticClass:"text-no-wrap"},[s("can",{attrs:{code:"indices.edit"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("v-btn",t._g({attrs:{to:{name:"indices.edit",params:{id:r.id}},icon:""}},o),[s("v-icon",{attrs:{small:""}},[t._v("mdi-pencil-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Edit this index")))])])],1),t._v(" "),s("can",{attrs:{code:"indices.destroy"}},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[s("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.askUserToDestroyIndex(r)}}},o),[s("v-icon",{attrs:{small:""}},[t._v("mdi-delete-outline")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Move to trash")))])])],1)],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?s("div",[s("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search}}),t._v(" "),s("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"indices.create"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-account-plus-outline")]),t._v("\n          "+t._s(t.trans("Add Index"))+"\n        ")],1)]},proxy:!0}],null,!1,2232658387)})],1):t._e()],1)}),[],!1,null,null,null);e.default=w.exports;d()(w,{VAvatar:h.a,VBtn:p.a,VCard:g.a,VDataTable:v.a,VIcon:f.a,VImg:m.a,VSlideYReverseTransition:b.i,VSlideYTransition:b.j,VTooltip:y.a})}}]);
//# sourceMappingURL=27.js.map