<?php

namespace Database\Seeders;

use App\Actions\AssociateStationAction;
use App\Actions\PollAction;
use App\Classes\CandidateVote;
use Illuminate\Database\Seeder;
use App\Models\{Contact, Candidate, PollItem, Station};
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->complex();
    }

    protected function simple()
    {
        $municity = 'Quezon City';

        $station1 = Station::create(['cluster' => 1, 'municity' => $municity]);
        $station2 = Station::create(['cluster' => 2, 'municity' => $municity]);
        $station3 = Station::create(['cluster' => 3, 'municity' => $municity]);

        $mobile1 = '09173011987';
        $mobile2 = '09189362340';
        $mobile3 = '09175180722';

        $contact1 = Contact::create(['mobile' => $mobile1]);
        $contact2 = Contact::create(['mobile' => $mobile2]);
        $contact3 = Contact::create(['mobile' => $mobile3]);

        AssociateStationAction::run($station1, $contact1);
        AssociateStationAction::run($station2, $contact2);
        AssociateStationAction::run($station3, $contact3);

        $candidate1 = Candidate::create(['code' => 'PING', 'name' => 'Ping Lacson']);
        $candidate2 = Candidate::create(['code' => 'BBM', 'name' => 'Bongbong Marcos']);
        $candidate3 = Candidate::create(['code' => 'LENI', 'name' => 'Leni Robredo']);
        $candidate4 = Candidate::create(['code' => 'ISKO', 'name' => 'Isko Moreno']);
        $candidate5 = Candidate::create(['code' => 'MP', 'name' => 'Manny Pacquiao']);

        PollAction::run($contact1, collect([
            new CandidateVote($candidate1, 100),
            new CandidateVote($candidate2, 200),
            new CandidateVote($candidate3, 300),
            new CandidateVote($candidate4, 400),
            new CandidateVote($candidate5, 500),
        ]));

        PollAction::run($contact2, collect([
            new CandidateVote($candidate1, 100),
            new CandidateVote($candidate2, 200),
            new CandidateVote($candidate3, 300),
            new CandidateVote($candidate4, 400),
            new CandidateVote($candidate5, 500),
        ]));

        PollAction::run($contact3, collect([
            new CandidateVote($candidate1, 100),
            new CandidateVote($candidate2, 200),
            new CandidateVote($candidate3, 300),
            new CandidateVote($candidate4, 400),
            new CandidateVote($candidate5, 500),
        ]));
    }

    protected function complex()
    {
        $candidate1 = Candidate::create(['code' => 'PING', 'name' => 'Ping Lacson']);
        $candidate2 = Candidate::create(['code' => 'BBM', 'name' => 'Bongbong Marcos']);
        $candidate3 = Candidate::create(['code' => 'LENI', 'name' => 'Leni Robredo']);
        $candidate4 = Candidate::create(['code' => 'ISKO', 'name' => 'Isko Moreno']);
        $candidate5 = Candidate::create(['code' => 'MP', 'name' => 'Manny Pacquiao']);

        $places = [
            'Luzon' => [
                'Region 1' => [
                    'Ilocos Norte' => [
                        'Currimao',
                        'Laoag City',
                    ],
                    'Ilocos Sur' => [
                        'Bantay',
                        'Vigan'
                    ],
                ],
                'Region 2' => [
                    'Batanes' => [
                        'Basco',
                        'Ivana'
                    ],
                    'Cagayan' => [
                        'Tuao',
                        'Tuguegarao City'
                    ],
                ],
//                'Region 3',
//                'Region 4A',
//                'Region 4B',
//                'NCR',
//                'Region 5',
//                'Region 6',
            ],
            'Visayas' => [
                'Region 6' => [
                    'Antique' => [
                        'Pandan',
                        'Valderrama'
                    ],
                    'Iloilo' => [
                        'Carles',
                        'Miagao',
                    ],
                ],
                'Region 7' => [
                    'Bohol' => [
                        'Tagbilaran City',
                        'Panglao',
                    ],
                    'Cebu' => [
                        'Toledo City',
                        'Talisay City'
                    ]
                ],
                'Region 8' => [
                    'Eastern Samar' => [
                        'Borongan',
                        'Dolores'
                    ],
                    'Leyte' => [
                        'Baybay City',
                        'Tolosa'
                    ],
                ],
            ],
            'Mindanao' => [
                'Region 10' => [
                    'Bukidnon' => [
                        'Malaybalay City',
                        'Valencia City'
                    ],
                    'Misamis Oriental' => [
                        'Gingoog City',
                        'Jasaan',
                    ],
                ],
                'Region 11' => [
                    'Davao del Norte' => [
                        'Panabo',
                        'Samal'
                    ],
                    'Davao del Sur' => [
                        'Digos',
                        'Kiblawan'
                    ]
                ],
                'Region 12' => [
                    'Cotabato' => [
                        'Kidapawan City',
                        'Pikit',
                    ],
                    'Sarangani' => [
                        'Maasim',
                        'Maitum'
                    ]
                ],
            ],
        ];

        $barangays = [
            'Poblacion Uno',
            'Poblacion Dos'
        ];

        foreach ($places as $island => $regions) {
            foreach ($regions as $region => $provinces) {
                foreach ($provinces as $province => $municities) {
                    foreach ($municities as $municity) {
                        $cluster = 1;
                        $district = Arr::random(['First ', 'Second ']) . "District of {$province}";
                        foreach ($barangays as $barangay) {
                            for ($i = 1; $i <= 3; $i++) {
                                echo $region . ' '
                                    . $province . ' '
                                    . $district . ' '
                                    . $municity . ' '
                                    . $barangay . ' '
                                    . $cluster
                                    . "\r\n";
                                Station::create(compact(
                                    'cluster',
                                    'barangay',
                                    'municity',
                                    'district',
                                    'province',
                                    'region',
                                    'island'
                                ));

                                $cluster++;
                            }
                        }
                    }
                }
            }
        }

        $i = 0;
        Station::all()->each(function ($station, $key) use ($i, $candidate1, $candidate2, $candidate3, $candidate4, $candidate5) {
            $mobile = Arr::random(['0917', '0918', '0923']) . random_int(1000, 9999). str_pad($key, 3, '0', STR_PAD_LEFT);;
            $contact = Contact::create(compact('mobile'));
            AssociateStationAction::run($station, $contact);
            PollAction::run($contact, collect([
                new CandidateVote($candidate1, random_int(random_int(0,150), random_int(151,200))),
                new CandidateVote($candidate2, random_int(random_int(0,25), random_int(26,200))),
                new CandidateVote($candidate3, random_int(random_int(0,100), random_int(101,200))),
                new CandidateVote($candidate4, random_int(random_int(0,50), random_int(51,200))),
                new CandidateVote($candidate5, random_int(random_int(0,25), random_int(26,200))),
            ]));
        });

//        $candidate1 = Candidate::create(['code' => 'PING', 'name' => 'Ping Lacson']);
//        $candidate2 = Candidate::create(['code' => 'BBM', 'name' => 'Bongbong Marcos']);
//        $candidate3 = Candidate::create(['code' => 'LENI', 'name' => 'Leni Robredo']);
//        $candidate4 = Candidate::create(['code' => 'ISKO', 'name' => 'Isko Moreno']);
//        $candidate5 = Candidate::create(['code' => 'MP', 'name' => 'Manny Pacquiao']);
    }
}
