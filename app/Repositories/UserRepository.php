<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
    * @var  string[]
    */
    protected $fieldSearchable = [
        'username',
        'password',
        'email',
        'name',
    ];

    /**
    * @return  string[]
    */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
    * @return  string
    */
    public function model(): string
    {
        return User::class;
    }
}
