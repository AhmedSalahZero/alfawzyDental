<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;


function getServices()
{
    return [
        'Teeth Whitening' => __('Teeth Whitening')
    ];
}

function branchesInfos()
{
    return [
        [
            'icon'=>'fa-solid fa-house',
            'title'=>__('Main Branch'),
            'description'=>__('96 Nile st., Al Galaa Square, Al Agouzah, Giza, Egypt- 5th floor'),
            'phones'=>[
                '+20 1110100027', '+202 33351509'
            ]
        ],

        [
            'icon'=>'fa-solid fa-house',
            'title'=>__('Dokki Branch'),
            'description'=>__('10 Lotfy Hassona St., Dokki, Giza, Egypt, 1st & 2nd floors.'),
            'phones'=>[
                '+2033351509', '+202 33356786'
            ]
        ],
        [
            'icon'=>'fa-solid fa-envelope',
            'title'=>__('Our Email Address'),
            'description'=>__('bookappointment@alfawzydental.com'),

        ]

    ];
}

function getPages(): array
{
    return [
        'about' => [
            'title' => __('About'),
            'url' => '#',
            'is_active' => false
        ],
        'our-services' => [
            'title' => __('Our Services'),
            'url' => '#',
            'is_active' => false
        ],
        'our partners' => [
            'title' => __('Our Partners'),
            'url' => '#',
            'is_active' => false
        ],
        'Gallery' => [
            'title' => __('Gallery'),
            'url' => '#',
            'is_active' => false
        ], 'Dental Tourism' => [
            'title' => __('Dental Tourism'),
            'url' => '#',
            'is_active' => false
        ], 'FAQs' => [
            'title' => __('FAQs'),
            'url' => '#',
            'is_active' => false
        ], 'Contacts' => [
            'title' => __('Contacts'),
            'url' => '#',
            'is_active' => false
        ],

    ];
}


function footerPages()
{
    return [
        [
            'link' => route('web_about.index'),
            'title' => 'About',

        ],
        [
            'link' => route('web_services.index'),
            'title' => 'Our Services',

        ],
        [
            'link' => route('web_partners.index'),
            'title' => 'Our Partners',

        ],

        [
            'link' => route('web_gallery.index'),
            'title' => 'Photo Gallery',

        ],
        [
            'link' => route('dental.tourism.index'),
            'title' => 'Dental Tourism',

        ],
        [
            'link' => route('web_faq.index'),
            'title' => 'FAQs',

        ],
        [
            'link' => route('web_contacts.index'),
            'title' => 'Contacts',

        ]
    ];
}


function getServicesTypes()
{
    return [
        __('Core Dental Services ') => [
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Esthetic Dentistry '),
            ],
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Dental Implants'),
            ], [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Full Mouth Cases'),
            ]
        ],
        __('Specialized Services') => [
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Laser Dentistry'),
            ],
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Laser Dentistry'),
            ]
        ],
        __('Complex  Services​') => [
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Special Needs'),
            ],
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Geriatric Dentistry'),
            ],
        ],
        __('Unique Services') => [
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Treatment under GA'),
            ],
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Treatment @ Home'),
            ],
        ],
        __('Routine Dental Services') => [
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Teeth Whitening'),
            ],
            [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Periodontal Therapy'),
            ], [
                'image' => asset('front/image/service-1.png'),
                'name' => __('Root Canal Treatment'),
            ],
        ]
    ];
}


function getBlogs()
{
    return [
        [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ], [
            'img' => asset('front/image/blog.png'),
            'date' => '28 Jan',
            'title' => 'TECHNOLOGY',
            'subtitle' => __('New Technology Make for Dental Operation'),
            'description' => __('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing')
        ],
    ];
}

