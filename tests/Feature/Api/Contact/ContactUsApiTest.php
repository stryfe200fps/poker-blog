<?php

test('contact us validation works', function () {

  $this->json('POST', 'api/contact')
  ->assertJsonValidationErrors(['email', 'name', 'message']);

});

test('contact us inserts something', function () {

  $contact = $this->json('POST', 'api/contact', [
    'email' => 'kamlonboy@yhoo.com',
    'name' => 'Adrian',
    'message' => 'Adi radn',
    'subject' => 'Subject'
  ])->assertJsonFragment([
    'status' => 200
  ]);

  $this->assertDatabaseHas('contact_forms', ['email' => 'kamlonboy@yhoo.com',
        'name' => 'Adrian',
        'message' => 'Adi radn',
    ]);
});




