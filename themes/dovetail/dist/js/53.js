(window.webpackJsonp=window.webpackJsonp||[]).push([[53],{317:function(e,t,s){"use strict";s.r(t);var r=s(15),o=s(17),a=s(6);function n(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function i(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var c={data:function(){return{api:r.a,resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Name"),align:"left",value:"name",class:"text-no-wrap"},{text:trans("Manager"),align:"left",value:"manager_id",class:"text-no-wrap"},{text:trans("Date Deleted"),value:"deleted_at",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},computed:{resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},options:function(){return{per_page:this.resources.options.itemsPerPage,page:this.resources.options.page,sort:this.resources.options.sortBy[0]||void 0,order:this.resources.options.sortDesc[0]?"desc":"asc"}},selected:function(){return this.resources.selected.map((function(e){return e.id}))}},methods:function(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?n(Object(s),!0).forEach((function(t){i(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):n(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}({},Object(a.b)({errorDialog:"dialog/error",loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show"}),{changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(e){this.getPaginatedData(this.options)},getPaginatedData:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;t=Object.assign(t||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(this.api.trashed(),{params:t}).then((function(s){e.resources=Object.assign({},e.resources,s.data),e.resources.options=Object.assign(e.resources.options,s.data.meta,t),e.resources.loading=!1,e.$router.push({query:Object.assign({},e.$route.query,t)}).catch((function(e){}))})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})})).finally((function(){e.resources.data.map((function(e){return Object.assign(e,{loading:!1})}))}))},search:_.debounce((function(e){this.resources.search=e.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options),this.resources.searching=!1)}),200),focusSearchBar:function(){this.$refs.tablesearch.focus()},bulkRestoreResources:function(){var e=this,t=this.selected;axios.patch(r.a.restore(null),{id:t}).then((function(t){e.getPaginatedData(null),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Team successfully restored",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},bulkDeleteResources:function(){var e=this,t=this.selected;axios.delete(r.a.delete(null),{data:{id:t}}).then((function(t){e.getPaginatedData(null),e.tabletoolbar.toggleTrash=!1,e.tabletoolbar.toggleBulkEdit=!1,e.hideDialog(),e.showSnackbar({text:trans_choice("Items permanently deleted",e.tabletoolbar.bulkCount)})})).catch((function(t){e.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:t.response.data.message})}))},restoreResource:function(e){var t=this;e.loading=!0,axios.patch(r.a.restore(e.id)).then((function(e){t.getPaginatedData(null),t.showSnackbar({text:trans_choice("Team successfully restored",1)})}))},askUserToPermanentlyDeleteResource:function(e){var t=this;this.showDialog({color:"error",illustration:o.default,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to permanently delete the selected team.",text:["Some data related to the account will still remain.",trans("Are you sure you want to permanently delete?",{name:e.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Permanently delete",color:"error",callback:function(s){t.loadDialog(!0),t.deleteResource(e)}}}})},deleteResource:function(e){var t=this;e.loading=!0,axios.delete(r.a.delete(e.id)).then((function(s){e.active=!1,t.getPaginatedData(null),t.hideDialog(),t.showSnackbar({text:trans_choice("Team successfully deleted",1)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){e.active=!1,e.loading=!1}))}}),mounted:function(){this.changeOptionsFromRouterQueries()},watch:{"resources.search":function(e){this.resources.searching=!0},"resources.selected":function(e){this.tabletoolbar.bulkCount=e.length},"tabletoolbar.toggleBulkEdit":function(e){e||(this.resources.selected=[])}}},l=s(0),u=s(2),d=s.n(u),h=s(105),p=s(260),g=s(594),m=s(91),b=s(4),f=s(585),v=Object(l.a)(c,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",[s("metatag",{attrs:{title:e.trans("Trashed Teams")}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"teams.index"},text:e.trans("Teams")}}}),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:e.tabletoolbar,bulk:"",restorable:"",deletable:""},on:{"update:items":function(t){e.tabletoolbar=t},"update:restore":e.bulkRestoreResources,"update:search":e.search,"update:delete":e.bulkDeleteResources}}),e._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:e.resources.headers,items:e.resources.data,loading:e.resources.loading,"mobile-breakpoint":NaN,options:e.resources.options,"server-items-length":e.resources.meta.total,"show-select":e.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(t){return e.$set(e.resources,"options",t)},e.optionsChanged]},scopedSlots:e._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",e._l(e.resources.options.itemsPerPage,(function(e,t){return s("div",{key:t},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.name",fn:function(t){var r=t.item;return[s("span",{staticClass:"text-no-wrap muted--text",attrs:{title:r.name}},[e._v(e._s(e.trans(r.name)))])]}},{key:"item.manager_id",fn:function(t){var r=t.item;return[s("span",{staticClass:"text-no-wrap muted--text"},[e._v(e._s(e.trans(r.author)))])]}},{key:"item.deleted_at",fn:function(t){var r=t.item;return[s("span",{staticClass:"muted--text",attrs:{title:r.deleted_at}},[e._v(e._s(e.trans(r.deleted)))])]}},{key:"item.action",fn:function(t){var r=t.item;return[s("div",{staticClass:"text-no-wrap"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var o=t.on;return[s("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.restoreResource(r)}}},o),[r.loading?s("v-icon",{staticClass:"mdi-spin",attrs:{small:""}},[e._v("mdi-loading")]):s("v-icon",{attrs:{small:""}},[e._v("mdi-restore")])],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans_choice("Restore this team",1)))])]),e._v(" "),s("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(t){var o=t.on;return[s("v-btn",e._g({attrs:{icon:""},on:{click:function(t){return e.askUserToPermanentlyDeleteResource(r)}}},o),[s("v-icon",{attrs:{small:""}},[e._v("mdi-delete-forever-outline")])],1)]}}],null,!0)},[e._v(" "),s("span",[e._v(e._s(e.trans_choice("Permanently delete this team",1)))])])],1)]}}]),model:{value:e.resources.selected,callback:function(t){e.$set(e.resources,"selected",t)},expression:"resources.selected"}})],1)],1)],1),e._v(" "),e.resourcesIsEmpty?s("div",[s("empty-state",{scopedSlots:e._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"teams.index"}}},[e._v("\n          "+e._s(e.trans("Go back to all Team"))+"\n        ")])]},proxy:!0}],null,!1,145707925)})],1):e._e()],1)}),[],!1,null,null,null);t.default=v.exports;d()(v,{VBtn:h.a,VCard:p.a,VDataTable:g.a,VIcon:m.a,VSlideYReverseTransition:b.i,VSlideYTransition:b.j,VTooltip:f.a})}}]);
//# sourceMappingURL=53.js.map