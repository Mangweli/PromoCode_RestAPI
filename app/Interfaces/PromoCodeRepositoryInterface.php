<?php

namespace App\Interfaces;

interface PromoCodeRepositoryInterface {
    public function getAllPromocodes(int $pagination);
    public function getPromocodeFilteredByKey(string $key, $value, int $pagination);
    public function createPromoCode(array $promoDetails);
    public function setPromoCodeDetails($promoCodeName, array $promoDetails);
    public function checkPromoValidity($promoCodeName, $origin=null, $destination=null);
}
