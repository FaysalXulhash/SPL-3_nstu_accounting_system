<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * User Role Type as ID
     */
    const TYPE_ADMIN = 1;
    const TYPE_REGISTRAR_OFFICER = 2;
    const TYPE_EXAM_CONTROLLER = 3;
    const TYPE_SUB_EXAM_CONTROLLER = 4;
    const TYPE_EXAM_BOARD_DIRECTOR = 5;
    const TYPE_ACCOUNTS_SECTION_OFFICER = 6;
    const TYPE_VICE_CHANCELLOR = 7;
    const TYPE_TREASURER = 8;
    const TYPE_ACCOUNTS_DIRECTOR = 9;
    const TYPE_DEPT_CHAIRMAN = 10;
    const TYPE_TEACHER = 11;
    const TYPE_STAFF = 12;
    const TYPE_USER = 13;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'role_id',
        'from',
        'designation_id',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasNot(array $roles)
    {
        return !in_array($this->role->code, $roles);
    }

    public function isAdmin()
    {
        return $this->role_id == User::TYPE_ADMIN;
    }

    public function isRegistrarOfficer()
    {
        return $this->role_id == User::TYPE_REGISTRAR_OFFICER;
    }

    public function isExamController()
    {
        return $this->role_id == User::TYPE_EXAM_CONTROLLER;
    }

    public function isSubExamController()
    {
        return $this->role_id == User::TYPE_SUB_EXAM_CONTROLLER;
    }

    public function isExamBoardDirector()
    {
        return $this->role_id == User::TYPE_EXAM_BOARD_DIRECTOR;
    }

    public function isAccountsSectionOfficer()
    {
        return $this->role_id == User::TYPE_ACCOUNTS_SECTION_OFFICER;
    }

    public function isVC()
    {
        return $this->role_id == User::TYPE_VICE_CHANCELLOR;
    }

    public function isTreasurer()
    {
        return $this->role_id == User::TYPE_TREASURER;
    }

    public function isAccountsDirector()
    {
        return $this->role_id == User::TYPE_ACCOUNTS_DIRECTOR;
    }

    public function isDeptChairman()
    {
        return $this->role_id == User::TYPE_DEPT_CHAIRMAN;
    }

    public function isTeacher()
    {
        return $this->role_id == User::TYPE_TEACHER;
    }

    public function isStaff()
    {
        return $this->role_id == User::TYPE_STAFF;
    }

    public function isUser()
    {
        return $this->role_id == User::TYPE_USER;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function from()
    {
        return $this->morphTo();
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
