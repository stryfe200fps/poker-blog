import{d as h,p as N,C as T,l as F,o,c as E,w as u,b as k,a as t,t as a,g as p,H as V,n as L,e as l,h as f,F as m,L as B,i,f as b}from"./app.60127239.js";import{_ as M}from"./FrontLayout.87ba07a7.js";/* empty css                                                                   */import"./moment.0703cf10.js";import{d as P}from"./default-img.f9de1402.js";/* empty css                                                             */import{u as $}from"./article.eaf18aab.js";import"./_plugin-vue_export-helper.cdc0426e.js";const O=t("meta",{name:"description",content:"Your page description"},null,-1),R=["content"],Y=["content"],j={class:"block-content"},q={id:"table-of-contents",class:"table-contents"},z=["href"],D={class:"title-section"},I=t("h1",{class:"text-primary"},[t("span",null,[t("i",{class:"fa fa-chevron-left","aria-hidden":"true"}),i(" Back")])],-1),U={class:"single-post-box"},G={class:"title-post"},J={style:{display:"flex","justify-content":"space-between","align-items":"center"}},K={class:"post-tags"},Q=t("i",{class:"fa fa-clock-o"},null,-1),W=t("i",{class:"fa fa-user"},null,-1),X=i("by "),Z={href:"#"},tt={class:"post-tags share-post-links"},st={class:"share-post-mobile",style:{position:"relative"}},et={class:"btn",style:{"margin-right":"0","background-color":"#1854dd"}},ot=["href"],lt=t("i",{class:"fa-brands fa-facebook-f",style:{"margin-right":"0",color:"#fff"}},null,-1),at=[lt],nt={class:"btn",style:{"margin-right":"0","background-color":"#18a3dd"}},it=["href"],ct=t("i",{class:"fa fa-twitter",style:{"margin-right":"0",color:"#fff"}},null,-1),rt=[ct],dt={class:"btn",style:{"background-color":"#25d366"}},_t=["href"],ht=t("i",{class:"fa fa-whatsapp",style:{"margin-right":"0",color:"#fff"}},null,-1),ut=[ht],pt=t("i",{class:"fa fa-share-alt"},null,-1),ft=t("span",{class:"text-uppercase"},"Share",-1),mt=[pt,ft],gt={class:"share-post-desktop"},vt=t("li",{class:"text-secondary"},[t("i",{class:"fa fa-share-alt text-secondary"}),t("span",{class:"text-secondary"},"Share Post")],-1),kt=["href"],bt=t("i",{class:"fa fa-facebook text-secondary"},null,-1),yt=[bt],wt=["href"],xt=t("i",{class:"fa fa-twitter text-secondary"},null,-1),St=[xt],Ct=["href"],Ft=t("i",{class:"fa fa-whatsapp text-secondary"},null,-1),Lt=[Ft],Bt={key:0,class:"post-gallery"},At=["src","alt"],Ht={class:"image-caption"},Nt={style:{"margin-bottom":"20px"}},Tt=["innerHTML"],Et={key:1,class:"post-tags-box"},Vt={class:"tags-box"},Mt=t("li",null,[t("i",{class:"fa fa-tags"}),t("span",null,"Tags:")],-1),Pt={key:2,class:"title-section",style:{"margin-top":"50px"}},$t=t("h1",null,[t("span",null,"Related news")],-1),Ot=[$t],Rt={class:"row"},Yt={class:"item news-post image-post3"},jt=["src"],qt=["src"],zt={class:"hover-box"},Dt=["href"],It={class:"post-tags"},Ut=t("i",{class:"fa fa-clock-o"},null,-1),es={__name:"Show",props:{slug:{type:String,default:""}},setup(A){const y=A,n=$(),s=h([]),g=h(null),v=h(!1),c=h(!1),H=()=>{v.value=!v.value};function w(){const r=document.querySelector("#table-of-contents");window.scrollY>200?r.classList.add("active"):r.classList.remove("active"),document.documentElement.style.setProperty("--scroll-padding",r.offsetHeight+80+"px")}return N(async()=>{await n.getList(),await n.getRelatedNews(y.slug),window.addEventListener("scroll",w)}),T(()=>{window.removeEventListener("scroll",w)}),F(()=>n.list,function(){s.value=n.getArticleBySlug(y.slug)}),F(()=>n.related,function(){g.value=n.related.data}),(r,d)=>(o(),E(M,{title:""},{default:u(()=>{var x,S,C;return[k(p(V),null,{default:u(()=>[t("title",null,a(s.value.title),1),O,t("meta",{property:"og:title=",content:s.value.title},null,8,R),t("meta",{property:"og:description",content:s.value.body},null,8,Y)]),_:1}),t("div",j,[t("label",q,[t("div",{onClick:d[0]||(d[0]=e=>c.value=!c.value),class:"table-header"}," Table of Contents "),t("ul",{class:L(["table-menu",{pull:c.value}])},[(o(!0),l(m,null,f(s.value.content,(e,_)=>(o(),l("li",{key:_},[t("a",{href:"#content"+_,onClick:d[1]||(d[1]=Gt=>c.value=!1)},a(e.title),9,z)]))),128))],2)]),t("div",D,[k(p(B),{href:"/"},{default:u(()=>[I]),_:1})]),t("div",U,[t("div",G,[t("h1",null,[t("h1",null,a(s.value.title),1)]),t("div",J,[t("div",null,[t("ul",K,[t("li",null,[Q,i(a(s.value.date),1)]),t("li",null,[W,X,t("a",Z,a((x=s.value.author)==null?void 0:x.name),1)])])]),t("div",null,[t("ul",tt,[t("div",st,[t("div",{class:L(["btn-group-vertical social-links-group",{show:v.value}])},[t("li",et,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+s.value.slug+"&src=sdkpreparse"},at,8,ot)]),t("li",nt,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+s.value.slug},rt,8,it)]),t("li",dt,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+s.value.slug},ut,8,_t)])],2),t("li",{onClick:H,class:"btn btn-default share-btn-mobile"},mt)]),t("div",gt,[vt,t("li",null,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+s.value.slug+"&src=sdkpreparse",class:"facebook"},yt,8,kt)]),t("li",null,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+s.value.slug,class:"twitter"},St,8,wt)]),t("li",null,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+s.value.slug,class:"whatsapp"},Lt,8,Ct)])])])])])]),s.value.main_image?(o(),l("div",Bt,[t("img",{src:s.value.main_image,alt:s.value.main_image},null,8,At),t("span",Ht,a(s.value.caption),1)])):b("",!0),(o(!0),l(m,null,f(s.value.content,(e,_)=>(o(),l("div",{key:_,class:"post-content"},[t("h3",Nt,a(e.title),1),t("div",{innerHTML:e.body},null,8,Tt)]))),128)),(S=s.value.tags)!=null&&S.length?(o(),l("div",Et,[t("ul",Vt,[Mt,(o(!0),l(m,null,f(s.value.tags,e=>(o(),l("li",{key:e.id},[k(p(B),{href:"/tag/articles/"+e.slug},{default:u(()=>[i(a(e.title),1)]),_:2},1032,["href"])]))),128))])])):b("",!0),(C=g.value)!=null&&C.length?(o(),l("div",Pt,Ot)):b("",!0),t("div",Rt,[(o(!0),l(m,null,f(g.value,e=>(o(),l("div",{class:"col-xs-12 col-md-4",style:{"margin-bottom":"30px"},key:e.id},[t("div",Yt,[e.main_image.length?(o(),l("img",{key:0,src:e.main_image,alt:""},null,8,jt)):(o(),l("img",{key:1,src:p(P),alt:""},null,8,qt)),t("div",zt,[t("h2",null,[t("a",{href:"/article/show/"+e.slug},a(e.title),9,Dt)]),t("ul",It,[t("li",null,[Ut,i(a(e.date),1)])])])])]))),128))])])])]}),_:1}))}};export{es as default};
