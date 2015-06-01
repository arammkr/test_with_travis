<?php

namespace tests\TestData;

use App\Models\Author;

class AuthorTestData
{
    protected static $authors = null;

    public static function getAuthors()
    {
        if (self::$authors === null) {
            self::$authors = Author::all();
        }

        return self::$authors;
    }

    public static function getRandomAuthor()
    {
        return self::getAuthors()->random();
    }
}
