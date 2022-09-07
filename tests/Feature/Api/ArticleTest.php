<?php

test('article is working', function () {
    $response = $this->get('api/article');
    $response->assertStatus(200);
});
