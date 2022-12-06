<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products</title>

        <!-- Fonts -->

        <!-- Styles -->

        <link href="{{ asset('css/font.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" integrity="" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable.css') }}">
    </head>
    <body>
        <div class="container-fluid p-3">
                <div class="card col-md-12">
                    <div class="card-body">
                        <div class="mx-auto" style="text-align: center">
                            <h5 style="color:green;" class="card-title"><b>Product Details</b></h5>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Add Products
                            </button>
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Products</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <span id="msg"></span><br>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Product Name</label>
                                                <input type="text" class="form-control" id="product_name" name="product_name" aria-describedby="product_name" placeholder="Enter Product Name" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Product Desc.</label>
                                                <textarea type="text" class="form-control" id="product_desc" name="product_desc" placeholder="Enter Product Desc" required></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Product Price</label>
                                                <input type="text" class="form-control" id="product_price" name="product_price" aria-describedby="product_price" placeholder="Enter Product Price">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Images</label>
                                                <input type="file" class="form-control" id="images" name="images[]" aria-describedby="Images" placeholder="Enter Product Images" multiple="multiple">
                                            </div>
                                            <div class="form-group col-md-6 btnn">
                                                <button onclick="dataSubmit();" type="button" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <table class="table" width="100%" id="product_details" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#SL No.</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Description</th>
                                        <th>Images</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                            <div class="modal fade edit_modal" id="myModal5">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Products</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <span id="msg1"></span><br>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Product Name</label>
                                                <input type="text" class="form-control" id="product_name1" name="product_name" aria-describedby="product_name" placeholder="Enter Product Name" required>
                                                <input type="hidden" id="id" name="id" >
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Product Desc.</label>
                                                <textarea type="text" class="form-control" id="product_desc1" name="product_desc" placeholder="Enter Product Desc" required></textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1">Product Price</label>
                                                <input type="text" class="form-control" id="product_price1" name="product_price" aria-describedby="product_price" placeholder="Enter Product Price">
                                            </div>
                                            <div class="form-group col-md-12 images">
                                            </div>
                                            <div class="form-group col-md-12 image">
                                                <label for="exampleInputEmail1">Images</label>
                                                <input type="file" class="form-control" id="images1" name="images[]" aria-describedby="Images" placeholder="Enter Product Images" multiple="multiple">
                                            </div>
                                            <div class="form-group col-md-6 btnn">
                                                <button onclick="EditdataSubmit();" type="button" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
