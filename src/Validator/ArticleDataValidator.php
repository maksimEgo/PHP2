<?php

namespace src\Validator;

use src\Exceptions\MultiException;
use TheSeer\Tokenizer\Exception;

class ArticleDataValidator
{
    private \Exception $exception;

    public function __construct()
    {
        $this->exception = new MultiException();
    }

    public function validate(array $data): bool
    {
        if ( empty($data['title']) ) {
            $this->exception->add(new Exception('Title is required.'));
        }

        if ( empty($data['content']) ) {
            $this->exception->add(new Exception('Content is required.'));
        }

        if ( empty($data['author_id']) ) {
            $this->exception->add(new Exception('author_id is required.'));
        }

        if ( !is_numeric($data['author_id']) ) {
            $this->exception->add(new Exception('Author id must be an integer.'));
        }

        if ( $this->exception->empty() ) {
            throw $this->exception;
        }

        return true;
    }
}