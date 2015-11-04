<?php

namespace NpTS\Domain\Client\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use NpTS\Domain\Client\Models\VirtualServer;
use NpTS\Domain\Client\Models\Invoice;
use NpTS\Domain\Client\Models\Subscription;
use NpTS\Domain\HelpDesk\Models\Question;
use NpTS\Domain\Client\Repositories\Contracts\SubscriptionRepositoryContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * An user may have one or many VirtualServers.
     * @return Collection
     */
    public function virtualServers()
    {
        return $this->hasMany(VirtualServer::class)->get();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class , 'user_id')->get();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->get();
    }

    public function activeSubscriptions()
    {
        return app(SubscriptionRepositoryContract::class)->findActiveSubscriptionsByUserId($this->id);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->get();
    }

    public function getSignatureAttribute()
    {
        return $this->name.",  ".$this->email;
    }
}
