<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    // public function testBasicExample(): void
    // {
    //     $this->browse(function (Browser $browser) {
    //        $browser->visit('/users')
    //                ->assertTitle('User CRUD')
    //                 ->screenshot('users_index')
    //                ->pause(9000);
    //     });
    // }

    public function testUserListing()
    {
    $this->browse(function (Browser $browser) {
        $browser->visit('/users')
                ->assertTitle('User CRUD')
                ->screenshot('users_index')
                   ->pause(9000);// button on index page
    });
    }

    public function testCreateUser()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/users/create')
                ->type('first_name', 'John Doe')
                ->type('last_name', 'John Doe')
                ->type('email', 'john@example.com')
                ->type('password', 'secret123')
                ->press('Save') // button text
                ->assertPathIs('/users')
                ->assertTitle('User CRUD');
    });
}

}
