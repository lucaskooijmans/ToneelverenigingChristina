<?php

    namespace Tests\Browser;

    use App\Models\User;
    use Illuminate\Foundation\Testing\DatabaseMigrations;
    use Laravel\Dusk\Browser;
    use Tests\DuskTestCase;

    class TicketExportTest extends DuskTestCase
    {

        public function testTicketExport()
        {
            $this->browse(function (Browser $browser) {
                $browser->loginAs(User::find(1)) // Log in as admin
                ->visit('/performances/1/export-tickets')
                ->assertSee('Exporteer verkochte tickets naar CSV')
                ->clickLink('Exporteer verkochte tickets naar CSV') // Click the export button
                ->pause(2000); // Wait for the file to download

                $browser->assertPathIs('/performances/1/export-tickets');
            });
        }
    }
