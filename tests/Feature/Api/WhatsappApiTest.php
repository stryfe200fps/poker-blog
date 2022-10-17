<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Player;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\ArticleAuthor;
use App\Models\ImageTheme;

test('whatsapp api', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $event = Event::factory()->create([
        'id' => 1,
        'slug' => 'final-event'
    ]);
    $page = $this->get('admin/report/create?event='.$event->id)->assertStatus(200);

    $eventChip = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 1,
        'event_id' => $event->id
    ]);

    $eventChip2 = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 0,
        'event_id' => $event->id
    ]);

    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
     
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added' => Carbon::now()->addHours(3),
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
    ];
    
    $this->post('/admin/report', $data);

    $response = $this->get('api/lof-event-index/'.$event->slug.'/whatsapp');
    $response->assertStatus(200);

    //check if whatsapp is true
    $response->assertJsonPath(
           'data.event_chips.0.is_whatsapp', 1 
    );




});
