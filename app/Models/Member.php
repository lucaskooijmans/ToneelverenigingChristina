<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class Member extends Authenticatable
    {
        use HasFactory, Notifiable;

        protected $fillable = [
            'name', 'email', 'password', 'phoneNumber', 'postalCode', 'houseNumber', 'street', 'city'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }
