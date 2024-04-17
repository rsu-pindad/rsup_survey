<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\LayananResponResource;
use App\Models\LayananRespon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class LayananResponController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $layananRespon = LayananRespon::all();
        return $this->sendResponse(LayananResponResource::collection($layananRespon), 'list layanan respon berhasil didapat.');
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
    public function store(Request $request) : JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'layanan_id' => 'required|numeric|exists:layanan,id',
            'respon_id' => 'required|numeric|exists:respon,id'
        ]);
        if($validator->fails()){
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $layananRespon = LayananRespon::create($input);
        return $this->sendResponse(new LayananResponResource($layananRespon), 'layanan respon berhasil di simpan');
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
