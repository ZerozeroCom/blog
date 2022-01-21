<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Tests\DuskTestCase;



class ExampleTest extends DuskTestCase
{
        use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    protected function setup():Void
    {
        parent::setup();
        User::factory()->create([
            'email' => 'xxx@gmail.com'
        ]);
        Artisan::call('db:seed',['--class' => 'ProductSeeder']);
    }
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            //'disable-gpu'
            //'--headless-'
        ]);

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->with('.special-text',function($text){
                $text->assertSee('固定資料');
            });
            $browser->click('.check_product')->waitForDialog(5)->assertDialogOpened('商品數量充足')->acceptDialog();
        });
    }
    public function testFillForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/contact-us')
                    ->value('[name="name"]','cool')
                    ->select('[name="product"]','物品')
                    ->press('送出')
                    ->assertQueryStringHas('product','物品');

        });
    }
}
