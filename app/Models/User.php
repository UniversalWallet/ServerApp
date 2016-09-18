<?php

namespace App\Models;

use App\Models\Support\BidderInterface;
use App\Models\Support\BidderTrait;
use App\Models\Support\ValidatingTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property boolean $is_confirmed
 * @property string $password
 * @property string $phone
 * @property string $company_name
 * @property string $company_position
 * @property string $company_inn
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsConfirmed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCompanyName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCompanyPosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCompanyInn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bid[] $bids
 */
class User extends Authenticatable implements BidderInterface
{
    use Notifiable, ValidatingTrait, BidderTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'company_name', 'company_position', 'company_inn', 'is_confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    protected static $ruleset = [
        "register" => [
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required',
            'password_confirmation' => 'required|same:password',
            'name'         => 'required',
            'phone'        => 'required',
            'company_name' => 'required',
            'company_position' => 'required',
            'company_inn'  => 'required|numeric'
        ],
        "store" => [
            'email'        => 'required|email|unique:users,email',
            'name'         => 'required',
            'phone'        => 'required',
            'company_name' => 'required',
            'company_position' => 'required',
            'company_inn'  => 'required|numeric',
            'is_confirmed' => 'boolean'
        ],
        "update" => [
            'email'        => 'required|email|unique:users,email',
            'name'         => 'required',
            'phone'        => 'required',
            'company_name' => 'required',
            'company_position' => 'required',
            'company_inn'  => 'required|numeric',
            'is_confirmed' => 'boolean'
        ]
    ];

    protected static $validationMessages = [
        'email.required' => 'Необходимо заполнить email.',
        'email.email'    => 'Необходимо ввести верный email.',
        'email.unique'   => 'Уже существует пользователь с таким email.',
        'name.required'  => 'Необходимо заполнить ФИО.',
        'phone.required' => 'Необходимо заполнить телефон.',
        'company_name.required'   => 'Необходимо заполнить название компании.',
        'company_position.required' => 'Необходимо заполнить должность в компании.',
        'company_inn.required' => 'Необходимо заполнить ИНН компании.',
        'company_inn.numeric' => 'ИНН должен быть числом.',
        'is_confirmed.boolean' => 'Подтверждение должно быть равно 1 или 0.'
    ];


}
