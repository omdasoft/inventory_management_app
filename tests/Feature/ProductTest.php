<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ProductTest extends TestCase
{
    public function test_get_product_list(): void
    {
        $productList = file_get_contents('tests/Fixtures/salla_products_list.json');
        Http::fake([
            'https://api.salla.dev/admin/v2/*' => Http::response($productList, 200, ['Content-Type' => 'application/json']),
        ]);

        $respose = Http::get('https://api.salla.dev/admin/v2/products')->json();
        $this->assertEquals(200, $respose['status']);
        $this->assertEquals(4, count($respose));
        $this->assertTrue($respose['success']);
        $this->assertArrayHasKey('data', $respose);
        $this->assertArrayHasKey('pagination', $respose);
    }

    public function test_get_product_details(): void
    {
        $productDetails = file_get_contents('tests/Fixtures/salla_product_details.json');
        $product = json_decode($productDetails);
        $productArr = json_decode(json_encode($product), true);
        $id = $productArr['data']['id'];
        Http::fake([
            'https://api.salla.dev/admin/v2/*' => Http::response($productDetails, 200, ['Content-Type' => 'application/json']),
        ]);

        $respose = Http::get("https://api.salla.dev/admin/v2/products/$id")->json();
        $this->assertEquals(200, $respose['status']);
        $this->assertEquals($id, $respose['data']['id']);
        $this->assertTrue($respose['success']);
        $this->assertArrayHasKey('data', $respose);
    }
}
