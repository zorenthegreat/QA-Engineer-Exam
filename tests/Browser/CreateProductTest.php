<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
            ->type('email' , 'uolson@example.net')
            ->type('password' , 'password')
            ->check('input[name="remember"]')
            ->click('button[type="submit"]')
            ->assertSee('Products')
            ->clickLink('Create')
            ->visit('product/form')
            ->assertSee('Product Create')
            ->type('.form-control', 'Testing')
            ->keys('.ck-content', 'This is a Description Test')
            ->clickLink('Next')
            ->clickLink('Next')
            ->pause(5000)
           ;
        });
    }
}
