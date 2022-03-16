<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Book Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .book-container{
            margin-left:120px;
            margin-top:50px;
        }
        *{
            font-size:12px;
        }
    </style>
</head>
<body>
    
    {{-- Cateogry Registration --}}

    {{-- Table Content --}}


<div class="container book-container">
    <h1>Category</h1><br>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewBook"> Create New Category</a><br><br>
    <table class="table table-bordered data-table" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Category Name</th>   
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


{{-- Modal Class --}}

   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="bookForm" name="bookForm" class="form-horizontal">
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                     <span id ="notification"></span>
                    <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="book-container">
    <h1>Book</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewBookHandler"> Create New Book</a><br><br>
    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading2"></h4>
                </div>
                <div class="modal-body">
                    <form id="bookForm2" name="bookForm2" class="form-horizontal">
                       <input type="hidden" name="book_id" id="book_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="bookName" name="bookName" placeholder="Enter Book Name" value="" maxlength="50" required=""><br>
                            </div>
                            <label for="name" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-12">
                                <select name="categorySelector" id="categorySelector" class="form-control" style="width:300px;" >
                                   @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                   @endforeach
                                </select><br>
                            </div>
    
                            <label for="name" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="Price" name="Price" placeholder="Enter Price" value="" maxlength="50" required=""><br>
                            </div>
    
                            <label for="name" class="col-sm-2 control-label">Author</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="Author" name="Author" placeholder="Enter Author Name" value="" maxlength="50" required=""><br>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-primary" id="saveBtn2" value="create">Save changes</button><br>
                         <span id ="notification"></span>
                        <br><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container book-container">
    <table class="table table-bordered data-table2"  id="table2" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Name</th> 
                <th>Price</th>
                <th>Author</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table><br><br><br>
</div>


{{-- Book Registration --}}




    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  


<script type="text/javascript">


    /* Security Token */
    
    
    $(function () {

        // Security Token

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // Display Table Data


        var table = $('#table').DataTable({
            
            processing: true,
            serverSide: true,
            ajax: "{{ route('index.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'category_name', name: 'category_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        var table_book=$('#table2').DataTable({
            
            processing: true,
            serverSide: true,
            ajax: "indexBook",
            columns: [
                {data:  'id',            name:  'id'            },
                {data:  'book_name',     name:  'book_name'     },
                {data:  'price',         name:  'price'         },
                {data:  'author',        name:  'author'        },
                {data:  'category_name',   name:  'category_name'   },
                {data:  'action',        name:  'action', orderable: false, searchable: false},
            ],
        });


        // Click New Category Button Model Popup


        $('#createNewBook').click(function () {
            $('#saveBtn').val("create-book");
            $('#category_id').val('');
            $('#bookForm').trigger("reset");
            $('#modelHeading').html("Create New Category");
            $('#ajaxModel').modal('show');
        });

        $('#createNewBookHandler').click(function () {
            $('#saveBtn').val("create-book");
            $('#category_id').val('');
            $('#bookForm').trigger("reset");
            $('#modelHeading2').html("Create New Book");
            $('#ajaxModel2').modal('show');
        });


        // Save Button in Modal


        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saved');
            $('notification').html('Data Saved Successfully !');
        
            $.ajax({
                data: $('#bookForm').serialize(),
                url: "{{ route('index.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#bookForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Something Went Wrong ! Please Try Again.');
                }
            });
        });


        $('#saveBtn2').click(function (e) {
            e.preventDefault();
            $(this).html('Saved');        
            $.ajax({
                data: $('#bookForm2').serialize(),
                url: "{{url('saveBook') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#bookForm2').trigger("reset");
                    $('#ajaxModel2').modal('hide');
                    table.draw();
                
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn2').html('Something Went Wrong ! Please Try Again.');
                }
            });
        });


        // Edit Button

        
        $('body').on('click', '.editBook', function () {
            var category_id = $(this).data('id');
            $.get("{{ route('index.index') }}" +'/' + category_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Category");
                $('#saveBtn').val("edit-book");
                $('#ajaxModel').modal('show');
                $('#category_id').val(data.id);
                $('#category_name').val(data.category_name);
            })
        });

        $('body').on('click', '.editBook2', function () {
            var book_id = $(this).data('id');
            // alert(book_id);
            $.get("{{ url('edit') }}"+'/'+book_id, function (data) {
                $('#modelHeading2').html("Edit Book");
                $('#saveBtn2').val("edit-book");
                $('#ajaxModel2').modal('show');
                $('#book_id').val(data.id);
                $('#bookName').val(data.book_name);
                $('#Price').val(data.price);
                $('#Author').val(data.author);
                // $('#categorySelector').val(data.category_name);
            })
        });


        // Delete Button


         $('body').on('click', '.deleteBook', function () {
     
            var category_id = $(this).data('id');
           
            confirm("Are You sure want to delete ?");
        
            $.ajax({
                // type: "DELETE",
                url:"{{url('destroy') }}"+"/"+category_id,
                success: function (data) {
                    // $('#table').DataTable().ajax.reload(); //To reload DataTable
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });


        $('body').on('click', '.deleteBook2', function () {
     
            var book_id = $(this).data("id");
            // alert (category_id);
            confirm("Are You sure want to delete ?");
        
            $.ajax({
                type: "DELETE",
                url: "{{ url('delete') }}"+'/'+book_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        


    });


</script>
</body>
</html>