<?php

namespace app\Models;

use UIS\Core\Models\BaseModel;

class Article extends BaseModel
{
    protected $table = 'article';

    protected $fillable = ['title', 'body', 'show_status'];

    protected $hidden = ['created_at', 'updated_at'];

    public function author()
    {
        return $this->hasOne(Author::class, 'author_id');
    }
}
