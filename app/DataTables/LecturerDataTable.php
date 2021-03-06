<?php

namespace App\DataTables;

use App\Models\Lecturer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LecturerDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['foto_dosen', 'action'])
            ->editColumn('jurusan_uuid', function ($data) {
                return ($data->jurusan()->first()->kode_jurusan ?? '') ." - ". ($data->prodi()->first()->nama_prodi ?? '');
            })
            ->editColumn('bimbingan', function ($data) {
                return ($data->activities()->count() ?? '0') . " Org";
            })
            ->editColumn('foto_dosen', function ($data) {
                return '<img src="'.asset('storage/' . $data->foto_dosen).'" height="80px">';
            })
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('dosen.destroy', ['id' => $data->uuid]), 'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                $action  .= '<div class="btn-group btn-group-sm" role="group">';
                $action  .= '<a role="button" href=' . route('dosen.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info" ><i class="fa fa-search"></i></a> ';
                if(\Auth::guard('web')->user()->role_pengguna == 'super_admin' || \Auth::guard('web')->user()->role_pengguna == 'admin_prodi'){
                    $action  .= '<a role="button" href=' . route('dosen.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
                    $action  .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                }
                $action  .= '</div>';
                
                return $action;
            });
    }


    public function query()
    {
        $data = Lecturer::select();
        return $this->applyScopes($data);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('lecturer-table')
            ->columns($this->getColumns())
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => ['create', 'excel', 'print', 'reload'],
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::make('nip_dosen')
                ->title('NIP'),
            Column::make('nama_dosen')
                ->title('Nama'),
            Column::make('email')
                ->title('Email'),
            Column::make('jurusan_uuid')
                ->title('Jurusan'),
            Column::make('bimbingan')
                ->title('Bimbingan')
                ->class('text-center'),
            Column::make('foto_dosen')
                ->title('Foto')
                ->class('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Lecturer_' . date('YmdHis');
    }
}
