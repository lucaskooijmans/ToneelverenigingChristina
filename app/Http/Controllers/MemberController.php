<?php

    namespace App\Http\Controllers;

    use App\Models\Member;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class MemberController extends Controller
    {
        public function index(){
            return view('member.register');
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:members',
                'phoneNumber' => 'min:10',
                'postalCode' => 'required|min:6|max:7', // dit nog veranderen naar regex
                'houseNumber' => 'required',
                'street' => 'required',
                'city' => 'required',
                'password' => 'required|min:8',
            ]);

            $member = Member::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phoneNumber' => $validatedData['phoneNumber'],
                'postalCode' => $validatedData['postalCode'],
                'houseNumber' => $validatedData['houseNumber'],
                'street' => $validatedData['street'],
                'city' => $validatedData['city'],
                'password' => bcrypt($validatedData['password']),
            ]);

            $data = [
                'name' => $member->name,
                'email' => $member->email,
                'phoneNumber' => $member->phoneNumber
            ];

            // Stuur een e-mail naar de MAIL_FROM_ADDRESS met de alert template
            Mail::send('emails.member-registration-alert', ['data' => $data], function($message) use ($data) {
                $message->to(config('mail.from.address'))->subject('Nieuwe inschrijving');
                $message->from(config('mail.from.address'));
            });

            // Stuur een bevestigingsmail naar het lid met de confirmation template
            Mail::send('emails.member-registration-confirmation', ['data' => $data], function($message) use ($data) {
                $message->to($data['email'])->subject('Inschrijving bij Toneelvereniging Christina succesvol');
                $message->from(config('mail.from.address'));
            });

            session()->flash('success', 'Bedankt voor de inschrijving! U ontvangt zo snel mogelijk een bevestigingsmail.');

            return redirect()->back();
        }
    }
