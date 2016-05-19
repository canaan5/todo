<?php

namespace App\Http\Controllers;

use Canaan\Contracts\CalenderSynchronizationInterface;
use Canaan\Contracts\TodoInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;

class Todo extends Controller
{
    /**
     * @var TodoInterface $model
     */
    protected $model;

    /**
     * @var CalenderSynchronizationInterface $calender
     */
    protected $calender;


    public function __construct(TodoInterface $model, CalenderSynchronizationInterface $calender)
    {
        $this->model = $model;
        $this->calender = $calender;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->model->getAll();
        return view('index', compact('todos', 'events'));
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
    public function store(Requests\TodoRequest $request)
    {
        // Array of data to save from the request
        $data = [
            'title' => $request->title,
            'date' => $request->date,
            'info' => $request->info,
        ];

        // Save the new todo list item to the database
        if ( $this->model->create($data)) {
            return redirect('/')->with('message', "To-Do item {$request->title} Added");
        }

        return back()->withInput()->withErrors();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if($this->model->delete($id)) {
            return back()->with('message', 'item deleted');
        }

        return back()->with('message', 'Error Deleting Item');
    }

    /**
     * One way synchronization with google calender
     *
     * @return resource
     */
    public function calender()
    {
        $events = $this->calender->sync();

        if($events instanceof RedirectResponse) {
            return $events;
        }

        return view('calender', compact('events'));
    }

    /**
     * @return bool
     */
    public function authenticate()
    {
        return $this->calender->authenticate();
    }
}
