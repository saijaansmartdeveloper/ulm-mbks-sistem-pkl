<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('user.destroy', ['id' => $data->uuid]), 'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                $action  .= '<div class="btn-group btn-group-sm" role="group">';
                $action  .= '<a role="button" href=' . route('user.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> ';
                $action  .= '<a role="button" href=' . route('user.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info"><i class="fa fa-search"></i></a> ';
                $action  .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                $action  .= '</div>';
                
                return $action;
            })
            ->editColumn('jurusan_uuid', function ($data) {
                if ($data->jurusan_uuid == null) {
                    return '-';
                }
                return $data->major()->first()->kode_jurusan;
            })
            ->editColumn('prodi_uuid', function ($data) {
                if ($data->prodi_uuid == null) {
                    return '-';
                }
                return $data->studyprogram()->first()->kode_prodi;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->orderBy('nama_pengguna', 'asc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => ['create', 'excel', 'print', 'reload'],

            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::make('nama_pengguna'),
            Column::make('role_pengguna'),
            Column::make('email'),
            Column::make('jurusan_uuid')
                ->title('Jurusan'),
            Column::make('prodi_uuid')
                ->title('Program Studi'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
