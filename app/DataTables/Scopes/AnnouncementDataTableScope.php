<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class AnnouncementDataTableScope implements DataTableScope
{
    public $user = null;

    public function __construct($data)
    {
        $this->user = $data;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $jurusan = $this->jurusan_uuid ?? null;
        $prodi   = $this->prodi_uuid ?? null;

        if ($jurusan == null) {
            return $query->orderBy('created_at', 'asc');
        } else {
            return $query->orderBy('created_at', 'asc')->whereNotNull('jurusan_uuid', $jurusan);
        }

        // if ($prodi == null && $jurusan != null) {
        // } elseif ($prodi != null && $jurusan != null) {
        //     return $query->orderBy('created_at', 'asc')->where('prodi_uuid', $prodi)->whereNull('prodi_uuid')->where('jurusan_uuid', $jurusan)->whereNull('jurusan_uuid');
        // }

        // return $query->orderBy('created_at', 'asc')->where('prodi_uuid', $prodi)->where('jurusan_uuid', $jurusan)->whereNull('prodi_uuid')->whereNull('jurusan_uuid');


        // if ($jurusan != null) {
        //     return $query->where('jurusan_uuid', $jurusan);
        // }

    }
}
