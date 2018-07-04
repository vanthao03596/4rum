<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilter;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @param Channel $channel
	 * @return \Illuminate\Http\Response
	 */
	public function index(Channel $channel, ThreadFilter $filter)
	{
		$threads = $channel->threads()->filter($filter);
		$threads = $threads->get();
		return view('channels.index', compact('threads', 'channel'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		Channel::create($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function show(Channel $channel)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Channel $channel)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Channel $channel)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Channel $channel)
	{
		//
	}
}
