import{o as l,e as r,d as j,a as n,b as I,w,i as m,t as d,g as x,L as F,n as M,X as st,f,F as D,h as z,E as ot,G as lt,_ as ht,C as ct,p as dt,V as pt,m as ut,v as O,x as W,c as G}from"./app.56436720.js";import{t as ft}from"./FrontLayout.53e7ac29.js";/* empty css                                                                   */import{_ as J}from"./_plugin-vue_export-helper.cdc0426e.js";import{d as at,C as K,w as mt,a as yt,s as _t,p as gt,i as vt,h as bt,f as wt,b as xt,c as St}from"./water-waves.c74fef80.js";import{C as q,h as Z}from"./moment.f09a3ee0.js";const Et={__name:"AlertMessage",setup(s){const t=()=>{window.scroll({top:0,behavior:"smooth"})};return(e,i)=>(l(),r("div",{class:"alert-msg",onClick:t},"New Reports added."))}},Ct=J(Et,[["__scopeId","data-v-fd1bd42c"]]);/*!
  * PhotoSwipe Lightbox 5.3.2 - https://photoswipe.com
  * (c) 2022 Dmytro Semenov
  */function U(s,t,e){const i=document.createElement(t||"div");return s&&(i.className=s),e&&e.appendChild(i),i}function It(s,t,e){let i="translate3d("+s+"px,"+(t||0)+"px,0)";return e!==void 0&&(i+=" scale3d("+e+","+e+",1)"),i}function X(s,t,e){s.style.width=typeof t=="number"?t+"px":t,s.style.height=typeof e=="number"?e+"px":e}const _={IDLE:"idle",LOADING:"loading",LOADED:"loaded",ERROR:"error"};function Lt(s){if(s.which===2||s.ctrlKey||s.metaKey||s.altKey||s.shiftKey)return!0}function Y(s,t,e=document){let i=[];if(s instanceof Element)i=[s];else if(s instanceof NodeList||Array.isArray(s))i=Array.from(s);else{const a=typeof s=="string"?s:t;a&&(i=Array.from(e.querySelectorAll(a)))}return i}function kt(s){return typeof s=="function"&&s.prototype&&s.prototype.goTo}function it(){return!!(navigator.vendor&&navigator.vendor.match(/apple/i))}class Tt{constructor(t,e){this.type=t,e&&Object.assign(this,e)}preventDefault(){this.defaultPrevented=!0}}class $t{constructor(){this._listeners={},this._filters={},this.pswp=void 0,this.options=void 0}addFilter(t,e,i=100){this._filters[t]||(this._filters[t]=[]),this._filters[t].push({fn:e,priority:i}),this._filters[t].sort((a,h)=>a.priority-h.priority),this.pswp&&this.pswp.addFilter(t,e,i)}removeFilter(t,e){this._filters[t]&&(this._filters[t]=this._filters[t].filter(i=>i.fn!==e)),this.pswp&&this.pswp.removeFilter(t,e)}applyFilters(t,...e){return this._filters[t]&&this._filters[t].forEach(i=>{e[0]=i.fn.apply(this,e)}),e[0]}on(t,e){this._listeners[t]||(this._listeners[t]=[]),this._listeners[t].push(e),this.pswp&&this.pswp.on(t,e)}off(t,e){this._listeners[t]&&(this._listeners[t]=this._listeners[t].filter(i=>e!==i)),this.pswp&&this.pswp.off(t,e)}dispatch(t,e){if(this.pswp)return this.pswp.dispatch(t,e);const i=new Tt(t,e);return this._listeners&&this._listeners[t]&&this._listeners[t].forEach(a=>{a.call(this,i)}),i}}class Dt{constructor(t,e){this.element=U("pswp__img pswp__img--placeholder",t?"img":"",e),t&&(this.element.decoding="async",this.element.alt="",this.element.src=t,this.element.setAttribute("role","presentation")),this.element.setAttribute("aria-hiden","true")}setDisplayedSize(t,e){!this.element||(this.element.tagName==="IMG"?(X(this.element,250,"auto"),this.element.style.transformOrigin="0 0",this.element.style.transform=It(0,0,t/250)):X(this.element,t,e))}destroy(){this.element.parentNode&&this.element.remove(),this.element=null}}class At{constructor(t,e,i){this.instance=e,this.data=t,this.index=i,this.element=void 0,this.displayedImageWidth=0,this.displayedImageHeight=0,this.width=Number(this.data.w)||Number(this.data.width)||0,this.height=Number(this.data.h)||Number(this.data.height)||0,this.isAttached=!1,this.hasSlide=!1,this.state=_.IDLE,this.data.type?this.type=this.data.type:this.data.src?this.type="image":this.type="html",this.instance.dispatch("contentInit",{content:this})}removePlaceholder(){this.placeholder&&!this.keepPlaceholder()&&setTimeout(()=>{this.placeholder&&(this.placeholder.destroy(),this.placeholder=null)},1e3)}load(t,e){if(this.slide&&this.usePlaceholder())if(this.placeholder){const i=this.placeholder.element;i&&!i.parentElement&&this.slide.container.prepend(i)}else{const i=this.instance.applyFilters("placeholderSrc",this.data.msrc&&this.slide.isFirstSlide?this.data.msrc:!1,this);this.placeholder=new Dt(i,this.slide.container)}this.element&&!e||this.instance.dispatch("contentLoad",{content:this,isLazy:t}).defaultPrevented||(this.isImageContent()?(this.element=U("pswp__img","img"),this.displayedImageWidth&&this.loadImage(t)):(this.element=U("pswp__content"),this.element.innerHTML=this.data.html||""),e&&this.slide&&this.slide.updateContentSize(!0))}loadImage(t){const e=this.element;this.instance.dispatch("contentLoadImage",{content:this,isLazy:t}).defaultPrevented||(this.updateSrcsetSizes(),this.data.srcset&&(e.srcset=this.data.srcset),e.src=this.data.src,e.alt=this.data.alt||"",this.state=_.LOADING,e.complete?this.onLoaded():(e.onload=()=>{this.onLoaded()},e.onerror=()=>{this.onError()}))}setSlide(t){this.slide=t,this.hasSlide=!0,this.instance=t.pswp}onLoaded(){this.state=_.LOADED,this.slide&&(this.instance.dispatch("loadComplete",{slide:this.slide,content:this}),this.slide.isActive&&this.slide.heavyAppended&&!this.element.parentNode&&(this.append(),this.slide.updateContentSize(!0)),(this.state===_.LOADED||this.state===_.ERROR)&&this.removePlaceholder())}onError(){this.state=_.ERROR,this.slide&&(this.displayError(),this.instance.dispatch("loadComplete",{slide:this.slide,isError:!0,content:this}),this.instance.dispatch("loadError",{slide:this.slide,content:this}))}isLoading(){return this.instance.applyFilters("isContentLoading",this.state===_.LOADING,this)}isError(){return this.state===_.ERROR}isImageContent(){return this.type==="image"}setDisplayedSize(t,e){if(!!this.element&&(this.placeholder&&this.placeholder.setDisplayedSize(t,e),!this.instance.dispatch("contentResize",{content:this,width:t,height:e}).defaultPrevented&&(X(this.element,t,e),this.isImageContent()&&!this.isError()))){const i=!this.displayedImageWidth&&t;this.displayedImageWidth=t,this.displayedImageHeight=e,i?this.loadImage(!1):this.updateSrcsetSizes(),this.slide&&this.instance.dispatch("imageSizeChange",{slide:this.slide,width:t,height:e,content:this})}}isZoomable(){return this.instance.applyFilters("isContentZoomable",this.isImageContent()&&this.state!==_.ERROR,this)}updateSrcsetSizes(){if(this.data.srcset){const t=this.element,e=this.instance.applyFilters("srcsetSizesWidth",this.displayedImageWidth,this);(!t.dataset.largestUsedSize||e>parseInt(t.dataset.largestUsedSize,10))&&(t.sizes=e+"px",t.dataset.largestUsedSize=String(e))}}usePlaceholder(){return this.instance.applyFilters("useContentPlaceholder",this.isImageContent(),this)}lazyLoad(){this.instance.dispatch("contentLazyLoad",{content:this}).defaultPrevented||this.load(!0)}keepPlaceholder(){return this.instance.applyFilters("isKeepingPlaceholder",this.isLoading(),this)}destroy(){this.hasSlide=!1,this.slide=null,!this.instance.dispatch("contentDestroy",{content:this}).defaultPrevented&&(this.remove(),this.placeholder&&(this.placeholder.destroy(),this.placeholder=null),this.isImageContent()&&this.element&&(this.element.onload=null,this.element.onerror=null,this.element=null))}displayError(){if(this.slide){let t=U("pswp__error-msg");t.innerText=this.instance.options.errorMsg,t=this.instance.applyFilters("contentErrorElement",t,this),this.element=U("pswp__content pswp__error-msg-container"),this.element.appendChild(t),this.slide.container.innerText="",this.slide.container.appendChild(this.element),this.slide.updateContentSize(!0),this.removePlaceholder()}}append(){if(this.isAttached)return;if(this.isAttached=!0,this.state===_.ERROR){this.displayError();return}if(this.instance.dispatch("contentAppend",{content:this}).defaultPrevented)return;const t="decode"in this.element;this.isImageContent()?t&&this.slide&&(!this.slide.isActive||it())?(this.isDecoding=!0,this.element.decode().finally(()=>{this.isDecoding=!1,this.appendImage()})):this.appendImage():this.element&&!this.element.parentNode&&this.slide.container.appendChild(this.element)}activate(){this.instance.dispatch("contentActivate",{content:this}).defaultPrevented||this.slide&&(this.isImageContent()&&this.isDecoding&&!it()?this.appendImage():this.isError()&&this.load(!1,!0))}deactivate(){this.instance.dispatch("contentDeactivate",{content:this})}remove(){this.isAttached=!1,!this.instance.dispatch("contentRemove",{content:this}).defaultPrevented&&(this.element&&this.element.parentNode&&this.element.remove(),this.placeholder&&this.placeholder.element&&this.placeholder.element.remove())}appendImage(){!this.isAttached||this.instance.dispatch("contentAppendImage",{content:this}).defaultPrevented||(this.slide&&this.element&&!this.element.parentNode&&this.slide.container.appendChild(this.element),(this.state===_.LOADED||this.state===_.ERROR)&&this.removePlaceholder())}}function Pt(s,t){if(s.getViewportSizeFn){const e=s.getViewportSizeFn(s,t);if(e)return e}return{x:document.documentElement.clientWidth,y:window.innerHeight}}function V(s,t,e,i,a){let h;if(t.paddingFn)h=t.paddingFn(e,i,a)[s];else if(t.padding)h=t.padding[s];else{const u="padding"+s[0].toUpperCase()+s.slice(1);t[u]&&(h=t[u])}return h||0}function Mt(s,t,e,i){return{x:t.x-V("left",s,t,e,i)-V("right",s,t,e,i),y:t.y-V("top",s,t,e,i)-V("bottom",s,t,e,i)}}const nt=4e3;class zt{constructor(t,e,i,a){this.pswp=a,this.options=t,this.itemData=e,this.index=i}update(t,e,i){this.elementSize={x:t,y:e},this.panAreaSize=i;const a=this.panAreaSize.x/this.elementSize.x,h=this.panAreaSize.y/this.elementSize.y;this.fit=Math.min(1,a<h?a:h),this.fill=Math.min(1,a>h?a:h),this.vFill=Math.min(1,h),this.initial=this._getInitial(),this.secondary=this._getSecondary(),this.max=Math.max(this.initial,this.secondary,this._getMax()),this.min=Math.min(this.fit,this.initial,this.secondary),this.pswp&&this.pswp.dispatch("zoomLevelsUpdate",{zoomLevels:this,slideData:this.itemData})}_parseZoomLevelOption(t){const e=t+"ZoomLevel",i=this.options[e];if(!!i)return typeof i=="function"?i(this):i==="fill"?this.fill:i==="fit"?this.fit:Number(i)}_getSecondary(){let t=this._parseZoomLevelOption("secondary");return t||(t=Math.min(1,this.fit*3),t*this.elementSize.x>nt&&(t=nt/this.elementSize.x),t)}_getInitial(){return this._parseZoomLevelOption("initial")||this.fit}_getMax(){const t=this._parseZoomLevelOption("max");return t||Math.max(1,this.fit*4)}}function rt(s,t,e){const i=t.createContentFromData(s,e);if(!i||!i.lazyLoad)return;const{options:a}=t,h=t.viewportSize||Pt(a,t),u=Mt(a,h,s,e),v=new zt(a,s,-1);return v.update(i.width,i.height,u),i.lazyLoad(),i.setDisplayedSize(Math.ceil(i.width*v.initial),Math.ceil(i.height*v.initial)),i}function Ot(s,t){const e=t.getItemData(s);if(!t.dispatch("lazyLoadSlide",{index:s,itemData:e}).defaultPrevented)return rt(e,t,s)}class Ft extends $t{getNumItems(){let t;const{dataSource:e}=this.options;e?"length"in e?t=e.length:"gallery"in e&&(e.items||(e.items=this._getGalleryDOMElements(e.gallery)),e.items&&(t=e.items.length)):t=0;const i=this.dispatch("numItems",{dataSource:e,numItems:t});return this.applyFilters("numItems",i.numItems,e)}createContentFromData(t,e){return new At(t,this,e)}getItemData(t){const{dataSource:e}=this.options;let i;Array.isArray(e)?i=e[t]:e&&e.gallery&&(e.items||(e.items=this._getGalleryDOMElements(e.gallery)),i=e.items[t]);let a=i;a instanceof Element&&(a=this._domElementToItemData(a));const h=this.dispatch("itemData",{itemData:a||{},index:t});return this.applyFilters("itemData",h.itemData,t)}_getGalleryDOMElements(t){return this.options.children||this.options.childSelector?Y(this.options.children,this.options.childSelector,t)||[]:[t]}_domElementToItemData(t){const e={element:t},i=t.tagName==="A"?t:t.querySelector("a");if(i){e.src=i.dataset.pswpSrc||i.href,i.dataset.pswpSrcset&&(e.srcset=i.dataset.pswpSrcset),e.width=parseInt(i.dataset.pswpWidth,10),e.height=parseInt(i.dataset.pswpHeight,10),e.w=e.width,e.h=e.height,i.dataset.pswpType&&(e.type=i.dataset.pswpType);const a=t.querySelector("img");a&&(e.msrc=a.currentSrc||a.src,e.alt=a.getAttribute("alt")),(i.dataset.pswpCropped||i.dataset.cropped)&&(e.thumbCropped=!0)}return this.applyFilters("domItemData",e,t,i)}lazyLoadData(t,e){return rt(t,this,e)}}class Rt extends Ft{constructor(t){super(),this.options=t||{},this._uid=0}init(){this.onThumbnailsClick=this.onThumbnailsClick.bind(this),Y(this.options.gallery,this.options.gallerySelector).forEach(t=>{t.addEventListener("click",this.onThumbnailsClick,!1)})}onThumbnailsClick(t){if(Lt(t)||window.pswp||window.navigator.onLine===!1)return;let e={x:t.clientX,y:t.clientY};!e.x&&!e.y&&(e=null);let i=this.getClickedIndex(t);i=this.applyFilters("clickedIndex",i,t,this);const a={gallery:t.currentTarget};i>=0&&(t.preventDefault(),this.loadAndOpen(i,a,e))}getClickedIndex(t){if(this.options.getClickedIndexFn)return this.options.getClickedIndexFn.call(this,t);const e=t.target,a=Y(this.options.children,this.options.childSelector,t.currentTarget).findIndex(h=>h===e||h.contains(e));return a!==-1?a:this.options.children||this.options.childSelector?-1:0}loadAndOpen(t,e,i){return window.pswp?!1:(this.options.index=t,this.options.initialPointerPos=i,this.shouldOpen=!0,this.preload(t,e),!0)}preload(t,e){const{options:i}=this;e&&(i.dataSource=e);const a=[],h=typeof i.pswpModule;if(kt(i.pswpModule))a.push(Promise.resolve(i.pswpModule));else{if(h==="string")throw new Error("pswpModule as string is no longer supported");if(h==="function")a.push(i.pswpModule());else throw new Error("pswpModule is not valid")}typeof i.openPromise=="function"&&a.push(i.openPromise()),i.preloadFirstSlide!==!1&&t>=0&&(this._preloadedContent=Ot(t,this));const u=++this._uid;Promise.all(a).then(v=>{if(this.shouldOpen){const p=v[0];this._openPhotoswipe(p,u)}})}_openPhotoswipe(t,e){if(e!==this._uid&&this.shouldOpen||(this.shouldOpen=!1,window.pswp))return;const i=typeof t=="object"?new t.default(this.options):new t(this.options);this.pswp=i,window.pswp=i,Object.keys(this._listeners).forEach(a=>{this._listeners[a].forEach(h=>{i.on(a,h)})}),Object.keys(this._filters).forEach(a=>{this._filters[a].forEach(h=>{i.addFilter(a,h.fn,h.priority)})}),this._preloadedContent&&(i.contentLoader.addToCache(this._preloadedContent),this._preloadedContent=null),i.on("destroy",()=>{this.pswp=null,window.pswp=null}),i.init()}destroy(){this.pswp&&this.pswp.destroy(),this.shouldOpen=!1,this._listeners=null,Y(this.options.gallery,this.options.gallerySelector).forEach(t=>{t.removeEventListener("click",this.onThumbnailsClick,!1)})}}const S=s=>(ot("data-v-7a946a21"),s=s(),lt(),s),Nt={class:"single-post-box"},Ht={class:"title-post"},Bt={class:"text-capitalize"},Wt={style:{display:"flex","justify-content":"space-between","align-items":"center"}},Ut={style:{"flex-grow":"1"}},Vt={class:"post-tags"},Yt=S(()=>n("i",{class:"fa fa-user"},null,-1)),Gt=m("by "),Zt={href:"#"},jt=S(()=>n("i",{class:"fa fa-clock-o"},null,-1)),Kt=S(()=>n("i",{class:"fa fa-bookmark"},null,-1)),qt={class:"post-tags share-post-links"},Xt={class:"share-post-mobile",style:{position:"relative"}},Jt={class:"btn",style:{"margin-right":"0","background-color":"#1854dd"}},Qt=["href"],te=S(()=>n("i",{class:"fa-brands fa-facebook-f",style:{"margin-right":"0",color:"#fff"}},null,-1)),ee=[te],se={class:"btn",style:{"margin-right":"0","background-color":"#18a3dd"}},ie=["href"],ne=S(()=>n("i",{class:"fa fa-twitter",style:{"margin-right":"0",color:"#fff"}},null,-1)),oe=[ne],le={class:"btn",style:{"background-color":"#25d366"}},ae=["href"],re=S(()=>n("i",{class:"fa fa-whatsapp",style:{"margin-right":"0",color:"#fff"}},null,-1)),he=[re],ce=S(()=>n("i",{class:"fa fa-share-alt"},null,-1)),de=S(()=>n("span",{class:"text-uppercase"},"Share",-1)),pe=[ce,de],ue={key:0,class:"post-gallery float-img",style:{float:"left",margin:"0px 15px 5px 0px"}},fe={style:{position:"relative"}},me=["src"],ye={key:0,class:"image-caption"},_e=["innerHTML"],ge={key:0},ve={key:0},be=["src"],we=["src"],xe=S(()=>n("span",{style:{"white-space":"nowrap"}},null,-1)),Se={key:1,class:"text-center hide-on-tablet"},Ee={key:2,class:"text-center hide-on-tablet"},Ce={key:3,class:"text-right"},Ie={key:4,class:"text-right hide-on-mobile"},Le={key:0,style:{"margin-left":"10px"}},ke={key:0,class:"fa-sharp fa-solid fa-caret-up text-green"},Te={key:1,style:{"margin-left":"10px"}},$e={key:0,class:"fa-sharp fa-solid fa-caret-down text-red"},De={key:1,class:"post-tags-box margin-top"},Ae={class:"tags-box"},Pe=S(()=>n("i",{class:"fa fa-tags"},null,-1)),Me=S(()=>n("span",null,"Tags:",-1)),ze={__name:"EachReport",props:{item:{type:Object}},setup(s){const t=s,e=u=>{let v=t.item.event.date_end;return Z().format("MMM D YYYY")>v?Z(u).format("MMM DD YYYY"):Z(u).fromNow()};j(0);const i=j(!1),a=()=>{i.value=!i.value};function h(u){switch(u){case"brokenMirror":return St;case"bulletHole":return xt;case"flames":return wt;case"happyBirthday":return bt;case"iceCubes":return vt;case"pocketAces":return gt;case"sunRays":return _t;case"waterLeaves":return yt;case"waterWaves":return mt}}return(u,v)=>{var p,y,A;return l(),r("div",Nt,[n("div",Ht,[n("h1",Bt,[I(x(F),{class:"default-text-color",href:`/event/${s.item.event.slug}/report/${s.item.slug}`},{default:w(()=>[m(d(s.item.title),1)]),_:1},8,["href"])]),n("div",Wt,[n("div",Ut,[n("ul",Vt,[n("li",null,[Yt,Gt,n("a",Zt,d((p=s.item.author)==null?void 0:p.first_name)+" "+d((y=s.item.author)==null?void 0:y.last_name),1)]),n("li",null,[jt,m(d(s.item.isFinished?e(s.item.date_added):s.item.formattedDate),1)]),n("li",null,[Kt,m(d(s.item.level.level),1)])])]),n("div",null,[n("ul",qt,[n("div",Xt,[n("div",{class:M(["btn-group-vertical social-links-group",{show:i.value}])},[n("li",Jt,[n("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+s.item.slug+"&src=sdkpreparse"},ee,8,Qt)]),n("li",se,[n("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+s.item.slug},oe,8,ie)]),n("li",le,[n("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+s.item.slug},he,8,ae)])],2),n("li",{onClick:a,class:"btn btn-default share-btn-mobile"},pe)])])])])]),n("div",{class:M([(A=s.item)!=null&&A.main_image?"post-content-min-height":"","post-content"])},[s.item.main_image?(l(),r("div",ue,[n("div",fe,[n("img",{src:s.item.main_image,alt:"",style:st([{"margin-bottom":"unset"},[s.item.theme?{filter:"brightness(0.8)"}:{}]])},null,12,me),n("div",{class:"imageFrame",style:st({"background-image":"url("+h(s.item.theme)+")"})},null,4)]),s.item.caption?(l(),r("span",ye,d(s.item.caption),1)):f("",!0)])):f("",!0),n("div",{class:"remove-padding",innerHTML:s.item.content},null,8,_e)],2),s.item.event_chips?(l(),r("div",ge,[I(K,null,{"table-body":w(()=>[(l(!0),r(D,null,z(s.item.event_chips,(c,P)=>{var R,N,o,b,E,C,L,k,T,$,H,B;return l(),r("tr",{key:P},[((R=c.player)==null?void 0:R.name)!=null?(l(),r("td",ve,[(N=c.player)!=null&&N.avatar?(l(),r("img",{key:0,class:"hide-on-mobile",src:(o=c.player)==null?void 0:o.avatar},null,8,be)):(l(),r("img",{key:1,class:"hide-on-mobile",src:x(at)},null,8,we)),m(" "+d((b=c.player)==null?void 0:b.name)+" ",1),xe])):f("",!0),((E=c.player)==null?void 0:E.name)!=null&&((C=c.player)==null?void 0:C.country)?(l(),r("td",Se,[I(x(q),{title:(k=(L=c.player)==null?void 0:L.country)==null?void 0:k.name,iso:($=(T=c.player)==null?void 0:T.country)==null?void 0:$.iso_3166_2},null,8,["title","iso"])])):(l(),r("td",Ee)),((H=c.player)==null?void 0:H.name)!=null?(l(),r("td",Ce,d(c.current_chips===0?"BUSTED":c.current_chips.toLocaleString()),1)):f("",!0),((B=c.player)==null?void 0:B.name)!=null?(l(),r("td",Ie,[m(d(c.current_chips===0?"":c.changes.toLocaleString())+" ",1),c.symbol==="up"?(l(),r("span",Le,[c.current_chips!=0?(l(),r("i",ke)):f("",!0)])):(l(),r("span",Te,[c.current_chips!=0?(l(),r("i",$e)):f("",!0)]))])):f("",!0)])}),128))]),_:1})])):f("",!0),s.item.event_chips.length?(l(),r("div",De,[n("ul",Ae,[n("li",null,[Pe,Me,(l(!0),r(D,null,z(s.item.event_chips,c=>{var P;return l(),r("a",{href:"#",key:c.id},d((P=c==null?void 0:c.player)==null?void 0:P.name),1)}),128))])])])):f("",!0)])}}},Oe=J(ze,[["__scopeId","data-v-7a946a21"]]),g=s=>(ot("data-v-ffd5a790"),s=s(),lt(),s),Fe={class:"about-more-autor"},Re={class:"nav nav-tabs custom-tabs"},Ne=g(()=>n("span",{class:"hide-on-mobile"},"LIVE UPDATES",-1)),He=g(()=>n("span",{class:"show-on-mobile"},"UPDATES",-1)),Be=g(()=>n("span",{class:"hide-on-mobile"},"CHIP COUNTS",-1)),We=g(()=>n("span",{class:"show-on-mobile"},"CHIPS",-1)),Ue=m("GALLERY"),Ve=m("PAYOUT"),Ye=m("#WHATSAPP"),Ge={class:"tab-content"},Ze={id:"liveReport"},je={class:"day-divider",style:{"border-bottom":"1px solid #d3d3d3","margin-top":"20px"}},Ke=g(()=>n("br",null,null,-1)),qe={key:0},Xe={class:"margin-top"},Je=g(()=>n("tr",{class:"text-primary"},[n("th",{class:"text-center"},"Rank"),n("th",null,"Player"),n("th",{class:"text-center hide-on-tablet"}," Country "),n("th",{class:"text-right"},"Chips"),n("th",{class:"text-right hide-on-mobile"}," Progress ")],-1)),Qe={class:"text-center"},ts=["src"],es=["src"],ss={style:{"white-space":"nowrap"}},is={key:0},ns={key:0,class:"text-center hide-on-tablet"},os={key:1,class:"text-center hide-on-tablet"},ls={key:2,class:"text-right"},as={key:3,class:"text-right"},rs={key:4,class:"text-right"},hs=g(()=>n("i",{class:"fa fa-whatsapp"},null,-1)),cs=m(" whatsapp "),ds=[hs,cs],ps={key:5,class:"text-right hide-on-mobile"},us={key:0,style:{"margin-left":"10px"}},fs={key:0,class:"fa-sharp fa-solid fa-caret-up text-green"},ms={key:1,style:{"margin-left":"10px"}},ys={key:0,class:"fa-sharp fa-solid fa-caret-down text-red"},_s={class:"grid-box"},gs={id:"my-gallery",class:"row"},vs={class:"col-xs-12"},bs=["href"],ws=["src","alt"],xs={class:"margin-top"},Ss={class:"text-primary"},Es=g(()=>n("th",{class:"text-center"},"Place",-1)),Cs=g(()=>n("th",null,"Name",-1)),Is=g(()=>n("th",{class:"text-center hide-on-mobile"}," Country ",-1)),Ls={class:"text-right"},ks=m(" Prize ("),Ts=["innerHTML"],$s=m(") "),Ds={key:0},As={class:"text-center"},Ps={key:0,style:{"white-space":"nowrap"}},Ms={key:1},zs={class:"text-center hide-on-mobile"},Os={key:0},Fs={key:1},Rs={class:"text-right"},Ns=["innerHTML"],Hs={class:"margin-top"},Bs=g(()=>n("p",null,"Whatsapp",-1)),Ws=g(()=>n("i",{class:"fa-sharp fa-solid fa-chevron-up"},null,-1)),Us=[Ws],Vs={__name:"ReportList",props:{reports:{type:Object},event:{type:Object},currentTab:{type:String,default:"report"}},emits:["loadMore"],setup(s,{emit:t}){window.Echo.channel("report").listen("NewReport",p=>{ft(Ct,{position:"top-center",hideProgressBar:!0,type:"danger",transition:"slide",timeout:5e3,showIcon:!0,showCloseButton:!1})});function e(p){!p||t("loadMore")}const i=j(0);function a(){const p=document.querySelector(".custom-tabs"),{top:y}=p.getBoundingClientRect(),A=document.querySelector(".scroll-top");if(y<=0){p.style.border="none",p.style.backgroundColor="white",p.style.boxShadow="0px 8px 40px rgba(0, 0, 0, 0.20)",A.style.display="block";return}p.style.backgroundColor="none",p.style.boxShadow="none",A.style.display="none",p.style.borderBottom="2px solid #f44336"}function h(){window.scroll({top:0,behavior:"smooth"})}const u=p=>{i.value=p},v=new Rt({gallery:"#my-gallery",children:"a",pswpModule:()=>ht(()=>import("./photoswipe.esm.382b1873.js"),[])});return ct(()=>{window.removeEventListener("scroll",a),v.destroy()}),dt(async()=>{window.addEventListener("scroll",a),v.init()}),(p,y)=>{var c,P,R,N;const A=pt("observe-visibility");return l(),r(D,null,[n("div",Fe,[n("ul",Re,[n("li",{onClick:y[0]||(y[0]=ut(o=>u(s.currentTab),["prevent"])),class:M({active:s.currentTab=="reports"})},[I(x(F),{href:"/event/"+s.event.slug,"data-toggle":"tab"},{default:w(()=>[Ne,He]),_:1},8,["href"])],2),n("li",{onClick:y[1]||(y[1]=o=>u(s.currentTab)),class:M({active:s.currentTab=="chip-stack"})},[I(x(F),{href:"/event/"+s.event.slug+"/chip-stack","data-toggle":"tab"},{default:w(()=>[Be,We]),_:1},8,["href"])],2),n("li",{onClick:y[2]||(y[2]=o=>u(s.currentTab)),class:M({active:s.currentTab=="gallery"})},[I(x(F),{href:"/event/"+s.event.slug+"/gallery","data-toggle":"tab"},{default:w(()=>[Ue]),_:1},8,["href"])],2),n("li",{onClick:y[3]||(y[3]=o=>u(s.currentTab)),class:M({active:s.currentTab=="payout"})},[I(x(F),{href:"/event/"+s.event.slug+"/payout","data-toggle":"tab"},{default:w(()=>[Ve]),_:1},8,["href"])],2),n("li",{onClick:y[4]||(y[4]=o=>u(s.currentTab)),class:M({active:s.currentTab=="whatsapp"})},[I(x(F),{href:"/event/"+s.event.slug+"/whatsapp","data-toggle":"tab"},{default:w(()=>[Ye]),_:1},8,["href"])],2)]),n("div",Ge,[O(n("div",Ze,[(l(!0),r(D,null,z(s.reports,(o,b)=>(l(),r("div",{key:b,class:"single-post-box round"},[(l(!0),r(D,null,z(o.collection,(E,C)=>(l(),G(Oe,{key:C,item:E},null,8,["item"]))),128)),n("div",je,[n("span",null,d(o.level),1),Ke])]))),128)),s.reports.length?O((l(),r("div",qe,null,512)),[[A,e]]):f("",!0)],512),[[W,s.currentTab=="reports"&&s.reports.length]]),O(n("div",null,[n("div",Xe,[(P=(c=s.event)==null?void 0:c.chip_stacks)!=null&&P.length?(l(),G(K,{key:0},{"table-head":w(()=>[Je]),"table-body":w(()=>[(l(!0),r(D,null,z(s.event.chip_stacks,(o,b)=>{var E,C,L,k,T,$,H,B,Q,tt,et;return l(),r("tr",{key:(E=o==null?void 0:o.player)==null?void 0:E.id},[n("td",Qe,d(b+1),1),n("td",null,[(C=o==null?void 0:o.player)!=null&&C.avatar?(l(),r("img",{key:0,class:"hide-on-tablet",src:(L=o==null?void 0:o.player)==null?void 0:L.avatar},null,8,ts)):(l(),r("img",{key:1,class:"hide-on-tablet",src:x(at)},null,8,es)),n("span",ss,[m(d((k=o==null?void 0:o.player)==null?void 0:k.name)+" ",1),(T=o.player)!=null&&T.pseudonym?(l(),r("span",is,"("+d(($=o.player)==null?void 0:$.pseudonym)+")",1)):f("",!0)])]),(H=o==null?void 0:o.player)!=null&&H.country?(l(),r("td",ns,[I(x(q),{title:(Q=(B=o==null?void 0:o.player)==null?void 0:B.country)==null?void 0:Q.name,iso:(et=(tt=o==null?void 0:o.player)==null?void 0:tt.country)==null?void 0:et.iso_3166_2},null,8,["title","iso"])])):(l(),r("td",os," ? ")),o.report_id==null?(l(),r("td",ls,d(o.current_chips.toLocaleString()),1)):(l(),r("td",as,d(o.current_chips===0?"BUSTED":o.current_chips.toLocaleString()),1)),o.report_id==null?(l(),r("td",rs,ds)):(l(),r("td",ps,[m(d(o.current_chips===0?"":o.changes.toLocaleString())+" ",1),o.symbol==="up"?(l(),r("span",us,[o.current_chips!=0?(l(),r("i",fs)):f("",!0)])):(l(),r("span",ms,[o.current_chips!=0?(l(),r("i",ys)):f("",!0)]))]))])}),128))]),_:1})):f("",!0)])],512),[[W,s.currentTab=="chip-stack"]]),O(n("div",null,[n("div",_s,[n("div",gs,[n("div",vs,[(l(!0),r(D,null,z(s.event.gallery,(o,b)=>(l(),r("a",{key:b,href:o.main,"data-pswp-width":900,"data-pswp-height":640,target:"_blank",rel:"noreferrer"},[n("img",{style:{width:"120px","max-width":"100%",height:"auto","object-fit":"cover","margin-right":"10px","margin-bottom":"10px"},src:o.thumbnail,alt:o.thumbnail},null,8,ws)],8,bs))),128))])])])],512),[[W,s.currentTab=="gallery"]]),O(n("div",null,[n("div",xs,[(N=(R=s.event)==null?void 0:R.payouts)!=null&&N.length?(l(),G(K,{key:0},{"table-head":w(()=>[n("tr",Ss,[Es,Cs,Is,n("th",Ls,[ks,n("span",{innerHTML:s.event.currency.prefix},null,8,Ts),$s])])]),"table-body":w(()=>[(l(!0),r(D,null,z(s.event.payouts,o=>{var b,E,C,L,k,T,$;return l(),r("tr",{key:o.player},[o.player?(l(),r("div",Ds)):f("",!0),n("td",As,d(o.position),1),n("td",null,[(b=o.player)!=null&&b.name?(l(),r("span",Ps,d((E=o.player)==null?void 0:E.name),1)):(l(),r("span",Ms,"N/A"))]),n("td",zs,[(C=o.player)!=null&&C.country?(l(),r("span",Os,[I(x(q),{title:(k=(L=o.player)==null?void 0:L.country)==null?void 0:k.full_name,iso:($=(T=o.player)==null?void 0:T.country)==null?void 0:$.iso_3166_2},null,8,["title","iso"])])):(l(),r("span",Fs,"N/A"))]),n("td",Rs,[n("span",{innerHTML:s.event.currency.prefix},null,8,Ns),m(" "+d(Number(o.prize).toLocaleString()),1)])])}),128))]),_:1})):f("",!0)])],512),[[W,s.currentTab=="payout"]]),O(n("div",null,[n("div",Hs,[m(d(s.event.whatsapp)+" ",1),Bs])],512),[[W,s.currentTab=="whatsapp"]])])]),n("div",{class:"scroll-top"},[n("button",{onClick:h,class:"btn btn-danger scroll-top-btn"},Us)])],64)}}},Xs=J(Vs,[["__scopeId","data-v-ffd5a790"]]);export{Xs as R};
