<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function DI\factory;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::truncate();

        $news = MenuItem::factory()->create([
            'name' => 'News',
            'type' => 'internal_link',
            'link' => 'news',
            'page_id' => null,
            'parent_id' => null,
            'lft' => $lft = 2,
            'rgt' => $lft++
        ]);

        MenuItem::factory()->create([
            'name' => 'Show latest news',
            'type' => 'internal_link',
            'link' => 'news',
            'page_id' => null,
            'parent_id' => $news->id,
            'lft' => $lft = 3,
            'rgt' => $lft++
        ]);

        MenuItem::factory()->create([
            'name' => 'Live Reporting',
            'type' => 'internal_link',
            'link' => 'live-reporting',
            'page_id' => null,
            'parent_id' => null,
            'lft' => $lft = 10,
            'rgt' => $lft++

        ]);

        
        Page::factory()->create([
            'template' => 'default',
            'name' => 'About us',
            'title' => 'About us',
            'slug' => 'about',
            'content' => '<h3><strong>We are the ace up the sleeve</strong></h3>

            <p>Life of poker is a one stop shop for all your poker needs, we take care of you so you can bring out your best at the tables!</p>
            
            <p>Life of poker exists of a team of professional poker players and hospitality industry experts that are here to take you to the hottest games while facilitating a smooth and safe process.</p>
            
            <p>The next poker boom is here in Asia and since the re-opening of travel the major tournament series have returned with a vengeance breaking record in prize money consistently.&nbsp;</p>
            
            <p>Life on the road in Asia can be tough and knowing your way around can make all the difference between wasting time and money or taking an immediate seat in an aircon cooled action packed poker game without worrying about safety, transportation, cash exchange or anything else.&nbsp; Poker is a time consuming exercise and we believe that time should be maximized on the felt.&nbsp;</p>
            
            <p>We know the ins and outs of all the major tournament stops and have access to the biggest games in the region.</p>
            
            <p>Our goal is to grow the game further and revolutionize the poker travel experience. By the players, for the players.</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Disclaimer',
            'title' => 'Disclaimer',
            'slug' => 'disclaimer',
            'content' => '<p>This disclaimer (&#8220;Disclaimer&#8221;) sets forth the general guidelines, disclosures, and terms of your use of the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&#8220;Website&#8221;), &#8220;Life of Poker&#8221; mobile application (&#8220;Mobile Application&#8221;) and any of their related products and services (collectively, &#8220;Services&#8221;). This Disclaimer is a legally binding agreement between you (&#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221;) and LIFE OF POKER PTY LTD (&#8220;LIFE OF POKER PTY LTD&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Services. By accessing and using the Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Disclaimer. You acknowledge that this Disclaimer is a contract between you and LIFE OF POKER PTY LTD, even though it is electronic and is not physically signed by you, and it governs your use of the Services.</p> 

                <div class="wpembed-index"><h3>Table of contents</h3><ol class="wpembed-index"><li><a href="#representation">Representation</a></li><li><a href="#content-and-postings">Content and postings</a></li><li><a href="#compensation-and-sponsorship">Compensation and sponsorship</a></li><li><a href="#reviews-and-testimonials">Reviews and testimonials</a></li><li><a href="#indemnification-and-warranties">Indemnification and warranties</a></li><li><a href="#changes-and-amendments">Changes and amendments</a></li><li><a href="#acceptance-of-this-disclaimer">Acceptance of this disclaimer</a></li><li><a href="#contacting-us">Contacting us</a></li></ol>
                
                <h2 id="representation">Representation</h2> 
                
                <p>Any views or opinions represented on the Services belong solely to the content creators and do not represent those of people, institutions or organizations that LIFE OF POKER PTY LTD or creators may or may not be associated with in professional or personal capacity, unless explicitly stated. Any views or opinions are not intended to malign any religion, ethnic group, club, organization, company, or individual.</p> 
                
                <h2 id="content-and-postings">Content and postings</h2> 
                
                <p>You may not modify, print or copy any part of the Services. Inclusion of any part of the Services in another work, whether in printed or electronic or another form or inclusion of any part of the Services on another resource by embedding, framing or otherwise without the express permission of LIFE OF POKER PTY LTD is prohibited. </p> 
                
                <h2 id="compensation-and-sponsorship">Compensation and sponsorship</h2> 
                
                <p>The Services may contain forms of advertising, sponsorship, paid insertions or other forms of compensation. On certain occasions LIFE OF POKER PTY LTD may be compensated to provide opinions on products, services, or various other topics. Even though LIFE OF POKER PTY LTD receives compensation for advertisements, the opinions, findings, beliefs, or experiences on those topics or products are honest and not influenced by the advertiser or sponsor. The views and opinions expressed on the Services are purely of LIFE OF POKER PTY LTD. Any product claims, statistics, quotes or other representations about products or services should be verified with the manufacturer, provider or the party in question. Note that sponsored content and advertising space may not always be identified as paid or sponsored. Some of the links on the Services may be affiliate links. This means if you click on the link and purchase an item, LIFE OF POKER PTY LTD will receive an affiliate commission.</p> 
                
                <h2 id="reviews-and-testimonials">Reviews and testimonials</h2> 
                
                <p>Testimonials are received in various forms through a variety of submission methods. The testimonials are not necessarily representative of all of those who will use Services, and LIFE OF POKER PTY LTD is not responsible for the opinions or comments available on the Services, and does not necessarily share them. All opinions expressed are strictly the views of the reviewers.</p> 
                
                <p>The testimonials displayed are given verbatim except for grammatical or typing error corrections. Some testimonials may have been edited for clarity, or shortened in cases where the original testimonial included extraneous information of no relevance to the general public. Testimonials may be reviewed for authenticity before they are available for public viewing.</p> 
                
                <h2 id="indemnification-and-warranties">Indemnification and warranties</h2> 
                
                <p>While we have made every attempt to ensure that the information contained on the Services is correct, LIFE OF POKER PTY LTD is not responsible for any errors or omissions, or for the results obtained from the use of this information. All information on the Services is provided &#8220;as is&#8221;, with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied. In no event will LIFE OF POKER PTY LTD, or its partners, employees or agents, be liable to you or anyone else for any decision made or action taken in reliance on the information on the Services, or for any consequential, special or similar damages, even if advised of the possibility of such damages. Information on the Services is for general information purposes only and is not intended to provide any type of professional advice. Please seek professional assistance should you require it. Information contained on the Services are subject to change at any time and without warning.</p> 
                
                <h2 id="changes-and-amendments">Changes and amendments</h2> 
                
                <p>We reserve the right to modify this Disclaimer or its terms related to the Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p> 
                
                <p>An updated version of this Disclaimer will be effective immediately upon the posting of the revised Disclaimer unless otherwise specified. Your continued use of the Services after the effective date of the revised Disclaimer (or such other act specified at that time) will constitute your consent to those changes.</p> 
                
                <h2 id="acceptance-of-this-disclaimer">Acceptance of this disclaimer</h2> 
                
                <p>You acknowledge that you have read this Disclaimer and agree to all its terms and conditions. By accessing and using the Services you agree to be bound by this Disclaimer. If you do not agree to abide by the terms of this Disclaimer, you are not authorized to access or use the Services.</p> 
                
                <h2 id="contacting-us">Contacting us</h2> 
                
                <p>If you have any questions, concerns, or complaints regarding this Disclaimer, we encourage you to contact us using the details below:</p> 
                
                <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;&#105;&#110;&#102;o&#64;lif&#101;o&#102;&#112;ok&#101;&#114;&#46;co&#109;">i&#110;fo&#64;&#108;&#105;feo&#102;po&#107;&#101;r.&#99;o&#109;</a></p> 
                
                <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Terms',
            'title' => 'Terms and conditions',
            'slug' => 'terms',
            'content' => '<p>These terms and conditions (&#8220;Agreement&#8221;) set forth the general terms and conditions of your use of the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&#8220;Website&#8221;), &#8220;Life of Poker&#8221; mobile application (&#8220;Mobile Application&#8221;) and any of their related products and services (collectively, &#8220;Services&#8221;). This Agreement is legally binding between you (&#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221;) and LIFE OF POKER PTY LTD (&#8220;LIFE OF POKER PTY LTD&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Services. By accessing and using the Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Agreement. You acknowledge that this Agreement is a contract between you and LIFE OF POKER PTY LTD, even though it is electronic and is not physically signed by you, and it governs your use of the Services.</p> 

                <div class="wpembed-index"><h3>Table of contents</h3><ol class="wpembed-index"><li><a href="#accounts-and-membership">Accounts and membership</a></li><li><a href="#adult-content">Adult content</a></li><li><a href="#billing-and-payments">Billing and payments</a></li><li><a href="#accuracy-of-information">Accuracy of information</a></li><li><a href="#third-party-services">Third party services</a></li><li><a href="#advertisements">Advertisements</a></li><li><a href="#links-to-other-resources">Links to other resources</a></li><li><a href="#gambling-related-material">Gambling related material</a></li><li><a href="#prohibited-uses">Prohibited uses</a></li><li><a href="#intellectual-property-rights">Intellectual property rights</a></li><li><a href="#disclaimer-of-warranty">Disclaimer of warranty</a></li><li><a href="#limitation-of-liability">Limitation of liability</a></li><li><a href="#indemnification">Indemnification</a></li><li><a href="#severability">Severability</a></li><li><a href="#dispute-resolution">Dispute resolution</a></li><li><a href="#assignment">Assignment</a></li><li><a href="#changes-and-amendments">Changes and amendments</a></li><li><a href="#acceptance-of-these-terms">Acceptance of these terms</a></li><li><a href="#contacting-us">Contacting us</a></li></ol></div><h2 id="accounts-and-membership">Accounts and membership</h2> 
                
                <p>You must be at least 18 years of age to use the Services. By using the Services and by agreeing to this Agreement you warrant and represent that you are at least 18 years of age. If you create an account on the Services, you are responsible for maintaining the security of your account and you are fully responsible for all activities that occur under the account and any other actions taken in connection with it. We may, but have no obligation to, monitor and review new accounts before you may sign in and start using the Services. Providing false contact information of any kind may result in the termination of your account. You must immediately notify us of any unauthorized uses of your account or any other breaches of security. We will not be liable for any acts or omissions by you, including any damages of any kind incurred as a result of such acts or omissions. We may suspend, disable, or delete your account (or any part thereof) if we determine that you have violated any provision of this Agreement or that your conduct or content would tend to damage our reputation and goodwill. If we delete your account for the foregoing reasons, you may not re-register for our Services. We may block your email address and Internet protocol address to prevent further registration.</p> 
                
                <h2 id="adult-content">Adult content</h2> 
                
                <p>Please be aware that there may be certain adult or mature content available on the Services. Where there is mature or adult content, individuals who are less than 18 years of age or are not permitted to access such content under the laws of any applicable jurisdiction may not access such content. If we learn that anyone under the age of 18 seeks to conduct a transaction through the Services, we will require verified parental consent, in accordance with the Children&#8217;s Online Privacy Protection Act of 1998 (&#8220;COPPA&#8221;). Certain areas of the Services may not be available to children under 18 under any circumstances.</p> 
                
                <h2 id="billing-and-payments">Billing and payments</h2> 
                
                <p>You shall pay all fees or charges to your account in accordance with the fees, charges, and billing terms in effect at the time a fee or charge is due and payable. Where Services are offered on a free trial basis, payment may be required after the free trial period ends, and not when you enter your billing details (which may be required prior to the commencement of the free trial period). If, in our judgment, your purchase constitutes a high-risk transaction, we will require you to provide us with a copy of your valid government-issued photo identification, and possibly a copy of a recent bank statement for the credit or debit card used for the purchase. We reserve the right to change products and product pricing at any time. We also reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person, per household or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, and/or orders that use the same billing and/or shipping address. In the event that we make a change to or cancel an order, we may attempt to notify you by contacting the e-mail and/or billing address/phone number provided at the time the order was made.</p> 
                
                <h2 id="accuracy-of-information">Accuracy of information</h2> 
                
                <p>Occasionally there may be information on the Services that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, availability, promotions and offers. We reserve the right to correct any errors, inaccuracies or omissions, and to change or update information or cancel orders if any information on the Services or Services is inaccurate at any time without prior notice (including after you have submitted your order). We undertake no obligation to update, amend or clarify information on the Services including, without limitation, pricing information, except as required by law. No specified update or refresh date applied on the Services should be taken to indicate that all information on the Services or Services has been modified or updated.</p> 
                
                <h2 id="third-party-services">Third party services</h2> 
                
                <p>If you decide to enable, access or use third party services, be advised that your access and use of such other services are governed solely by the terms and conditions of such other services, and we do not endorse, are not responsible or liable for, and make no representations as to any aspect of such other services, including, without limitation, their content or the manner in which they handle data (including your data) or any interaction between you and the provider of such other services. You irrevocably waive any claim against LIFE OF POKER PTY LTD with respect to such other services. LIFE OF POKER PTY LTD is not liable for any damage or loss caused or alleged to be caused by or in connection with your enablement, access or use of any such other services, or your reliance on the privacy practices, data security processes or other policies of such other services. You may be required to register for or log into such other services on their respective platforms. By enabling any other services, you are expressly permitting LIFE OF POKER PTY LTD to disclose your data as necessary to facilitate the use or enablement of such other service.</p> 
                
                <h2 id="advertisements">Advertisements</h2> 
                
                <p>During your use of the Services, you may enter into correspondence with or participate in promotions of advertisers or sponsors showing their goods or services through the Services. Any such activity, and any terms, conditions, warranties or representations associated with such activity, is solely between you and the applicable third party. We shall have no liability, obligation or responsibility for any such correspondence, purchase or promotion between you and any such third party.</p> 
                
                <h2 id="links-to-other-resources">Links to other resources</h2> 
                
                <p>Although the Services may link to other resources (such as websites, mobile applications, etc.), we are not, directly or indirectly, implying any approval, association, sponsorship, endorsement, or affiliation with any linked resource, unless specifically stated herein. Some of the links on the Services may be &#8220;affiliate links&#8221;. This means if you click on the link and purchase an item, LIFE OF POKER PTY LTD will receive an affiliate commission. We are not responsible for examining or evaluating, and we do not warrant the offerings of, any businesses or individuals or the content of their resources. We do not assume any responsibility or liability for the actions, products, services, and content of any other third parties. You should carefully review the legal statements and other conditions of use of any resource which you access through a link on the Services. Your linking to any other off-site resources is at your own risk.</p> 
                
                <h2 id="gambling-related-material">Gambling related material</h2> 
                
                <p>The website <a target="_blank" rel="noreferrer noopener external noreferrer noopener external nofollow" href="http://www.LifeofPoker.com">www.LifeofPoker.com</a> provides gambling related material to readers for informational purposes. LifeofPoker.com does not operate any online gaming services. Life of Poker receives payment for advertising of gambling related sites. Life of Poker does not accept any responsibility for any errors on the website or any gambling related losses incurred by visiting patrons of the website</p> 
                
                <h2 id="prohibited-uses">Prohibited uses</h2> 
                
                <p>In addition to other terms as set forth in the Agreement, you are prohibited from using the Services or Content: (a) for any unlawful purpose; (b) to solicit others to perform or participate in any unlawful acts; (c) to violate any international, federal, provincial or state regulations, rules, laws, or local ordinances; (d) to infringe upon or violate our intellectual property rights or the intellectual property rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity, race, age, national origin, or disability; (f) to submit false or misleading information; (g) to upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Services, third party products and services, or the Internet; (h) to spam, phish, pharm, pretext, spider, crawl, or scrape; (i) for any obscene or immoral purpose; or (j) to interfere with or circumvent the security features of the Services, third party products and services, or the Internet. We reserve the right to terminate your use of the Services for violating any of the prohibited uses.</p> 
                
                <h2 id="intellectual-property-rights">Intellectual property rights</h2> 
                
                <p>&#8220;Intellectual Property Rights&#8221; means all present and future rights conferred by statute, common law or equity in or in relation to any copyright and related rights, trademarks, designs, patents, inventions, goodwill and the right to sue for passing off, rights to inventions, rights to use, and all other intellectual property rights, in each case whether registered or unregistered and including all applications and rights to apply for and be granted, rights to claim priority from, such rights and all similar or equivalent rights or forms of protection and any other results of intellectual activity which subsist or will subsist now or in the future in any part of the world. This Agreement does not transfer to you any intellectual property owned by LIFE OF POKER PTY LTD or third parties, and all rights, titles, and interests in and to such property will remain (as between the parties) solely with LIFE OF POKER PTY LTD. All trademarks, service marks, graphics and logos used in connection with the Services, are trademarks or registered trademarks of LIFE OF POKER PTY LTD or its licensors. Other trademarks, service marks, graphics and logos used in connection with the Services may be the trademarks of other third parties. Your use of the Services grants you no right or license to reproduce or otherwise use any of LIFE OF POKER PTY LTD or third party trademarks.</p> 
                
                <h2 id="disclaimer-of-warranty">Disclaimer of warranty</h2> 
                
                <p>You agree that such Service is provided on an &#8220;as is&#8221; and &#8220;as available&#8221; basis and that your use of the Services is solely at your own risk. We expressly disclaim all warranties of any kind, whether express or implied, including but not limited to the implied warranties of merchantability, fitness for a particular purpose and non-infringement. We make no warranty that the Services will meet your requirements, or that the Service will be uninterrupted, timely, secure, or error-free; nor do we make any warranty as to the results that may be obtained from the use of the Service or as to the accuracy or reliability of any information obtained through the Service or that defects in the Service will be corrected. You understand and agree that any material and/or data downloaded or otherwise obtained through the use of Service is done at your own discretion and risk and that you will be solely responsible for any damage or loss of data that results from the download of such material and/or data. We make no warranty regarding any goods or services purchased or obtained through the Service or any transactions entered into through the Service unless stated otherwise. No advice or information, whether oral or written, obtained by you from us or through the Service shall create any warranty not expressly made herein.</p> 
                
                <h2 id="limitation-of-liability">Limitation of liability</h2> 
                
                <p>To the fullest extent permitted by applicable law, in no event will LIFE OF POKER PTY LTD, its affiliates, directors, officers, employees, agents, suppliers or licensors be liable to any person for any indirect, incidental, special, punitive, cover or consequential damages (including, without limitation, damages for lost profits, revenue, sales, goodwill, use of content, impact on business, business interruption, loss of anticipated savings, loss of business opportunity) however caused, under any theory of liability, including, without limitation, contract, tort, warranty, breach of statutory duty, negligence or otherwise, even if the liable party has been advised as to the possibility of such damages or could have foreseen such damages. To the maximum extent permitted by applicable law, the aggregate liability of LIFE OF POKER PTY LTD and its affiliates, officers, employees, agents, suppliers and licensors relating to the services will be limited to an amount no greater than one dollar or any amounts actually paid in cash by you to LIFE OF POKER PTY LTD for the prior one month period prior to the first event or occurrence giving rise to such liability. The limitations and exclusions also apply if this remedy does not fully compensate you for any losses or fails of its essential purpose.</p> 
                
                <h2 id="indemnification">Indemnification</h2> 
                
                <p>You agree to indemnify and hold LIFE OF POKER PTY LTD and its affiliates, directors, officers, employees, agents, suppliers and licensors harmless from and against any liabilities, losses, damages or costs, including reasonable attorneys&#8217; fees, incurred in connection with or arising from any third party allegations, claims, actions, disputes, or demands asserted against any of them as a result of or relating to your Content, your use of the Services or any willful misconduct on your part.</p> 
                
                <h2 id="severability">Severability</h2> 
                
                <p>All rights and restrictions contained in this Agreement may be exercised and shall be applicable and binding only to the extent that they do not violate any applicable laws and are intended to be limited to the extent necessary so that they will not render this Agreement illegal, invalid or unenforceable. If any provision or portion of any provision of this Agreement shall be held to be illegal, invalid or unenforceable by a court of competent jurisdiction, it is the intention of the parties that the remaining provisions or portions thereof shall constitute their agreement with respect to the subject matter hereof, and all such remaining provisions or portions thereof shall remain in full force and effect.</p> 
                
                <h2 id="dispute-resolution">Dispute resolution</h2> 
                
                <p>The formation, interpretation, and performance of this Agreement and any disputes arising out of it shall be governed by the substantive and procedural laws of Philippines without regard to its rules on conflicts or choice of law and, to the extent applicable, the laws of Philippines. The exclusive jurisdiction and venue for actions related to the subject matter hereof shall be the courts located in Philippines, and you hereby submit to the personal jurisdiction of such courts. You hereby waive any right to a jury trial in any proceeding arising out of or related to this Agreement. The United Nations Convention on Contracts for the International Sale of Goods does not apply to this Agreement.</p> 
                
                <h2 id="assignment">Assignment</h2> 
                
                <p>You may not assign, resell, sub-license or otherwise transfer or delegate any of your rights or obligations hereunder, in whole or in part, without our prior written consent, which consent shall be at our own sole discretion and without obligation; any such assignment or transfer shall be null and void. We are free to assign any of its rights or obligations hereunder, in whole or in part, to any third party as part of the sale of all or substantially all of its assets or stock or as part of a merger.</p> 
                
                <h2 id="changes-and-amendments">Changes and amendments</h2> 
                
                <p>We reserve the right to modify this Agreement or its terms related to the Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p> 
                
                <p>An updated version of this Agreement will be effective immediately upon the posting of the revised Agreement unless otherwise specified. Your continued use of the Services after the effective date of the revised Agreement (or such other act specified at that time) will constitute your consent to those changes.</p> 
                
                <h2 id="acceptance-of-these-terms">Acceptance of these terms</h2> 
                
                <p>You acknowledge that you have read this Agreement and agree to all its terms and conditions. By accessing and using the Services you agree to be bound by this Agreement. If you do not agree to abide by the terms of this Agreement, you are not authorized to access or use the Services.</p> 
                
                <h2 id="contacting-us">Contacting us</h2> 
                
                <p>If you have any questions, concerns, or complaints regarding this Agreement, we encourage you to contact us using the details below:</p> 
                
                <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;i&#110;&#102;&#111;&#64;l&#105;fe&#111;f&#112;&#111;&#107;er.c&#111;m">in&#102;o&#64;l&#105;&#102;eo&#102;&#112;oker.&#99;&#111;&#109;</a></p> 
                
                <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Privacy',
            'title' => 'Privacy Policy',
            'slug' => 'Privacy Policy',
            'content' => '<p>We respect your privacy and are committed to protecting it through our compliance with this privacy policy (&#8220;Policy&#8221;). This Policy describes the types of information we may collect from you or that you may provide (&#8220;Personal Information&#8221;) on the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&#8220;Website&#8221;), &#8220;Life of Poker&#8221; mobile application (&#8220;Mobile Application&#8221;), and any of their related products and services (collectively, &#8220;Services&#8221;), and our practices for collecting, using, maintaining, protecting, and disclosing that Personal Information. It also describes the choices available to you regarding our use of your Personal Information and how you can access and update it.</p> 

                <p>This Policy is a legally binding agreement between you (&#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221;) and LIFE OF POKER PTY LTD (&#8220;LIFE OF POKER PTY LTD&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Services. By accessing and using the Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Policy. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.</p> 
                
                <div class="wpembed-index"><h3>Table of contents</h3><ol class="wpembed-index"><li><a href="#collection-of-personal-information">Collection of personal information</a></li><li><a href="#privacy-of-children">Privacy of children</a></li><li><a href="#use-and-processing-of-collected-information">Use and processing of collected information</a></li><li><a href="#payment-processing">Payment processing</a></li><li><a href="#managing-information">Managing information</a></li><li><a href="#disclosure-of-information">Disclosure of information</a></li><li><a href="#retention-of-information">Retention of information</a></li><li><a href="#transfer-of-information">Transfer of information</a></li><li><a href="#data-protection-rights-under-the-gdpr">Data protection rights under the GDPR</a></li><li><a href="#california-privacy-rights">California privacy rights</a></li><li><a href="#how-to-exercise-your-rights">How to exercise your rights</a></li><li><a href="#cookies">Cookies</a></li><li><a href="#data-analytics">Data analytics</a></li><li><a href="#do-not-track-signals">Do Not Track signals</a></li><li><a href="#advertisements">Advertisements</a></li><li><a href="#social-media-features">Social media features</a></li><li><a href="#email-marketing">Email marketing</a></li><li><a href="#affiliate-links">Affiliate links</a></li><li><a href="#links-to-other-resources">Links to other resources</a></li><li><a href="#information-security">Information security</a></li><li><a href="#data-breach">Data breach</a></li><li><a href="#changes-and-amendments">Changes and amendments</a></li><li><a href="#acceptance-of-this-policy">Acceptance of this policy</a></li><li><a href="#contacting-us">Contacting us</a></li></ol></div><h2 id="collection-of-personal-information">Collection of personal information</h2> 
                
                <p>You can access and use the Services without telling us who you are or revealing any information by which someone could identify you as a specific, identifiable individual. If, however, you wish to use some of the features offered on the Services, you may be asked to provide certain Personal Information (for example, your name and e-mail address).</p> 
                
                <p>We receive and store any information you knowingly provide to us when you create an account, make a purchase,  or fill any forms on the Services. When required, this information may include the following:</p> 
                
                <ul> 
                
                <li>Account details (such as user name, unique user ID, password, etc)</li> 
                
                <li>Contact information (such as email address, phone number, etc)</li> 
                
                <li>Basic personal information (such as name, country of residence, etc)</li> 
                
                <li>Certain features on the mobile device (such as contacts, calendar, gallery, etc)</li> 
                
                <li>Any other materials you willingly submit to us (such as articles, images, feedback, etc)</li> 
                
                </ul> 
                
                <p>You can choose not to provide us with your Personal Information, but then you may not be able to take advantage of some of the features on the Services. Users who are uncertain about what information is mandatory are welcome to contact us.</p> 
                
                <h2 id="privacy-of-children">Privacy of children</h2> 
                
                <p>We do not knowingly collect any Personal Information from children under the age of 18. If you are under the age of 18, please do not submit any Personal Information through the Services. If you have reason to believe that a child under the age of 18 has provided Personal Information to us through the Services, please contact us to request that we delete that child&#8217;s Personal Information from our Services.</p> 
                
                <p>We encourage parents and legal guardians to monitor their children&#8217;s Internet usage and to help enforce this Policy by instructing their children never to provide Personal Information through the Services without their permission. We also ask that all parents and legal guardians overseeing the care of children take the necessary precautions to ensure that their children are instructed to never give out Personal Information when online without their permission.</p> 
                
                <h2 id="use-and-processing-of-collected-information">Use and processing of collected information</h2> 
                
                <p>We act as a data controller and a data processor in terms of the GDPR when handling Personal Information, unless we have entered into a data processing agreement with you in which case you would be the data controller and we would be the data processor.</p> 
                
                <p> Our role may also differ depending on the specific situation involving Personal Information. We act in the capacity of a data controller when we ask you to submit your Personal Information that is necessary to ensure your access and use of the Services. In such instances, we are a data controller because we determine the purposes and means of the processing of Personal Information and we comply with data controllers&#8217; obligations set forth in the GDPR.</p> 
                
                <p>We act in the capacity of a data processor in situations when you submit Personal Information through the Services. We do not own, control, or make decisions about the submitted Personal Information, and such Personal Information is processed only in accordance with your instructions. In such instances, the User providing Personal Information acts as a data controller in terms of the GDPR.</p> 
                
                <p>In order to make the Services available to you, or to meet a legal obligation, we may need to collect and use certain Personal Information. If you do not provide the information that we request, we may not be able to provide you with the requested products or services. Any of the information we collect from you may be used for the following purposes:</p> 
                
                <ul> 
                
                <li>Create and manage user accounts</li> 
                
                <li>Fulfill and manage orders</li> 
                
                <li>Deliver products or services</li> 
                
                <li>Improve products and services</li> 
                
                <li>Send administrative information</li> 
                
                <li>Send marketing and promotional communications</li> 
                
                <li>Send product and service updates</li> 
                
                <li>Respond to inquiries and offer support</li> 
                
                <li>Request user feedback</li> 
                
                <li>Improve user experience</li> 
                
                <li>Post customer testimonials</li> 
                
                <li>Deliver targeted advertising</li> 
                
                <li>Administer prize draws and competitions</li> 
                
                <li>Enforce terms and conditions and policies</li> 
                
                <li>Protect from abuse and malicious users</li> 
                
                <li>Respond to legal requests and prevent harm</li> 
                
                <li>Run and operate the Services</li> 
                
                </ul> 
                
                <p>Processing your Personal Information depends on how you interact with the Services, where you are located in the world and if one of the following applies: (i) you have given your consent for one or more specific purposes; this, however, does not apply, whenever the processing of Personal Information is subject to California Consumer Privacy Act or European data protection law; (ii) provision of information is necessary for the performance of an agreement with you and/or for any pre-contractual obligations thereof; (iii) processing is necessary for compliance with a legal obligation to which you are subject; (iv) processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in us; (v) processing is necessary for the purposes of the legitimate interests pursued by us or by a third party. We may also combine or aggregate some of your Personal Information in order to better serve you and to improve and update our Services.</p> 
                
                <p>We rely on the following legal bases as defined in the GDPR upon which we collect and process your Personal Information:</p> 
                
                <ul> 
                
                <li>User&#8217;s consent</li> 
                
                <li>Compliance with the law and legal obligations</li> 
                
                <li>Personal Information is already publicly available</li> 
                
                </ul> 
                
                <p> Note that under some legislations we may be allowed to process information until you object to such processing by opting out, without having to rely on consent or any other of the legal bases above. In any case, we will be happy to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Information is a statutory or contractual requirement, or a requirement necessary to enter into a contract.</p> 
                
                <h2 id="payment-processing">Payment processing</h2> 
                
                <p>In case of Services requiring payment, you may need to provide your credit card details or other payment account information, which will be used solely for processing payments. We use third-party payment processors (&#8220;Payment Processors&#8221;) to assist us in processing your payment information securely.</p> 
                
                <p>Payment Processors adhere to the latest security standards as managed by the PCI Security Standards Council, which is a joint effort of brands like Visa, MasterCard, American Express and Discover.  Sensitive and private data exchange happens over a SSL secured communication channel and is encrypted and protected with digital signatures, and the Services are also in compliance with strict vulnerability standards in order to create as secure of an environment as possible for Users. We will share payment data with the Payment Processors only to the extent necessary for the purposes of processing your payments, refunding such payments, and dealing with complaints and queries related to such payments and refunds.</p> 
                
                <p> Please note that the Payment Processors may collect some Personal Information from you, which allows them to process your payments (e.g., your email address, address, credit card details, and bank account number) and handle all the steps in the payment process through their systems, including data collection and data processing. The Payment Processors&#8217; use of your Personal Information is governed by their respective privacy policies which may or may not contain privacy protections as protective as this Policy. We suggest that you review their respective privacy policies.</p> 
                
                <h2 id="managing-information">Managing information</h2> 
                
                <p>You are able to delete certain Personal Information we have about you. The Personal Information you can delete may change as the Services change. When you delete Personal Information, however, we may maintain a copy of the unrevised Personal Information in our records for the duration necessary to comply with our obligations to our affiliates and partners, and for the purposes described below.</p> 
                
                <h2 id="disclosure-of-information">Disclosure of information</h2> 
                
                <p> Depending on the requested Services or as necessary to complete any transaction or provide any Service you have requested, we may share your information with our affiliates, contracted companies, and service providers (collectively, &#8220;Service Providers&#8221;) we rely upon to assist in the operation of the Services available to you and whose privacy policies are consistent with ours or who agree to abide by our policies with respect to Personal Information. We will not share any personally identifiable information with third parties and will not share any information with unaffiliated third parties.</p> 
                
                <p>Service Providers are not authorized to use or disclose your information except as necessary to perform services on our behalf or comply with legal requirements. Service Providers are given the information they need only in order to perform their designated functions, and we do not authorize them to use or disclose any of the provided information for their own marketing or other purposes.</p> 
                
                <h2 id="retention-of-information">Retention of information</h2> 
                
                <p>We will retain and use your Personal Information for the period necessary to comply with our legal obligations, as long as your user account remains active, to enforce our agreements, resolve disputes, and unless a longer retention period is required or permitted by law.</p> 
                
                <p>We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally. Once the retention period expires, Personal Information shall be deleted. Therefore, the right to access, the right to erasure, the right to rectification, and the right to data portability cannot be enforced after the expiration of the retention period.</p> 
                
                <h2 id="transfer-of-information">Transfer of information</h2> 
                
                <p>Depending on your location, data transfers may involve transferring and storing your information in a country other than your own. However, this will not include countries outside the European Union and European Economic Area. If any such transfer takes place, you can find out more by checking the relevant sections of this Policy or inquire with us using the information provided in the contact section.</p> 
                
                <h2 id="data-protection-rights-under-the-gdpr">Data protection rights under the GDPR</h2> 
                
                <p>If you are a resident of the European Economic Area (&#8220;EEA&#8221;), you have certain data protection rights and we aim to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Information. If you wish to be informed what Personal Information we hold about you and if you want it to be removed from our systems, please contact us. In certain circumstances, you have the following data protection rights:</p> 
                
                <p> 
                
                (i) You have the right to withdraw consent where you have previously given your consent to the processing of your Personal Information. To the extent that the legal basis for our processing of your Personal Information is consent, you have the right to withdraw that consent at any time. Withdrawal will not affect the lawfulness of processing before the withdrawal.</p> 
                
                <p>(ii) You have the right to learn if your Personal Information is being processed by us, obtain disclosure regarding certain aspects of the processing, and obtain a copy of your Personal Information undergoing processing.</p> 
                
                <p>(iii) You have the right to verify the accuracy of your information and ask for it to be updated or corrected. You also have the right to request us to complete the Personal Information you believe is incomplete.</p> 
                
                <p>(iv) You have the right to object to the processing of your information if the processing is carried out on a legal basis other than consent. Where Personal Information is processed for the public interest, in the exercise of an official authority vested in us, or for the purposes of the legitimate interests pursued by us, you may object to such processing by providing a ground related to your particular situation to justify the objection. You must know that, however, should your Personal Information be processed for direct marketing purposes, you can object to that processing at any time without providing any justification. To learn whether we are processing Personal Information for direct marketing purposes, you may refer to the relevant sections of this Policy.</p> 
                
                <p>(v) You have the right, under certain circumstances, to restrict the processing of your Personal Information. These circumstances include: the accuracy of your Personal Information is contested by you and we must verify its accuracy; the processing is unlawful, but you oppose the erasure of your Personal Information and request the restriction of its use instead; we no longer need your Personal Information for the purposes of processing, but you require it to establish, exercise or defend your legal claims; you have objected to processing pending the verification of whether our legitimate grounds override your legitimate grounds. Where processing has been restricted, such Personal Information will be marked accordingly and, with the exception of storage, will be processed only with your consent or for the establishment, to exercise or defense of legal claims, for the protection of the rights of another natural, or legal person or for reasons of important public interest.</p> 
                
                <p>(vi) You have the right, under certain circumstances, to obtain the erasure of your Personal Information from us. These circumstances include: the Personal Information is no longer necessary in relation to the purposes for which it was collected or otherwise processed; you withdraw consent to consent-based processing; you object to the processing under certain rules of applicable data protection law; the processing is for direct marketing purposes; and the personal data have been unlawfully processed. However, there are exclusions of the right to erasure such as where processing is necessary: for exercising the right of freedom of expression and information; for compliance with a legal obligation; or for the establishment, to exercise or defense of legal claims.</p> 
                
                <p>(vii) You have the right to receive your Personal Information that you have provided to us in a structured, commonly used, and machine-readable format and, if technically feasible, to have it transmitted to another controller without any hindrance from us, provided that such transmission does not adversely affect the rights and freedoms of others.</p> 
                
                <p>(viii) You have the right to complain to a data protection authority about our collection and use of your Personal Information. If you are not satisfied with the outcome of your complaint directly with us, you have the right to lodge a complaint with your local data protection authority. For more information, please contact your local data protection authority in the EEA. This provision is applicable provided that your Personal Information is processed by automated means and that the processing is based on your consent, on a contract which you are part of, or on pre-contractual obligations thereof.</p> 
                
                <h2 id="california-privacy-rights">California privacy rights</h2> 
                
                <p>Consumers residing in California are afforded certain additional rights with respect to their Personal Information under the California Consumer Privacy Act (&#8220;CCPA&#8221;). If you are a California resident, this section applies to you.</p> 
                
                <p>In addition to the rights as explained in this Policy, California residents who provide Personal Information as defined in the statute to obtain Services for personal, family, or household use are entitled to request and obtain from us, once a calendar year, information about the categories and specific pieces of Personal Information we have collected and disclosed.</p> 
                
                <p>Furthermore, California residents have the right to request deletion of their Personal Information or opt-out of the sale of their Personal Information which may include selling, disclosing, or transferring Personal Information to another business or a third party for monetary or other valuable consideration. To do so, simply contact us. We will not discriminate against you if you exercise your rights under the CCPA.</p> 
                
                <h2 id="how-to-exercise-your-rights">How to exercise your rights</h2> 
                
                <p>Any requests to exercise your rights can be directed to us through the contact details provided in this document. Please note that we may ask you to verify your identity before responding to such requests. Your request must provide sufficient information that allows us to verify that you are the person you are claiming to be or that you are the authorized representative of such person. If we receive your request from an authorized representative, we may request evidence that you have provided such an authorized representative with power of attorney or that the authorized representative otherwise has valid written authority to submit requests on your behalf.</p> 
                
                <p>You must include sufficient details to allow us to properly understand the request and respond to it. We cannot respond to your request or provide you with Personal Information unless we first verify your identity or authority to make such a request and confirm that the Personal Information relates to you.</p> 
                
                <h2 id="cookies">Cookies</h2> 
                
                <p>Our Services use &#8220;cookies&#8221; to help personalize your online experience. A cookie is a text file that is placed on your hard disk by a web page server. Cookies cannot be used to run programs or deliver viruses to your computer. Cookies are uniquely assigned to you, and can only be read by a web server in the domain that issued the cookie to you. If you choose to decline cookies, you may not be able to fully experience the features of the Services.</p> 
                
                <p>We may use cookies to collect, store, and track information for security and personalization, to operate the Services, and for statistical purposes. For further information on the cookies we collect and their purpose, see our <a href="http://www.lifeofpoker.com/cookiepolicy">cookie policy</a>. Please note that you have the ability to accept or decline cookies. Most web browsers automatically accept cookies by default, but you can modify your browser settings to decline cookies if you prefer.</p> 
                
                <h2 id="data-analytics">Data analytics</h2> 
                
                <p>Our Services may use third-party analytics tools that use cookies, web beacons, or other similar information-gathering technologies to collect standard internet activity and usage information. The information gathered is used to compile statistical reports on User activity such as how often Users visit our Services, what pages they visit and for how long, etc. We use the information obtained from these analytics tools to monitor the performance and improve our Services. We do not use third-party analytics tools to track or to collect any personally identifiable information of our Users and we will not associate any information gathered from the statistical reports with any individual User.</p> 
                
                <h2 id="do-not-track-signals">Do Not Track signals</h2> 
                
                <p>Some browsers incorporate a Do Not Track feature that signals to websites you visit that you do not want to have your online activity tracked. Tracking is not the same as using or collecting information in connection with a website. For these purposes, tracking refers to collecting personally identifiable information from consumers who use or visit a website or online service as they move across different websites over time. How browsers communicate the Do Not Track signal is not yet uniform. As a result, the Services are not yet set up to interpret or respond to Do Not Track signals communicated by your browser. Even so, as described in more detail throughout this Policy, we limit our use and collection of your Personal Information. For a description of Do Not Track protocols for browsers and mobile devices or to learn more about the choices available to you, visit <a href="https://www.internetcookies.com" target="_blank">internetcookies.com</a></p> 
                
                <h2 id="advertisements">Advertisements</h2> 
                
                <p>We may display online advertisements and we may share aggregated and non-identifying information about our customers that we or our advertisers collect through your use of the Services. We do not share personally identifiable information about individual customers with advertisers. In some instances, we may use this aggregated and non-identifying information to deliver tailored advertisements to the intended audience.</p> 
                
                <p>We may also permit certain third-party companies to help us tailor advertising that we think may be of interest to Users and to collect and use other data about User activities on the Services. These companies may deliver ads that might place cookies and otherwise track User behavior.</p> 
                
                <h2 id="social-media-features">Social media features</h2> 
                
                <p>Our Services may include social media features, such as the Facebook and Twitter buttons, Share This buttons, etc (collectively, &#8220;Social Media Features&#8221;). These Social Media Features may collect your IP address, what page you are visiting on our Services, and may set a cookie to enable Social Media Features to function properly. Social Media Features are hosted either by their respective providers or directly on our Services. Your interactions with these Social Media Features are governed by the privacy policy of their respective providers.</p> 
                
                <h2 id="email-marketing">Email marketing</h2> 
                
                <p>We offer electronic newsletters to which you may voluntarily subscribe at any time. We are committed to keeping your e-mail address confidential and will not disclose your email address to any third parties except as allowed in the information use and processing section. We will maintain the information sent via e-mail in accordance with applicable laws and regulations.</p> 
                
                <p>In compliance with the CAN-SPAM Act, all e-mails sent from us will clearly state who the e-mail is from and provide clear information on how to contact the sender. You may choose to stop receiving our newsletter or marketing emails by following the unsubscribe instructions included in these emails or by contacting us. However, you will continue to receive essential transactional emails.</p> 
                
                <h2 id="affiliate-links">Affiliate links</h2> 
                
                <p>We may engage in affiliate marketing and have affiliate links present on the Services for the purpose of being able to offer you related or additional products and services. If you click on an affiliate link, a cookie will be placed on your browser to track any sales for purposes of commissions.</p> 
                
                <h2 id="links-to-other-resources">Links to other resources</h2> 
                
                <p>The Services contain links to other resources that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other resources or third parties. We encourage you to be aware when you leave the Services and to read the privacy statements of each and every resource that may collect Personal Information.</p> 
                
                <h2 id="information-security">Information security</h2> 
                
                <p>We secure information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of Personal Information in our control and custody. However, no data transmission over the Internet or wireless network can be guaranteed.</p> 
                
                <p>Therefore, while we strive to protect your Personal Information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and the Services cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third party, despite best efforts.</p> 
                
                <p>As the security of Personal Information depends in part on the security of the device you use to communicate with us and the security you use to protect your credentials, please take appropriate measures to protect this information.</p> 
                
                <h2 id="data-breach">Data breach</h2> 
                
                <p>In the event we become aware that the security of the Services has been compromised or Users&#8217; Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the User as a result of the breach or if notice is otherwise required by law. When we do, we will post a notice on the Services.</p> 
                
                <h2 id="changes-and-amendments">Changes and amendments</h2> 
                
                <p>We reserve the right to modify this Policy or its terms related to the Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p> 
                
                <p>An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes. However, we will not, without your consent, use your Personal Information in a manner materially different than what was stated at the time your Personal Information was collected.</p> 
                
                <h2 id="acceptance-of-this-policy">Acceptance of this policy</h2> 
                
                <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Services and submitting your information you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Services.</p> 
                
                <h2 id="contacting-us">Contacting us</h2> 
                
                <p>If you have any questions regarding the information we may hold about you or if you wish to exercise your rights, you may use the following data subject request form to submit your request:</p> 
                
                <p><a href="https://app.websitepolicies.com/dsar/view/2jt8zqk5" target="_blank" rel="nofollow noreferrer noopener external">Submit a data access request</a></p> 
                
                <p>If you have any other questions, concerns, or complaints regarding this Policy, we encourage you to contact us using the details below:</p> 
                
                <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;i&#110;&#102;o&#64;&#108;if&#101;&#111;&#102;po&#107;er.&#99;&#111;&#109;">&#105;n&#102;&#111;&#64;lif&#101;&#111;f&#112;ok&#101;r&#46;co&#109;</a></p> 
                
                <p>We will attempt to resolve complaints and disputes and make every reasonable effort to honor your wish to exercise your rights as quickly as possible and in any event, within the timescales provided by applicable data protection laws.</p> 
                
                <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'contact',
            'name' => 'Contact',
            'title' => 'Contact',
            'slug' => 'contact',
            'content' => '<p>Let us know your question or just message us if you want to receive more information on any of our products.</p>

            <p>Please fill in the form and we will come back to you within 48 hours.</p>
            
            <p><a href="mailto:info@lifeofpoker.com">info@lifeofpoker.com</a></p>
            
            <p>&nbsp;</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Live Reporting',
            'title' => 'Live Reporting',
            'slug' => 'reporting',
            'content' => '<p>We are upgrading the system. Please check back soon.</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Agenda',
            'title' => 'Event Calendar',
            'slug' => 'event-calendar',
            'content' => 'Event calendar',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'Default',
            'name' => 'Cookie',
            'title' => 'Cookie Policy',
            'slug' => 'cookie',
            'content' => '<p>This cookie policy (&ldquo;Policy&rdquo;) describes what cookies are and how and they&rsquo;re being used by the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&ldquo;Website&rdquo; or &ldquo;Service&rdquo;) and any of its related products and services (collectively, &ldquo;Services&rdquo;). This Policy is a legally binding agreement between you (&ldquo;User&rdquo;, &ldquo;you&rdquo; or &ldquo;your&rdquo;) and LIFE OF POKER PTY LTD (&ldquo;LIFE OF POKER PTY LTD&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo; or &ldquo;our&rdquo;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &ldquo;User&rdquo;, &ldquo;you&rdquo; or &ldquo;your&rdquo; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Website and Services. You should read this Policy so you can understand the types of cookies we use, the information we collect using cookies and how that information is used. It also describes the choices available to you regarding accepting or declining the use of cookies.</p>

            <h3>Table of contents</h3>
            
            <ol>
                <li><a href="#what-are-cookies">What are cookies?</a></li>
                <li><a href="#what-type-of-cookies-do-we-use">What type of cookies do we use?</a></li>
                <li><a href="#what-are-your-cookie-options">What are your cookie options?</a></li>
                <li><a href="#changes-and-amendments">Changes and amendments</a></li>
                <li><a href="#acceptance-of-this-policy">Acceptance of this policy</a></li>
                <li><a href="#contacting-us">Contacting us</a></li>
            </ol>
            
            <h2>What are cookies?</h2>
            
            <p>Cookies are small pieces of data stored in text files that are saved on your computer or other devices when websites are loaded in a browser. They are widely used to remember you and your preferences, either for a single visit (through a &ldquo;session cookie&rdquo;) or for multiple repeat visits (using a &ldquo;persistent cookie&rdquo;).</p>
            
            <p>Session cookies are temporary cookies that are used during the course of your visit to the Website, and they expire when you close the web browser.</p>
            
            <p>Persistent cookies are used to remember your preferences within our Website and remain on your desktop or mobile device even after you close your browser or restart your computer. They ensure a consistent and efficient experience for you while visiting the Website and Services.</p>
            
            <p>Cookies may be set by the Website (&ldquo;first-party cookies&rdquo;), or by third parties, such as those who serve content or provide advertising or analytics services on the Website (&ldquo;third party cookies&rdquo;). These third parties can recognize you when you visit our website and also when you visit certain other websites.</p>
            
            <h2>What type of cookies do we use?</h2>
            
            <h3>Necessary cookies</h3>
            
            <p>Necessary cookies allow us to offer you the best possible experience when accessing and navigating through our Website and using its features. For example, these cookies let us recognize that you have created an account and have logged into that account to access the content.</p>
            
            <h3>Functionality cookies</h3>
            
            <p>Functionality cookies let us operate the Website and Services in accordance with the choices you make. For example, we will recognize your username and remember how you customized the Website and Services during future visits.</p>
            
            <h3>Analytical cookies</h3>
            
            <p>These cookies enable us and third party services to collect aggregated data for statistical purposes on how our visitors use the Website. These cookies do not contain personal information such as names and email addresses and are used to help us improve your user experience of the Website.</p>
            
            <h3>Advertising cookies</h3>
            
            <p>Advertising cookies allow us and third parties serve relevant ads to you more effectively and help us collect aggregated audit data, research, and performance reporting for advertisers. They also enable us to understand and improve the delivery of ads to you and know when certain ads have been shown to you.</p>
            
            <p>Your web browser may request advertisements directly from ad network servers, these networks can view, edit, or set their own cookies, just as if you had requested a web page from their website.</p>
            
            <p>Although we do not use cookies to create a profile of your browsing behavior on third party websites, we do use aggregate data from third parties to show you relevant, interest-based advertising. We do not provide any personal information that we collect to advertisers.</p>
            
            <h3>Social media cookies</h3>
            
            <p>Third party cookies from social media sites (such as Facebook, Twitter, etc) let us track social network users when they visit or use the Website and Services, or share content, by using a tagging mechanism provided by those social networks.</p>
            
            <p>These cookies are also used for event tracking and remarketing purposes. Any data collected with these tags will be used in accordance with our and social networks&rsquo; privacy policies. We will not collect or share any personally identifiable information from the user.</p>
            
            <h2>What are your cookie options?</h2>
            
            <p>If you don&rsquo;t like the idea of cookies or certain types of cookies, you can change your browser&rsquo;s settings to delete cookies that have already been set and to not accept new cookies. Visit <a href="https://www.internetcookies.com" target="_blank">internetcookies.com</a> to learn more about how to do this.</p>
            
            <h2>Changes and amendments</h2>
            
            <p>We reserve the right to modify this Policy or its terms related to the Website and Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p>
            
            <p>An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Website and Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes.</p>
            
            <h2>Acceptance of this policy</h2>
            
            <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Website and Services you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Website and Services.</p>
            
            <h2>Contacting us</h2>
            
            <p>If you have any questions, concerns, or complaints regarding this Policy or the use of cookies, we encourage you to contact us using the details below:</p>
            
            <p><a href="mailto:info@lifeofpoker.com">info@lifeofpoker.com</a></p>
            
            <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Acceptable Use Policy',
            'title' => 'Acceptable Use Policy',
            'slug' => 'acceptable-use',
            'content' => '<p>This acceptable use policy (&#8220;Policy&#8221;) sets forth the general guidelines and acceptable and prohibited uses of the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&#8220;Website&#8221;), &#8220;Life of Poker&#8221; mobile application (&#8220;Mobile Application&#8221;) and any of their related products and services (collectively, &#8220;Services&#8221;). This Policy is a legally binding agreement between you (&#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221;) and LIFE OF POKER PTY LTD (&#8220;LIFE OF POKER PTY LTD&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Services. By accessing and using the Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Agreement. You acknowledge that this Agreement is a contract between you and LIFE OF POKER PTY LTD, even though it is electronic and is not physically signed by you, and it governs your use of the Services.</p> 

                <div class="wpembed-index"><h3>Table of contents</h3><ol class="wpembed-index"><li><a href="#prohibited-activities-and-uses">Prohibited activities and uses</a></li><li><a href="#system-abuse">System abuse</a></li><li><a href="#service-resources">Service resources</a></li><li><a href="#no-spam-policy">No spam policy</a></li><li><a href="#copyrighted-content">Copyrighted content</a></li><li><a href="#security">Security</a></li><li><a href="#enforcement">Enforcement</a></li><li><a href="#reporting-violations">Reporting violations</a></li><li><a href="#changes-and-amendments">Changes and amendments</a></li><li><a href="#acceptance-of-this-policy">Acceptance of this policy</a></li><li><a href="#contacting-us">Contacting us</a></li></ol></div><h2 id="prohibited-activities-and-uses">Prohibited activities and uses</h2> 
                
                <p>You may not use the Services to engage in activity that is illegal under applicable law, that is harmful to others, or that would subject us to liability, including, without limitation, in connection with any of the following, each of which is prohibited under this Policy:</p> 
                
                <ul> 
                
                <li>Distributing malware or other malicious code.</li> 
                
                <li>Disclosing sensitive personal information about others.</li> 
                
                <li>Collecting, or attempting to collect, personal information about third parties without their knowledge or consent.</li> 
                
                <li>Distributing pornography or adult related content.</li> 
                
                <li>Promoting or facilitating prostitution or any escort services.</li> 
                
                <li>Hosting, distributing or linking to child pornography or content that is harmful to minors.</li> 
                
                <li>Promoting or facilitating gambling, violence, terrorist activities or selling weapons or ammunition.</li> 
                
                <li>Engaging in the unlawful distribution of controlled substances, drug contraband or prescription medications.</li> 
                
                <li>Managing payment aggregators or facilitators such as processing payments on behalf of other businesses or charities.</li> 
                
                <li>Facilitating pyramid schemes or other models intended to seek payments from public actors.</li> 
                
                <li>Threatening harm to persons or property or otherwise harassing behavior.</li> 
                
                <li>Purchasing any of the offered Services on someone else&#8217;s behalf.</li> 
                
                <li>Misrepresenting or fraudulently representing products or services.</li> 
                
                <li>Infringing the intellectual property or other proprietary rights of others.</li> 
                
                <li>Facilitating, aiding, or encouraging any of the above activities through the Services.</li> 
                
                </ul> 
                
                <h2 id="system-abuse">System abuse</h2> 
                
                <p>Any User in violation of the Services security is subject to criminal and civil liability, as well as immediate account termination. Examples include, but are not limited to the following:</p> 
                
                <ul> 
                
                <li>Use or distribution of tools designed for compromising security of the Services.</li> 
                
                <li>Intentionally or negligently transmitting files containing a computer virus or corrupted data.</li> 
                
                <li>Accessing another network without permission, including to probe or scan for vulnerabilities or breach security or authentication measures.</li> 
                
                <li>Unauthorized scanning or monitoring of data on any network or system without proper authorization of the owner of the system or network.</li> 
                
                </ul> 
                
                <h2 id="service-resources">Service resources</h2> 
                
                <p>You may not consume excessive amounts of the resources of the Services or use the Services in any way which results in performance issues or which interrupts the Services for other Users. Prohibited activities that contribute to excessive use, include without limitation:</p> 
                
                <ul> 
                
                <li>Deliberate attempts to overload the Services and broadcast attacks (i.e. denial of service attacks).</li> 
                
                <li>Engaging in any other activities that degrade the usability and performance of the Services.</li> 
                
                </ul> 
                
                <h2 id="no-spam-policy">No spam policy</h2> 
                
                <p>You may not use the Services to send spam or bulk unsolicited messages. We maintain a zero tolerance policy for use of the Services in any manner associated with the transmission, distribution or delivery of any bulk e-mail, including unsolicited bulk or unsolicited commercial e-mail, or the sending, assisting, or commissioning the transmission of commercial e-mail that does not comply with the U.S. CAN-SPAM Act of 2003 (&#8220;SPAM&#8221;).</p> 
                
                <p>Your products or services advertised via SPAM (i.e. Spamvertised) may not be used in conjunction with the Services. This provision includes, but is not limited to, SPAM sent via fax, phone, postal mail, email, instant messaging, or newsgroups.</p> 
                
                <p>Sending emails through the Services to purchased email lists (&#8220;safe lists&#8221;) will be treated as SPAM.</p> 
                
                <h2 id="copyrighted-content">Copyrighted content</h2> 
                
                <p>Copyrighted material must not be published via the Services without the explicit permission of the copyright owner or a person explicitly authorized to give such permission by the copyright owner. Upon receipt of a claim for copyright infringement, or a notice of such violation, we will immediately run full investigation and, upon confirmation, will notify the person or persons responsible for publishing it and, in our sole discretion, will remove the infringing material from the Services. We may terminate the Service of Users with repeated copyright infringements. Further procedures may be carried out if necessary. We will assume no liability to any User of the Services for the removal of any such material. If you believe your copyright is being infringed by a person or persons using the Services, please get in touch with us to report copyright infringement.</p> 
                
                <h2 id="security">Security</h2> 
                
                <p>You take full responsibility for maintaining reasonable security precautions for your account. You are responsible for protecting and updating any login account provided to you for the Services. You must protect the confidentiality of your login details, and you should change your password periodically.</p> 
                
                <h2 id="enforcement">Enforcement</h2> 
                
                <p>We reserve our right to be the sole arbiter in determining the seriousness of each infringement and to immediately take corrective actions, including but not limited to:</p> 
                
                <ul> 
                
                <li>Suspending or terminating your Service with or without notice upon any violation of this Policy. Any violations may also result in the immediate suspension or termination of your account.</li> 
                
                <li>Disabling or removing any content which is prohibited by this Policy, including to prevent harm to others or to us or the Services, as determined by us in our sole discretion.</li> 
                
                <li>Reporting violations to law enforcement as determined by us in our sole discretion.</li> 
                
                <li>A failure to respond to an email from our abuse team within 2 days, or as otherwise specified in the communication to you, may result in the suspension or termination of your account.</li> 
                
                </ul> 
                
                <p>Suspended and terminated User accounts due to violations will not be re-activated.</p> 
                
                <p>Nothing contained in this Policy shall be construed to limit our actions or remedies in any way with respect to any of the prohibited activities. We reserve the right to take any and all additional actions we may deem appropriate with respect to such activities, including without limitation taking action to recover the costs and expenses of identifying offenders and removing them from the Services, and levying cancellation charges to cover our costs. In addition, we reserve at all times all rights and remedies available to us with respect to such activities at law or in equity.</p> 
                
                <h2 id="reporting-violations">Reporting violations</h2> 
                
                <p>If you have discovered and would like to report a violation of this Policy, please contact us immediately. We will investigate the situation and provide you with full assistance.</p> 
                
                <h2 id="changes-and-amendments">Changes and amendments</h2> 
                
                <p>We reserve the right to modify this Policy or its terms related to the Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p> 
                
                <p>An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes.</p> 
                
                <h2 id="acceptance-of-this-policy">Acceptance of this policy</h2> 
                
                <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Services you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Services.</p> 
                
                <h2 id="contacting-us">Contacting us</h2> 
                
                <p>If you have any questions, concerns, or complaints regarding this Policy, we encourage you to contact us using the details below:</p> 
                
                <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;&#105;&#110;&#102;&#111;&#64;l&#105;&#102;e&#111;&#102;po&#107;&#101;&#114;.c&#111;&#109;">in&#102;&#111;&#64;lif&#101;ofpo&#107;&#101;&#114;&#46;&#99;&#111;&#109;</a></p> 
                
                <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'DMCA Policy',
            'title' => 'DMCA Policy',
            'slug' => 'dmca',
            'content' => '<p>This Digital Millennium Copyright Act policy (&#8220;Policy&#8221;) applies to the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&#8220;Website&#8221;), &#8220;Life of Poker&#8221; mobile application (&#8220;Mobile Application&#8221;) and any of their related products and services (collectively, &#8220;Services&#8221;) and outlines how LIFE OF POKER PTY LTD (&#8220;LIFE OF POKER PTY LTD&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;) addresses copyright infringement notifications and how you (&#8220;you&#8221; or &#8220;your&#8221;) may submit a copyright infringement complaint.</p> 

            <p>Protection of intellectual property is of utmost importance to us and we ask our users and their authorized agents to do the same. It is our policy to expeditiously respond to clear notifications of alleged copyright infringement that comply with the United States Digital Millennium Copyright Act (&#8220;DMCA&#8221;) of 1998, the text of which can be found at the U.S. Copyright Office <a href="https://www.copyright.gov" target="_blank" rel="nofollow noreferrer noopener external">website</a>.</p> 
            
            <div class="wpembed-index"><h3>Table of contents</h3><ol class="wpembed-index"><li><a href="#what-to-consider-before-submitting-a-copyright-complaint">What to consider before submitting a copyright complaint</a></li><li><a href="#notifications-of-infringement">Notifications of infringement</a></li><li><a href="#counter-notifications">Counter-notifications</a></li><li><a href="#changes-and-amendments">Changes and amendments</a></li><li><a href="#reporting-copyright-infringement">Reporting copyright infringement</a></li></ol></div><h2 id="what-to-consider-before-submitting-a-copyright-complaint">What to consider before submitting a copyright complaint</h2> 
            
            <p>Before submitting a copyright complaint to us, consider whether the use could be considered fair use. Fair use states that brief excerpts of copyrighted material may, under certain circumstances, be quoted verbatim for purposes such as criticism, news reporting, teaching, and research, without the need for permission from or payment to the copyright holder. If you have considered fair use, and you still wish to continue with a copyright complaint, you may want to first reach out to the user in question to see if you can resolve the matter directly with the user.</p> 
            
            <p>Please note that under 17 U.S.C. § 512(f), you may be liable for any damages, including costs and attorneys&#8217; fees incurred by us or our users, if you knowingly misrepresent that the material or activity is infringing. If you are unsure whether the material you are reporting is in fact infringing, you may wish to contact an attorney before filing a notification with us.</p> 
            
            <p>We may, at our discretion or as required by law, share a copy of your notification or counter-notification with third parties. This may include sharing the information with the account holder engaged in the allegedly infringing activity or for publication. If you are concerned about your information being forwarded, you may wish to <a href="https://www.copyrighted.com/professional-takedowns" target="_blank">hire an agent</a> to report infringing material for you.</p> 
            
            <h2 id="notifications-of-infringement">Notifications of infringement</h2> 
            
            <p>If you are a copyright owner or an agent thereof, and you believe that any material available on our Services infringes your copyrights, then you may submit a written copyright infringement notification (&#8220;Notification&#8221;) using the contact details below pursuant to the DMCA. All such Notifications must comply with the DMCA requirements. You may refer to a <a href="https://www.websitepolicies.com/create/dmca-takedown-notice" target="_blank">DMCA takedown notice generator</a> or other similar services to avoid making mistake and ensure compliance of your Notification.</p> 
            
            <p>Filing a DMCA complaint is the start of a pre-defined legal process. Your complaint will be reviewed for accuracy, validity, and completeness. If your complaint has satisfied these requirements, our response may include the removal or restriction of access to allegedly infringing material as well as a permanent termination of repeat infringers&#8217; accounts.</p> 
            
            <p>If we remove or restrict access to materials or terminate an account in response to a Notification of alleged infringement, we will make a good faith effort to contact the affected user with information concerning the removal or restriction of access, which may include a full copy of your Notification (including your name, address, phone, and email address), along with instructions for filing a counter-notification.</p> 
            
            <p>Notwithstanding anything to the contrary contained in any portion of this Policy, LIFE OF POKER PTY LTD reserves the right to take no action upon receipt of a DMCA copyright infringement notification if it fails to comply with all the requirements of the DMCA for such notifications.</p> 
            
            <h2 id="counter-notifications">Counter-notifications</h2> 
            
            <p>A user who receives a copyright infringement Notification may make a counter-Notification pursuant to sections 512(g)(2) and (3) of the US Copyright Act. If you receive a copyright infringement Notification, it means that the material described in the Notification has been removed from our Services or access to the material has been restricted. Please take the time to read through the Notification, which includes information on the Notification we received. To file a counter-notification with us, you must provide a written communication compliant with the DMCA requirements.</p> 
            
            <p>Please note that you may be liable for, including costs and attorneys&#8217; fees incurred by us or our users, if you knowingly misrepresent that the material or activity is not infringing the copyrights of others or that the material or activity was removed or restricted by mistake or misidentification. Accordingly, if you are not sure whether certain material infringes the copyrights of others or that the material or activity was removed or restricted by mistake or misidentification, you may wish to contact an attorney before filing a counter-notification.</p> 
            
            <p>Notwithstanding anything to the contrary contained in any portion of this Policy, LIFE OF POKER PTY LTD reserves the right to take no action upon receipt of a counter-notification. If we receive a counter-notification that complies with the terms of 17 U.S.C. § 512(g), we may forward it to the person who filed the original Notification.</p> 
            
            <p>The process described in this Policy does not limit our ability to pursue any other remedies we may have to address suspected infringement.</p> 
            
            <h2 id="changes-and-amendments">Changes and amendments</h2> 
            
            <p>We reserve the right to modify this Policy or its terms related to the Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p> 
            
            <p>An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes.</p> 
            
            <h2 id="reporting-copyright-infringement">Reporting copyright infringement</h2> 
            
            <p>If you would like to notify us of the infringing material or activity, we encourage you to contact us using the details below:</p> 
            
            <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;inf&#111;&#64;&#108;i&#102;&#101;&#111;fpoke&#114;&#46;com">&#105;&#110;&#102;o&#64;l&#105;f&#101;&#111;fpok&#101;&#114;.&#99;o&#109;</a></p> 
            
            <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Guest Post Policy',
            'title' => 'Guest Post Policy',
            'slug' => 'guest-post',
            'content' => '<p>Thank you for showing interest in writing a guest post for us. We&#8217;re glad you&#8217;re here.</p> 

            <p>Please take a moment to review this entire page as it explains the guidelines, the submission process, and other important details.</p> 
            
            <p>This will ensure that your submission meets what we&#8217;re looking for and improve your chances of getting the article published on our website.</p> 
            
            <h2>Article guidelines</h2> 
            
            <p>Before sending us your article, make sure it follows these guidelines:</p> 
            
            <ul> 
            
            <li>Article must have a minimum of 500 words</li> 
            
            <li>Article must be free of spelling mistakes</li> 
            
            <li>Article must be free of plagiarism</li> 
            
            <li>Article must be unique and not previously published anywhere else</li> 
            
            <li>Article must not violate any copyrights, patents, or trademarks</li> 
            
            <li>Article must not contain unlawful, hateful, and threatening language</li> 
            
            <li>Article must not contain profanity or vulgar language</li> 
            
            <li>Article must be search engine friendly (use proper headings, paragraphs, etc)</li> 
            
            <li>Article may include relevant pictures and videos with proper attributions, permission to use, or related licenses</li> 
            
            <li>Article may contain links to other websites as long as they don&#8217;t point to your own website</li> 
            
            <li>Article must be submitted in the Word format</li> 
            
            </ul> 
            
            <p>You may email your article to <a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;info&#64;&#108;i&#102;eo&#102;&#112;ok&#101;r.c&#111;&#109;">&#105;&#110;f&#111;&#64;l&#105;&#102;&#101;&#111;&#102;&#112;&#111;&#107;&#101;&#114;&#46;com</a></p> 
            
            <h2>Ownership and credit</h2> 
            
            <p>We accepted and publish only ghostwritten articles. This means that if your article is accepted and published, your name will not be displayed or referenced anywhere in the article and we reserve the right to display someone else&#8217;s name as the article&#8217;s writer. By submitting an article, you acknowledge that you understand and accept it.</p> 
            
            <p>You understand and agree that the article and related materials submitted and published by us will become our exclusive property. You understand and agree that you don&#8217;t have the right to republish the article on your own website or anywhere else (e.g. web, print, etc).</p> 
            
            <h2>Review process</h2> 
            
            <p>We&#8217;ll do our best to review all submitted articles as quickly as possible. However, due to a large number of article submissions we receive on a regular basis, it may take a while to get back to you so please be patient and don&#8217;t resubmit the same article multiple times.</p> 
            
            <p>Not all submitted articles will be accepted. We reserve the right to refuse any article at our sole discretion. Note that we&#8217;ll contact you only if we&#8217;re interested in your article. If you don&#8217;t hear from us for a while, you may review these guidelines again and submit another article.</p> 
            
            <h2>Article publishing</h2> 
            
            <p>If your article is accepted, it will be published right away. We may also have the article translated into other languages.</p> 
            
            <p>Note that we reserve the right to make corrections and changes in the article as we see fit (such as its format, wording, spelling, etc).</p> 
            
            <h2>Promotion and engagement</h2> 
            
            <p>Once your article is published, we&#8217;ll promote it to our audience for wider exposure and better engagement. This may include sending a newsletter, posting on your social media channels, making an announcement or linking to it from your own website.</p> 
            
            <h2>Legal disclaimer</h2> 
            
            <p>This guest post agreement (&#8220;Agreement&#8221;) sets forth the general guidelines, requirements, terms, conditions, rights, and obligations when you (&#8220;Writer&#8221;, &#8220;you&#8221; or &#8220;your&#8221;) wish to submit a guest post article (&#8220;Article&#8221;) for the <a href="http://www.lifeofpoker.com">lifeofpoker.com</a> website (&#8220;website&#8221;). This Agreement is legally binding between you and LIFE OF POKER PTY LTD (&#8220;LIFE OF POKER PTY LTD&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;).</p> 
            
            <p>If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &#8220;writer&#8221;, &#8220;you&#8221; or &#8220;your&#8221; shall refer to such entity. If you do not have such authority, or if you do not agree with the guidelines, terms, conditions, rights, or obligations, you must not accept this agreement and may not submit any articles.</p> 
            
            <p>By submitting an article for publishing on the website, you acknowledge that you have read, understood, and agree to be bound by the terms of this Agreement. You acknowledge that this Agreement is a contract between you and LIFE OF POKER PTY LTD, even though it is electronic and is not physically signed by you, and it governs your article submissions and publishings.</p> 
            
            <h3>Independent contractor status</h3> 
            
            <p>Nothing contained in this Agreement shall be interpreted as creating or establishing any partnership or joint venturers. You acknowledge that you act as an independent contractor. You are not considered an employee and are not entitled to participate in any employee plans, arrangements, or distributions by LIFE OF POKER PTY LTD. You must not act as an agent of LIFE OF POKER PTY LTD and must not provide any services under the name of LIFE OF POKER PTY LTD.</p> 
            
            <p>You must not under any circumstances (i) enter into any agreements on behalf of LIFE OF POKER PTY LTD, (ii) incur any obligations on behalf of LIFE OF POKER PTY LTD, (iii) act for or to bind LIFE OF POKER PTY LTD in any way, (iv) sign the name of LIFE OF POKER PTY LTD, (v) represent that LIFE OF POKER PTY LTD is in any way responsible for your acts or omissions (vi) refer to LIFE OF POKER PTY LTD as a customer in any manner or format, or (vii) use our logo or name in a way that implies that you and LIFE OF POKER PTY LTD are partners or that we have endorsed you, your website or your products or services. You must obtain express written permission for any use of the logos, trademarks, or other intellectual property that belong to LIFE OF POKER PTY LTD.</p> 
            
            <h3>Ownership of intellectual property</h3> 
            
            <p>Upon submitting an Article, you transfer all of its ownership rights to LIFE OF POKER PTY LTD and give LIFE OF POKER PTY LTD a perpetual, irrevocable, worldwide, non-exclusive, royalty-free, transferable, and fully sub-licensable right and license to reproduce, distribute, publicly display, use, perform, make derivative works of or otherwise use the Article and likeness in any form, media or technology, now known or later developed for any purpose including commercial purposes.</p> 
            
            <h3>Limitation of liability</h3> 
            
            <p>To the fullest extent permitted by applicable law, in no event will LIFE OF POKER PTY LTD, its affiliates, directors, officers, employees, agents, suppliers or licensors be liable to any person for any indirect, incidental, special, punitive, cover, or consequential damages (including, without limitation, damages for lost profits, revenue, sales, goodwill, use of the content, impact on business, business interruption, loss of anticipated savings, loss of business opportunity) however caused, under any theory of liability, including, without limitation, contract, tort, warranty, breach of statutory duty, negligence or otherwise, even if the liable party has been advised as to the possibility of such damages or could have foreseen such damages. You assume all legal liability for the accuracy, scope, quality, and any possible outcomes as a result of or relating to your Article.</p> 
            
            <h3>Indemnification</h3> 
            
            <p>You agree to indemnify and hold LIFE OF POKER PTY LTD and its affiliates, directors, officers, employees, agents, suppliers, and licensors harmless from and against any liabilities, losses, damages, or costs, including reasonable attorneys&#8217; fees, incurred in connection with or arising from any third party allegations, claims, actions, disputes, or demands asserted against any of them as a result of or relating to your Article, your use of the Services or any willful misconduct on your part.</p> 
            
            <h3>Severability</h3> 
            
            <p>All rights and restrictions contained in this Agreement may be exercised and shall be applicable and binding only to the extent that they do not violate any applicable laws and are intended to be limited to the extent necessary so that they will not render this Agreement illegal, invalid or unenforceable. If any provision or portion of any provision of this Agreement shall be held to be illegal, invalid, or unenforceable by a court of competent jurisdiction, it is the intention of the parties that the remaining provisions or portions thereof shall constitute their agreement with respect to the subject matter hereof, and all such remaining provisions or portions thereof shall remain in full force and effect.</p> 
            
            <h3>Dispute of resolution</h3> 
            
            <p>The formation, interpretation, and performance of this Agreement and any disputes arising out of it shall be governed by the substantive and procedural laws of Philippines without regard to its rules on conflicts or choice of law and, to the extent applicable, the laws of Philippines. The exclusive jurisdiction and venue for actions related to the subject matter hereof shall be the courts located in Philippines, and you hereby submit to the personal jurisdiction of such courts. You hereby waive any right to a jury trial in any proceeding arising out of or related to this Agreement. The United Nations Convention on Contracts for the International Sale of Goods does not apply to this Agreement.</p> 
            
            <h3>Assignment</h3> 
            
            <p>You may not assign, resell, sub-license or otherwise transfer or delegate any of your rights or obligations hereunder, in whole or in part, without our prior written consent, which consent shall be at our own sole discretion and without obligation; any such assignment or transfer shall be null and void. We are free to assign any of its rights or obligations hereunder, in whole or in part, to any third party as part of the sale of all or substantially all of its assets or stock or as part of a merger.</p> 
            
            <h3>Changes and amendments</h3> 
            
            <p>We reserve the right to modify this Agreement or its terms at any time at our discretion. When we do, we will revise the updated date at the bottom of this page. An updated version of this Agreement will be effective immediately upon the posting of the revised Agreement unless otherwise specified. Your future Article submissions after the effective date of the revised Agreement (or such other act specified at that time) will constitute your consent to those changes.</p> 
            
            <h3>Acceptance of these terms</h3> 
            
            <p>You acknowledge that you have read this Agreement and agree to all its terms and conditions. By submitting an Article for publishing on the website, you agree to be bound by this Agreement. If you do not agree to abide by the terms of this Agreement, you must not accept this agreement and may not submit any Articles.</p> 
            
            <h3>Contacting us</h3> 
            
            <p>If you have any questions, concerns, or complaints regarding this Agreement, we encourage you to contact us using the details below:</p> 
            
            <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;inf&#111;&#64;l&#105;&#102;&#101;&#111;&#102;&#112;&#111;&#107;e&#114;&#46;c&#111;m">i&#110;f&#111;&#64;&#108;&#105;&#102;e&#111;f&#112;ok&#101;r&#46;com</a></p> 
            
            <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Refund Policy',
            'title' => 'Refund Policy',
            'slug' => 'refund',
            'content' => '<p>We do not provide refunds after the product is shipped, which you acknowledge prior to purchasing any product on the Services. Please make sure that you&#8217;ve carefully read product description before making a purchase. If you would like to make a warranty claim, you may contact product&#8217;s manufacturer.</p> 

            <h2>Contacting us</h2> 
            
            <p>If you have any questions, concerns, or complaints regarding this refund policy, we encourage you to contact us using the details below:</p> 
            
            <p><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;i&#110;f&#111;&#64;l&#105;&#102;e&#111;f&#112;&#111;ker&#46;c&#111;&#109;">info&#64;&#108;i&#102;&#101;ofpok&#101;&#114;.&#99;om</a></p> 
            
            <p>This document was last updated on October 23, 2022</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'default',
            'name' => 'Responsible Gambling',
            'title' => 'Responsible Gambling',
            'slug' => 'responsible-gambling',
            'content' => '<h2>Safer gambling tips </h2>
            <p>Unlike a night in streaming movies, there’s an inherent built-in risk when it comes to gambling and odds are, over time, you may lose more often than you win. Here are some strategies you can use to play safe and have fun.</p>
            <ul>
                <li>Don’t gamble when you’re upset or stressed</li>
            <li>Limit your alcohol and/or cannabis intake while gambling</li>
            <li>Set budget and time limits – there are tools available on many slot machines, mobile and internet gambling sites to help you monitor your play</li>
            <li>Take frequent breaks – move around, get some fresh air, have something to eat or a coffee</li>
            <li>Only gamble with money you have – never borrow money or use money intended for necessities, like rent or food</li>
            <li>Don’t try to win back what you’ve lost</li>
            <li>Gambling is not a way to make money so don’t think of it as a chance to win money for a trip, to pay bills or to pay off debt </li>
            <li>Stick to your budget by leaving your credit and debit cards at home</li>
            <li>Balance gambling with other recreational activities</li>
            <li>If you’re no longer having fun, stop playing</li>
            <li>Don’t depend on “good luck” strategies – they don’t increase your chances of winning</li>
            </ul>
            
            <p>Gambling Help Online provides a range of supportive services for anyone negatively affected by gambling. It is free, confidential and available 24/7. 1800 858 858</p>
            <p><em>* LifeofPoker is approved for 18+ Audience only</em></p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'rooms',
            'name' => 'Rooms',
            'title' => 'Poker Rooms',
            'slug' => 'poker-rooms',
            'content' => '<p>As a poker player, you must be up-to-date regarding the best poker rooms. You don&#39;t want to wait for hours before a game starts or be uncertain if there is a game even. In this section, we show you which poker rooms you can find in Asia and Oceania. We will describe the location, other things to do next to poker, what cash games and tournaments are available, and which poker events these poker rooms have on their schedule.</p>',
            'extras' => null
        ]);

             Page::factory()->create([
            'template' => 'tours',
            'name' => 'Poker Tours',
            'title' => 'Poker Tours',
            'slug' => 'tours',
            'content' => '<p>Is attending a poker event you and your friends always something you thought about but never did? Do you play more often, but want to find a new tour you haven&#39;t attended yet? Or do you only prefer to play deep stack tournaments? Life of Poker fully understands that picking an event is something you and your friends have to schedule beforehand. You want to play at good events, at a good location, and with a professional staff. Therefore we made a page only with the best poker tour operators. You can find all information about the company itself, the upcoming events, locations, buy-ins, and structures.</p>

            <p>&nbsp;</p>',
            'extras' => null
        ]);

 

    }
}
