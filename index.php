<?php session_start() ?>
<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center h-hero">
    <h1 class="text-capitalize text-white text-center">Welcome to the LCFE Commodities Management System</h1>
    <p class="text-white text-center">Your One-stop Self-service system to tap into the FGN Duty-Free Import/Export Program. Register to Get Started</p>
    <div class="d-md-flex gap-3 my-3">
    <a class="text-decoration-none" href="login.php"><span class="bg-light py-2 px-4 text-comp rounded"> Login <i class="bi bi-door-open-fill"></i></span></a>
    <a class="text-decoration-none" href="register.php"><span class="bg-light py-2 px-4 text-comp rounded">Register <i class="bi bi-pencil-square"></i></span></a>
    </div>
</div>
<div class="container-fluid">
    <div class="container text-end d-<?php echo (isset($_SESSION['user_username'])) ? "block":"none" ?> my-2">
        <a
            href="<?php
                        echo (($_SESSION['user_approval'] == 'approved') &&
    in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader'])) ? "aggregator.php":"dashboard.php" ?>"
            class="smfs-5 text-secondary text-decoration-none"><i class="bi bi-house-check-fill"></i> Return to dashboard</a>
    </div>
</div>
<div class="container-fluid" style="padding: 25px 0">
<div class="container mt-4">
    <div class="d-md-flex gap-2 col-md-12">
        <div class="exchange-short col-md-5 mt-md-3 mb-3">
            <?php include 'components/exchange-v1.php'; ?>
        </div>
        <div class="news d-flex flex-column col-md-7 mb-3">
            <h5 class="smfs-6 text-uppercase text-comp mb-2">from the lcfe table</h5>
            <div class="w-100 rounded" style="height: 348px">
                <img src="assets/images/gold.jpg" alt="Image from article" class="w-100 rounded h-100" />
            </div>
            <h3 class="text-uppercase text-comp fw-bold mt-3">why you need to invest in gold now!</h3>
            <p>
                If you had invested when Eko Gold was listed at N42,500 per gram back in July
                2022,today, your investment would have grown by over 100% reaching an impressive
                N88,700 per gram. Seize the opportunity to be part of this remarkable growth
                story.
            </p>
        </div>
    </div>
</div>
</div>
<div class="container-fluid bg-light" style="padding: 50px 0">
    <div class="container">
        <?php include 'components/trading-lcfe.php'; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
