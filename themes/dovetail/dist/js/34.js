(window.webpackJsonp=window.webpackJsonp||[]).push([[34],{328:function(t,e,s){"use strict";s.r(e);var o=s(17),r=s(43),a={computed:{resourcesIsNotEmpty:function(){return!this.resourcesIsEmpty},resourcesIsEmpty:function(){return window._.isEmpty(this.resources.data)&&!this.resources.loading},allReportPresent:function(){return 4==this.resources.data.length}},data:function(){return{resource:new r.a,customer:{},resources:{loading:!0,search:null,options:{page:1,pageCount:0,itemsPerPage:10,sortDesc:[],sortBy:[]},meta:{},modes:{bulkedit:!1},selected:[],headers:[{text:trans("Report Type"),align:"left",value:"key",class:"text-no-wrap"},{text:trans("Generated By"),align:"left",value:"user_id",class:"text-no-wrap"},{text:trans("Month"),align:"center",value:"month",class:"text-no-wrap"},{text:trans("Actions"),align:"center",value:"action",sortable:!1,class:"muted--text text-no-wrap"}],data:[]},tabletoolbar:{bulkCount:0,isSearching:!1,search:null,listGridView:!1,toggleBulkEdit:!1,toggleTrash:!1,verticaldiv:!1}}},methods:{sendToCrm:function(t){var e={Id:this.resource.data.token,FileNo:this.resource.data.refnum,OverallScore:t.value["overall:score"],FileContentBase64:t.fileContentBase64,"Lessons Learnt":t.value["overall:comment"]};axios.post(o.a.crm.save(),e).then((function(t){}))},previewOverallReport:function(){this.$router.push({name:"teams.overall",query:{type:"overall",from:this.$route.fullPath,user_id:this.$route.params.user},params:{id:this.$route.params.customer}})},changeOptionsFromRouterQueries:function(){this.options.per_page=this.$route.query.per_page,this.options.page=parseInt(this.$route.query.page),this.options.search=this.$route.query.search,this.resources.search=this.options.search,this.tabletoolbar.search=this.options.search},optionsChanged:function(t){this.getPaginatedData(this.options)},getResource:function(){var t=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.reports.users.list(this.$route.params.customer,this.$route.params.user)).then((function(e){t.resource.data=e.data.data})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))},getCustomerData:function(){var t=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(o.a.customers.show(this.$route.params.customer)).then((function(e){t.customer=e.data.data})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))},getPaginatedData:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;arguments.length>1&&void 0!==arguments[1]&&arguments[1];e=Object.assign(e||this.$route.query,{search:this.resources.search}),this.resources.loading=!0,axios.get(o.a.reports.users.list(this.$route.params.customer,this.$route.params.user),{params:e}).then((function(s){t.resources=Object.assign({},t.resources,s.data),t.resources.options=Object.assign(t.resources.options,s.data.meta,e),t.resources.loading=!1,t.$router.push({query:Object.assign({},t.$route.query,e)}).catch((function(t){}))})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})})).finally((function(){t.resources.data.map((function(t){return Object.assign(t,{loading:!1})}))}))},askUserToDestroyReport:function(t){var e=this;this.showDialog({color:"error",illustration:man,illustrationWidth:200,illustrationHeight:160,width:"420",title:"You are about to move to trash the selected company.",text:["Some data related to company will still remain.",trans("Are you sure you want to move :name to Trash?",{name:t.name})],buttons:{cancel:{show:!0,color:"link"},action:{text:"Move to Trash",color:"error",callback:function(s){e.loadDialog(!0),e.destroyResource(t)}}}})},goToShowPage:function(t){return{name:"teams.report",query:{from:this.$route.fullPath},params:{id:t.customer_id,report:t.id}}},goToSurveyPage:function(t){return{name:"companies.response",query:{month:t.remarks,from:this.$route.fullPath},params:{id:t.customer_id,taxonomy:t.value["current:index"].taxonomy.id||null,survey:t.value["survey:id"]}}},load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=t},search:_.debounce((function(t){this.resources.search=t.srcElement.value||"",this.tabletoolbar.isSearching=!1,this.resources.searching&&(this.getPaginatedData(this.options,"search"),this.resources.searching=!1)}),200),bulkTrashResource:function(){var t=this,e=this.selected;axios.delete(o.a.reports.destroy(null),{data:{id:e}}).then((function(e){t.getPaginatedData(null,"bulkTrashResource"),t.tabletoolbar.toggleTrash=!1,t.tabletoolbar.toggleBulkEdit=!1,t.hideDialog(),t.showSnackbar({text:trans_choice("Company successfully moved to trash",t.tabletoolbar.bulkCount)})})).catch((function(e){t.errorDialog({width:400,buttons:{cancel:{show:!1}},title:trans("Whoops! An error occured"),text:e.response.data.message})}))}},mounted:function(){this.getResource(),this.getPaginatedData(),this.getCustomerData()},watch:{"resources.search":function(t){this.resources.searching=!0},"resources.selected":function(t){this.tabletoolbar.bulkCount=t.length},"tabletoolbar.toggleBulkEdit":function(t){t||(this.resources.selected=[])}}},n=s(1),i=s(2),c=s.n(i),u=s(105),l=s(278),d=s(595),h=s(90),m=s(5),p=s(585),v=Object(n.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",[s("metatag",{attrs:{title:t.customer.name}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"back",fn:function(){return[s("div",{staticClass:"mb-2"},[s("can",{attrs:{code:"teams.owned"},scopedSlots:t._u([{key:"unpermitted",fn:function(){return[s("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.owned"}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),s("span",{domProps:{textContent:t._s(t.trans("My Team"))}})],1)]},proxy:!0}])},[s("router-link",{staticClass:"text--decoration-none body-1 dt-link",attrs:{tag:"a",exact:"",to:{name:"teams.owned"}}},[s("v-icon",{staticClass:"mb-1",attrs:{small:""}},[t._v("mdi mdi-chevron-left")]),t._v(" "),s("span",{domProps:{textContent:t._s(t.trans("My Team"))}})],1)],1)],1)]},proxy:!0},{key:"title",fn:function(){return[t._v(t._s(t.customer.name))]},proxy:!0},{key:"utilities",fn:function(){return[s("h4",{staticClass:"muted--text",domProps:{textContent:t._s(t.trans("Reports List"))}})]},proxy:!0},{key:"action",fn:function(){return[t.allReportPresent?s("v-btn",{attrs:{block:t.$vuetify.breakpoint.smAndDown,color:"primary",exact:"",large:""},on:{click:t.previewOverallReport}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-chart-outline")]),t._v("\n        "+t._s(t.__("Overall Report"))+"\n      ")],1):t._e()]},proxy:!0}])}),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.resourcesIsNotEmpty,expression:"resourcesIsNotEmpty"}]},[s("v-card",[s("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search},scopedSlots:t._u([{key:"filter",fn:function(){return[s("monthly-picker")]},proxy:!0}])}),t._v(" "),s("v-slide-y-reverse-transition",{attrs:{mode:"out-in"}},[s("v-data-table",{attrs:{headers:t.resources.headers,items:t.resources.data,loading:t.resources.loading,"mobile-breakpoint":NaN,options:t.resources.options,"server-items-length":t.resources.meta.total,"show-select":t.tabletoolbar.toggleBulkEdit,color:"primary","item-key":"id"},on:{"update:options":[function(e){return t.$set(t.resources,"options",e)},t.optionsChanged]},scopedSlots:t._u([{key:"progress",fn:function(){return[s("span")]},proxy:!0},{key:"loading",fn:function(){return[s("v-slide-y-transition",{attrs:{mode:"out-in"}},[s("div",t._l(t.resources.options.itemsPerPage,(function(t,e){return s("div",{key:e},[s("skeleton-table")],1)})),0)])]},proxy:!0},{key:"item.key",fn:function(e){var o=e.item;return[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("span",t._g({staticClass:"mt-1"},r),[s("router-link",{staticClass:"text-no-wrap text--decoration-none",attrs:{tag:"a",exact:"",to:t.goToShowPage(o)},domProps:{textContent:t._s(o.key)}})],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View Preview Report")))])])]}},{key:"item.created_at",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",attrs:{title:o.created_at}},[t._v(t._s(t.trans(o.created)))])]}},{key:"item.user_id",fn:function(e){var o=e.item;return[s("span",{staticClass:"text-no-wrap",domProps:{textContent:t._s(o.author)}})]}},{key:"item.action",fn:function(e){var o=e.item;return[s("div",{staticClass:"text-no-wrap"},[s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("v-btn",t._g({attrs:{icon:""},on:{click:function(e){return t.sendToCrm(o)}}},r),[s("v-icon",{attrs:{small:""}},[t._v("mdi-send")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("Send Report to CRM")))])]),t._v(" "),s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var r=e.on;return[s("v-btn",t._g({attrs:{to:t.goToSurveyPage(o),icon:""}},r),[s("v-icon",{attrs:{small:""}},[t._v("mdi-file-table")])],1)]}}],null,!0)},[t._v(" "),s("span",[t._v(t._s(t.trans("View Survey")))])])],1)]}}]),model:{value:t.resources.selected,callback:function(e){t.$set(t.resources,"selected",e)},expression:"resources.selected"}})],1)],1)],1),t._v(" "),t.resourcesIsEmpty?s("div",[s("toolbar-menu",{attrs:{items:t.tabletoolbar},on:{"update:items":function(e){t.tabletoolbar=e},"update:search":t.search},scopedSlots:t._u([{key:"filter",fn:function(){return[s("monthly-picker")]},proxy:!0}],null,!1,59150502)}),t._v(" "),s("empty-state",{scopedSlots:t._u([{key:"actions",fn:function(){return[s("v-btn",{attrs:{large:"",color:"primary",exact:"",to:{name:"companies.owned"}}},[s("v-icon",{attrs:{small:"",left:""}},[t._v("mdi-file-document-box-search-outline")]),t._v("\n          "+t._s(t.trans("Back to My Companies"))+"\n        ")],1)]},proxy:!0}],null,!1,372801965)})],1):t._e()],1)}),[],!1,null,null,null);e.default=v.exports;c()(v,{VBtn:u.a,VCard:l.a,VDataTable:d.a,VIcon:h.a,VSlideYReverseTransition:m.i,VSlideYTransition:m.j,VTooltip:p.a})},43:function(t,e,s){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.users=[],this.managers=[],this.selected=[],this.preview=null,this.data={code:"",created:"",description:"",icon:"",name:"",selected:[],users:[],manager_id:"",lead:{},members:[]}}}}]);
//# sourceMappingURL=34.js.map