<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\Discussions\CreateDiscussionRequest;
use App\Notifications\MarkAsBestReply;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', ['discussions' => Discussion::FilterByChannels()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = \Str::slug($request->title);

        Auth::user()->discussions()->create($data);

        session()->flash('success', 'Discussion created success.');

        return redirect()->route('discussions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show', ['discussion' => $discussion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bestReply(Discussion $discussion, Reply $reply)
    {
        if (Auth::id() != $discussion->user->id) {
            abort(404);
        }
        $discussion->setBestReply($reply);

        session()->flash('success', 'Mark best reply success.');

        return redirect()->back();
    }
}
