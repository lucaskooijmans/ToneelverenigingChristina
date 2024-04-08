<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class NewsTest extends DuskTestCase
{
    /**
     * Test the creation of a news item.
     */
    public function testCreate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/nieuws')
                    ->assertSee('Nieuws')
                    ->assertSee('Toevoegen')
                    ->clickLink('Toevoegen')
                    ->assertSee('Toevoegen')
                    ->type('title', 'Test nieuws')
                    ->type('body', 'Dit is een test nieuwsbericht')
                    ->press('Toevoegen')
                    ->visit('/nieuws')
                    ->assertSee('Test nieuws')
                    ->assertSee('Dit is een test nieuwsbericht')
                    ->press('Verwijderen')
                    ->screenshot('nieuwsCreate');
        });
    }

    /**
     * Test the deletion of a news item.
     */
    public function testDelete(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/nieuws')
                    ->assertSee('Toevoegen')
                    ->clickLink('Toevoegen')
                    ->assertSee('Toevoegen')
                    ->type('title', 'Test nieuws')
                    ->type('body', 'Dit is een test nieuwsbericht')
                    ->press('Toevoegen')
                    ->visit('/nieuws')
                    ->assertSee('Test nieuws')
                    ->assertSee('Dit is een test nieuwsbericht')
                    ->press('Verwijderen')
                    ->visit('/nieuws')
                    ->assertDontSee('Test nieuws')
                    ->assertDontSee('Dit is een test nieuwsbericht')
                    ->screenshot('nieuwsDelete');
        });
    }

    /**
     * Test the editing of a news item.
     */
    public function testEdit(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/nieuws')
                    ->assertSee('Toevoegen')
                    ->clickLink('Toevoegen')
                    ->assertSee('Toevoegen')
                    ->type('title', 'Test nieuws')
                    ->type('body', 'Dit is een test nieuwsbericht')
                    ->press('Toevoegen')
                    ->visit('/nieuws')
                    ->assertSee('Test nieuws')
                    ->assertSee('Dit is een test nieuwsbericht')
                    ->clickLink('Aanpassen')
                    ->assertSee('Aanpassen')
                    ->type('title', 'Test nieuws bewerkt')
                    ->type('body', 'Dit is een test nieuwsbericht bewerkt')
                    ->press('Aanpassen')
                    ->visit('/nieuws')
                    ->assertSee('Test nieuws bewerkt')
                    ->assertSee('Dit is een test nieuwsbericht bewerkt')
                    ->press('Verwijderen')
                    ->screenshot('nieuwsEdit');
        });
    }
}
