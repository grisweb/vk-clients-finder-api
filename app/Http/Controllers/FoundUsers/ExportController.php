<?php

namespace App\Http\Controllers\FoundUsers;

use App\Exports\ExportFoundUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function csv(ExportFoundUsers $foundUsers): Response|BinaryFileResponse
    {
        return $foundUsers->download('clients.csv', Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
