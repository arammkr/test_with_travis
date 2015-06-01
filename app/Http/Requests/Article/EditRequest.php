<?php

namespace app\Http\Requests\Article;

use App\Models\Author;
use UIS\Core\Requests\BaseRequest;

class EditRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => [
                'type'     => 'string',
                'required' => 'Article title required.',
                'error'    => 'Too long article title.',
                'params'   => [
                    'max_length' => 250,
                ],
                'filters' => [
                    'string.trim' => true,
                ],
            ],
            'body' => [
                'type'     => 'string',
                'required' => 'Article body required.',
                'error'    => 'Too long article body.',
                'params'   => [
                    'max_length' => 65000,
                ],
                'filters' => [
                    'string.trim' => true,
                ],
            ],
            'author_id' => [
                'type'     => 'function',
                'required' => 'Author required.',
                'error'    => 'Author not found.',
                'params'   => [
                    'function' => function ($authorId) {
                        $author = Author::find($authorId);

                        return !empty($author);
                    },
                ],
            ],
        ];
    }
}
