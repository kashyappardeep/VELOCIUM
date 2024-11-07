<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'prefix',
        'name',
        'email',
        'phone',
        'withdrawable',
        'staking_balance',
        'direct_balance',
        'level_balance',
        'royalty_balance',
        'total_investment',
        'wallet_address',
        'password',
        'referal_code',
        'referal_by',
        'type',
        'gender',
        'activation_balance',
        'team_business'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //    
    public function claimHistories()
    {
        return $this->hasMany(TransactionHistory::class);
    }
    public function Referral()
    {
        return $this->hasMany(TransactionHistory::class, 'by', 'id');
    }
    public function investmentHistory()
    {
        return $this->hasMany(InvestmentHistory::class);
    }
}
