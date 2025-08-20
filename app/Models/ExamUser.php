<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class ExamUser extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table = 'exam_users';

    // 🔑 Spatie necesita saber el guard asociado
    protected string $guard_name = 'exam';

    protected $fillable = [
        'nickname',
        'name',
        'email',
        'password',
        'is_active',
        'last_login_at',
        'expires_at',
        'valid_for_days',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'expires_at'    => 'datetime',
        'is_active'     => 'boolean',
        'deleted_at'    => 'datetime',
    ];

    public function isAccountValid(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        if ($this->valid_for_days) {
            $calculatedExpiration = $this->created_at->addDays($this->valid_for_days);
            if (now()->greaterThan($calculatedExpiration)) {
                return false;
            }
        }

        return true;
    }
}
