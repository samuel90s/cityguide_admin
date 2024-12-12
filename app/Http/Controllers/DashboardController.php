<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with static data.
     */
    public function index()
    {
        // Statistik Utama dengan Data Statis
        $totalDestinations = 20;
        $totalAccommodations = 10;
        $totalEvents = 5;
        $totalTransportations = 15;

        // Data Acara Mendatang Statis
        $upcomingEvents = [
            [
                'id' => 1,
                'name' => 'Cultural Festival',
                'event_date' => '2024-12-20',
                'location' => 'City Square',
            ],
            [
                'id' => 2,
                'name' => 'Music Concert',
                'event_date' => '2024-12-25',
                'location' => 'Central Park',
            ],
        ];

        // Data untuk Grafik Aktivitas Pengguna Statis
        $userActivityData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'datasets' => [
                [
                    'label' => 'Active Users',
                    'data' => [50, 60, 70, 80, 90],
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'fill' => false,
                ],
            ],
        ];

        // Data untuk Grafik Kunjungan Destinasi Statis
        $destinationVisitsData = [
            'labels' => ['Destination A', 'Destination B', 'Destination C'],
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => [100, 200, 150],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                ],
            ],
        ];

        return view('dashboard', compact(
            'totalDestinations',
            'totalAccommodations',
            'totalEvents',
            'totalTransportations',
            'upcomingEvents',
            'userActivityData',
            'destinationVisitsData'
        ));
    }
}
