<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait LimitUserPermissions
{

  protected function denyAccessIfNoPermission() {

    $user = backpack_user();

    if ($user->hasRole('super-admin')) 
      return;

    $entityName = $this->crud->entity_name;
        
    if (!$user->can($entityName.'.list')) {
        $this->crud->denyAccess('list');
    }

    if (!$user->can($entityName.'.update')) {
        $this->crud->denyAccess('update');
    }

    if (!$user->can($entityName.'.create')) {
        $this->crud->denyAccess('create');
    }

    if (!$user->can($entityName.'.delete')) {
        $this->crud->denyAccess('delete');
    }


  }
   
}