import{d as f,p as V,C as $,l as F,o as l,c as M,w as m,b,a as t,t as a,g,H as q,e as o,n as T,F as u,h as d,f as _,L as H,i as h}from"./app.56436720.js";import{_ as z}from"./FrontLayout.53e7ac29.js";/* empty css                                                                   */import"./moment.f09a3ee0.js";import{d as O}from"./default-img.f9de1402.js";/* empty css                                                             */import{u as P}from"./article.0eba43f4.js";import"./_plugin-vue_export-helper.cdc0426e.js";const R=t("meta",{name:"description",content:"Your page description"},null,-1),Y=["content"],j=["content"],D={class:"block-content"},I={key:0,id:"table-of-contents",class:"table-contents"},U=["href"],G={class:"title-section"},J=t("h1",{class:"text-primary"},[t("span",null,[t("i",{class:"fa fa-chevron-left","aria-hidden":"true"}),h(" Back")])],-1),K={class:"single-post-box"},Q={class:"title-post"},W={style:{display:"flex","justify-content":"space-between","align-items":"center"}},X={class:"post-tags"},Z=t("i",{class:"fa fa-clock-o"},null,-1),tt=t("i",{class:"fa fa-user"},null,-1),et=h("by "),st={href:"#"},lt={class:"post-tags share-post-links"},ot={class:"share-post-mobile",style:{position:"relative"}},at={class:"btn",style:{"margin-right":"0","background-color":"#1854dd"}},nt=["href"],it=t("i",{class:"fa-brands fa-facebook-f",style:{"margin-right":"0",color:"#fff"}},null,-1),ct=[it],rt={class:"btn",style:{"margin-right":"0","background-color":"#18a3dd"}},ut=["href"],dt=t("i",{class:"fa fa-twitter",style:{"margin-right":"0",color:"#fff"}},null,-1),_t=[dt],ht={class:"btn",style:{"background-color":"#25d366"}},pt=["href"],ft=t("i",{class:"fa fa-whatsapp",style:{"margin-right":"0",color:"#fff"}},null,-1),mt=[ft],gt=t("i",{class:"fa fa-share-alt"},null,-1),vt=t("span",{class:"text-uppercase"},"Share",-1),yt=[gt,vt],bt={key:0,class:"post-gallery"},kt=["src","alt"],wt={class:"image-caption"},xt={key:1},Ct=t("h4",{class:"text-uppercase"},"Table of Contents",-1),St={style:{"padding-inline-start":"20px","font-size":"16px"}},Lt=["href"],Bt={style:{"margin-bottom":"20px"}},Ft=["innerHTML"],Tt={key:2,class:"post-tags-box"},Ht={class:"tags-box"},Nt=t("li",null,[t("i",{class:"fa fa-tags"}),t("span",null,"Tags:")],-1),At={key:3,class:"title-section",style:{"margin-top":"50px"}},Et=t("h1",null,[t("span",null,"Related news")],-1),Vt=[Et],$t={class:"row"},Mt={class:"item news-post image-post3"},qt=["src"],zt=["src"],Ot={class:"hover-box"},Pt=["href"],Rt={class:"post-tags"},Yt=t("i",{class:"fa fa-clock-o"},null,-1),Wt={__name:"Show",props:{slug:{type:String,default:""}},setup(N){const k=N,i=P(),e=f([]),v=f(null),y=f(!1),r=f(!1),A=()=>{y.value=!y.value};function w(){const p=document.querySelector("#table-of-contents");window.scrollY>200?p.classList.add("active"):p.classList.remove("active"),document.documentElement.style.setProperty("--scroll-padding",p.offsetHeight+80+"px")}return V(async()=>{await i.getList(),await i.getRelatedNews(k.slug),window.addEventListener("scroll",w)}),$(()=>{window.removeEventListener("scroll",w)}),F(()=>i.list,function(){e.value=i.getArticleBySlug(k.slug)}),F(()=>i.related,function(){v.value=i.related.data}),(p,c)=>(l(),M(z,{title:""},{default:m(()=>{var x,C,S,L,B;return[b(g(q),null,{default:m(()=>[t("title",null,a(e.value.title),1),R,t("meta",{property:"og:title=",content:e.value.title},null,8,Y),t("meta",{property:"og:description",content:e.value.body},null,8,j)]),_:1}),t("div",D,[((x=e.value.content)==null?void 0:x.length)>1?(l(),o("label",I,[t("div",{onClick:c[0]||(c[0]=s=>r.value=!r.value),class:"table-header"}," Table of Contents "),t("ul",{class:T(["table-menu",{pull:r.value}])},[(l(!0),o(u,null,d(e.value.content,(s,n)=>(l(),o("li",{key:n},[t("a",{href:"#content"+n,onClick:c[1]||(c[1]=E=>r.value=!1)},a(s.title),9,U)]))),128))],2)])):_("",!0),t("div",G,[b(g(H),{href:"/"},{default:m(()=>[J]),_:1})]),t("div",K,[t("div",Q,[t("h1",null,[t("h1",null,a(e.value.title),1)]),t("div",W,[t("div",null,[t("ul",X,[t("li",null,[Z,h(a(e.value.date),1)]),t("li",null,[tt,et,t("a",st,a((C=e.value.author)==null?void 0:C.name),1)])])]),t("div",null,[t("ul",lt,[t("div",ot,[t("div",{class:T(["btn-group-vertical social-links-group",{show:y.value}])},[t("li",at,[t("a",{target:"_blank",href:"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flifeofpoker.com%2Freport%2F"+e.value.slug+"&src=sdkpreparse"},ct,8,nt)]),t("li",rt,[t("a",{target:"_blank",href:"https://twitter.com/intent/tweet?text=https%3A//lifeofpoker.com/report/"+e.value.slug},_t,8,ut)]),t("li",ht,[t("a",{target:"_blank",href:"https://api.whatsapp.com/send?text=%0ahttps://lifeofpoker.com/report/"+e.value.slug},mt,8,pt)])],2),t("li",{onClick:A,class:"btn btn-default share-btn-mobile"},yt)])])])])]),e.value.main_image?(l(),o("div",bt,[t("img",{src:e.value.main_image,alt:e.value.main_image},null,8,kt),t("span",wt,a(e.value.caption),1)])):_("",!0),((S=e.value.content)==null?void 0:S.length)>1?(l(),o("div",xt,[Ct,t("ul",St,[(l(!0),o(u,null,d(e.value.content,(s,n)=>(l(),o("li",{key:n,style:{margin:"10px 0","list-style":"square"}},[t("a",{class:"text-primary",href:"#content"+n,onClick:c[2]||(c[2]=E=>r.value=!1)},a(s.title),9,Lt)]))),128))])])):_("",!0),(l(!0),o(u,null,d(e.value.content,(s,n)=>(l(),o("div",{key:n,class:"post-content"},[t("h3",Bt,a(s.title),1),t("div",{innerHTML:s.body},null,8,Ft)]))),128)),(L=e.value.tags)!=null&&L.length?(l(),o("div",Tt,[t("ul",Ht,[Nt,(l(!0),o(u,null,d(e.value.tags,s=>(l(),o("li",{key:s.id},[b(g(H),{href:"/tag/articles/"+s.slug},{default:m(()=>[h(a(s.title),1)]),_:2},1032,["href"])]))),128))])])):_("",!0),(B=v.value)!=null&&B.length?(l(),o("div",At,Vt)):_("",!0),t("div",$t,[(l(!0),o(u,null,d(v.value,s=>(l(),o("div",{class:"col-xs-12 col-md-4",style:{"margin-bottom":"30px"},key:s.id},[t("div",Mt,[s.main_image.length?(l(),o("img",{key:0,src:s.main_image,alt:""},null,8,qt)):(l(),o("img",{key:1,src:g(O),alt:""},null,8,zt)),t("div",Ot,[t("h2",null,[t("a",{href:"/article/show/"+s.slug},a(s.title),9,Pt)]),t("ul",Rt,[t("li",null,[Yt,h(a(s.date),1)])])])])]))),128))])])])]}),_:1}))}};export{Wt as default};
