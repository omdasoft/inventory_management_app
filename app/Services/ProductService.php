<?php
namespace App\Services;
use App\Helpers\ApiClient;
class ProductService 
{
    public function __construct(private ApiClient $apiClient)
    {}

    public function productList()
    {
        return $this->apiClient->get(endpoint:'products', queryParams:[], headers:['Content-Type' => 'application/json']);
    }
    
    public function productDetails(int $id)
    {
        return $this->apiClient->get(endpoint:'products/'.$id, queryParams:[], headers:['Content-Type' => 'application/json']);
    }
}