import{d as _,p as N,C as ge,o as d,e as w,a as o,b as p,w as b,g as k,L as E,n as Y,F as V,h as J,c as f,i as L,t as z,f as x,D as j,E as ee,G as te,I as oe,J as we,T as be,q as Z,j as H,K as ye,r as W,M as ue,m as ke,v as Ie,N as Te,l as ve,O as xe,P as Ee,Q as pe,R as he,H as Se}from"./app.56436720.js";import{_ as se}from"./_plugin-vue_export-helper.cdc0426e.js";const U=e=>(ee("data-v-0cbbc7be"),e=e(),te(),e),Ce={class:"navbar navbar-default navbar-static-top custom-header--bg",role:"navigation"},$e={class:"logo-advertisement custom-header--bg"},Le={class:"container"},Oe={class:"custom-header--flex"},Be={class:"navbar-header"},Me=U(()=>o("img",{class:"header-logo",src:"/lop_logo_white.svg",alt:"Logo"},null,-1)),ze=j('<div class="advertisement" style="align-self:center;padding:0;" data-v-0cbbc7be><div class="desktop-advert" data-v-0cbbc7be><h4 class="text-uppercase" style="color:#fff;" data-v-0cbbc7be> \u201CBRINGING THE ACTION TO YOUR DOORSTEP\u201D </h4></div></div><div class="advertisement" style="overflow:visible;padding:0;" data-v-0cbbc7be><div class="desktop-advert" data-v-0cbbc7be><div class="header-actions" data-v-0cbbc7be><div id="google_translate_element" data-v-0cbbc7be></div></div></div></div>',2),Ne=U(()=>o("span",{class:"sr-only"},"Toggle navigation",-1)),Pe=U(()=>o("span",{class:"icon-bar"},null,-1)),De=U(()=>o("span",{class:"icon-bar"},null,-1)),He=U(()=>o("span",{class:"icon-bar"},null,-1)),Re=[Ne,Pe,De,He],Ve={class:"nav-list-container",style:{border:"0"}},je={class:"container"},Ue={class:"nav navbar-nav navbar-left navbar-nav--custom"},Fe={key:2,class:"dropdown"},We={__name:"Header",setup(e){const t=_(!1),s=_(0),a=_(null),n=_(window.location.pathname.split("/")[1]);function i(){t.value=!t.value}function v(h){s.value=h.target.documentElement.scrollTop;var r=document.body.clientWidth;r<769||(s.value>=a.value.offsetTop+100?a.value.classList.add("active"):a.value.classList.remove("active"))}function u(){new google.translate.TranslateElement({pageLanguage:"en",includedLanguages:"zh-CN,zh-TW,en,ko,ja,es,de"},"google_translate_element");const h=document.getElementById("google_translate_element"),r=document.getElementsByClassName("goog-te-combo");h&&r&&(h.addEventListener("DOMNodeInserted",()=>{const c=r[0].options;Array.prototype.forEach.call(c,l=>{switch(l.value){case"zh-CN":l.text="\u4E2D\u6587 (\u7B80\u4F53)";break;case"zh-TW":l.text="\u4E2D\u6587 (\u7E41\u4F53)";break;case"de":l.text="Deutsch";break;case"ja":l.text="\u306B\u307B\u3093\u3054";break;case"ko":l.text="\uD55C\uAD6D\uC5B4";break;case"es":l.text="Espa\xF1ol";break;default:l.text="English"}})}),r[0].addEventListener("change",function(){r[0].value==="en"&&window.location.reload()}))}return N(()=>{n.value!=="tournament"&&n.value!=="event"&&n.value!=="article"&&window.addEventListener("scroll",v);let h=document.getElementById("google_translate_element");if(h){h.innerHTML="";const r=document.createElement("script");r.type="text/javascript",r.src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit",document.head.appendChild(r),setTimeout(()=>{u()},500);return}}),ge(()=>{window.removeEventListener("scroll",v)}),(h,r)=>(d(),w("header",{ref_key:"sticky",ref:a,class:"clearfix",style:{"z-index":"auto !important"}},[o("nav",Ce,[o("div",$e,[o("div",Le,[o("div",Oe,[o("div",Be,[p(k(E),{class:"navbar-brand",href:"/",style:{padding:"0"}},{default:b(()=>[Me]),_:1})]),ze,o("button",{type:"button",class:"navbar-toggle collapsed","data-toggle":"collapse","data-target":"#bs-example-navbar-collapse-1",style:{"align-self":"center",margin:"0 15px 0 0"},onClick:i},Re)])])]),o("div",Ve,[o("div",je,[o("div",{class:Y(["collapse navbar-collapse navbar-collapse--custom",{in:t.value}]),id:"bs-example-navbar-collapse-1"},[o("ul",Ue,[(d(!0),w(V,null,J(h.$page.props.menu,c=>(d(),w("li",{class:"drop",key:c.id},[c.children.length?(d(),f(k(E),{key:1,class:Y(["home home--custom",{child:c.children.length}])},{default:b(()=>[L(z(c.name),1)]),_:2},1032,["class"])):(d(),f(k(E),{key:0,class:Y(["home home--custom",{child:c.children.length,"router-link-active":n.value==c.link}]),href:"/"+c.link},{default:b(()=>[L(z(c.name),1)]),_:2},1032,["class","href"])),c.children.length?(d(),w("ul",Fe,[(d(!0),w(V,null,J(c.children,l=>(d(),w("li",{key:l.id},[c.link!==l.link?(d(),f(k(E),{key:0,href:"/"+c.link+"/"+l.link,style:{background:"rgb(239, 239, 239)"}},{default:b(()=>[L(z(l.name),1)]),_:2},1032,["href"])):(d(),f(k(E),{key:1,href:"/"+l.link,style:{background:"rgb(239, 239, 239)"}},{default:b(()=>[L(z(l.name),1)]),_:2},1032,["href"]))]))),128))])):x("",!0)]))),128))])],2)])])])],512))}},Ge=se(We,[["__scopeId","data-v-0cbbc7be"]]);var Xe=Object.defineProperty,qe=Object.defineProperties,Ae=Object.getOwnPropertyDescriptors,le=Object.getOwnPropertySymbols,Ye=Object.prototype.hasOwnProperty,Ke=Object.prototype.propertyIsEnumerable,re=(e,t,s)=>t in e?Xe(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,T=(e,t)=>{for(var s in t||(t={}))Ye.call(t,s)&&re(e,s,t[s]);if(le)for(var s of le(t))Ke.call(t,s)&&re(e,s,t[s]);return e},ae=(e,t)=>qe(e,Ae(t));const R={type:"default",timeout:5e3,showCloseButton:!0,position:"top-right",transition:"bounce",hideProgressBar:!1,swipeClose:!0};var B,$;($=B||(B={}))[$.TITLE_ONLY=0]="TITLE_ONLY",$[$.TITLE_DESCRIPTION=1]="TITLE_DESCRIPTION",$[$.COMPONENT=2]="COMPONENT",$[$.VNODE=3]="VNODE";const Qe={"top-left":{bounce:"mosha__bounceInLeft",zoom:"mosha__zoomIn",slide:"mosha__slideInLeft"},"top-right":{bounce:"mosha__bounceInRight",zoom:"mosha__zoomIn",slide:"mosha__slideInRight"},"top-center":{bounce:"mosha__bounceInDown",zoom:"mosha__zoomIn",slide:"mosha__slideInDown"},"bottom-center":{bounce:"mosha__bounceInUp",zoom:"mosha__zoomIn",slide:"mosha__slideInUp"},"bottom-right":{bounce:"mosha__bounceInRight",zoom:"mosha__zoomIn",slide:"mosha__slideInRight"},"bottom-left":{bounce:"mosha__bounceInLeft",zoom:"mosha__zoomIn",slide:"mosha__slideInLeft"}},de=(e,t=300)=>{let s;return(...a)=>{s&&(clearTimeout(s),s=void 0),s=setTimeout(()=>e(...a),t)}},Je=(e,t,s)=>{const a=_(),n=_(void 0),i=_(),v=r=>r instanceof MouseEvent,u=r=>{s!==!1&&a.value&&(v(r)?n.value=a.value.clientX-r.clientX:n.value=a.value.touches[0].clientX-r.touches[0].clientX,i.value=ae(T({},i.value),{transition:"none"}),e.endsWith("left")?i.value.left=-n.value+"px !important":e.endsWith("right")?i.value.right=`${n.value}px !important`:n.value>0?i.value.left=-n.value+"px !important":i.value.right=`${n.value}px !important`,Math.abs(n.value)>200&&t())},h=r=>{s!==!1&&(a.value&&(a.value=void 0),n.value&&(n.value=void 0),removeEventListener(r,u))};return Z(()=>{s!==!1&&(h("mousemove"),h("touchmove"))}),{swipedDiff:n,swipeStart:a,swipeStyle:i,swipeHandler:u,startSwipeHandler:r=>{if(s===!1)return;a.value=r;const c=v(r)?"mousemove":"touchmove",l=v(r)?"mouseup":"touchend";addEventListener(c,u),addEventListener(l,()=>(m=>{const O={transition:"left .3s ease-out",left:0},S={transition:"right .3s ease-out",right:0},X={transition:"all .3s ease-out",left:0,right:0};e.endsWith("left")?i.value=T(T({},i.value),O):e.endsWith("right")?i.value=T(T({},i.value),S):i.value=T(T({},i.value),X),a.value=void 0,n.value=void 0,removeEventListener(m,u)})(c))},cleanUpMove:h}};var _e=oe({props:{type:{type:String,default:"default"}}});const Ze={class:"mosha__icon"},et={key:0,xmlns:"http://www.w3.org/2000/svg",height:"32px",viewBox:"0 0 24 24",width:"32px",fill:"#ffffff"},tt=p("path",{d:"M4.47 21h15.06c1.54 0 2.5-1.67 1.73-3L13.73 4.99c-.77-1.33-2.69-1.33-3.46 0L2.74 18c-.77 1.33.19 3 1.73 3zM12 14c-.55 0-1-.45-1-1v-2c0-.55.45-1 1-1s1 .45 1 1v2c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z"},null,-1),ot={key:1,xmlns:"http://www.w3.org/2000/svg",height:"32px",viewBox:"0 0 24 24",width:"32px",fill:"#ffffff"},st=p("path",{d:"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z"},null,-1),at={key:2,xmlns:"http://www.w3.org/2000/svg",height:"32px",viewBox:"0 0 24 24",width:"32px",fill:"#ffffff"},nt=p("path",{d:"M0 0h24v24H0V0z",fill:"none"},null,-1),it=p("path",{d:"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z"},null,-1),lt={key:3,xmlns:"http://www.w3.org/2000/svg",height:"32px",viewBox:"0 0 24 24",width:"32px",fill:"#616161"},rt=p("path",{d:"M0 0h24v24H0z",fill:"none"},null,-1),dt=p("path",{d:"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"},null,-1),ct={key:4,xmlns:"http://www.w3.org/2000/svg",height:"32px",viewBox:"0 0 24 24",width:"32px",fill:"#ffffff"},ut=p("path",{d:"M0 0h24v24H0z",fill:"none"},null,-1),vt=p("path",{d:"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"},null,-1);_e.render=function(e,t,s,a,n,i){return d(),f("span",Ze,[e.type==="warning"?(d(),f("svg",et,[tt])):e.type==="danger"?(d(),f("svg",ot,[st])):e.type==="success"?(d(),f("svg",at,[nt,it])):e.type==="default"?(d(),f("svg",lt,[rt,dt])):(d(),f("svg",ct,[ut,vt]))])};var F=oe({name:"MToast",components:{MIcon:_e},props:{visible:Boolean,text:{type:String,default:""},description:{type:String,default:""},toastBackgroundColor:{type:String,default:""},type:{type:String,default:"default"},onClose:{type:Function,default:()=>null},onCloseHandler:{type:Function,required:!0},offset:{type:Number,required:!0},id:{type:Number,required:!0},timeout:{type:Number,default:5e3},position:{type:String,required:!0},showCloseButton:{type:Boolean,default:!0},swipeClose:{type:Boolean,default:!0},hideProgressBar:{type:Boolean,default:!1},showIcon:{type:Boolean,default:!1},transition:{type:String,default:"bounce"}},setup(e,t){const s=_(),{width:a}=(()=>{const y=_(-1),C=_(-1),g=I=>{I!==null&&I.currentTarget!==null&&(y.value=I.currentTarget.innerWidth,C.value=I.currentTarget.innerHeight)};return N(()=>{window.innerWidth>0&&(y.value=window.innerWidth,C.value=window.innerHeight),window.addEventListener("resize",de(g))}),Z(()=>{window.removeEventListener("resize",de(g))}),{width:y,height:C}})(),{swipedDiff:n,startSwipeHandler:i,swipeStyle:v,cleanUpMove:u}=Je(e.position,e.onCloseHandler,e.swipeClose),{transitionType:h}=(r=e.position,c=e.transition,l=n,{transitionType:H(()=>l.value>200?"mosha__fadeOutLeft":l.value<-200?"mosha__fadeOutRight":Qe[r][c])});var r,c,l;const{start:m,stop:O,progress:S}=((y,C)=>{const g=_(),I=_(0),D=_(C),A=_(),ne=_(100),ie=()=>{clearInterval(A.value),clearTimeout(g.value)};return N(()=>{}),Z(()=>{ie()}),{start:()=>{I.value=Date.now(),clearTimeout(g.value),A.value=setInterval(()=>{ne.value--},C/100-5),g.value=setTimeout(y,D.value)},stop:()=>{clearInterval(A.value),clearTimeout(g.value),D.value-=Date.now()-I.value},clear:ie,progress:ne}})(()=>{e.onCloseHandler()},e.timeout),X=H(()=>t.slots.default),me=H(()=>/<\/?[a-z][\s\S]*>/i.test(e.description)),q=()=>{e.timeout>0&&m()};return ye(()=>{const{customStyle:y}=((C,g,I)=>{const D=H(()=>{switch(C){case"top-left":return{left:"0",top:`${g}px`};case"bottom-left":return{left:"0",bottom:`${g}px`};case"bottom-right":return{right:"0",bottom:`${g}px`};case"top-center":return{top:`${g}px`,left:"0",right:"0",marginRight:"auto",marginLeft:"auto"};case"bottom-center":return{bottom:`${g}px`,left:"0",right:"0",marginRight:"auto",marginLeft:"auto"};default:return{right:"0",top:`${g}px`}}});return I.length>0&&(D.value.backgroundColor=I),{customStyle:D}})(e.position,e.offset,e.toastBackgroundColor);s.value=y.value}),N(()=>{q()}),{style:s,transitionType:h,startTimer:q,progress:S,onTouchStart:y=>{i(y)},onMouseLeave:()=>{u("mousemove"),q()},onMouseDown:y=>{i(y)},swipeStyle:v,isSlotPassed:X,isDescriptionHtml:me,onMouseEnter:()=>{e.timeout>0&&a.value>425&&O()}}}});const pt={class:"mosha__toast__content-wrapper"},ht={class:"mosha__toast__content"},_t={class:"mosha__toast__content__text"},ft={key:1,class:"mosha__toast__content__description"},mt={key:0,class:"mosha__toast__slot-wrapper"};F.render=function(e,t,s,a,n,i){const v=we("MIcon");return d(),f(be,{name:e.transitionType,type:"animation"},{default:b(()=>[e.visible?(d(),f("div",{key:0,class:["mosha__toast",e.toastBackgroundColor?null:e.type],style:[e.style,e.swipeStyle],onMouseenter:t[2]||(t[2]=(...u)=>e.onMouseEnter&&e.onMouseEnter(...u)),onMouseleave:t[3]||(t[3]=(...u)=>e.onMouseLeave&&e.onMouseLeave(...u)),onTouchstartPassive:t[4]||(t[4]=(...u)=>e.onTouchStart&&e.onTouchStart(...u)),onMousedown:t[5]||(t[5]=(...u)=>e.onMouseDown&&e.onMouseDown(...u))},[p("div",pt,[e.showIcon?(d(),f(v,{key:0,type:e.type},null,8,["type"])):x("",!0),p("div",ht,[p("div",_t,z(e.text),1),e.description.length>0&&e.isDescriptionHtml?(d(),f("div",{key:0,class:"mosha__toast__content__description",innerHTML:e.description},null,8,["innerHTML"])):x("",!0),e.description.length>0&&!e.isDescriptionHtml?(d(),f("div",ft,z(e.description),1)):x("",!0)])]),e.isSlotPassed?(d(),f("div",mt,[W(e.$slots,"default")])):x("",!0),e.showCloseButton?(d(),f("div",{key:1,class:"mosha__toast__close-icon",onClick:t[1]||(t[1]=(...u)=>e.onCloseHandler&&e.onCloseHandler(...u))})):x("",!0),e.hideProgressBar?x("",!0):(d(),f("div",{key:2,class:"mosha__toast__progress",style:{width:`${e.progress}%`}},null,4))],38)):x("",!0)]),_:3},8,["name"])};const G={"top-left":[],"top-right":[],"bottom-left":[],"bottom-right":[],"top-center":[],"bottom-center":[]};let gt=0;const wt=(e,t)=>{const s=gt++,a=t?bt(t):R;if(e.__v_isVNode)return K(s,B.VNODE,a,e),{close:()=>P(s,a.position)};if(e.hasOwnProperty("render"))return K(s,B.COMPONENT,a,e),{close:()=>P(s,a.position)};const n=yt(e);return K(s,B.TITLE_DESCRIPTION,a,n),{close:()=>P(s,a.position)}},K=(e,t,s,a)=>{setTimeout(()=>{const n=kt(s,G,12),i=document.createElement("div");let v;document.body.appendChild(i),v=t===B.VNODE?p(F,Q(s,e,n,P),()=>[a]):t===B.TITLE_DESCRIPTION?p(F,Q(s,e,n,P,a)):p(F,Q(s,e,n,P),()=>[p(a)]),ue(v,i),G[s.position].push({toastVNode:v,container:i}),v.component&&(v.component.props.visible=!0)},1)},Q=(e,t,s,a,n)=>ae(T(T({},e),n),{id:t,offset:s,visible:!1,onCloseHandler:()=>{a(t,e.position?e.position:"top-right")}}),bt=e=>{const t=ae(T({},e),{type:e.type||R.type,timeout:e.timeout||R.timeout,showCloseButton:e.showCloseButton,position:e.position||R.position,showIcon:e.showIcon,swipeClose:e.swipeClose,transition:e.transition||R.transition});return t.hideProgressBar=t.timeout!==void 0&&t.timeout<=0,e.hideProgressBar!==void 0&&(t.hideProgressBar=e.hideProgressBar),t},yt=e=>({text:typeof e=="string"?e:e.title,description:typeof e=="string"?void 0:e.description}),kt=(e,t,s)=>{let a=s;if(!e.position)throw new Error("no position");return t[e.position].forEach(({toastVNode:n})=>{a+=n.el.offsetHeight+s||0}),a},P=(e,t)=>{const s=G[t],a=s.findIndex(({toastVNode:u})=>u.props&&e===u.props.id);if(a===-1)return;const{container:n,toastVNode:i}=s[a];if(!i.el)return;const v=i.el.offsetHeight;G[t].splice(a,1),((u,h,r,c)=>{for(let l=u;l<h.length;l++){const{toastVNode:m}=h[l];if(!m.el)return;const O=r.split("-")[0]||"top",S=parseInt(m.el.style[O],10)-c-12;if(!m.component)return;m.component.props.offset=S}})(a,s,t,v),i.component&&(i.component.props.visible=!1,i.component.props.onClose&&i.component.props.onClose(),setTimeout(()=>{ue(null,n),document.body.removeChild(n)},1e3))};const M=e=>(ee("data-v-fa961d23"),e=e(),te(),e),It={style:{background:"#2d3436"}},Tt={class:"container"},xt={class:"footer-widgets-part"},Et={class:"row"},St=M(()=>o("div",{class:"col-md-4"},[o("div",{class:"widget text-widget"},[o("h1",{style:{color:"white","border-color":"#999"}}," About Us "),o("p",null,"We are the ace up the sleeve"),o("p",null," Life of poker is a one stop shop for all your poker needs, we take care of you so you can bring out your best at the tables! Life of poker exists of a team of professional poker players and hospitality industry experts that are here to take you to the hottest games while facilitating a smooth and safe process. The next poker boom is here in Asia and since the re-opening of travel the major tournament series have returned with a vengeance breaking record in prize money consistently. ")])],-1)),Ct={class:"col-md-4"},$t=j('<div class="widget social-widget" data-v-fa961d23><h1 style="color:white;border-color:#999;" data-v-fa961d23> Stay Connected </h1><ul class="social-icons" data-v-fa961d23><li data-v-fa961d23><a href="https://www.facebook.com/profile.php?id=100083369017397" target="_blank" class="facebook" style="border:none;" data-v-fa961d23><i class="fa fa-facebook" data-v-fa961d23></i></a></li><li data-v-fa961d23><a href="https://twitter.com/Life_of_Poker" target="_blank" class="twitter" style="border:none;" data-v-fa961d23><i class="fa fa-twitter" data-v-fa961d23></i></a></li><li data-v-fa961d23><a href="https://www.instagram.com/lifeofpoker_com/" target="_blank" class="instagram" style="border:none;" data-v-fa961d23><i class="fa-brands fa-instagram" data-v-fa961d23></i></a></li><li data-v-fa961d23><a href="https://www.youtube.com/channel/UCbBvulSR2T9y2vTtcKglXUg" target="_blank" class="youtube" style="border:none;" data-v-fa961d23><i class="fa-brands fa-youtube" data-v-fa961d23></i></a></li></ul></div>',1),Lt={class:"widget subscribe-widget"},Ot=["onSubmit"],Bt=M(()=>o("h1",null,"Subscribe and stay updated",-1)),Mt=M(()=>o("button",{type:"submit",style:{background:"none"}},[o("i",{class:"fa fa-arrow-circle-right",style:{color:"red"}})],-1)),zt=M(()=>o("p",null," Get all latest content delivered to your email a few times a month. ",-1)),Nt={class:"col-md-4"},Pt={class:"widget most-posts-widget"},Dt=M(()=>o("h1",{style:{color:"white","border-color":"#999"}}," Quick Links ",-1)),Ht=M(()=>o("div",{class:"row"},null,-1)),Rt={class:"col-md-6 list-unstyled",style:{"padding-left":"unset"}},Vt={class:"footer-links",style:{"margin-bottom":"1rem"}},jt=L("About Us"),Ut=j('<li class="footer-links" style="margin-bottom:1rem;" data-v-fa961d23><a href="#" style="color:white;" data-v-fa961d23>News</a></li><li class="footer-links" style="margin-bottom:1rem;" data-v-fa961d23><a href="#" style="color:white;" data-v-fa961d23>Live Reporting</a></li><li class="footer-links" style="margin-bottom:1rem;" data-v-fa961d23><a href="#" style="color:white;" data-v-fa961d23>Event Calendar</a></li><li class="footer-links" style="margin-bottom:1rem;" data-v-fa961d23><a href="#" style="color:white;" data-v-fa961d23>Contact</a></li>',4),Ft={class:"footer-last-line"},Wt={class:"row"},Gt=M(()=>o("div",{class:"col-md-6"},[o("p",null,"\xA9 COPYRIGHT 2022 lifeofpoker.com")],-1)),Xt={class:"col-md-6"},qt={class:"footer-nav"},At=L("Terms & Conditions"),Yt=L("Privacy"),Kt=L("Disclaimer"),Qt={__name:"Footer",setup(e){const t=_(null);async function s(){try{await axios.post("api/subscribe",{email:t.value}),t.value=null,wt("Thank you for subscribing.",{position:"top-center",hideProgressBar:!0,type:"success",transition:"slide",timeout:2e3,showIcon:!0,showCloseButton:!0})}catch(a){console.error(a)}}return(a,n)=>(d(),w("footer",It,[o("div",Tt,[o("div",xt,[o("div",Et,[St,o("div",Ct,[$t,o("div",Lt,[o("form",{onSubmit:ke(s,["prevent"]),class:"subscribe-form",style:{padding:"0",background:"none"}},[Bt,Ie(o("input",{type:"email","onUpdate:modelValue":n[0]||(n[0]=i=>t.value=i),placeholder:"Email",class:"subscribe-email",required:"",style:{"padding-right":"4rem"}},null,512),[[Te,t.value]]),Mt,zt],40,Ot)])]),o("div",Nt,[o("div",Pt,[Dt,Ht,o("ul",Rt,[o("li",Vt,[p(k(E),{href:"/about",style:{color:"white"}},{default:b(()=>[jt]),_:1})]),Ut])])])])]),o("div",Ft,[o("div",Wt,[Gt,o("div",Xt,[o("nav",qt,[o("ul",null,[o("li",null,[p(k(E),{href:"/terms"},{default:b(()=>[At]),_:1})]),o("li",null,[p(k(E),{href:"/privacy"},{default:b(()=>[Yt]),_:1})]),o("li",null,[p(k(E),{href:"/disclaimer"},{default:b(()=>[Kt]),_:1})])])])])])])])]))}},Jt=se(Qt,[["__scopeId","data-v-fa961d23"]]);var ce=Object.getOwnPropertySymbols,Zt=Object.prototype.hasOwnProperty,eo=Object.prototype.propertyIsEnumerable,to=(e,t)=>{var s={};for(var a in e)Zt.call(e,a)&&t.indexOf(a)<0&&(s[a]=e[a]);if(e!=null&&ce)for(var a of ce(e))t.indexOf(a)<0&&eo.call(e,a)&&(s[a]=e[a]);return s},oo=(e,t)=>{const s=e.__vccOpts||e;for(const[a,n]of t)s[a]=n;return s};const so=["ar","bn","cs","da","de","el","en","es","fa","fi","fil","fr","he","hi","hu","id","it","ja","ko","msa","nl","no","pl","pt","ro","ru","sv","th","tr","uk","ur","vi","zh-cn","zh-tw"],ao=/^(https?:\/\/)?(www\.)?twitter\.com\/.*\/status(?:es)?\/(?<tweetId>[^\/\?]\d+)$/i,no=oe({props:{tweetId:{type:String,default:""},tweetUrl:{type:String,default:""},conversation:{type:String,default:"all",validator:e=>["all","none"].includes(e)},cards:{type:String,default:"visible",validator:e=>["visible","hidden"].includes(e)},width:{type:[String,Number],default:"auto",validator:e=>typeof e=="string"?e==="auto":typeof e=="number"?e>=250&&e<=550:!1},align:{type:[String,void 0],default:void 0,validator:e=>["left","right","center",void 0].includes(e)},theme:{type:String,default:"light",validator:e=>["light","dark"].includes(e)},lang:{type:String,default:"en",validator:e=>so.includes(e)},dnt:{type:Boolean,default:!1}},emits:{"tweet-load-success":e=>!!e,"tweet-load-error":()=>!0},setup(e,{attrs:t,emit:s}){const a=_(!0),n=_(!1),i=_();N(()=>{v()}),ve(e,()=>{v()});function v(){if(!(window.twttr&&window.twttr.ready)){h("https://platform.twitter.com/widgets.js",v);return}window.twttr.ready().then(({widgets:r})=>{a.value=!0,n.value=!1,i.value&&(i.value.innerHTML="");const{tweetId:c,tweetOptions:l}=u();r.createTweet(c,i.value,l).then(async m=>{await xe(),m?s("tweet-load-success",m):(n.value=!0,s("tweet-load-error"))}).finally(()=>{a.value=!1})})}function u(){var r;let c=e,{tweetId:l,tweetUrl:m}=c,O=to(c,["tweetId","tweetUrl"]);if(l&&m)throw new Error("Cannot provide both tweet-id and tweet-url.");if(l){if(!/^\d+$/.test(l))throw new Error("Invalid tweet-id, please provide a valid numerical tweet-id.")}else if(m){const S=m.trim().match(ao);if(S)l=(r=S.groups)==null?void 0:r.tweetId;else throw new Error("Invalid tweet-url.")}else throw new Error("Must provide either tweet-id or tweet-url.");return{tweetId:l,tweetOptions:O}}function h(r,c){const l=document.createElement("script");l.setAttribute("src",r),l.addEventListener("load",()=>c(),!1),document.body.appendChild(l)}return{tweetContainerRef:i,isLoading:a,hasError:n,attrs:t}}});function io(e,t,s,a,n,i){return d(),w(V,null,[e.isLoading?W(e.$slots,"loading",{key:0}):e.hasError?W(e.$slots,"error",{key:1}):x("",!0),o("div",Ee({ref:"tweetContainerRef"},e.attrs),null,16)],64)}var lo=oo(no,[["render",io]]);const ro=pe("twitter",{state:()=>({tweetIDs:[]}),actions:{async getTweetID(){try{const{data:e}=await he.get("/api/twitter");this.tweetIDs=e}catch(e){console.error(e)}}}}),co=pe("instagram",{state:()=>({igFeed:null}),actions:{async getIGFeed(){try{const{data:e}=await he.get("/api/instagram");this.igFeed=e}catch(e){console.error(e)}}}});const fe=e=>(ee("data-v-c1cded8e"),e=e(),te(),e),uo={class:"sidebar"},vo=j('<div class="widget social-widget" data-v-c1cded8e><div class="title-section" data-v-c1cded8e><h1 data-v-c1cded8e><span data-v-c1cded8e>Stay Connected</span></h1></div><ul class="social-share" data-v-c1cded8e><li data-v-c1cded8e><a class="social-share__btn facebook" href="https://www.facebook.com/profile.php?id=100083369017397" target="_blank" data-v-c1cded8e><span class="social-share__btn-text" data-v-c1cded8e><i class="fa fa-facebook social-share__icon" data-v-c1cded8e></i>Facebook</span></a></li><li data-v-c1cded8e><a class="social-share__btn instagram" href="https://www.instagram.com/lifeofpoker_com/" target="_blank" data-v-c1cded8e><span class="social-share__btn-text" data-v-c1cded8e><i class="fa-brands fa-instagram social-share__icon" data-v-c1cded8e></i>Instagram</span></a></li><li data-v-c1cded8e><a class="social-share__btn twitter" href="https://twitter.com/Life_of_Poker" target="_blank" data-v-c1cded8e><span class="social-share__btn-text" data-v-c1cded8e><i class="fa fa-twitter social-share__icon" data-v-c1cded8e></i>Twitter</span></a></li><li data-v-c1cded8e><a class="social-share__btn youtube" href="https://www.youtube.com/channel/UCbBvulSR2T9y2vTtcKglXUg" target="_blank" data-v-c1cded8e><span class="social-share__btn-text" data-v-c1cded8e><i class="fa-brands fa-youtube social-share__icon" data-v-c1cded8e></i>Youtube</span></a></li></ul></div>',1),po={class:"widget social-widget"},ho=fe(()=>o("div",{class:"title-section"},[o("h1",null,[o("span",null,"twitter")])],-1)),_o=fe(()=>o("div",{class:"tweets-skeleton"},[o("div",{class:"tweet-skeleton"},[o("div",{class:"img"}),o("div",{class:"content-1"},[o("div",{class:"line"}),o("div",{class:"line"}),o("div",{class:"line"})]),o("div",{class:"content-2"},[o("div",{class:"line"}),o("div",{class:"line"})])])],-1)),fo=j('<div class="widget social-widget" data-v-c1cded8e><div class="title-section" data-v-c1cded8e><h1 data-v-c1cded8e><span data-v-c1cded8e>instagram</span></h1></div><div class="news-post video-post" data-v-c1cded8e><div class="tweets-skeleton" data-v-c1cded8e><div class="tweet-skeleton" data-v-c1cded8e><div class="img" data-v-c1cded8e></div><div class="content-1" data-v-c1cded8e><div class="line" data-v-c1cded8e></div><div class="line" data-v-c1cded8e></div><div class="line" data-v-c1cded8e></div></div><div class="content-2" data-v-c1cded8e><div class="line" data-v-c1cded8e></div><div class="line" data-v-c1cded8e></div></div></div></div></div></div>',1),mo={__name:"SideBar",setup(e){const t=ro(),s=_(null),a=co(),n=_(null);return H(()=>{var i;return(i=n.value)==null?void 0:i.find(v=>v.permalink).permalink}),N(async()=>{await t.getTweetID(),await a.getIGFeed()}),ve(()=>[t.tweetIDs,a.igFeed],function(){var i;s.value=t.tweetIDs.data,n.value=(i=a.igFeed)==null?void 0:i.data}),(i,v)=>(d(),w("div",uo,[vo,o("div",po,[ho,(d(!0),w(V,null,J(s.value,(u,h)=>(d(),w("div",{class:"news-post video-post",key:h},[p(k(lo),{"tweet-id":u.id,cards:"hidden",conversation:"none"},{loading:b(()=>[_o]),_:2},1032,["tweet-id"])]))),128))]),fo]))}},go=se(mo,[["__scopeId","data-v-c1cded8e"]]);const wo=o("title",null,"Home",-1),bo={class:"active"},yo={class:"block-wrapper"},ko={class:"container"},Io={class:"row"},To={class:"col-md-9 col-sm-8"},xo={class:"col-md-3 col-sm-4",style:{overflow:"none"}},Co={__name:"FrontLayout",props:{title:String},setup(e){return(t,s)=>(d(),w(V,null,[p(k(Se),null,{default:b(()=>[wo]),_:1}),o("div",bo,[p(Ge),o("main",null,[o("section",yo,[o("div",ko,[o("div",Io,[o("div",To,[W(t.$slots,"default")]),o("div",xo,[p(go)])])])])]),p(Jt)])],64))}};export{Co as _,wt as t};
