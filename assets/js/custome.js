$(document).ready(function() {
    $('#prod_nameval,#prod_imgval,#prod_qunval,#prod_priceval,#prod_detailval,#notsuccess,#success,#customer_nameval,#customer_emailval,#customer_phoneval,#customer_addressval,#customer_genderval,#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide();
    $('#product,#customer').select2();

    var productsArray = [];
    $('#order_btn').click(function(e) {
        e.preventDefault();
        var customer = $('#customer').val();
        var productId = $('#product').val();

        $.ajax({
            type: "POST",
            url: baseUrl + "add_order",
            data: {
                customer: customer,
                productId: productId,
            },
            success: function(data) {
                try {
                    let product = data;
                    console.log(product);
                    var price = parseFloat(product.prod_price);
                    var qun = parseInt(product.prod_quantity, 10);

                    var productObj = {
                        id: productId,
                        name: product.prod_name,
                        price: price,
                        quantity: 1,
                        subtotal: price * 1
                    };
                    console.log(productObj);
                    productsArray.push(productObj);

                    const inputString = product.prod_img;
                    const commaIndex = inputString.indexOf(',');
                    const result = commaIndex !== -1 ? inputString.substring(0, commaIndex) : inputString;

                    var row = '<div class="product-item">';
                    row += '<div class="d-flex justify-content-between">';
                    row += '<div>';
                    row += '<img src="uploads/' + result + '" height="75px" width="75px">';
                    row += '<h4>' + product.prod_name + '</h4>';
                    row += '</div>';
                    row += '<div>';
                    row += '<p id="price_' + productId + '">' + price + '</p>';
                    row += '</div>';
                    row += '<div>';
                    row += '<select class="form-select quantity" data-index="' + productId + '" aria-label="Default select example">';
                    row += '<option selected value="' + 1 + '">' + 1 + '</option>';
                    for (var i = 2; i <= qun; i++) {
                        row += '<option value="' + i + '">' + i + '</option>';
                    }
                    row += '</select>';
                    row += '</div>';
                    row += '<div>';
                    row += '<p id="subtotal_' + productId + '">' + (price * 1).toFixed(2) + '</p>';
                    row += '</div>';
                    row += '</div>';
                    row += '<div class="text-end">';
                    row += '<button class="del btn btn-danger">Remove</button>';
                    row += '</div>';
                    row += '</div>';

                    $('#checkout').show();
                    $('#all_order').append(row);

                    // updateTotalAmount();

                    // Bind click event for dynamically created .del buttons
                    // $('.del').off('click').on('click', function() {
                    //     var removedProduct = $(this).closest('.product-item');
                    //     var removedProductId = removedProduct.find('.quantity').data('index');

                    //     productsArray = productsArray.filter(function(prod) {
                    //         return prod.id !== removedProductId;
                    //     });

                    //     updateTotalAmount();

                    //     removedProduct.remove();
                    // });

                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function() {
                $('#notsuccess').show().delay(2000).fadeOut().html('Product Added Failed');
            }
        });
    });

    $(document).on('change', '.quantity', function() {
        var productId = $(this).data('index'); // Get productId from data-index attribute
        var newQuantity = parseInt($(this).val(), 10); // Get new quantity selected

        // Find the product object in productsArray by productId
        var productIndex = productsArray.findIndex(function(prod) {
            return productId === productId;
        });

        if (productIndex !== -1) {
            // Update quantity in productsArray
            productsArray[productIndex].quantity = newQuantity;

            // Calculate new subtotal based on updated quantity
            var price = productsArray[productIndex].price;
            var newSubtotal = price * newQuantity;
            productsArray[productIndex].subtotal = newSubtotal;

            // Update subtotal displayed in the UI
            var $subtotalElement = $('#subtotal_' + productId);
            if ($subtotalElement.length > 0) {
                $subtotalElement.text(newSubtotal.toFixed(2)); // Update subtotal text
            }

            // Optionally update other UI elements related to this product

            // Call function to update total amount
            updateTotalAmount();
        } else {
            console.log('Product with ID', productId, 'not found in productsArray.');
        }
    });


    $('#checkout').click(function(e) {
        e.preventDefault();
        var customer = $('#customer').val();

        // Prepare data for checkout from productsArray
        var checkoutData = {
            customer: customer,
            productsArray: productsArray, // Send all products to backend for checkout
            actionName: 'checkout'
        };

        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: checkoutData,
            success: function(data) {
                var response = JSON.parse(data);
                if (response.status == 'success') {
                    $('.product-item').remove(); // Remove all product items from UI
                    $('.btn-success').hide();
                    $('#all_prod_total').hide();
                    $('#success').show().delay(2000).fadeOut().html("Product Checkout Successfully");
                } else {
                    $('#notsuccess').show().html('Failed to checkout products');
                }
            },
            error: function() {
                $("#prod_form")[0].reset();
                $('#notsuccess').show().html('Product Checkout Failed');
            }
        });
    });

    // Function to update total amount displayed
    function updateTotalAmount() {
        var totalAmount = 0;
        productsArray.forEach(function(product) {
            totalAmount += product.subtotal;
        });

        $('#all_prod_total').css('display', 'block');
        $('#all_prod_total').text('Total Amount: ' + totalAmount.toFixed(2));
    }

    $('#prod_form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        let isValid = true;
        if ($('#prod_name').val() == '') {
            $('#prod_nameval').show().css('color', 'red');
            isValid = false;
        } else {
            $('#prod_nameval').hide();
        }

        if ($('#prod_qun').val() == '') {
            $('#prod_qunval').show().css('color', 'red');
            isValid = false;
        } else {
            $('#prod_qunval').hide();
        }

        if ($('#prod_price').val() == '') {
            $('#prod_priceval').show().css('color', 'red');
            isValid = false;
        } else {
            $('#prod_priceval').hide();
        }

        if ($('#prod_detail').val() == '') {
            $('#prod_detailval').show().css('color', 'red');
            isValid = false;
        } else {
            $('#prod_detailval').hide();
        }

        if ($('#prod_img').val() == '') {
            $('#prod_imgval').show().css('color', 'red');
            isValid = false;
        } else {
            $('#prod_imgval').hide();
        }

        if (isValid) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: baseUrl + "add_product",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    var data1 = JSON.parse(data);
                    if (data1.status == 'success') {
                        $("#prod_form")[0].reset();
                        $('#success').show().delay(2000).fadeOut().html("Product Added Successfully");
                    } else {
                        $('#notsuccess').show().html('Product Addition Failed');
                    }
                },
                error: function() {
                    $('#notsuccess').show().html('Product Addition Failed');
                }
            });
        }
    });



    function viewProduct() {

        $.ajax({
            type: "GET",
            url: baseUrl + "view_product",
            data: {},
            success: function(data) {
                data1 = data.data.product;
                var rows = '';
                $.each(data1, function(index, product) {
                    const inputString = product.prod_img;
                    const commaIndex = inputString.indexOf(',');
                    const result = commaIndex !== -1 ? inputString.substring(0, commaIndex) : inputString;
                    rows += '<tr>';
                    rows += '<td>' + product.prod_id + '</td>';
                    rows += '<td>' + product.prod_name + '</td>';
                    rows += '<td><img src="uploads/' + result + '" height="50px" width="50px"></td>';
                    rows += '<td>' + product.prod_quantity + '</td>';
                    rows += '<td>' + product.prod_price + '</td>';
                    rows += '<td>' + product.prod_detail + '</td>';
                    rows += '<td><a data-id="' + product.prod_id + '" class="btn btn-primary edit">Edit</a></td>';
                    rows += '<td><a data-id="' + product.prod_id + '" class="btn btn-danger delete">Delete</a></td>';
                    rows += '</tr>';
                });

                $('#result').html(rows);
                $('#prod_tbl').DataTable();

                $('.edit').on('click', function() {
                    var id = $(this).data('id');
                    fetchData(id);
                    $(document).on('click', '#btn_update', function() {
                        updateData(id);
                    })
                });

                $('.delete').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "POST",
                            url: baseUrl + "deleteProduct",
                            data: {
                                id: id,
                                actionName: 'prod_delete'
                            },
                            success: function(response) {
                                var data = $.parseJSON(response);
                                if (data.status === "success") {
                                    $('#success').show().delay(2000).fadeOut();
                                    $('#success').html("Product Deleted Successfully");
                                    window.location.reload();
                                }
                            },
                            error: function(status, error) {
                                console.error("AJAX Error: " + status + error);
                            }
                        });
                    } else {
                        return false;
                    }
                })
            },
            error: function(status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    }
    viewProduct();

    $('#customer_phone').on('input', function() {
        if ($(this).val().length > 10) {
            $(this).val($(this).val().substring(0, 10));
        }
    });

    $('#customer_form').on('submit', function(e) {
        e.preventDefault();

        var isValid = true;

        $('.validation-message').hide();

        if ($('#customer_name').val() == '') {
            $('#customer_nameval').show().css('color', 'red');
            isValid = false;
        }

        var email = $('#customer_email').val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email == '') {
            $('#customer_emailval').show().css('color', 'red');
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $('#customer_emailval').show().css('color', 'red').html('Invalid email format');
            isValid = false;
        }

        var phone = $('#customer_phone').val();
        if (phone == '') {
            $('#customer_phoneval').show().css('color', 'red');
            isValid = false;
        } else if (phone.length < 10) {
            $('#customer_phoneval').show().html("Mobile no. should be 10 digits").css('color', 'red');
            isValid = false;
        }

        if ($('.customer_gender:checked').val() == undefined) {
            $('#customer_genderval').show().css('color', 'red');
            isValid = false;
        }

        if ($('#customer_address').val() == '') {
            $('#customer_addressval').show().css('color', 'red');
            isValid = false;
        }


        if (isValid) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: baseUrl + "add_customer",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    var data1 = JSON.parse(data);
                    console.log(data1);
                    if (data1.status == 'contacterror') {
                        $('#customer_phoneval').html('Contact Already exist');
                        $('#customer_phoneval').show();
                        $('#customer_phoneval').css('color', 'red');
                    }
                    if (data1.status == 'emailerror') {
                        $('#customer_emailval').html('Email Already exist');
                        $('#customer_emailval').show();
                        $('#customer_emailval').css('color', 'red');
                    }
                    if (data1.status == 'success') {
                        console.log('success');
                        $('#success').show().delay(2000).fadeOut().html("Customer Added Successfully");
                        $('#customer_nameval,#customer_emailval,#customer_phoneval,#customer_addressval,#customer_genderval').hide();
                        $("#customer_form")[0].reset();
                    }
                },
                error: function() {
                    $("#customer_form")[0].reset();
                    $('#notsuccess').show().html('Product Added Failed');
                }
            });
        }
    });


    function viewCustomer() {
        $.ajax({
            type: "GET",
            url: baseUrl + "view_customer",
            data: {},
            success: function(data) {
                data1 = data.data.customer;
                var rows = '';
                $.each(data1, function(index, customer) {
                    rows += '<tr>';
                    rows += '<td>' + customer.customer_id + '</td>';
                    rows += '<td>' + customer.customer_name + '</td>';
                    rows += '<td>' + customer.customer_email + '</td>';
                    rows += '<td>' + customer.customer_phone + '</td>';
                    rows += '<td>' + customer.customer_gender + '</td>';
                    rows += '<td>' + customer.customer_address + '</td>';
                    rows += '<td><a data-id="' + customer.customer_id + '" class="btn btn-primary edit1">Edit</a></td>';
                    rows += '<td><a data-id="' + customer.customer_id + '" class="btn btn-danger delete1">Delete</a></td>';
                    rows += '</tr>';
                });

                $('#result1').html(rows);
                $('#customer_tbl').DataTable();

                $('.edit1').on('click', function() {
                    var id = $(this).data('id');
                    fetchDatacustomer(id);
                    $(document).on('click', '#btn_update1', function() {
                        if ($('#customer_name').val() == '') {
                            $('#customer_nameval1').show().css('color', 'red');
                        }
                        if ($('#prod_qun1').val() == '') {
                            $('#prod_qunval1').show().css('color', 'red');
                        }
                        if ($('#prod_price1').val() == '') {
                            $('#prod_priceval1').show().css('color', 'red');
                        }
                        if ($('#prod_detail1').val() == '') {
                            $('#prod_detailval1').show().css('color', 'red');
                        }
                        if ($('#prod_img1').val() == '') {
                            $('#prod_imgval1').show().css('color', 'red');
                        } else {
                            var formData = new FormData();
                            formData.append('customer_id', id);
                            formData.append('actionName', 'update');
                            $.ajax({
                                url: 'assets/php/ajx.php',
                                method: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    $('#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide()
                                    $('#Update').modal('hide');
                                    $('.alert-success').show().fadeOut(function() {});
                                    $('.alert-success').html("Data Updated Successfully");
                                    $('.alert-success').hide();
                                },
                                error: function() {
                                    $('.alert-danger').show().delay(2000).fadeOut();
                                    $('.alert-danger').html("Data not Updated!!!");
                                    $('.alert-danger').hide();
                                }
                            });
                        }
                    })
                });
                $('.delete1').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id)
                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "POST",
                            url: "assets/php/ajx.php",
                            data: {
                                id: id,
                                actionName: 'customer_delete'
                            },
                            success: function(response) {
                                var data = $.parseJSON(response);
                                if (data.status === "success") {
                                    $('#success').show().delay(2000).fadeOut();
                                    $('#success').html("Customer Deleted Successfully");
                                    window.location.reload();
                                }
                            },
                            error: function(status, error) {
                                +console.error("AJAX Error: " + status + error);
                            }
                        });
                    } else {
                        return false;
                    }
                })
            },
            error: function(status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    }
    viewCustomer();

    $('#customer_report').on('change', function() {
        var customer_report = $('#customer_report').val();
        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: {
                customer_report: customer_report,
                actionName: 'customer_report'
            },
            success: function(data) {
                // Clear previous chart data
                if (window.myChart) {
                    window.myChart.destroy();
                }

                var data1 = JSON.parse(data);
                var productData = data1;


                console.log(data1);

                // Initialize arrays to store labels, revenue data, and sales data
                var labels = [];
                var revenueData = [];
                var salesData = [];

                const months1 = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                for (let index = 0; index < 12; index++) {
                    labels.push(months1[index]);
                }

                // Extract the necessary data from the productData array
                for (var i = 0; i < productData.length; i++) {
                    var product = productData[i];
                    var quantity = product.prod_quantity;
                    var prod_subtotal = product.prod_subtotal;
                    revenueData.push(quantity);
                    salesData.push(quantity);
                }

                var ctx = $('#productChart')[0].getContext('2d');
                window.myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Sales',
                            data: salesData,
                            backgroundColor: 'rgba(255,99,132,0.2)',
                            borderColor: 'rgba(255,99,132,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });
            },
            error: function(status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    });

    function report() {

        $.ajax({
            type: "GET",
            url: baseUrl + "view_report",
            data: {},
            success: function(data) {
                console.log(data);
                if (window.myChart) {
                    window.myChart.destroy();
                }
                // var data1 = JSON.parse(data);
                var productData = data;

                var labels = [];
                var revenueData = [];
                var salesData = [];

                const months = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                for (let index = 0; index < 12; index++) {
                    labels.push(months[index]);
                }

                // Extract the necessary data from the productData array
                for (var i = 0; i < productData.length; i++) {
                    var product = productData[i];
                    var quantity = product.prod_quantity;
                    var prod_subtotal = product.prod_subtotal;
                    revenueData.push(quantity);
                    salesData.push(quantity);
                }

                // Create a bar chart using Chart.js
                var ctx = $('#productChart')[0].getContext('2d');
                window.myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Sales',
                            data: salesData,
                            backgroundColor: 'rgba(255,99,132,0.2)',
                            borderColor: 'rgba(255,99,132,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });

            },
            error: function(status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    }
    report()

    function viewOrder() {
        $.ajax({
            type: "GET",
            url: baseUrl + "view_order",
            data: {},
            success: function(data) {
                console.log();
                data1 = data.data.order;
                var rows = '';
                $.each(data1, function(index, data1) {
                    rows += '<tr>';
                    rows += '<td>' + data1.customer_product_id + '</td>';
                    rows += '<td>' + data1.customer_name + '</td>';
                    rows += '<td>' + data1.prod_name + '</td>';
                    rows += '<td>' + data1.prod_price + '</td>';
                    rows += '<td>' + data1.prod_quantity + '</td>';
                    rows += '<td>' + data1.prod_subtotal + '</td>';
                    rows += '<td><a data-id="' + data1.customer_product_id + '" class="btn btn-primary edit1">Edit</a></td>';
                    rows += '<td><a data-id="' + data1.customer_product_id + '" class="btn btn-danger delete1">Delete</a></td>';
                    rows += '</tr>';
                });

                $('#result3').html(rows);
                $('#order_tbl').DataTable();

                $('.edit1').on('click', function() {
                    var id = $(this).data('id');
                    fetchDatacustomer(id);
                    $(document).on('click', '#btn_update1', function() {
                        if ($('#customer_name').val() == '') {
                            $('#customer_nameval1').show().css('color', 'red');
                        }
                        if ($('#prod_qun1').val() == '') {
                            $('#prod_qunval1').show().css('color', 'red');
                        }
                        if ($('#prod_price1').val() == '') {
                            $('#prod_priceval1').show().css('color', 'red');
                        }
                        if ($('#prod_detail1').val() == '') {
                            $('#prod_detailval1').show().css('color', 'red');
                        }
                        if ($('#prod_img1').val() == '') {
                            $('#prod_imgval1').show().css('color', 'red');
                        } else {
                            var formData = new FormData();
                            formData.append('customer_id', id);
                            formData.append('actionName', 'update');
                            $.ajax({
                                url: 'assets/php/ajx.php',
                                method: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    $('#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide()
                                    $('#Update').modal('hide');
                                    $('.alert-success').show().fadeOut(function() {
                                        // window.location.reload()
                                    });
                                    $('.alert-success').html("Data Updated Successfully");
                                    $('.alert-success').hide();
                                },
                                error: function() {
                                    $('.alert-danger').show().delay(2000).fadeOut();
                                    $('.alert-danger').html("Data not Updated!!!");
                                    $('.alert-danger').hide();
                                }
                            });
                        }
                    })
                });
                $('.delete1').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id)
                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "POST",
                            url: "assets/php/ajx.php",
                            data: {
                                id: id,
                                actionName: 'customer_delete'
                            },
                            success: function(response) {
                                var data = $.parseJSON(response);
                                if (data.status === "success") {
                                    $('#success').show().delay(2000).fadeOut();
                                    $('#success').html("Customer Deleted Successfully");
                                    window.location.reload();
                                }
                            },
                            error: function(status, error) {
                                +console.error("AJAX Error: " + status + error);
                            }
                        });
                    } else {
                        return false;
                    }
                })
            },
            error: function(status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    }
    viewOrder()

    function fetchData(id) {

        console.log(id);
        $('#Update').modal('show');
        $.ajax({
            url: 'assets/php/ajx.php',
            method: 'post',
            data: {
                id: id,
                actionName: 'fetch'
            },
            dataType: 'JSON',
            success: function(data) {

                $('#prod_name1').val(data[0]);
                var img = JSON.parse(data[1]);
                var add_img = '';
                $.each(img, function(index, user1) {
                    add_img += ' <img src="assets/php/uploads/' + img[index] + '" height="50px" width="50px"> ';
                });
                $('#add_img').html(add_img);
                $('#prod_qun1').val(data[2]);
                $('#prod_price1').val(data[3]);
                $('#prod_address1').val(data[4]);

                $('#Update').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function fetchDatacustomer(id) {

        console.log(id);
        $('#Update1').modal('show');
        $.ajax({
            url: 'assets/php/ajx.php',
            method: 'post',
            data: {
                id: id,
                actionName: 'customerfetch'
            },
            dataType: 'JSON',
            success: function(data) {

                $('#customer_name1').val(data[0]);
                $('#customer_email1').val(data[1]);
                $('#customer_phone1').val(data[2]);
                if (data[3] == 'male') {
                    $('#male').prop('checked', true);
                } else {
                    $('#female').prop('checked', true);
                }
                $('#customer_address1').val(data[4]);

                $('#Update1').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function updateData(id) {

        if ($('#prod_name1').val() == '') {
            $('#prod_nameval1').show().css('color', 'red');
        }
        if ($('#prod_qun1').val() == '') {
            $('#prod_qunval1').show().css('color', 'red');
        }
        if ($('#prod_price1').val() == '') {
            $('#prod_priceval1').show().css('color', 'red');
        }
        if ($('#prod_detail1').val() == '') {
            $('#prod_detailval1').show().css('color', 'red');
        }
        if ($('#prod_img1').val() == '') {
            $('#prod_imgval1').show().css('color', 'red');
        } else {
            var prod_name1 = $('#prod_name1').val();
            var prod_qun1 = $('#prod_qun1').val();
            var prod_price1 = $('#prod_price1').val();
            var prod_detail1 = $('#prod_address1').val();
            var prod_img1 = $('#prod_img1').val();
            console.log($('#prod_img1').val());
            var formData = new FormData();
            formData.append('prod_id', id);
            formData.append('prod_name1', prod_name1);
            formData.append('prod_img1', prod_img1);
            formData.append('prod_qun1', prod_qun1);
            formData.append('prod_price1', prod_price1);
            formData.append('prod_detail1', prod_detail1);
            formData.append('actionName', 'update');
            $.ajax({
                url: 'assets/php/ajx.php',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide()
                    $('#Update').modal('hide');
                    $('.alert-success').show().fadeOut(function() {
                        // window.location.reload()
                    });
                    $('.alert-success').html("Data Updated Successfully");
                    $('.alert-success').hide();
                },
                error: function() {
                    $('.alert-danger').show().delay(2000).fadeOut();
                    $('.alert-danger').html("Data not Updated!!!");
                    $('.alert-danger').hide();
                }
            });
        }
    }
});