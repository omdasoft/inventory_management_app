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

        $respose = Http::get('https://api.salla.dev/admin/v2/products');
        $resposeArray = $respose->json();
        $this->assertEquals(200, $resposeArray['status']);
        $this->assertEquals(4, count($resposeArray));
        $this->assertTrue($respose['success']);
        $this->assertArrayHasKey('data', $resposeArray);
        $this->assertArrayHasKey('pagination', $resposeArray);
    }
}
