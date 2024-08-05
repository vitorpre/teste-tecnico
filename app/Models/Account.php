<?php

namespace App\Models;

use App\Exceptions\NotEnoughBalanceException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getAccountByNumber(int $accountNumber): ?Account
    {
        return self::where("number", $accountNumber)
            ->first();
    }

    public static function create(int $number, float $balance): ?Account
    {
        $account = new Account([
            "number" => $number,
            "balance" => $balance
        ]);

        if(!$account->save()) {
            throw new \Exception("Não foi possível criar a conta");
        }

        return self::getAccountByNumber($number);
    }

    /**
     * Check if account has enough balance for the transaction
     * @param $value
     * @return bool
     */
    public function hasEnoughBalance($value): bool
    {
        return ($this->balance + $value) > 0;
    }

    /**
     * Update balance with given value
     * @param $value
     * @return bool
     * @throws NotEnoughBalanceException
     */
    public function updateBalance($value): bool
    {
        if(!$this->hasEnoughBalance($value)) {
            throw new NotEnoughBalanceException("Saldo insuficiente");
        }

        $this->balance = $this->balance + $value;
        return $this->save();
    }
}
