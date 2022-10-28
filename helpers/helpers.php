<?php

use App\Models\Glossary;

function translations($json)
{
    if (! file_exists($json)) {
        return [];
    }

    return json_decode(file_get_contents($json), true);
}

function adi()
{
    dd('adi');
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

    return $content[0];
}