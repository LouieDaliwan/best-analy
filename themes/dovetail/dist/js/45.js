(window.webpackJsonp=window.webpackJsonp||[]).push([[45],{291:function(e,t,a){"use strict";a.r(t);var n=a(12),s=a(9),o=a(45),r=a(22);window.CRM_CODE_FILE_NUMBER_FOUND=1,window.CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST=4;window.CRM_CODE_FILE_NUMBER_FOUND;var i=window.CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST,u=a(6);function c(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function l(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var m={store:r.a,data:function(){return{results:!1,searching:!1,companyFound:!1,query:"",errors:[],headers:[{text:"Company Name",align:"left",value:"CompanyName"},{text:"Funding Request No.",align:"left",value:"FundingRequestNo"},{text:"Business Counselor Name",align:"left",value:"BusinessCounselorName"},{text:"Status",align:"left",value:"Status"},{text:"",align:"left",value:"actions"}],companies:[],company:new o.a}},methods:function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?c(Object(a),!0).forEach((function(t){l(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):c(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}({},Object(u.b)({loadDialog:"dialog/loading",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",toggleBreadcrumbs:"breadcrumbs/toggle"}),{search:_.debounce((function(e){var t=this;this.query=e.srcElement.value||"",this.searching=!0,this.companyFound=!1,_.isEmpty(this.query)||this.searchForCompanyInCrm(this.query),setTimeout((function(){t.searching=!1}),3e3)}),920),searchForCompanyInCrm:function(e){var t=this;axios.get(n.a.crm.search(e)).then((function(e){var a=e.data,n=a.Code,s=a.Message,o=a.Content;if(n==i)return t.errors.push(s),t.showSnackbar({icon:!1,button:{show:!0},text:t.trans(s)});n==CRM_CODE_FILE_NUMBER_FOUND&&(t.companyFound=!0,t.results=!0,t.companies.push(o))})).catch((function(e){t.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,261))},title:trans("Internal Error"),width:400,text:trans("Incorrect file number input. Please try again."),buttons:{cancel:!1}})})).finally((function(){t.searching=!1}))},goToNextStep:function(e){this.prepFoundCompany(e)},saveDummyCompany:function(){var e=this.query||Math.random(),t={name:"Dummy Company "+Math.random(),code:this.slugify("Dummy Company "+Math.random()),refnum:e,status:"Pending",token:"09-09090909-090909-0909-dummy",user_id:s.default.getId(),metadata:Object.assign({FileNo:e,FundingRequestNo:e,SiteVisitDate:new Date,BusinessCounselorName:Math.random(),PeeBusinessCounselorName:Math.random()},this.company.metadata)};this.saveFoundCompany(t)},prepFoundCompany:function(e){var t={name:e.CompanyName,code:this.slugify(e.CompanyName),refnum:this.query,status:e.Status,token:e.Id,user_id:s.default.getId(),metadata:Object.assign({FileNo:this.query,FundingRequestNo:e.FundingRequestNo,SiteVisitDate:e.SiteVisitDate||null,BusinessCounselorName:e.BusinessCounselorName,PeeBusinessCounselorName:e.PeeBusinessCounselorName},this.company.metadata)};this.saveFoundCompany(t)},saveFoundCompany:function(e){var t=this;axios.post(n.a.crm.update(),e).then((function(e){t.showSnackbar({icon:!1,button:{show:!0},text:trans("Company successfully saved")}),t.goToCompanyShowPage(e.data.id)}))},goToCompanyShowPage:function(e){this.$router.push({name:"companies.edit",params:{id:e}})}}),mounted:function(){this.toggleBreadcrumbs({show:!1})}},d=a(0),h=a(2),p=a.n(h),y=a(107),f=a(264),g=a(583),v=a(600),b=a(585),C=a(5),w=a(598),O=a(50),N=Object(d.a)(m,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("admin",[a("metatag",{attrs:{title:e.trans("Find Company")}}),e._v(" "),a("div",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","alt","."],expression:"['ctrl', 'alt', '.']",modifiers:{once:!0}}],on:{shortkey:e.saveDummyCompany}}),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12"}},[a("v-row",{attrs:{justify:"center"}},[a("v-col",{attrs:{cols:"10"}},[a("div",{staticClass:"text-center mb-4"},[a("v-scale-transition",[e.companyFound?a("h1",{staticClass:"primary--text mb-1"},[e._v(e._s(e.trans("Company Found!")))]):a("h1",{staticClass:"primary--text mb-1"},[e._v(e._s(e.trans("Find Company")))])]),e._v(" "),a("p",{staticClass:"muted--text"},[e._v(e._s(e.trans("Try finding a company by its file number. It is usually 5-digits long.")))])],1),e._v(" "),a("v-card",{staticClass:"my-10"},[a("v-text-field",{staticClass:"dt-text-field__search",attrs:{label:e.trans("Search file number"),loading:e.searching,autofocus:"","clear-icon":"mdi-close-circle-outline",clearable:"",flat:"","full-width":"",height:"68","hide-details":"","prepend-inner-icon":"mdi-magnify",solo:""},nativeOn:{keydown:function(t){return e.search(t)}}})],1)],1)],1),e._v(" "),e.searching||e.results?e._e():a("div",[a("div",{staticClass:"text-center mt-9"},[a("search-icon",{staticClass:"primary--text",staticStyle:{filter:"grayscale(0.7)"}})],1)]),e._v(" "),a("v-slide-y-transition",{attrs:{mode:"in-out"}},[e.searching?a("div",[a("v-skeleton-loader",{staticClass:"px-4 py-3 d-block",attrs:{width:"100%",type:"table-thead, table-row@5"}})],1):e._e()]),e._v(" "),e.results?a("v-data-table",{staticClass:"mt-9",attrs:{headers:e.headers,items:e.companies},scopedSlots:e._u([{key:"item.actions",fn:function(t){var n=t.item;return[a("v-btn",{attrs:{color:"primary"},on:{click:function(t){return t.preventDefault(),e.goToNextStep(n)}}},[e._v(e._s(e.trans("Start")))])]}}],null,!1,740400130)}):e._e()],1)],1)],1)}),[],!1,null,null,null);t.default=N.exports;p()(N,{VBtn:y.a,VCard:f.a,VCol:g.a,VDataTable:v.a,VRow:b.a,VScaleTransition:C.d,VSkeletonLoader:w.a,VSlideYTransition:C.j,VTextField:O.a})}}]);
//# sourceMappingURL=45.js.map