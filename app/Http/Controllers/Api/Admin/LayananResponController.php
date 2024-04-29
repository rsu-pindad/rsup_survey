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

    function __contruct()
    {
        $this->middleware(['role:admin','permission:layanan-respon-list|layanan-respon-create|layanan-respon-edit|layanan-respon-delete'],['only' => ['index','show']]);
        $this->middleware(['role:admin','permission:layanan-respon-create'],['only' => ['create', 'store']]);
        $this->middleware(['role:admin','permission:layanan-respon-edit'],['only' => ['edit', 'update']]);
        $this->middleware(['role:admin','permission:layanan-respon-delete'],['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $layananRespon = LayananRespon::paginate(50);
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
    public function show(string $id) : JsonResponse
    {
        $layananRespon = LayananRespon::find($id);
        if(is_null($layananRespon)){
            return $this->sendError('Layanan Respon tidak ditemukan.');
        }
        return $this->sendResponse(new LayananResponResource($layananRespon), 'show layanan respon didapat.');
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
    public function update(Request $request, LayananRespon $layananRespon)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'layanan_id' => 'required|numeric|exists:layanan,id',
            'respon_id' => 'required|numeric|exists:respon,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $layananRespon->layanan_id = $input['layanan_id'];
        $layananRespon->respon_id = $input['respon_id'];
        $layananRespon->save();
        return $this->sendResponse(new LayananResponResource($layananRespon), 'layanan respon berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layananRespon = LayananRespon::find($id);
        if ($layananRespon) {
            $layananRespon->delete();
            return $this->sendResponse('layanan respon berhasil di hapus.', 201);
        }
        return $this->sendError('Layanan respon tidak ditemukan');
    }
}
