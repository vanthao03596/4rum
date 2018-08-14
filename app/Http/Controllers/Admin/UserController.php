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
            return DataTables::of(User::with('profile')->select('users.*'))
                            ->editColumn('profile.avatar', function($user) {
                                 return '<img src="' . $user->avatar . '" alt="" class="direct-chat-img">';
                            })
                            ->addColumn('action', function ($user) {
                                return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-lock"></i> ' .trans('admin.isLocked').'</a>'.
                                        '<a href="#lock-'.$user->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>' .trans('admin.view').'</a>';
                            })
                            ->rawColumns(['profile.avatar', 'action'])
                            ->toJson();
        }

        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                    ['data' => 'profile.avatar', 'name' => 'profile.avatar', 'title' => trans('admin.avatar')],
                    ['data' => 'name', 'name' => 'name', 'title' => trans('admin.name')],
                    ['data' => 'email', 'name' => 'email', 'title' => trans('admin.email')],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => trans('admin.created_at')],
                    ['data' => 'updated_at', 'name' => 'updated_at', 'title' => trans('admin.updated_at')],
                ])

                ->parameters([
                    'language' =>  [
                        'processing' => '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>',
                        'url' =>  'https://cdn.datatables.net/plug-ins/1.10.19/i18n/' .config('datatables.locale.' . app()->getLocale() ) .'.json'
                    ],
                ])
                ->addAction([
                    'defaultContent' => '',
                    'data'           => 'action',
                    'name'           => 'action',
                    'title'          => trans('admin.action'),
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
