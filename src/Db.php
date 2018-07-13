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
    private $con;

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

    public function getTable($tablename)
    {
        $table = $this->con->table($tablename);
        return $table->select()->get();
    }

    public function updateTable($params) {

        foreach ($params['values'] as $key => $value) {
            if($key === 'id') {
                continue;
            }
            $table = $this->con->table($params['table']);
            $table->update()
                  ->set($key, $value)
                  ->where('id', $params['values']['id'])
                  ->execute();
        }
    }

}