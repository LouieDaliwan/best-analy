(window.webpackJsonp=window.webpackJsonp||[]).push([[41],{279:function(e,t,a){"use strict";a.r(t);var s=a(12),r=a(52),n=a(51),o=a(0),i=a(2),l=a.n(i),c=a(262),d=a(1),u=a(580),h=a(582),m=a(595),p=Object(o.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),f=p.exports;l()(p,{VCard:c.a,VCardText:d.c,VCol:u.a,VRow:h.a,VSkeletonLoader:m.a});var v=Object(o.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),g=v.exports;l()(v,{VCard:c.a,VCardText:d.c,VCol:u.a,VRow:h.a,VSkeletonLoader:m.a});var b=a(6);function y(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,s)}return a}function x(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?y(Object(a),!0).forEach((function(t){C(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):y(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function C(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var w={beforeRouteLeave:function(e,t,a){this.resource.isPrestine?a():this.askUserBeforeNavigatingAway(a)},components:{SkeletonEditCompany:f,SkeletonEditFinancial:g,SendFinancialDataToCrmButton:n.a,TotalRow:function(){return a.e(45).then(a.bind(null,356))}},computed:x({},Object(b.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading}}),data:function(e){return{resource:new r.a,loading:!0,tabsModel:1,costOfGoodSold:{Year1:0,Year2:0,Year3:0},totalProductionCost:{Year1:0,Year2:0,Year3:0},totalGeneralMgmtCost:{Year1:0,Year2:0,Year3:0},totalPurchases:{Year1:0,Year2:0,Year3:0},valueAdded:{Year1:0,Year2:0,Year3:0},totalLabourExpenses:{Year1:0,Year2:0,Year3:0},totalDepreciation:{Year1:0,Year2:0,Year3:0},totalNonOperatingExpenses:{Year1:0,Year2:0,Year3:0},totalTaxes:{Year1:0,Year2:0,Year3:0},totalInterest:{Year1:0,Year2:0,Year3:0},financialTotal:{Year1:0,Year2:0,Year3:0},balanceTotal:{Year1:0,Year2:0,Year3:0}}},methods:x({},Object(b.b)({hideSidebar:"sidebar/hide",hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,525))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},ct:function(e){switch(e){case"Closing Stocks":return{title:"Cost of Good Sold",total:this.costOfGoodSold};case"Direct Employee Cost":return{title:"Total Production Cost",total:this.totalProductionCost};case"Other Administrative Costs":return{title:"Total General Management Cost",total:this.totalGeneralMgmtCost};case"Total General Management Cost":return{title:"Total Purchase of Goods and Services",total:this.totalPurchases};case"Total Purchase of Goods and Services":return{title:"Value Added",total:this.valueAdded};case"Other Labour Expenses":return{title:"Total Labour Expenses",total:this.totalLabourExpenses};case"Others (Depreciation)":return{title:"Total Depreciation",total:this.totalDepreciation};case"Others (Non-Operating Costs)":return{title:"Net Non-Operating Expenses",total:this.totalNonOperatingExpenses};case"Others (excluding Income Tax)":return{title:"Total Taxes",total:this.totalTaxes};case"Others (Interest on Loan/Hires)":return{title:"Total Interest on Loans/Hires",total:this.totalInterest}}return!1},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,525))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.hideDialog(),e.$router.replace({name:"companies.owned"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},formIsChanged:function(){this.resource.isPrestine=!1},parseResourceData:function(e){_.clone(e);var t=new FormData(this.$refs["updateform-form"].$el);return t.append("_method","put"),t},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),e.preventDefault(),axios.post(s.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){t.resource.isPrestine=!0,t.showSuccessbox({text:trans("Company updated successfully"),buttons:{show:{code:"customers.show",to:{name:"companies.show",params:{id:t.resource.data.id}},icon:"mdi-briefcase-search-outline",text:trans("Go to Survey Page")},create:{code:"crm.search",to:{name:"companies.find"},icon:"mdi-file-document-box-search-outline",text:trans("Find Another Company")}}})})).catch((function(e){if(e.response&&e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},getResource:function(){var e=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(s.a.show(this.$route.params.id)).then((function(t){e.resource.data=t.data.data,e.resource.metadata=_.merge({},e.resource.metadata,e.resource.data.metadata),e.resource.data.financials=e.resource.metadata})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))},activateTab:function(){this.tabsModel=parseInt(this.$route.query.tab||0)},calculateTotals:function(){var e=this.resource.data.financials["fps-qa1"];this.costOfGoodSold=this.multiplyToNegative(this.resource.calculateThreeYears({"Opening Stocks":e["Opening Stocks"],"Raw Materials (direct & indirect)":e["Raw Materials (direct & indirect)"],"Closing Stocks":e["Closing Stocks"]})),this.totalProductionCost=this.multiplyToNegative(this.resource.calculateThreeYears({"Cargo and Handling":e["Cargo and Handling"],"Part-time/Temporary Labour":e["Part-time/Temporary Labour"],"Insurance (not including employee's insurance)":e["Insurance (not including employee's insurance)"],Transportation:e.Transportation,Utilities:e.Utilities,"Maintenance (Building, Plant, and Machinery)":e["Maintenance (Building, Plant, and Machinery)"],"Lease of Plant and Machinery":e["Lease of Plant and Machinery"],"Direct Employee Cost":e["Direct Employee Cost"]})),this.totalGeneralMgmtCost=this.multiplyToNegative(this.resource.calculateThreeYears({"Stationery Supplies and Printing":e["Stationery Supplies and Printing"],Rental:e.Rental,"Insurance (not including employee's insurance) ":e["Insurance (not including employee's insurance) "],"Transportation ":e["Transportation "],"Company Car/Bus etc.":e["Company Car/Bus etc."],Advertising:e.Advertising,Entertainment:e.Entertainment,"Food and Drinks":e["Food and Drinks"],"Telephone and Fax":e["Telephone and Fax"],"Mail and Courier":e["Mail and Courier"],"Maintenance (Office Equipment)":e["Maintenance (Office Equipment)"],Travel:e.Travel,"Audit, Secretarial, and Professional Costs":e["Audit, Secretarial, and Professional Costs"],"Newspapers and Magazines":e["Newspapers and Magazines"],"Stamp Duty, Filing and Legal":e["Stamp Duty, Filing and Legal"],"Bank charges":e["Bank charges"],"Other Administrative Costs":e["Other Administrative Costs"]})),this.totalPurchases=this.multiplyToNegative(this.resource.calculateThreeYears({"Cost of Good Sold":this.costOfGoodSold,"Total Production Cost":this.totalProductionCost,"Total General Management Cost":this.totalGeneralMgmtCost})),this.valueAdded=this.resource.calculateThreeYears({Sales:e.Sales,"Total Purchases":this.totalPurchases}),this.totalLabourExpenses=this.multiplyToNegative(this.resource.calculateThreeYears({"Employee Compensation":e["Employee Compensation"],Bonuses:e.Bonuses,"Provident Fund":e["Provident Fund"],"Employee Welfare":e["Employee Welfare"],"Medical Costs":e["Medical Costs"],"Employee Training":e["Employee Training"],"Director's Salary":e["Director's Salary"],"Employee Insurance":e["Employee Insurance"],"Other Labour Expenses":e["Other Labour Expenses"]})),this.totalDepreciation=this.multiplyToNegative(this.resource.calculateThreeYears({Buildings:e.Buildings,"Plant, Machinery & Equipment":e["Plant, Machinery & Equipment"],"Others (Depreciation)":e["Others (Depreciation)"]})),this.totalNonOperatingExpenses=this.multiplyToNegative(this.resource.calculateThreeYears({"Profit from Fixed Assets Sale":e["Profit from Fixed Assets Sale"],"Profit from Foreign Exchange":e["Profit from Foreign Exchange"],"Other Income":e["Other Income"],"Bad Debts":e["Bad Debts"],Donations:e.Donations,"Foreign Exchange Loss":e["Foreign Exchange Loss"],"Loss on Fixed Assets Sale":e["Loss on Fixed Assets Sale"],"Others (Non-Operating Costs)":e["Others (Non-Operating Costs)"]})),this.totalTaxes=this.multiplyToNegative(this.resource.calculateThreeYears({"Tax on Property":e["Tax on Property"],"Duties (Customs & Excise)":e["Duties (Customs & Excise)"],"Levy on Foreign Workers":e["Levy on Foreign Workers"],"Others (excluding Income Tax)":e["Others (excluding Income Tax)"]})),this.totalInterest=this.multiplyToNegative(this.resource.calculateThreeYears({"Interest & Charges by Bank":e["Interest & Charges by Bank"],"Interest on Loan":e["Interest on Loan"],"Interest on Hire Purchase":e["Interest on Hire Purchase"],"Others (Interest on Loan/Hires)":e["Others (Interest on Loan/Hires)"]})),this.financialTotal=this.resource.calculateThreeYears(e),this.balanceTotal=this.formatBalanceTotal(this.resource.calculateThreeYears(this.resource.data.financials["balance-sheet"]))},multiplyToNegative:function(e){return Object.keys(e).forEach((function(t){return e[t]*=-1})),e},formatBalanceTotal:function(e){return Object.keys(e).forEach((function(t){0===e[t]&&(e[t]="Balanced!")})),e}}),mounted:function(){this.hideSidebar(),this.getResource(),this.activateTab()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.calculateTotals(),this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},k=a(587),T=a(104),S=a(581),P=a(5),O=a(594),E=a(91),D=a(349),I=a(583),Y=a(78),F=a(44),L=a(58),M=a(3),R=a(8);var A=Object(R.a)(Y.a,Object(F.a)("windowGroup","v-window-item","v-window")).extend().extend().extend({name:"v-window-item",directives:{Touch:L.a},props:{disabled:Boolean,reverseTransition:{type:[Boolean,String],default:void 0},transition:{type:[Boolean,String],default:void 0},value:{required:!1}},data:()=>({isActive:!1,inTransition:!1}),computed:{classes(){return this.groupClasses},computedTransition(){return this.windowGroup.internalReverse?void 0!==this.reverseTransition?this.reverseTransition||"":this.windowGroup.computedTransition:void 0!==this.transition?this.transition||"":this.windowGroup.computedTransition}},methods:{genDefaultSlot(){return this.$slots.default},genWindowItem(){return this.$createElement("div",{staticClass:"v-window-item",class:this.classes,directives:[{name:"show",value:this.isActive}],on:this.$listeners},this.showLazyContent(this.genDefaultSlot()))},onAfterTransition(){this.inTransition&&(this.inTransition=!1,this.windowGroup.transitionCount>0&&(this.windowGroup.transitionCount--,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=void 0)))},onBeforeTransition(){this.inTransition||(this.inTransition=!0,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=Object(M.h)(this.windowGroup.$el.clientHeight)),this.windowGroup.transitionCount++)},onTransitionCancelled(){this.onAfterTransition()},onEnter(e){this.inTransition&&this.$nextTick(()=>{this.computedTransition&&this.inTransition&&(this.windowGroup.transitionHeight=Object(M.h)(e.clientHeight))})}},render(e){return e("transition",{props:{name:this.computedTransition},on:{beforeEnter:this.onBeforeTransition,afterEnter:this.onAfterTransition,enterCancelled:this.onTransitionCancelled,beforeLeave:this.onBeforeTransition,afterLeave:this.onAfterTransition,leaveCancelled:this.onTransitionCancelled,enter:this.onEnter}},[this.genWindowItem()])}}),$=A.extend({name:"v-tab-item",props:{id:String},methods:{genWindowItem(){const e=A.options.methods.genWindowItem.call(this);return e.data.domProps=e.data.domProps||{},e.data.domProps.id=this.id||this.value,e}}}),B=a(48),N=a(20),G=Object(o.a)(w,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[a("v-container",{staticClass:"py-0 px-0"},[a("v-row",{attrs:{justify:"space-between",align:"center"}},[a("v-fade-transition",[e.isNotFormPrestine?a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),a("v-spacer"),e._v(" "),a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("div",{staticClass:"d-flex justify-end"},[a("v-spacer"),e._v(" "),a("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),a("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[a("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[a("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Update"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[a("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),a("back-to-top"),e._v(" "),e._v(" "),a("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var s=t.handleSubmit;t.errors,t.invalid,t.passed;return[a("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false"},on:{change:e.formIsChanged,submit:function(t){t.preventDefault(),s(e.submit(t))}}},[a("button",{ref:"submit-button",staticClass:"d-none",attrs:{disabled:e.isFormDisabled,type:"submit"}}),e._v(" "),a("page-header",{attrs:{back:{to:{name:"companies.owned"},text:e.trans("Companies")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("Edit :name",{name:e.resource.data.name+"'s Input Data"}))+"\n        ")]},proxy:!0},{key:"action",fn:function(){return[a("validation-provider",{attrs:{vid:"metadata[type]",name:e.trans("Type"),rules:"email"},scopedSlots:e._u([{key:"default",fn:function(t){t.errors;return[a("div",[a("label",[e._v("Audited Financials")]),e._v(" "),a("input",{attrs:{type:"radio",name:"metadata[type]",value:"Audited"},domProps:{checked:"Audited"==e.resource.data.metadata.type}}),e._v(" "),a("span",{staticClass:"d-inline-block mx-3"}),e._v(" "),a("label",[e._v("In-House Financials")]),e._v(" "),a("input",{attrs:{type:"radio",name:"metadata[type]",value:"In-House"},domProps:{checked:"In-House"==e.resource.data.metadata.type}})])]}}],null,!0)}),e._v(" "),a("div",{staticClass:"mt-3 text-right"},[a("send-financial-data-to-crm-button",{attrs:{customer:e.resource.data.id,user:e.resource.data.user_id}})],1)]},proxy:!0}],null,!0)}),e._v(" "),a("alertbox"),e._v(" "),a("input",{attrs:{type:"hidden",name:"name"},domProps:{value:e.resource.data.name}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"code"},domProps:{value:e.resource.data.code}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"refnum"},domProps:{value:e.resource.data.refnum}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.resource.data.user_id}}),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"12"}},[a("v-card",{attrs:{flat:"",color:"transparent"}},[a("tabs",{scopedSlots:e._u([{key:"item",fn:function(){return[a("v-tab-item",{key:"tab-0"},[e.isFetchingResource?[a("skeleton-edit-company")]:e._e(),e._v(" "),a("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}]},[a("v-card-text",[a("validation-provider",{attrs:{vid:"name",name:e.trans("Name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Company Name"),autofocus:"",name:"name",outlined:"","prepend-inner-icon":"mdi-briefcase-outline"},model:{value:e.resource.data.name,callback:function(t){e.$set(e.resource.data,"name",t)},expression:"resource.data.name"}})]}}],null,!0)}),e._v(" "),a("validation-provider",{attrs:{vid:"metadata[email]",name:e.trans("Email"),rules:"email"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Company Email"),autofocus:"",name:"metadata[email]",outlined:"","prepend-inner-icon":"mdi-email-outline"},model:{value:e.resource.data.metadata.email,callback:function(t){e.$set(e.resource.data.metadata,"email",t)},expression:"resource.data.metadata['email']"}})]}}],null,!0)}),e._v(" "),a("validation-provider",{attrs:{vid:"metadata[address]",name:e.trans("Company Address")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Company Address"),autofocus:"",name:"metadata[address]",outlined:"","prepend-inner-icon":"mdi-map-marker"},model:{value:e.resource.data.metadata.address,callback:function(t){e.$set(e.resource.data.metadata,"address",t)},expression:"resource.data.metadata['address']"}})]}}],null,!0)}),e._v(" "),a("validation-provider",{attrs:{vid:"metadata[website]",name:e.trans("Website")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Website"),autofocus:"",name:"metadata[website]",outlined:"","prepend-inner-icon":"mdi-earth"},model:{value:e.resource.data.metadata.website,callback:function(t){e.$set(e.resource.data.metadata,"website",t)},expression:"resource.data.metadata['website']"}})]}}],null,!0)}),e._v(" "),a("validation-provider",{attrs:{vid:"metadata[staffstrength]",name:e.trans("Staff Strength")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Staff Strength"),autofocus:"",name:"metadata[staffstrength]",outlined:"",type:"number"},model:{value:e.resource.data.metadata.staffstrength,callback:function(t){e.$set(e.resource.data.metadata,"staffstrength",t)},expression:"resource.data.metadata['staffstrength']"}})]}}],null,!0)}),e._v(" "),a("validation-provider",{attrs:{vid:"metadata[industry]",name:e.trans("Industry")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Industry"),name:"metadata[industry]",outlined:""},model:{value:e.resource.data.metadata.industry,callback:function(t){e.$set(e.resource.data.metadata,"industry",t)},expression:"resource.data.metadata['industry']"}})]}}],null,!0)}),e._v(" "),e._l(e.resource.data.metadata,(function(t,s){return a("input",{attrs:{type:"hidden",name:"metadata["+s+"]"},domProps:{value:e.resource.data.metadata[s]}})}))],2)],1)],2),e._v(" "),a("v-tab-item",{key:"tab-1"},[e.isFetchingResource?[a("skeleton-edit-financial")]:e._e(),e._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}]},[a("v-card",{staticClass:"mb-3"},[a("v-card-title",[a("span",{staticClass:"red--text mr-2"},[e._v("*")]),e._v(" - Denotes compulsory items")]),e._v(" "),a("v-card-title",[e._v(e._s(e.trans("Income Statement")))]),e._v(" "),a("v-card-text",{staticStyle:{"overflow-x":"auto"}},[a("v-simple-table",{staticClass:"transparent mb-3",staticStyle:{"min-width":"800px"}},[a("tbody",[a("tr",{staticStyle:{"vertical-align":"top"}},[a("td",{attrs:{colspan:"100%"}}),e._v(" "),a("td",[a("strong",[e._v(e._s(e.trans("Period 1")))])]),e._v(" "),a("td",[a("strong",[e._v(e._s(e.trans("Period 2")))])]),e._v(" "),a("td",[a("strong",[e._v(e._s(e.trans("Period 3"))),a("br"),e._v(e._s(e.trans("(most recent)")))])])]),e._v(" "),e._l(e.resource.metadata.years,(function(t,s){return a("tr",{key:s},[a("td",{attrs:{colspan:t.length?1:"100%"}},[a("div",{staticClass:"year-label",domProps:{innerHTML:e._s(e.trans(s))}})]),e._v(" "),e._l(t,(function(t,r){return a("td",{key:r},[a("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[years]["+s+"]["+r+"]",label:e.trans(r),dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials.years[s][r],callback:function(t){e.$set(e.resource.data.financials.years[s],r,t)},expression:"resource.data.financials['years'][i][k]"}})],1)}))],2)})),e._v(" "),a("tr",[a("td",{staticClass:"text-right",attrs:{colspan:"100%"}},[a("strong",[e._v("Net Profit")])]),e._v(" "),e._l(e.financialTotal,(function(t,s){return a("td",{key:s},[a("v-text-field",{staticClass:"dt-text-field",class:t>0?"text-green":"text-red",attrs:{disabled:e.isLoading,label:"Total",color:t>0?"green":"red",dense:"","hide-details":"",value:t,readonly:""}})],1)}))],2),e._v(" "),e._l(e.resource.metadata["fps-qa1"],(function(t,s){return[["Stock Expiring","Other Materials Used"].includes(s)?e._e():a("tr",{key:s},[a("td",{class:{compulsory:e.resource.checkIfCompulsoryItems(s)},attrs:{colspan:t.length?1:"100%"},domProps:{innerHTML:e._s(e.trans(s))}}),e._v(" "),e._l(t,(function(t,r){return a("td",{key:r},[a("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[fps-qa1]["+s+"]["+r+"]",dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials["fps-qa1"][s][r],callback:function(t){e.$set(e.resource.data.financials["fps-qa1"][s],r,t)},expression:"resource.data.financials['fps-qa1'][i][k]"}})],1)}))],2),e._v(" "),e.ct(s)?a("total-row",{key:s+"-1",attrs:{title:e.ct(s).title,totals:e.ct(s).total,isLoading:e.isLoading}}):e._e(),e._v(" "),e.ct(e.ct(s).title)?a("total-row",{key:e.ct(s).title+"-1",attrs:{title:e.ct(e.ct(s).title).title,totals:e.ct(e.ct(s).title).total,isLoading:e.isLoading}}):e._e(),e._v(" "),e.ct(e.ct(e.ct(s).title).title)?a("total-row",{key:e.ct(e.ct(s).title).title+"-1",attrs:{title:e.ct(e.ct(e.ct(s).title).title).title,totals:e.ct(e.ct(e.ct(s).title).title).total,isLoading:e.isLoading}}):e._e()]}))],2)])],1)],1),e._v(" "),a("v-card",{staticClass:"mb-3"},[a("v-card-title",[e._v(e._s(e.trans("Balance Sheet")))]),e._v(" "),a("v-card-text",{staticStyle:{"overflow-x":"auto"}},[a("v-simple-table",{staticClass:"transparent mb-3",staticStyle:{"min-width":"800px"}},[a("tbody",[a("tr",{staticStyle:{"vertical-align":"top"}},[a("td",{attrs:{colspan:"100%"}}),e._v(" "),a("td",[a("strong",[e._v(e._s(e.trans("Period 1")))])]),e._v(" "),a("td",[a("strong",[e._v(e._s(e.trans("Period 2")))])]),e._v(" "),a("td",[a("strong",[e._v(e._s(e.trans("Period 3"))),a("br"),e._v(e._s(e.trans("(most recent)")))])])]),e._v(" "),e._l(e.resource.metadata.years,(function(t,s){return a("tr",{key:s},[a("td",{attrs:{colspan:t.length?1:"100%"}},[a("div",{staticClass:"year-label",domProps:{innerHTML:e._s(e.trans(s))}})]),e._v(" "),e._l(t,(function(t,r){return a("td",{key:r},[a("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[years]["+s+"]["+r+"]",label:e.trans(r),dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials.years[s][r],callback:function(t){e.$set(e.resource.data.financials.years[s],r,t)},expression:"resource.data.financials['years'][i][k]"}})],1)}))],2)})),e._v(" "),a("tr",[a("td",{staticClass:"text-right",attrs:{colspan:"100%"}},[a("strong",[e._v("Balance checked!")])]),e._v(" "),e._l(e.balanceTotal,(function(t,s){return a("td",{key:s},[a("v-text-field",{staticClass:"dt-text-field",class:"Balanced!"!==t?"text-red":"text-green",attrs:{disabled:e.isLoading,label:"Result",color:"Balanced!"!==t?"red":"green",dense:"","hide-details":"",value:t,readonly:""}})],1)}))],2),e._v(" "),e._l(e.resource.metadata["balance-sheet"],(function(t,s){return a("tr",{key:s},[a("td",{class:{compulsory:e.resource.checkIfCompulsoryItems(s)},attrs:{colspan:t.length?1:"100%"},domProps:{innerHTML:e._s(e.trans(s))}}),e._v(" "),e._l(t,(function(t,r){return a("td",{key:r},[a("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,name:"metadata[balance-sheet]["+s+"]["+r+"]",dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.financials["balance-sheet"][s][r],callback:function(t){e.$set(e.resource.data.financials["balance-sheet"][s],r,t)},expression:"resource.data.financials['balance-sheet'][i][k]"}})],1)}))],2)}))],2)])],1)],1)],1)],2)]},proxy:!0}],null,!0),model:{value:e.tabsModel,callback:function(t){e.tabsModel=t},expression:"tabsModel"}})],1)],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=G.exports;l()(G,{VBadge:k.a,VBtn:T.a,VCard:c.a,VCardText:d.c,VCardTitle:d.d,VCol:u.a,VContainer:S.a,VFadeTransition:P.c,VForm:O.a,VIcon:E.a,VRow:h.a,VSimpleTable:D.a,VSpacer:I.a,VTabItem:$,VTextField:B.a,VToolbarTitle:N.a})},51:function(e,t,a){"use strict";var s=a(12),r={props:["customer","user"],data:function(){return{isSending:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var e=this;return new Promise((function(t,a){var s=e.customer,r=e.user;axios.get("/api/v1/reports/overall/customer/".concat(s,"/user/").concat(r)).then((function(e){t(e)})).catch((function(e){a(e)}))}))},sendBothScoreAndDocument:function(){this.sendToCrm(),this.sendDocumentToCrm()},sendToCrm:function(){var e=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:"Please complete all surveys for the Financial Report to be submitted."}),e.isSending=!1,!1;var a={FileNo:e.resource.data.customer.filenumber,YearofFinancial:e.resource.data.customer.metadata.years.Years.Year3,SubmissionDate:e.resource.data.profit_and_loss["Submission Date"]||e.resource.data.report.updated_at,Revenue:parseInt(e.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(e.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:0,NonOperatingExpenses:parseInt(e.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(e.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(e.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(e.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(e.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(e.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(e.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(e.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(e.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(e.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(e.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log(a),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(s.a.crm.sendFinancial(),a).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(e){console.log("err",e)}))},sendDocumentToCrm:function(){var e=this;this.isSending=!0,this.getReportData().then((function(t){e.resource.data=t.data;var a={Id:_.toUpper(e.resource.data.customer.token),FileContentBase64:e.resource.data["report:financial"]||"empty"};e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(s.a.crm.sendDocument(),a).then((function(t){console.log("data",t.data),e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1}))}))}}},n=a(0),o=a(2),i=a.n(o),l=a(104),c=a(91),d=Object(n.a)(r,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-btn",{attrs:{loading:e.isSending,disabled:e.isSending,large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:e.sendBothScoreAndDocument}},[a("v-icon",{attrs:{left:"",small:""}},[e._v("mdi-send")]),e._v("\n  "+e._s(e.trans("Send Financial Report to CRM"))+"\n")],1)}),[],!1,null,null,null);t.a=d.exports;i()(d,{VBtn:l.a,VIcon:c.a})}}]);
//# sourceMappingURL=41.js.map