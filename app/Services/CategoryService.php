<?php

namespace App\Services;

use App\Helpers\ApiClient;

class CategoryService {
    public function __construct(private ApiClient $apiClient) 
    {
    }

    public function categoryList() 
    {
        return $this->apiClient->get(endpoint:'categories', queryParams:[], headers:['Content-Type' => 'application/json']);
    }
}