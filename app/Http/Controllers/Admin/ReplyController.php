<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Reply;
use App\User;

class ReplyController extends Controller
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
            $query = Reply::select('replies.*')
                                ->withCount('favorites')
                                ->with(['owner:id,name','thread:id,channel_id,user_id,title']);

            return DataTables::of($query)
                            ->addColumn('action', function ($reply) {
                                return '<a href="#delete-'.$reply->id.'" onclick="deleteReply(' .$reply->id .');" class="btn btn-xs btn-danger"><i class="fa fa-fw fa-trash-o"></i>'.trans('admin.delete').'</a>'.
                                        '<form action="' .route('admin.replies.delete', $reply->id) .'" method="POST" id="delete-' . $reply->id .'">'.
                                            csrf_field().
                                            method_field('DELETE')
                                            .'<input type="hidden" name="id" value="' . $reply->id .'">
                                        </form>';
                            })
                            ->editColumn('message', function($reply){
                                return '<a href="' . $reply->path() . '" data-toggle="tooltip" title="' . $reply->message .'">'.$reply->short_message.'</a>';
                            })
                            ->editColumn('thread.title', function($reply){
                                return '<a href="' . $reply->thread->path() . '">'.$reply->thread->title.'</a>';
                            })
                            ->rawColumns(['message', 'action', 'thread.title'])
                            ->toJson();
        }
        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                    ['data' => 'message', 'name' => 'message', 'title' => trans('admin.message')],
                    ['data' => 'thread.title', 'name' => 'thread.title', 'title' => trans('admin.threads')],
                    ['data' => 'owner.name', 'name' => 'owner.name', 'title' => trans('admin.creator')],
                    ['data' => 'favorites_count', 'name' => 'favorites_count', 'title' => trans('admin.favorite'), 'searchable' => false,],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => trans('admin.created_at'),],
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
        return view('admin.reply', compact('html'));
    }

    public function destroy(Request $request)
    {
        Reply::findOrFail($request->id)->delete();
        session()->flash('status', trans('admin.delete_success'));
        return back();
    }

}
