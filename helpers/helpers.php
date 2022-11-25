<?php

use App\Models\Glossary;

function translations($json)
{
<<<<<<< HEAD
    if (!file_exists($json)) {
=======
    if (! file_exists($json)) {
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        return [];
    }

    return json_decode(file_get_contents($json), true);
}

<<<<<<< HEAD
function googleTranslateExclude($content)
{
    $content = collect($content)->map(function ($item) {
        if (is_countable($item)) {
            $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) {
                $pattern = '/' . $word . '/i';
                $item['body'] = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item['body']);
                $item['body'] = tableReplacement($item['body']);
                $item['body'] = imageResponsiveReplacement($item['body']);
                $item['title'] = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item['title']);
            }
        } else {
            $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) {
                $pattern = '/' . $word . '/i';
                $item = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item);
                $item = tableReplacement($item);
                $item = imageResponsiveReplacement($item);
            }
=======


function googleTranslateExclude($content) { 
   $content = collect($content)->map(function ($item) {

        if (is_countable($item)) {
            $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) { 
            $pattern = '/'.$word.'/i';
            $item['body'] = preg_replace($pattern, '<span translate="no">'.$word.'</span>' , $item['body']);
            $item['body'] = tableReplacement ($item['body']);
            $item['body'] = imageResponsiveReplacement ($item['body']);
            $item['title'] = preg_replace($pattern, '<span translate="no">'.$word.'</span>' , $item['title']);
            }
        } else {
           $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) { 
            $pattern = '/'.$word.'/i';
            $item = preg_replace($pattern, '<span translate="no">'.$word.'</span>' , $item);
            $item = tableReplacement ($item);
            $item = imageResponsiveReplacement ($item);
            }

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        }
        return $item;
    });


    if (!is_array($content)) {
        return $content;
<<<<<<< HEAD
    }
=======
    }  
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

    return $content[0];
}

function articleContentFormatter($content)
{
<<<<<<< HEAD
    if (!is_array($content)) {
        $content->body = '<div class="content" id="content0">' . $content->body . '</div>';
=======
    if (! is_array($content) ) {
        $content->body = '<div class="content" id="content0">'.$content->body.'</div>';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        return $content;
    }

    $new = collect($content)->map(function ($item, $key) {
<<<<<<< HEAD
        $item->body = '<div class="content" id="content' . $key . '">' . $item->body . '</div>';
=======
        $item->body = '<div class="content" id="content'.$key.'">'.$item->body.'</div>';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        return $item;
    });

    return $new;
}

<<<<<<< HEAD
function customHeading($link, $title, $other)
=======
function customHeading($link,  $title, $other)
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
{
    Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade::setHeading("<a href='/admin/$link'>«</a> $title : $other");
}

function tableReplacement($content)
{
    $pattern = '/(<table[^>]*>(?:.|\n)*<\/table>)/';
    $replacement = '<div class="forum-table">${1}</div>';
    return preg_replace($pattern, $replacement, $content);
}
<<<<<<< HEAD

function imageResponsiveReplacement($content)
{
    $pattern = '/(<img) (!src="\/cards\/\w+.\w+"|alt=(["\'])(?:(?=(\\?))\2.)*?|alt="") /';
    $replacement = '<img class="img-responsive ckeditor-img" loading="lazy" ';
    return preg_replace($pattern, $replacement, $content);
}

function checkUrlCode($url)
{
    $code = false;
    $options['http'] = array(
        'method' => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0
    );

    $body = file_get_contents($url, null, stream_context_create($options));

    sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $code);

    return $code;
}
=======
function imageResponsiveReplacement($content)
{
    $pattern = '/(<img)/'; 
    $replacement = '<img class="img-responsive" ';
    return preg_replace($pattern, $replacement, $content);
}
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
