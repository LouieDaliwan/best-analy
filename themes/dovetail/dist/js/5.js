(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{27:function(e,t,a){"use strict";t.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(e)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},315:function(e,t,a){"use strict";a.r(t);var s=a(10),r=a(27),i=a(73),n=a(76),o=a(78),c=a(6);function l(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,s)}return a}function d(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?l(Object(a),!0).forEach((function(t){u(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):l(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function u(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var v={beforeRouteLeave:function(e,t,a){this.resource.isPrestine?a():this.askUserBeforeNavigatingAway(a)},computed:d({},Object(c.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),components:{SkeletonEdit:n.a,SkeletonIcon:o.a},data:function(){return{auth:s.default.getUser(),loading:!0,resource:new i.a,isValid:!0}},methods:d({},Object(c.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,551))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(a.bind(null,551))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"indices.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},parseResourceData:function(e){_.clone(e);var t=new FormData(this.$refs["updateform-form"].$el);return t.append("_method","put"),t},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),this.hideAlertbox(),e.preventDefault(),axios.post(r.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){t.showSnackbar({text:trans("Component updated successfully")}),t.showSuccessbox({text:trans("Updated Component {name}",{name:t.resource.data.name}),buttons:{show:{code:"indices.index",to:{name:"indices.index",params:{id:t.resource.data.id}},icon:"mdi-account-search-outline",text:trans("View All Indexes")},create:{code:"indices.create",to:{name:"indices.create"},icon:"mdi-account-plus-outline",text:trans("Add New Component")}}}),t.$refs.updateform.reset(),t.resource.isPrestine=!0})).catch((function(e){if(e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},getResource:function(){var e=this;axios.get(r.a.show(this.$route.params.id)).then((function(t){e.resource.data=Object.assign(t.data.data),e.resource.data.metadata=Object.assign([],e.resource.data.metadata)})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))}}),mounted:function(){this.getResource()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},h=a(0),m=a(2),f=a.n(m),p=a(616),b=a(112),g=a(277),x=a(1),w=a(609),y=a(610),k=a(5),C=a(623),D=a(98),F=a(611),P=a(612),O=a(51),V=a(614),j=a(20),S=Object(h.a)(v,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[a("v-container",{staticClass:"py-0 px-0"},[a("v-row",{attrs:{justify:"space-between",align:"center"}},[a("v-fade-transition",[e.isNotFormPrestine?a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),a("v-spacer"),e._v(" "),a("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[a("div",{staticClass:"d-flex justify-end"},[a("v-spacer"),e._v(" "),a("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),a("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[a("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[a("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[a("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),e._v(" "),a("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var s=t.handleSubmit;t.errors,t.invalid,t.passed;return[a("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),s(e.submit(t))}}},[a("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),a("page-header",{attrs:{back:{to:{name:"indices.index"},text:e.trans("Indexes")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("Edit Component"))+"\n        ")]},proxy:!0}],null,!0)}),e._v(" "),a("alertbox"),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"12",md:"9"}},[e.isFetchingResource?[a("skeleton-edit")]:e._e(),e._v(" "),a("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[a("v-card-text",[a("v-row",[a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"name",name:e.trans("name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Name"),autofocus:"",name:"name",outlined:""},model:{value:e.resource.data.name,callback:function(t){e.$set(e.resource.data,"name",t)},expression:"resource.data.name"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("Name (arabic)"),autofocus:"",name:"metadata[name_arabic]",outlined:""},model:{value:e.resource.data.metadata.name_arabic,callback:function(t){e.$set(e.resource.data.metadata,"name_arabic",t)},expression:"resource.data.metadata.name_arabic"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"code",rules:"required",name:e.trans("code")},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Code"),value:e.slugify(e.resource.data.name),name:"code",outlined:""}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("validation-provider",{attrs:{vid:"alias",name:e.trans("alias"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Alias"),name:"alias",outlined:""},model:{value:e.resource.data.alias,callback:function(t){e.$set(e.resource.data,"alias",t)},expression:"resource.data.alias"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"6"}},[a("validation-provider",{attrs:{vid:"metadata.weightage",name:"weightage"},scopedSlots:e._u([{key:"default",fn:function(t){var s=t.errors;return[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":s,label:e.trans("Weightage"),name:"metadata[weightage]",outlined:"",min:"0.0",type:"number"},model:{value:e.resource.data.metadata.weightage,callback:function(t){e.$set(e.resource.data.metadata,"weightage",t)},expression:"resource.data.metadata.weightage"}})]}}],null,!0)})],1),e._v(" "),a("v-col",{attrs:{cols:"12",md:"6"}},[a("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("Color"),placeholder:e.trans("E.g. #FFFFFF"),name:"metadata[color]",outlined:""},model:{value:e.resource.data.metadata.color,callback:function(t){e.$set(e.resource.data.metadata,"color",t)},expression:"resource.data.metadata['color']"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description"),"auto-grow":"","hide-details":"",name:"description",outlined:""},model:{value:e.resource.data.description,callback:function(t){e.$set(e.resource.data,"description",t)},expression:"resource.data.description"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12"}},[a("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description (arabic)"),"auto-grow":"","hide-details":"",name:"metadata[description_arabic]",outlined:""},model:{value:e.resource.data.metadata.description_arabic,callback:function(t){e.$set(e.resource.data.metadata,"description_arabic",t)},expression:"resource.data.metadata['description_arabic']"}})],1)],1),e._v(" "),a("input",{attrs:{type:"hidden",name:"type"},domProps:{value:e.resource.data.type}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.auth.id}})],1)],1)],2),e._v(" "),a("v-col",{attrs:{cols:"12",md:"3"}},[e.isFetchingResource?[a("skeleton-icon")]:e._e(),e._v(" "),a("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[a("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.__("Icon")))]),e._v(" "),a("v-card-text",{staticClass:"text-center"},[a("upload-avatar",{attrs:{name:"photo",avatar:"icon"},model:{value:e.resource.data.icon,callback:function(t){e.$set(e.resource.data,"icon",t)},expression:"resource.data.icon"}})],1)],1),e._v(" "),e.isFetchingResource?[a("skeleton-metainfo-card")]:e._e(),e._v(" "),a("metainfo-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{list:e.metaInfoCardList}})],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=S.exports;f()(S,{VBadge:p.a,VBtn:b.a,VCard:g.a,VCardText:x.c,VCardTitle:x.d,VCol:w.a,VContainer:y.a,VFadeTransition:k.d,VForm:C.a,VIcon:D.a,VRow:F.a,VSpacer:P.a,VTextField:O.a,VTextarea:V.a,VToolbarTitle:j.a})},73:function(e,t,a){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={name:"",alias:"",code:"",description:"",type:"",icon:"",metadata:{weightage:"",color:"",name_arabic:"",description_arabic:""},created:""}}},76:function(e,t,a){"use strict";var s=a(0),r=a(2),i=a.n(r),n=a(277),o=a(1),c=a(609),l=a(611),d=a(624),u=Object(s.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"120",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);t.a=u.exports;i()(u,{VCard:n.a,VCardText:o.c,VCol:c.a,VRow:l.a,VSkeletonLoader:d.a})},78:function(e,t,a){"use strict";var s=a(0),r=a(2),i=a.n(r),n=a(277),o=a(1),c=a(624),l=Object(s.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-card",{staticClass:"mb-3"},[t("v-card-title",{staticClass:"pb-0"},[this._v(this._s(this.__("Icon")))]),this._v(" "),t("v-card-text",{staticClass:"text-center"},[t("div",{staticClass:"d-flex justify-center"},[t("v-skeleton-loader",{staticClass:"dt-skeleton-avatar-upload",attrs:{type:"avatar"}})],1)])],1)}),[],!1,null,null,null);t.a=l.exports;i()(l,{VCard:n.a,VCardText:o.c,VCardTitle:o.d,VSkeletonLoader:c.a})}}]);
//# sourceMappingURL=5.js.map