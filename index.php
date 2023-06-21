<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .errorColor {
            color: #d30000;
        }
    </style>
    <title>CRUD-APP</title><!-- Latest compiled and minified CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">CRUD</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <!-- <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">details</a>
                </li>
            </ul> -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-dark font-weight-normal my-3"> Single page CRUD application </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary"> All Users in database!</h4>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal"><i class="fa-solid fa-user"></i>&nbsp; &nbsp; Add New User</button>

                <a href="action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp; Export to Excel</a>
            </div>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser">
                    <h3 class="text-center text-success" style="margin-top: 150px;">Loading...</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" id="form-data" method="post" class="needs-validation">
                        <div id="errorMessage" class="alert alert-danger d-none"></div>
                        <div class="form-group">
                            <!-- <label>Enter First Name<span class="text-danger">*</span></label> -->
                            <input type="text" name="fname" id="first" class="form-control" placeholder="First Name" minlength="3">
                            <!-- <span class="text-danger"></span> -->
                            <!-- <div id="errorMessage1" class="alert alert-danger d-none"></div> -->
                            <span class="alert alert-danger d-none" id="errorMessage1"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" id="last" class="form-control" placeholder="Last Name">
                            <div id="errorMessage2" class="alert alert-danger d-none"></div>
                            <!-- <span class="text-danger"></span> -->
                        </div>
                        <div class="form-group">
                            <input type="number" name="age" id="a" class="form-control" placeholder="Age" min="10" max="100">
                            <div id="errorMessage3" class="alert alert-danger d-none"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="em" class="form-control" placeholder="Email id" >
                            <!-- <span class="text-danger"></span> -->
                            <div id="errorMessage4" class="alert alert-danger d-none"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="contact" id="cont" class="form-control" placeholder="Contact Number">
                            <div id="errorMessage5" class="alert alert-danger d-none"></div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="submit" name="insert" id="insert" value="Add User" class="btn btn-danger btn-block">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" id="edit-form-data" method="post">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="fname" class="form-control" id="fname">
                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" class="form-control" id="lname" >
                        </div>
                        <div class="form-group">
                            <input type="number" name="age" class="form-control" id="age" >
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="contact" class="form-control" id="contact" maxlength="10">
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="submit" name="update" id="update" value="Update User" class="btn btn-primary btn-block">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery library
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script> -->

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            showAllUsers();

            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        //console.log(response);
                        $('#showUser').html(response);
                        $("table").DataTable({
                            order: [0, 'desc'],
                            processing: true,
                            serverside: true,
                            limit: 10
                        });
                    }
                });
            }

            // $("#first").on("blur", function() {
            //     if ($(this).val().match('^[a-zA-Z]{3,16}$')) {
            //         // alert("Valid name");

            //     } else {
            //         swal.fire({
            //             title: "You enter wrong first name",
            //             icon: 'warming',
            //             text: 'Name should only contain alphabets',
            //             showCancelButton: true
            //         })
            //     }
            // });
            // $("#last").on("blur", function() {
            //     if ($(this).val().match('^[a-zA-Z]{3,16}$')) {
            //         // alert("Valid name");

            //     } else {
            //         swal.fire({
            //             title: "You enter wrong last name",
            //             icon: 'warming',
            //             text: 'Name should only contain alphabets',
            //             showCancelButton: true
            //         })
            //     }
            // });
            // $('#em').on("blur", function() {
            //     if ($(this).val().match('/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/')) {

            //     } else {
            //         swal.fire({
            //             title: "You enter wrong email address",
            //             icon: 'warming',
            //             text: 'Email should contain @ and .',
            //             showCancelButton: true
            //         });
            //     }
            // });

            // $('#form-data').formValidation({
            //     framework: 'bootstrap',
            //     excluded: ':disabled',
            //     icon: {
            //         vvalid: 'glyphicon glyphicon-ok',
            //         invalid: 'glyphicon glyphicon-remove',
            //         validating: 'glyphicon glyphicon-refresh'
            //     },
            //     fields: {
            //         fname:{
            //             validators:{
            //                 notEmpty:{
            //                     message: 'Name is required'
            //                 }
            //             }
            //         },

            //     }
            // })
            // insert ajax request
            $('#insert').click(function(e) {
                if ($('#form-data')[0].checkValidity()) {
                    e.preventDefault();
                    var fuser=$('#first').val();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(response) {
                            var data=jQuery.parseJSON(response);
                            // if(data.id == 'fname')
                            if(data.status == 00){
                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(data.message);
                            } else if(data.status == 200){
                                $('#errorMessage').addClass('d-none');
                                // $("#errorMessage").hide();
                                swal.fire({
                                    title: 'User Added Successfully',
                                    type: 'success'
                                })
                                $("#addModal").modal('hide');
                                $('#form-data')[0].reset();
                                console.log(response);
                                showAllUsers();
                            } else if(data.status ==500){
                                alert(data.message);
                            } 
                            $("#first").focusout(function(){
                                
                            });
                            if(data.id == 1){
                                $('#errorMessage1').removeClass('d-none');
                                $('#errorMessage1').text(data.message);
                                // if(!fuser==""){
                                //     $('#errorMessage1').addClass('d-none');
                                // }

                            }
                            if(data.id==2){
                                $('#errorMessage2').removeClass('d-none');
                                $('#errorMessage2').text(data.message);   
                            }
                            if(data.id==3){
                                $('#errorMessage3').removeClass('d-none');
                                $('#errorMessage3').text(data.message);   
                            }
                            if(data.id==4){
                                $('#errorMessage4').removeClass('d-none');
                                $('#errorMessage4').text(data.message);   
                            }
                            if(data.id==5){
                                $('#errorMessage5').removeClass('d-none');
                                $('#errorMessage5').text(data.message);   
                            }

                            //console.log(response);
                            // swal.fire({
                            //     title: 'User Added Successfully',
                            //     type: 'success'
                            // })
                            // $("#addModal").modal('hide');
                            // $('#form-data')[0].reset();
                            // showAllUsers();
                        }
                    });
                }
            });
            // edit user
            $("body").on("click", ".editBtn", function(e) {
                //console.log("working");
                e.preventDefault();
                edit_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        console.log(data);
                        $("#id").val(data.id);
                        $("#fname").val(data.fname);
                        $("#lname").val(data.lname);
                        $("#age").val(data.age);
                        $("#email").val(data.email);
                        $("#contact").val(data.contact);
                    }
                });
            });
            // update ajax request
            $('#update').click(function(e) {
                if ($('#edit-form-data')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(response) {
                            //console.log(response);

                            var data=jQuery.parseJSON(response);
                            if(data.status == 422){
                                $('#errorMessage').removeClass('d-none');
                                $('#errorMessage').text(data.message);
                            } else if(data.status == 200){
                                $('#errorMessage').addClass('d-none');
                                swal.fire({
                                    title: 'User Updated Successfully',
                                    type: 'success'
                                })
                                $("#editModal").modal('hide');
                                $('#edit-form-data')[0].reset();
                                console.log(response);
                                showAllUsers();
                            } else if(data.status ==500){
                                alert(data.message);
                            }

                            // swal.fire({
                            //     title: 'User Updated Successfully',
                            //     type: 'success'
                            // })
                            // $("#editModal").modal('hide');
                            // $('#edit-form-data')[0].reset();
                            // showAllUsers();
                        }
                    });
                }
            });
            // Delete Ajax Request
            $("body").on("click", ".delBtn", function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                del_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: {
                                del_id: del_id
                            },
                            success: function(response) {
                                tr.css('background-color', '#ff6666');
                                Swal.fire({
                                    title: 'User Deleted Successfully',
                                    type: 'success'
                                })
                                showAllUsers();
                            }
                        });
                    }
                });
            });
            // View Detail
            $("body").on("click", ".infoBtn", function(e) {
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(response) {
                        //console.log(response);
                        data = JSON.parse(response);
                        swal.fire({
                            title: '<strong>User Info : ID(' + data.id + ')</strong>',
                            type: 'info',
                            html: '<b>First Name :</b>' + data.fname + '<br><b>Last Name :</b>' + data.lname + '<br><b>Age : </b>' + data.age + '<br><b>Email id: </b>' + data.email + '<br><b>Contact No. : </b>' + data.contact,
                            showCancelButton: true,

                        })
                    }
                });
            });
        });
    </script>
</body>

</html>
<?php

?>