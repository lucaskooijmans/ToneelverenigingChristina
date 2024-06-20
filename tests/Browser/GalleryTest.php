<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class GalleryTest extends DuskTestCase
{
    /**
     * Test the creation of a gallery item.
     */
    public function testCreate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/gallery')
                    ->assertSee('Foto Galerij')
                    ->assertSee('Foto toevoegen')
                    ->clickLink('Foto toevoegen')
                    ->assertSee('Foto toevoegen')
                    ->attach('image', 'tests\Browser\content\vleermuis.jpg')
                    ->type('title', 'Test afbeelding')
                    ->type('description', 'Dit is een test afbeelding')
                    ->press('Toevoegen')
                    ->visit('/gallery')
                    ->assertSee('Test afbeelding')
                    ->assertSee('Dit is een test afbeelding')
                    ->screenshot('galleryCreate')
                    ->press('Verwijderen');
        });
    }

    /**
     * Test the deletion of a gallery item.
     */
    public function testDelete(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/gallery')
                    ->assertSee('Foto toevoegen')
                    ->clickLink('Foto toevoegen')
                    ->assertSee('Foto toevoegen')
                    ->attach('image', 'tests\Browser\content\vleermuis.jpg')
                    ->type('title', 'Test afbeelding')
                    ->type('description', 'Dit is een test afbeelding')
                    ->press('Toevoegen')
                    ->visit('/gallery')
                    ->assertSee('Test afbeelding')
                    ->assertSee('Dit is een test afbeelding')
                    ->press('Verwijderen')
                    ->visit('/gallery')
                    ->assertDontSee('Test afbeelding')
                    ->assertDontSee('Dit is een test afbeelding')
                    ->screenshot('galleryDelete');
        });
    }

    /**
     * Test the editing of a gallery item.
     */
    public function testEdit(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/gallery')
                    ->assertSee('Foto toevoegen')
                    ->clickLink('Foto toevoegen')
                    ->assertSee('Foto toevoegen')
                    ->attach('image', 'tests\Browser\content\vleermuis.jpg')
                    ->type('title', 'Test afbeelding')
                    ->type('description', 'Dit is een test afbeelding')
                    ->press('Toevoegen')
                    ->visit('/gallery')
                    ->assertSee('Test afbeelding')
                    ->assertSee('Dit is een test afbeelding')
                    ->clickLink('Aanpassen')
                    ->assertSee('Afbeelding aanpassen')
                    ->type('title', 'Test afbeelding bewerkt')
                    ->type('description', 'Dit is een test afbeelding bewerkt')
                    ->press('Aanpassen')
                    ->visit('/gallery')
                    ->assertSee('Test afbeelding bewerkt')
                    ->assertSee('Dit is een test afbeelding bewerkt')
                    ->screenshot('galleryEdit')
                    ->press('Verwijderen');
        });
    }
    
    /**
     * Test the validation of the creation of a gallery item.
     */
    public function testValidation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/gallery')
                    ->assertSee('Foto toevoegen')
                    ->clickLink('Foto toevoegen')
                    ->assertSee('Foto toevoegen')
                    ->press('Toevoegen')
                    ->assertSee('The image field is required.')
                    ->assertSee('The title field is required.')
                    ->assertSee('The description field is required.')
                    ->screenshot('galleryValidation');
        });
    }
}
