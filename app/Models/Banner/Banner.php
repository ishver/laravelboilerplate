<?php

namespace App\Models\Banner;

use Illuminate\Database\Eloquent\Model;
use App\Models\Banner\Traits\Scope\Scope;
use App\Models\Banner\Traits\Attribute\Attribute;
use App\Models\Banner\Traits\Relationship\Relationship;

/**
 * Class Role.
 */
class Banner extends Model
{
    use Scope,
        Attribute,
        Relationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'all', 'sort'];

   
}
