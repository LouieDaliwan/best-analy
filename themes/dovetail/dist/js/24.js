(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{302:function(t,n,e){"use strict";e.r(n);var i=e(68),s={data:function(){return{videos:[]}},mounted:function(){this.displayVideos()},methods:{displayVideos:function(){var t=this;axios.get(i.a.url()).then((function(n){t.videos=n.data.videos}))}}},o=e(0),a=Object(o.a)(s,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("admin",[e("page-header",{scopedSlots:t._u([{key:"utilities",fn:function(){return[e("p",[t._v(t._s(t.__("Instructional videos of the app.")))])]},proxy:!0}])}),t._v(" "),t._l(t.videos,(function(n,i){return[e("h3",{staticClass:"my-4",domProps:{innerHTML:t._s(i)}}),t._v(" "),e("ul",[t._l(n,(function(n){return[e("can",{attrs:{code:n.code}},[e("li",{staticClass:"mb-4"},[e("router-link",{staticClass:"title font-weight-normal text--decoration-none",attrs:{tag:"a",to:{name:"faq.single",query:{url:n.url}}}},[t._v(t._s(n.title))])],1)])]}))],2),t._v(" "),e("div",{staticStyle:{height:"30px"}})]}))],2)}),[],!1,null,null,null);n.default=a.exports},68:function(t,n,e){"use strict";n.a={url:function(){return"/api/v1/faqs/contents"}}}}]);
//# sourceMappingURL=24.js.map