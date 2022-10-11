<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('articles')->delete();

        \DB::table('articles')->insert([
            0 => [
                'id' => 1,
                'title' => 'Lung Wai Tang wins APPT Kickoff 2022',
                'description' => 'Lung Wai Tang wins the opening event at the APPT Manila. He qualified at Day 1A with 264,000 chips and from the get-go he was building up his stack.',
                'body' => '<p><strong>Lung Wai Tang</strong>&nbsp;wins the opening event at the APPT Manila. He qualified at Day 1A with 264,000 chips and from the get-go he was building up his stack.</p>

<p>Some of the players in the final table started Day 2 with a hot streak.&nbsp;<strong>Zhao Feng, Mike Takayama and John Tech</strong>&nbsp;all built their stacks early on day 2. Singaporean&nbsp;<strong>Zhao Feng</strong>&nbsp; started Day 2 below 100k&nbsp; chips but managed to win some important hands in the first two hours of the day launching him to over 500,000 chips.&nbsp;<strong>Mike Takayama</strong>&nbsp;however was the&nbsp; first player to reach a million chips. Filipino favorite&nbsp;<strong>Conrad Lumaban&nbsp;</strong>won several big hands at the last 4 tables launching him into the chiplead.</p>

<p><strong>Final Table highlights</strong></p>

<p>In the second hand of the final table, Chris Feng and Ashish Munot went all-in preflop. Feng&#39;s pocket tens won the race against Munot&#39;s AQ.</p>

<p>John Tech might have more lives than a cat, after losing a huge cooler early at day 2 with queens against kings, he still managed&nbsp; to win and build his stack to reach the final table.</p>

<p>Mike &quot;Mahal na hari&quot; Takayama, the most popular Filipino poker player, sent Madwahan to the rail in 8th after a coinflip preflop all-in. Mike managed to hit his 8 against Madhawan&#39;s pocket fours.</p>

<p>Mike Takayama&#39;s streak would soon after come to an end by Chris Feng. The Singaporean was dominating the table and gained a huge chiplead on the final table.</p>

<p>Of the four Filipinos that entered the final table only two made it to the final four players. John Tech and Conrad Lumaban bravely defended the pride of their countrymen. Tech however would fall soon after in 4th place.</p>

<p>Everything looked going Feng his way, however in the pot of the tournament Feng lost with <img src="/cards/kh.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/qs.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;versus the <img src="/cards/ad.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/as.png" style="height:15px; margin-right:5px; width:25px" />of Tang. Feng couldn&#39;t find a fold against Tang on <img src="/cards/8d.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/8s.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/10c.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/kd.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;Feng not much later busted in 3th place.</p>

<p>The heads-up itself took around 30 minutes. A difference of more than ₱700,000 was at stake for the players.</p>

<p>In the end Tang managed to get it all-in preflop, but Conrad Lumaban is ahead with <img src="/cards/ah.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/9c.png" style="height:15px; margin-right:5px; width:25px" />against Tang&#39;s <img src="/cards/kh.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/7s.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>The flop was deadly for Lumaban making Tang two pair on <img src="/cards/kd.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/ks.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/7d.png" style="height:15px; margin-right:5px; width:25px" />. The <img src="/cards/6d.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;turn gave Lumaban an up and down, but the <img src="/cards/qc.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;on the river sealed the faith of the Filipino. For Lung Wai Tang, a Hong-Kong businessmen it was his first ever live poker cash. What an exciting ride!</p>

<p>&nbsp;</p>

<p><strong>APPT KICKOFF FINALL TABLE RESULTS</strong></p>

<p>1st:&nbsp;<strong>Lung Wai Tang</strong>&nbsp;(Hong Kong) - ₱1,976,000<br />
2nd:&nbsp;<strong>Conrad Lumaban</strong>&nbsp;(Philippines) - ₱1,200,000<br />
3rd:&nbsp;<strong>Zhao Feng</strong>&nbsp;(Singapore) - ₱860,000<br />
4th:&nbsp;<strong>John Tech</strong>&nbsp;(Philippines) - ₱665,000<br />
5th:&nbsp;<strong>Joseroy Jeremias Jr</strong>&nbsp;(Philippines) - ₱524,000<br />
6th:&nbsp;<strong>Mike Takayama</strong>&nbsp;(Philippines) - ₱410,000<br />
7th:&nbsp;<strong>Duy Tung Nguyen</strong>&nbsp;(Vietnam) - ₱300,000<br />
8th:&nbsp;<strong>Ankit Wadhawan</strong>&nbsp;(India) - ₱205,000<br />
9th:&nbsp;<strong>Ashish Munot</strong>&nbsp;(India) - ₱163,180</p>',
                'image' => null,
                'slug' => 'lung-wai-tang-wins-appt-kickoff-2022',
                'published_date' => '2022-08-01 10:06:00',
                'article_author_id' => 6,
                'created_at' => '2022-09-18 07:32:19',
                'updated_at' => '2022-09-18 08:12:39',
            ],
            1 => [
                'id' => 2,
                'title' => 'Junya Kubo wins APPT National for ₱2,465,000!',
                'description' => 'What an exciting lineup we saw at the APPT National. A few known pro\'s like Laksh Pal Singh and Daniel Benor and several local heroes like Joseph Sia and Noel Regencia.',
                'body' => '<p>What an exciting lineup we saw at the APPT National. A few known pro&#39;s like Laksh Pal Singh and Daniel Benor and several local heroes like Joseph Sia and Noel Regencia. After a long final table it was however the Japanese lawyer Junya Kubo that surprised everyone and claimed his first Pokerstars Live title. His first title is a big one, APPT National winner ₱2,465,000 ($44,235.39).</p>

<p>The key hand for Kubo must have been the gigantic coinflip against Noel Regencia:</p>

<p>&nbsp;</p>

<p>Kubo raised to 280k and Regencia decided to shove for over 3 million in chips. He got snapcalled by Kubo:</p>

<p>Kubo: <img src="/cards/jd.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/js.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Regencia: <img src="/cards/as.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/qd.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>The flop was disaster for the last Filipino left on the final table: <img src="/cards/2c.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/3c.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/jc.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Regencia in big trouble needing a runner runner to stay alive.</p>

<p>No miracles as the board ran <img src="/cards/6d.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/5d.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Kubo started the heads-up as a 2:1 favorite and the battle lasted over an hour. In hand 38 of the heads-up we saw the deciding hand:</p>

<p>&nbsp;</p>

<p>Benor compleets the big blind 180k and Kubo checks.</p>

<p>Kubo leads 180k on <img src="/cards/3c.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/8c.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/6h.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Benor calls.On the <img src="/cards/7c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;Kubo checks the action to Benor who bets 425k into Kubo.</p>

<p>Kubo clicks it back to Benor making it 825k, Benor calls.</p>

<p>The river <img src="/cards/5d.png" style="height:15px; margin-right:5px; width:25px" />makes Kubo shove, putting Benor all-in.</p>

<p>Benor decided to call with <img src="/cards/7s.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/3s.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;for two pair. Kubo right away stood up raising his hands revealing <img src="/cards/qc.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/4c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;for the queen high flush.</p>

<p>&nbsp;</p>

<p>The final table payouts:</p>

<p>1st:&nbsp;<strong>Junya Kubo</strong>&nbsp;(Japan) - ₱2,465,000<br />
2nd:&nbsp;<strong>Daniel Benor</strong>&nbsp;(Israel) - ₱1,520,000<br />
3rd:&nbsp;<strong>Noel Regencia</strong>&nbsp;(Philippines) - ₱1,100,000<br />
4th:&nbsp;<strong>Laksh Pal Singh</strong>&nbsp;(India) - ₱890,000<br />
5th:&nbsp;<strong>Joseph Sia</strong>&nbsp;(Philippines) - ₱704,000<br />
6th:&nbsp;<strong>Edgar Asehan</strong>&nbsp;(Philippines) - ₱542,000<br />
7th:&nbsp;<strong>Shota Hayama</strong>&nbsp;(Japan) - ₱403,300<br />
8th:&nbsp;<strong>Deepak Borthra</strong>&nbsp;(India) - ₱292,000<br />
9th:&nbsp;<strong>Mai Bien</strong>&nbsp;(Vietnam) - ₱236,085</p>

<p>&nbsp;</p>',
                'image' => null,
                'slug' => 'junya-kubo-wins-appt-national-for-2465000',
                'published_date' => '2022-08-04 06:13:00',
                'article_author_id' => 6,
                'created_at' => '2022-09-18 07:50:05',
                'updated_at' => '2022-09-18 08:12:36',
            ],
            2 => [
                'id' => 3,
                'title' => 'APPT Main Event attracts a total of 801 entries',
                'description' => 'As expected APPT Main Event day 1B would be a big one. With a total of 338 entries and 108 re-entries it was a busy day in  Okada Manila.',
                'body' => '<p>As expected APPT Main Event day 1B would be a big one. With a total of 338 entries and 108 re-entries it was a busy day in&nbsp; Okada Manila. After the closing of the registration the total combined entries would see the amazing number of 801, combining a total prize pool of&nbsp;<strong>₱45,452,745 (~$817,875)</strong>. The winner of this years APPT will take home&nbsp;<strong>₱8,564,000 ($154,822.41) + a PSPC package worth ₱57,000</strong>. The first prize can only go to one player, but 119 players will be assured they will be in the money.</p>

<p>&nbsp;</p>

<p>Many of the known pro&#39;s would be seen in the field at day 1B. Local poker pro&#39;s like Vamerdino Magsakay, Florencio Campomanes, Richard Marquez, Renniel Galvez, Emmanuel Segismundo, Lester Edoc and Eugeno Co would all be seen in action at day 1B. In combination with foreign pro&#39;s like Thijs Hilberts, Abhinav Iyer, Artem Sofronov, Henrik Tollefsen and Nicola Moltabano a very interesting field.</p>

<p>&nbsp;</p>

<p>For 2019 APPT Main Event champion Florencio Campomanes it was a day to forget. He was not able to survive day 1B even after multiple re-entries. Also Richard Marquez was not able to build a stack and make it to day 2, we will for sure see him in one of the side-events this weekend. Where some of the known pro&#39;s were not able to make it, others did. Big names that made day 2 with a top-10 stack are WSOP bracelet winner Abhinav Iyer (395,000), Singaporean poker pro and 3th place finisher in the APPT Kickoff Zhao Feng (318,000) and 2019 APPT Main Event runner-up Thijs Hilberts (308,000).</p>

<p>&nbsp;</p>

<p>The chipleader for day 2 however is for Seungmook Jung of Korea. He is the only player in the field above 400k, bagging a total of 412,000 chips. The Korean has been seated at table 4, a table with several other big stacks. Today day 2 of the APPT Main Event continues at 3pm. To follow all major developments on day 2 of the APPT Main Event we recommend you to see our live reporting blog.</p>

<p>&nbsp;</p>

<p><strong>MAIN EVENT DAY 1B TOP TEN STACKS</strong><br />
1.&nbsp;<strong>Seungmook Jung</strong>&nbsp;(South Korea) - 412,000<br />
2.&nbsp;<strong>Abhinav Iyer</strong>&nbsp;(India) - 395,000<br />
3.&nbsp;<strong>Yong Man Kwon</strong>&nbsp;(South Korea) - 356,500<br />
4.&nbsp;<strong>Zhao Feng</strong>&nbsp;(Singapore) - 318,000<br />
5.&nbsp;<strong>Thijs Hilberts</strong>&nbsp;(Netherlands) - 308,000<br />
6.&nbsp;<strong>Po Wen Fang</strong>&nbsp;(Taiwan) - 296,000<br />
7.&nbsp;<strong>Bonifacio Mondalo</strong>&nbsp;(Philippines) - 295,500<br />
8.&nbsp;<strong>*Aaron Lam Weiming</strong>&nbsp;(Singapore) - 260,500<br />
9.&nbsp;<strong>Matthew Holley</strong>&nbsp;(USA) - 250,500<br />
10.&nbsp;<strong>Artem Sofronov</strong>&nbsp;(Russia) - 248,000</p>

<p>Final table payouts:</p>

<ol>
<li>₱8,564,000</li>
<li>₱5,204,000</li>
<li>₱3,685,000</li>
<li>₱2,780,000</li>
<li>₱2,197,000</li>
<li>₱1,654,000</li>
<li>₱1,184,000</li>
<li>₱827,000</li>
<li>₱658,745</li>
</ol>',
                'image' => null,
                'slug' => 'appt-main-event-attracts-a-total-of-801-entries',
                'published_date' => '2022-08-06 05:00:00',
                'article_author_id' => 6,
                'created_at' => '2022-09-18 07:55:09',
                'updated_at' => '2022-09-18 08:12:32',
            ],
            3 => [
                'id' => 4,
                'title' => 'Seina Asagiri leads last 21 players into final day of the APPT Main Event',
                'description' => 'A long day for the day 2 survivors of the APPT Main Event in Okada Manila yesterday.',
                'body' => '<p>A long day for the day 2 survivors of the APPT Main Event in Okada Manila yesterday. The day started at 3pm with 188 players, 119 of them would make the money. We saw many big names still in the field like Vamerdino Magsakay, Mike Takayama, Thijs Hilberts, Thomas Ward, Martijn Gerrits, Zhao Feng and John Tech. Many of the big names would fall after a day of almost 12 hours of poker. The tournament organization in the end had to stop play at the final 21 players.</p>

<p>&nbsp;</p>

<p>After the money&nbsp; was reached we saw many local favorites bust out. Local favorites like APT winner Renniel Galvez busted in 112th (₱102,000), Mike Takayama of Nuebe Gaming busted in 71th (₱138,000) and John &quot;JoJo&quot; Tech in 43th (₱158,000). While big names were falling rapidly a few other big names would build big stacks during the day.</p>

<p>&nbsp;</p>

<p>The 2019 APPT Manila main event runner-up Thijs Hilberts of the Netherlands was building a huge stack early on and kept the momentum till the end of the day. He finished the day second in chips with 2,500,000. The other big name who is having an amazing APPT Manila so far is Singaporean pro Zhao Feng. He made 3th place in the APPT Kickoff and with a chip stack of 2,070,000 he is in third place overall.</p>

<p>&nbsp;</p>

<p>The overall chip lead however is in hands of the only woman left in the field, Seina Asagiri from Japan. In the last levels of the day she got an amazing run with four times pocket aces within an hour. All four times receiving action launching her stack well over 2,5 million chips. She finished the day in the chip lead with 2,660,000.</p>

<p>&nbsp;</p>

<p>All 21 players left are assured of ₱286,000. Play will resume today again at 3pm. The seat draw at the start of today:</p>

<p>Table 6:</p>

<p>Seat 1 - Ferdinand Lu - 680,000</p>

<p>Seat 3 - Xin Hua Lai - 1,560,000</p>

<p>Seat 4 - Kim Michael Enriquez - 700,000</p>

<p>Seat 5 - Jingxiang Ong - 540,000</p>

<p>Seat 6 - Renjie Ye - 920,000</p>

<p>Seat 7 - Jason Magbanua - 1,405,000</p>

<p>Seat 8 - Woosok Hong - 760,000</p>

<p>&nbsp;</p>

<p>Table 8:<br />
Seat 1 - Zhao Feng - 2,070,000</p>

<p>Seat 2 - Po Wen Fang - 1,359,000</p>

<p>Seat 3 - Dongin Jung - 1,050,000</p>

<p>Seat 4 - Dhanesh Chainani - 1,150,000</p>

<p>Seat 5 - William Ysmael - 1,255,000</p>

<p>Seat 6 - Seina Asagiri - 2,660,000</p>

<p>Seat 8 - Liow Meng Kee - 830,000</p>

<p>&nbsp;</p>

<p>Table 10:</p>

<p>Seat 2 - Wonchul Bae - 720,000</p>

<p>Seat 3 - Ashish Monet - 810,000</p>

<p>Seat 4 - George Salud - 145,000</p>

<p>Seat 5 - Thijs Hilberts - 2,500,000</p>

<p>Seat 6 - Matthew Holley - 450,000</p>

<p>Seat 7 - John Howard - 1,935,000</p>

<p>Seat 8 - Yukishige Doi - 290,000</p>',
                'image' => null,
                'slug' => 'seina-asagiri-leads-last-21-players-into-final-day-of-the-appt-main-event',
                'published_date' => '2022-08-07 17:49:00',
                'article_author_id' => 6,
                'created_at' => '2022-09-18 07:57:22',
                'updated_at' => '2022-09-18 08:12:28',
            ],
            4 => [
                'id' => 5,
                'title' => 'Xin Hua Lai wins the APPT Main Event for ₱5,973,000',
                'description' => 'The APPT Manila has come to an end. With an amazing 801 entries the APPT main event was a huge success.',
                'body' => '<p>The APPT Manila has come to an end. With an amazing 801 entries the APPT main event was a huge success. On Sunday 21 players came back, and for&nbsp;<strong>Xin Hua Lai</strong>&nbsp;it was a day to never forget. He crowned himself the new APPT Manila champion after a 3-way deal. The Singaporean took home ₱5,973,000 + PSPC ticket worth ₱57,000.</p>

<p>&nbsp;</p>

<p>The day started with 21 left and within the hour we would be down to 12 players. For Lai the day started amazing after a gigantic pot against John Howard of the UK:</p>

<p>&nbsp;</p>

<p>John Howard opens UTG to 70k and gets called by Lai in the BB.</p>

<p>Flop comes <img src="/cards/7c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/ac.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/ah.png" style="height:15px; margin-right:5px; width:25px" />.</p>

<p>Lai check and Howard bets 150k. Lai comes over the top making it 400k, Howard calls.</p>

<p>Turn is <img src="/cards/qs.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;and Lai now leads into Howard. After some seconds Howard pushes all-in, Lai snap calls.</p>

<p>Howard: <img src="/cards/ad.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/7d.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Lai: <img src="/cards/as.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/qd.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>The river is <img src="/cards/2d.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;leaving Howard short, Lai to the new chip leader with over 4 million chips.</p>

<p>&nbsp;</p>

<p>This big hand made sure Lai went to the final table as the chip leader. Other notable names on the final table were 2019 APPT Manila main event runner-up&nbsp;<strong>Thijs Hilberts</strong>, Singaporean pro&#39;s&nbsp;<strong>Zhao Feng</strong>&nbsp;and&nbsp;<strong>Dhanesh Chainani&nbsp;</strong>and the last woman standing&nbsp;<strong>Seina Asagiri</strong>.</p>

<p>&nbsp;</p>

<p>The players came to play, so we witnessed a spectacular final table, with sadly for the Filipino railers early bust outs for the last two Filipino&#39;s in the field (9th&nbsp;<strong>Jason Magbanua&nbsp;</strong>₱658,745 and 7th&nbsp;<strong>Kim Michael Enriquez</strong>&nbsp;₱1,184,000). The final table really would come alive after the bust out of&nbsp;<strong>Wonchul Bae&nbsp;</strong>of South Korea in 6th.</p>

<p>&nbsp;</p>

<p>Every player on the final table saw massive swings, from huge chip leader to the short stack. In the end a horrible bad beat ended the tournament of the friendly&nbsp;<strong>Seina Asagiri&nbsp;</strong>in 5th for ₱2,197,000. She got it all-in preflop as a huge favorite against Lai:</p>

<p>&nbsp;</p>

<p>After a raise from Lai, Asagiri shoved all-in. The action gets folded back to Lai who makes the call with <img src="/cards/qc.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/qd.png" style="height:15px; margin-right:5px; width:25px" />. He sees right away he is in trouble as Asagiri shows him <img src="/cards/ac.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/ad.png" style="height:15px; margin-right:5px; width:25px" />.</p>

<p>The flop however means heartbreak for the last woman standing <img src="/cards/qs.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/8c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/6d.png" style="height:15px; margin-right:5px; width:25px" />. Lai spikes a queen putting Asagiri in despair. Lai fades the turn and river ace, busting Asagiri and going into a commanding chip lead.</p>

<p>&nbsp;</p>

<p>His chip lead would be lost however not shortly after due to the preflop and post flop aggression of Dutch pro Thijs Hilberts. The Dutchmen was the most aggressive player this entire final table and with the pressure building up he was the one taking most control. With the bust out of&nbsp;<strong>Zhao Feng&nbsp;</strong>in 4th for ₱2,780,000, we were down to three players.</p>

<p>&nbsp;</p>

<p>Hilberts and Chainani both were really short at sometime, but both fought back and doubled up on several occassions. In the end the three decided to make a deal. They use ICM numbers and left ₱900,000 in the middle for the winner. A heads-up however would never take place cause in a 3-way all-in situation the biggest stack Lai would decide the tournament:</p>

<p>&nbsp;</p>

<p>All the chips would go in preflop as Hilberts and Chainani were both around 10 big blinds.</p>

<p>Lai: <img src="/cards/7h.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/7d.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Hilberts: <img src="/cards/kh.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/10d.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Chainani: <img src="/cards/qs.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/js.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>The flop made Lai explode in celebration: <img src="/cards/7s.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/8c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/2h.png" style="height:15px; margin-right:5px; width:25px" />.</p>

<p>On the turn Hilberts and Chainani get outs with the <img src="/cards/6s.png" style="height:15px; margin-right:5px; width:25px" />.</p>

<p>The river is the <img src="/cards/8s.png" style="height:15px; margin-right:5px; width:25px" />, at first Lai thinks he loses as Chainani makes his flush. After 5 seconds he realizes it&#39;s a paired board, bursting into celebration with his loyal railers.</p>

<p>&nbsp;</p>

<p><strong>MAIN EVENT FINAL TABLE RESULTS</strong><br />
1st:&nbsp;<strong>Xin Hua Lai</strong>&nbsp;(Singapore) - ₱5,973,000<br />
2nd:&nbsp;<strong>Thijs Hilberts</strong>&nbsp;(Netherlands) - ₱6,071,000<br />
3rd:&nbsp;<strong>Dhanesh Chainani</strong>&nbsp;(Singapore) - ₱5,409,000<br />
4th:&nbsp;<strong>Zhao Feng</strong>&nbsp;(Singapore) - ₱2,780,000<br />
5th:&nbsp;<strong>Seina Asagiri</strong>&nbsp;(Japan) - ₱2,197,000<br />
6th:&nbsp;<strong>Wonchul Bae</strong>&nbsp;(South Korea) - ₱1,654,000<br />
7th:&nbsp;<strong>Kim Michael Enriquez</strong>&nbsp;(Philippines) - ₱1,184,000<br />
8th:&nbsp;<strong>Woosok Hong</strong>&nbsp;(South Korea) - ₱827,000<br />
9th:&nbsp;<strong>Jason Magbanua</strong>&nbsp;(Philippines) - ₱658,745</p>

<p>&nbsp;</p>

<p>It has been an amazing ten days in Okada Manila at the APPT Manila for many players and for the Life of Poker team. We hope to see you all back again in September in Okada Manila for the Road to PSPC tournament series from 19-25 September. The schedule is not yet available but the main event is set at ₱22,000.</p>',
                'image' => null,
                'slug' => 'xin-hua-lai-wins-the-appt-main-event-for-5973000',
                'published_date' => '2022-08-08 21:06:00',
                'article_author_id' => 6,
                'created_at' => '2022-09-18 08:02:56',
                'updated_at' => '2022-09-18 08:12:24',
            ],
        ]);
    }
}
