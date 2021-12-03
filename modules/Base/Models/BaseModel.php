<?php

namespace Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    
    protected $guarded = ['id'];

    public $timestamp = true;

}