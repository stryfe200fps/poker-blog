<?php

namespace App;

trait PageTemplates
{
    // private function services()
    // {
    //     $this->crud->addField([   // CustomHTML
    //         'name' => 'metas_separator',
    //         'type' => 'custom_html',
    //         'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
    //     ]);
    //     $this->crud->addField([
    //         'name' => 'meta_title',
    //         'label' => trans('backpack::pagemanager.meta_title'),
    //         'fake' => true,
    //         'store_in' => 'extras',
    //     ]);
    //     $this->crud->addField([
    //         'name' => 'meta_description',
    //         'label' => trans('backpack::pagemanager.meta_description'),
    //         'fake' => true,
    //         'store_in' => 'extras',
    //     ]);
    //     $this->crud->addField([
    //         'name' => 'meta_keywords',
    //         'type' => 'ckeditor',
    //         'label' => trans('backpack::pagemanager.meta_keywords'),
    //         'fake' => true,
    //         'store_in' => 'extras',
    //     ]);
    //     $this->crud->addField([   // CustomHTML
    //         'name' => 'content_separator',
    //         'type' => 'custom_html',
    //         'value' => '<br><h2>'.trans('backpack::pagemanager.content').'</h2><hr>',
    //     ]);
    //     $this->crud->addField([
    //         'name' => 'content',
    //         'label' => trans('backpack::pagemanager.content'),
    //         'type' => 'ckeditor',
    //         'placeholder' => trans('backpack::pagemanager.content_placeholder'),
    //     ]);
    // }

    private function Default()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
        ]);
    }

    private function contact()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
        ]);
    }

    private function rooms()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
        ]);
    }

    private function videos()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'extra_plugins' => ['widget', 'autocomplete', 'textmatch', 'toolbar', 'wysiwygarea', 'image', 'sourcearea'],
        ]);
    }

}
