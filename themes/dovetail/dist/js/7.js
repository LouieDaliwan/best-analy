(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{26:function(t,e,s){"use strict";e.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(t)},restore:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(t)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},update:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},destroy:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(t)},translation:function(){return"/api/v1/best/settings/translations/keys"}}},304:function(t,e,s){"use strict";s.r(e);var r=s(26),a=s(72),n=s(73),o=s(6);function i(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function c(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?i(Object(s),!0).forEach((function(e){l(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):i(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}function l(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var u={beforeRouteLeave:function(t,e,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},computed:c({},Object(o.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),components:{SkeletonEdit:a.a,SkeletonIcon:n.a},data:function(){return{loading:!0,resource:{data:[]},isValid:!0}},methods:c({},Object(o.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(t){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,539))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){t(),e.hideDialog()}}}})},load:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=t,this.loading=t},parseResourceData:function(t){_.clone(t);return new FormData(this.$refs["updateform-form"].$el)},parseErrors:function(t){return this.$refs.updateform.setErrors(t),t=Object.values(t).flat(),this.resource.hasErrors=t.length,this.resource.errors},getParseErrors:function(t){return t=Object.values(t).flat(),this.resource.hasErrors=t.length,t},submitForm:function(){this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"})},submit:function(t){var e=this;this.load(),this.hideAlertbox(),t.preventDefault(),axios.post(r.a.translation(),this.parseResourceData(this.resource.data)).then((function(t){e.showSnackbar({text:trans("Index Settings updated successfully")}),e.$refs.updateform.reset(),e.resource.isPrestine=!0})).catch((function(t){if(t.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(t.response.data.errors);e.$refs.updateform.setErrors(t.response.data.errors),e.showErrorbox({text:trans(t.response.data.message),errors:t.response.data.errors})}})).finally((function(){e.load(!1)}))},getResource:function(){var t=this;axios.get(r.a.translation()).then((function(e){t.resource.data=e.data})).finally((function(){t.load(!1),t.resource.isPrestine=!0}))}}),mounted:function(){this.getResource()},watch:{"resource.data":{handler:function(t){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},d=s(0),h=s(2),f=s.n(h),v=s(583),b=s(104),p=s(576),m=s(577),g=s(4),y=s(590),w=s(90),x=s(578),k=s(579),C=s(48),P=s(20),O=Object(d.a)(u,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("admin",{scopedSlots:t._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[t.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[t._v(t._s(t.trans("Unsaved changes")))])],1):t._e()],1),t._v(" "),s("v-spacer"),t._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),t._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:t.shortkeyCtrlIsPressed,callback:function(e){t.shortkeyCtrlIsPressed=e},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{loading:t.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(e){return e.preventDefault(),t.submitForm(e)},shortkey:t.submitForm}},[s("v-icon",{attrs:{left:""}},[t._v("mdi-content-save-outline")]),t._v("\n                "+t._s(t.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:t.__("Summary of Recommendation")}}),t._v(" "),t._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:t._u([{key:"default",fn:function(e){var r=e.handleSubmit;e.errors,e.invalid,e.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:t.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(e){e.preventDefault(),r(t.submit(e))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),t._v(" "),s("page-header",{scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n          "+t._s(t.trans("Summary of Recommendation"))+"\n        ")]},proxy:!0}],null,!0)}),t._v(" "),s("alertbox"),t._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12"}},[t.isFetchingResource?[s("skeleton-edit")]:t._e(),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},t._l(t.resource.data,(function(e,r){return s("div",{key:r},[s("div",{staticClass:"mb-3"},[s("h3",{staticClass:"mb-3",domProps:{innerHTML:t._s(r)}}),t._v(" "),t._l(e,(function(e){return s("div",[s("v-row",[s("v-col",{attrs:{cols:"12",md:"6"}},[s("p",{staticClass:"mb-0"},[t._v(t._s(e.en))])]),t._v(" "),s("v-col",{attrs:{cols:"12",md:"6"}},[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:t.isDense,disabled:t.isLoading,label:t.trans("Arabic"),outlined:"",name:"translations["+e.en+"][ar]","hide-details":""},model:{value:e.ar,callback:function(s){t.$set(e,"ar",s)},expression:"item.ar"}})],1)],1)],1)}))],2)])})),0)],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);e.default=O.exports;f()(O,{VBadge:v.a,VBtn:b.a,VCol:p.a,VContainer:m.a,VFadeTransition:g.c,VForm:y.a,VIcon:w.a,VRow:x.a,VSpacer:k.a,VTextField:C.a,VToolbarTitle:P.a})},72:function(t,e,s){"use strict";var r=s(0),a=s(2),n=s.n(a),o=s(259),i=s(1),c=s(576),l=s(578),u=s(591),d=Object(r.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-card",{staticClass:"mb-3"},[e("v-card-text",[e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),this._v(" "),e("v-col",{attrs:{cols:"12"}},[e("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"120",type:"image"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.a=d.exports;n()(d,{VCard:o.a,VCardText:i.c,VCol:c.a,VRow:l.a,VSkeletonLoader:u.a})},73:function(t,e,s){"use strict";var r=s(0),a=s(2),n=s.n(a),o=s(259),i=s(1),c=s(591),l=Object(r.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("v-card",{staticClass:"mb-3"},[e("v-card-title",{staticClass:"pb-0"},[this._v(this._s(this.__("Icon")))]),this._v(" "),e("v-card-text",{staticClass:"text-center"},[e("div",{staticClass:"d-flex justify-center"},[e("v-skeleton-loader",{staticClass:"dt-skeleton-avatar-upload",attrs:{type:"avatar"}})],1)])],1)}),[],!1,null,null,null);e.a=l.exports;n()(l,{VCard:o.a,VCardText:i.c,VCardTitle:i.d,VSkeletonLoader:c.a})}}]);
//# sourceMappingURL=7.js.map