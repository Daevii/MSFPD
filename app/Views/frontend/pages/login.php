<!DOCTYPE html>
<html lang="en">
<?php session()->destroy(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LNU Purchasing</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/lnu logo.png') ?>" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #65000b;
        }

        .content {
            margin: 10%;
            background-color: #fff;
            padding: 3rem 1rem 4rem 1rem;
            box-shadow: 0 0 5px 5px rgba(0, 0, 0, .05);
            border-radius: 20px;
        }

        .signin-text {
            font-style: normal;
            font-weight: 600 !important;

        }

        .form-control {
            display: block;
            width: 100%;
            font-size: 1rem;
            font-weight: 400;
            line-height: 2;
            border-color: #3d3d3d !important;
            border-style: solid !important;
            border-width: 0 0 1px 0 !important;
            padding: 0px !important;
            color: #660000;
            height: auto;
            border-radius: 0;
            background-color: #fff;
            background-clip: padding-box;
        }


        .form-control:focus {

            color: #660000;
            background-color: #fff;
            border-color: #fff;
            outline: 0;
            box-shadow: none;
        }

        .birthday-section {
            padding: 15px;
        }

        .btn-class {
            border-color: #00ac96;
            color: #00ac96;
            margin-top: 20px;
        }

        .btn-class:hover {
            background-color: #660000;
            color: #fff;
            transition: 0.4s ease;
        }

        .img {
            vertical-align: middle;
            border-radius: 20px;

        }

        .label {
            display: inline-block;
            font-weight: 700;
        }

        .header-page {
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: -2rem;
            margin-bottom: 2rem;
            /* border-bottom: 3px solid maroon; */
            background-color: #660000;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container md" style="transition: 0.5s ease;">
        <div class="row content">

            <div class="col-md-12 header-page">
                <img src="<?= base_url('assets/images/lnuhead1 (2).png') ?>" alt="LNU" width="100%">
            </div>
            <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>
            <div id="carouselExample" class="carousel slide col-md-6 mb-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="img" width="100%" height="275px" src="<?= base_url('assets/images/2023-10-10.jpg') ?>" alt="">
                    </div>
                    <div class="carousel-item ">
                        <img class="img" width="100%" height="275px" src="<?= base_url('assets/images/Lyceum-campus.jpg') ?>" alt="">
                    </div>

                    <div class="carousel-item ">
                        <img class="img" width="100%" height="275px" src="<?= base_url('assets/images/Lyceum-Classroom.webp') ?>" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="img" width="100%" height="275px" src="<?= base_url('assets/images/lnu-carusel.webp') ?>" alt="lnu">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h3 class="signin-text mb-3"> Login</h3>

                <form action="<?= base_url('login') ?>" method="post">
                    <div class="form-group">
                        <label class="label" for="name">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="label" for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-class">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#carouselExample').carousel({
            interval: 3000 // Set the interval in milliseconds (10 seconds)
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</html>