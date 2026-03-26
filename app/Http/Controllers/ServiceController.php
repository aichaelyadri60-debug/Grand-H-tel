<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = [
            [
                'icon' => 'utensils',
                'title' => 'Fine Dining Restaurant',
                'description' => 'Experience culinary excellence with our award-winning chef preparing international and local cuisine using the finest ingredients.'
            ],
            [
                'icon' => 'waves',
                'title' => 'Infinity Pool & Spa',
                'description' => 'Relax in our rooftop infinity pool with stunning city views, or indulge in rejuvenating spa treatments and massages.'
            ],
            [
                'icon' => 'wifi',
                'title' => 'High-Speed WiFi',
                'description' => 'Stay connected with complimentary high-speed internet access throughout the hotel.'
            ],
            [
                'icon' => 'car',
                'title' => 'Valet Parking',
                'description' => 'Enjoy hassle-free parking with our professional valet service.'
            ],
            [
                'icon' => 'dumbbell',
                'title' => 'Fitness Center',
                'description' => 'Maintain your fitness routine in our modern gym.'
            ],
            [
                'icon' => 'coffee',
                'title' => '24/7 Room Service',
                'description' => 'Meals and beverages delivered anytime.'
            ],
            [
                'icon' => 'shield',
                'title' => 'Concierge Service',
                'description' => 'Our concierge assists with reservations and tours.'
            ],
            [
                'icon' => 'headphones',
                'title' => 'Business Center',
                'description' => 'Meeting rooms and professional support staff.'
            ],
        ];
        return view('services.index', compact('services'));
    }
}
