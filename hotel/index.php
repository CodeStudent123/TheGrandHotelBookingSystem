<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CHARLES HOTEL APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    .hero {
      background: url('images/hero.jpg') no-repeat center center/cover;
      color: white;
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .form-control, .btn {
      border-radius: 0.5rem;
    }

    .section-title {
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .contact-section {
      background-color: #0d0d0d;
      color: white;
      padding: 60px 0;
    }

    .contact-section input,
    .contact-section textarea {
      border-radius: 10px;
    }

    footer {
      padding: 20px;
      text-align: center;
      background-color: #111;
      color: #fff;
    }

    .navbar-brand img {
      height: 40px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
  <a class="navbar-brand" href="#">CHARLES HOTEL APP</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
      <li class="nav-item"><a class="nav-link" href="#rooms">Our Room</a></li>
      <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
      <li class="nav-item"><a class="nav-link" href="#booking">Booking</a></li>
      <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
      <li class="nav-item"><a class="nav-link" href="login.php">Register</a></li>
      <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
    </ul>
  </div>
</nav>

<!-- Hero -->
<section class="hero" id="hero">
  <div class="container">
    <h1>Welcome to Your Home Away From Home</h1>
  </div>
</section>

<!-- About Us -->
<section id="about" class="py-5">
  <div class="container">
    <h2 class="section-title text-center">ABOUT US</h2>
    <div class="row align-items-center">
      <div class="col-md-6">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras faucibus ut lorem vel pharetra. Proin interdum, risus vel convallis mollis, odio nibh ornare lorem, non imperdiet lorem erat in elit. Integer id massa in lectus imperdiet tempor.</p>
      </div>
      <div class="col-md-6">
        <img src="images/about-us.jpg" class="img-fluid rounded" alt="About Us"/>
      </div>
    </div>
  </div>
</section>

<!-- Rooms -->
<section id="rooms" class="bg-light py-5">
  <div class="container">
    <h2 class="section-title text-center">OUR ROOM</h2>
    <div class="row g-4">
      <!-- Room Cards -->
      <div class="col-md-4">
        <div class="card">
          <img src="images/room-1.jpg" class="card-img-top" alt="Single Room"/>
          <div class="card-body">
            <h5 class="card-title">Single Room (₱3,000.00/night)</h5>
            <p class="card-text">Ideal for one person with a single bed.</p>
          </div>
        </div>
      </div>
      <!-- Repeat for more rooms -->
      <div class="col-md-4">
        <div class="card">
          <img src="images/room-2.jpg" class="card-img-top" alt="Double Room"/>
          <div class="card-body">
            <h5 class="card-title">Double Room  (₱4,000.00/night)</h5>
            <p class="card-text">A double bed or two singles for two people.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="images/room-3.jpg" class="card-img-top" alt="Suite"/>
          <div class="card-body">
            <h5 class="card-title">Suite Room (₱5,000.00/night)</h5>
            <p class="card-text">Includes living area, bedroom, and more.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery -->
<section id="gallery" class="py-5">
  <div class="container">
    <h2 class="section-title text-center">GALLERY</h2>
    <div class="row g-3">
      <!-- Gallery images -->
      <div class="col-md-3 col-6">
        <img src="images/gallery1.jpg" class="img-fluid rounded" alt="Gallery Image"/>
      </div>
      <div class="col-md-3 col-6">
        <img src="images/gallery2.webp" class="img-fluid rounded" alt="Gallery Image"/>
      </div>
      <div class="col-md-3 col-6">
        <img src="images/gallery3.webp" class="img-fluid rounded" alt="Gallery Image"/>
      </div>
      <div class="col-md-3 col-6">
        <img src="images/gallery4.webp" class="img-fluid rounded" alt="Gallery Image"/>
      </div>
    </div>
  </div>
</section>

<!-- Booking Form -->
<section id="booking" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title text-center">BOOK YOUR STAY</h2>
    <form class="row g-3" method="POST" action="booking.php">
      <div class="col-md-6">
        <input type="text" class="form-control" name="guest_name" id="guest_name" placeholder="Guest Name" required>
      </div>
      <div class="col-md-6">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
      </div>
      <div class="col-md-6">
        <input type="date" class="form-control" name="checkin_date" id="checkin_date" placeholder="Check-in Date" required>
      </div>
      <div class="col-md-6">
        <input type="date" class="form-control" name="checkout_date" id="checkout_date" placeholder="Check-out Date" required>
      </div>
      <div class="col-md-6">
        <select class="form-select" name="room_type" id="room_type" required>
          <option value="" selected disabled>Room Type</option>
          <option>Single Room (₱3,000.00/night)</option>
          <option>Double Room (₱4,000.00/night)</option>
          <option>Suite Room (₱5,000.00/night)</option>
        </select>
        <input type="hidden" name="room_rate" id="room_rate" value="0.00">
        <input type="hidden" name="nights" id="nights" value="0">
        <input type="hidden" name="status" id="status" value="Pending">
      </div>
      <div class="col-md-6">
        <input type="number" class="form-control" name="number_guests" id="number_guests" placeholder="Number of Guests" required>
      </div>
      <div class="col-md-6">
        <input type="number" class="form-control" name="total_amount" id="total_amount" placeholder="Total Amount" readonly required>
      </div>
      <div class="col-md-6">
        <select class="form-select" name="payment_method" id="payment_method" required>
          <option value="" selected disabled>Payment Method</option>
          <option>COD</option>
          <option>Credit Card</option>
          <option>Gcash</option>
          <option>Paypal</option>
        </select>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary px-5">Book Now</button>
      </div>
    </form>
  </div>
</section>

<!-- Contact Us -->
<section id="contact" class="contact-section">
  <div class="container">
    <div class="row g-5">
      <div class="col-md-6">
        <h2>Contact Us</h2>
        <form method="POST" action="contact.php">
          <input type="text" class="form-control mb-3" name="name" placeholder="Name" required>
          <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
          <input type="tel" class="form-control mb-3" name="phone" placeholder="Phone Number" required>
          <textarea class="form-control mb-3" rows="4" name="message" placeholder="Message" required></textarea>
          <button class="btn btn-light w-100">Send</button>
        </form>
      </div>
      <div class="col-md-6">
        <img src="images/pool.webp" class="img-fluid rounded" alt="Pool"/>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <p>&copy; 2025 CHARLES HOTEL APP. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


  $(document).ready(function () {

    function getRoomRate() {
        const roomType = $('#room_type').val();
        let rate = 0;

        switch (roomType) {
            case 'Single Room (₱3,000.00/night)':
                rate = 3000;
                break;
            case 'Double Room (₱4,000.00/night)':
                rate = 4000;
                break;
            case 'Suite Room (₱5,000.00/night)':
                rate = 5000;
                break;
            default:
                rate = 0;
        }

        $('#room_rate').val(rate);
    }


    function calculateTotal() {
        getRoomRate();
        const roomRate = parseInt($('#room_rate').val()) || 0;
        const guestCount = parseInt($('#number_guests').val()) || 0;
        const dateFrom = new Date($('#checkin_date').val());
        const dateTo = new Date($('#checkout_date').val());

        let nights = 0;
        if (!isNaN(dateFrom) && !isNaN(dateTo) && dateTo > dateFrom) {
            const diffTime = Math.abs(dateTo - dateFrom);
            nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        }

        const total = roomRate * nights;
        $('#nights').val(nights);
        $('#total_amount').val(total);
    }

    $('#room_type, #number_guests, #checkin_date, #checkout_date').on('change', calculateTotal);

  });
</script>
</body>
</html>
