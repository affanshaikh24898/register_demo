<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ajax ToDo List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>
<body>
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Project Task List<a href="#" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i></a></h3>
                        </div>
                        <div class="panel-body" id="allItems">
                            <ul class="list-group">
                                @foreach($items as $item)
                                    <li class="list-group-item our-item" data-toggle="modal" data-target="#myModal">{{ $item->item }}
                                        <input type="hidden" id="itemId" value="{{ $item->id }}">
                                    </li>
                                @endforeach
                            </ul>     
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-2">
                    <a class="btn btn-primary" href="/dashboard"> Back</a>
                </div>

               
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="title">Add New Task</h4>
                            </div>
                            <div class="modal-body">
                                 <input type="hidden" id="id">
                              <p><input type="text" placeholder="Write Item Here" id="addItem" class="form-control"></p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-warning" id="deleteItem" data-dismiss="modal" style="display:none">Delete</button>
                              <button type="button" class="btn btn-primary" id="saveItem" data-dismiss="modal" style="display:none">Save changes</button>
                              <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
                            </div>
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
        {{ csrf_field() }}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function(){
                $(document).on("click", ".our-item", function(event){
                    var text = $(this).text();
                    var id   = $(this).find("#itemId").val();
                    var text = $.trim(text);
                    $("#addItem").val(text);
                    $("#title").text("Edit Item");
                    $("#saveItem").show(400);
                    $("#deleteItem").show(400);
                    $("#addButton").hide(400);
                    $("#id").val(id);
                });
            
            $(document).on("click" , "#addNew" , function(event){
                    $("#addItem").val("");
                    $("#title").text("Add New Item");
                    $("#saveItem").hide(400);
                    $("#deleteItem").hide(400);
                    $("#addButton").show(400);
            });
            $("#addButton").click(function(event){
                var text = $("#addItem").val();
                if(text == ""){
                    alert("Please Write anything for Item");
                }else{
                    $.post('list', {'text' : text, '_token':$('input[name=_token]').val()} , function(data){
                        $("#allItems").load(location.href + " #allItems");
                        alert(data);
                    });
                }
            });
            $("#saveItem").click(function(event){
                var confirmation = confirm("are you sure you want to change this list?");
                if (confirmation) {
                    var id = $("#id").val();
                    var value = $("#addItem").val();
                    $.post('update', {'id' : id, 'value' : value, '_token':$('input[name=_token]').val()} , function(data){
                        $("#allItems").load(location.href + " #allItems");
                        alert(data);
                    });
                }
            });
            $("#deleteItem").click(function(event){
                var confirmation = confirm("are you sure you want to remove this list?");
                if (confirmation) {
                    var id = $("#id").val();
                    $.post('delete', {'id' : id, '_token':$('input[name=_token]').val()} , function(data){
                        $("#allItems").load(location.href + " #allItems");
                        alert(data);
                    });
                }
            });
        });
    </script>
</body>
</html>