<?php

namespace src\model;

use src\Model;
use src\ObjectProperties;

/**
 * Class Article
 *
 * This class represents an article and extends the Model class.
 * It includes methods for handling the author and their properties.
 *
 * @package src\model
 */
class Article extends Model
{
    /**
     * Include trait for dynamic property handling.
     */
    use ObjectProperties;

    /**
     * Define the database table for articles.
     */
    protected const TABLE = 'news';

    /**
     * @var string The title of the article.
     */
    public string $title;
    /**
     * @var string The content of the article.
     */
    public string $content;
    /**
     * @var int|null The ID of the author associated with the article.
     */
    public ?int $author_id = null;
    /**
     * @var Author|null The author object associated with the article.
     */
    private object|null $authorObject = null;

    /**
     * Retrieve the author information for the article.
     */
    public function getAuthor(): void
    {
        if ($this->author_id !== null && $this->authorObject === null) {
            $this->authorObject = Author::findById($this->author_id);
        }
    }

    /**
     * Magic getter method to access properties dynamically.
     *
     * @param string $name The name of the property to access.
     * @return mixed The value of the property.
     */
    public function __get($name)
    {
        if ($name === 'author') {
            $this->getAuthor();
            return $this->authorObject;
        }
        return parent::__get($name);
    }
}
