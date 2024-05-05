<?php

namespace App\Http\Constants;

class DoctorQualificationConstants{
    const MBChB = 0;
    const MBBS = 1;
    const LRCP = 2;
    const BSc = 3;
    const MD_and_PhD = 4;


    const QUALIFICATION = [
        self::MBChB => 'MBChB',
        self::MBBS => 'MBBS',
        self::LRCP => 'LRCP',
        self::BSc => 'BSc',
        self::MD_and_PhD => 'MD_and_PhD',
    ];
}
