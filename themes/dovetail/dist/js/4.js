(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{13:function(e,t,s){"use strict";t.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(e)},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(e)},overall:function(e,t,s){return"/api/v1/reports/overall/customer/".concat(e,"/user/").concat(t,"?month=").concat(s)},financialRatio:function(e){return"/api/v1/customer/".concat(e,"/financial-ratios")},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(e){return"/api/v1/surveys/".concat(e,"/submit")},show:function(e){return"/api/v1/surveys/".concat(e)}},crm:{search:function(e){return"/api/v1/crm/customers/search/".concat(e)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(e){return"/api/v1/customers/".concat(e,"/reports")},generate:function(e){return"/api/v1/reports/".concat(e,"/generate")},download:function(e){return"/api/v1/reports/".concat(e,"/download")},delete:function(e){return"/api/v1/reports/".concat(e)},financialRatio:function(e,t){return"/api/v1/reports/financial-ratio/customers/".concat(e,"/users/").concat(t,"/financial-ratio")}}}},295:function(e,t,s){"use strict";s.r(t);var n=s(13),a=s(54),o=s(56),r=s(0),i=s(2),c=s.n(i),u=s(277),l=s(1),d=s(609),h=s(611),p=s(624),m=Object(r.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),f=m.exports;c()(m,{VCard:u.a,VCardText:l.c,VCol:d.a,VRow:h.a,VSkeletonLoader:p.a});var v=Object(r.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),b=v.exports;c()(v,{VCard:u.a,VCardText:l.c,VCol:d.a,VRow:h.a,VSkeletonLoader:p.a});var g=s(9),w=s(6);function y(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,n)}return s}function k(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?y(Object(s),!0).forEach((function(t){x(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):y(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function x(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var C={beforeRouteLeave:function(e,t,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},components:{CompanyInformation:function(){return s.e(52).then(s.bind(null,380))},ApplicantInformation:function(){return s.e(51).then(s.bind(null,381))},FinancialStatement:function(){return s.e(12).then(s.bind(null,382))},SkeletonEditCompany:f,SkeletonEditFinancial:b,SendFinancialDataToCrmButton:o.a,TotalRow:function(){return s.e(54).then(s.bind(null,383))}},computed:k({},Object(w.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading}}),data:function(e){return{isFinancialStatementHasValue:!1,resource:new a.a,loading:!0,tabsModel:1}},methods:k({},Object(w.b)({hideSidebar:"sidebar/hide",hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,570))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,570))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.hideDialog(),e.$router.replace({name:"companies.owned"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},formIsChanged:function(){this.resource.isPrestine=!1},parseResourceData:function(e){_.clone(e);var t=new FormData(this.$refs["updateform-form"].$el);return console.log(t),t.append("_method","put"),t},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),e.preventDefault(),axios.post(n.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){t.resource.isPrestine=!0,t.isFinancialStatementHasValue=e.data.is_fs_has_no_zero_value,t.getResource(),t.showSuccessbox({text:trans("Company updated successfully"),buttons:{show:{code:"customers.show",to:{name:"companies.show",params:{id:t.resource.data.id}},icon:"mdi-briefcase-search-outline",text:trans("Go to Survey Page")},create:{code:"crm.search",to:{name:"companies.find"},icon:"mdi-file-document-box-search-outline",text:trans("Find Another Company")}}})})).catch((function(e){if(e.response&&e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},previewRatiosReport:function(){this.$router.push({name:"reports.ratios",query:{type:"ratios",user_id:g.default.getId()},params:{id:this.$route.params.id}})},getResource:function(){var e=this;this.resource.loading=!0,this.resource.isPrestine=!1,axios.get(n.a.show(this.$route.params.id)).then((function(t){var s=e.resource.data,n=s.applicant,a=s.metadata,o=t.data.data,r=o.applicant||n;r.metadata=_.merge(n.metadata,r.metadata),o.applicant=r,o.metadata=_.merge(a,o.metadata),o.financials=o.metadata,e.resource.data=o,e.isFinancialStatementHasValue=t.data.data.is_fs_has_no_zero_value})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))},activateTab:function(){this.tabsModel=parseInt(this.$route.query.tab||0)},update:function(){this.resource.isPrestine=!1}}),mounted:function(){this.hideSidebar(),this.getResource(),this.activateTab()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},F=s(616),D=s(112),S=s(610),P=s(5),T=s(623),R=s(98),I=s(612),O=s(374),E=s(20),$=Object(r.a)(C,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Update"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),s("back-to-top"),e._v(" "),e._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var n=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false"},on:{change:e.formIsChanged,submit:function(t){t.preventDefault(),n(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{disabled:e.isFormDisabled,type:"submit"}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"companies.owned"},text:e.trans("Companies")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("Edit :name",{name:e.resource.data.name+"'s Input Data"}))+"\n        ")]},proxy:!0},{key:"action",fn:function(){return[s("validation-provider",{attrs:{name:e.trans("Type"),rules:"email",vid:"metadata[type]"},scopedSlots:e._u([{key:"default",fn:function(t){t.errors;return[s("div",[s("label",[e._v("Audited Financials")]),e._v(" "),s("input",{attrs:{name:"metadata[type]",type:"radio",value:"Audited"},domProps:{checked:"Audited"==e.resource.data.metadata.type}}),e._v(" "),s("span",{staticClass:"d-inline-block mx-3"}),e._v(" "),s("label",[e._v("In-House Financials")]),e._v(" "),s("input",{attrs:{name:"metadata[type]",type:"radio",value:"In-House"},domProps:{checked:"In-House"==e.resource.data.metadata.type}})])]}}],null,!0)})]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("input",{attrs:{type:"hidden",name:"name"},domProps:{value:e.resource.data.name}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"code"},domProps:{value:e.resource.data.code}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"refnum"},domProps:{value:e.resource.data.refnum}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.resource.data.user_id}}),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"12"}},[s("v-card",{attrs:{flat:"",color:"transparent"}},[s("tabs",{scopedSlots:e._u([{key:"item",fn:function(){return[s("v-tab-item",{key:"tab-0"},[e.isFetchingResource?[s("skeleton-edit-company")]:e._e(),e._v(" "),s("company-information",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{isDense:e.isDense,isLoading:e.isLoading},model:{value:e.resource.data,callback:function(t){e.$set(e.resource,"data",t)},expression:"resource.data"}})],2),e._v(" "),s("v-tab-item",{key:"tab-1"},[e.isFetchingResource?[s("skeleton-edit-company")]:e._e(),e._v(" "),s("applicant-information",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{isDense:e.isDense,isLoading:e.isLoading},model:{value:e.resource.data,callback:function(t){e.$set(e.resource,"data",t)},expression:"resource.data"}})],2),e._v(" "),s("v-tab-item",{key:"tab-2"},[e.isFetchingResource?[s("skeleton-edit-financial")]:e._e(),e._v(" "),s("financial-statement",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{isDense:e.isDense,isLoading:e.isLoading},on:{update:e.update},model:{value:e.resource.data,callback:function(t){e.$set(e.resource,"data",t)},expression:"resource.data"}})],2)]},proxy:!0}],null,!0),model:{value:e.tabsModel,callback:function(t){e.tabsModel=t},expression:"tabsModel"}})],1)],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=$.exports;c()($,{VBadge:F.a,VBtn:D.a,VCard:u.a,VCol:d.a,VContainer:S.a,VFadeTransition:P.d,VForm:T.a,VIcon:R.a,VRow:h.a,VSpacer:I.a,VTabItem:O.a,VToolbarTitle:E.a})},374:function(e,t,s){"use strict";var n=s(83),a=s(45),o=s(51),r=s(3),i=s(10);var c=Object(i.a)(n.a,Object(a.a)("windowGroup","v-window-item","v-window")).extend().extend().extend({name:"v-window-item",directives:{Touch:o.a},props:{disabled:Boolean,reverseTransition:{type:[Boolean,String],default:void 0},transition:{type:[Boolean,String],default:void 0},value:{required:!1}},data:()=>({isActive:!1,inTransition:!1}),computed:{classes(){return this.groupClasses},computedTransition(){return this.windowGroup.internalReverse?void 0!==this.reverseTransition?this.reverseTransition||"":this.windowGroup.computedTransition:void 0!==this.transition?this.transition||"":this.windowGroup.computedTransition}},methods:{genDefaultSlot(){return this.$slots.default},genWindowItem(){return this.$createElement("div",{staticClass:"v-window-item",class:this.classes,directives:[{name:"show",value:this.isActive}],on:this.$listeners},this.showLazyContent(this.genDefaultSlot()))},onAfterTransition(){this.inTransition&&(this.inTransition=!1,this.windowGroup.transitionCount>0&&(this.windowGroup.transitionCount--,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=void 0)))},onBeforeTransition(){this.inTransition||(this.inTransition=!0,0===this.windowGroup.transitionCount&&(this.windowGroup.transitionHeight=Object(r.h)(this.windowGroup.$el.clientHeight)),this.windowGroup.transitionCount++)},onTransitionCancelled(){this.onAfterTransition()},onEnter(e){this.inTransition&&this.$nextTick(()=>{this.computedTransition&&this.inTransition&&(this.windowGroup.transitionHeight=Object(r.h)(e.clientHeight))})}},render(e){return e("transition",{props:{name:this.computedTransition},on:{beforeEnter:this.onBeforeTransition,afterEnter:this.onAfterTransition,enterCancelled:this.onTransitionCancelled,beforeLeave:this.onBeforeTransition,afterLeave:this.onAfterTransition,leaveCancelled:this.onTransitionCancelled,enter:this.onEnter}},[this.genWindowItem()])}});t.a=c.extend({name:"v-tab-item",props:{id:String},methods:{genWindowItem(){const e=c.options.methods.genWindowItem.call(this);return e.data.domProps=e.data.domProps||{},e.data.domProps.id=this.id||this.value,e}}})},54:function(e,t,s){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={applicant:{customer_id:null,metadata:{BusinessCounselorName:null,FileNo:null,FundingRequestNo:null,PeeBusinessCounselorName:null,SiteVisitDate:null,address:null,contact_person:null,designation:null,email:null,industry:null,name:null,number:null,staffstrength:null,website:null,cooperation:{Reachable:null,Cooperating:null,Involvement:null,"Duration of Overdue (DPD)":null}}},name:"",code:"",refnum:"",description:"",details:{customer_id:null,metadata:{business_size:null,description:null,funding_program:null,industry_sector:null,license_no:null,project_location:null,project_name:null,project_type:null,trade_name_ar:null,trade_name_en:null}},metadata:{type:"",applicant:{name:""}},financials:this.metadataOrig,reports:[]}}},56:function(e,t,s){"use strict";var n=s(13),a={props:["customer","user"],data:function(){return{isSending:!1,resource:{data:{}}}},computed:{isOverall:function(){return"overall"==this.type}},methods:{getReportData:function(){var e=this;return new Promise((function(t,s){e.customer;var n=e.user;axios.get("/api/v1/reports/financial-ratio//".concat(customecustomerr,"/user/").concat(n)).then((function(e){t(e)})).catch((function(e){s(e)}))}))},sendBothScoreAndDocument:function(){this.sendToCrm(),this.sendDocumentToCrm()},sendToCrm:function(){var e=this;this.$store.dispatch("snackbar/show",{button:{show:!1},timeout:0,text:"Sending report to CRM. Please wait..."}),this.getReportData().then((function(t){if(e.resource.data=t.data,!e.resource.data.customer)return e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:"Please complete all surveys for the Financial Report to be submitted."}),e.isSending=!1,!1;console.log(e.resource);var s={FileNo:e.resource.data.customer.filenumber,YearofFinancial:e.resource.data.customer.metadata.years.Years.Year3,SubmissionDate:e.resource.data.profit_and_loss["Submission Date"]||e.resource.data.date,Revenue:parseInt(e.resource.data.profit_and_loss.Revenue.Year3||0),CostofGoodsSold:parseInt(e.resource.data.profit_and_loss.CostOfGoodsSold.Year3||0),OtherExpenses:0,NonOperatingExpenses:parseInt(e.resource.data.profit_and_loss.OtherExpenses["Non-Operating expenses (NOE)"].Year3||0),OperatingLossProfit:parseInt(e.resource.data.profit_and_loss.OtherExpenses["Operating (loss)/profit"].Year3||0),Depreciation:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Depreciation.Year3||0),Taxes:parseInt(e.resource.data.profit_and_loss.OtherExpenses.Taxes.Year3||0),NetLossProfits:parseInt(e.resource.data.profit_and_loss.NetProfit.Year3||0),FixedAssets:parseInt(e.resource.data.profit_and_loss.FixedAssets["Fixed Assets"].Year3||0),TotalLiabilities:parseInt(e.resource.data.profit_and_loss.FixedAssets["Total Liabilities"].Year3||0),StockholdersEquity:parseInt(e.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3||0),Marketing:parseInt(e.resource.data.profit_and_loss.Marketing.Year3||0),Rent:parseInt(e.resource.data.profit_and_loss.Rent.Year3||0),Salaries:parseInt(e.resource.data.profit_and_loss.Salaries.Year3||0),LicensingFees:parseInt(e.resource.data.profit_and_loss["Licensing Fees"].Year3||0),VisaEmploymentFees:parseInt(e.resource.data.profit_and_loss["Visa / Employment Fees"].Year3||0)};console.log(s),e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending report to CRM. Establishing connection to CRM..."}),axios.post(n.a.crm.sendFinancial(),s).then((function(t){e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})}))})).catch((function(e){console.log("err",e)}))},sendDocumentToCrm:function(){var e=this;this.isSending=!0,this.getReportData().then((function(t){e.resource.data=t.data;var s={Id:_.toUpper(e.resource.data.customer.token),FileContentBase64:e.resource.data["report:financial"]||"empty"};e.$store.dispatch("snackbar/show",{icon:"mdi-spin mdi-loading",button:{show:!1},timeout:0,text:"Sending Financial Report Document to CRM. Establishing connection..."}),axios.post(n.a.crm.sendDocument(),s).then((function(t){console.log("data",t.data),e.$store.dispatch("snackbar/hide"),1==t.data.Code?e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("File Successfully sent to CRM")}):e.$store.dispatch("dialog/error",{show:!0,width:400,buttons:{cancel:{show:!1}},title:"Returned a Code "+t.data.Code,text:t.data.Message})})).catch((function(t){e.$store.dispatch("snackbar/show",{icon:!1,timeout:8e3,button:{show:!0},text:trans("Unable to connect to CRM. Please check your network connection")})})).finally((function(){e.isSending=!1}))}))}}},o=s(0),r=s(2),i=s.n(r),c=s(112),u=s(98),l=Object(o.a)(a,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("v-btn",{attrs:{loading:e.isSending,disabled:e.isSending,large:"",block:e.$vuetify.breakpoint.smAndDown,color:"primary"},on:{click:e.sendBothScoreAndDocument}},[s("v-icon",{attrs:{left:"",small:""}},[e._v("mdi-send")]),e._v("\n  "+e._s(e.trans("Send Financial Report to CRM"))+"\n")],1)}),[],!1,null,null,null);t.a=l.exports;i()(l,{VBtn:c.a,VIcon:u.a})}}]);
//# sourceMappingURL=4.js.map