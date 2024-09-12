<div class="container" style="margin-top:3rem; margin-left:16rem;">
<div class="alert alert-success" role="alert" id="success" style="width:68%; margin-left:15rem;">
  This is a success alert—check it out!
</div>
<div class="alert alert-danger" role="alert" id="notsuccess" style="width:68%; margin-left:15rem;">
  This is a danger alert—check it out!
</div>
    <h1 class="text-center">Add Order</h1>
<div id="add_order1" class="container" style="width: 70%;">
            <div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
              <select id="customer" class="form-select mb-3" aria-label="Default select example">
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
            <div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
              <select id="product" class="form-select" aria-label="Default select example">
                <option selected>Select Product</option>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo htmlspecialchars($product['prod_id']); ?>">
                            <?php echo htmlspecialchars($product['prod_name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>No products available</option>
                <?php endif; ?>
              </select>
            </div>
            <button id="order_btn" class="btn btn-primary mx-5">Add Product</button>
            <div id="all_order">
              <h1 class="text-center">Cart Items</h1>
              <div class="d-flex justify-content-between">
                <p>Item</p>
                <p>Price</p>
                <p>Quantity</p>
                <p>Subtotal</p>
              </div>
            </div>
            <div>
              <h4 id="all_prod_total" style="display: none;"></h4>
              <button class="btn btn-success float-end mt-2" id="checkout" style="display: none;">Submit Order</button>
            </div>
          </div>
          </div>