<?php

use App\Models\Article;



it('it accepts milions of text in content', function () {

    $length = 1000000;

$article = Article::factory([
    'title' => 'testcount',
    'content' => [
    [
        'title' => 'title',
        'body' => generateString($length)
    ]
]
])->create() ;

expect($length)->toBe(strlen($article->firstContent->body));
$this->assertDatabaseHas('articles', [
    'title' => 'testcount',
]);

});
