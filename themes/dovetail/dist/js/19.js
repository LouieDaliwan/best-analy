(window.webpackJsonp=window.webpackJsonp||[]).push([[19],{27:function(e,t,a){"use strict";t.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(e)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},323:function(e,t,a){"use strict";a.r(t);var s=a(10),r=a(27),n=a(73),i=a(6);function o(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,s)}return a}function c(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?o(Object(a),!0).forEach((function(t){l(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):o(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function l(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var d={beforeRouteLeave:function(e,t,a){this.isFormPrestine?a():this.askUserBeforeNavigatingAway(a)},computed:c({},Object(i.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isNotFormDisabled:function(){return!this.isFormDisabled},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},form:function(){return this.$refs.addform}}),data:function(){return{auth:s.default.getUser(),resource:new n.a}},methods:c({},Object(i.b)({showAlertbox:"alertbox/show",hideAlertbox:"alertbox/hide",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",showSuccessbox:"successbox/show",hideSuccessbox:"successbox/hide"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,570))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,570))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"indices.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},parseResourceData:function(e){_.clone(e);return new FormData(this.$refs["addform-form"].$el)},parseErrors:function(e){return this.form.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isNotFormDisabled&&(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),this.hideAlertbox(),e.preventDefault(),axios.post(r.a.store(),this.parseResourceData(this.resource.data),{headers:{"Content-Type":"multipart/form-data"}}).then((function(e){t.resource.isPrestine=!0,t.showSnackbar({text:trans("Index created successfully")}),t.$router.push({name:"indices.edit",params:{id:e.data.id},query:{success:!0}}),t.showSuccessbox({text:trans("Created Index {name}",{name:e.data.name}),buttons:{show:{code:"indices.index",to:{name:"indices.index",params:{id:e.data.id}},icon:"mdi-open-in-new",text:trans("View All Indexes")},create:{code:"indices.create",to:{name:"indices.create"},icon:"mdi-shield-plus-outline",text:trans("Add New Index")}}})})).catch((function(e){console.log(e.response.data.errors),t.form.setErrors(e.response.data.errors)})).finally((function(){t.load(!1)}))}}),watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.addform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},u=a(0),v=a(2),f=a.n(v),m=a(616),h=a(112),b=a(277),p=a(1),g=a(609),x=a(610),w=a(5),y=a(623),k=a(98),D=a(611),C=a(612),P=a(52),F=a(614),O=a(20),j=Object(u.a)(d,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[a("v-container",{staticClass:"py-0 px-0"},[a("v-row",{attrs:{justify:"space-between",align:"center"}},[a("v-fade-transition",[e.isNotFormPrestine?a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),a("v-spacer"),e._v(" "),a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("div",{staticClass:"d-flex justify-end"},[a("v-spacer"),e._v(" "),a("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),a("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[a("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[a("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[a("metatag",{attrs:{title:e.trans("Add Index")}}),e._v(" "),e._v(" "),a("validation-observer",{ref:"addform",scopedSlots:e._u([{key:"default",fn:function(t){var s=t.handleSubmit;t.errors,t.invalid,t.passed;return[a("v-form",{ref:"addform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),s(e.submit(t))}}},[a("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),a("page-header",{attrs:{back:{to:{name:"indices.index"},text:e.trans("Indexes")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.trans("Add Index")))]},proxy:!0}],null,!0)}),e._v(" "),a("alertbox"),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"9"}},[a("v-card",{staticClass:"mb-3"},[a("v-card-text",[a("v-row",[a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"name",name:e.trans("name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Name"),autofocus:"",name:"name",outlined:""},model:{value:e.resource.data.name,callback:function(t){e.$set(e.resource.data,"name",t)},expression:"resource.data.name"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("Name (arabic)"),name:"metadata[name_arabic]",outlined:""}})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"code",rules:"required",name:e.trans("code")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Code"),value:e.slugify(e.resource.data.name),name:"code",outlined:""}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"alias",name:e.trans("alias"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Alias"),name:"alias",outlined:""},model:{value:e.resource.data.alias,callback:function(t){e.$set(e.resource.data,"alias",t)},expression:"resource.data.alias"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"6"}},[a("validation-provider",{attrs:{vid:"metadata.weightage",name:"weightage"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Weightage"),name:"metadata[weightage]",outlined:"",min:"0.0",type:"number"},model:{value:e.resource.data.metadata.weightage,callback:function(t){e.$set(e.resource.data.metadata,"weightage",t)},expression:"resource.data.metadata.weightage"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"6"}},[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("Color"),placeholder:e.trans("E.g. #FFFFFF"),name:"metadata[color]",outlined:""},model:{value:e.resource.data.metadata.color,callback:function(t){e.$set(e.resource.data.metadata,"color",t)},expression:"resource.data.metadata['color']"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description"),"auto-grow":"","hide-details":"",name:"description",outlined:""}})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description (arabic)"),"auto-grow":"","hide-details":"",name:"metadata[description_arabic]",outlined:""}})],1),e._v(" "),a("input",{attrs:{type:"hidden",name:"type",value:"performance-index"}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.auth.id}})],1)],1)],1)],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"3"}},[a("v-card",{staticClass:"mb-3"},[a("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.__("Photo")))]),e._v(" "),a("v-card-text",{staticClass:"text-center"},[a("upload-avatar",{attrs:{name:"photo",avatar:"icon"},model:{value:e.resource.data.icon,callback:function(t){e.$set(e.resource.data,"icon",t)},expression:"resource.data.icon"}})],1)],1)],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=j.exports;f()(j,{VBadge:m.a,VBtn:h.a,VCard:b.a,VCardText:p.c,VCardTitle:p.d,VCol:g.a,VContainer:x.a,VFadeTransition:w.d,VForm:y.a,VIcon:k.a,VRow:D.a,VSpacer:C.a,VTextField:P.a,VTextarea:F.a,VToolbarTitle:O.a})},73:function(e,t,a){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={name:"",alias:"",code:"",description:"",type:"",icon:"",metadata:{weightage:"",color:"",name_arabic:"",description_arabic:""},created:""}}}}]);
//# sourceMappingURL=19.js.map