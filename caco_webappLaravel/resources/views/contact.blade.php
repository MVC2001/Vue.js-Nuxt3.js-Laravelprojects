<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contact</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<title>contact</title>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>


  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">careandcomfort23@gmail.com</a>
        <i class="bi bi-phone"></i>cont:  +255 682 047 717, +255  655 881 777
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="http://x.com/CareAndcomfort6?t=OuPS6uKNNWhlm7ZtxKBPiA&s=09" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="http://www.facebook.com/profile.php?id=100089675673186&mibextid-sAuArU1zVvLjaiq0" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="http://www.instagram.com/careandcomfort_caco?igsh=d2j3YTNmdXNTcTRn" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="LinkedIn@care" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="cacohome"><img src="./assets/img/logo.jpg" style="width: 120px;height: 130px;"></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="service">Services</a></li>
          <li class="dropdown"><a href="#"><span>About CACO</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="areaOFfocus">AREAS OF FOCUS..</a></li>
              <li><a href="ourVision">OUR VISION..</a></li>
              <li><a href="ourMission">OUR MISSION</a></li>
               <li><a href="objectives">OBJECTIVES</a></li>
               <li class="dropdown"><a href="#"><span>Others</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">OUR MISSION</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="newshome">News</a></li>
          <li><a class="nav-link scrollto" href="cacoteam">CACO Team</a></li>
          <li><a class="nav-link scrollto" href="cacoBackground">background of CACO</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

     <a href="login" class="appointment-btn scrollto">Login</a>

    </div>
  </header><!-- End Header -->


  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
      <div class="container" style="margin-top: 180px;">
        <div class="section-title">
          <h2>Contact</h2>
          <p>Care and Comfort Organization  (CACO) is situated  in the United Republic of Tanzania, specifically in Dar Es Salaam,Kinondoni,Makongo,in proximity to Mlimani City. This strategic location allow CACO to effective  serve and engage with the local community,promoting health,education and holistic well-being within the region.</p>
        </div>
      </div>


      <div class="container" style="height: 340px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Kinondoni,Mlimani City,Makongo</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>careandcomfort23@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+255  682 047 717</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

           <div class="container">
    <h2>Contact Form</h2>
     <div class="error-message"></div>
    @if(session('success'))
        <div class="sent-message">{{ session('success') }}</div>
    @endif
    <form action="{{ route('contacts.store') }}" method="post" role="form" class="php-email-form">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
        </div>
        <div class="text-center"><button type="submit">Send Message</button></div>
    </form>
</div>
          </div>

        </div>

      </div>
      <div class="text-center">
        <a href="contact.html" class="more-btn">Learn More to Contact <i class="bx bx-chevron-right"></i></a>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">




          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>CACO</h3>
            <p> Kinondoni,Mlimani City,Makongo <br><br>
              <strong>Phone:</strong> +255  682 047 717<br>
              <strong>Email:</strong> careandcomfort23@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="service.html">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Nutritional counceling</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Community workshops on healthy living</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Nutritional counceling(Reiterated)</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Distribution of fruits and  natural foods to enhance overall well being.</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <p>Enter your email then click Subscribe button to subscribe our company</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span><b>@caco23</b></span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/"><b>MvcSofts123</b></a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="http://x.com/CareAndcomfort6?t=OuPS6uKNNWhlm7ZtxKBPiA&s=09" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="http://www.facebook.com/profile.php?id=100089675673186&mibextid-sAuArU1zVvLjaiq0" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="http://www.instagram.com/careandcomfort_caco?igsh=d2j3YTNmdXNTcTRn" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
