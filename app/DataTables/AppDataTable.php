<?php

namespace App\DataTables;

use App\Models\App;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class AppDataTable extends DataTable
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
            ->editColumn('title', function ($row) {
                return $row->translation('title' , app()->getLocale());
            })
            ->editColumn('description', function ($row) {
                return $row->translation('description' , app()->getLocale());
            })
            ->editColumn('category_id', function ($row) {
                return object_get($row, 'category')->translation('title' , app()->getLocale());
            })
            ->addColumn('tags', function ($row) {
               return implode(' , ' , object_get($row , 'tags')->map(function($tag){
                   return $tag->translation('title' , app()->getLocale());
               })->toArray());
            })
            ->editColumn('owner_id', function ($row) {
                return object_get($row, 'owner.name');
            })
            ->addColumn('action', 'admin.apps.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\App $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(App $model)
    {
        return $model->with(['category', 'tags', 'owner'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('app-table')
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
            'id',
            'title',
//            'description',
//            'size',
//            'original_link',
//            'extension',
            'category_id',
            'tags',
            'owner_id',
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'App_' . date('YmdHis');
    }
}
