<?php
namespace App\Services\Salla\DataTransferObjects;

class SallaProductCategoriesDTO {
    public static function transformCollection(array $categories): array
    {
        return array_map(function ($category) {
            return [
                'id' => $category['id'],
                'name' => $category['name'],
            ];
        }, $categories['data']);
    }
}