<div class="modal fade" id="Update">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="UpdateLabel">Update Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p id="up-messages-error"></p>
                <form class action method="post" enctype="multipart/form-data">
                  <div class="row g-3">
                    <div class="col-md-12">
                      <label for="contact">Product Name</label>
                      <input type="text" class="form-control mt-2" name="prod_name1" id="prod_name1"
                        Placeholder="Enter Name *" required>
                      <div id="prod_nameval1">
                        Please choose a product name.
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="contact">Product Image</label>
                      <input type="file" class="form-control mt-2" name="prod_img1" id="prod_img1"
                        Placeholder="User Email *" required>
                      <div id="prod_imgval1">
                        Please choose a product image.
                      </div>
                      <div id="add_img">

                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Product Quantity</label>
                      <input type="number" class="form-control" name="prod_qun1" id="prod_qun1">
                      <div id="prod_qunval1">
                        Please choose a product quantity.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Product Price</label>
                      <input type="number" class="form-control" name="prod_price1" id="prod_price1">
                      <div id="prod_priceval1">
                        Please choose a product price.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Product Detail</label>
                      <textarea class="form-control" id="prod_address1" rows="3" name="prod_address1"></textarea>
                      <div id="prod_detailval1">
                        Please choose a product detail.
                      </div>
                    </div>
                  </div>
                  </from>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_update">Update Now</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_close">Close</button>
              </div>
            </div>
          </div>
        </div>