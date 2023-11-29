<?php
namespace App\Services\Salla\DataTransferObjects;

class SallaproductDTO {
    public static function transform(array $product): array
    {
        $out = ['status' => '', 'data' => []];
        $data = [
                'id' => $product['data']['id'],
                'name' => $product['data']['name'],
                'price' => ['amount' => $product['data']['price']['amount'], 'currency' => $product['data']['price']['currency']],
                'sale_price' => ['amount' => $product['data']['sale_price']['amount'], 'currency' => $product['data']['sale_price']['currency']],
                'sku' => $product['data']['sku'],
                'category' => array_map(fn($cat) => ['id' => $cat['id'], 'name' => $cat['name']], $product['data']['categories']),
                'qty' => $product['data']['quantity'],
                'status' => $product['data']['status'],
                'main_image' => $product['data']['main_image'],
                'images' => array_map(fn($image) => ['url' => $image['url'], 'alt' => $image['alt']], $product['data']['images']),
                'desc' => $product['data']['description'], 
        ];

        $out['status'] = $product['status'];
        $out['data'] = $data;
        return $out;
    }
}