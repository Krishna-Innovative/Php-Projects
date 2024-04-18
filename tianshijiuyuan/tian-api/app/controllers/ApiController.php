<?php

/**
 * Class ApiController
 */
class ApiController extends Controller
{

    /**
     * @param string $type
     * @param string $message
     * @param int $code
     * @return Illuminate\Support\Facades\Response
     */
    public function respondWithError($type, $message, $code)
    {
        return Response::json([
            'error' => [
                'type' => $type,
                'message' => $message,
            ]
        ], $code);
    }

} 