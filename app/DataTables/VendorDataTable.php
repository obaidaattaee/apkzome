<?php

namespace App\DataTables;

use App\Models\Vendor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorDataTable extends DataTable
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
            ->editColumn('image' , function ($row) {
                return "<img src='{$row->image_file}' style='width: 50px;border-radius: 100%' />";
            })
            ->addColumn('rate' , function ($row) {
                return view('admin.vendors.rate')->with('rate' , $row->rate);
            })
            ->addColumn('action', 'admin.vendors.actions')
            ->rawColumns(['action' , 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vendor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vendor $model)
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
                    ->setTableId('vendor-table')
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
            ['name' => 'id' , 'title' => '#' , 'data' => 'id' ],
            ['name' => 'name' , 'title' => __('common.name') , 'data' => 'name' ],
            ['name' => 'image' , 'title' => __('common.image') , 'data' => 'image' ],
            ['name' => 'rate' , 'title' => __('common.rate') , 'data' => 'rate' ],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
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
        return 'Vendor_' . date('YmdHis');
    }
}
