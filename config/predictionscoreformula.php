<?php

/*
 -- Formulas
 -- @author Louie Daliwan
*/
return [
    'bspi' => [
       'y1' => [0.242875171621555, -0.0509831167545037, -0.137396497063824, 0.029786390472177, 0.00420604643330126, 0.0342294796112141, 0.0788705282096166, 0.0518922947199071, 0.0457355966474312, -0.0341345677529339, -0.0850091060438013, -0.0902433102747671, -0.000453077714367096, 0.10, 0.715868870969844],
       'y2' => [-0.000910639402419791, 0.737966871699596, -0.0474151683678102, 0.0289149525665692, -0.0752003142187617, -0.0456978140176706, 0.0772796475448672, 0.0077449302750303, -0.00878603858986928, 0.0535964775322476, -0.104320999415548, 0.057518343208068, 0.0380672200301327, -0.07, 3.43407772439457],
       'y3' => [-0.162782550659685, 0.14871871258874, 2.19035645633213, 0.160117690031196, 0.464244720489719, -0.0574541881968092, 0.623530082270329, -0.0483834417929757, 0.0401545899302282, -0.138969229617026, -0.473564539720811, 0.000148202146890849, -0.0928965138173976, -0.25, 4.5192870733279],
       'y4' => [0.146274425502249, -0.119055309732243, 0.137329225069943, 1.07835940638075, -0.233789614235601, 0.180966089953278, -0.668120743534944, 0.112885158649817, -0.23219832951808, -0.105704944727668, -0.162348865463675, -0.189025280162997, 0.303559679896604, 0.75, 0.460440787306507],
       'y5' => [-0.00138250173526871, -0.00093005686969933, 0.120099890165183, -0.0130277078881061, 0.480534616781984, -0.0109954184202262, -0.0395669241859048, -0.00924099608057952, -0.0268055144884828, -0.0128723226963162, 0.06534173917686, 0.0229338997266178, 0.0225931379997454, -0.01, 11.1504429080271],
       'y6v' => [-0.6042, 4.8958, -15.583, 29],
       'y7' => [-0.00728707948739, 0.0396403420618311, 0.00739907329341833, 0.0165106069790848, -0.00566319468378947, -0.0344859434603172, 0.439994079371448, -0.0480447573187558, 0.0172451046449499, 0.0236186510705281, 0.0132026576063742, 0.0513402438210318, 0.0156348266188868, 0.00, 14.5851418709888],
       'y8' => [0.0361699686954698, -0.0302094487105092, -0.109900637273625, 0.0254267132262672, 0.0695811605732949, -0.0201332677003515, 0.0953230884666523, 0.343673645962791, -0.0399898493711012, 0.0741064413733662, -0.0799035431245399, -0.0257575639124945, -0.00946450578859672, 0.06, 16.8940867815778],
       'y9v' => [-0.4375, 3.2917, -10, 29],
       'y10' => [-0.0451394722900663, 0.165290818673936, -0.00257726147993948, 0.0657397198786032, -0.0766030397733567, -0.141575304179356, -0.327432538080435, 0.0820623339449619, 0.0466710422715835, 0.651561739571441, 0.025072220090086, 0.0267289270847614, -0.0154906372342603, 0.40, 19.3173242001528],
       'y11' => [0.0458570757696431, 0.00338249374264582, -0.00397895883619587, -0.0111380635776091, 0.100246847232668, 0.00520109630624964, -0.048812251925433,-0.028546879141536, -0.00287925303090118, 0.0504359819138728, 0.541241485352202, 0.00793395309537387, -0.0543258781794059, -0.06, 23.250892569199],
       'y12' => [0.0470838312639832, 0.0425057342605987, -0.0747705284707181, -0.0488000195562221, 0.0747320346157753, 0.0519125151438656, 0.108686780641554, 0.00790743111010677, -0.0226113172600003, 0.139494272097201, -0.0594366159821398, 0.287311514779368, -0.0440925834920165, -0.06, 23.5583507122555],
       'y13v' => [2.3438, -21.51, 84.375, -97],
       'y14' => [-0.0675378008252283, 0.496883862583138, -0.198823092104638, -0.0671839511341386, -0.0881315179672688, -0.0638483975554895, -0.0131138985480612, -0.17133146562038, 0.04218434490698, 0.705566885720301, 0.0455665013673148, 0.237266209360934, 0.0389802917913437, 1.24, 21.455497058005],
    ],
    'fmpi' => [
      'y1v' => [0.0783,  -0.6459, 0.3876,  12.787], //1 previous y6v
      'y2v' => [0.175, -2.25, 10.125,  -18.25,  10.2,  15], //2 previous y7v
      'y3v' => [-0.0301, 0.7991,  -7.6116, 30.982,  -31.429], //3 previous y8v
      'y4v' => [0.1161,  -1.6681, 7.1174,  9.148], //4 previous y9v
      'y5v' => [-0.2628, 3.3462,  -15.16,  29.308,  -1.5385], //5 previous y10v
      'y6v' => [0.2411,  -2.7798, 10.473,  -12.649, 20.214],//6 previous y11v
      'y7v' => [0.0156,  -0.4167, 4.0625,  -16.583, 46], //7 previous y12v
      'y8v' => [0.0812,  -1.6753, 12.217,  -36.715, 39.167], //8 previous y1v
      'y9v' => [-0.65, 7.2917,  -27.333, 40.708,  -20.017, 3], //9 previous y2v
      'y10v' => [0.04957,  -5.8846, 25.266,  -43.955, 29.948], //10 previous y3v
      'y11v' => [-0.0581,  1.2136,  -7.4631, 9.2143,  30.686], // 11 previous y4v
      'y12v' => [0.4559, -5.6445, 24.159,  -40.425, 29.868], //12 previous y5
      'y13v' => [0.0142, -0.3352, 2.9091,  -10.5, 37.273],
      'y14v' => [0.0417, -0.5833, 2.9583,  -5.4167, 30],
    ],
    'pmpi' => [
      'y1v' => [0.0503, -1.1156, 8.0571, -19.595, 16.948],
      'y2v' => [0.2693, -3.8139, 17.022, -20.765, 7.3349],
      'y3' => [0.140766078300687, -0.570933909524777, 3.21113800780747, -0.245214427460295, -0.492041818748275, 0.198047612916796, 0.052462080524732, 0.0935338911929122,-0.1020951322, 0.209106243654791, 0.329210648704361,0.143014069645861, -0.139598733387647, 0.1607342399, 3.12704678731067],
      'y4v' => [-0.0171, 0.4583, -4.346, 17.292, -25.842, 20],
      'y5' => [-0.28057371617618, -0.6924985278967, -1.20941275584385, 0.529244705093636, 2.30626878196098, 0.665209497906583, 0.819367404765924, -0.426872659900973, 0.118587066645214, -1.35012684912262, -0.362882622128618, 0.417748163320779, -0.0357385265733838, 0.15371645, 6.83342618385822],
      'y6v' => [0.0579, -1.2255, 7.9223, -14756, 8.0963],
      'y7v' => [0.5774, -6.605, 25.54, -35.162, 19.022],
      'y8' => [0.437492948614463, -0.194240396141708, -0.30140288294119, 0.203799770350448, 0.284202561881874, -0.6265614114629, -0.564726180424598, 1.75952568948125, 0.0930529449337366, -0.196819475801732, -0.246899665013694, 0.0928995646095227, -0.0377020537087583, 0.2084157825, 1.61447727766538],
      'y9' => [0.240212388864952, -1.68826545508371, -0.155085250557043, 0.657187389996286, -0.217950146926666, 0.0643843268947657, -0.123096941879949, 0.580853994503451, 0.882425774896083, -2.64654828171787, 0.324852501464339, 0.869087269791947, -0.0782217869588474, 0.4099581843, 5.90627249697715],
      'y10' => [-0.107836606142825, 0.385684857336826, 0.164358530607005, 0.0694130033015585, -0.810418354736305, -0.0436533651177157, -1.72795434891405, 0.246235896644357, 0.672146720782746, 2.96006983029826, 0.524321791575705, -0.322663837218225, -0.110647265499983, -0.515208909, 4.56647853268541],
      'y11v' => [0.94, -9.3276, 26.66, -18.247, 5.0919],
      'y12v' => [0.0166, -0.4306, 3.5244, -7.6877, 8.336],
      'y13v' => [0.3989, -4.6052, 18.924, -29.33, 22.96],
      'y14v' => [-0.1777, 3.2002, -16.598, 28.053, 6.7739],
    ],
    'hrpi' => [
      'y1' => [0.466211036929885, -0.0783160829761061, -0.0490920921874216, 0.0103695072883733, -0.000644105171771821, -0.0211467346949121, 0.0756297795722468, 0.0595516925433733, -0.00919702708255443, -0.0886036881342818, -0.0197930415170269, 0.00463166939788807, -0.0373084073153104, 0.04507817653, 0.617012157334566],
      'y2' => [-0.0612651518383509, 0.624838137821501, -0.0328833631606754, 0.00113146114995922, -0.0165772158038639, -0.0143444106424999, 0.0620348283313841, 0.0593965239598865, 0.0632485834848148, -0.169663173895611, 0.117306664150542, 0.0259657970131006, -0.0542994358409031, 0.2483951704, 0.297445192712451],
      'y3' => [-0.0140371809161638, -0.10570745664468, 1.40390617733995, -0.059186589225724, 0.119245464360513, 0.0216888586765246, -0.115198076245407, 0.0570042935520112, -0.0038981706003206, -0.0598024013772113, 0.0590483273084082, 0.0349213897168066, -0.0735365831037985, 0.05529471023, 3.62165242552072],
      'y4v' => [-0.0266, 0.6016, -4.5833, 13.844, -13.742, 8],
      'y5v' => [1.2141, -12.079, 34.842, -24.845, 17.096],
      'y6' => [0.0109049820871803, -0.00719990424018249, -0.11047801427464, -0.00854278713712614, -0.0246023488890715, 0.21258305890723, 0.0958349409504157, 0.0293537053245213,-0.0385615016814575, 0.00242133162720419, -0.0257534044645774, -0.00477786087486563, 0.0276943480172742, 0.0197780694, 10.6774938195796],
      'y7v' => [-0.1417, 1.625, -6.375, 9.875, -4.9833, 16],
      'y8v' => [-0.0043, 0.0988, -0.7658, 2.3309, -2.3197, 16],
      'y9v' => [0.051, -0.5355, 1.4075, 17.829],
      'y10' => [0.0601983574639425, -0.0555280547627099, 0.132432966728964, 0.0313998433697269, -0.0808539353481585, -0.0125747998902615, -0.174451646512862, 0.0147889291391758, -0.0151560895476971, 0.536836930609454, -0.041693718244658, -0.00749368506654732, -0.0333268680790853, 0.08389205769, 17.6836870859837],
      'y11v' => [0.1826, -1.4784, 2.7706, 0.8312, 22.744],
      'y12v' => [-0.0373, 0.3131, -1.0174, 1.0565, 23],
      'y13v' => [-0.0351, 0.3854, -1.1611, 0.96, 26.992],
      'y14v' => [0.1815, -0.5662, 27.286],
    ],
];
