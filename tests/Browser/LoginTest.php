<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
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
            ->click('.fas fa-trash')
            ->assertSee('Product Create')
            ->clickLink('Videos')
            ->visit('/videos')
            ->assertSee('test.mp4')
            ->clickLink('Logout');
        });
    }
}
