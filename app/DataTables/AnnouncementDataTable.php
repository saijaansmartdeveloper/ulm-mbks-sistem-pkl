<?php

namespace App\DataTables;

use App\Models\Announcement;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AnnouncementDataTable extends DataTable
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
                $action = \Form::open(['url' => route('pengumuman.destroy', ['id' => $data->id]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action .= \Form::close();
                $action .= '<a href=' . route('pengumuman.edit', ['id' => $data->id]) . ' class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i></a> ';
                $action .= '<button onclick="deleteRow(' . $data->id . ')" class = "btn btn-danger btn-sm" ><i class="fa fa-trash"></i></button>';
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Announcement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Announcement $model)
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
            ->setTableId('announcement-table')
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
            Column::make('judul_pengumuman'),
            Column::make('tanggal_pengumuman'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Announcement_' . date('YmdHis');
    }
}
