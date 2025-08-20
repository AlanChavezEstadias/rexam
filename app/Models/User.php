<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'created_by',
        'nickname',
        'name',
        'email',
        'password',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
            'deleted_at'        => 'datetime',
        ];
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            if (! $user->isForceDeleting()) {
                $user->syncRoles([]);
                DB::table('sessions')->where('user_id', $user->id)->delete();
            }
        });
    }

    public function getRouteKey()
    {
        return Hashids::connection()->encode($this->getKey());
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $id = Hashids::connection()->decode($value);
        if (! empty($id)) {
            return $this->whereKey($id[0])->firstOrFail();
        }
        return null;
    }
}
