<div class="container" style="margin-top:3rem; margin-left:16rem;">
<div class="alert alert-success" role="alert" id="success" style="width:68%; margin-left:15rem;">
  This is a success alert—check it out!
</div>
<div class="alert alert-danger" role="alert" id="notsuccess" style="width:68%; margin-left:15rem;">
  This is a danger alert—check it out!
</div>
    <h1 class="text-center">Add Customer</h1>
    <div id="add_customer1" class="container" style="width: 70%;">
        <form id="customer_form" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name">
                <div id="customer_nameval">
                    Please choose a customer name.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Customer Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email">
                <div id="customer_emailval">
                    Please choose a customer email.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Customer Phone</label>
                <input type="number" class="form-control" id="customer_phone" name="customer_phone"
                aria-describedby="emailHelp">
                <div id="customer_phoneval">
                  Please choose a customer phone.
                </div>
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Customer Gender - </label>
                  <label for="exampleInputEmail1" class="form-label">Male</label>
                  <input type="radio" name="customer_gender" class="customer_gender" value="male" id="customer_gender1"
                  aria-describedby="emailHelp">
                  <label for="exampleInputEmail1" class="form-label">Female</label>
                  <input type="radio" id="customer_gender2" name="customer_gender" class="customer_gender"
                  value="female" id="customer_gender2" aria-describedby="emailHelp">
                  <div id="customer_genderval">
                      Please choose a customer gender.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Customer City</label>
                    <input type="text" name="customer_address" class="form-control" id="customer_address">
                    <div id="customer_addressval">
                        Please choose a customer city.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Customer</button>
            </form>
          </div>
            </div>