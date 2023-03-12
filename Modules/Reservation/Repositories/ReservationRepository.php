<?php

namespace Modules\Reservation\Repositories;

use App\Repository\BaseRepository;
use Modules\Reservation\Repositories\Interfaces\ReservationInterface;
use Modules\Reservation\Entities\Reservation;

class ReservationRepository extends BaseRepository implements ReservationInterface {

    public function __construct() {
        parent::__construct(Reservation::class);
    }
}