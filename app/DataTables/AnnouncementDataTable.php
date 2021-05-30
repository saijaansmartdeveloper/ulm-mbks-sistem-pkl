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
            ->editColumn('user_uuid', function ($data) {
                return $data->users()->nama_pengguna ?? '';
            })
            ->editColumn('status_pengumuman', function ($data) {
                return $data->status_pengumuman == '1' ? 'Aktif' : 'Tidak Aktif';
            })
            ->addColumn('jurusan_dan_prodi', function ($data) {
                $jurusan = $data->jurusan()->kode_jurusan ?? '';
                $prodi   = $data->prodi()->kode_prodi ?? '';

                if ($jurusan == '' && $prodi == '') {
                    return 'Untuk Semua Jurusan dan Prodi';
                } else if ($jurusan != '' && $prodi == '') {
                    return $jurusan . ' - Untuk Semua Prodi';
                } else {
                    return $jurusan == '' ? $prodi : $jurusan . ' - ' . $prodi;
                }

            })
            ->addColumn('action', function ($data) {
                $action  = \Form::open(['url' => route('pengumuman.destroy', ['id' => $data->id]),  'id' => 'data-' . $data->id, 'method' => 'delete']);
                $action .= \Form::close();
                $action .= '<a href=' . route('pengumuman.show', ['id' => $data->id]) . ' class="btn btn-sm btn-info" ><i class="fa fa-eye"></i></a> ';
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
            Column::make('user_uuid')
                ->title('Pembuat'),
            Column::make('judul_pengumuman')
                ->title('Judul'),
            Column::make('jurusan_dan_prodi')
                ->title('Jurusan Dan Prodi'),
            Column::make('tanggal_pengumuman')
                ->title('Tanggal'),
            Column::make('jenis_pengumuman')
                ->title('Jenis'),
            Column::make('status_pengumuman')
                ->title('status'),
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
