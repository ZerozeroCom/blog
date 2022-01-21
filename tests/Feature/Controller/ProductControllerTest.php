<?php

namespace Tests\Feature\Controller;

use App\Http\Services\ShortUrlService;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    private $fakeUser;

    protected function setup(): void{
        parent::setUp();

    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSharedUrl()
    {
        $product = Product::factory()->create();
        $id = $product->id;

        $this->mock(AuthService::class, function ($mock) {
            $mock->shouldReceive('fakeReturn');
        });

        $this->mock(ShortUrlService::class, function ($mock) use($id) {
            $mock->shouldReceive('makeShortUrl')
                 ->with("http://localhost:8000/products/$id")
                 ->andReturn('fakeUrl');
        });

        $response = $this->call(
            'GET',
            'products/'.$id.'/shared-url'
        );

        $response->assertOk();
        $response = json_decode($response->getContent(),true);
        $this->assertEquals($response['url'],'fakeUrl');
    }
}
