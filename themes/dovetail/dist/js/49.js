(window.webpackJsonp=window.webpackJsonp||[]).push([[49],{279:function(e,t,s){"use strict";s.r(t);var a=function(){return"/api/v1/settings/app"},r=function(){return"/api/v1/settings/branding"},i=s(41);var o=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={file:i.a.logo}},n=s(0),l=s(2),c=s.n(l),d=s(262),u=s(1),p=s(580),h=s(582),v=s(595),f=Object(n.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-card",{staticClass:"mb-3"},[t("v-card-text",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),t("v-col",{attrs:{cols:"12"}},[t("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null),b=f.exports;c()(f,{VCard:d.a,VCardText:u.c,VCol:p.a,VRow:h.a,VSkeletonLoader:v.a});var m=Object(n.a)({},(function(){var e=this.$createElement,t=this._self._c||e;return t("v-card",{staticClass:"mb-3"},[t("v-card-title",{staticClass:"pb-0"},[this._v(this._s(this.__("Icon")))]),this._v(" "),t("v-card-text",{staticClass:"text-center"},[t("div",{staticClass:"d-flex justify-center"},[t("v-skeleton-loader",{staticClass:"dt-skeleton-avatar-upload",attrs:{type:"avatar"}})],1)])],1)}),[],!1,null,null,null),g=m.exports;c()(m,{VCard:d.a,VCardText:u.c,VCardTitle:u.d,VSkeletonLoader:v.a});var x=s(6);function y(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,a)}return s}function k(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?y(Object(s),!0).forEach((function(t){w(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):y(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function w(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var C={beforeRouteLeave:function(e,t,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},computed:k({},Object(x.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),components:{SkeletonEdit:b,SkeletonIcon:g},data:function(){return{loading:!0,resource:new o,isValid:!0}},methods:k({},Object(x.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,543))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},parseResourceData:function(e){_.clone(e);return new FormData(this.$refs["updateform-form"].$el)},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"})},submit:function(e){var t=this;this.load(),this.hideAlertbox(),e.preventDefault(),axios.post(r(),this.parseResourceData(this.resource.data)).then((function(e){t.showSnackbar({text:trans("General Settings updated successfully")}),t.$refs.updateform.reset(),t.resource.isPrestine=!0})).catch((function(e){if(e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},getResource:function(){var e=this;axios.get(a()).then((function(t){console.log(t.data),e.resource.data=Object.assign([],e.resource.data,t.data)})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))}}),mounted:function(){this.getResource()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},P=s(587),D=s(104),O=s(581),F=s(5),V=s(594),j=s(91),E=s(583),S=s(48),$=s(20),A=Object(n.a)(C,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.__("General Settings")}}),e._v(" "),e._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var a=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),a(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),s("page-header",{scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n          "+e._s(e.trans("General Settings"))+"\n        ")]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"9"}},[e.isFetchingResource?[s("skeleton-edit")]:e._e(),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Title"),name:"app:title",outlined:"","hide-details":""},model:{value:e.resource.data["app:title"],callback:function(t){e.$set(e.resource.data,"app:title",t)},expression:"resource.data['app:title']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Author"),name:"app:author",outlined:"","hide-details":""},model:{value:e.resource.data["app:author"],callback:function(t){e.$set(e.resource.data,"app:author",t)},expression:"resource.data['app:author']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Code"),name:"app:code",outlined:"","hide-details":""},model:{value:e.resource.data["app:code"],callback:function(t){e.$set(e.resource.data,"app:code",t)},expression:"resource.data['app:code']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Email Address"),name:"app:email",outlined:"","hide-details":""},model:{value:e.resource.data["app:email"],callback:function(t){e.$set(e.resource.data,"app:email",t)},expression:"resource.data['app:email']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Full Title"),name:"app:fulltitle",outlined:"","hide-details":""},model:{value:e.resource.data["app:fulltitle"],callback:function(t){e.$set(e.resource.data,"app:fulltitle",t)},expression:"resource.data['app:fulltitle']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Tagline"),name:"app:tagline",outlined:"","hide-details":""},model:{value:e.resource.data["app:tagline"],callback:function(t){e.$set(e.resource.data,"app:tagline",t)},expression:"resource.data['app:tagline']"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,label:e.trans("App Year"),name:"app:year",outlined:"","hide-details":""},model:{value:e.resource.data["app:year"],callback:function(t){e.$set(e.resource.data,"app:year",t)},expression:"resource.data['app:year']"}})],1)],1)],1)],2),e._v(" "),s("v-col",{attrs:{cols:"12",md:"3"}},[e.isFetchingResource?[s("skeleton-icon")]:e._e(),e._v(" "),s("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-card-title",{staticClass:"pb-0"},[e._v(e._s(e.__("App Logo")))]),e._v(" "),s("v-card-text",{staticClass:"text-center"},[s("upload-avatar",{attrs:{name:"file",avatar:"file"},model:{value:e.resource.data.file,callback:function(t){e.$set(e.resource.data,"file",t)},expression:"resource.data['file']"}})],1)],1)],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=A.exports;c()(A,{VBadge:P.a,VBtn:D.a,VCard:d.a,VCardText:u.c,VCardTitle:u.d,VCol:p.a,VContainer:O.a,VFadeTransition:F.c,VForm:V.a,VIcon:j.a,VRow:h.a,VSpacer:E.a,VTextField:S.a,VToolbarTitle:$.a})}}]);
//# sourceMappingURL=49.js.map