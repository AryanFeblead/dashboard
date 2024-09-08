<div class="container" style="margin-top:3rem; margin-left:16rem;">
<div class="alert alert-success" role="alert" id="success" style="width:68%; margin-left:15rem;">
  This is a success alert—check it out!
</div>
<div class="alert alert-danger" role="alert" id="notsuccess" style="width:68%; margin-left:15rem;">
  This is a danger alert—check it out!
</div>
    <h1 class="text-center">Add Products</h1>
<div class="container" style="width: 70%;">
            <form id="prod_form" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="prod_name" name="prod_name" aria-describedby="emailHelp">
                <div id="prod_nameval">
                  Please choose a product name.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="prod_img" name="prod_img[]" multiple>
                <div id="prod_imgval">
                  Please choose a product image.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
                <input type="number" class="form-control" id="prod_qun" aria-describedby="emailHelp" name="prod_qun">
                <div id="prod_qunval">
                  Please choose a product quantity.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="prod_price" name="prod_price"
                  aria-describedby="emailHelp">
                <div id="prod_priceval">
                  Please choose a product price.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Details</label>
                <textarea name="prod_detail" class="form-control" id="prod_detail"></textarea>
                <div id="prod_detailval">
                  Please choose a product detail.
                </div>
              </div>
              <button id="add_product" class="btn btn-primary">Add Product</button>
            </form>
          </div>
          </div>