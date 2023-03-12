<?php

namespace Modules\User\Repositories;

use App\Repository\BaseRepository;

use Modules\User\Entities\User;
use Modules\User\Repositories\Interfaces\UserInterface;

class UserRepository extends BaseRepository implements UserInterface {

    public function __construct() {
        parent::__construct(User::class);
    }
}