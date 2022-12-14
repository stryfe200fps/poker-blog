<?php

use App\Models\Glossary;

function translations($json)
{
    if (!file_exists($json)) {
        return [];
    }

    return json_decode(file_get_contents($json), true);
}

function googleTranslateExclude($content)
{
    articleContentFormatter($content);

    $content = collect($content)->map(function ($item) use ($content) {
        if (is_countable($item)) {
            $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) {
                $pattern = '/' . $word . '/i';
                $item['body'] = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item['body']);
             
                $item['title'] = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item['title']);
            }
            $item['body'] = tableReplacement($item['body']);
            $item['body'] = imageResponsiveReplacement($item['body']);
        } 
        else if (gettype($item) === 'object') { 
                $item = (array)$item;
                  $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) {
                $pattern = '/' . $word . '/i';
                $item['body'] = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item['body']);
             
                $item['title'] = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item['title']);
            }

            // dd($content);
            $item['body'] = tableReplacement($item['body']);
            $item['body'] = imageResponsiveReplacement($item['body']);
            return $item;

            }
        else {

      

            $glossary = Glossary::all()->pluck('word')->toArray();
            foreach ($glossary as $word) {
                $pattern = '/' . $word . '/i';
                $item = preg_replace($pattern, '<span translate="no">' . $word . '</span>', $item);
       
            }
            $item = tableReplacement($item);
            $item = imageResponsiveReplacement($item);

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
    if (gettype($content) === 'object'  ) {
        $content->body = '<div class="content" id="main_content">' . $content->body . '</div>';
        return $content;
    }

    if (gettype($content) === 'array') { 
    $new = collect($content)->map(function ($item, $key) {
        $item->body = '<div class="content" id="content' . $key . '">' . $item->body . '</div>';
        return $item;
    });
    return $new;
    }

    if (gettype($content) === 'string') {
            return '';
    }

    return '';
}

function customHeading($link, $title, $other)
{
    Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade::setHeading("<a href='/admin/$link'>??</a> $title : $other");
}

function tableReplacement($content)
{
    $pattern = '/(<table[^>]*>)/';
    $replacement = '<div class="forum-table">$1';
    $table = preg_replace($pattern, $replacement, $content);
    return preg_replace('/<\/table>/', '</table></div>', $table);
}

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