(window.webpackJsonp=window.webpackJsonp||[]).push([[14],{13:function(t,e,n){"use strict";e.a={list:function(){return"/api/v1/customers"},owned:function(){return"/api/v1/customers/owned"},store:function(){return"/api/v1/customers"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/restore/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},trashed:function(){return"/api/v1/customers/trashed"},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/".concat(t)},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/customers/delete/".concat(t)},overall:function(t,e,n){return"/api/v1/reports/overall/customer/".concat(t,"/user/").concat(e,"?month=").concat(n)},financialRatio:function(t){return"/api/v1/customer/".concat(t,"/financial-ratios")},indices:{list:function(){return"/api/v1/indices"}},surveys:{submit:function(t){return"/api/v1/surveys/".concat(t,"/submit")},show:function(t){return"/api/v1/surveys/".concat(t)}},crm:{search:function(t){return"/api/v1/crm/customers/search/".concat(t)},update:function(){return"/api/v1/crm/customers/update"},save:function(){return"/api/v1/crm/customers/save"},sendDocument:function(){return"/api/v1/crm/report/send"},sendFinancial:function(){return"/api/v1/crm/financial/send"}},reports:{list:function(t){return"/api/v1/customers/".concat(t,"/reports")},generate:function(t){return"/api/v1/reports/".concat(t,"/generate")},download:function(t){return"/api/v1/reports/".concat(t,"/download")},delete:function(t){return"/api/v1/reports/".concat(t)}}}},309:function(t,e,n){"use strict";n.r(e);var a=n(13),s=n(10),r=n(53),o=n(23);window.CRM_CODE_FILE_NUMBER_FOUND=1,window.CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST=4;window.CRM_CODE_FILE_NUMBER_FOUND;var i=window.CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST,u=n(6);function c(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function l(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var d={store:o.a,data:function(){return{results:!1,searching:!1,companyFound:!1,query:"",errors:[],headers:[{text:"Company Name",align:"left",value:"CompanyName"},{text:"Funding Request No.",align:"left",value:"FundingRequestNo"},{text:"Business Counselor Name",align:"left",value:"BusinessCounselorName"},{text:"Status",align:"left",value:"Status"},{text:"",align:"left",value:"actions"}],companies:[],company:new r.a}},methods:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?c(Object(n),!0).forEach((function(e){l(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(u.b)({loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",toggleBreadcrumbs:"breadcrumbs/toggle"}),{search:_.debounce((function(t){var e=this;this.query=t.srcElement.value||"",this.searching=!0,this.companyFound=!1,_.isEmpty(this.query)||this.searchForCompanyInCrm(this.query),setTimeout((function(){e.searching=!1}),3e3)}),920),searchForCompanyInCrm:function(t){var e=this;axios.get(a.a.crm.search(t)).then((function(t){var n=t.data,a=n.Code,s=n.Message,r=n.Content;if(a==i)return e.errors.push(s),e.showSnackbar({icon:!1,button:{show:!0},text:e.trans(s)});a==CRM_CODE_FILE_NUMBER_FOUND&&(e.companyFound=!0,e.results=!0,e.companies.push(r))})).catch((function(t){e.showDialog({illustration:function(){return Promise.resolve().then(n.bind(null,278))},title:trans("Internal Error"),width:400,text:trans("Incorrect file number input. Please try again."),buttons:{cancel:!1}})})).finally((function(){e.searching=!1}))},goToNextStep:function(t){this.prepFoundCompany(t)},saveDummyCompany:function(){var t=this.query||Math.random(),e={name:"Dummy Company "+Math.random(),code:this.slugify("Dummy Company "+Math.random()),refnum:t,status:"Pending",token:"09-09090909-090909-0909-dummy",user_id:s.default.getId(),metadata:Object.assign({FileNo:t,FundingRequestNo:t,SiteVisitDate:new Date,BusinessCounselorName:Math.random(),PeeBusinessCounselorName:Math.random()},this.company.metadata)};this.saveFoundCompany(e)},prepFoundCompany:function(t){var e={name:t.CompanyName,code:this.slugify(t.CompanyName),refnum:this.query,status:t.Status,token:t.Id,user_id:s.default.getId(),metadata:Object.assign({FileNo:this.query,FundingRequestNo:t.FundingRequestNo,SiteVisitDate:t.SiteVisitDate||null,BusinessCounselorName:t.BusinessCounselorName,PeeBusinessCounselorName:t.PeeBusinessCounselorName},this.company.metadata)};this.saveFoundCompany(e)},saveFoundCompany:function(t){var e=this;axios.post(a.a.crm.update(),t).then((function(t){e.showSnackbar({icon:!1,button:{show:!0},text:trans("Company successfully saved")}),e.goToCompanyShowPage(t.data.id)}))},goToCompanyShowPage:function(t){this.$router.push({name:"companies.edit",params:{id:t}})}}),mounted:function(){this.toggleBreadcrumbs({show:!1})}},m=n(0),p=n(2),h=n.n(p),f=n(116),v=n(280),y=n(612),g=n(630),b=n(614),C=n(5),w=n(627),N=n(51),O=Object(m.a)(d,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("admin",[n("metatag",{attrs:{title:t.trans("Find Company")}}),t._v(" "),n("div",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","alt","."],expression:"['ctrl', 'alt', '.']",modifiers:{once:!0}}],on:{shortkey:t.saveDummyCompany}}),t._v(" "),n("v-row",[n("v-col",{attrs:{cols:"12"}},[n("v-row",{attrs:{justify:"center"}},[n("v-col",{attrs:{cols:"10"}},[n("div",{staticClass:"text-center mb-4"},[n("v-scale-transition",[t.companyFound?n("h1",{staticClass:"primary--text mb-1"},[t._v(t._s(t.trans("Company Found!")))]):n("h1",{staticClass:"primary--text mb-1"},[t._v(t._s(t.trans("Find Company")))])]),t._v(" "),n("p",{staticClass:"muted--text"},[t._v(t._s(t.trans("Try finding a company by its file number. It is usually 5-digits long.")))])],1),t._v(" "),n("v-card",{staticClass:"my-10"},[n("v-text-field",{staticClass:"dt-text-field__search",attrs:{label:t.trans("Search file number"),loading:t.searching,autofocus:"","clear-icon":"mdi-close-circle-outline",clearable:"",flat:"","full-width":"",height:"68","hide-details":"","prepend-inner-icon":"mdi-magnify",solo:""},nativeOn:{keydown:function(e){return t.search(e)}}})],1)],1)],1),t._v(" "),t.searching||t.results?t._e():n("div",[n("div",{staticClass:"text-center mt-9"},[n("search-icon",{staticClass:"primary--text",staticStyle:{filter:"grayscale(0.7)"}})],1)]),t._v(" "),n("v-slide-y-transition",{attrs:{mode:"in-out"}},[t.searching?n("div",[n("v-skeleton-loader",{staticClass:"px-4 py-3 d-block",attrs:{width:"100%",type:"table-thead, table-row@5"}})],1):t._e()]),t._v(" "),t.results?n("v-data-table",{staticClass:"mt-9",attrs:{headers:t.headers,items:t.companies},scopedSlots:t._u([{key:"item.actions",fn:function(e){var a=e.item;return[n("v-btn",{attrs:{color:"primary"},on:{click:function(e){return e.preventDefault(),t.goToNextStep(a)}}},[t._v(t._s(t.trans("Start")))])]}}],null,!1,740400130)}):t._e()],1)],1)],1)}),[],!1,null,null,null);e.default=O.exports;h()(O,{VBtn:f.a,VCard:v.a,VCol:y.a,VDataTable:g.a,VRow:b.a,VScaleTransition:C.e,VSkeletonLoader:w.a,VSlideYTransition:C.k,VTextField:N.a})},53:function(t,e,n){"use strict";e.a=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={applicant:{customer_id:null,metadata:{BusinessCounselorName:null,FileNo:null,FundingRequestNo:null,PeeBusinessCounselorName:null,SiteVisitDate:null,address:null,contact_person:null,designation:null,email:null,industry:null,name:null,number:null,staffstrength:null,website:null}},name:"",code:"",refnum:"",description:"",details:{customer_id:null,metadata:{business_size:null,description:null,funding_program:null,industry_sector:null,license_no:null,project_location:null,project_name:null,project_type:null,trade_name_ar:null,trade_name_en:null}},metadata:{type:"",applicant:{name:""}},financials:this.metadataOrig,reports:[]}}}}]);
//# sourceMappingURL=14.js.map