<script src="{{ asset('js/jquery-slim.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/proper-min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap-min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/datatable.js') }}"></script>
<script>
    function EditdataSubmit(){
        var product_name = $('#product_name1').val();
        var product_price = $('#product_price1').val();
        var product_desc = $('#product_desc1').val();
        var images = $('#images1').prop('files')[0];   ;
        var lengths = $('#images1').get(0).files.length;
        var formData = new FormData()
        formData.append('product_name', product_name);
        formData.append('product_price', product_price);
        formData.append('product_desc', product_desc);
        formData.append('id', $('#id').val());
        for (var index = 0; index < lengths; index++) {
            formData.append("images[]", document.getElementById('images1').files[index]);
        }
       // console.log('test '+lengths);
        if(product_name !== '' && product_price !== '' && product_desc !== ''){
        //alert(project);
            $.ajax({
                type: 'POST',
                url: '<?php echo url('/editProductSave'); ?>',
                data: formData,
                headers: {
                    'X-CSRF-Token': '<?php echo csrf_token() ?>'
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    //console.log(data);
                    if(data == 'Datasave SuccessFull'){
                        $('#product_name').val('');
                        $('#product_price').val('');
                        $('#product_desc').val('');
                        $('#images').val('');
                        $('#msg1').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data+' .<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                         table.destroy();
                         myFunction();
                        editModal($('#id').val());
                    }else{
                        $('#msg1').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data+' .<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                }
            });
        }
    }
    function editModal(id){
        if (id) {
            $('#msg').html('');
            $('#msg1').html('');
            $.ajax({
                type: 'POST',
                url: '<?php echo url('/fetchProductByid'); ?>',
                data: {id:id},
                headers: {
                    'X-CSRF-Token': '<?php echo csrf_token() ?>'
                },
                success: function (data) {
                    //console.log(data);
                    $('#product_name1').val(data.product_name);
                    $('#product_price1').val(data.product_price);
                    $('#product_desc1').val(data.product_description);
                    $('#id').val(data.id);
                    var split = data.product_images.split(',');
                    var imges = '';
                    for(var i=0;i<split.length;i++){
                         imges += '<img style="width:30px;" src="<?php echo asset('uploads/'); ?>/' + split[i] + '" />&nbsp;&nbsp;';
                    }
                    //console.log("<?php echo asset('uploads/'); ?>");
                    $(".images").html(imges);
                }
            });
        }
    }
    function confirms(id){
        let text = "Are You Sure Want to Delete the Task ?";
        if (confirm(text) == true) {
            $.ajax({
                type: 'POST',
                url: '<?php echo url('/deleteProduct'); ?>',
                data: {id:id},
                headers: {
                    'X-CSRF-Token': '<?php echo csrf_token() ?>'
                },
                success: function (data) {
                    //console.log(data);
                    if(data == 'SuccessFull'){
                         table.destroy();
                         myFunction();
                    }
                }
            });
        }
    }
    var table;
    function myFunction(){
        table = $('#product_details').DataTable( {
            "ajax": {
            'url': '<?php echo url('/fetchProducts'); ?>',
            'type': 'POST',
            'headers': {
                    'X-CSRF-Token': '<?php echo csrf_token() ?>'
            },
            'data': '',
            'dataSrc': function ( json ) {
                //console.log(json.data);
                return json.data;
            },
            },
            "pageLength": 25,
            "ordering": false,
            // "dom": '<"toolbar">frtip',
            "columns": [
                        { "data":'id'},
                        { "data":'product_name'},
                        { "data":'product_price'},
                        { "data":'product_description'},
                        { "data":'product_images'},
                        { "data":'created_at'},
                        {
                            "data" : "id",
                            'render': function (data, type, full, meta){
                                return '<a onclick="confirms('+"'"+data+"'"+');" type="button" class="btn btn-danger btn-sm">Delete</a><a onclick="editModal('+"'"+data+"'"+');" type="button"  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal5">Edit</a>';
                            }
                        }
            ],
            //"deferRender": true,
            'order': [1, 'asc']
        } );
        //alert();
    }
    myFunction();
    function dataSubmit(){
        var product_name = $('#product_name').val();
        var product_price = $('#product_price').val();
        var product_desc = $('#product_desc').val();
        var images = $('#images').prop('files')[0];   ;
        var lengths = $('#images').get(0).files.length;
        var formData = new FormData()
        formData.append('product_name', product_name);
        formData.append('product_price', product_price);
        formData.append('product_desc', product_desc);
        for (var index = 0; index < lengths; index++) {
            formData.append("images[]", document.getElementById('images').files[index]);
        }
       // console.log('test '+lengths);
        if(product_name !== '' && product_price !== '' && product_desc !== '' && lengths > 0){
        //alert(project);
            $.ajax({
                type: 'POST',
                url: '<?php echo url('/productSave'); ?>',
                data: formData,
                headers: {
                    'X-CSRF-Token': '<?php echo csrf_token() ?>'
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    //console.log(data);
                    if(data == 'Datasave SuccessFull'){
                        $('#product_name').val('');
                        $('#product_price').val('');
                        $('#product_desc').val('');
                        $('#images').val('');
                        $('#msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data+' .<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                         table.destroy();
                         myFunction();
                    }else{
                        $('#msg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data+' .<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                }
            });
        }
        // else{
        //     console.log(product_name + ' ' + product_price + ' ' + ' ' + product_desc + ' ' + images);
        // }
    }
</script>
