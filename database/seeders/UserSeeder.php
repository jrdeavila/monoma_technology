<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Src\BoundedContext\User\Application\CreateUserUseCase;
use Src\BoundedContext\User\Infrastructure\Repository\MongoUserRepository;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = new MongoUserRepository();
        $useCase = new CreateUserUseCase($repository);

        $useCase->__invoke(
            'tester',
            Hash::make('PASSWORD'),
            'manager',
        );
        $useCase->__invoke(
            'tester2',
            Hash::make('PASSWORD'),
            'manager',
        );
        $useCase->__invoke(
            'agtester',
            Hash::make('PASSWORD'),
            'agent',
        );
        $useCase->__invoke(
            'agtester2',
            Hash::make('PASSWORD'),
            'agent',
        );
    }
}
