<?php

namespace App\Http\Controllers;

use Canaan\Repo\Contracts\CalenderInterface;
use Canaan\Repo\Contracts\TodoInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Todo extends Controller
{
    /**
     * @var TodoInterface $model
     */
    protected $model;

    /**
     * @var CalenderInterface $calender
     */
    protected $calender;


    public function __construct(TodoInterface $model, CalenderInterface $calender)
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

    public function sync()
    {
        $events = $this->calender->sync();
        return view('calender', compact('events'));
    }

    public function authenticate()
    {
        return $this->calender->authenticate();
    }
}
