<div class="container" style="margin-top:3rem; margin-left:16rem;">
    <h1 class="text-center">Add Order</h1>
<div id="add_order1" class="container" style="width: 70%;">
            <div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
              <select id="customer" class="form-select mb-3" aria-label="Default select example">
                <option selected>Select Customer</option>
              </select>
            </div>
            <div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
              <select id="product" class="form-select" aria-label="Default select example">
                <option selected>Select Product</option>
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