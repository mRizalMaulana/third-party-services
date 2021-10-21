<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlatformController extends Controller
{
    public function index()
    {
        try {
            $platfomFileJson = Storage::get('platform.json');
            $platformArray = json_decode($platfomFileJson, true);

            return response()->json(['status' => true, 'data' => $platformArray]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Oops something went wrong!']);
        }
    }

    public function addPlatform(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'platform_name' => 'required|string',
            ], [
                'platform_name.required' => 'platform name is required!',
                'platform_name.string' => 'platform name must be a string'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
            }

            $platformName = $request->platform_name;
            $platfomFileJson = Storage::get('platform.json');
            $platformArray = json_decode($platfomFileJson, true);
            $dataPlatform = ['platform_name' => $platformName];
            array_push($platformArray, $dataPlatform);
            $platformJson = json_encode($platformArray);
            Storage::put('platform.json', $platformJson);

            return response()->json(['status' => true, 'message' => 'platform name saved']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Oops something went wrong!']);
        }
    }
}
