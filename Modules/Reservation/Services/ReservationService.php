<?php

namespace Modules\Reservation\Services;

use App\Traits\Exporter;
use Illuminate\Http\Request;

use Modules\Reservation\Repositories\Interfaces\ReservationInterface;
use Illuminate\Support\Carbon;
use Modules\User\Repositories\Interfaces\UserInterface;

class ReservationService {

    use Exporter;

    public function __construct(protected ReservationInterface $reservationRepository, protected UserInterface $userInterface) {}

    public function reserve(Request $request) {

        $isWeekend = Carbon::now()->format('N') >= 6;

        $dateNowToString = Carbon::now()->toDateString();

        $reservationOpenOn = Carbon::parse($dateNowToString.'8:00');

        $reservationEndOn = Carbon::parse($dateNowToString.'16:00');

        if(!Carbon::now()->between($reservationOpenOn, $reservationEndOn) || $isWeekend) {
            return response()->json([
                'status' => false,
                'message' => 'Booking of room is only available on weekdays between 7am-4pm.'
            ], 401);
        }

        $this->reservationRepository->store($request->all());

        return response()->json();
    }

    public function getReservationByUserId(string $userId) {
        return $this->reservationRepository->findByKeyAndValue('user_id', $userId);
    }

    public function isDateAvailable($start, $end) {
        
        $this->reservationRepository->between('start', $start);
    }

    public function export(string $userId) {

        $getUser = $this->userInterface->show($userId);

        $reservationsByUserId = $this->getReservationByUserId($userId);

        $getTimeStamp = Carbon::now()->timestamp;

        $fileName = "{$getUser->name} Reservations - {$getTimeStamp}.csv";

        return $this->exportAsCsv($reservationsByUserId->get()->toArray(), $fileName);
    }
}