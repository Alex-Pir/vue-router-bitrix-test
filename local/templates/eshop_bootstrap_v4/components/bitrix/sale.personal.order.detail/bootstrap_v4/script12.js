this.BX=this.BX||{},this.BX.Citrus=this.BX.Citrus||{},function(a,b){'use strict';function c(a,b,c,d,e,f,g,h,i,j){"boolean"!=typeof g&&(i=h,h=g,g=!1);const k="function"==typeof c?c.options:c;a&&a.render&&(k.render=a.render,k.staticRenderFns=a.staticRenderFns,k._compiled=!0,e&&(k.functional=!0)),d&&(k._scopeId=d);let l;if(f?(l=function(a){a=a||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,a||"undefined"==typeof __VUE_SSR_CONTEXT__||(a=__VUE_SSR_CONTEXT__),b&&b.call(this,i(a)),a&&a._registeredComponents&&a._registeredComponents.add(f)},k._ssrRegister=l):b&&(l=g?function(a){b.call(this,j(a,this.$root.$options.shadowRoot))}:function(a){b.call(this,h(a))}),l)if(k.functional){const a=k.render;k.render=function(b,c){return l.call(c),a(b,c)}}else{const a=k.beforeCreate;k.beforeCreate=a?[].concat(a,l):[l]}return c}function d(){return(a,b)=>e(a,b)}function e(a,b){const c=f?b.media||"default":a,d=h[c]||(h[c]={ids:new Set,styles:[]});if(!d.ids.has(a)){d.ids.add(a);let c=b.source;if(b.map&&(c+="\n/*# sourceURL="+b.map.sources[0]+" */",c+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(b.map))))+" */"),d.element||(d.element=document.createElement("style"),d.element.type="text/css",b.media&&d.element.setAttribute("media",b.media),void 0===g&&(g=document.head||document.getElementsByTagName("head")[0]),g.appendChild(d.element)),"styleSheet"in d.element)d.styles.push(c),d.element.styleSheet.cssText=d.styles.filter(Boolean).join("\n");else{const a=d.ids.size-1,b=document.createTextNode(c),e=d.element.childNodes;e[a]&&d.element.removeChild(e[a]),e.length?d.element.insertBefore(b,e[a]):d.element.appendChild(b)}}}const f="undefined"!=typeof navigator&&/msie [6-9]\\b/.test(navigator.userAgent.toLowerCase());let g;const h={};var i=function(){var a=this,b=a.$createElement,c=a._self._c||b;return c("div",{staticClass:"product-sum"},[a._v("\n  "+a._s(a.displayNumber)+"\n")])};i._withStripped=!0;c({render:i,staticRenderFns:[]},function(a){a&&a("data-v-0ecd6fce_0",{source:"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n",map:{version:3,sources:[],names:[],mappings:"",file:"animated-number.vue"},media:void 0})},{name:"animated-number",props:{number:{default:0}},data(){return{displayNumber:0,interval:!1}},mounted:function(){this.displayNumber=this.number?this.number:0},watch:{number:function(){clearInterval(this.interval);this.number==this.displayNumber||(this.interval=window.setInterval(function(){if(this.displayNumber!=this.number){var a=(this.number-this.displayNumber)/10;a=0<=a?Math.ceil(a):Math.floor(a),this.displayNumber+=a}}.bind(this),20))}}},"data-v-0ecd6fce",!1,void 0,!1,d,void 0,void 0);var j=function(){var a=this,b=a.$createElement,c=a._self._c||b;return c("div",{staticClass:"order-detail-products-block"},[a._v("\n  test vue\n")])};j._withStripped=!0;const k=c({render:j,staticRenderFns:[]},function(a){a&&a("data-v-290b2fd4_0",{source:"\n.reload-block-item[data-v-290b2fd4] {\n  display: table;\n  flex-flow: column;\n  justify-content: space-between;\n}\n.table-header[data-v-290b2fd4] {\n  border-bottom: 2px solid #000;\n}\n.order-detail-header-column[data-v-290b2fd4] {\n  display: table-cell;\n  width: 200px;\n  height: 30px;\n  max-height: 30px;\n  box-sizing: border-box;\n  position: relative;\n  max-width: 200px;\n}\n.container[data-v-290b2fd4] {\n  display: table-row;\n  max-height: 30px;\n  box-sizing: border-box;\n}\n.block[data-v-290b2fd4],\n.change-text[data-v-290b2fd4]{\n  width: 100px;\n}\n.change-text[data-v-290b2fd4] {\n  padding: 2px 5px;\n  box-sizing: border-box;\n}\n.detail-order-header[data-v-290b2fd4]\n{\n  display: table-row;\n}\n.change-block[data-v-290b2fd4]\n{\n  display: flex;\n  max-width: 100px;\n  position: absolute;\n}\n.delete[data-v-290b2fd4] {\n  text-decoration: line-through;\n}\n.order-detail-product-delete[data-v-290b2fd4] {\n  position: absolute;\n}\n.fade-enter-active[data-v-290b2fd4], .fade-leave-active[data-v-290b2fd4] {\n  transition: padding 0.5s, width 0.5s;\n}\n.fade-enter[data-v-290b2fd4], .fade-leave-to[data-v-290b2fd4] /* .fade-leave-active \u0434\u043E \u0432\u0435\u0440\u0441\u0438\u0438 2.1.8 */ {\n  width: 0;\n  padding: 0 !important;\n}\n\n",map:{version:3,sources:["C:\\openserver\\OpenServer\\domains\\aspro\\local\\templates\\eshop_bootstrap_v4\\components\\bitrix\\sale.personal.order.detail\\bootstrap_v4\\vue\\src\\components\\app.vue"],names:[],mappings:";AAoBA;EACA,cAAA;EACA,iBAAA;EACA,8BAAA;AAEA;AAEA;EACA,6BAAA;AACA;AAEA;EACA,mBAAA;EACA,YAAA;EACA,YAAA;EACA,gBAAA;EACA,sBAAA;EACA,kBAAA;EACA,gBAAA;AACA;AAEA;EACA,kBAAA;EACA,gBAAA;EACA,sBAAA;AACA;AAIA;;EAEA,YAAA;AACA;AAEA;EACA,gBAAA;EACA,sBAAA;AACA;AAEA;;EAEA,kBAAA;AACA;AAEA;;EAEA,aAAA;EACA,gBAAA;EACA,kBAAA;AACA;AAEA;EACA,6BAAA;AACA;AAEA;EACA,kBAAA;AACA;AAGA;EACA,oCAAA;AACA;AACA;EACA,QAAA;EACA,qBAAA;AACA",file:"app.vue",sourcesContent:["<template>\n  <div class=\"order-detail-products-block\">\n    test vue\n  </div>\n</template>\n\n<script>\n\nimport animatedNumber from './animated-number.vue'\n\nexport default {\n  data() {\n    return {\n\n    }\n  },\n}\n</script>\n\n<style scoped>\n.reload-block-item {\n  display: table;\n  flex-flow: column;\n  justify-content: space-between;\n\n}\n\n.table-header {\n  border-bottom: 2px solid #000;\n}\n\n.order-detail-header-column {\n  display: table-cell;\n  width: 200px;\n  height: 30px;\n  max-height: 30px;\n  box-sizing: border-box;\n  position: relative;\n  max-width: 200px;\n}\n\n.container {\n  display: table-row;\n  max-height: 30px;\n  box-sizing: border-box;\n}\n\n\n\n.block,\n.change-text{\n  width: 100px;\n}\n\n.change-text {\n  padding: 2px 5px;\n  box-sizing: border-box;\n}\n\n.detail-order-header\n{\n  display: table-row;\n}\n\n.change-block\n{\n  display: flex;\n  max-width: 100px;\n  position: absolute;\n}\n\n.delete {\n  text-decoration: line-through;\n}\n\n.order-detail-product-delete {\n  position: absolute;\n}\n\n\n.fade-enter-active, .fade-leave-active {\n  transition: padding 0.5s, width 0.5s;\n}\n.fade-enter, .fade-leave-to /* .fade-leave-active \u0434\u043E \u0432\u0435\u0440\u0441\u0438\u0438 2.1.8 */ {\n  width: 0;\n  padding: 0 !important;\n}\n\n</style>"]},media:void 0})},{data(){return{}}},"data-v-290b2fd4",!1,void 0,!1,d,void 0,void 0);b.Vue.component("app",k)}(this.BX.Citrus.Order=this.BX.Citrus.Order||{},BX);
//# sourceMappingURL=script12.js.map