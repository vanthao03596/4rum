<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Contact;

class ContactController extends Controller
{
    protected $builder;
    public function __construct(Builder $builder)
    {
        $this->middleware('auth:admin');
        $this->builder = $builder;
    }

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Contact::query())
                            ->toJson();
        }

        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                    ['data' => 'name', 'name' => 'name', 'title' => trans('admin.name')],
                    ['data' => 'email', 'name' => 'email', 'title' => trans('admin.email')],
                    ['data' => 'website', 'name' => 'website', 'title' => trans('admin.website')],
                    ['data' => 'message', 'name' => 'message', 'title' => trans('admin.message')],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => trans('admin.created_at')],
                ])

                ->parameters([
                    'language' =>  [
                        'processing' => '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>',
                        'url' =>  'https://cdn.datatables.net/plug-ins/1.10.19/i18n/' .config('datatables.locale.' . app()->getLocale() ) .'.json'
                    ],
                ]);
        return view('admin.contact', compact('html'));
    }
}
