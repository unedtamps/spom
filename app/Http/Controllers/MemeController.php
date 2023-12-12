<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemeRequest;
use App\Http\Requests\UpdateMemeRequest;
use App\Models\Meme;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Meme $meme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meme $meme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemeRequest $request, Meme $meme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meme $meme)
    {
        //
    }
}
