<?php

namespace src\Model\News;

use src\AbstractModel;

/**
 * Class Author
 *
 * This class represents an author and extends the base AbstractModel class.
 * It provides properties and methods related to authors.
 *
 * @package src\AbstractModel
 */
class Author extends AbstractModel
{
    /**
     * @var string The database table associated with the Author AbstractModel.
     */
    protected const TABLE = 'authors';

    /**
     * @var string The name of the author.
     */
    public string $name;
}