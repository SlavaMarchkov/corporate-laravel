<?php

namespace App\Policies;

use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function save(User $user)
    {
        return $user->canDo('ADD_ARTICLE');
    }
    
    public function edit(User $user)
    {
        return $user->canDo('UPDATE_ARTICLE');
    }
    
    public function destroy(User $user, Article $article)
    {
        // удалять запись может только тот пользователь,
        // который имеет права на удалени и который создал эту статью (user_id в таблице articles)
        return ($user->canDo('DELETE_ARTICLE') && ($user->id == $article->user_id));
    }
}
