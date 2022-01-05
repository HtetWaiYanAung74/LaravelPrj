<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Api;

class ApiController extends Controller
{
    public function index()
    {
        $apis = Api::latest()->get();

        return response(['data' => $apis ], 200);
    }

    public function store(ApiRequest $request)
    {
        $api = Api::create($request->all());

        return response(['data' => $api ], 201);

    }

    public function show($id)
    {
        $api = Api::findOrFail($id);

        return response(['data', $api ], 200);
    }

    public function update(ApiRequest $request, $id)
    {
        $api = Api::findOrFail($id);
        $api->update($request->all());

        return response(['data' => $api ], 200);
    }

    public function destroy($id)
    {
        Api::destroy($id);

        return response(['data' => null ], 204);
    }
}
