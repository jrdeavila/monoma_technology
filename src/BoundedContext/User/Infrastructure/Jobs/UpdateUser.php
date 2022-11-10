<?php

namespace Src\BoundedContext\User\Infrastructure\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Src\BoundedContext\User\Application\UpdateUserUseCase;
use Src\BoundedContext\User\Domain\Contract\UserRepositoryContract;
use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserLastLogin;
use Src\BoundedContext\User\Infrastructure\Repository\MongoUserRepository;

class UpdateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private User $user;
    private UserRepositoryContract $repository;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, UserRepositoryContract $repository)
    {
        $this->user = $user;
        $this->repository = $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $updateUser = new UpdateUserUseCase($this->repository);
        $lastlogin = new UserLastLogin(new \DateTime('now'));
        $this->user->setLast_login($lastlogin);
        $updateUser->__invoke($this->user->getId(), $this->user);
    }
}
