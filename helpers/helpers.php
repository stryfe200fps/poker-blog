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
            $item['title'] = preg_replace($pattern, '<span translate="no">'.$word.'</span>' , $item['title']);
            }

        } else {

           $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) { 
            $pattern = '/'.$word.'/i';
            $item = preg_replace($pattern, '<span translate="no">'.$word.'</span>' , $item);
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
