(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{29:function(e,t,s){"use strict";t.a={list:function(){return"/api/v1/users"},store:function(){return"/api/v1/users"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/restore/".concat(e)},trashed:function(){return"/api/v1/users/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/users/".concat(e)}}},292:function(e,t,s){"use strict";s.r(t);var a=s(29),r=s(75),i={name:"ChangePasswordField",props:{value:{type:[String]}},computed:{password:{get:function(){return this.value},set:function(e){this.$emit("input",e)}},passwordName:function(){return _.isEmpty(this.password)?"not-password":"password"},inputType:function(){return this.inputTypeIsPassword?"password":"text"},isDense:function(){return this.$vuetify.breakpoint.xlAndUp}},data:function(){return{inputTypeIsPassword:!0}},methods:{toggleVisibility:function(){this.inputTypeIsPassword=!this.inputTypeIsPassword}}},n=s(0),o=s(2),l=s.n(o),d=s(276),c=s(1),u=s(51),v=Object(n.a)(i,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("v-card",{staticClass:"mb-3"},[s("v-card-title",[e._v(e._s(e.trans("Change Password")))]),e._v(" "),s("v-card-subtitle",{staticClass:"muted--text"},[e._v(e._s(e.trans("You have the ability to change other people's passwords. Leave blank to use their old password.")))]),e._v(" "),s("v-card-text",[s("validation-provider",{attrs:{vid:"password",name:e.trans("password"),rules:"min:6"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{ref:"password",staticClass:"dt-text-field",attrs:{"append-icon":e.inputTypeIsPassword?"mdi-eye-off":"mdi-eye",dense:e.isDense,"error-messages":a,label:e.trans("Password"),name:e.passwordName,type:e.inputType,autocomplete:"new-password",outlined:"","prepend-inner-icon":"mdi-lock"},on:{"click:append":e.toggleVisibility},model:{value:e.password,callback:function(t){e.password=t},expression:"password"}})]}}])})],1)],1)}),[],!1,null,null,null),m=v.exports;l()(v,{VCard:d.a,VCardSubtitle:c.b,VCardText:c.c,VCardTitle:c.d,VTextField:u.a});var p=s(608),f=s(610),h=s(623),b=Object(n.a)({},(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("v-card",{staticClass:"mb-3"},[s("v-card-title",[e._v(e._s(e.trans("Account Information")))]),e._v(" "),s("v-card-text",[s("v-row",{attrs:{justify:"space-between"}},[s("v-col",{attrs:{cols:"6",md:"2"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"40",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"6",md:"2"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"40",type:"image"}})],1)],1),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"4"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"4"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"4"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1),e._v(" "),s("v-row",{attrs:{align:"center"}},[s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1),e._v(" "),s("v-card",[s("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.trans("Additional Background Details")))]),e._v(" "),s("v-card-text",[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}}),e._v(" "),s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1)}),[],!1,null,null,null),g=b.exports;l()(b,{VCard:d.a,VCardText:c.c,VCardTitle:c.d,VCol:p.a,VRow:f.a,VSkeletonLoader:h.a});var w=Object(n.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-card",[t("v-card-title",[this._v(this._s(this.trans("Roles")))]),this._v(" "),this._t("illustration",[t("div",{staticClass:"secondary--text text-center"},[t("shield-with-check-mark-icon")],1)]),this._v(" "),t("v-card-text",[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],2)}),[],!1,null,null,null),x=w.exports;l()(w,{VCard:d.a,VCardText:c.c,VCardTitle:c.d,VSkeletonLoader:h.a});var y=s(64),k=s(6);function C(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,a)}return s}function P(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?C(Object(s),!0).forEach((function(t){D(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):C(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function D(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var S={beforeRouteLeave:function(e,t,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},components:{AccountDetails:r.a,ChangePasswordField:m,SkeletonEdit:g,SkeletonRolePicker:x},computed:P({},Object(k.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),data:function(){return{resource:new y.a,isValid:!0,loading:!0}},methods:P({},Object(k.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,552))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,552))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"users.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},parseResourceData:function(e){var t=_.clone(e);t.details=Object.assign({},t.details,t.details.others||{}),delete t.details.others;var s=new FormData(this.$refs["updateform-form"].$el);for(var a in s.append("username",t.username),s.append("email",t.email),t.details){var r=t.details[a],i=r.key,n=r.icon,o=null==r.value||"undefined"==r.value||"null"==r.value||null==r.value?"":r.value;s.append("details[".concat(r.key,"][key]"),i),s.append("details[".concat(r.key,"][icon]"),n),s.append("details[".concat(r.key,"][value]"),o)}return s.append("_method","put"),t=s},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),this.hideErrorbox(),e.preventDefault(),axios.post(a.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){t.showSnackbar({text:trans("User updated successfully")}),t.showSuccessbox({text:trans("Updated User {name}",{name:t.resource.data.displayname}),buttons:{show:{code:"users.show",to:{name:"users.show",params:{id:t.resource.data.id}},icon:"mdi-account-search-outline",text:trans("View Details")},create:{code:"users.create",to:{name:"users.create"},icon:"mdi-account-plus-outline",text:trans("Add New User")}}}),t.$refs.updateform.reset(),t.resource.isPrestine=!0})).catch((function(e){if(e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},getResource:function(){var e=this;axios.get(a.a.show(this.$route.params.id)).then((function(t){e.resource.data=Object.assign(t.data.data,{details:Object.assign(e.resource.data.details,t.data.data.details)})})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))}}),mounted:function(){this.getResource()},watch:{"resource.password":function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},F=s(615),V=s(111),$=s(609),O=s(5),T=s(622),j=s(98),A=s(42),E=s(611),M=s(20),R=Object(n.a)(S,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Update"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.resource.data.displayname}}),e._v(" "),e._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var a=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),a(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"users.index"},text:e.trans("Users")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("Edit User"))+"\n        ")]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"9"}},[e.isFetchingResource?[s("skeleton-edit")]:e._e(),e._v(" "),s("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-card-title",[e._v(e._s(e.trans("Account Information")))]),e._v(" "),s("v-card-text",[s("v-row",{attrs:{justify:"space-between"}},[s("v-col",{attrs:{cols:"6",md:"2"}},[s("v-select",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,items:["Mr.","Ms.","Mrs."],label:e.trans("Prefix"),"append-icon":"mdi-chevron-down","background-color":"selects",dense:"","hide-details":"",outlined:""},model:{value:e.resource.data.prefixname,callback:function(t){e.$set(e.resource.data,"prefixname",t)},expression:"resource.data.prefixname"}}),e._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:e.resource.data.prefixname,expression:"resource.data.prefixname"}],attrs:{type:"hidden",name:"prefixname"},domProps:{value:e.resource.data.prefixname},on:{input:function(t){t.target.composing||e.$set(e.resource.data,"prefixname",t.target.value)}}})],1),e._v(" "),s("v-col",{attrs:{cols:"6",md:"2"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{disabled:e.isLoading,"hide-details":"",label:e.trans("Suffix"),name:"suffixname",outlined:"",dense:""},model:{value:e.resource.data.suffixname,callback:function(t){e.$set(e.resource.data,"suffixname",t)},expression:"resource.data.suffixname"}})],1)],1),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"4"}},[s("validation-provider",{attrs:{vid:"firstname",name:e.trans("first name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("First name"),autofocus:"",name:"firstname",outlined:"","prepend-inner-icon":"mdi-account-outline"},model:{value:e.resource.data.firstname,callback:function(t){e.$set(e.resource.data,"firstname",t)},expression:"resource.data.firstname"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"4"}},[s("validation-provider",{attrs:{vid:"middlename",name:e.trans("middle name")},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Middle name"),name:"middlename",outlined:""},model:{value:e.resource.data.middlename,callback:function(t){e.$set(e.resource.data,"middlename",t)},expression:"resource.data.middlename"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"4"}},[s("validation-provider",{attrs:{vid:"lastname",name:e.trans("last name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Last name"),name:"lastname",outlined:""},model:{value:e.resource.data.lastname,callback:function(t){e.$set(e.resource.data,"lastname",t)},expression:"resource.data.lastname"}})]}}],null,!0)})],1)],1),e._v(" "),s("v-row",{attrs:{align:"center"}},[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"details[Mobile Phone]",name:e.trans("Mobile phone")},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Mobile phone"),name:"details[Mobile Phone][value]",outlined:"","prepend-inner-icon":"mdi-cellphone-android"},model:{value:e.resource.data.details["Mobile Phone"].value,callback:function(t){e.$set(e.resource.data.details["Mobile Phone"],"value",t)},expression:"resource.data.details['Mobile Phone'].value"}})]}}],null,!0)}),e._v(" "),s("input",{attrs:{type:"hidden",name:"details[Mobile Phone][key]"},domProps:{value:e.trans(e.resource.data.details["Mobile Phone"].key)}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"details[Mobile Phone][icon]"},domProps:{value:e.resource.data.details["Mobile Phone"].icon}})],1)],1),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"details[Home Address]",name:e.trans("Home address")},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Home address"),name:"details[Home Address][value]",outlined:"","prepend-inner-icon":"mdi-cellphone-android"},model:{value:e.resource.data.details["Home Address"].value,callback:function(t){e.$set(e.resource.data.details["Home Address"],"value",t)},expression:"resource.data.details['Home Address'].value"}})]}}],null,!0)}),e._v(" "),s("input",{attrs:{type:"hidden",name:"details[Home Address][key]"},domProps:{value:e.trans(e.resource.data.details["Home Address"].key)}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"details[Home Address][icon]"},domProps:{value:e.resource.data.details["Home Address"].icon}})],1)],1)],1)],1),e._v(" "),s("account-details",{model:{value:e.resource,callback:function(t){e.resource=t},expression:"resource"}}),e._v(" "),s("can",{attrs:{code:"password.change"}},[s("change-password-field",{model:{value:e.resource.password,callback:function(t){e.$set(e.resource,"password",t)},expression:"resource.password"}})],1),e._v(" "),s("v-card",[s("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.trans("Additional Background Details")))]),e._v(" "),s("v-card-text",[s("repeater",{attrs:{dense:e.isDense,disabled:e.isLoading},model:{value:e.resource.data.details.others,callback:function(t){e.$set(e.resource.data.details,"others",t)},expression:"resource.data.details.others"}})],1)],1)],2),e._v(" "),s("v-col",{attrs:{cols:"12",md:"3"}},[e.isFetchingResource?[s("skeleton-avatar")]:e._e(),e._v(" "),s("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.__("Photo")))]),e._v(" "),s("v-card-text",{staticClass:"text-center"},[s("upload-avatar",{attrs:{name:"photo"},model:{value:e.resource.data.avatar,callback:function(t){e.$set(e.resource.data,"avatar",t)},expression:"resource.data.avatar"}})],1)],1),e._v(" "),e.isFetchingResource?[s("skeleton-role-picker")]:e._e(),e._v(" "),s("role-picker",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3",attrs:{dense:e.isDense,disabled:e.isLoading},model:{value:e.resource.data.roles,callback:function(t){e.$set(e.resource.data,"roles",t)},expression:"resource.data.roles"}}),e._v(" "),e.isFetchingResource?[s("skeleton-metainfo-card")]:e._e(),e._v(" "),s("metainfo-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{list:e.metaInfoCardList}})],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=R.exports;l()(R,{VBadge:F.a,VBtn:V.a,VCard:d.a,VCardText:c.c,VCardTitle:c.d,VCol:p.a,VContainer:$.a,VFadeTransition:O.d,VForm:T.a,VIcon:j.a,VRow:f.a,VSelect:A.a,VSpacer:E.a,VTextField:u.a,VToolbarTitle:M.a})},64:function(e,t,s){"use strict";function a(e,t){for(var s=0;s<t.length;s++){var a=t[s];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}var r=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.password=null,this.data={prefixname:"",firstname:"",middlename:"",lastname:"",suffixname:"",username:"",email:"",password:"",password_confirmation:"",photo:"",modified:"",details:{Gender:{key:trans("Gender"),value:"",icon:""},Birthday:{key:trans("Birthday"),value:"",icon:"mdi-cake-variant"},"Marital Status":{key:trans("Marital Status"),value:"",icon:""},"Mobile Phone":{key:trans("Mobile Phone"),value:"",icon:"mdi-cellphone-android"},"Home Address":{key:trans("Home Address"),value:"",icon:"mdi-map-marker"},others:[]},roles:[]},this.gender={items:[{color:"gray",icon:"mdi-help",key:"Gender",value:"None"},{color:"blue",icon:"mdi-gender-male",key:"Gender",value:"Male"},{color:"pink",icon:"mdi-gender-female",key:"Gender",value:"Female"},{color:"gray",icon:"mdi-gender-male-female",key:"Gender",value:"Unspecified"}]},this.maritalStatus={items:[{icon:"mdi-checkbox-blank-circle-outline",key:"Marital Status",value:"Unspecified"},{icon:"mdi-human-handsup",key:"Marital Status",value:"Single"},{icon:"mdi-human-male-female",key:"Marital Status",value:"Married"},{icon:"mdi-ring",key:"Marital Status",value:"Widowed"},{icon:"mdi-heart-broken",key:"Marital Status",value:"Separated"}]}}var t,s,r;return t=e,(s=[{key:"changeMaritalStatusIcon",value:function(e){return e&&e.icon||"mdi-checkbox-blank-circle-outline"}},{key:"changeGenderIcon",value:function(e){return e&&e.icon||"mdi-gender-male-female"}}])&&a(t.prototype,s),r&&a(t,r),e}();t.a=r},75:function(e,t,s){"use strict";s(64);var a={name:"AccountDetails",props:{value:{type:[Array,Object]},confirmed:{type:[Boolean]},password:{type:[Boolean]}},computed:{resource:{get:function(){return this.value},set:function(e){this.$emit("input",e)}},hasPassword:function(){return this.password},isDense:function(){return this.$vuetify.breakpoint.xlAndUp}}},r=s(0),i=s(2),n=s.n(i),o=s(276),l=s(1),d=s(608),c=s(610),u=s(51),v=Object(r.a)(a,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("v-card",{staticClass:"mb-3"},[s("v-card-title",[e._v(e._s(e.trans("Account Details")))]),e._v(" "),s("v-card-subtitle",{staticClass:"muted--text"},[e._v(e._s(e.trans("Fields will be used to sign in to the app")))]),e._v(" "),s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"email",name:e.trans("email address"),rules:"required|email"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":a,label:e.trans("Email address"),name:"email",outlined:"","prepend-inner-icon":"mdi-email-outline",type:"email"},model:{value:e.resource.data.email,callback:function(t){e.$set(e.resource.data,"email",t)},expression:"resource.data.email"}})]}}])})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"username",name:e.trans("username"),rules:"required|min:3"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":a,label:e.trans("Username"),autocomplete:"off",name:"username",outlined:"","prepend-inner-icon":"mdi-account-outline"},model:{value:e.resource.data.username,callback:function(t){e.$set(e.resource.data,"username",t)},expression:"resource.data.username"}})]}}])})],1),e._v(" "),e.hasPassword?s("v-col",{attrs:{cols:"12",md:e.confirmed?6:12}},[s("validation-provider",{attrs:{vid:"password",name:e.trans("password"),rules:"required|min:6"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{ref:"password",staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":a,label:e.trans("Password"),autocomplete:"new-password",name:"password",outlined:"","prepend-inner-icon":"mdi-lock",type:"password"},model:{value:e.resource.data.password,callback:function(t){e.$set(e.resource.data,"password",t)},expression:"resource.data.password"}})]}}],null,!1,409301405)})],1):e._e(),e._v(" "),e.hasPassword&&e.confirmed?s("v-col",{attrs:{cols:"12",md:"6"}},[s("validation-provider",{attrs:{vid:"password_confirmation",name:e.trans("confirm password"),rules:"required|confirmed:password|min:6"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,"error-messages":a,label:e.trans("Retype Password"),autocomplete:"new-password",name:"password_confirmation",outlined:"","prepend-inner-icon":"mdi-lock",type:"password"},model:{value:e.resource.data.password_confirmation,callback:function(t){e.$set(e.resource.data,"password_confirmation",t)},expression:"resource.data.password_confirmation"}})]}}],null,!1,4171517130)})],1):e._e()],1)],1)],1)}),[],!1,null,null,null);t.a=v.exports;n()(v,{VCard:o.a,VCardSubtitle:l.b,VCardText:l.c,VCardTitle:l.d,VCol:d.a,VRow:c.a,VTextField:u.a})}}]);
//# sourceMappingURL=11.js.map