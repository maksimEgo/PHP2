<?php

namespace src\Validator;

class ArticleDataValidator
{
    public static function validate(array $data) : ?array
    {
        $errors = [];

        if ( empty($data['title']) ) {
            $errors['title'] = 'Title is required.';
        }

        if ( empty($data['content']) ) {
            $errors['content'] = 'Content is required.';
        }

        if ( empty($data['author_id']) ) {
            $errors['author_id'] = 'author_id is required.';
        }

        if ( !is_numeric($data['author_id']) ) {
            $errors['author_id'] = 'Author id must be an integer.';
        }

        return count($errors) > 0 ? $errors : null;
    }
}