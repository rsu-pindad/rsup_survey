<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\LayananResource;
use App\Models\Layanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class LayananController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $layanan = Layanan::paginate(100);
        return $this->sendResponse(LayananResource::collection($layanan), 'list layanan didapat.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_layanan' => 'required|max:50|min:3'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator Error. ', $validator->errors());
        }
        $layanan = Layanan::create($input);
        return $this->sendResponse(new LayananResource($layanan), 'layanan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $layanan = Layanan::find($id);
        if (is_null($layanan)) {
            return $this->sendError('Layanan tidak ditemukan');
        }
        return $this->sendResponse(new LayananResource($layanan), 'show layanan didapat.');
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
    public function update(Request $request, Layanan $layanan): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_layanan' => 'required|max:50|min:3'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $layanan->nama_layanan = $input['nama_layanan'];
        $layanan->save();
        return $this->sendResponse(new LayananResource($layanan), 'layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $layanan = Layanan::find($id);
        if ($layanan) {
            $layanan->delete();
            return $this->sendResponse('layanan berhasil di hapus.', 201);
        }
        return $this->sendError('Layanan tidak ditemukan');
    }
}
