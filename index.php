<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BloodBank</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    .navbar-toggler {
        z-index: 1;
    }

    @media (max-width: 576px) {
        nav>.container {
            width: 100%;
        }
    }

    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }

    #color {
        color: #ba2916;
    }

    #color1 {
        background-color: #ba2916;
        color: #fff;
    }

    #color2 {
        color: #db4843;
    }

    .card-tex{
        text-align: center;
    }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/slider.php'; ?>
    <br>
    <!-- Page Content -->
    <div class="container">

        <h1 class="my-4" id="color">Welcome to BLOODBANK</h1>
        
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header" id="color1">The need for blood</h4>

                    <p class="card-text" style="padding-left:5%">Blood is essential to help patients survive surgeries,
                        cancer treatment, chronic illnesses, and traumatic injuries. This lifesaving care starts with
                        one person making a generous donation. The need for blood is constant. But only about 3% of
                        age-eligible people donate blood yearly. </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header" id="color1">Blood Donation Types</h4>

                    <p class="card-text" style="padding-left:5%">Blood donations can yield a variety of blood products,
                        including red cells, platelets and plasma. You may be most familiar with the typical whole blood
                        donation drive seen at workplaces, schools and community events. And we are also a place to
                        donate blood. </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header" id="color1">Who you could Help?</h4>

                    <p class="card-text" style="padding-left:5%"> Your blood donations are used for patients in need of
                        surgery, cancer treatment and transfusions for blood loss from traumatic injuries. CMV-negative
                        blood may be utilized for transfusions for pediatric-specific conditions
                        for newborns and premature babies, as well as for immune-compromised adults. </p>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->

        <!-- /.row -->

        <!-- Features Section -->
        <hr> <br>
        <div class="row">
            <div class="col-lg-6">
                <h2 id="color2">BLOOD GROUPS</h2>
                <p> Blood group of any human being will mainly fall in any one of the following groups.</p>
                <ul>
                    <li>A positive or A negative</li>
                    <li>B positive or B negative</li>
                    <li>O positive or O negative</li>
                    <li>AB positive or AB negative.</li>
                </ul>
                <p>A healthy diet helps ensure a successful blood donation, and also makes you feel better! Check out
                    the following recommended foods to eat prior to your donation.</p>
            </div>
            <div class="col-lg-6">
                <img style="width: 100%; height:400px;" class="img-fluid rounded" src="admin/images/hero.jpg" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr> <br>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h4 id="color2">UNIVERSAL DONORS AND RECIPIENTS</h4>
                <p>
                    Universal donors are those with an O negative blood type. Why? O negative blood can be used in
                    transfusions for any blood type.
                </p>
                <p>
                    Type O is routinely in short supply and in high demand by hospitals – both because it is the most
                    common blood type and because type O negative blood is the universal blood type needed for emergency
                    transfusions and for immune deficient infants.
                </p>
                <p>
                    Types O negative and O positive are in high demand. Only 7% of the population are O negative.
                    However, the need for O negative blood is the highest because it is used most often during
                    emergencies. The need for O+ is high because it is the most frequently occurring blood type (37% of
                    the population).
                </p>
                <p>
                    The universal red cell donor has Type O negative blood. The universal plasma donor has Type AB
                    blood. For more about plasma donation, visit the plasma donation facts.
                </p>
            </div>
            <div class="col-md-4">
                <img class="img-fluid rounded" src="admin/images/blood-donor.jpg" alt="">
                <br>
                <a class="btn btn-lg btn-secondary btn-block" href="become-donar.php" id="color1">Become a Donar</a>
                <br>
                <a class="btn btn-lg btn-secondary btn-block" href="bloodrequest.php" id="color1">Blood Request</a>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <?php require_once 'footer.php'; ?>
    
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>