<?php

/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Feb 2017
 */

namespace App\Helper;

use Illuminate\Database\Eloquent\Builder as BaseBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;


class Builder extends BaseBuilder
{
    protected $model;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    /**
     * find row[s] in table
     *
     *
     * @param array $where
     * @param boolean $all
     * @param array $select
     * @param int $limit
     * @param int $offset
     * @param string $orderBy
     * @param array|string $rulesOrder
     *
     * @return array collection
     */
    public function find_v2($where, $all = false, $select = ['*'], $limit = 0, $offset = 0, $orderBy = 'id', $rulesOrder = 'ASC')
    {
        $query = $this->where($where)
            ->orderBy($orderBy, $rulesOrder);

        if ($limit != 0) {
            $query->limit($limit)
                ->offset($offset);

        }
        if ($all) {
            return $query->get($select);
        }
        return $query->first($select);
    }

    /**
     * Update a record based on where clause
     * if record does not exist, system will create it
     *
     * @param array $where
     * @param array $values
     * @return boolean
     */
    public function updateOrInsert_v2($where, $values)
    {
        $query = $this->updateOrInsert($where, $values);
        return true;
    }

    /**
     * Update a record based on where clause
     *
     * @param array $where
     * @param array $values
     * @return boolean
     */
    public function update_v2($where, $values)
    {
        $query = $this->where($where)->update($values);
        return true;
    }
}