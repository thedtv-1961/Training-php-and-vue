<?php

namespace App\Repositories;

interface BaseInterface
{
    /**
     * function all to get all data of model.
     *
     * @return void
    */
    public function all();

    /**
     * to get columns that delete used soft delete.
     *
     * @return void
    */
    public function withTrashed();

    /**
    * to get column that delete used soft delete.
     *
     * @return void
    */
    public function onlyTrashed();

    /**
     *
     */
    public function makeModel();

    /**
     * to get lists columns.
     *
     * @return void
    */
    public function lists($column, $key = null);

    /**
     *  Paginate the given query.
     *
     */
    public function paginate($limit = null, $columns = ['*']);

    public function find($id, $columns = ['*']);

    public function findOrFail($id, $columns = ['*']);

    public function where($conditions, $operator = null, $value = null);

    public function whereIn($column, $value);

    public function whereHas($relationships, $function);

    public function whereFirst(string $conditions, string $value);

    public function orWhere($column, $operator = null, $value = null);

    public function orWhereIn($column, $values);

    public function whereBetween($colunm, $values);

    public function whereNotIn($colunm, $values);

    public function whereNull($colunm);

    public function whereNotNull($colunm);

    public function create($input);

    public function firstOrCreate($input);

    public function multiCreate($input);

    public function update($id, $input);

    public function multiUpdate($column, $value, $input);

    public function delete();

    public function forceDelete();

    public function join($tableName, $tableColumn, $modelColumn, $option = '');

    public function groupBy($colunms);

    public function count();

    public function first($columns = ['*']);

    public function with($relationship);

    public function orderBy($column, $option = 'asc');

    public function get();

    public function exists();

    public function select($columns = ['*']);

    public function createByRelationship($method, $inputs, $option = false);

    public function take($limit);

    public function pluck($column, $key = null);
}
