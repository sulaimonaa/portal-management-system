<?php session_start() ?>
<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center p-hero">
    <h1 class="text-capitalize text-white text-center">Payment Solution</h1>
    <p class="text-white text-center">Get all updates on payment service providers available</p>
</div>
<div class="container-fluid py-2">
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
        <div class="news d-flex flex-column col-md-7 mb-3">
        <h5 class="fs-5 text-uppercase text-comp mb-2 text-center">Licensed payments service provider </h5>
        <p class="text-center mb-3">Find below available payment solution/providers  </p>
            <div class="mb-0">
            <h5 class="fw-bold fs-5 bg-comp text-light p-2 text-uppercase mb-0">Card payment schemes</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-dark table-hover">
                    <thead class="text-light text-uppercase">
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">licensee</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>3Line Card Management Limited</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Afrigo Financial Services Limited</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mastercard International</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Verve International</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 2 -->
            <div class="mb-0">
            <h5 class="fw-bold fs-5 bg-comp text-light p-2 text-uppercase mb-0">MOBILE MONEY OPERATOR LICENSE CATEGORY</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-success table-hover">
                    <thead class="text-light text-uppercase">
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">licensee</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>eTranzact International Limited</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Funds And Electronic Transfer (FETS) Limited</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Opay Digital Services Limited</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Xpress MTS Limited</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 3 -->
            <div class="mb-0">
            <h5 class="fw-bold fs-5 bg-comp text-light p-2 text-uppercase mb-0">SWITCHING & PROCESSING LICENSE CATEGORY</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-primary table-hover">
                    <thead class="text-light text-uppercase">
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">licensee</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Arca Payments Company Limited</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Coralpay Technology Nigeria Limited</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>eTranzact International Limited</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Flutterwave Technology Solutions Limited</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 4 -->
            <div class="mb-0">
            <h5 class="fw-bold fs-5 bg-comp text-light p-2 text-uppercase mb-0">PAYMENT SOLUTION SERVICE PROVIDER (PSSP) AUTHORISATION</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-info table-hover">
                    <thead class="text-light text-uppercase">
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">licensee</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Akupay Services Limited</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Afara Partners Limited</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Aliancepay Limited</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Betastack Technology Limited</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 5 -->
            <div class="mb-0">
            <h5 class="fw-bold fs-5 bg-comp text-light p-2 text-uppercase mb-0">PAYMENT TERMINAL SERVICES PROVIDER (PTSP) AUTHORISATION</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-warning table-hover">
                    <thead class="text-light text-uppercase">
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">licensee</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>3gee Pay Limited</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>3Line Card Management</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Appmart Integrated Limited</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Konetpay Nigeria Limited</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="exchange-short col-md-5 mt-md-3 mb-3">
            <?php include 'components/exchange-v1.php'; ?>
        </div>
    </div>
</div>
</div>
<?php include 'includes/footer.php'; ?>