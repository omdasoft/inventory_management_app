<?php
namespace App\Services\Salla;

use App\Services\SallaAuthService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\Salla\DataTransferObjects\SallaProductDTO;
use App\Services\Salla\DataTransferObjects\SallaProductsDTO;
use App\Services\Salla\DataTransferObjects\SallaProductCategoriesDTO;

class SallaService
{

    private array $headers;
    public function __construct(protected string $baseUri)
    {
        $this->headers = [
            'Accept' => 'application/json',
        ];
    }

    public function getProducts(): array
    {
        try {
            $cacheKey = "salla_products";
            $ttl = 3600;
            $accessToken = $this->getAccessToken();
            return Cache::remember($cacheKey, $ttl, function () use ($accessToken) {

                $response = Http::withToken($accessToken)
                            ->withHeaders($this->headers)
                            ->get($this->baseUri . '/products');

                if ($response->successful()) {
                    $products = $response->json();
                    $data = SallaProductsDTO::transformCollection($products);
                    return ['status' => $products['status'], 'data' => $data, 'metadata' => $products['pagination']];
                }

                $response = $response->json();
                return ['status' => $response['status'], 'error' => $response['error']['message']];
            });
            
        } catch (\Exception $e) {
            Log::error("Salla Fetch Products API ERROR: " . $e->getMessage() . " Code :" . $e->getCode() . " CLASS :" . __CLASS__);
            return ['status' => $e->getCode(), 'error' => 'something went wrong'];
        }
    }

    public function getProduct(int $id): array
    {
        try {
            $accessToken = $this->getAccessToken();
            $response = Http::withToken($accessToken)->withHeaders($this->headers)->get($this->baseUri . '/products/' . $id);
            if ($response->successful()) {
                $product = $response->json();
                return SallaProductDTO::transform($product);
            }
            
            $response = $response->json();
            return ['status' => $response['status'], 'error' => $response['error']['message']];

        } catch (\Exception $e) {
            Log::error("Salla Fetch Product API ERROR: " . $e->getMessage() . " Code :" . $e->getCode() . " CLASS :" . __CLASS__);
            return ['status' => $e->getCode(), 'error' => 'something went wrong'];
        }

    }

    public function getCategories(): array
    {
        try {
            $cacheKey = "salla_product_categories";
            $ttl = 3600;
            $accessToken = $this->getAccessToken();
            return Cache::remember($cacheKey, $ttl, function () use ($accessToken) {

                $response = Http::withToken($accessToken)
                            ->withHeaders($this->headers)
                            ->get($this->baseUri . '/categories');

                if ($response->successful()) {
                    $categories = $response->json();
                    $data = SallaProductCategoriesDTO::transformCollection($categories);
                    return ['status' => $categories['status'], 'data' => $data, 'metadata' => $categories['pagination']];
                }

                $response = $response->json();
                return ['status' => $response['status'], 'error' => $response['error']['message']];
            });
            
        } catch (\Exception $e) {
            Log::error("Salla Fetch Product Categories API ERROR: " . $e->getMessage() . " Code :" . $e->getCode() . " CLASS :" . __CLASS__);
            return ['status' => $e->getCode(), 'error' => 'something went wrong'];
        }
    }

    private function getAccessToken(): null|string
    {
        return (new SallaAuthService)->getToken();
    }
}
