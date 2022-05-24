<?php

use Best\Pro\TrafficLight;

return [
    TrafficLight::FAILED => ':name has less than expected efficiency practices in place. Requires considerable overhaul and/or introduction of new efficiency process and/or manuals.',
    TrafficLight::CRITICAL => ':name has less than expected efficiency practices in place. Requires considerable overhaul and/or introduction of new efficiency process and/or manuals.', 
    TrafficLight::CORRECTIVE_ACTION => ':name is generally in a stable position with desired efficiency elements in place. Streamlining and introduction of new processes and/or manuals is recommended. Recommends further detailed diagnostics.',
    TrafficLight::NORMAL => ':name is in a very good shape. :appcode elements are well implemented with effective forms, processes, policies and structured systems in place. Recommends that a validation of findings through engagements to be executed.',
    TrafficLight::RED_LIGHT => ':name has less than expected efficiency practices in place. Requires considerable overhaul and/or introduction of new efficiency process and/or manuals.',
    TrafficLight::AMBER_LIGHT => ':name is generally in a stable position with desired efficiency elements in place. Streamlining and introduction of new processes and/or manuals is recommended. Recommends further detailed diagnostics.',
    TrafficLight::GREEN_LIGHT => ':name is in a very good shape. :appcode elements are well implemented with effective forms, processes, policies and structured systems in place. Recommends that a validation of findings through engagements to be executed.',
];
