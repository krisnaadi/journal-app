<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJournalRequest;
use App\Http\Requests\UpdateJournalRequest;
use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('journals.list', [
            'journals' => Journal::latest()->get(),
        ]);
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
    public function store(StoreJournalRequest $request)
    {
        auth()->user()->journals()->create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalRequest $request, Journal $journal)
    {
        $journal->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journal $journal)
    {
        $journal->delete();
        return redirect()->back();
    }
}
