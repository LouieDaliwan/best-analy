(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{316:function(e,t,s){"use strict";s.r(t);var r=s(9),a=s(14),i=s(42),n=s(6);function o(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function c(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?o(Object(s),!0).forEach((function(t){l(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):o(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function l(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var d={beforeRouteLeave:function(e,t,s){this.isFormPrestine?s():this.askUserBeforeNavigatingAway(s)},computed:c({},Object(n.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isNotFormDisabled:function(){return!this.isFormDisabled},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},form:function(){return this.$refs.addform},filter:function(){}}),data:function(){return{auth:r.default.getUser(),resource:new i.a,search:"",searchSelectedMember:""}},methods:c({},Object(n.b)({showAlertbox:"alertbox/show",hideAlertbox:"alertbox/hide",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",showSuccessbox:"successbox/show",hideSuccessbox:"successbox/hide"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,540))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,540))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"teams.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},parseResourceData:function(e){_.clone(e);return new FormData(this.$refs["addform-form"].$el)},parseErrors:function(e){return this.form.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isNotFormDisabled&&(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},displayUsersList:function(){var e=this;axios.get(a.a.users.list(),{params:{per_page:"-1"}}).then((function(t){e.resource.users=Object.assign([],e.resource.users,t.data.data),e.resource.usersTotal=t.data.meta.last_page,e.resource.users=e.resource.users.map((function(e,t){return Object.assign(e,{key:e.id,name:e.displayname+" "+e.username+" "+e.email,order:t})}))}))},submit:function(e){var t=this;this.load(),e.preventDefault(),this.hideAlertbox(),axios.post(a.a.store(),this.parseResourceData(this.resource.data)).then((function(e){t.resource.isPrestine=!0,t.showSnackbar({text:trans("Team created successfully")}),t.$router.push({name:"teams.edit",params:{id:e.data.id},query:{success:!0}}),t.showSuccessbox({text:trans("Created Team {name}",{name:e.data.name}),buttons:{show:{code:"teams.index",to:{name:"teams.index",params:{id:e.data.id}},icon:"mdi-open-in-new",text:trans("View All Teams")},create:{code:"teams.create",to:{name:"teams.create"},icon:"mdi-shield-plus-outline",text:trans("Add New Team")}}})})).catch((function(e){t.form.setErrors(e.response.data.errors)})).finally((function(){t.load(!1)}))}}),mounted:function(){this.displayUsersList()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.addform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},u=s(0),m=s(2),v=s.n(m),f=s(262),h=s(584),p=s(105),b=s(260),g=s(1),x=s(577),y=s(578),w=s(263),k=s(4),C=s(591),D=s(91),P=s(123),O=s(579),S=s(580),j=s(48),T=s(582),V=s(20),F=Object(u.a)(d,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.trans("Add Team")}}),e._v(" "),s("back-to-top"),e._v(" "),e._v(" "),s("validation-observer",{ref:"addform",scopedSlots:e._u([{key:"default",fn:function(t){var r=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"addform-form",attrs:{disabled:e.isLoading,autocomplete:"false"},on:{submit:function(t){t.preventDefault(),r(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"teams.index"},text:e.trans("Teams")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.trans("Add Team")))]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("v-card",{staticClass:"mb-3"},[s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"name",name:e.trans("name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Name"),autofocus:"",name:"name",outlined:""},model:{value:e.resource.data.name,callback:function(t){e.$set(e.resource.data,"name",t)},expression:"resource.data.name"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"code",rules:"required",name:e.trans("code")},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Code"),value:e.slugify(e.resource.data.name),name:"code",outlined:""}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"manager_id",rules:"required",name:e.trans("manager_id")},scopedSlots:e._u([{key:"default",fn:function(t){t.errors;return[s("manager-picker",{attrs:{dense:e.isDense,disabled:e.isLoading,name:"manager_id"},model:{value:e.resource.managers,callback:function(t){e.$set(e.resource,"managers",t)},expression:"resource.managers"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description"),"auto-grow":"","hide-details":"",name:"description",outlined:""}})],1),e._v(" "),s("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.auth.id}})],1)],1),e._v(" "),s("div",{staticClass:"d-flex mb-4"},[s("v-divider"),e._v(" "),s("v-icon",{staticClass:"mx-3 mt-n2",attrs:{small:"",color:"muted"}},[e._v("mdi-account-settings")]),e._v(" "),s("v-divider")],1),e._v(" "),s("v-row",[s("v-col",{staticClass:"pt-0"},[s("v-card-text",{staticClass:"pt-0"},[s("h4",{staticClass:"mb-5",domProps:{textContent:e._s(e.trans("Select Members"))}}),e._v(" "),s("treeview-field",{model:{value:e.search,callback:function(t){e.search=t},expression:"search"}}),e._v(" "),s("validation-provider",{attrs:{vid:"users",name:"users[]",rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return e._l(r,(function(t){return s("v-card-text",{key:t,staticClass:"error--text",domProps:{innerHTML:e._s(t)}})}))}}],null,!0)}),e._v(" "),s("treeview-pagination",{attrs:{items:e.resource.users,search:e.search,selectable:!0},model:{value:e.resource.selected,callback:function(t){e.$set(e.resource,"selected",t)},expression:"resource.selected"}}),e._v(" "),e._l(e.resource.selected,(function(e){return s("input",{attrs:{type:"hidden",name:"users[]"},domProps:{value:e.id}})}))],2)],1),e._v(" "),s("v-divider",{staticClass:"d-none d-md-block",attrs:{vertical:""}}),e._v(" "),s("v-col",{staticClass:"pt-0",attrs:{cols:"12",md:"6"}},[e.resource.selected.length?s("v-card-text",{staticClass:"pt-0"},[s("h4",{staticClass:"mb-5",domProps:{textContent:e._s(e.trans("Selected Members"))}}),e._v(" "),s("v-scroll-x-transition",{attrs:{mode:"in-out"}},[s("div",[s("v-scroll-x-transition",{attrs:{group:"",mode:"in-out"}},e._l(e.resource.selected,(function(t,r){return s("div",{key:r},[s("div",{staticClass:"py-3 px-4",class:{"d-none":t.active}},[s("v-avatar",{staticClass:"mr-6",attrs:{size:"32",color:"workspace"}},[s("v-img",{attrs:{src:t.avatar}})],1),e._v(" "),s("span",{domProps:{textContent:e._s(t.displayname)}})],1)])})),0)],1)])],1):s("v-card-text",{staticClass:"text-center"},[s("v-scroll-x-transition",{attrs:{mode:"out-in"}},[s("div",[s("checklist-icon",{staticClass:"primary--text",staticStyle:{filter:"grayscale(0.8) brightness(150%)"},attrs:{height:"100"}}),e._v(" "),s("p",{staticClass:"muted--text pa-3"},[e._v("\n                        "+e._s(e.trans("Select members from the list to view details"))+"\n                      ")])],1)])],1)],1)],1)],1)],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=F.exports;v()(F,{VAvatar:f.a,VBadge:h.a,VBtn:p.a,VCard:b.a,VCardText:g.c,VCol:x.a,VContainer:y.a,VDivider:w.a,VFadeTransition:k.c,VForm:C.a,VIcon:D.a,VImg:P.a,VRow:O.a,VScrollXTransition:k.e,VSpacer:S.a,VTextField:j.a,VTextarea:T.a,VToolbarTitle:V.a})},42:function(e,t,s){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.users=[],this.managers=[],this.selected=[],this.preview=null,this.data={code:"",created:"",description:"",icon:"",name:"",selected:[],users:[],manager_id:"",lead:{},members:[]}}}}]);
//# sourceMappingURL=35.js.map