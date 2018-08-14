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
            return DataTables::of(Thread::with('creator:id,name','channel:id,slug')->select('threads.*'))
                            ->addColumn('action', function ($thread) {
                                $id = "'lock-{$thread->id}'";
                                $icon = $thread->isLocked() ? 'fa fa-fw fa-unlock' : 'fa fa-fw fa-lock';
                                $btn = $thread->isLocked() ? trans('admin.unlock') : trans('admin.isLocked');
                                $color = $thread->isLocked() ? 'btn-info' : 'btn-danger';
                                return '<a href="#lock-'.$thread->id.'" onclick="lock(' .$thread->id .');" class="btn btn-xs '.$color.'"><i class="'.$icon.'"></i> '. $btn .'</a>'.
                                        '<a href="'. route('threads.show',[$thread->channel->slug, $thread->slug]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> '.trans('admin.view').'</a>'.
                                        '<form action="' .route('admin.threads.lock', $thread->id) .'" method="POST" id="lock-' . $thread->id .'">'.
                                            csrf_field()
                                            .'<input type="hidden" name="id" value="' . $thread->id .'">
                                        </form>';
                            })
                            ->editColumn('locked', function($thread) {
                                if($thread->locked == 1)
                                {
                                    return '<span class="label label-danger">'.trans('admin.isLocked').'</span>';
                                }
                                return '<span class="label label-success">' .trans('admin.working') .'</span>';
                            })
                            ->rawColumns(['locked', 'action'])
                            ->toJson();
        }
        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                    ['data' => 'title', 'name' => 'title', 'title' => trans('admin.title')],
                    ['data' => 'creator.name', 'name' => 'creator.name', 'title' => trans('admin.creator')],
                    ['data' => 'replies_count', 'name' => 'replies_count', 'title' => trans('admin.reply')],
                    ['data' => 'locked', 'name' => 'locked', 'title' => trans('admin.locked')],
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
    public function lock(Request $request)
    {
        $thread = Thread::findOrFail($request->id);
        if($thread->islocked())
        {
            $thread->unlock();
            session()->flash('status', trans('admin.unlock_success'));
        } else {
            $thread->lock();
            session()->flash('status', trans('admin.lock_success'));
        }
        return back();
    }
}
