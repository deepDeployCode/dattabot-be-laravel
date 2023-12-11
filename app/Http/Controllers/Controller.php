<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ok($data, string $message = 'Successfully Data', int $statusCode = 200)
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }

    public function error(string $message = 'Errors Data', int $statusCode = 422)
    {
        return response()->json(['message' => $message], $statusCode);
    }

    public function customError($data)
    {
        $data = collect($data);
        $res = collect([]);

        foreach ($data as $key => $value) {
            $data = array(
                'request' => $key,
                'message' => $value[0],
            );

            $res->push($data);
        }

        return response()->json(['message' => 'Not Complete Data', 'data' => $res], 422);
    }

    public function limit($request)
    {
        $limit = 20;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }
        return $limit; //use limit default
    }
}
