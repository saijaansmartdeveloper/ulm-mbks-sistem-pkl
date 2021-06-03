<?php

namespace App\DataTables;

use App\Models\Monev;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanMonevDataTable extends DataTable
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
            ->editColumn('kegiatan_uuid', function ($data) {
                return ($data->activies()->first() == null ? '-' : ($data->activies()->first()->partner()->first()->nama_mitra . " - " . $data->activies()->first()->student()->first()->nama_mahasiswa));
            })
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('public.laporan-monev.destroy', ['id' => $data->uuid]), 'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                // $action  .= '<a href=' . route('laporan-monev.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
                $action  .= '<a href=' . route('laporan-monev.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info" ><i class="fa fa-search"></i></a> ';
                $action  .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';

                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LaporanMonev $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Monev $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('laporanmonev-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
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
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('jenis_laporan'),
            Column::make('judul_laporan_monev'),
            Column::make('kegiatan_uuid'),
            Column::make('tanggal_laporan_monev')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LaporanMonev_' . date('YmdHis');
    }
}
