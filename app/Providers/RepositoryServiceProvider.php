<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Group\GroupInterface;
use App\Repositories\Group\GroupRepository;
use App\Repositories\ChangeEmailRequest\ChangeEmailRequestInterface;
use App\Repositories\ChangeEmailRequest\ChangeEmailRequestRepository;
use App\Repositories\Announcement\AnnouncementInterface;
use App\Repositories\Announcement\AnnouncementRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserInterface::class, UserRepository::class);
        $this->app->singleton(GroupInterface::class, GroupRepository::class);
        $this->app->singleton(AnnouncementInterface::class, AnnouncementRepository::class);
        $this->app->singleton(ChangeEmailRequestInterface::class, ChangeEmailRequestRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
