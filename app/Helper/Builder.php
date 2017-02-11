<?php

/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Feb 2017
 */

namespace App\Helper;

use Illuminate\Database\Query\Builder as BaseBuilder;

class Builder extends BaseBuilder
{

    protected $model;

    /**
     * find row[s] in table
     *
     * @param array $where
     * @param boolean $all
     * @param int $limit
     * @param int $offset
     * @param string $orderBy
     * @param array|string $rulesOrder
     *
     * @return array collection
     */
    public function find_v2($where, $all = false, $limit = 0, $offset = 0, $orderBy = 'id', $rulesOrder = 'ASC')
    {

        $query = $this->select(['*'])
            ->where($where)
            ->limit($limit)
            ->offset($offset)
            ->orderBy($orderBy, $rulesOrder);

        if ($all) {
            return $query->get();
        }
        return $query->first();
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