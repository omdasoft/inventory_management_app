<?php
namespace App\Helpers;

use App\Services\SallaAuthService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    private $accessToken;
    private $baseUrl;
    
    public function __construct(private SallaAuthService $sallaAuthService)
    {
        $this->accessToken = $this->sallaAuthService->getToken();
        $this->baseUrl = config('salla.base_url');
    }

    public function get($endpoint, $queryParams = [], $headers = [])
    {
        try {
            $response = Http::withToken($this->accessToken)
                ->withHeaders($headers)
                ->get($this->baseUrl.'/'.$endpoint, $queryParams);
            if ($response->successful()) {
                return $response->body();
            } else {
                $statusCode = $response->status();
                $errorMessage = $response->json('message');
                Log::error("HTTP request failed with status code $statusCode: $errorMessage File: ".__CLASS__." Time: ".now());
                return json_encode(['status' => $statusCode, 'error' => $errorMessage ?? "something went wrong"]);
            }
        } catch (\Exception $e) {
            Log::error("An unexpected error occurred: " . $e->getMessage());
        }
    }
}
