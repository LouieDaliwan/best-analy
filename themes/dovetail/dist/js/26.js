(window.webpackJsonp=window.webpackJsonp||[]).push([[26],{312:function(t,e,n){"use strict";n.r(e);var o=n(69),s={data:function(t){return{videos:[],video:t.$route.query.url,title:t.$route.query.title}},mounted:function(){this.displayVideos()},methods:{displayVideos:function(){var t=this;axios.get(o.a.url()).then((function(e){t.videos=e.data.videos}))}}},i=n(0),r=n(2),a=n.n(r),u=n(271),d=Object(i.a)(s,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("admin",[n("page-header",{attrs:{back:{to:{name:"faq.index"},text:t.trans("Back")}},scopedSlots:t._u([{key:"title",fn:function(){return[n("p",[t._v(t._s(t.title))])]},proxy:!0}])}),t._v(" "),n("v-card",[n("video",{staticStyle:{display:"block"},attrs:{controls:"",height:"100%",width:"100%"}},[t._v("\n      "+t._s(t.trans("Your browser does not support HTML5 video."))+"\n      "),n("source",{attrs:{src:t.video}})])])],1)}),[],!1,null,null,null);e.default=d.exports;a()(d,{VCard:u.a})},69:function(t,e,n){"use strict";e.a={url:function(){return"/api/v1/faqs/contents"}}}}]);
//# sourceMappingURL=26.js.map