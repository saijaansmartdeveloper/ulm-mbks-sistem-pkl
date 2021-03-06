<?php

namespace App\DataTables;

use App\Models\Major;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DB;

class MajorDataTable extends DataTable
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
            ->of($query)
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('jurusan.destroy', ['id' => $data->uuid]), 'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                $action  .= '<a href=' . route('jurusan.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> ';
                $action  .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>';

                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Major $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return DB::table('jurusan as jur')
        ->selectRaw("
            jur.id,
            jur.uuid,
            jur.nama_jurusan as nama_jurusan,
            jur.kode_jurusan as kode_jurusan,
            COUNT(prodi.nama_prodi) as program_studi
        ")
        ->leftJoin('prodi','jur.uuid','=','prodi.jurusan_uuid')
        ->groupByRaw("jur.id")->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('major-table')
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
            Column::make('kode_jurusan'),
            Column::make('nama_jurusan'),
            Column::make('program_studi')
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Major_' . date('YmdHis');
    }
}
