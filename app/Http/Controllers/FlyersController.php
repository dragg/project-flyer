<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests;
use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FlyersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FlyerRequest $request
     * @return Response
     */
    public function store(FlyerRequest $request)
    {
        $flyer = $this->user->publish(
            new Flyer ($request->all())
        );

        flash()->success('Success!', 'Your flyer has been created.');

        return redirect()->route('flyers.show', [$flyer->zip, str_replace(' ', '-', $flyer->street)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
