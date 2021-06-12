<?php

namespace App\DataTables;

use App\Models\ReportActivity;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActivityReportDataTable extends DataTable
{
    protected $actions = ['create', 'excel', 'reload', 'import'];
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
            ->rawColumns(['action','mahasiswa', 'dosen_uuid'])
            ->editColumn('kegiatan_uuid', function ($data) {
                return $data->activity()->first() == null ? '-' : $data->activity()->first()->typeofactivity()->first()->nama_jenis_kegiatan;
                // return ($data->activity()->first() == null ? '-' : ($data->activity()->first()->partner()->first()->nama_mitra . " - " . $data->activity()->first()->student()->first()->nama_mahasiswa));
            })
            ->addColumn('mahasiswa', function ($data) {
                return $data->activity()->first() == null ? '-' : $data->activity()->first()->student()->first()->student_link_profile;
            })
            ->editColumn('dosen_uuid', function ($data) {
                return $data->lecturer()->first() == null ? '-' : $data->lecturer()->first()->lecturer_link_profile;
            })
            ->addColumn('action', function ($data) {
                $action   = \Form::open(['url' => route('public.laporan-kegiatan.destroy', ['id' => $data->uuid]), 'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action  .= \Form::close();
                // // $action  .= '<a href=' . route('laporan-monev.edit', ['id' => $data->uuid]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
                $action  .= '<a href=' . route('public.laporan-kegiatan.show', ['id' => $data->uuid]) . ' class="btn btn-sm btn-info" ><i class="fa fa-search"></i></a> ';
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
    public function query(ReportActivity $model)
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
                    ->setTableId('laporankegiatan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'buttons' => ['create', 'excel', 'reload']
                    ]);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload'),
                    //     Button::make('import')
                    // );
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
            Column::make('jenis_laporan')
                ->title('Jenis Laporan'),
            Column::make('judul_laporan_activity')
                ->title('Judul'),
            Column::make('tanggal_laporan_activity')
                ->title('Tanggal'),
            Column::make('kegiatan_uuid')
                ->title('Program Kegiatan'),
            Column::make('mahasiswa')
                ->title('Mahasiswa'),
            Column::make('dosen_uuid')
                ->title('Dosen')
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

    public function import()
    {

    }
}
