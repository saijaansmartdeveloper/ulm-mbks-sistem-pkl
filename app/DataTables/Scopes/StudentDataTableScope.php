<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class StudentDataTableScope implements DataTableScope
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        dd($user);
        return $query->where('prodi_uuid', $this->user->prodi_uuid);
    }
}