function getFounders()
{
    return [
        [
            'name' => 'Dr Ahmed Fawzy',
            'image' => asset('front/image/founder-1.png'),
            'position' => __('Founder And Ceo'),
            'description' => __('Dr Soliman graduated from Faculty of Oral & Dental Medicine-Cairo University, Egypt in 1998. He then completed his Masters in Prosthodontics in 2010. In 2016, Dr.Soliman moved to the USA with his family where he invested in his career by joining the Advanced Education General Dentistry Residency In Eastman Institute of Oral Health at the University of Rochester. Dr.Soliman is an expert in dental implantology, successfully placed more than 2000 implants and is counted one of the well-known implantologist in the region.​')

        ],
        [
            'name' => 'Dr.Manal Elesily',
            'image' => asset('front/image/founder-2.png'),
            'position' => __('owner'),
            'description' => __('Since graduated from Faculty of Oral & Dental Medicine-Cairo University, Egypt in 1999, Dr.Elesily has been practicing through all fields of general dentistry, with more passion to pediatric and restorative dentistry. When settled in the USA, Dr.Elesily upscaled her scientific knowledge by achieving an associate degree in dental hygiene from the State University of New York. ADA recommendations, CDC guidelines, Infection control and dental hygiene are her main projects in Al Fawzy Dental facility.​​')
        ]
    ];
}

function getTopManngements()
{
    return [
        __('Top Management')=> [
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ], [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ], [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ]
        ],
        __('Chief Admins')=>[
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ]
        ],
        __('Meet The Doctors')=>[
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ], [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ],
            [
                'image'=>asset('front/image/doctor-1.png'),
                'name'=>'Dr.Yassmein Hussein',
                'position'=>__('Managing Director')
            ]
        ]
    ];
}

function getParteners()
{
    return [
        [
            'image'=>asset('front/image/partner-1.png')
        ],
        [
            'image'=>asset('front/image/partner-2.png')
        ],
        [
            'image'=>asset('front/image/partner-3.png')
        ],
        [
            'image'=>asset('front/image/partner-4.png')
        ]
    ];
}

function getBranchesInfos(): array
{
    return [
        [
            'title' => __('Main Branch'),
            'description' => __('96 Nile st., Al Galaa Square, Al Agouzah, Giza, Egypt- 5th floor.  +20 1110100027 / +2033351509')
        ],
        [
            'title' => __('Dokki Branch'),
            'description' => __('10 Lotfy Hassona, from Al Galaa Square, Dokki, Giza, Egypt, 1st & 2nd floors, +20 11114444190 / +20 33356786')
        ]
    ];
}


function getSocialIcons()
{
    $settings=\App\Models\Setting::firstOrCreate();
    return [
        __('Instagram') => [
            'icon' => 'fa-brands fa-instagram',
            'link' => $settings->instagram,
        ],
        __('Facebook') => [
            'icon' => 'fa-brands fa-facebook-f',
            'link' => $settings->facebook,
        ],
        __('Snapchat') => [
            'icon' => 'fa-brands fa-snapchat',
            'link' => $settings->snapchat,
        ],
//        __('Google') => [
//            'icon' => 'fa-brands fa-google',
//            'link' => $settings->gmail,
//        ],
//        __('Tiktok') => [
//            'icon' => 'fa-brands fa-tiktok',
//            'link' => '#'
//        ]
    ];
}


if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}


if (!function_exists('saas')) {
    function saas()
    {
        return auth()->guard('saas');
    }
}


if (!function_exists('setting')) {
    function setting()
    {
        return \App\Models\Setting::firstorFail();
    }
}


if (!function_exists('get_file')) {
    function get_file($file)
    {
        // Storage::exists( $file )
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $file_path = $file;
        } elseif ($file) {
            $file_path = asset('storage/uploads') . '/' . $file;
        } else {
            $file_path = asset('dashboard/assets/images/companies/img-1.png');
        }
        return $file_path;
    }//end
}


function localRowData($model, $id, $column)
{
    $lang = \App\Models\Language::where('abbreviation', app()->getLocale())->first();
    if ($lang) {
        return $row = $model->where('lang_id', $lang->id)->where($column, $id)->first();

    }
    return null;
}

function rowData($model, $id, $column, $lang_id)
{
    $lang = \App\Models\Language::findOrFail($lang_id);
    if ($lang) {
        return $row = $model->where('lang_id', $lang->id)->where($column, $id)->first();
    }
    return null;
}

if (!function_exists('get_lang')) {
    function get_lang()
    {
        return \LaravelLocalization::setLocale() ?? 'en';
    }
}


