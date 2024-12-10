<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Blog\Category as BlogPostCategory;
use App\Models\Blog\Post as BlogPost;
use App\Models\Delivery;
use App\Models\DeliveryUpdate;
use App\Models\Dispatcher;
use App\Models\Driver;
use App\Policies\ActivityPolicy;
use App\Policies\Blog\CategoryPolicy as BlogPostCategoryPolicy;
use App\Policies\Blog\PostPolicy as BlogPostPolicy;
use App\Policies\DeliveryPolicy;
use App\Policies\DeliveryUpdatePolicy;
use App\Policies\DispatcherPolicy;
use App\Policies\DriverPolicy;
use App\Policies\ExceptionPolicy;
use BezhanSalleh\FilamentExceptions\Models\Exception;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Activity::class => ActivityPolicy::class,
        BlogPostCategory::class => BlogPostCategoryPolicy::class,
        BlogPost::class => BlogPostPolicy::class,
        Exception::class => ExceptionPolicy::class,
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        Delivery::class => DeliveryPolicy::class,
        DeliveryUpdate::class => DeliveryUpdatePolicy::class,
        Dispatcher::class => DispatcherPolicy::class,
        Driver::class => DriverPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
