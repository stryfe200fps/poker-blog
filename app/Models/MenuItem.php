<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use CrudTrait;

    protected $table = 'menu_items';

    protected $fillable = ['name', 'type', 'link', 'page_id', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    

    /**
     * Get all menu items, in a hierarchical collection.
     * Only supports 2 levels of indentation.
     */
    public static function getTree()
    {
        $menu = self::orderBy('lft')->get();

        if ($menu->count()) {
            // dd($menu);
            foreach ($menu as $k => $menu_item) {
                $menu_item->children = collect([]);
                $menu_item->page_slug = $menu_item->page()->select('slug')->first()?->slug ;

                // $menu_item->link = $menu_item->link . '/' . $menu_subitem->link;

                foreach ($menu as $i => $menu_subitem) {
                    
                    if ($menu_subitem->parent_id == $menu_item->id) {


                        $menu_subitem->page_slug = $menu_subitem->page()->select('slug')->first()?->slug;



                        // if ( $menu_item->link  ===  $menu_subitem->link) { 
                        //     $menu_subitem->link = $menu_item->link;
                        // } else {

                        //     $menu_subitem->link =  $menu_item->link . '/' . $menu_subitem->link;
                        // }



                        $menu_item->children->push($menu_subitem);

                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }

        return $menu;
    }

    public function url()
    {
        switch ($this->type) {
            case 'external_link':
                return $this->link;

            case 'internal_link':
                return is_null($this->link) ? '#' : url($this->link);

            default: //page_link
                if ($this->page) {
                    return url($this->page->slug);
                }
                break;
        }
    }
}
