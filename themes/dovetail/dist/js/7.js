(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{13:function(e,a,t){"use strict";a.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(e)},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(e){return"/api/v1/surveys/".concat(e,"/submit")},show:function(e){return"/api/v1/surveys/".concat(e)}},crm:{search:function(e){return"/api/v1/crm/customers/search/".concat(e)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"}},reports:{list:function(e){return"/api/v1/customers/".concat(e,"/reports")},generate:function(e){return"/api/v1/reports/".concat(e,"/generate")},download:function(e){return"/api/v1/reports/".concat(e,"/download")},delete:function(e){return"/api/v1/reports/".concat(e)}}}},280:function(e,a,t){"use strict";t.r(a);var r=t(13),s=t(66),n=t(6);function o(e,a){var t=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);a&&(r=r.filter((function(a){return Object.getOwnPropertyDescriptor(e,a).enumerable}))),t.push.apply(t,r)}return t}function i(e){for(var a=1;a<arguments.length;a++){var t=null!=arguments[a]?arguments[a]:{};a%2?o(Object(t),!0).forEach((function(a){d(e,a,t[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):o(Object(t)).forEach((function(a){Object.defineProperty(e,a,Object.getOwnPropertyDescriptor(t,a))}))}return e}function d(e,a,t){return a in e?Object.defineProperty(e,a,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[a]=t,e}var c={beforeRouteLeave:function(e,a,t){this.resource.isPrestine?t():this.askUserBeforeNavigatingAway(t)},computed:i({},Object(n.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine}}),data:function(e){return{resource:new s.a,tabsModel:1}},methods:i({},Object(n.b)({hideSidebar:"sidebar/hide",hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var a=this;this.showDialog({illustration:function(){return Promise.resolve().then(t.bind(null,529))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){a.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),a.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(t.bind(null,529))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.hideDialog(),e.$router.replace({name:"companies.owned"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},formIsChanged:function(){this.resource.isPrestine=!1},parseResourceData:function(e){_.clone(e);var a=new FormData(this.$refs["updateform-form"].$el);return a.append("_method","put"),a},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var a=this;this.load(),e.preventDefault(),axios.post(r.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){a.resource.isPrestine=!0,a.showSuccessbox({text:trans("Company updated successfully"),buttons:{show:{code:"customers.show",to:{name:"companies.show",params:{id:a.resource.data.id}},icon:"mdi-briefcase-search-outline",text:trans("View Details")},create:{code:"crm.search",to:{name:"companies.find"},icon:"mdi-briefcase-plus-outline",text:trans("Find Another Company")}}})})).catch((function(e){if(e.response&&e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);a.$refs.updateform.setErrors(e.response.data.errors),a.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){a.load(!1)}))},getResource:function(){var e=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(r.a.show(this.$route.params.id)).then((function(a){e.resource.data=a.data.data,e.resource.metadata=_.merge({},e.resource.metadata,e.resource.data.metadata),e.resource.data.financials=e.resource.metadata})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))},activateTab:function(){this.tabsModel=parseInt(this.$route.query.tab||0)}}),mounted:function(){this.hideSidebar(),this.getResource(),this.activateTab()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},l=t(0),u=t(2),Y=t.n(u),m=t(568),h=t(100),f=t(263),p=t(1),v=t(563),g=t(564),b=t(4),y=t(577),w=t(86),x=t(565),C=t(340),k=t(566),P=t(73),T=t(42),O=t(55),S=t(3),D=t(8);var E=Object(D.a)(P.a,Object(T.a)("windowGroup","v-window-item","v-window")).extend().extend().extend({name:"v-window-item",directives:{Touch:O.a},props:{disabled:Boolean,reverseTransition:{type:[Boolean,String],default:void 0},transition:{type:[Boolean,String],default:void 0},value:{required:!1}},data:()=>({isActive:!1,inTransition:!1}),computed:{classes(){return this.groupClasses},computedTransition(){return this.windowGroup.internalReverse?void 0!==this.reverseTransition?this.reverseTransition||"":this.windowGroup.computedTransition:void 0!==this.transition?this.transition||"":this.windowGroup.computedTransition}},methods:{genDefaultSlot(){return this.$slots.default},genWindowItem(){return this.$createElement("div",{staticClass:"v-window-item",class:this.classes,directives:[{name:"show",value:this.isActive}],on:this.$listeners},this.showLazyContent(this.genDefaultSlot()))},onAfterTransition(){this.inTransition&&(this.inTransition=!1,this.windowGroup.transitionCount>0&&(this.windowGroup.transitionCount--,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=void 0)))},onBeforeTransition(){this.inTransition||(this.inTransition=!0,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=Object(S.h)(this.windowGroup.$el.clientHeight)),this.windowGroup.transitionCount++)},onTransitionCancelled(){this.onAfterTransition()},onEnter(e){this.inTransition&&this.$nextTick(()=>{this.computedTransition&&this.inTransition&&(this.windowGroup.transitionHeight=Object(S.h)(e.clientHeight))})}},render(e){return e("transition",{props:{name:this.computedTransition},on:{beforeEnter:this.onBeforeTransition,afterEnter:this.onAfterTransition,enterCancelled:this.onTransitionCancelled,beforeLeave:this.onBeforeTransition,afterLeave:this.onAfterTransition,leaveCancelled:this.onTransitionCancelled,enter:this.onEnter}},[this.genWindowItem()])}}),I=E.extend({name:"v-tab-item",props:{id:String},methods:{genWindowItem(){const e=E.options.methods.genWindowItem.call(this);return e.data.domProps=e.data.domProps||{},e.data.domProps.id=this.id||this.value,e}}}),L=t(46),F=t(20),A=Object(l.a)(c,(function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[t("v-container",{staticClass:"py-0 px-0"},[t("v-row",{attrs:{justify:"space-between",align:"center"}},[t("v-fade-transition",[e.isNotFormPrestine?t("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[t("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),t("v-spacer"),e._v(" "),t("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[t("div",{staticClass:"d-flex justify-end"},[t("v-spacer"),e._v(" "),t("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),t("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(a){e.shortkeyCtrlIsPressed=a},expression:"shortkeyCtrlIsPressed"}},[t("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(a){return a.preventDefault(),e.submitForm(a)},shortkey:e.submitForm}},[t("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Update"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[t("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),t("back-to-top"),e._v(" "),e._v(" "),t("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(a){var r=a.handleSubmit;a.errors,a.invalid,a.passed;return[t("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false"},on:{change:e.formIsChanged,submit:function(a){a.preventDefault(),r(e.submit(a))}}},[t("button",{ref:"submit-button",staticClass:"d-none",attrs:{disabled:e.isFormDisabled,type:"submit"}}),e._v(" "),t("page-header",{attrs:{back:{to:{name:"companies.owned"},text:e.trans("Companies")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("Edit :name",{name:e.resource.data.name+"'s Input Data"}))+"\n        ")]},proxy:!0}],null,!0)}),e._v(" "),t("alertbox"),e._v(" "),t("input",{attrs:{type:"hidden",name:"name"},domProps:{value:e.resource.data.name}}),e._v(" "),t("input",{attrs:{type:"hidden",name:"code"},domProps:{value:e.resource.data.code}}),e._v(" "),t("input",{attrs:{type:"hidden",name:"refnum"},domProps:{value:e.resource.data.refnum}}),e._v(" "),t("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.resource.data.user_id}}),e._v(" "),t("v-row",[t("v-col",{attrs:{cols:"12",md:"12"}},[t("v-card",{attrs:{flat:"",color:"transparent"}},[t("tabs",{scopedSlots:e._u([{key:"item",fn:function(){return[t("v-tab-item",{key:"tab-0"},[t("v-card",[t("v-card-text",[t("validation-provider",{attrs:{vid:"metadata[email]",name:e.trans("Email"),rules:"email"},scopedSlots:e._u([{key:"default",fn:function(a){var r=a.errors;return[t("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Company Email"),autofocus:"",name:"metadata[email]",outlined:"","prepend-inner-icon":"mdi-email-outline"},model:{value:e.resource.data.metadata.email,callback:function(a){e.$set(e.resource.data.metadata,"email",a)},expression:"resource.data.metadata['email']"}})]}}],null,!0)}),e._v(" "),t("validation-provider",{attrs:{vid:"metadata[address]",name:e.trans("Company Address")},scopedSlots:e._u([{key:"default",fn:function(a){var r=a.errors;return[t("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Company Address"),autofocus:"",name:"metadata[address]",outlined:"","prepend-inner-icon":"mdi-map-marker"},model:{value:e.resource.data.metadata.address,callback:function(a){e.$set(e.resource.data.metadata,"address",a)},expression:"resource.data.metadata['address']"}})]}}],null,!0)}),e._v(" "),t("validation-provider",{attrs:{vid:"metadata[website]",name:e.trans("Website")},scopedSlots:e._u([{key:"default",fn:function(a){var r=a.errors;return[t("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Website"),autofocus:"",name:"metadata[website]",outlined:"","prepend-inner-icon":"mdi-earth"},model:{value:e.resource.data.metadata.website,callback:function(a){e.$set(e.resource.data.metadata,"website",a)},expression:"resource.data.metadata['website']"}})]}}],null,!0)}),e._v(" "),t("validation-provider",{attrs:{vid:"metadata[staffstrength]",name:e.trans("Staff Strength")},scopedSlots:e._u([{key:"default",fn:function(a){var r=a.errors;return[t("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Staff Strength"),autofocus:"",name:"metadata[staffstrength]",outlined:"",type:"number"},model:{value:e.resource.data.metadata.staffstrength,callback:function(a){e.$set(e.resource.data.metadata,"staffstrength",a)},expression:"resource.data.metadata['staffstrength']"}})]}}],null,!0)}),e._v(" "),t("validation-provider",{attrs:{vid:"metadata[industry]",name:e.trans("Industry")},scopedSlots:e._u([{key:"default",fn:function(a){var r=a.errors;return[t("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Industry"),name:"metadata[industry]",outlined:""},model:{value:e.resource.data.metadata.industry,callback:function(a){e.$set(e.resource.data.metadata,"industry",a)},expression:"resource.data.metadata['industry']"}})]}}],null,!0)})],1)],1)],1),e._v(" "),t("v-tab-item",{key:"tab-1"},[t("v-card",{staticClass:"mb-3"},[t("v-card-title",[e._v(e._s(e.trans("Income Statement")))]),e._v(" "),t("v-card-text",{staticStyle:{"overflow-x":"auto"}},[t("v-simple-table",{staticClass:"transparent mb-3",staticStyle:{"min-width":"800px"}},[t("tbody",[t("tr",{staticStyle:{"vertical-align":"top"}},[t("td",{attrs:{colspan:"100%"}}),e._v(" "),t("td",[t("strong",[e._v(e._s(e.trans("Period 1")))])]),e._v(" "),t("td",[t("strong",[e._v(e._s(e.trans("Period 2")))])]),e._v(" "),t("td",[t("strong",[e._v(e._s(e.trans("Period 3"))),t("br"),e._v(e._s(e.trans("(most recent)")))])])]),e._v(" "),e._l(e.resource.metadata.years,(function(a,r){return t("tr",{key:r},[t("td",{attrs:{colspan:a.length?1:"100%"}},[t("div",{staticClass:"year-label",domProps:{innerHTML:e._s(e.trans(r))}})]),e._v(" "),e._l(a,(function(a,s){return t("td",{key:s},[t("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[years]["+r+"]["+s+"]",label:e.trans(s),dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials.years[r][s],callback:function(a){e.$set(e.resource.data.financials.years[r],s,a)},expression:"resource.data.financials['years'][i][k]"}})],1)}))],2)})),e._v(" "),e._l(e.resource.metadata["fps-qa1"],(function(a,r){return t("tr",{key:r},[t("td",{attrs:{colspan:a.length?1:"100%"},domProps:{innerHTML:e._s(e.trans(r))}}),e._v(" "),e._l(a,(function(a,s){return t("td",{key:s},[t("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[fps-qa1]["+r+"]["+s+"]",dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials["fps-qa1"][r][s],callback:function(a){e.$set(e.resource.data.financials["fps-qa1"][r],s,a)},expression:"resource.data.financials['fps-qa1'][i][k]"}})],1)}))],2)}))],2)])],1)],1),e._v(" "),t("v-card",{staticClass:"mb-3"},[t("v-card-title",[e._v(e._s(e.trans("Balance Sheet")))]),e._v(" "),t("v-card-text",{staticStyle:{"overflow-x":"auto"}},[t("v-simple-table",{staticClass:"transparent mb-3",staticStyle:{"min-width":"800px"}},[t("tbody",[t("tr",{staticStyle:{"vertical-align":"top"}},[t("td",{attrs:{colspan:"100%"}}),e._v(" "),t("td",[t("strong",[e._v(e._s(e.trans("Period 1")))])]),e._v(" "),t("td",[t("strong",[e._v(e._s(e.trans("Period 2")))])]),e._v(" "),t("td",[t("strong",[e._v(e._s(e.trans("Period 3"))),t("br"),e._v(e._s(e.trans("(most recent)")))])])]),e._v(" "),e._l(e.resource.metadata.years,(function(a,r){return t("tr",{key:r},[t("td",{attrs:{colspan:a.length?1:"100%"}},[t("div",{staticClass:"year-label",domProps:{innerHTML:e._s(e.trans(r))}})]),e._v(" "),e._l(a,(function(a,s){return t("td",{key:s},[t("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[years]["+r+"]["+s+"]",label:e.trans(s),dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials.years[r][s],callback:function(a){e.$set(e.resource.data.financials.years[r],s,a)},expression:"resource.data.financials['years'][i][k]"}})],1)}))],2)})),e._v(" "),e._l(e.resource.metadata["balance-sheet"],(function(a,r){return t("tr",{key:r},[t("td",{attrs:{colspan:a.length?1:"100%"},domProps:{innerHTML:e._s(e.trans(r))}}),e._v(" "),e._l(a,(function(a,s){return t("td",{key:s},[t("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[balance-sheet]["+r+"]["+s+"]",dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials["balance-sheet"][r][s],callback:function(a){e.$set(e.resource.data.financials["balance-sheet"][r],s,a)},expression:"resource.data.financials['balance-sheet'][i][k]"}})],1)}))],2)}))],2)])],1)],1)],1)]},proxy:!0}],null,!0),model:{value:e.tabsModel,callback:function(a){e.tabsModel=a},expression:"tabsModel"}})],1)],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);a.default=A.exports;Y()(A,{VBadge:m.a,VBtn:h.a,VCard:f.a,VCardText:p.c,VCardTitle:p.d,VCol:v.a,VContainer:g.a,VFadeTransition:b.c,VForm:y.a,VIcon:w.a,VRow:x.a,VSimpleTable:C.a,VSpacer:k.a,VTabItem:I,VTextField:L.a,VToolbarTitle:F.a})},66:function(e,a,t){"use strict";function r(e,a,t){return a in e?Object.defineProperty(e,a,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[a]=t,e}a.a=function e(){var a;!function(e,a){if(!(e instanceof a))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.metadata={years:{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"fps-qa1":(a={Sales:{Year1:"100000",Year2:"125000",Year3:"200000"},"<strong>Change in Inventory Levels</strong>":[],"Opening Stocks":{Year1:"8000",Year2:"9500",Year3:"6500"},"Closing Stocks":{Year1:"9500",Year2:"6500",Year3:"3200"},"":[],"<h4><strong>Purchase of Goods and Services</strong></h4>":[],"<strong>Materials Consumed</strong>":[],"Raw Materials (direct & indirect)":{Year1:"36000",Year2:"45000",Year3:"55000"},"Stock Expiring":{Year1:"",Year2:"",Year3:""},"Other Materials Used":{Year1:"1500",Year2:"1000",Year3:"1000"}},r(a,"",[]),r(a,"<strong>Production Costs</strong>",[]),r(a,"Cargo and Handling",{Year1:"",Year2:"",Year3:""}),r(a,"Part-time/Temporary Labour",{Year1:"",Year2:"",Year3:""}),r(a,"Insurance (not including employee's insurance)",{Year1:"1000",Year2:"1000",Year3:"1000"}),r(a,"Transportation",{Year1:"10000",Year2:"11000",Year3:"11000"}),r(a,"Utilities",{Year1:"",Year2:"",Year3:""}),r(a,"Maintenance (Building, Plant, and Machinery)",{Year1:"2400",Year2:"2500",Year3:"2300"}),r(a,"Lease of Plant and Machinery",{Year1:"",Year2:"",Year3:""}),r(a,"Other Production Costs",{Year1:"",Year2:"",Year3:""}),r(a,"",[]),r(a,"<strong>General Management Costs</strong>",[]),r(a,"Stationery Supplies and Printing",{Year1:"450",Year2:"450",Year3:"450"}),r(a,"Rental",{Year1:"10000",Year2:"10000",Year3:"11000"}),r(a,"Insurance (not including employee's insurance)",{Year1:"",Year2:"",Year3:""}),r(a,"Transportation",{Year1:"1200",Year2:"1200",Year3:"1300"}),r(a,"Company Car/Bus etc.",{Year1:"",Year2:"",Year3:""}),r(a,"Advertising",{Year1:"12000",Year2:"13000",Year3:"13000"}),r(a,"Entertainment",{Year1:"",Year2:"",Year3:""}),r(a,"Food and Drinks",{Year1:"2000",Year2:"1800",Year3:"2100"}),r(a,"Telephone and Fax",{Year1:"600",Year2:"700",Year3:"800"}),r(a,"Mail and Courier",{Year1:"",Year2:"",Year3:""}),r(a,"Maintenance (Office Equipment)",{Year1:"",Year2:"",Year3:""}),r(a,"Travel",{Year1:"",Year2:"",Year3:""}),r(a,"Audit, Secretarial, and Professional Costs",{Year1:"1800",Year2:"2000",Year3:"2000"}),r(a,"Newspapers and Magazines",{Year1:"",Year2:"",Year3:""}),r(a,"Stamp Duty, Filing and Legal",{Year1:"",Year2:"",Year3:""}),r(a,"Bank charges",{Year1:"720",Year2:"720",Year3:"720"}),r(a,"Other Administrative Costs",{Year1:"",Year2:"",Year3:""}),r(a,"<strong>Labour Expenses</strong>",[]),r(a,"Employee Compensation",{Year1:"193257",Year2:"193257",Year3:"193257"}),r(a,"Bonuses",{Year1:"245165",Year2:"245165",Year3:"245165"}),r(a,"Provident Fund",{Year1:"13113",Year2:"13113",Year3:"13113"}),r(a,"Employee Welfare",{Year1:"75092",Year2:"75092",Year3:"75092"}),r(a,"Medical Costs",{Year1:"3395",Year2:"3395",Year3:"3395"}),r(a,"Employee Training",{Year1:"",Year2:"",Year3:""}),r(a,"Director's Salary",{Year1:"409846",Year2:"409846",Year3:"409846"}),r(a,"Employee Insurance",{Year1:"",Year2:"",Year3:""}),r(a,"Other Labour Expenses",{Year1:"",Year2:"",Year3:""}),r(a,"<strong>Depreciation</string>",[]),r(a,"Buildings",{Year1:"179869",Year2:"179869",Year3:"179869"}),r(a,"Plant, Machinery & Equipment",{Year1:"",Year2:"",Year3:""}),r(a,"Others (Depreciation)",{Year1:"",Year2:"",Year3:""}),r(a,"<h4><strong>Non-operating Expenses</strong></h4>",[]),r(a,"<strong>Non-Operating Income</strong>",[]),r(a,"Profit from Fixed Assets Sale",{Year1:"29744",Year2:"10386",Year3:"27577"}),r(a,"Profit from Foreign Exchange",{Year1:"",Year2:"",Year3:""}),r(a,"Other Income",{Year1:"26792",Year2:"24113",Year3:"16075"}),r(a,"<strong>Non-Operating Costs</strong>",[]),r(a,"Bad Debts",{Year1:"",Year2:"",Year3:""}),r(a,"Donations",{Year1:"15135",Year2:"15135",Year3:"15135"}),r(a,"Foreign Exchange Loss",{Year1:"24302",Year2:"24302",Year3:"24302"}),r(a,"Loss on Fixed Assets Sale",{Year1:"",Year2:"",Year3:""}),r(a,"Others (Non-Operating Costs)",{Year1:"",Year2:"",Year3:""}),r(a,"<strong>Taxation</strong>",[]),r(a,"Tax on Property",{Year1:"",Year2:"",Year3:""}),r(a,"Duties (Customs & Excise)",{Year1:"",Year2:"",Year3:""}),r(a,"Levy on Foreign Workers",{Year1:"6275",Year2:"6275",Year3:"6275"}),r(a,"Others (excluding Income Tax)",{Year1:"",Year2:"",Year3:""}),r(a,"<strongInterest On Loans/Hires</strong>",[]),r(a,"Interest & Charges by Bank",{Year1:"493458",Year2:"493458",Year3:"493458"}),r(a,"Interest on Loan",{Year1:"300390",Year2:"300390",Year3:"300390"}),r(a,"Interest on Hire Purchase",{Year1:"",Year2:"",Year3:""}),r(a,"Others (Interest on Loan/Hires)",{Year1:"",Year2:"",Year3:""}),r(a,"<strong>Company Tax</strong>",[]),r(a,"Tax on Company",{Year1:"",Year2:"",Year3:""}),a),"balance-sheet-years":{Years:{Year1:"Year 1",Year2:"Year 2",Year3:"Year 3"}},"balance-sheet":{Cash:{Year1:"8700",Year2:"8550",Year3:"8900"},"Trade Receivables":{Year1:"1200",Year2:"1500",Year3:"1000"},Inventories:{Year1:"800",Year2:"650",Year3:"700"},"Other CA":{Year1:"",Year2:"",Year3:""},"Fixed Assets":{Year1:"1000",Year2:"1000",Year3:"1000"},"Trade Payables":{Year1:"1200",Year2:"1100",Year3:"1150"},"Other CL":{Year1:"500",Year2:"600",Year3:"450"},"Stockholders' Equity":{Year1:"10000",Year2:"10000",Year3:"10000"},"Other NCL":{Year1:"500",Year2:"600",Year3:"450"},"Common Shares Outstanding":{Year1:"",Year2:"",Year3:""}},"fps-qa2":{"<h4><strong>Operating Profit/(Loss)</strong></h4>":[],"Profit or (Loss) Before Income Tax":{Year1:"83184",Year2:"308354",Year3:"242318"},"<strong>Non-Operating Income</strong>":[],"Profit from Fixed Assets Sale":{Year1:"132407",Year2:"135755",Year3:"492314"},"Profit from Foreign Exchange":{Year1:"",Year2:"2030",Year3:""},"Other Income":{Year1:"32150",Year2:"143569",Year3:"1841875"},"<strong>Non-Operating Costs</strong>":[],"Bad Debts":{Year1:"8,570",Year2:"",Year3:""},Donations:{Year1:"19199",Year2:"26062",Year3:"15135"},"Foreign Exchange Loss":{Year1:"",Year2:"",Year3:"24302"},"Loss on Fixed Assets Sale":{Year1:"",Year2:"",Year3:""},"Others (Non-Operating Costs)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Labour Expenses</strong></h4>":[],"Employee Compensation":{Year1:"394097",Year2:"283821",Year3:"209362"},Bonuses:{Year1:"65725",Year2:"6495",Year3:"265595"},"Provident Fund":{Year1:"15930",Year2:"11221",Year3:"14206"},"Employee Welfare":{Year1:"20547",Year2:"52460",Year3:"81350"},"Medical Costs":{Year1:"",Year2:"",Year3:""},"Employee Training":{Year1:"",Year2:"",Year3:""},"Director's Salary":{Year1:"534000",Year2:"422000",Year3:"444000"},"Employee Insurance":{Year1:"",Year2:"",Year3:""},"Others (Labour Expenses)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Interests on Loans/Hires</strong></h4>":[],"Interest & Charges by Bank":{Year1:"534580",Year2:"334666",Year3:"578254"},"Interest on Loan":{Year1:"300390",Year2:"621676",Year3:"587215"},"Interest on Hire Purchase":{Year1:"",Year2:"",Year3:""},"Others (interest on loan/hires)":{Year1:"",Year2:"",Year3:""},"<h4><strong>Depreciation</strong></h4>":[],Buildings:{Year1:"167126",Year2:"179869",Year3:"253729"},"Plant, Machinery & Equipment":{Year1:"",Year2:"",Year3:""},Others:{Year1:"",Year2:"",Year3:""},"<h4><strong>Taxation</strong></h4>":[],"Tax on Property":{Year1:"",Year2:"",Year3:""},"Duties (Customs & Excise)":{Year1:"",Year2:"",Year3:""},"Levy on Foreign Workers":{Year1:"6275",Year2:"35595",Year3:"33832"},"Others (excluding Income Tax & GST/VAT)":{Year1:"",Year2:"",Year3:""}}},this.data={name:"",code:"",refnum:"",description:"",metadata:{},financials:this.metadata}}}}]);
//# sourceMappingURL=7.js.map