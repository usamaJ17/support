<?php

namespace App\DataTables;

use App\Models\Ticket;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class TicketDataTableAdmin extends DataTable
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
        return $dataTable->addColumn('status_tag', function($query) {
            return view('components.datatables_status', [
                'msg' => ($query->status) ? 'open' : 'closed',
                'type' => ($query->status) ? 'success' : 'warning',
            ]);
        })
        ->addColumn('user', function($query) {
            return $query->user->name;
        })
        ->addColumn('agent', function($query) {
            return ($query->agent) ? $query->agent->name : "Not Assigned";
        })
        ->addColumn('change', 'ticket.change_agent')->escapeColumns([])
        ->addColumn('action', 'ticket.datatables_admin_actions')
        ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ticket $model)
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
                   'text' => '<i class="fa fa-download"></i> Export'
                ],
                [
                   'extend' => 'reload',
                   'className' => 'btn btn-default btn-sm no-corner',
                   'text' => '<i class="fa fa-refresh"></i> Reload'
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
            'user' => new Column(['title' =>"By User" , 'data' => 'user','searchable' => true]),
            'agent' => new Column(['title' =>"Agent Assigned" , 'data' => 'agent','searchable' => true]),
            'change' => new Column(['title' =>"Change Agent" , 'data' => 'change']),
            'status' => new Column(['title' =>"Status"  , 'data' => 'status_tag']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'all_tickets_' . time();
    }
}
