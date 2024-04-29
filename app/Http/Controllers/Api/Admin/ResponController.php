<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Respon;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ResponResource;

class ResponController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $respon = Respon::all();
        return $this->sendResponse(ResponResource::collection($respon), 'list respon berhasil didapat.');
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
            'nama_respon' => 'required|max:20|min:3',
            'icon_respon' => 'required|max:9|min:1',
            'tag_warna_respon' => 'required|max:9|min:1',
            'skor_respon' => 'required|numeric|max:9|min:1'
        ]);
        if($validator->fails()){
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $respon = Respon::create($input);
        return $this->sendResponse(new ResponResource($respon), 'respon berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $respon = Respon::find($id);
        if(is_null($respon)){
            return $this->sendError('respon tidak ditemukan.');
        }
        return $this->sendResponse(new ResponResource($respon), 'respon ditemukan.');
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
    public function update(Request $request, Respon $respon) : JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_respon' => 'required|max:50|min:3',
            'skor_respon' => 'required|numeric|max:9|min:1'
        ]);
        if($validator->fails()){
            return $this->sendError('Validator error. ', $validator->errors());
        }
        $respon->nama_respon = $input['nama_respon'];
        $respon->skor_respon = $input['skor_respon'];
        $respon->save();
        return $this->sendResponse(new ResponResource($respon), 'respon berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $respon = Respon::find($id);
        if($respon){
            $respon->delete();
            return $this->sendResponse('Respon berhasil dihapus.', 201);
        }
        return $this->sendError('Respon tidak ditemukan.');
    }
}
