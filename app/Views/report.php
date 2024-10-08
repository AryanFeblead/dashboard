<div class="container" style="margin-top:3rem; margin-left:20rem; width: 80%;">
    <h1 class="text-center">Report</h1>
<div id="report1">
<div class="container">
<div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
<select id="customer_report" class="form-select mb-3" aria-label="Default select example">
<option selected>Select Customer</option>
<?php if (!empty($customers)): ?>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?php echo htmlspecialchars($customer['customer_id']); ?>">
                                <?php echo htmlspecialchars($customer['customer_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled>No customers available</option>
                    <?php endif; ?>
</select>
</div>
</div>
<div id="chart1" style="width:790px; margin:50px auto; border:1px solid #ddd;">
<canvas id="productChart"></canvas>
</div>
</div>
</div>