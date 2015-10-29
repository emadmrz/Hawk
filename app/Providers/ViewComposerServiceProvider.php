<?php

namespace App\Providers;

use App\Advantage;
use App\Repositories\EducationRepository;
use App\Repositories\ProfileProgressRepository;
use App\University;
use App\User;
use Illuminate\Http\Request;
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

        $this->composeSkill();

        $this->composeLatestPosts();

        $this->composeProfileProgress();

        view()->composer('shop.partials.headerMenu', function($view) {
            $shop = $view->getData()['shop'];
            $advantages = $shop->advantages()->lists('advantage_id')->toArray();
            $advantages_list = Advantage::get();
            $categories = $shop->products()->with('category')->groupBy('category_id')->get()->pluck('category.name','category.id');
            $view->with(['advantages_list'=>$advantages_list, 'advantages'=>$advantages, 'categories'=>$categories]);
        });
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
            $view->with(['biography'=>$biography, 'attachments'=>$attachments, 'role'=>$user->roles->first()->slug ]);
        });
    }

    private function composeMyArticles(){
        view()->composer('profile.partials.latestArticles', function($view) {
            $user = Auth::user();
            $articles = $user->articles()->latest()->take(5)->get();
            $view->with(['articles'=>$articles]);
        });
    }

    private function composeSkill(){
        view()->composer('profile.partials.skill', function($view) {
            $user = Auth::user();
            $skills = $user->skills()->with(
                'experiences',
                'experiences.files',
                'degrees',
                'degrees.files',
                'honors',
                'honors.files',
                'histories',
                'histories.files',
                'tags',
                'schedules'
            )->get();
            $view->with(['skills'=>$skills]);
        });
    }

    private function composeProfileProgress(){
        view()->composer('partials.profileProgress', function($view){
            $viewdata= $view->getData();
            if(isset($viewdata['userProfile'])){
                //it mean's this in not my profile
                $user = $viewdata['userProfile'];
//                $user = User::find($user_id)->first();
            }else{
                $user = Auth::user();
            }
            $profileProgressRepository = new ProfileProgressRepository();
            $progress_value = $profileProgressRepository->calculate($user);
            $view->with(['progress_value'=>$progress_value]);
        });
    }

    private function composeLatestPosts(){
        view()->composer('profile.partials.latestPosts', function($view){
            $user = Auth::user();
            $posts = $user->posts()->latest()->take(5)->get();
            $view->with(['posts'=>$posts]);
        });
    }
}
