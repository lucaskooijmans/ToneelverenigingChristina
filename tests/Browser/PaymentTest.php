<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PaymentTest extends DuskTestCase
{
    public function testSuccesfulPayment(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/voorstellingen')
                    ->clickLink('Meer informatie')
                    ->type('buyer_first_name', 'John')
                    ->type('buyer_last_name', 'Doe')
                    ->type('buyer_email', 'john@example.com')
                    ->type('amount', '1')
                    ->press('Afrekenen')
                    ->assertRouteIs('payment.handleStatus')
                    ->assertSee('Betaling succesvol afgerond. Uw tickets zijn verzonden naar uw e-mailadres.');
        });
    }
}
