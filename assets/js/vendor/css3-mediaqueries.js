"function"!=typeof Object.create&&(Object.create=function(e){function t(){}return t.prototype=e,new t});var ua={toString:function(){return navigator.userAgent},test:function(e){return this.toString().toLowerCase().indexOf(e.toLowerCase())>-1}};ua.version=(ua.toString().toLowerCase().match(/[\s\S]+(?:rv|it|ra|ie)[\/: ]([\d.]+)/)||[])[1],ua.webkit=ua.test("webkit"),ua.gecko=ua.test("gecko")&&!ua.webkit,ua.opera=ua.test("opera"),ua.ie=ua.test("msie")&&!ua.opera,ua.ie6=ua.ie&&document.compatMode&&"undefined"==typeof document.documentElement.style.maxHeight,ua.ie7=ua.ie&&document.documentElement&&"undefined"!=typeof document.documentElement.style.maxHeight&&"undefined"==typeof XDomainRequest,ua.ie8=ua.ie&&"undefined"!=typeof XDomainRequest;var domReady=function(){var e=[],t=function(){if(!arguments.callee.done){arguments.callee.done=!0;for(var t=0;t<e.length;t++)e[t]()}};return document.addEventListener&&document.addEventListener("DOMContentLoaded",t,!1),ua.ie&&(!function(){try{document.documentElement.doScroll("left"),document.body.length}catch(e){return setTimeout(arguments.callee,50),void 0}t()}(),document.onreadystatechange=function(){"complete"===document.readyState&&(document.onreadystatechange=null,t())}),ua.webkit&&document.readyState&&!function(){"loading"!==document.readyState?t():setTimeout(arguments.callee,10)}(),window.onload=t,function(n){return"function"==typeof n&&(t.done?n():e[e.length]=n),n}}(),cssHelper=function(){var e,t={BLOCKS:/[^\s{;][^{;]*\{(?:[^{}]*\{[^{}]*\}[^{}]*|[^{}]*)*\}/g,BLOCKS_INSIDE:/[^\s{][^{]*\{[^{}]*\}/g,DECLARATIONS:/[a-zA-Z\-]+[^;]*:[^;]+;/g,RELATIVE_URLS:/url\(['"]?([^\/\)'"][^:\)'"]+)['"]?\)/g,REDUNDANT_COMPONENTS:/(?:\/\*([^*\\\\]|\*(?!\/))+\*\/|@import[^;]+;|@-moz-document\s*url-prefix\(\)\s*{(([^{}])+{([^{}])+}([^{}])+)+})/g,REDUNDANT_WHITESPACE:/\s*(,|:|;|\{|\})\s*/g,WHITESPACE_IN_PARENTHESES:/\(\s*(\S*)\s*\)/g,MORE_WHITESPACE:/\s{2,}/g,FINAL_SEMICOLONS:/;\}/g,NOT_WHITESPACE:/\S+/g},n=!1,r=[],s=function(e){"function"==typeof e&&(r[r.length]=e)},o=function(){for(var t=0;t<r.length;t++)r[t](e)},u={},l=function(e,t){if(u[e]){var n=u[e].listeners;if(n)for(var r=0;r<n.length;r++)n[r](t)}},a=function(e,t,n){if(ua.ie&&!window.XMLHttpRequest&&(window.XMLHttpRequest=function(){return new ActiveXObject("Microsoft.XMLHTTP")}),!XMLHttpRequest)return"";var r=new XMLHttpRequest;try{r.open("get",e,!0),r.setRequestHeader("X_REQUESTED_WITH","XMLHttpRequest")}catch(i){return n(),void 0}var s=!1;setTimeout(function(){s=!0},5e3),document.documentElement.style.cursor="progress",r.onreadystatechange=function(){4!==r.readyState||s||(!r.status&&"file:"===location.protocol||r.status>=200&&r.status<300||304===r.status||navigator.userAgent.indexOf("Safari")>-1&&"undefined"==typeof r.status?t(r.responseText):n(),document.documentElement.style.cursor="",r=null)},r.send("")},c=function(e){return e=e.replace(t.REDUNDANT_COMPONENTS,""),e=e.replace(t.REDUNDANT_WHITESPACE,"$1"),e=e.replace(t.WHITESPACE_IN_PARENTHESES,"($1)"),e=e.replace(t.MORE_WHITESPACE," "),e=e.replace(t.FINAL_SEMICOLONS,"}")},d={stylesheet:function(e){var n={},r=[],i=[],s=[],o=[],u=e.cssHelperText,l=e.getAttribute("media");if(l)var a=l.toLowerCase().split(",");else var a=["all"];for(var c=0;c<a.length;c++)r[r.length]=d.mediaQuery(a[c],n);var f=u.match(t.BLOCKS);if(null!==f)for(var c=0;c<f.length;c++)if("@media "===f[c].substring(0,7)){var g=d.mediaQueryList(f[c],n);s=s.concat(g.getRules()),i[i.length]=g}else s[s.length]=o[o.length]=d.rule(f[c],n,null);return n.element=e,n.getCssText=function(){return u},n.getAttrMediaQueries=function(){return r},n.getMediaQueryLists=function(){return i},n.getRules=function(){return s},n.getRulesWithoutMQ=function(){return o},n},mediaQueryList:function(e,n){var r={},i=e.indexOf("{"),s=e.substring(0,i);e=e.substring(i+1,e.length-1);for(var o=[],u=[],l=s.toLowerCase().substring(7).split(","),a=0;a<l.length;a++)o[o.length]=d.mediaQuery(l[a],r);var c=e.match(t.BLOCKS_INSIDE);if(null!==c)for(a=0;a<c.length;a++)u[u.length]=d.rule(c[a],n,r);return r.type="mediaQueryList",r.getMediaQueries=function(){return o},r.getRules=function(){return u},r.getListText=function(){return s},r.getCssText=function(){return e},r},mediaQuery:function(e,n){e=e||"";var r,i;"mediaQueryList"===n.type?r=n:i=n;for(var s,o=!1,u=[],l=!0,a=e.match(t.NOT_WHITESPACE),c=0;c<a.length;c++){var d=a[c];if(s||"not"!==d&&"only"!==d)if(s){if("("===d.charAt(0)){var f=d.substring(1,d.length-1).split(":");u[u.length]={mediaFeature:f[0],value:f[1]||null}}}else s=d;else"not"===d&&(o=!0)}return{getQueryText:function(){return e},getAttrStyleSheet:function(){return i||null},getList:function(){return r||null},getValid:function(){return l},getNot:function(){return o},getMediaType:function(){return s},getExpressions:function(){return u}}},rule:function(e,t,n){for(var r={},i=e.indexOf("{"),s=e.substring(0,i),o=s.split(","),u=[],l=e.substring(i+1,e.length-1).split(";"),a=0;a<l.length;a++)u[u.length]=d.declaration(l[a],r);return r.getStylesheet=function(){return t||null},r.getMediaQueryList=function(){return n||null},r.getSelectors=function(){return o},r.getSelectorText=function(){return s},r.getDeclarations=function(){return u},r.getPropertyValue=function(e){for(var t=0;t<u.length;t++)if(u[t].getProperty()===e)return u[t].getValue();return null},r},declaration:function(e,t){var n=e.indexOf(":"),r=e.substring(0,n),i=e.substring(n+1);return{getRule:function(){return t||null},getProperty:function(){return r},getValue:function(){return i}}}},f=function(t){if("string"==typeof t.cssHelperText){var n={stylesheet:null,mediaQueryLists:[],rules:[],selectors:{},declarations:[],properties:{}},r=n.stylesheet=d.stylesheet(t),s=(n.mediaQueryLists=r.getMediaQueryLists(),n.rules=r.getRules()),o=n.selectors,u=function(e){for(var t=e.getSelectors(),n=0;n<t.length;n++){var r=t[n];o[r]||(o[r]=[]),o[r][o[r].length]=e}};for(i=0;i<s.length;i++)u(s[i]);var l=n.declarations;for(i=0;i<s.length;i++)l=n.declarations=l.concat(s[i].getDeclarations());var a=n.properties;for(i=0;i<l.length;i++){var c=l[i].getProperty();a[c]||(a[c]=[]),a[c][a[c].length]=l[i]}return t.cssHelperParsed=n,e[e.length]=t,n}},g=function(e,t){},m=function(){n=!0,e=[];for(var r=[],i=function(){for(var e=0;e<r.length;e++)f(r[e]);var t=document.getElementsByTagName("style");for(e=0;e<t.length;e++)g(t[e]);n=!1,o()},s=document.getElementsByTagName("link"),u=0;u<s.length;u++){var l=s[u];l.getAttribute("rel").indexOf("style")>-1&&l.href&&0!==l.href.length&&!l.disabled&&(r[r.length]=l)}if(r.length>0){var d=0,m=function(){d++,d===r.length&&i()},h=function(e){var n=e.href;a(n,function(r){r=c(r).replace(t.RELATIVE_URLS,"url("+n.substring(0,n.lastIndexOf("/"))+"/$1)"),e.cssHelperText=r,m()},m)};for(u=0;u<r.length;u++)h(r[u])}else i()},h={stylesheets:"array",mediaQueryLists:"array",rules:"array",selectors:"object",declarations:"array",properties:"object"},p={stylesheets:null,mediaQueryLists:null,rules:null,selectors:null,declarations:null,properties:null},y=function(e,t){if(null!==p[e]){if("array"===h[e])return p[e]=p[e].concat(t);var n=p[e];for(var r in t)t.hasOwnProperty(r)&&(n[r]=n[r]?n[r].concat(t[r]):t[r]);return n}},v=function(t){p[t]="array"===h[t]?[]:{};for(var n=0;n<e.length;n++){var r="stylesheets"===t?"stylesheet":t;y(t,e[n].cssHelperParsed[r])}return p[t]},E=function(e){return"undefined"!=typeof window.innerWidth?window["inner"+e]:"undefined"!=typeof document.documentElement&&"undefined"!=typeof document.documentElement.clientWidth&&0!=document.documentElement.clientWidth?document.documentElement["client"+e]:void 0};return{addStyle:function(e,t,n){var r,i="css-mediaqueries-js",s="",o=document.getElementById(i);return t&&t.length>0&&(s=t.join(","),i+=s),null!==o?r=o:(r=document.createElement("style"),r.setAttribute("type","text/css"),r.setAttribute("id",i),r.setAttribute("media",s),document.getElementsByTagName("head")[0].appendChild(r)),r.styleSheet?r.styleSheet.cssText+=e:r.appendChild(document.createTextNode(e)),r.addedWithCssHelper=!0,"undefined"==typeof n||n===!0?cssHelper.parsed(function(){var t=g(r,e);for(var n in t)t.hasOwnProperty(n)&&y(n,t[n]);l("newStyleParsed",r)}):r.parsingDisallowed=!0,r},removeStyle:function(e){return e.parentNode?e.parentNode.removeChild(e):void 0},parsed:function(t){n?s(t):"undefined"!=typeof e?"function"==typeof t&&t(e):(s(t),m())},stylesheets:function(e){cssHelper.parsed(function(){e(p.stylesheets||v("stylesheets"))})},mediaQueryLists:function(e){cssHelper.parsed(function(){e(p.mediaQueryLists||v("mediaQueryLists"))})},rules:function(e){cssHelper.parsed(function(){e(p.rules||v("rules"))})},selectors:function(e){cssHelper.parsed(function(){e(p.selectors||v("selectors"))})},declarations:function(e){cssHelper.parsed(function(){e(p.declarations||v("declarations"))})},properties:function(e){cssHelper.parsed(function(){e(p.properties||v("properties"))})},broadcast:l,addListener:function(e,t){"function"==typeof t&&(u[e]||(u[e]={listeners:[]}),u[e].listeners[u[e].listeners.length]=t)},removeListener:function(e,t){if("function"==typeof t&&u[e])for(var n=u[e].listeners,r=0;r<n.length;r++)n[r]===t&&(n.splice(r,1),r-=1)},getViewportWidth:function(){return E("Width")},getViewportHeight:function(){return E("Height")}}}();domReady(function(){var e,t={LENGTH_UNIT:/[0-9]+(em|ex|px|in|cm|mm|pt|pc)$/,RESOLUTION_UNIT:/[0-9]+(dpi|dpcm)$/,ASPECT_RATIO:/^[0-9]+\/[0-9]+$/,ABSOLUTE_VALUE:/^[0-9]*(\.[0-9]+)*$/},n=[],r=function(){var e="css3-mediaqueries-test",t=document.createElement("div");t.id=e;var n=cssHelper.addStyle("@media all and (width) { #"+e+" { width: 1px !important; } }",[],!1);document.body.appendChild(t);var i=1===t.offsetWidth;return n.parentNode.removeChild(n),t.parentNode.removeChild(t),r=function(){return i},i},i=function(){e=document.createElement("div"),e.style.cssText="position:absolute;top:-9999em;left:-9999em;margin:0;border:none;padding:0;width:1em;font-size:1em;",document.body.appendChild(e),16!==e.offsetWidth&&(e.style.fontSize=16/e.offsetWidth+"em"),e.style.width=""},s=function(t){e.style.width=t;var n=e.offsetWidth;return e.style.width="",n},o=function(e,n){var r=e.length,i="min-"===e.substring(0,4),o=!i&&"max-"===e.substring(0,4);if(null!==n){var u,l;if(t.LENGTH_UNIT.exec(n))u="length",l=s(n);else if(t.RESOLUTION_UNIT.exec(n)){u="resolution",l=parseInt(n,10);var a=n.substring((l+"").length)}else t.ASPECT_RATIO.exec(n)?(u="aspect-ratio",l=n.split("/")):t.ABSOLUTE_VALUE?(u="absolute",l=n):u="unknown"}var c,d;if("device-width"===e.substring(r-12,r))return c=screen.width,null!==n?"length"===u?i&&c>=l||o&&l>c||!i&&!o&&c===l:!1:c>0;if("device-height"===e.substring(r-13,r))return d=screen.height,null!==n?"length"===u?i&&d>=l||o&&l>d||!i&&!o&&d===l:!1:d>0;if("width"===e.substring(r-5,r))return c=document.documentElement.clientWidth||document.body.clientWidth,null!==n?"length"===u?i&&c>=l||o&&l>c||!i&&!o&&c===l:!1:c>0;if("height"===e.substring(r-6,r))return d=document.documentElement.clientHeight||document.body.clientHeight,null!==n?"length"===u?i&&d>=l||o&&l>d||!i&&!o&&d===l:!1:d>0;if("orientation"===e.substring(r-11,r))return c=document.documentElement.clientWidth||document.body.clientWidth,d=document.documentElement.clientHeight||document.body.clientHeight,"absolute"===u?"portrait"===l?d>=c:c>d:!1;if("aspect-ratio"===e.substring(r-12,r)){c=document.documentElement.clientWidth||document.body.clientWidth,d=document.documentElement.clientHeight||document.body.clientHeight;var f=c/d,g=l[1]/l[0];return"aspect-ratio"===u?i&&f>=g||o&&g>f||!i&&!o&&f===g:!1}if("device-aspect-ratio"===e.substring(r-19,r))return"aspect-ratio"===u&&screen.width*l[1]===screen.height*l[0];if("color-index"===e.substring(r-11,r)){var m=Math.pow(2,screen.colorDepth);return null!==n?"absolute"===u?i&&m>=l||o&&l>m||!i&&!o&&m===l:!1:m>0}if("color"===e.substring(r-5,r)){var h=screen.colorDepth;return null!==n?"absolute"===u?i&&h>=l||o&&l>h||!i&&!o&&h===l:!1:h>0}if("resolution"===e.substring(r-10,r)){var p;return p="dpcm"===a?s("1cm"):s("1in"),null!==n?"resolution"===u?i&&p>=l||o&&l>p||!i&&!o&&p===l:!1:p>0}return!1},u=function(e){var t=e.getValid(),n=e.getExpressions(),r=n.length;if(r>0){for(var i=0;r>i&&t;i++)t=o(n[i].mediaFeature,n[i].value);var s=e.getNot();return t&&!s||s&&!t}return t},l=function(e,t){for(var r=e.getMediaQueries(),i={},s=0;s<r.length;s++){var o=r[s].getMediaType();if(0!==r[s].getExpressions().length){var l=!0;if("all"!==o&&t&&t.length>0){l=!1;for(var a=0;a<t.length;a++)t[a]===o&&(l=!0)}l&&u(r[s])&&(i[o]=!0)}}var c=[],d=0;for(var f in i)i.hasOwnProperty(f)&&(d>0&&(c[d++]=","),c[d++]=f);c.length>0&&(n[n.length]=cssHelper.addStyle("@media "+c.join("")+"{"+e.getCssText()+"}",t,!1))},a=function(e,t){for(var n=0;n<e.length;n++)l(e[n],t)},c=function(e){for(var t=e.getAttrMediaQueries(),r=!1,i={},s=0;s<t.length;s++)u(t[s])&&(i[t[s].getMediaType()]=t[s].getExpressions().length>0);var o=[],l=[];for(var c in i)i.hasOwnProperty(c)&&(o[o.length]=c,i[c]&&(l[l.length]=c),"all"===c&&(r=!0));l.length>0&&(n[n.length]=cssHelper.addStyle(e.getCssText(),l,!1));var d=e.getMediaQueryLists();r?a(d):a(d,o)},d=function(e){for(var t=0;t<e.length;t++)c(e[t]);ua.ie?(document.documentElement.style.display="block",setTimeout(function(){document.documentElement.style.display=""},0),setTimeout(function(){cssHelper.broadcast("cssMediaQueriesTested")},100)):cssHelper.broadcast("cssMediaQueriesTested")},f=function(){for(var e=0;e<n.length;e++)cssHelper.removeStyle(n[e]);n=[],cssHelper.stylesheets(d)},g=0,m=function(){var e=cssHelper.getViewportWidth(),t=cssHelper.getViewportHeight();if(ua.ie){var n=document.createElement("div");n.style.position="absolute",n.style.top="-9999em",n.style.overflow="scroll",document.body.appendChild(n),g=n.offsetWidth-n.clientWidth,document.body.removeChild(n)}var i,s=function(){var n=cssHelper.getViewportWidth(),s=cssHelper.getViewportHeight();(Math.abs(n-e)>g||Math.abs(s-t)>g)&&(e=n,t=s,clearTimeout(i),i=setTimeout(function(){r()?cssHelper.broadcast("cssMediaQueriesTested"):f()},500))};window.onresize=function(){var e=window.onresize||function(){};return function(){e(),s()}}()},h=document.documentElement;return h.style.marginLeft="-32767px",setTimeout(function(){h.style.marginLeft=""},5e3),function(){r()?h.style.marginLeft="":(cssHelper.addListener("newStyleParsed",function(e){c(e.cssHelperParsed.stylesheet)}),cssHelper.addListener("cssMediaQueriesTested",function(){ua.ie&&(h.style.width="1px"),setTimeout(function(){h.style.width="",h.style.marginLeft=""},0),cssHelper.removeListener("cssMediaQueriesTested",arguments.callee)}),i(),f()),m()}}());try{document.execCommand("BackgroundImageCache",!1,!0)}catch(e){}