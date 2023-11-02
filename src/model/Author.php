<?php

namespace src\model;

use src\Model;

/**
 * Class Author
 *
 * This class represents an author and extends the base Model class.
 * It provides properties and methods related to authors.
 *
 * @package src\model
 */
class Author extends Model
{
    /**
     * @var string The database table associated with the Author model.
     */
    protected const TABLE = 'authors';

    /**
     * @var string The name of the author.
     */
    public string $name;
}