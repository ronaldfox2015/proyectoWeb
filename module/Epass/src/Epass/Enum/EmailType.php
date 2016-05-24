<?php

namespace Epass\Enum;

use Epass\Common\Enum;

class EmailType extends Enum
{

    const WITH_TEMPLATE = '1';
    const EXCEPTION = '2';
    const WITHOUT_TEMPLATE = '3';
    const WITH_TEMPLATE_RECEIVE = '4';

}
