<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <form action="">

        <label for="cars">User:</label>

        <select name="usersdw" id="usersdw">
            @foreach ($users as $user)
                <option value="{{ $user->name }}">{{ $user->email }}</option>
            @endforeach
        </select>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            add user
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewmodal">
            view
        </button>





        <div class="form-group">
            <label for="name">text</label>
            <input type="text" class="form-control" id="text" name="test" aria-describedby="emailHelp"
                placeholder="Name">

        </div>

    </form>



    <div id ='msg'>This message will be replaced using Ajax.
        Click the button to replace the message.</div>




    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <form action="{{ route('create') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="emailHelp" placeholder="Name">

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>

                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    </form>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" id="user_create"class="btn btn-primary">Submit</button>

                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- @include('add_user_modal'); --}}


    <!-- Modal -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <p id="selectedUserName"></p>
                    <p id="selectedUserEmail"></p>
                </div>



            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



    <script>
        $(document).ready(function() {
            $("#user_create").click(function() {
                $.ajax({
                    url: '/create',
                    method: 'POST',
                    data: {
                        _token: '<?php echo csrf_token(); ?>',
                        name: $('#name').val(),
                        email: $('#exampleInputEmail1').val(),
                    },
                    success: function(result) {
                        console.log(result);
                        $("#msg").html("User added successfully.");

                        // Add a new option to the select element and set it as selected
                        $("#usersdw").append('<option value="' + result.user.name +
                            '" selected>' + result.user.email + '</option>');

                        // Close the modal
                        $('#exampleModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $("#msg").html("Error adding user. Please try again.");
                    }
                })
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            // Triggered when the value of the select changes
            $("#usersdw").change(function() {
                // Get the selected option's values
                var selectedName = $("#usersdw option:selected").text();
                var selectedEmail = $("#usersdw").val();

                // Display the values in the modal
                $("#selectedUserName").text("Name: " + selectedName);
                $("#selectedUserEmail").text("Email: " + selectedEmail);
            });
        });
    </script>



</body>

</html>
