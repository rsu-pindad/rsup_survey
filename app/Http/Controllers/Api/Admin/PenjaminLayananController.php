<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PenjaminLayananResource;
use App\Models\PenjaminLayanan;
use Validator;

class PenjaminLayananController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $penjaminLayanan = PenjaminLayanan::latest()->paginate(25);
        return $this->sendResponse(PenjaminLayananResource::collection($penjaminLayanan), 'list penjamin layanan berhasil di dapat.');
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
