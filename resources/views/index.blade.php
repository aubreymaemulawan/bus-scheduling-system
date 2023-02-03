<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('pub/img/logo.svg')}}" />

  <title>BSATS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">

  <!-- CSS Styles -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
  <!-- Top Bar -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><span>helpdesk@bsats.com</span></i>
        <i class="d-none bi bi-phone d-flex align-items-center ms-4"><span>+63 916 310 4268</span></i>
      </div>
      <div class="d-md-flex align-items-center">
      <i class="d-flex align-items-center ms-4"><span id="live_clock"></span></i>
      </div>
    </div>
  </section>

  <!-- Header -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo">
        <a href="index.html">
          <img src="/img/logo.svg" alt="bsats_logo">
           BSATS
          <span>.</span>
        </a>
      </h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#home">Home</a></li>
          <li><a class="nav-link scrollto" href="#updates">Updates</a></li>
          <li><a class="nav-link scrollto" href="#companies">Companies</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <!-- Home -->
  <section id="home" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome <span>Passengers.</span></h1>
      <h2>Please enter your preferred destination to get started!</h2>
      <div class="d-flex">
          <div class="col-md-3">
            <div class="form-group">
              <div class="row">
                <div class="col-md-1">
                  <i class="bi bi-geo-alt-fill" style="font-size: 1.4em;"></i>
                </div>
                <div class="col-md-11">
                  <select name="route_id" class="form-control" data-style="btn btn-link" id="route_id">
                    <option value="" disabled selected hidden>Origin</option>
                    @foreach ($location as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->place }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <a class="btn-arrow"><i class="bi bi-arrow-right"></i></a>
          <div class="col-md-3">
            <div class="form-group">
              <div class="row">
                <div class="col-md-1">
                  <i class="bi bi-geo-alt-fill" style="font-size: 1.4em; color:#106eea"></i>
                </div>
                <div class="col-md-11">
                  <select name="route_id" class="form-control" data-style="btn btn-link" id="route_id">
                    <option value="" disabled selected hidden>Destination</option>
                    @foreach ($location as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->place }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <a href="#on" class="btn-find scrollto">Find</a>
        </div>
      </div>
    </div>
  </section>

  <main id="main">
    <!-- Trips -->
    <section id="on" class="updates">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Trips</h2>
          <h3>Bus Terminal<span> Trips</span></h3>
          <p>Monitor on-going trips to have a hassle-free trip.</p>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box ">
              <h3>On-going Trips<span id="date"></span></h3>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Date</th>
                        <th>Company</th>
                        <th>Bus Info</th>
                        <th>Trip</th>
                        <th>Route</th>
                        <th>Location</th>
                        <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>May 29, 2022</td>
                      <td>RTMI</td>
                      <td>Bus No: 121 <br> Bus Type: Airconditioned</td>
                      <td>1</td>
                      <td>Cagayan de Oro City - Butuan</td>
                      <td><a target="_blank" rel="nofollow" href="#">Click here to track<br>bus location &rarr;</a></td>
                      <td>Departed:<br> 8:00 am</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Updates -->
    <section id="updates" class="updates">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Updates</h2>
          <h3>Schedule | <span> Fare</span></h3>
          <p>Always stay updated with our Schedules and Fares.</p>
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box ">
              <h3>Schedule for Tomorrow<span id="date"></span></h3>
              <!-- <h4><span>Last Updated: </span></h4> -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Company</th>
                        <th>Route</th>
                        <th>Bus No.</th>
                        <th>Trip</th>
                        <th>Interval</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($schedule as $sched)
                      @if($sched->is_active==1)
                        <tr> 
                          <td>{{$sched->company->company_name}}</td>
                          <td>{{$sched->route->from_to_location}}</td>
                          @if($sched->bus->bustype->bus_type=="Airconditioned")
                          <td>{{$sched->bus->bus_no}} - AC</td>
                          @elseif($sched->bus->bustype->bus_type=="Non-Airconditioned")
                          <td>{{$sched->bus->bus_no}} - NAC</td>
                          @endif
                          <td>First Trip: {{$sched->first_trip}} <br>Last trip: {{$sched->last_trip}}</td>
                          <td>{{$sched->interval_mins}} mins</td>
                        </tr>
                      @endif
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>Fare</h3>
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Route</th>
                        <th>Type</th>
                        <th>Price</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($fare as $fr)
                      <tr>
                          <td>{{$fr->route->from_to_location}}</td>
                          @if($fr->bustype_id==1)
                            <td>AC</td>
                          @elseif($fr->bustype_id==2)
                            <td>NAC</td>
                          @endif
                          <td>₱{{$fr->price}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Companies -->
    <section id="companies" class="companies section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Companies</h2>
          <h3>Bus Companies | <span>Agora Terminal</span></h3>
          <p>Our Companies provides a secure, safe, and best travels for you.</p>
        </div>
        <div class="row">
          @foreach($company as $comp)
            @if($comp->is_active==1)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                <div class="member-img">
                  @if($comp->logo_path=="")
                    <img src="{{ asset('/img/no-logo.svg') }}" class="img-fluid" alt="">
                  @else
                    <?php
                        $str = $comp->logo_path;
                        $str = ltrim($str, 'public/');
                    ?>
                    <img src="{{ asset('../storage/'.$str) }}" class="img-fluid" alt="">
                  @endif
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>{{ $comp->company_name }}</h4>
                  <span>{{ $comp->description }}</span>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        </div>
      </div>
    </section><!-- End Team Section -->

    <!-- Contact Us -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Contact</h2>
          <h3><span>Contact Us</span></h3>
          <p>Leave us a message. We're always ready to help you.</p>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://maps.google.com/maps?q=Agora%20Bus%20Terminal,%20Gaabucayan%20Street,%20Cagayan%20de%20Oro,%20Misamis%20Oriental,%20Philippines&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Agora Bus Terminal, Gaabucayan Street, Cagayan de Oro, PH 9000</p>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="info-box  mb-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>helpdesk@bsats.com</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="info-box  mb-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>+63 916 310 4268</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
    <footer id="footer">
      <div class="container py-4">
        <div class="copyright">
          &copy; Copyright <strong><span>BSATS</span></strong> 2022
        </div>
      </div>
    </footer>

  <!-- Preloader -->
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{asset('js/datatables.js')}}" type="text/javascript" charset="utf8" ></script> 
  
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Page Scripts -->
  <script>
    $(document).ready( 
        function () {
            $('#dataTable').DataTable();
        } 
    );

    // Clock Navbar
      var live_clock = document.getElementById('live_clock');
      function time() {
          var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
          var d = new Date();
          var date = d.toLocaleDateString("en-US", options);
          var s = d.getSeconds();
          var m = d.getMinutes();
          var h = d.getHours();
          live_clock.textContent = date + " / " +("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
      }
      setInterval(time, 1000);
  </script>
</body>

</html>