<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsuranceType;
use App\Models\InsuranceLabelFee;
use App\Models\Discriminatory;
use App\Models\MacLocality;
use App\Models\Gender;

class ProcedureDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedureInsuranceTypes = [
            [
                'description' => 'Medicare',
                'insuranceLabelFees' => [
                    ['description' => 'Non facility price'],
                    ['description' => 'Facility price'],
                    ['description' => 'Non facility limiting charge'],
                    ['description' => 'Facility limiting charge']
                ]
            ],
            [
                'description' => 'Medicaid',
                'insuranceLabelFees' => [
                    ['description' => 'Facility rate'],
                    ['description' => 'Non facility rate']
                ]
            ],
        ];

        foreach ($procedureInsuranceTypes as $insuranceType) {
            $procedureInsuranceType = InsuranceType::firstOrCreate([
                'description' => $insuranceType['description']
            ], [
                'description' => $insuranceType['description']
            ]);

            foreach ($insuranceType['insuranceLabelFees'] as $insuranceLabelFee) {
                InsuranceLabelFee::firstOrCreate([
                    'description'       => $insuranceLabelFee['description'],
                    'insurance_type_id' => $procedureInsuranceType->id
                ], [
                    'description'       => $insuranceLabelFee['description'],
                    'insurance_type_id' => $procedureInsuranceType->id
                ]);
            }
        }

        $discriminatories = [
            ['description' => 'Greater or equal'],
            ['description' => 'Smaller or equal'],
            ['description' => 'Range']
        ];

        foreach ($discriminatories as $discriminatory) {
            Discriminatory::firstOrCreate($discriminatory);
        }

        $genders = [
            ['description' => 'Female'],
            ['description' => 'Male'],
            ['description' => 'Both']
        ];

        foreach ($genders as $gender) {
            Gender::firstOrCreate($gender);
        }

        $procedureMacLocalities = [
            [
                "mac"             => "10112",
                "locality_number" => "00",
                "state"           => "ALABAMA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "02102",
                "locality_number" => "01",
                "state"           => "ALASKA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "03102",
                "locality_number" => "00",
                "state"           => "ARIZONA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "07102",
                "locality_number" => "13",
                "state"           => "ARKANSAS",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "26",
                "state"           => "CALIFORNIA",
                "fsa"             => "LOS ANGELES-LONG BEACH-ANAHEIM (ORANGE CNTY)",
                "counties"        => "ORANGE"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "18",
                "state"           => "",
                "fsa"             => "LOS ANGELES-LONG BEACH-ANAHEIM (LOS ANGELES CNTY)",
                "counties"        => "LOS ANGELES"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "52",
                "state"           => "",
                "fsa"             => "SAN FRANCISCO-OAKLAND-BERKELEY (MARIN CNTY)",
                "counties"        => "MARIN"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "07",
                "state"           => "",
                "fsa"             => "SAN FRANCISCO-OAKLAND-BERKELEY (ALAMEDA/CONTRA COSTA CNTY)",
                "counties"        => "ALAMEDA AND CONTRA COSTA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "05",
                "state"           => "",
                "fsa"             => "SAN FRANCISCO-OAKLAND-BERKELEY (SAN FRANCISCO CNTY)",
                "counties"        => "SAN FRANCISCO"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "06",
                "state"           => "",
                "fsa"             => "SAN FRANCISCO-OAKLAND-BERKELEY (SAN MATEO CNTY)",
                "counties"        => "SAN MATEO"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "09",
                "state"           => "",
                "fsa"             => "SAN JOSE-SUNNYVALE-SANTA CLARA (SANTA CLARA CNTY)",
                "counties"        => "SANTA CLARA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "51",
                "state"           => "",
                "fsa"             => "NAPA",
                "counties"        => "NAPA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "53",
                "state"           => "",
                "fsa"             => "VALLEJO",
                "counties"        => "SOLANO"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "54",
                "state"           => "",
                "fsa"             => "BAKERSFIELD",
                "counties"        => "KERN"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "55",
                "state"           => "",
                "fsa"             => "CHICO",
                "counties"        => "BUTTE"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "56",
                "state"           => "",
                "fsa"             => "FRESNO",
                "counties"        => "FRESNO"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "57",
                "state"           => "",
                "fsa"             => "HANFORD-CORCORAN",
                "counties"        => "KINGS"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "58",
                "state"           => "",
                "fsa"             => "MADERA",
                "counties"        => "MADERA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "59",
                "state"           => "",
                "fsa"             => "MERCED",
                "counties"        => "MERCED"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "60",
                "state"           => "",
                "fsa"             => "MODESTO",
                "counties"        => "STANISLAUS"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "61",
                "state"           => "",
                "fsa"             => "REDDING",
                "counties"        => "SHASTA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "62",
                "state"           => "",
                "fsa"             => "RIVERSIDE-SAN BERNARDINO-ONTARIO",
                "counties"        => "SAN BERNARDINO, RIVERSIDE"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "63",
                "state"           => "",
                "fsa"             => "SACRAMENTO-ROSEVILLE-FOLSOM",
                "counties"        => "SACRAMENTO, PLACER, YOLO, EL DORADO"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "64",
                "state"           => "",
                "fsa"             => "SALINAS",
                "counties"        => "MONTEREY"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "65",
                "state"           => "",
                "fsa"             => "SAN JOSE-SUNNYVALE-SANTA CLARA (SAN BENITO CNTY)",
                "counties"        => "SAN BENITO"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "66",
                "state"           => "",
                "fsa"             => "SANTA CRUZ-WATSONVILLE",
                "counties"        => "SANTA CRUZ"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "67",
                "state"           => "",
                "fsa"             => "SANTA ROSA-PETALUMA",
                "counties"        => "SONOMA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "68",
                "state"           => "",
                "fsa"             => "STOCKTON",
                "counties"        => "SAN JOAQUIN"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "69",
                "state"           => "",
                "fsa"             => "VISALIA",
                "counties"        => "TULARE"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "70",
                "state"           => "",
                "fsa"             => "YUBA CITY",
                "counties"        => "SUTTER, YUBA"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "71",
                "state"           => "",
                "fsa"             => "EL CENTRO",
                "counties"        => "IMPERIAL"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "72",
                "state"           => "",
                "fsa"             => "SAN DIEGO-CHULA VISTA-CARLSBAD",
                "counties"        => "SAN DIEGO"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "73",
                "state"           => "",
                "fsa"             => "SAN LUIS OBISPO-PASO ROBLES",
                "counties"        => "SAN LUIS OBISPO"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "74",
                "state"           => "",
                "fsa"             => "SANTA MARIA-SANTA BARBARA",
                "counties"        => "SANTA BARBARA"
            ],
            [
                "mac"             => "01182",
                "locality_number" => "17",
                "state"           => "",
                "fsa"             => "OXNARD-THOUSAND OAKS-VENTURA",
                "counties"        => "VENTURA"
            ],
            [
                "mac"             => "01112",
                "locality_number" => "75",
                "state"           => "",
                "fsa"             => "REST OF STATE*",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "04112",
                "locality_number" => "01",
                "state"           => "COLORADO",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "13102",
                "locality_number" => "00",
                "state"           => "CONNECTICUT",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "12102",
                "locality_number" => "01",
                "state"           => "DELAWARE",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "12202",
                "locality_number" => "01",
                "state"           => "DISTRICT OF COLUMBIA",
                "fsa"             => "DC + MD/VA SUBURBS",
                "counties"        => "DISTRICT OF COLUMBIA; ALEXANDRIA CITY, ARLINGTON, FAIRFAX, FAIRFAX CITY, FALLS CHURCH CITY IN VIRGINIA; MONTGOMERY AND PRINCE GEORGE'S IN MARYLAND"
            ],
            [
                "mac"             => "09102",
                "locality_number" => "03",
                "state"           => "FLORIDA",
                "fsa"             => "FORT LAUDERDALE",
                "counties"        => "BROWARD, COLLIER, INDIAN RIVER, LEE, MARTIN, PALM BEACH, AND ST. LUCIE"
            ],
            [
                "mac"             => "09102",
                "locality_number" => "04",
                "state"           => "",
                "fsa"             => "MIAMI",
                "counties"        => "DADE AND MONROE"
            ],
            [
                "mac"             => "09102",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "10212",
                "locality_number" => "01",
                "state"           => "GEORGIA",
                "fsa"             => "ATLANTA",
                "counties"        => "BUTTS, CHEROKEE, CLAYTON, COBB, DEKALB, DOUGLAS, FAYETTE, FORSYTH, FULTON, GWINNETT, HENRY, NEWTON, PAULDING, ROCKDALE AND WALTON"
            ],
            [
                "mac"             => "10212",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "01212",
                "locality_number" => "01",
                "state"           => "HAWAII/GUAM",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "02202",
                "locality_number" => "00",
                "state"           => "IDAHO",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "06102",
                "locality_number" => "16",
                "state"           => "ILLINOIS",
                "fsa"             => "CHICAGO",
                "counties"        => "COOK "
            ],
            [
                "mac"             => "06102",
                "locality_number" => "12",
                "state"           => "",
                "fsa"             => "EAST ST. LOUIS",
                "counties"        => "BOND, CALHOUN, CLINTON, JERSEY, MACOUPIN, MADISON, MONROE, MONTGOMERY, RANDOLPH, ST. CLAIR AND WASHINGTON"
            ],
            [
                "mac"             => "06102",
                "locality_number" => "15",
                "state"           => "",
                "fsa"             => "SUBURBAN CHICAGO",
                "counties"        => "DUPAGE, KANE, LAKE AND WILL"
            ],
            [
                "mac"             => "06102",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "08102",
                "locality_number" => "00",
                "state"           => "INDIANA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "05102",
                "locality_number" => "00",
                "state"           => "IOWA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "05202",
                "locality_number" => "00",
                "state"           => "KANSAS",
                "fsa"             => "STATEWIDE*",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "15102",
                "locality_number" => "00",
                "state"           => "KENTUCKY",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "07202",
                "locality_number" => "01",
                "state"           => "LOUISIANA",
                "fsa"             => "NEW ORLEANS",
                "counties"        => "JEFFERSON, ORLEANS, PLAQUEMINES AND ST. BERNARD"
            ],
            [
                "mac"             => "07202",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "14112",
                "locality_number" => "03",
                "state"           => "MAINE",
                "fsa"             => "SOUTHERN MAINE",
                "counties"        => "CUMBERLAND AND YORK"
            ],
            [
                "mac"             => "14112",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "12302",
                "locality_number" => "01",
                "state"           => "MARYLAND",
                "fsa"             => "BALTIMORE/SURR. CNTYS",
                "counties"        => "ANNE ARUNDEL, BALTIMORE, BALTIMORE CITY, CARROLL, HARFORD AND HOWARD"
            ],
            [
                "mac"             => "12302",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES EXCEPT MONTGOMERY AND PRINCE GEORGE'S"
            ],
            [
                "mac"             => "14212",
                "locality_number" => "01",
                "state"           => "MASSACHUSETTS",
                "fsa"             => "METROPOLITAN BOSTON",
                "counties"        => "MIDDLESEX, NORFOLK AND SUFFOLK"
            ],
            [
                "mac"             => "14212",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "08202",
                "locality_number" => "01",
                "state"           => "MICHIGAN",
                "fsa"             => "DETROIT",
                "counties"        => "MACOMB, OAKLAND, WASHTENAW AND WAYNE"
            ],
            [
                "mac"             => "08202",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "06202",
                "locality_number" => "00",
                "state"           => "MINNESOTA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "07302",
                "locality_number" => "00",
                "state"           => "MISSISSIPPI",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "05302",
                "locality_number" => "02",
                "state"           => "MISSOURI",
                "fsa"             => "METROPOLITAN KANSAS CITY",
                "counties"        => "CLAY, JACKSON AND PLATTE"
            ],
            [
                "mac"             => "05302",
                "locality_number" => "01",
                "state"           => "",
                "fsa"             => "METROPOLITAN ST. LOUIS",
                "counties"        => "JEFFERSON, ST. CHARLES, ST. LOUIS AND ST. LOUIS CITY"
            ],
            [
                "mac"             => "05302",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE*",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "05302",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE*",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "03202",
                "locality_number" => "01",
                "state"           => "MONTANA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "05402",
                "locality_number" => "00",
                "state"           => "NEBRASKA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "01312",
                "locality_number" => "00",
                "state"           => "NEVADA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "14312",
                "locality_number" => "40",
                "state"           => "NEW HAMPSHIRE",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "12402",
                "locality_number" => "01",
                "state"           => "NEW JERSEY",
                "fsa"             => "NORTHERN NJ",
                "counties"        => "BERGEN, ESSEX, HUDSON, HUNTERDON, MIDDLESEX, MORRIS, PASSAIC, SOMERSET, SUSSEX, UNION AND WARREN"
            ],
            [
                "mac"             => "12402",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "04212",
                "locality_number" => "05",
                "state"           => "NEW MEXICO",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "13202",
                "locality_number" => "01",
                "state"           => "NEW YORK",
                "fsa"             => "MANHATTAN",
                "counties"        => "NEW YORK "
            ],
            [
                "mac"             => "13202",
                "locality_number" => "02",
                "state"           => "",
                "fsa"             => "NYC SUBURBS/LONG ISLAND",
                "counties"        => "BRONX, KINGS, NASSAU, RICHMOND, ROCKLAND, SUFFOLK AND WESTCHESTER"
            ],
            [
                "mac"             => "13202",
                "locality_number" => "03",
                "state"           => "",
                "fsa"             => "POUGHKPSIE/N NYC SUBURBS",
                "counties"        => "COLUMBIA, DELAWARE, DUTCHESS, GREENE, ORANGE, PUTNAM, SULLIVAN AND ULSTER"
            ],
            [
                "mac"             => "13292",
                "locality_number" => "04",
                "state"           => "",
                "fsa"             => "QUEENS",
                "counties"        => "QUEENS"
            ],
            [
                "mac"             => "13282",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "11502",
                "locality_number" => "00",
                "state"           => "NORTH CAROLINA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "03302",
                "locality_number" => "01",
                "state"           => "NORTH DAKOTA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "15202",
                "locality_number" => "00",
                "state"           => "OHIO",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "04312",
                "locality_number" => "00",
                "state"           => "OKLAHOMA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "02302",
                "locality_number" => "01",
                "state"           => "OREGON",
                "fsa"             => "PORTLAND",
                "counties"        => "CLACKAMAS, MULTNOMAH AND WASHINGTON"
            ],
            [
                "mac"             => "02302",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "12502",
                "locality_number" => "01",
                "state"           => "PENNSYLVANIA",
                "fsa"             => "METROPOLITAN PHILADELPHIA",
                "counties"        => "BUCKS, CHESTER, DELAWARE, MONTGOMERY AND PHILADELPHIA"
            ],
            [
                "mac"             => "12502",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "09202",
                "locality_number" => "20",
                "state"           => "PUERTO RICO",
                "fsa"             => "PUERTO RICO",
                "counties"        => "ALL COUNTY EQUIVALENTS"
            ],
            [
                "mac"             => "14412",
                "locality_number" => "01",
                "state"           => "RHODE ISLAND",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "11202",
                "locality_number" => "01",
                "state"           => "SOUTH CAROLINA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "03402",
                "locality_number" => "02",
                "state"           => "SOUTH DAKOTA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "10312",
                "locality_number" => "35",
                "state"           => "TENNESSEE",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "04412",
                "locality_number" => "31",
                "state"           => "TEXAS",
                "fsa"             => "AUSTIN",
                "counties"        => "TRAVIS"
            ],
            [
                "mac"             => "04412",
                "locality_number" => "20",
                "state"           => "",
                "fsa"             => "BEAUMONT",
                "counties"        => "JEFFERSON "
            ],
            [
                "mac"             => "04412",
                "locality_number" => "09",
                "state"           => "",
                "fsa"             => "BRAZORIA",
                "counties"        => "BRAZORIA "
            ],
            [
                "mac"             => "04412",
                "locality_number" => "11",
                "state"           => "",
                "fsa"             => "DALLAS",
                "counties"        => "DALLAS"
            ],
            [
                "mac"             => "04412",
                "locality_number" => "28",
                "state"           => "",
                "fsa"             => "FORT WORTH",
                "counties"        => "TARRANT "
            ],
            [
                "mac"             => "04412",
                "locality_number" => "15",
                "state"           => "",
                "fsa"             => "GALVESTON",
                "counties"        => "GALVESTON "
            ],
            [
                "mac"             => "04412",
                "locality_number" => "18",
                "state"           => "",
                "fsa"             => "HOUSTON",
                "counties"        => "HARRIS"
            ],
            [
                "mac"             => "04412",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "03502",
                "locality_number" => "09",
                "state"           => "UTAH",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "14512",
                "locality_number" => "50",
                "state"           => "VERMONT",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "09202",
                "locality_number" => "50",
                "state"           => "VIRGIN ISLANDS",
                "fsa"             => "VIRGIN ISLANDS",
                "counties"        => "ALL COUNTY EQUIVALENTS"
            ],
            [
                "mac"             => "11302",
                "locality_number" => "00",
                "state"           => "VIRGINIA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES, EXCEPT ALEXANDRIA CITY, ARLINGTON, FAIRFAX, FAIRFAX CITY, AND FALLS CHURCH CITY"
            ],
            [
                "mac"             => "02402",
                "locality_number" => "02",
                "state"           => "WASHINGTON",
                "fsa"             => "SEATTLE (KING CNTY)",
                "counties"        => "KING "
            ],
            [
                "mac"             => "02402",
                "locality_number" => "99",
                "state"           => "",
                "fsa"             => "REST OF STATE",
                "counties"        => "ALL OTHER COUNTIES"
            ],
            [
                "mac"             => "11402",
                "locality_number" => "16",
                "state"           => "WEST VIRGINIA",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "06302",
                "locality_number" => "00",
                "state"           => "WISCONSIN",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
            [
                "mac"             => "03602",
                "locality_number" => "21",
                "state"           => "WYOMING",
                "fsa"             => "STATEWIDE",
                "counties"        => "ALL COUNTIES"
            ],
        ];

        foreach ($procedureMacLocalities as $procedureMacLocality) {
            MacLocality::firstOrCreate($procedureMacLocality);
        }
    }
}
