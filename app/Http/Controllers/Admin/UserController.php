<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use App\User;

class UserController extends Controller
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
            return DataTables::of(User::query())
                            ->addColumn('action', function ($user) {
                                return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-lock"></i> Lock</a>'.
                                        '<a href="#lock-'.$user->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> View</a>';
                            })->toJson();
        }

        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                    ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                    ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                    ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
                ])

                ->parameters([
                    'language' =>  [
                        'processing' => '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>'
                    ],
                ])
                ->addAction([
                    'defaultContent' => '',
                    'data'           => 'action',
                    'name'           => 'action',
                    'title'          => 'Action',
                    'render'         => null,
                    'orderable'      => false,
                    'searchable'     => false,
                    'exportable'     => false,
                    'printable'      => true,
                    'footer'         => '',
                ]);
        return view('admin.user', compact('html'));
    }
}
