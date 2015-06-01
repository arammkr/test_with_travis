<?php

namespace app\Models;

use UIS\Core\Models\BaseModel;

class Author extends BaseModel
{
    protected $table = 'author';

    protected $fillable = ['first_name', 'last_name', 'email'];

    protected $hidden = ['created_at'];
}
