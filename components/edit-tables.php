<div class="container-fluid py-4">
    <div class="container">
        <div class="col-md-12 d-md-flex gap-2">
            <div class="col-md-4 p-4 shadow rounded">
                <h6 class="smfs-5 text-uppercase text-comp text-center mb-3">Add Crude Oil Data</h6>
                <form action="sub-crude.php" method="post">
                    <label for="date-added">Date:</label>
                    <input type="text" id="date-added" name="date-added" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="asset-name">Asset Name:</label>
                    <input type="text" id="asset-name" name="asset-name" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" id="price" name="price" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <input type="submit" value="Submit" class="border-0 p-2 rounded">
                </form>
            </div>
            
            <div class="col-md-4 p-4 shadow rounded">
            <h6 class="smfs-5 text-uppercase text-comp text-center mb-3">Add Exchange Rate Data</h6>
                <form action="sub-exch.php" method="post">
                    <label for="date-added">Date:</label>
                    <input type="text" id="date-added" name="date-added" required="required" class="w-100 mb-3 border-0 bg-light py-2">
                    <label for="currency">Currency Name:</label>
                    <input type="text" id="currency" name="currency" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="buying">Buying:</label>
                    <input type="number" step="0.0001" id="buying" name="buying" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="central">Central:</label>
                    <input type="number" step="0.0001" id="central" name="central" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="selling">Selling:</label>
                    <input type="number" step="0.0001" id="selling" name="selling" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="strength">Currency Strength:</label>
                    <select name="pl" id="strength" class="mb-3 border-0 shadow p-2 rounded">
                        <option value="strong">Strong</option>
                        <option value="weak">Weak</option>
                    </select><br/><br/>
                    <input type="submit" value="Submit" class="border-0 p-2 rounded">
                </form>
            </div>

            <div class="col-md-4 p-4 shadow rounded">
            <h6 class="smfs-5 text-uppercase text-comp text-center mb-3">Add Financial Data</h6>
                <form action="sub-fin.php" method="post">
                    <label for="date-added">Date:</label>
                    <input type="text" id="date-added" name="date-added" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="asset-name">Asset Name:</label>
                    <input type="text" id="asset-name" name="asset-name" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" id="price" name="price" required="required" class="w-100 mb-3 border-0 bg-light py-2 rounded">
                    <input type="submit" value="Submit" class="border-0 p-2 rounded">
                </form>
            </div>
        </div>
    </div>
</div>


