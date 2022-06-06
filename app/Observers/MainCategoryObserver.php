<?php

namespace App\Observers;

use App\Models\main_category;

class MainCategoryObserver
{
    /**
     * Handle the main_category "created" event.
     *
     * @param  \App\Models\main_category  $main_category
     * @return void
     */
    public function created(main_category $main_category)
    {
        //
    }

    /**
     * Handle the main_category "updated" event.
     *
     * @param  \App\Models\main_category  $main_category
     * @return void
     */
    public function updated(main_category $main_category)
    {
        /* 
        Let the active for vendors under the same MainCategory 
        is the same as the active for maincateogy parent
        */
 
        $main_category->vendors()->update(['active'=>$main_category->active]); 
    }

    /**
     * Handle the main_category "deleted" event.
     *
     * @param  \App\Models\main_category  $main_category
     * @return void
     */
    public function deleted(main_category $main_category)
    {
        $main_category->vendors()->update(['category_id'=>0]);
    }

    /**
     * Handle the main_category "restored" event.
     *
     * @param  \App\Models\main_category  $main_category
     * @return void
     */
    public function restored(main_category $main_category)
    {
        //
    }

    /**
     * Handle the main_category "force deleted" event.
     *
     * @param  \App\Models\main_category  $main_category
     * @return void
     */
    public function forceDeleted(main_category $main_category)
    {
        //
    }
}
