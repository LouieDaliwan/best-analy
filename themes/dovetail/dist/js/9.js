(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{28:function(e,t,a){"use strict";t.a={list:function(){return"/api/v1/users"},store:function(){return"/api/v1/users"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/restore/".concat(e)},trashed:function(){return"/api/v1/users/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(e)}}},319:function(e,t,a){"use strict";a.r(t);var s=a(28),r=a(71),n=a(61),o=a(6);function i(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,s)}return a}function l(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?i(Object(a),!0).forEach((function(t){d(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function d(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var c={beforeRouteLeave:function(e,t,a){this.isFormPrestine?a():this.askUserBeforeNavigatingAway(a)},components:{AccountDetails:r.a},computed:l({},Object(o.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isNotFormDisabled:function(){return!this.isFormDisabled},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},form:function(){return this.$refs.addform}}),data:function(){return{resource:new n.a}},methods:l({},Object(o.b)({showAlertbox:"alertbox/show",hideAlertbox:"alertbox/hide",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",showSuccessbox:"successbox/show",hideSuccessbox:"successbox/hide"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,525))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,525))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"users.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},parseResourceData:function(e){var t=_.clone(e),a=new FormData(this.$refs["addform-form"].$el);for(var s in t.details=Object.assign({},t.details,t.details.others||{}),delete t.details.others,a.append("username",t.username),a.append("email",t.email),t.details){var r=t.details[s],n=r.key,o=r.icon,i=null==r.value||"undefined"==r.value||"null"==r.value||null==r.value?"":r.value;a.append("details[".concat(r.key,"][key]"),n),a.append("details[".concat(r.key,"][icon]"),o),a.append("details[".concat(r.key,"][value]"),i)}return t=a},parseErrors:function(e){return this.form.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isNotFormDisabled&&(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),e.preventDefault(),this.hideAlertbox(),axios.post(s.a.store(),this.parseResourceData(this.resource.data),{headers:{"Content-Type":"multipart/form-data"}}).then((function(e){t.resource.isPrestine=!0,t.showSnackbar({text:trans("User created successfully")}),t.$router.push({name:"users.edit",params:{id:e.data.data.id},query:{success:!0}}),t.showSuccessbox({text:trans("Updated User {name}",{name:e.data.data.displayname}),buttons:{show:{code:"users.show",to:{name:"users.show",params:{id:e.data.data.id}},icon:"mdi-account-search-outline",text:trans("View Details")},create:{code:"users.create",to:{name:"users.create"},icon:"mdi-account-plus-outline",text:trans("Add New User")}}})})).catch((function(e){t.form.setErrors(e.response.data.errors)})).finally((function(){t.load(!1)}))}}),watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.addform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},u=a(0),m=a(2),v=a.n(m),f=a(587),p=a(104),h=a(262),b=a(1),y=a(580),x=a(581),g=a(5),k=a(594),w=a(91),P=a(582),D=a(42),C=a(583),S=a(48),A=a(20),M=Object(u.a)(c,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[a("v-container",{staticClass:"py-0 px-0"},[a("v-row",{attrs:{justify:"space-between",align:"center"}},[a("v-fade-transition",[e.isNotFormPrestine?a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),a("v-spacer"),e._v(" "),a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("div",{staticClass:"d-flex justify-end"},[a("v-spacer"),e._v(" "),a("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),a("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[a("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[a("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[a("metatag",{attrs:{title:e.trans("Add User")}}),e._v(" "),e._v(" "),a("validation-observer",{ref:"addform",scopedSlots:e._u([{key:"default",fn:function(t){var s=t.handleSubmit;t.errors,t.invalid,t.passed;return[a("v-form",{ref:"addform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),s(e.submit(t))}}},[a("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),a("page-header",{attrs:{back:{to:{name:"users.index"},text:e.trans("Users")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.trans("Add User")))]},proxy:!0}],null,!0)}),e._v(" "),a("alertbox"),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"9"}},[a("v-card",{staticClass:"mb-3"},[a("v-card-title",[e._v(e._s(e.trans("Account Information")))]),e._v(" "),a("v-card-text",[a("v-row",{attrs:{justify:"space-between"}},[a("v-col",{attrs:{cols:"6",md:"2"}},[a("v-select",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,items:["Mr.","Ms.","Mrs."],label:e.trans("Prefix"),"append-icon":"mdi-chevron-down","background-color":"selects",dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.prefixname,callback:function(t){e.$set(e.resource.data,"prefixname",t)},expression:"resource.data.prefixname"}}),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.resource.data.prefixname,expression:"resource.data.prefixname"}],attrs:{type:"hidden",name:"prefixname"},domProps:{value:e.resource.data.prefixname},on:{input:function(t){t.target.composing||e.$set(e.resource.data,"prefixname",t.target.value)}}})],1),e._v(" "),a("v-col",{attrs:{cols:"6",md:"2"}},[a("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,"hide-details":"",label:e.trans("Suffix"),name:"suffixname",outlined:"",dense:""},model:{value:e.resource.data.suffixname,callback:function(t){e.$set(e.resource.data,"suffixname",t)},expression:"resource.data.suffixname"}})],1)],1),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"4"}},[a("validation-provider",{attrs:{vid:"firstname",name:e.trans("first name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("First name"),autofocus:"",name:"firstname",outlined:"","prepend-inner-icon":"mdi-account-outline"},model:{value:e.resource.data.firstname,callback:function(t){e.$set(e.resource.data,"firstname",t)},expression:"resource.data.firstname"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"4"}},[a("validation-provider",{attrs:{vid:"middlename",name:e.trans("middle name")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Middle name"),name:"middlename",outlined:""},model:{value:e.resource.data.middlename,callback:function(t){e.$set(e.resource.data,"middlename",t)},expression:"resource.data.middlename"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"4"}},[a("validation-provider",{attrs:{vid:"lastname",name:e.trans("last name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Last name"),name:"lastname",outlined:""},model:{value:e.resource.data.lastname,callback:function(t){e.$set(e.resource.data,"lastname",t)},expression:"resource.data.lastname"}})]}}],null,!0)})],1)],1),e._v(" "),a("v-row",{attrs:{align:"center"}},[a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"details[Mobile Phone]",name:e.trans("Mobile phone")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Mobile phone"),name:"details[Mobile Phone][value]",outlined:"","prepend-inner-icon":"mdi-cellphone-android"},model:{value:e.resource.data.details["Mobile Phone"].value,callback:function(t){e.$set(e.resource.data.details["Mobile Phone"],"value",t)},expression:"resource.data.details['Mobile Phone'].value"}})]}}],null,!0)}),e._v(" "),a("input",{attrs:{type:"hidden",name:"details[Mobile Phone][key]"},domProps:{value:e.trans(e.resource.data.details["Mobile Phone"].key)}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"details[Mobile Phone][icon]"},domProps:{value:e.resource.data.details["Mobile Phone"].icon}})],1)],1),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"details[Home Address]",name:e.trans("Home address")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Home address"),name:"details[Home Address][value]",outlined:"","prepend-inner-icon":"mdi-cellphone-android"},model:{value:e.resource.data.details["Home Address"].value,callback:function(t){e.$set(e.resource.data.details["Home Address"],"value",t)},expression:"resource.data.details['Home Address'].value"}})]}}],null,!0)}),e._v(" "),a("input",{attrs:{type:"hidden",name:"details[Home Address][key]"},domProps:{value:e.trans(e.resource.data.details["Home Address"].key)}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"details[Home Address][icon]"},domProps:{value:e.resource.data.details["Home Address"].icon}})],1)],1)],1)],1),e._v(" "),a("can",{attrs:{code:"password.change"}},[a("account-details",{attrs:{password:"",confirmed:""},model:{value:e.resource,callback:function(t){e.resource=t},expression:"resource"}})],1),e._v(" "),a("v-card",[a("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.trans("Additional Background Details")))]),e._v(" "),a("v-card-text",[a("repeater",{attrs:{dense:e.isDense,disabled:e.isLoading},model:{value:e.resource.data.details.others,callback:function(t){e.$set(e.resource.data.details,"others",t)},expression:"resource.data.details.others"}})],1)],1)],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"3"}},[a("v-card",{staticClass:"mb-3"},[a("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.__("Photo")))]),e._v(" "),a("v-card-text",{staticClass:"text-center"},[a("upload-avatar",{attrs:{name:"photo"},model:{value:e.resource.data.avatar,callback:function(t){e.$set(e.resource.data,"avatar",t)},expression:"resource.data.avatar"}})],1)],1),e._v(" "),a("role-picker",{staticClass:"mb-3",attrs:{dense:e.isDense,disabled:e.isLoading},model:{value:e.resource.data.roles,callback:function(t){e.$set(e.resource.data,"roles",t)},expression:"resource.data.roles"}})],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=M.exports;v()(M,{VBadge:f.a,VBtn:p.a,VCard:h.a,VCardText:b.c,VCardTitle:b.d,VCol:y.a,VContainer:x.a,VFadeTransition:g.c,VForm:k.a,VIcon:w.a,VRow:P.a,VSelect:D.a,VSpacer:C.a,VTextField:S.a,VToolbarTitle:A.a})},61:function(e,t,a){"use strict";function s(e,t){for(var a=0;a<t.length;a++){var s=t[a];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(e,s.key,s)}}var r=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.password=null,this.data={prefixname:"",firstname:"",middlename:"",lastname:"",suffixname:"",username:"",email:"",password:"",password_confirmation:"",photo:"",modified:"",details:{Gender:{key:trans("Gender"),value:"",icon:""},Birthday:{key:trans("Birthday"),value:"",icon:"mdi-cake-variant"},"Marital Status":{key:trans("Marital Status"),value:"",icon:""},"Mobile Phone":{key:trans("Mobile Phone"),value:"",icon:"mdi-cellphone-android"},"Home Address":{key:trans("Home Address"),value:"",icon:"mdi-map-marker"},others:[]},roles:[]},this.gender={items:[{color:"gray",icon:"mdi-help",key:"Gender",value:"None"},{color:"blue",icon:"mdi-gender-male",key:"Gender",value:"Male"},{color:"pink",icon:"mdi-gender-female",key:"Gender",value:"Female"},{color:"gray",icon:"mdi-gender-male-female",key:"Gender",value:"Unspecified"}]},this.maritalStatus={items:[{icon:"mdi-checkbox-blank-circle-outline",key:"Marital Status",value:"Unspecified"},{icon:"mdi-human-handsup",key:"Marital Status",value:"Single"},{icon:"mdi-human-male-female",key:"Marital Status",value:"Married"},{icon:"mdi-ring",key:"Marital Status",value:"Widowed"},{icon:"mdi-heart-broken",key:"Marital Status",value:"Separated"}]}}var t,a,r;return t=e,(a=[{key:"changeMaritalStatusIcon",value:function(e){return e&&e.icon||"mdi-checkbox-blank-circle-outline"}},{key:"changeGenderIcon",value:function(e){return e&&e.icon||"mdi-gender-male-female"}}])&&s(t.prototype,a),r&&s(t,r),e}();t.a=r},71:function(e,t,a){"use strict";a(61);var s={name:"AccountDetails",props:{value:{type:[Array,Object]},confirmed:{type:[Boolean]},password:{type:[Boolean]}},computed:{resource:{get:function(){return this.value},set:function(e){this.$emit("input",e)}},hasPassword:function(){return this.password},isDense:function(){return this.$vuetify.breakpoint.xlAndUp}}},r=a(0),n=a(2),o=a.n(n),i=a(262),l=a(1),d=a(580),c=a(582),u=a(48),m=Object(r.a)(s,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-card",{staticClass:"mb-3"},[a("v-card-title",[e._v(e._s(e.trans("Account Details")))]),e._v(" "),a("v-card-subtitle",{staticClass:"muted--text"},[e._v(e._s(e.trans("Fields will be used to sign in to the app")))]),e._v(" "),a("v-card-text",[a("v-row",[a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"email",name:e.trans("email address"),rules:"required|email"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":s,label:e.trans("Email address"),name:"email",outlined:"","prepend-inner-icon":"mdi-email-outline",type:"email"},model:{value:e.resource.data.email,callback:function(t){e.$set(e.resource.data,"email",t)},expression:"resource.data.email"}})]}}])})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"username",name:e.trans("username"),rules:"required|min:3"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":s,label:e.trans("Username"),autocomplete:"off",name:"username",outlined:"","prepend-inner-icon":"mdi-account-outline"},model:{value:e.resource.data.username,callback:function(t){e.$set(e.resource.data,"username",t)},expression:"resource.data.username"}})]}}])})],1),e._v(" "),e.hasPassword?a("v-col",{attrs:{cols:"12",md:e.confirmed?6:12}},[a("validation-provider",{attrs:{vid:"password",name:e.trans("password"),rules:"required|min:6"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{ref:"password",staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":s,label:e.trans("Password"),autocomplete:"new-password",name:"password",outlined:"","prepend-inner-icon":"mdi-lock",type:"password"},model:{value:e.resource.data.password,callback:function(t){e.$set(e.resource.data,"password",t)},expression:"resource.data.password"}})]}}],null,!1,409301405)})],1):e._e(),e._v(" "),e.hasPassword&&e.confirmed?a("v-col",{attrs:{cols:"12",md:"6"}},[a("validation-provider",{attrs:{vid:"password_confirmation",name:e.trans("confirm password"),rules:"required|confirmed:password|min:6"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":s,label:e.trans("Retype Password"),autocomplete:"new-password",name:"password_confirmation",outlined:"","prepend-inner-icon":"mdi-lock",type:"password"},model:{value:e.resource.data.password_confirmation,callback:function(t){e.$set(e.resource.data,"password_confirmation",t)},expression:"resource.data.password_confirmation"}})]}}],null,!1,4171517130)})],1):e._e()],1)],1)],1)}),[],!1,null,null,null);t.a=m.exports;o()(m,{VCard:i.a,VCardSubtitle:l.b,VCardText:l.c,VCardTitle:l.d,VCol:d.a,VRow:c.a,VTextField:u.a})}}]);
//# sourceMappingURL=9.js.map