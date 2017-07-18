<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::share('post_archives', $this->getPostArchive());
        View::share('categories', $this->getCategories());


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function getCategories()
    {
        $categories = \App\Category::all();
        return $categories;
    }

    private function getPostArchive()
    {
        $posts = DB::select("SELECT YEAR(created_at) year,
                                   MONTH(created_at) month,
                                   MONTHNAME(created_at) month_name,
                                   COUNT(*) post_count
                              FROM posts
                             GROUP BY YEAR(created_at), MONTH(created_at)
                             ORDER BY year DESC, month DESC");

        return $posts;

    }
}
