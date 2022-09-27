<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LiveReportsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('live_reports')->delete();

        \DB::table('live_reports')->insert([
            0 => [
                'id' => 5,
                'title' => 'Niroshan Loganathan leads APPT Kickoff Day 1A field',
                'content' => '<p>There was a real excitement in the poker room of Okada Manila yesterday. After an absence of 3 years the APPT is back! Yes we saw a smaller amazing version of the APPT already earlier this year, but now the big one is finally here.</p>

<p>&nbsp;</p>

<p>The first tournament on the schedule is the APPT Kickoff. A tournament with a buy-in of ₱20,000 (around $400) and an guarantee of ₱3,000,000. Day 1A started at 1pm and the action was fierce from the start. Several familiar faces showed up like bracelet winner Mike Takayama, former APPT main event winners Florencio Campomanes and Henrik Tollefsen and Canadian pro Niroshan Loganathan.</p>

<p>&nbsp;</p>

<p>In total 176 players bought into day 1A already crushing the guarantee of ₱3,000,000. At 27 players the day would come to a close, and players that would remain automatically would be in the money. Known players like Florencio Campomanes, Thijs Hilberts and Christopher Mateo would bust out before the end of the day.</p>

<p>&nbsp;</p>

<p>In a huge pot for the massive chiplead Norwegian poker pro Henrik Tollefsen would be left with around 30 big blinds. Canadian Niroshan Loganathan however was on the rise and with several huge pots near the closing of the day he would take a huge chiplead. The bubble took more then an hour, but in the end it was Tollefsen that would be the last bust out of the day. All other players are guaranteed a spot in the money.</p>

<p>&nbsp;</p>

<p>Known players that would survive day 1A are: chipleader Niroshan Loganathan, Joris Michl, Mike Takayama, Artem Sofronov, Sandro Bruni, Joven Huerto and John Dela Cruz. Today the APPT continues with at 1pm day 1B of the Kickoff. For all players that didn&#39;t make it in the first 2 flights there is a day 1C a turbo of the Kickoff that starts at 7pm. Full list of players that survived day 1A:</p>

<p>&nbsp;</p>

<table>
<tbody>
<tr>
<th>Player Name</th>
<th>Country</th>
<th>Chipcounts</th>
</tr>
<tr>
<td>1. Niroshan Loganathan</td>
<td>Canada</td>
<td>597,000</td>
</tr>
<tr>
<td>2. Kim Michael Enriquez</td>
<td>Philippines</td>
<td>494,000</td>
</tr>
<tr>
<td>3. James Mendoza</td>
<td>Philippines</td>
<td>396,000</td>
</tr>
<tr>
<td>4. Joris Michl</td>
<td>Netherlands</td>
<td>326,000</td>
</tr>
<tr>
<td>5. Jisang Jang</td>
<td>Japan</td>
<td>312,000</td>
</tr>
<tr>
<td>6. Mike Takayama</td>
<td>Philippines</td>
<td>299,000</td>
</tr>
<tr>
<td>7. Noel Araniel</td>
<td>Philippines</td>
<td>284,000</td>
</tr>
<tr>
<td>8. Jong Chan Park</td>
<td>South Korea</td>
<td>276,000</td>
</tr>
<tr>
<td>9. Artem Sofronov</td>
<td>Russia</td>
<td>271,000</td>
</tr>
<tr>
<td>10. Lung Wai Tang</td>
<td>Hong Kong</td>
<td>264,000</td>
</tr>
<tr>
<td>11. Sandro Bruni</td>
<td>Italy</td>
<td>225,000</td>
</tr>
<tr>
<td>12. Jonghoon Bae</td>
<td>South Korea</td>
<td>180,000</td>
</tr>
<tr>
<td>13. Joven Huerto</td>
<td>Philippines</td>
<td>158,000</td>
</tr>
<tr>
<td>14. Jose Padilla</td>
<td>Philippines</td>
<td>155,000</td>
</tr>
<tr>
<td>15. Harold Neal Ruaya</td>
<td>Philippines</td>
<td>150,000</td>
</tr>
<tr>
<td>16. Jason Magbanua</td>
<td>Philippines</td>
<td>139,000</td>
</tr>
<tr>
<td>17. Ivan Tabucal</td>
<td>Philippines</td>
<td>129,000</td>
</tr>
<tr>
<td>18. Jose Drilon</td>
<td>Philippines</td>
<td>92,000</td>
</tr>
<tr>
<td>19. Ronald Gorgonia</td>
<td>Philippines</td>
<td>90,000</td>
</tr>
<tr>
<td>20. John Carlo Sayo</td>
<td>Philippines</td>
<td>90,000</td>
</tr>
<tr>
<td>21. Jannodin Riga</td>
<td>Philippines</td>
<td>78,000</td>
</tr>
<tr>
<td>22. Marco Almerez</td>
<td>Philippines</td>
<td>56,000</td>
</tr>
<tr>
<td>23. Joseroy Jeremias Jr.</td>
<td>Philippines</td>
<td>56,000</td>
</tr>
<tr>
<td>24. Quentin de Rozieres</td>
<td>France</td>
<td>51,000</td>
</tr>
<tr>
<td>25. John dela Cruz</td>
<td>Philippines</td>
<td>45,000</td>
</tr>
<tr>
<td>26. Juichiro Hashimoto</td>
<td>Japan</td>
<td>37,000</td>
</tr>
<tr>
<td>27. Ruben Clamares</td>
<td>Philippines</td>
<td>23,000</td>
</tr>
</tbody>
</table>',
                'day' => '1A',
                'level_id' => '6',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-29 09:20:00',
                'players' => '[]',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:23:53',
                'updated_at' => '2022-09-18 09:25:51',
                'image' => null,
            ],
            1 => [
                'id' => 6,
                'title' => 'Cards are in the air',
                'content' => '<p>After a short delay the APPT Kickoff Day 1B has started! An exciting day with tons of action. We expect to break over 200 players today in 1B.</p>',
                'day' => '1B',
                'level_id' => '1',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-09-18 09:32:55',
                'players' => 'null',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:33:41',
                'updated_at' => '2022-09-18 09:40:08',
                'image' => null,
            ],
            2 => [
                'id' => 7,
                'title' => 'Thijs Hilberts entered from the start',
                'content' => '<h3>Thijs Hilberts entered from the start</h3>',
                'day' => '1B',
                'level_id' => '1',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 09:33:00',
                'players' => '[]',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:35:28',
                'updated_at' => '2022-09-18 09:37:58',
                'image' => null,
            ],
            3 => [
                'id' => 8,
                'title' => 'Alexis Lim',
                'content' => '<p>Alexis Lim also joined the action he is located at table 5. Can the Team Metro Pro go deep again?</p>',
                'day' => '1B',
                'level_id' => '1',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 09:35:00',
                'players' => '[]',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:36:10',
                'updated_at' => '2022-09-18 09:37:18',
                'image' => null,
            ],
            4 => [
                'id' => 9,
                'title' => 'Early chiplead on table 8',
                'content' => '<p>The early chiplead can be found at table 8.</p>

<p>At this table we also find Hazel Timonera. She was able to bust a player and is sitting at over 40,000 already.</p>',
                'day' => '1B',
                'level_id' => '8',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 09:43:00',
                'players' => '""',
                'image_caption' => 'Hazel Timonera',
                'image_theme' => 'flame',
                'user_id' => 1,
                'created_at' => '2022-09-18 09:50:24',
                'updated_at' => '2022-09-18 09:50:24',
                'image' => null,
            ],
            5 => [
                'id' => 10,
                'title' => 'Jhun Mondalo fires another bullet in the APPT Kickoff NLH.',
                'content' => '<p>Jhun Mondalo enters Day 1B of the APPT kickoff once again after busting day 1A yesterday. He&#39;s expected to play most of the major tournaments of the APPT Manila</p>',
                'day' => '1B',
                'level_id' => '8',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 09:51:00',
                'players' => '""',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:53:41',
                'updated_at' => '2022-09-18 09:53:41',
                'image' => null,
            ],
            6 => [
                'id' => 11,
                'title' => 'Blinds are up',
                'content' => '<p>Blinds are up with 100 players. Registration is still open with one single re-entry allowed.</p>',
                'day' => '1B',
                'level_id' => '9',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-09-18 09:53:43',
                'players' => '""',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:54:34',
                'updated_at' => '2022-09-18 09:54:34',
                'image' => null,
            ],
            7 => [
                'id' => 12,
                'title' => 'Several Chipstacks at the break',
                'content' => '<h3>Several Chipstacks at the break</h3>',
                'day' => '1B',
                'level_id' => '10',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 09:54:00',
                'players' => '[]',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 09:58:16',
                'updated_at' => '2022-09-18 10:04:07',
                'image' => null,
            ],
            8 => [
                'id' => 13,
                'title' => 'Vamerdino Magsakay the latest APT Main Event winner joins the action',
                'content' => '<p>Vamerdino Magsakay has joined the action.</p>

<p>He won 2 weeks ago the APT Main event in Vietnam for almost $85,000. Can this APPT be another success story for Magsakay?</p>',
                'day' => '1B',
                'level_id' => '9',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 10:18:00',
                'players' => '""',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 10:19:07',
                'updated_at' => '2022-09-18 10:19:07',
                'image' => null,
            ],
            9 => [
                'id' => 14,
                'title' => 'Level 6, 127 players remain',
                'content' => '<p>The blinds are now 400/800 with an 800 ante.</p>

<p>So far 161 players registered and 127 are left.</p>',
                'day' => '1B',
                'level_id' => '11',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 10:19:00',
                'players' => '""',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 10:19:35',
                'updated_at' => '2022-09-18 10:19:35',
                'image' => null,
            ],
            10 => [
                'id' => 15,
                'title' => 'Richard Marquez on 50,000',
                'content' => '<h3>Richard Marquez is in the house and already made an impact. He almost doubled his begin stack already and is on a decent stack.</h3>',
                'day' => '1B',
                'level_id' => '11',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 10:19:00',
                'players' => '""',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 10:20:21',
                'updated_at' => '2022-09-18 10:20:21',
                'image' => null,
            ],
            11 => [
                'id' => 16,
                'title' => 'Vamerdino Magsakay of Team Metro Pro has to re-enter',
                'content' => '<p>The middle position opens and the cutoff calls, Vam in the BTN reraise to 6,500.MP folds and CO calls leaving Vam with 10,100 chips.</p>

<p>Flop came <img src="/cards/qd.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/js.png" style="height:15px; margin-right:5px; width:25px" /><img src="/cards/ad.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>BTN bets enough for Vam to go all-in and Vam called with <img src="/cards/kh.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/kd.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;against <img src="/cards/7c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/as.png" style="height:15px; margin-right:5px; width:25px" /></p>

<p>Turn and River <img src="/cards/jc.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;<img src="/cards/2c.png" style="height:15px; margin-right:5px; width:25px" />&nbsp;doesn&#39;t help Magsakay.</p>

<p>Magsakay re-entered and is sitting at the same table as Joseph Talamayan.</p>',
                'day' => '1B',
                'level_id' => '11',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 10:20:00',
                'players' => '""',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 10:21:48',
                'updated_at' => '2022-09-18 10:21:48',
                'image' => null,
            ],
            12 => [
                'id' => 17,
                'title' => 'Campomanes ready to rumble',
                'content' => '<p>Florencio Campomanes has joined the action and is on a solid stack of around 60,000.</p>',
                'day' => '1B',
                'level_id' => '12',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 10:21:00',
                'players' => '[{"rank":"1","player_id":"41","current_chips":"60000","payout":"0"}]',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 10:23:12',
                'updated_at' => '2022-09-18 10:23:12',
                'image' => null,
            ],
            13 => [
                'id' => 18,
                'title' => 'Chipcounts at the break',
                'content' => '<p>The players are going on a 10 minute break.</p>

<p>Total entrees are on 220 with 126 players remaining.</p>

<p>We noted down several known players and their chip stacks:</p>',
                'day' => '1B',
                'level_id' => '13',
                'poker_event_id' => 6,
                'article_author_id' => 6,
                'date_added' => '2022-07-30 10:23:00',
                'players' => '[{"rank":"1","player_id":"42","current_chips":"165000","payout":"0"},{"rank":"2","player_id":"41","current_chips":"85000","payout":"0"},{"rank":"3","player_id":"37","current_chips":"125000","payout":"0"},{"rank":"4","player_id":"43","current_chips":"55000","payout":"0"},{"rank":"5","player_id":"35","current_chips":"45000","payout":"0"},{"rank":"6","player_id":"40","current_chips":"50000","payout":"0"},{"rank":"7","player_id":"38","current_chips":"57000","payout":"0"}]',
                'image_caption' => null,
                'image_theme' => null,
                'user_id' => 1,
                'created_at' => '2022-09-18 10:26:09',
                'updated_at' => '2022-09-18 10:26:09',
                'image' => null,
            ],
        ]);
    }
}