if (!function_exists('session_lang')) {
    function session_lang()
    {
        $lang = 'ar';
        /*if (session()->get('lang') && in_array(session()->get('lang'), ['ar', 'en'])) {
            $lang = session()->get('lang') ? session()->get('lang') : 'default';
        }*/

        if (get_lang() && in_array(get_lang(), ['ar', 'en'])) {
            $lang = get_lang();
        }

        if (request()->get('lang') && in_array(request()->get('lang'), ['ar', 'en'])) {
            $lang = request()->get('lang');
        }

        if (request()->post('lang') && in_array(request()->post('lang'), ['ar', 'en'])) {
            $lang = request()->post('lang');
        }

        if (request()->header('lang') && in_array(request()->header('lang'), ['ar', 'en'])) {
            $lang = request()->header('lang');
        }
        return $lang;
    }


    if (!function_exists('AvailableUser')) {
        function AvailableUser($app_id, $client_id, $type_id, $level_id, $name = null, $phone = null, $email = null)
        {
            $user = \App\Models\User::where('app_id', $app_id)->where('client_id', $client_id)->where('type_id', $type_id)->first();
            if ($user)
                return $user;

            $user = \App\Models\User::create([
                'type_id' => $type_id,
                'app_id' => $app_id,
                'client_id' => $client_id,
                'level_id' => $level_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'column_client_id' => $client_id,
            ]);

            return $user;

        }
    }


    if (!function_exists('howToGetPointPermission')) {
        function howToGetPointPermission($slug)
        {
            $row = \App\Models\HowToGetPoint::where('slug', $slug)->first();
            if (!$row)
                return 401;
            if ($row->status == 0)
                return 405;
            return 200;
        }
    }


    if (!function_exists('howToGetPointAvailable')) {
        function howToGetPointAvailable($level_id, $reason_id)
        {
            $point = \App\Models\HowToGetPointLevelLimitPoint::where('level_id', $level_id)->where('how_to_get_point_id', $reason_id)->where('points', '>', 0)->first();
            if (!$point)
                return false;

            return $point;
        }
    }


    if (!function_exists('saveQrCode')) {
        function saveQrCode($data)
        {
            $size = 300; // QR code size (default: 300)


            $imageData = QrCode::format('png')
                ->size($size)
                ->generate($data);

            $filename = time() . $data . '.png'; // Create a unique filename
            $filePath = public_path('qrcodes/' . $filename);

            // Save the QR code image to the public/qrcodes directory
            file_put_contents($filePath, $imageData);

            // Save only the relative path to the database
            return $relativePath = 'qrcodes/' . $filename;
        }
    }


    if (!function_exists('howToRedeemPoints')) {
        function howToRedeemPoints($reason_id, $points, $user_id)
        {
            $row = \App\Models\HowToRedeem::find($reason_id);
            if (!$row)
                return 401;

            $availablePoints = \App\Models\Point::where('user_id', $user_id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');
            if ($availablePoints < $points)
                return 405;
            return 200;
        }
    }


    if (!function_exists('availableOffer')) {
        function availableOffer($reason_id)
        {
            return $offer = \App\Models\Offer::where('fromDate', '<=', date('Y-m-d'))->where('toDate', '>=', date('Y-m-d'))->find($reason_id);

        }
    }


    if (!function_exists('offerPoint')) {
        function offerPoint($level_id, $offer_id, $points)
        {
            return $point = \App\Models\OfferPointLevel::where('level_id', $level_id)->where('offer_id', $offer_id)->first();
        }
    }


    if (!function_exists('howToRedeemAvailable')) {
        function howToRedeemAvailable($level_id, $points, $reason_id)
        {
            $point = \App\Models\HowToRedeemPointLevelLimitPoint::where('level_id', $level_id)->where('how_to_redeem_id', $reason_id)->first();
            if (!$point)
                return false;
            if ($points < $point->points)
                return false;

            return $point;
        }
    }


    if (!function_exists('dailyPoint')) {
        function dailyPoint($reason, $user)
        {

            $currentDate = now()->toDateString(); // Get current date in 'Y-m-d' format

            if ($reason->slug == 'login') {


                $points = \App\Models\Point::where('user_id', $user->id)->where('reason_id', $reason->id)->whereDate('created_at', $currentDate)->count();
                if ($points == 0)
                    return true;
                else
                    return false;
            } else {
                return true;

            }

        }
    }


}
