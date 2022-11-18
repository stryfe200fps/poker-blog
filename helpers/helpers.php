<?php

use App\Models\Glossary;

function translations($json)
{
    if (! file_exists($json)) {
        return [];
    }

    return json_decode(file_get_contents($json), true);
}



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

        }
        return $item;
    });


    if (!is_array($content)) {
        return $content;
    }  

    return $content[0];
}

function articleContentFormatter($content)
{
    if (! is_array($content) ) {
        $content->body = '<div class="content" id="content0">'.$content->body.'</div>';
        return $content;
    }

    $new = collect($content)->map(function ($item, $key) {
        $item->body = '<div class="content" id="content'.$key.'">'.$item->body.'</div>';
        return $item;
    });

    return $new;
}

function customHeading($link,  $title, $other)
{
    Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade::setHeading("<a href='/admin/$link'>«</a> $title : $other");
}

function tableReplacement($content)
{
    $pattern = '/(<table[^>]*>(?:.|\n)*<\/table>)/';
    $replacement = '<div class="forum-table">${1}</div>';
    return preg_replace($pattern, $replacement, $content);
}

function imageResponsiveReplacement($content)
{
    $pattern = '/(<img) alt=""/'; 
    $replacement = '<img class="img-responsive" ';
    return preg_replace($pattern, $replacement, $content);
}


function checkUrlCode($url)
{

$code = FALSE;
$options['http'] = array(
    'method' => "HEAD",
    'ignore_errors' => 1,
    'max_redirects' => 0
);

$body = file_get_contents($url, null , stream_context_create($options));

sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $code);

return $code;
}

