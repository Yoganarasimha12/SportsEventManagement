<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Standard Chartered</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Hero background */
    .hero-section {
      background: linear-gradient(180deg, #1a5dab 0%, #3b8ed6 100%);
      color: white;
      padding: 40px 0;
    }
    .hero-section h3 {
      font-weight: 600;
    }
  </style>
</head>
<body>

  <!-- Top Navbar -->
  <nav class="navbar navbar-light bg-light px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <!-- Left: Home icon -->
      <a href="#" class="me-3">
        <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" alt="Home" width="20" height="20">
      </a>

      <!-- Center nav items: force one line -->
      <div class="d-flex flex-grow-1 justify-content-center flex-nowrap">
        <ul class="nav">
          <li class="nav-item mx-2"><a class="nav-link" href="#">You're in <span class="text-success">India</span></a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="#">Our Products</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="#">Promotions</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="#">Services</a></li>
          <li class="nav-item mx-2"><a class="nav-link" href="#">Help</a></li>
        </ul>
      </div>

      <!-- Right side: Search + Login + Logo -->
      <div class="d-flex align-items-center flex-nowrap">
        <a href="#" class="me-3">
          <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Search" width="20" height="20">
        </a>
        <button class="btn btn-success me-3">LOGIN</button>
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Standard_Chartered_2012_logo.svg" 
             alt="Standard Chartered" height="40">
      </div>

    </div>
  </nav>

  <!-- Hero Section (background + welcome + cards) -->
  <div class="hero-section">
    <div class="container-fluid text-center mb-4">
      <h3 class="mb-5">Welcome to Standard Chartered</h3>
    </div>

    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-md-5 g-3 justify-content-center">

        <!-- Card 1 -->
        <div class="col">
          <div class="card h-100">
            <img src="https://images.unsplash.com/photo-1578321272238-4a4fcf04c2f8?q=80&w=600" class="card-img-top" alt="Wildlife">
            <div class="card-body">
              <h6 class="card-title">Combating the illegal wildlife trade</h6>
              <p class="card-text small">See how we work with partners to fight money laundering and the illegal wildlife trade</p>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
          <div class="card h-100">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=600" class="card-img-top" alt="Invest">
            <div class="card-body">
              <h6 class="card-title">Invest like you never left India</h6>
              <p class="card-text small">Invest on-the-go with NRI Banking.</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
          <div class="card h-100">
            <img src="https://images.unsplash.com/photo-1533639327638-67f6b7d37677?q=80&w=600" class="card-img-top" alt="Explore">
            <div class="card-body">
              <h6 class="card-title">Explore the world like a local #PayLikeALocal</h6>
              <p class="card-text small">Load up to 20 currencies on the Multi-Currency Forex card. Apply now</p>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col">
          <div class="card h-100">
            <img src="https://images.unsplash.com/photo-1588702547923-7093a6c3ba33?q=80&w=600" class="card-img-top" alt="App">
            <div class="card-body">
              <h6 class="card-title">SC Edge app – Exclusive for salary accounts</h6>
              <p class="card-text small">One app for travel, dining, recharges, bill pay & managing expenses. Know more</p>
            </div>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="col">
          <div class="card h-100">
            <img src="https://images.unsplash.com/photo-1517686469429-8bdb88b9f907?q=80&w=600" class="card-img-top" alt="Cashback">
            <div class="card-body">
              <h6 class="card-title">Get 5% cashback at supermarket</h6>
              <p class="card-text small">With Manhattan Platinum credit card</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>​-