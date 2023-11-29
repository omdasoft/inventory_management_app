<?php
namespace App\Services\Salla\DataTransferObjects;

class SallaProductsDTO {
    public static function transformCollection(array $products): array
    {
        return array_map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => ['amount' => $product['price']['amount'], 'currency' => $product['price']['currency']],
                'sale_price' => ['amount' => $product['sale_price']['amount'], 'currency' => $product['sale_price']['currency']],
                'sku' => $product['sku'],
                'categories' => array_map(fn($cat) => ['id' => $cat['id'], 'name' => $cat['name']], $product['categories']),
                'qty' => $product['quantity'],
                'status' => $product['status'],
                'main_image' => $product['main_image'],
                'images' => array_map(fn($image) => ['url' => $image['url'], 'alt' => $image['alt']], $product['images']),
                'desc' => $product['description'], 
            ];
        }, $products['data']);
    }
}