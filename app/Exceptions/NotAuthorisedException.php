<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotAuthorisedException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        Log::debug('401');
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], 401);
    }
}
