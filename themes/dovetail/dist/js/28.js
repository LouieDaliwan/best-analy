(window.webpackJsonp=window.webpackJsonp||[]).push([[28],{293:function(e,t,s){"use strict";s.r(t);var r=s(24),a=s(50),i=s(1),o=s(2),n=s.n(o),c=s(279),l=s(0),d=s(579),u=s(271),h=s(90),v=s(581),f=s(594),m=Object(i.a)({},(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("v-card",{staticClass:"mb-3"},[s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-skeleton-loader",{attrs:{height:"120",type:"image"}})],1)],1)],1),e._v(" "),s("div",{staticClass:"d-flex"},[s("v-divider"),e._v(" "),s("v-icon",{staticClass:"mx-3 mt-n2",attrs:{small:"",color:"muted"}},[e._v("mdi-shield-lock")]),e._v(" "),s("v-divider")],1),e._v(" "),s("v-card-text",[s("h4",{staticClass:"mb-5"},[e._v(e._s(e.trans("Permissions")))]),e._v(" "),s("v-skeleton-loader",{staticClass:"mb-6",attrs:{height:"56",type:"image"}}),e._v(" "),s("div",{staticClass:"mt-4"},[s("v-skeleton-loader",{attrs:{width:"20%",type:"text@5"}})],1)],1)],1)}),[],!1,null,null,null),p=m.exports;n()(m,{VCard:c.a,VCardText:l.c,VCol:d.a,VDivider:u.a,VIcon:h.a,VRow:v.a,VSkeletonLoader:f.a});var b=s(6);function g(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function x(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?g(Object(s),!0).forEach((function(t){w(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):g(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function w(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var y={beforeRouteLeave:function(e,t,s){this.resource.isPrestine?s():this.askUserBeforeNavigatingAway(s)},components:{SkeletonEdit:p},computed:x({},Object(b.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFetchingResource:function(){return this.loading},isFinishedFetchingResource:function(){return!this.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},metaInfoCardList:function(){return[{icon:"mdi-calendar",text:trans("Created :date",{date:this.resource.data.created})},{icon:"mdi-calendar-edit",text:trans("Modified :date",{date:this.resource.data.modified})}]}}),data:function(){return{resource:new a.a,loading:!0,isValid:!0,search:null}},methods:x({},Object(b.b)({hideAlertbox:"alertbox/hide",hideDialog:"dialog/hide",hideErrorbox:"errorbox/hide",hideSnackbar:"snackbar/hide",hideSuccessbox:"successbox/hide",showAlertbox:"alertbox/show",showDialog:"dialog/show",showErrorbox:"errorbox/show",showSnackbar:"snackbar/show",showSuccessbox:"successbox/show"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,545))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,545))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"roles.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e,this.loading=e},parseResourceData:function(e){_.clone(e);var t=new FormData(this.$refs["updateform-form"].$el);return t.append("_method","put"),t},parseErrors:function(e){return this.$refs.updateform.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,this.resource.errors},getParseErrors:function(e){return e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isFormDisabled||(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),e.preventDefault(),axios.post(r.a.update(this.resource.data.id),this.parseResourceData(this.resource.data)).then((function(e){t.showSnackbar({text:trans("Role updated successfully")}),t.showSuccessbox({text:trans("Updated Role {name}",{name:t.resource.data.name}),buttons:{show:{code:"roles.show",to:{name:"roles.show",params:{id:t.resource.data.id}},icon:"mdi-account-search-outline",text:trans("View Details")},create:{code:"roles.create",to:{name:"roles.create"},icon:"mdi-account-plus-outline",text:trans("Add New Role")}}}),t.$refs.updateform.reset(),t.resource.isPrestine=!0})).catch((function(e){if(e.response.status==Response.HTTP_UNPROCESSABLE_ENTITY){_.size(e.response.data.errors);t.$refs.updateform.setErrors(e.response.data.errors),t.showErrorbox({text:trans(e.response.data.message),errors:e.response.data.errors})}})).finally((function(){t.load(!1)}))},getResource:function(){var e=this;axios.get(r.a.show(this.$route.params.id)).then((function(t){e.resource.data=_.clone(t.data.data),e.resource.selected=_.clone(e.resource.data["permissions:selected"])})).finally((function(){e.load(!1),e.resource.isPrestine=!0}))},displayPermissionsList:function(){var e=this;axios.get(r.a.permissions.list()).then((function(t){e.resource.permissions=t.data})).finally((function(){e.getResource()}))}}),mounted:function(){this.displayPermissionsList()},watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0},"resource.selected":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.updateform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!1}}},k=s(584),C=s(105),P=s(580),D=s(5),F=s(593),O=s(582),V=s(48),E=s(590),R=s(21),j=Object(i.a)(y,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Update"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.resource.data.name}}),e._v(" "),e._v(" "),s("validation-observer",{ref:"updateform",scopedSlots:e._u([{key:"default",fn:function(t){var r=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"updateform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),r(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"roles.index"},text:e.trans("Roles")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.trans("Edit Role")))]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"9"}},[e.isFetchingResource?[s("skeleton-edit")]:e._e(),e._v(" "),s("v-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],staticClass:"mb-3"},[s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"name",name:e.trans("name"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Name"),autofocus:"",name:"name",outlined:""},model:{value:e.resource.data.name,callback:function(t){e.$set(e.resource.data,"name",t)},expression:"resource.data.name"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"code",rules:"required",name:e.trans("code")},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Code"),value:e.slugify(e.resource.data.name),name:"code",outlined:""}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Description"),"auto-grow":"","hide-details":"",name:"description",outlined:""},model:{value:e.resource.data.description,callback:function(t){e.$set(e.resource.data,"description",t)},expression:"resource.data.description"}})],1)],1)],1),e._v(" "),s("div",{staticClass:"d-flex"},[s("v-divider"),e._v(" "),s("v-icon",{staticClass:"mx-3 mt-n2",attrs:{small:"",color:"muted"}},[e._v("mdi-shield-lock")]),e._v(" "),s("v-divider")],1),e._v(" "),s("v-card-text",[s("h4",{staticClass:"mb-5"},[e._v(e._s(e.trans("Permissions")))]),e._v(" "),s("treeview-field",{model:{value:e.search,callback:function(t){e.search=t},expression:"search"}}),e._v(" "),s("treeview",{attrs:{items:e.resource.permissions,search:e.search,selectable:!0},on:{"update:items":function(t){return e.$set(e.resource,"permissions",t)}},model:{value:e.resource.selected,callback:function(t){e.$set(e.resource,"selected",t)},expression:"resource.selected"}}),e._v(" "),e._l(e.resource.selected,(function(e){return s("input",{attrs:{type:"hidden",name:"permissions[]"},domProps:{value:e}})})),e._v(" "),s("validation-provider",{attrs:{vid:"permissions",name:"permissions",rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return e._l(r,(function(t){return s("v-card-text",{key:t,staticClass:"error--text",domProps:{innerHTML:e._s(t)}})}))}}],null,!0)})],2)],1)],2),e._v(" "),s("v-col",{attrs:{cols:"23",md:"3"}},[e.isFetchingResource?[s("skeleton-metainfo-card")]:e._e(),e._v(" "),s("metainfo-card",{directives:[{name:"show",rawName:"v-show",value:e.isFinishedFetchingResource,expression:"isFinishedFetchingResource"}],attrs:{list:e.metaInfoCardList}})],2)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=j.exports;n()(j,{VBadge:k.a,VBtn:C.a,VCard:c.a,VCardText:l.c,VCol:d.a,VContainer:P.a,VDivider:u.a,VFadeTransition:D.c,VForm:F.a,VIcon:h.a,VRow:v.a,VSpacer:O.a,VTextField:V.a,VTextarea:E.a,VToolbarTitle:R.a})},50:function(e,t,s){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.permissions=[],this.selected=[],this.data={name:"",alias:"",code:"",description:"",created:"",permissions:[],selected:[]}}}}]);
//# sourceMappingURL=28.js.map