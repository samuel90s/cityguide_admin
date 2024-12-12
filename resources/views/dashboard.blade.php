@extends('template.layouts.app')
@section('title', 'Dashboard | CityGuide')
@section('title-header', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <h3 class="font-weight-bold">Welcome, Admin!</h3>
            <h6 class="font-weight-normal mb-0">Your CityGuide management system is up and running!</h6>
        </div>
    </div>

    <div class="row">
        <!-- Statistik Utama -->
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4">Total Destinations</p>
                    <p class="fs-30 mb-2">20</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Accommodations</p>
                    <p class="fs-30 mb-2">10</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent">
            <div class="card card-light-blue">
                <div class="card-body">
                    <p class="mb-4">Total Events</p>
                    <p class="fs-30 mb-2">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent`">
            <div class="card card-light-danger">
                <div class="card-body">
                    <p class="mb-4">Total Transportations</p>
                    <p class="fs-30 mb-2">15</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Aktivitas -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">User Activity</p>
                    <canvas id="user-activity-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Destination Visits</p>
                    <canvas id="destination-visits-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Acara Terbaru -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upcoming Events</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Cultural Festival</td>
                                    <td>20 Dec 2024</td>
                                    <td>City Square</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Music Concert</td>
                                    <td>25 Dec 2024</td>
                                    <td>Central Park</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Grafik User Activity dan Destination Visits
    const userActivityCtx = document.getElementById('user-activity-chart').getContext('2d');
    const destinationVisitsCtx = document.getElementById('destination-visits-chart').getContext('2d');

    new Chart(userActivityCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [
                {
                    label: 'Active Users',
                    data: [50, 60, 70, 80, 90],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                },
            ],
        },
    });

    new Chart(destinationVisitsCtx, {
        type: 'bar',
        data: {
            labels: ['Destination A', 'Destination B', 'Destination C'],
            datasets: [
                {
                    label: 'Visits',
                    data: [100, 200, 150],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                },
            ],
        },
    });
</script>
@endsection
