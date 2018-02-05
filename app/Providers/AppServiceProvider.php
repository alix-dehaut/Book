<?php

namespace App\Providers;

use App\Score;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;

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

        //on va etendre ici les regles de la classe Validator
         Validator::extend('uniqueVoteIp', function ($attribute, $value, $parameters, $validator) {
            dump($value);
            dump($parameters);
            $count= Score::where('book_id', $value)->where('IP', $parameters)->count();
            dump($count);
            if($count>0){
                return false;
            };
            return true;
       });
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
}
