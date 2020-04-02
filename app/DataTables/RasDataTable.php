<?php

namespace App\DataTables;

use App\Ras;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RasDataTable extends DataTable
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
            ->addColumn('action', function($row){
                $btn = '<button type="button" name="edit" id="'.$row->id.'" class="edit btn btn-primary btn-sm">Ubah</button>';
                $btn .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\RasDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ras $model)
    {
        return $model->newQuery()->select('*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('ras-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->buttons(
                    Button::make('export'),
                    Button::make('print'),
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
            Column::make('id')
                ->title('ID'),
            Column::make('jenis_ras')
                ->title('Jenis Ras'),
            Column::make('ket_ras')
                ->title('Keterangan'),
            Column::make('created_at')
                ->title('Created At'),
            Column::make('updated_at')
                ->title('Updated At'),
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ras_' . date('YmdHis');
    }
}
