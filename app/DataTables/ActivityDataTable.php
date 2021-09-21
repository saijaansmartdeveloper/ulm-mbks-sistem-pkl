<?php

namespace App\DataTables;

use App\Models\Activity;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActivityDataTable extends DataTable
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
                $action = \Form::open(['url' => route('magang.destroy', ['id' => $data->uuid]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action .= \Form::close();
                $action  .= '<div class="btn-group btn-group-sm" role="group">';
                $action .= '<a href=' . route('magang.edit', ['id' => $data->uuid]) . ' class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> ';
                $action .= '<a href=' . route('magang.show', ['id' => $data->uuid]) . ' class="btn btn-info btn-sm"><i class="fa fa-search"></i></a> ';
                $action .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                $action  .= '</div>';
                
                return $action;
            })
            ->editColumn('jenis_kegiatan_uuid', function ($data) {
                if ($data->jenis_kegiatan_uuid == null) {
                    return '-';
                }
                return $data->typeofactivity()->first()->nama_jenis_kegiatan;
            })
            ->editColumn('dosen_uuid', function ($data) {
                if ($data->dosen_uuid == null) {
                    return '-';
                }
                return $data->lecturer()->first()->nama_dosen;
            })
            ->editColumn('mahasiswa_uuid', function ($data) {
                if ($data->mahasiswa_uuid == null) {
                    return '-';
                }
                return $data->student()->first()->nama_mahasiswa;
            })
            ->editColumn('mitra_uuid', function ($data) {
                if ($data->mitra_uuid == null) {
                    return '-';
                }
                return $data->partner()->first()->nama_mitra;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Activity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $data   = Activity::select();
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('activity-table')
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
            Column::make('jenis_kegiatan_uuid')->title('Program Kegiatan'),
            Column::make('dosen_uuid')->title('Dosen'),
            Column::make('mahasiswa_uuid')->title('Mahasiswa'),
            Column::make('mitra_uuid')->title('Mitra'),
            Column::make('status_mitra')->title('Status'),
            Column::make('lama_kegiatan')->title('Lama (Hari)'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Activity_' . date('YmdHis');
    }
}
