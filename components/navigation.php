<div class="container-fluid bg-comp py-2 w-100 d-md-flex justify-content-between align-items-center">
        <div class="brand">
            <a href="index.php">
                <img src="assets/images/lcfe.png" alt="brand" />
            </a>
        </div>
        <nav
            class="navbar navbar-expand-sm navbar-light"
        >
            <div class="container">
                <button
                    class="navbar-toggler d-lg-none border-0 bg-light"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item text-white mx-1 d-<?php echo (isset($_SESSION['user_username'])) ? "none":"block" ?>">
                            <a class="nav-link text-white px-2" href="index.php">Home</a>
                        </li>
                        <li class="nav-item text-white mx-1">
                            <a class="nav-link text-white px-2" href="currency.php">Currency</a>
                        </li>
                        <li class="nav-item text-white mx-1">
                            <a class="nav-link text-white px-2" href="payment.php">Payment System</a>
                        </li>
                        <li class="nav-item text-white mx-1">
                            <a class="nav-link text-white px-2" href="statistics.php">Statistics</a>
                        </li>
                        <li class="nav-item bg-light text-comp login-tab d-<?php echo (isset($_SESSION['user_username'])) ? "none":"flex" ?> mx-2 justify-content-center">
                            <a class="nav-link text-comp" href="login.php">Login <i class="bi bi-door-open-fill"></i></a>
                            <a class="nav-link text-comp" href="register.php">Register <i class="bi bi-pencil-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="d-flex gap-2 align-items-center d-<?php echo (isset($_SESSION['user_username'])) ? "block":"none" ?>">
            <p class="fs-6 fw-bold text-white m-0 text-capitalize">
                Welcome <?= $_SESSION['name']; ?>
            </p>
            <a href="logout.php" class="text-decoration-none text-white fs-5"><i class="bi bi-box-arrow-right"></i></a>
        </div>
</div>