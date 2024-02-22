<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repository\Customer\Auth\AuthCustomerService;
use App\Repository\Customer\Auth\ILoginCustomerInterface;
use App\Repository\Customer\Auth\ILogoutCustomerInterface;
use App\Repository\Customer\Auth\IRegisterCustomerInterface;
use App\Repository\Customer\Category\CategoryService;
use App\Repository\Customer\Category\IShowAllCategory;
use App\Repository\Customer\CustomerProfile\ICanShowMovieInterface;
use App\Repository\Customer\CustomerProfile\IClearAllHistoryInterface;
use App\Repository\Customer\CustomerProfile\IClearSingleHistoryInterface;
use App\Repository\Customer\CustomerProfile\IProfileInterface;
use App\Repository\Customer\CustomerProfile\IShowAllHistoeyInterface;
use App\Repository\Customer\CustomerProfile\IUpdateImageProfileInterface;
use App\Repository\Customer\CustomerProfile\ProfileService;
use App\Repository\Customer\Review\ICreateReviewInterface;
use App\Repository\Customer\Review\IDeleteReviewInterface;
use App\Repository\Customer\Review\IEditReviewInterface;
use App\Repository\Customer\Review\ReviewService;
use App\Repository\Customer\Search\ISearchByCategoryInterface;
use App\Repository\Customer\Search\ISearchByPaidOrFreeInterface;
use App\Repository\Customer\Search\SearchService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IRegisterCustomerInterface::class,AuthCustomerService::class);
        $this->app->bind(ILoginCustomerInterface::class,AuthCustomerService::class);
        $this->app->bind(ILogoutCustomerInterface::class,AuthCustomerService::class);
        $this->app->bind(IProfileInterface::class,ProfileService::class);
        $this->app->bind(IUpdateImageProfileInterface::class,ProfileService::class);
        $this->app->bind(IShowAllHistoeyInterface::class,ProfileService::class);
        $this->app->bind(IClearAllHistoryInterface::class,ProfileService::class);
        $this->app->bind(IClearSingleHistoryInterface::class,ProfileService::class);
        $this->app->bind(ICanShowMovieInterface::class,ProfileService::class);
        $this->app->bind(IShowAllCategory::class,CategoryService::class);
        $this->app->bind(ICreateReviewInterface::class,ReviewService::class);
        $this->app->bind(IEditReviewInterface::class,ReviewService::class);
        $this->app->bind(IDeleteReviewInterface::class,ReviewService::class);
        $this->app->bind(ISearchByCategoryInterface::class,SearchService::class);
        $this->app->bind(ISearchByPaidOrFreeInterface::class,SearchService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
