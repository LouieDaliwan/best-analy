(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{28:function(e,t,s){"use strict";t.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(e)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)}}},296:function(e,t,s){"use strict";s.r(t);var a=s(12),r=s(28),i=s(77),n=s(1),o=s(2),c=s.n(o),l=s(288),d=s(0),u=s(587),v=s(589),h=s(600),f=Object(n.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"120",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),m=f.exports;c()(f,{VCard:l.a,VCardText:d.c,VCol:u.a,VRow:v.a,VSkeletonLoader:h.a});var p=Object(n.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-card",{staticClass:"mb-3"},[t("v-card-title",{staticClass:"pb-0"},[this._v(this._s(this.__("Icon")))]),this._v(" "),t("v-card-text",{staticClass:"text-center"},[t("div",{staticClass:"d-flex justify-center"},[t("v-skeleton-loader",{staticClass:"dt-skeleton-avatar-upload",attrs:{type:"avatar"}})],1)])],1)}),[],!1,null,null,null),b=p.exports;c()(p,{VCard:l.a,VCardText:d.c,VCardTitle:d.d,VSkeletonLoader:h.a});var g=s(6);function x(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,a)}return s}function w(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?x(Object(s),!0).forEach((function(t){y(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):x(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function y(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var k={beforeRouteLeave:function(e,t,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},computed:w({},Object(g.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),components:{SkeletonEdit:m,SkeletonIcon:b},data:function(){return{auth:a.default.getUser(),loading:!0,resource:new i.a,isValid:!0}},methods:w({},Object(g.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,553))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,553))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"indices.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},parseResourceData:function(e){_.clone(e);var t=new FormData(this.$refs["updateform-form"].$el);return t.append("_method","put"),t},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),this.hideAlertbox(),e.preventDefault(),axios.post(r.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){t.showSnackbar({text:trans("Index updated successfully")}),t.showSuccessbox({text:trans("Updated Index {name}",{name:t.resource.data.name}),buttons:{show:{code:"indices.index",to:{name:"indices.index",params:{id:t.resource.data.id}},icon:"mdi-account-search-outline",text:trans("View All Indexes")},create:{code:"indices.create",to:{name:"indices.create"},icon:"mdi-account-plus-outline",text:trans("Add New Index")}}}),t.$refs.updateform.reset(),t.resource.isPrestine=!0})).catch((function(e){if(e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},getResource:function(){var e=this;axios.get(r.a.show(this.$route.params.id)).then((function(t){e.resource.data=Object.assign(t.data.data),e.resource.data.metadata=Object.assign([],e.resource.data.metadata)})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))}}),mounted:function(){this.getResource()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},C=s(592),F=s(108),D=s(588),P=s(5),O=s(599),V=s(93),j=s(590),S=s(50),E=s(596),I=s(21),R=Object(n.a)(k,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),e._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var a=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),a(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"indices.index"},text:e.trans("Indexes")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("Edit Index"))+"\n        ")]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"9"}},[e.isFetchingResource?[s("skeleton-edit")]:e._e(),e._v(" "),s("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"name",name:e.trans("name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Name"),autofocus:"",name:"name",outlined:""},model:{value:e.resource.data.name,callback:function(t){e.$set(e.resource.data,"name",t)},expression:"resource.data.name"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"code",rules:"required",name:e.trans("code")},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Code"),value:e.slugify(e.resource.data.name),name:"code",outlined:""}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"alias",name:e.trans("alias"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Alias"),name:"alias",outlined:""},model:{value:e.resource.data.alias,callback:function(t){e.$set(e.resource.data,"alias",t)},expression:"resource.data.alias"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"6"}},[s("validation-provider",{attrs:{vid:"metadata.weightage",name:"weightage"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":a,label:e.trans("Weightage"),name:"metadata[weightage]",outlined:"",min:"0.0",type:"number"},model:{value:e.resource.data.metadata.weightage,callback:function(t){e.$set(e.resource.data.metadata,"weightage",t)},expression:"resource.data.metadata.weightage"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("Color"),placeholder:e.trans("E.g. #FFFFFF"),name:"metadata[color]",outlined:""},model:{value:e.resource.data.metadata.color,callback:function(t){e.$set(e.resource.data.metadata,"color",t)},expression:"resource.data.metadata['color']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description"),"auto-grow":"","hide-details":"",name:"description",outlined:""},model:{value:e.resource.data.description,callback:function(t){e.$set(e.resource.data,"description",t)},expression:"resource.data.description"}})],1)],1),e._v(" "),s("input",{attrs:{type:"hidden",name:"type"},domProps:{value:e.resource.data.type}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.auth.id}})],1)],1)],2),e._v(" "),s("v-col",{attrs:{cols:"12",md:"3"}},[e.isFetchingResource?[s("skeleton-icon")]:e._e(),e._v(" "),s("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.__("Icon")))]),e._v(" "),s("v-card-text",{staticClass:"text-center"},[s("upload-avatar",{attrs:{name:"photo",avatar:"icon"},model:{value:e.resource.data.icon,callback:function(t){e.$set(e.resource.data,"icon",t)},expression:"resource.data.icon"}})],1)],1),e._v(" "),e.isFetchingResource?[s("skeleton-metainfo-card")]:e._e(),e._v(" "),s("metainfo-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{list:e.metaInfoCardList}})],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=R.exports;c()(R,{VBadge:C.a,VBtn:F.a,VCard:l.a,VCardText:d.c,VCardTitle:d.d,VCol:u.a,VContainer:D.a,VFadeTransition:P.c,VForm:O.a,VIcon:V.a,VRow:v.a,VSpacer:j.a,VTextField:S.a,VTextarea:E.a,VToolbarTitle:I.a})},77:function(e,t,s){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={name:"",alias:"",code:"",description:"",type:"",icon:"",metadata:{weightage:"",color:""},created:""}}}}]);
//# sourceMappingURL=17.js.map