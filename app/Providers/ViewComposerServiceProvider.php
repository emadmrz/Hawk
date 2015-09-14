<?php

namespace App\Providers;

use App\Repositories\EducationRepository;
use App\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('profile.partials.cover', function($view){
           $view->with(['user'=>Auth::user()]);
        });

        $this->composeEducation(new EducationRepository());

        $this->composeBiography();

        $this->composeMyArticles();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Created by Emad Mirzaie on 11/09/2015.
     * Education Form composer
     */
    private function composeEducation($educationRepository)
    {
        view()->composer('profile.partials.education', function($view) use ($educationRepository) {
            $user = Auth::user();
            $universities = University::lists('name','id');
            $statuses = $educationRepository->statuses();
            $degrees = $educationRepository->degrees();
            $educations = $user->educations()->with('university')->get();
            $view->with(['universities'=>$universities, 'statuses'=>$statuses, 'degrees'=>$degrees, 'educations'=>$educations]);
        });
    }

    private function composeBiography(){
        view()->composer('profile.partials.biography', function($view) {
            $user = Auth::user();
            $biography = $user->biography()->firstOrCreate(['user_id'=>$user->id]);
            $attachments = $biography->files;
            $view->with(['biography'=>$biography, 'attachments'=>$attachments]);
        });
    }

    private function composeMyArticles(){
        view()->composer('profile.partials.latestArticles', function($view) {
            $user = Auth::user();
            $articles = $user->articles()->latest()->take(5)->get();
            $view->with(['articles'=>$articles]);
        });
    }
}
