<?php
session_start();

if (!in_array($_SESSION['user_level'], ['aggregator', 'Commodities Brokers', 'Specialized Commodities Dealer', 'Commodities Broker Dealer', 'Commodities Trader']) || $_SESSION['user_approval'] !== 'approved') {
    header('Location: dashboard.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'components/navigation.php'; ?>
<div class="container-fluid bg-comp-2 py-4">
    <div class="container">
        <div class="d-flex flex-row justify-content-between">
            <div class="smfs-6">
                <a href="aggregator.php" class="text-secondary">
                    <i class="bi bi-house text-secondary"></i>
                </a>
                <span class="text-secondary">
                    | Dashboard</span>
            </div>
        </div>
    </div>
</div>
<div class="container py-4 agr">
   
    <div class="d-md-flex flex-column align-items-center justify-content-around" style="min-height: 540px;">
        <div class="d-md-flex flex-column">
             <div class="d-flex justify-content-between align-items-center gap-4">
            <h2 class="fs-5 text-uppercase text-secondary">Register A Dealing Member</h2>
            <a href="aggregator.php" class="smfs-5 text-uppercase text-secondary text-decoration-none"><i class="bi bi-arrow-90deg-left"></i> back</a>
        </div>
            <h5 class="smfs-5 mb-3">Select dealing member from the available list.</h5>
            <form id="mainForm">
                <select id="formSelect" class="bg-light border-0 text-secondary p-2 rounded">
                    <option value="">--Select a Member--</option>
                    <option value="option-1">Option 1</option>
                    <option value="option-2">Option 2</option>
                    <option value="option-3">Option 3</option>
                    <option value="option-4">Option 4</option>
                    <option value="option-5">Option 5</option>
                    <option value="option-6">Option 6</option>
                    <option value="option-7">Option 7</option>
                    <option value="option-8">Option 8</option>
                    <option value="option-9">Option 9</option>
                    <option value="option-10">Option 10</option>
                </select>
            </form>
        </div>
        <div class="d-md-flex align-items-center">
            <!-- Form Sections -->
            <div id="option-1" class="form-section">
                <h3>Form for Option 1</h3>
                <form>
                    <label for="input1">Input 1:</label>
                    <input type="text" id="input1" name="input1"><br><br>
                    <label for="input2">Input 2:</label>
                    <input type="text" id="input2" name="input2"><br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div id="option-2" class="form-section">
                <h3>Form for Option 2</h3>
                <form>
                    <label for="inputA">Input A:</label>
                    <input type="text" id="inputA" name="inputA"><br><br>
                    <label for="inputB">Input B:</label>
                    <input type="text" id="inputB" name="inputB"><br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>