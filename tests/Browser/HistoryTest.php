<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class HistoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('/historie')
            ->assertSee('Historie')
            ->visit(route('history.create'))
            ->type('header', 'Header Test')
            ->type('optional_text_one', 'Koptekst Test')
            ->attach('image_path', 'tests\Browser\content\batsoup.jpeg')
            ->type('video_path', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->type('optional_text_two', 'Koptekst 2 Test')
            ->type('optional_footer', 'Footer Test')
            ->type('date', '04-10-2024')
            ->screenshot('historiescreenshot')
            ->check('milestone')
            ->check('contribution')
            ->press('Bevestig')
            ->assertSee('Header Test') 
            ->assertSee('Koptekst Test')
            ->screenshot('historiepagescreenshot')
            ->press('Verwijderen')
            ->assertDialogOpened('Are you sure?')
            ->acceptDialog();
        });
    }

    public function testExampleEdit(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('/historie')
            ->assertSee('Historie')
            ->visit(route('history.create'))
            ->type('header', 'Header Test')
            ->type('optional_text_one', 'Koptekst Test')
            ->attach('image_path', 'tests\Browser\content\batsoup.jpeg')
            ->type('video_path', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->type('optional_text_two', 'Koptekst 2 Test')
            ->type('optional_footer', 'Footer Test')
            ->type('date', '04-10-2024')
            ->screenshot('historiescreenshot')
            ->check('milestone')
            ->check('contribution')
            ->press('Bevestig')
            ->assertSee('Header Test') 
            ->assertSee('Koptekst Test')
            ->screenshot('historiepagescreenshot')
            
            ->clickLink('Aanpassen')
            ->type('header', 'Edit Header Test')
            ->type('optional_text_one', 'Edit Koptekst Test')
            ->attach('image_path', 'tests\Browser\content\batsoup2.jpg')
            ->type('video_path', 'https://www.youtube.com/watch?v=hd4cKFwm1cQ')
            ->type('optional_text_two', 'Edit Koptekst 2 Test')
            ->type('optional_footer', 'Edit Footer Test')
            ->type('date', '05-11-2025')
            ->uncheck('milestone')
            ->screenshot('historiescreenshot')
            ->press('Bevestig')
            ->assertSee('Edit Header Test') 
            ->assertSee('Edit Koptekst Test')
            ->screenshot('edithistoriepagescreenshot')
            ->press('Verwijderen')
            ->assertDialogOpened('Are you sure?')
            ->acceptDialog();
        });
    }

    public function testExampleDelete(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('/historie')
            ->assertSee('Historie')
            ->visit(route('history.create'))
            ->type('header', 'Header Test')
            ->type('optional_text_one', 'Koptekst Delete Test')
            ->attach('image_path', 'tests\Browser\content\batsoup.jpeg')
            ->type('video_path', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->type('optional_text_two', 'Koptekst 2 Test')
            ->type('optional_footer', 'Footer Test')
            ->type('date', '04-10-2024')
            ->screenshot('historiescreenshot')
            ->check('milestone')
            ->check('contribution')
            ->press('Bevestig')
            ->assertSee('Header Test') 
            ->assertSee('Koptekst Delete Test')
            ->screenshot('historiepagescreenshot')
            ->press('Verwijderen')
            ->assertDialogOpened('Are you sure?')
            ->acceptDialog()
            ->assertDontSee('Header Test'); // Assuming the deleted item is no longer visible
        });
    }
}
