<?php

namespace App\DataTables;

use App\Models\EmailModel;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class EmailDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'ticket.datatables_user_actions')
        ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EmailModel $model)
    {
        return $model->newQuery()->with('user')->orderBy('id' , 'DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->addAction(['width' => '120px', 'printable' => false, 'title' => "Action"])
        ->parameters([
            'dom'       => 'Bfrtip',
            'stateSave' => true,
            'bSort' => false,
            'order'     => [[0, 'desc']],
            'buttons'   => [
                [
                   'extend' => 'export',
                   'className' => 'btn btn-default btn-sm no-corner',
                   'text' => '<i class="fa fa-download"></i> ' .'Export'
                ],
                [
                   'extend' => 'reload',
                   'className' => 'btn btn-default btn-sm no-corner',
                   'text' => '<i class="fa fa-refresh"></i> ' .'Reload'
                ],
                [
                   'extend' => 'create',
                   'className' => 'btn btn-default btn-sm no-corner',
                   'text' => '<i class="fa fa-plus"></i> ' .'Send New'
                ],
            ],
            'language' => [
                'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
            ],
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
            'id' => new Column(['title' =>"ID", 'data' => 'id']),
            'subject' => new Column(['title' =>"Subject" , 'data' => 'subject','searchable' => true]),
            'to' => new Column(['title' =>"Customer Adress"  , 'data' => 'to']),
            'by' => new Column(['title' =>"Sender Adress"  , 'data' => 'user.name']),
            'time' => new Column(['title' =>"STime"  , 'data' => 'created_at']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'emails_' . time();
    }
}
