<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Thread;
use App\User;

class ThreadController extends Controller
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
            return DataTables::of(Thread::with('creator'))
                            ->addColumn('action', function ($thread) {
                                return '<a href="#edit-'.$thread->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-lock"></i> Lock</a>'.
                                        '<a href="#lock-'.$thread->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> View</a>';
                            })
                            ->toJson();
        }

        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                    ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
                    ['data' => 'creator.name', 'name' => 'creator', 'title' => 'Creator'],
                    ['data' => 'replies_count', 'name' => 'replies_count', 'title' => 'Reply'],
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
        return view('admin.thread', compact('html'));
    }

    public function test()
    {
        $data['tasks'] = [
                [
                        'name' => 'Design New Dashboard',
                        'progress' => '87',
                        'color' => 'danger'
                ],
                [
                        'name' => 'Create Home Page',
                        'progress' => '76',
                        'color' => 'warning'
                ],
                [
                        'name' => 'Some Other Task',
                        'progress' => '32',
                        'color' => 'success'
                ],
                [
                        'name' => 'Start Building Website',
                        'progress' => '56',
                        'color' => 'info'
                ],
                [
                        'name' => 'Develop an Awesome Algorithm',
                        'progress' => '10',
                        'color' => 'success'
                ]
        ];
        return view('admin.test')->with($data);
    }
}