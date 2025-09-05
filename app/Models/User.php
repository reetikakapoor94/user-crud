<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    // Map timestamps to spec
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'modified_at';
    public $timestamps = true;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    protected $hidden = ['password'];

    // ---- Factory methods (as requested) ----
    public static function createUser(array $data): self
    {
        $data['password'] = Hash::make($data['password']);
        return self::create($data);
    }

    public static function updateUser(int $id, array $data): bool
    {
        $user = self::findOrFail($id);

        if (isset($data['password']) && $data['password'] !== '') {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // don’t overwrite with empty
        }

        return $user->update($data);
    }

    public static function deleteUser(int $id): bool
    {
        $user = self::findOrFail($id);
        return (bool) $user->delete();
    }

    public static function listUsers(int $perPage = 5, ?string $search = null): LengthAwarePaginator
    {
        $query = self::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->orderByDesc('id')->paginate($perPage)->withQueryString();
    }
}
