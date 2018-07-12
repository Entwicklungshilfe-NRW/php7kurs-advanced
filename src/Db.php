<?php
/**
 * Created by PhpStorm.
 * User: rocket
 * Date: 12.07.18
 * Time: 15:16
 */

namespace gfu;

use \ClanCats\Hydrahon\Builder;
use \ClanCats\Hydrahon\Query\Sql\FetchableInterface;
use PDO;

class Db
{
    public $con;

    public function __construct()
    {
        $connection = new PDO('mysql:host=localhost;dbname=advanced', 'root', 'root');

        $this->con = new Builder('mysql', function($query, $queryString, $queryParameters) use ($connection)
        {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);

            // when the query is fetchable return all results and let hydrahon do the rest
            if ($query instanceof FetchableInterface)
            {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        });
    }

}