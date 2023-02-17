<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder;

class OfferScope implements Scope {

    public function apply(\Illuminate\Database\Eloquent\Builder $builder, Model $model)
    {

        $builder->where('status',0);
    }


}

