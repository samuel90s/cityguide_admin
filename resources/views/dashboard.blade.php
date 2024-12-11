@extends('template.layouts.app')
@section('title', 'Dashboard | Fintrack')
@section('title-header', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
            <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
          </div>
          <div class="col-12 col-xl-4">
           <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <i class="mdi mdi-calendar"></i> Today (10 Jan 2024)
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div>
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('assets/images/dashboard/people.svg') }}" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-normal">
                                    <i class="icon-sun mr-2"></i>Loading<sup>°C</sup>
                                </h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-normal">Loading...</h4>
                                <h6 class="font-weight-normal">Loading...</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Total Companies</p>
                {{-- <p class="fs-30 mb-2">{{ $totalCompanies }}</p> --}}
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Total Users</p>
                {{-- <p class="fs-30 mb-2">{{ $totalUsers }}</p> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Total Expenses</p>
                {{-- <p class="fs-30 mb-2">{{ $totalExpenses }}</p> --}}
              </div>
            </div>
          </div>
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Total Income</p>
                {{-- <p class="fs-30 mb-2">{{ $totalIncome }}</p> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Order Details</p>
            <div class="d-flex flex-wrap mb-5">
              <div class="mr-5 mt-3">
                <p class="text-muted">Order value</p>
                <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
              </div>
              <div class="mr-5 mt-3">
                <p class="text-muted">Orders</p>
                <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
              </div>
              <div class="mr-5 mt-3">
                <p class="text-muted">Users</p>
                <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
              </div>
            </div>
            <canvas id="order-chart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <p class="card-title">Sales Report</p>
              <a href="#" class="text-info">View all</a>
            </div>
            <p class="font-weight-500">The total number of sessions within the date range...</p>
            <canvas id="sales-chart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/weather')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                // Update data cuaca di halaman
                document.querySelector('.weather-info .mb-0').innerHTML = `
                    <i class="icon-sun mr-2"></i>${Math.round(data.temperature)}<sup>°C</sup>`;
                document.querySelector('.weather-info .location').textContent = data.city;
                document.querySelector('.weather-info h6').textContent = data.country;

                // Tambahkan ikon cuaca
                const weatherIcon = document.createElement('img');
                weatherIcon.src = `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
                weatherIcon.alt = data.description;
                weatherIcon.style.width = '50px';
                document.querySelector('.weather-info .d-flex').appendChild(weatherIcon);
            })
            .catch(error => console.error('Error fetching weather data:', error));
    });
    </script>
@endsection
