<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function view(User $user, Note $note): bool
    {
        return optional($note->user)->id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function update(User $user, Note $note): bool
    {
        return optional($note->user)->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function delete(User $user, Note $note): bool
    {
        return optional($note->user)->id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function restore(User $user, Note $note): bool
    {
        return optional($note->user)->id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return false;
    }


    /**
     * Determine whether the user can publish the model.
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function publish(User $user, Note $note): bool
    {
        return $user->is_publishable && optional($note->user)->id === $user->id;
    }


    /**
     * Determine whether the user can unpublish the model.
     * @param User $user
     * @param Note $note
     * @return bool
     */
    public function unpublish(User $user, Note $note): bool
    {
        return $user->is_publishable && optional($note->user)->id === $user->id;
    }
}
