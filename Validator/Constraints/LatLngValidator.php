<?php

namespace Oh\GoogleMapFormTypeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class LatLngValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $latitude = isset($value['latitude']) ? $value['latitude'] : $value['lat'];
        $longitude = isset($value['longitude']) ? $value['longitude'] : $value['lng'];

        if (!preg_match('/^[0-9\-\.]+$/', $latitude, $matches) || !preg_match('/^[0-9\-\.]+$/', $longitude, $matches)) {
            $this->context->addViolation($constraint->message, array('%latitude%' => (float)$latitude, '%longitude%' => (float)$longitude));
            return false;
        }
        if($latitude > 90 || $latitude < -90 || $longitude > 180 || $longitude < -180)
        {
            $this->context->addViolation($constraint->message, array('%latitude%' => (float)$latitude, '%longitude%' => (float)$longitude));
            return false;
        }

        return true;
    }
}
