(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{26:function(e,t,s){"use strict";t.a={list:function(){return"/api/v1/surveys"},store:function(){return"/api/v1/surveys"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/restore/".concat(e)},trashed:function(){return"/api/v1/surveys/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(e)},submit:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/surveys/".concat(e,"/submit")}}},28:function(e,t,s){"use strict";t.a={list:function(){return"/api/v1/indices"},store:function(){return"/api/v1/indices"},delete:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/delete/".concat(e)},restore:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/restore/".concat(e)},trashed:function(){return"/api/v1/indices/trashed"},show:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},update:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)},destroy:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return"/api/v1/indices/".concat(e)}}},322:function(e,t,s){"use strict";s.r(t);var r=s(12),a=s(26),n=s(37),i=s(51),o=s(6);function d(e,t){var s=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),s.push.apply(s,r)}return s}function l(e){for(var t=1;t<arguments.length;t++){var s=null!=arguments[t]?arguments[t]:{};t%2?d(Object(s),!0).forEach((function(t){c(e,t,s[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(s)):d(Object(s)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(s,t))}))}return e}function c(e,t,s){return t in e?Object.defineProperty(e,t,{value:s,enumerable:!0,configurable:!0,writable:!0}):e[t]=s,e}var u={beforeRouteLeave:function(e,t,s){this.isFormPrestine?s():this.askUserBeforeNavigatingAway(s)},components:{IndexPicker:i.a},computed:l({},Object(o.c)({isDense:"settings/fieldIsDense",shortkeyCtrlIsPressed:"shortkey/ctrlIsPressed"}),{isDesktop:function(){return this.$vuetify.breakpoint.mdAndUp},isInvalid:function(){return this.resource.isPrestine||this.resource.loading},isLoading:function(){return this.resource.loading},isFormDisabled:function(){return this.isInvalid||this.resource.isPrestine},isNotFormDisabled:function(){return!this.isFormDisabled},isFormPrestine:function(){return this.resource.isPrestine},isNotFormPrestine:function(){return!this.isFormPrestine},form:function(){return this.$refs.addform}}),data:function(){return{auth:r.default.getUser(),resource:new n.a}},methods:l({},Object(o.b)({showAlertbox:"alertbox/show",hideAlertbox:"alertbox/hide",showDialog:"dialog/show",hideDialog:"dialog/hide",showSnackbar:"snackbar/show",hideSnackbar:"snackbar/hide",showSuccessbox:"successbox/show",hideSuccessbox:"successbox/hide"}),{askUserBeforeNavigatingAway:function(e){var t=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,545))},title:trans("Unsaved changes will be lost"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Go Back"),callback:function(){t.hideDialog()}},action:{text:trans("Discard"),callback:function(){e(),t.hideDialog()}}}})},askUserToDiscardUnsavedChanges:function(){var e=this;this.showDialog({illustration:function(){return Promise.resolve().then(s.bind(null,545))},title:trans("Discard changes?"),text:trans("You have unsaved changes on this page. If you navigate away from this page, data will not be recovered."),buttons:{cancel:{text:trans("Cancel"),callback:function(){e.hideDialog()}},action:{text:trans("Discard"),callback:function(){e.resource.isPrestine=!0,e.hideDialog(),e.$router.replace({name:"surveys.index"})}}}})},load:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.resource.loading=e},parseResourceData:function(e){_.clone(e);return new FormData(this.$refs["addform-form"].$el)},parseErrors:function(e){return this.form.setErrors(e),e=Object.values(e).flat(),this.resource.hasErrors=e.length,e},submitForm:function(){this.isNotFormDisabled&&(this.$refs["submit-button"].click(),window.scrollTo({top:0,left:0,behavior:"smooth"}))},submit:function(e){var t=this;this.load(),e.preventDefault(),this.hideAlertbox(),axios.post(a.a.store(),this.parseResourceData(this.resource.data)).then((function(e){t.resource.isPrestine=!0,t.showSnackbar({text:trans("Survey created successfully")}),t.$router.push({name:"surveys.edit",params:{id:e.data.id},query:{success:!0}}),t.showSuccessbox({text:trans("Created Survey {name}",{name:e.data.title}),buttons:{show:{code:"surveys.show",to:{name:"surveys.show",params:{id:e.data.id}},icon:"mdi-open-in-new",text:trans("View Details")},create:{code:"surveys.create",to:{name:"surveys.create"},icon:"mdi-shield-plus-outline",text:trans("Add New Survey")}}})})).catch((function(e){t.form.setErrors(e.response.data.errors)})).finally((function(){t.load(!1)}))}}),watch:{"resource.data":{handler:function(e){this.resource.isPrestine=!1,this.resource.hasErrors=this.$refs.addform.flags.invalid,this.resource.hasErrors||this.hideAlertbox()},deep:!0}}},v=s(1),f=s(2),p=s.n(f),m=s(584),h=s(105),b=s(278),y=s(0),g=s(579),x=s(580),w=s(270),k=s(5),P=s(593),D=s(90),C=s(581),S=s(582),O=s(48),j=s(590),V=s(21),I=Object(v.a)(u,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("admin",{scopedSlots:e._u([{key:"appbar",fn:function(){return[s("v-container",{staticClass:"py-0 px-0"},[s("v-row",{attrs:{justify:"space-between",align:"center"}},[s("v-fade-transition",[e.isNotFormPrestine?s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("v-toolbar-title",{staticClass:"muted--text"},[e._v(e._s(e.trans("Unsaved changes")))])],1):e._e()],1),e._v(" "),s("v-spacer"),e._v(" "),s("v-col",{staticClass:"py-0",attrs:{cols:"auto"}},[s("div",{staticClass:"d-flex justify-end"},[s("v-spacer"),e._v(" "),s("v-btn",{staticClass:"ml-3 mr-0",attrs:{text:"",large:""},on:{click:e.askUserToDiscardUnsavedChanges}},[e._v(e._s(e.trans("Discard")))]),e._v(" "),s("v-badge",{staticClass:"dt-badge",attrs:{bordered:"",bottom:"",color:"dark",content:"s","offset-x":"20","offset-y":"20",tile:"",transition:"fade-transition"},model:{value:e.shortkeyCtrlIsPressed,callback:function(t){e.shortkeyCtrlIsPressed=t},expression:"shortkeyCtrlIsPressed"}},[s("v-btn",{directives:[{name:"shortkey",rawName:"v-shortkey.once",value:["ctrl","s"],expression:"['ctrl', 's']",modifiers:{once:!0}}],ref:"submit-button-main",staticClass:"ml-3 mr-0",attrs:{disabled:e.isFormDisabled,loading:e.isLoading,color:"primary",large:"",type:"submit"},on:{click:function(t){return t.preventDefault(),e.submitForm(t)},shortkey:e.submitForm}},[s("v-icon",{attrs:{left:""}},[e._v("mdi-content-save-outline")]),e._v("\n                "+e._s(e.trans("Save"))+"\n              ")],1)],1)],1)])],1)],1)]},proxy:!0}])},[s("metatag",{attrs:{title:e.trans("Add Survey")}}),e._v(" "),e._v(" "),s("validation-observer",{ref:"addform",scopedSlots:e._u([{key:"default",fn:function(t){var r=t.handleSubmit;t.errors,t.invalid,t.passed;return[s("v-form",{ref:"addform-form",attrs:{disabled:e.isLoading,autocomplete:"false",enctype:"multipart/form-data"},on:{submit:function(t){t.preventDefault(),r(e.submit(t))}}},[s("button",{ref:"submit-button",staticClass:"d-none",attrs:{type:"submit"}}),e._v(" "),s("page-header",{attrs:{back:{to:{name:"surveys.index"},text:e.trans("Surveys")}},scopedSlots:e._u([{key:"title",fn:function(){return[e._v(e._s(e.trans("Add Survey")))]},proxy:!0}],null,!0)}),e._v(" "),s("alertbox"),e._v(" "),s("v-row",[s("v-col",{attrs:{cols:"12",md:"9"}},[s("v-card",[s("v-card-text",[s("v-row",[s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"title",name:e.trans("title"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Survey Title"),autofocus:"",name:"title",outlined:""},model:{value:e.resource.data.title,callback:function(t){e.$set(e.resource.data,"title",t)},expression:"resource.data.title"}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("validation-provider",{attrs:{vid:"code",rules:"required",name:e.trans("code")},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-text-field",{staticClass:"dt-text-field",attrs:{dense:e.isDense,disabled:e.isLoading,"error-messages":r,label:e.trans("Survey Code"),value:e.slugify(e.resource.data.title),name:"code",outlined:""}})]}}],null,!0)})],1),e._v(" "),s("v-col",{attrs:{cols:"12"}},[s("v-textarea",{staticClass:"dt-text-field",attrs:{label:e.trans("Survey Description"),"auto-grow":"","hide-details":"",name:"body",outlined:""}})],1)],1),e._v(" "),s("input",{attrs:{type:"hidden",name:"type",value:"survey"}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"formable_type",value:"Index\\Models\\Index"}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"formable_id"},domProps:{value:e.resource.data.indices}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"user_id"},domProps:{value:e.auth.id}})],1),e._v(" "),s("div",{staticClass:"d-flex my-6"},[s("v-divider"),e._v(" "),s("span",{staticClass:"muted--text mx-3 mt-n3"},[s("strong",[e._v(e._s(e.trans("Fields")))])]),e._v(" "),s("v-divider")],1),e._v(" "),s("v-card-text",{staticClass:"selects"},[s("group-repeater",{attrs:{fields:1,disabled:e.isLoading},model:{value:e.resource.data.fields,callback:function(t){e.$set(e.resource.data,"fields",t)},expression:"resource.data.fields"}}),e._v(" "),e._l(e.resource.data.fields,(function(t,r){return[e._l(t.children,(function(a,n){return[s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][group]"},domProps:{value:t.group}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][type]",value:"likert"}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][title]"},domProps:{value:a.title}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][code]"},domProps:{value:e.slugify(a.title)}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][metadata][total]"},domProps:{value:a.total}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][metadata][wts]"},domProps:{value:a.wts}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][metadata][comment]"},domProps:{value:a.comment}}),e._v(" "),s("input",{attrs:{type:"hidden",name:"fields["+(t.group+r+n)+"][metadata][categories]"},domProps:{value:a.categories}})]}))]}))],2)],1)],1),e._v(" "),s("v-col",{attrs:{cols:"12",md:"3"}},[s("index-picker",{attrs:{dense:e.isDense,disabled:e.isLoading,name:"formable_id"},model:{value:e.resource.data.indices,callback:function(t){e.$set(e.resource.data,"indices",t)},expression:"resource.data.indices"}})],1)],1)],1)]}}])})],1)}),[],!1,null,null,null);t.default=I.exports;p()(I,{VBadge:m.a,VBtn:h.a,VCard:b.a,VCardText:y.c,VCol:g.a,VContainer:x.a,VDivider:w.a,VFadeTransition:k.c,VForm:P.a,VIcon:D.a,VRow:C.a,VSpacer:S.a,VTextField:O.a,VTextarea:j.a,VToolbarTitle:V.a})},37:function(e,t,s){"use strict";t.a=function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.loading=!1,this.isPrestine=!0,this.isValid=!0,this.errors=[],this.data={title:"",code:"",body:"",metadata:"",type:"",user_id:"",created:"",indices:[],answer:"",fields:[{group:"",type:"",children:[]}]}}},51:function(e,t,s){"use strict";var r=s(28),a={name:"IndexPicker",props:{value:{type:[Array,Object,String,Number]},dense:{type:Boolean},errors:{type:[Array,Object]},lazyLoad:{type:Boolean},illustration:{type:Boolean,default:!0}},computed:{index:{get:function(){return this.value[0]},set:function(e){this.$emit("input",[e])}},indices:function(){return this.items.map((function(e){return{value:e.id,text:e.name,icon:e.icon}}))}},data:function(){return{items:[]}},methods:{getIndexsData:function(){var e=this;window._.isEmpty(this.items)&&axios.get(r.a.list(),{params:{per_page:"-1"}}).then((function(t){e.items=t.data.data}))}},mounted:function(){this.lazyLoad||this.getIndexsData()}},n=s(1),i=s(2),o=s.n(i),d=s(278),l=s(0),c=s(41),u=Object(n.a)(a,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("v-card",{staticClass:"mb-3"},[s("v-card-title",[e._v(e._s(e.trans("Performance Index")))]),e._v(" "),e.illustration?s("div",{staticClass:"primary--text text-center"},[s("checklist-icon",{attrs:{width:"100",height:"100"}})],1):e._e(),e._v(" "),s("v-card-text",[s("validation-provider",{attrs:{vid:"indices",name:e.trans("indices"),rules:"required"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.errors;return[s("v-select",{ref:"indices",staticClass:"dt-text-field",attrs:{dense:e.dense,"error-messages":r,"hide-details":!r.length,items:e.indices,label:e.$tc("Select..."),"background-color":"selects","menu-props":"offsetY",name:"formable_id",outlined:""},on:{focus:e.getIndexsData},scopedSlots:e._u([{key:"item",fn:function(t){var r=t.item;return[s("img",{staticClass:"mr-3",attrs:{src:r.icon,width:"20"}}),e._v(" "),s("span",{domProps:{textContent:e._s(r.text)}})]}}],null,!0),model:{value:e.index,callback:function(t){e.index=t},expression:"index"}})]}}])}),e._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:e.index,expression:"index"}],attrs:{type:"hidden",name:"formable_id"},domProps:{value:e.index},on:{input:function(t){t.target.composing||(e.index=t.target.value)}}})],1)],1)}),[],!1,null,null,null);t.a=u.exports;o()(u,{VCard:d.a,VCardText:l.c,VCardTitle:l.d,VSelect:c.a})}}]);
//# sourceMappingURL=5.js.map