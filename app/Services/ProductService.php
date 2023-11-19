<?php
namespace App\Services;
use App\Helpers\ApiClient;
use Illuminate\Support\Facades\Cache;

class ProductService 
{
    public function __construct(private ApiClient $apiClient)
    {}

    public function productList(): string
    {
        $ttl = 300;
        return Cache::remember('salla_product_list', $ttl, function () {
            return $this->apiClient->get(endpoint:'products', queryParams:[], headers:['Content-Type' => 'application/json']);
        });
    }
    
    public function productDetails(int $id): string
    {
        return $this->apiClient->get(endpoint:'products/'.$id, queryParams:[], headers:['Content-Type' => 'application/json']);
    }
}