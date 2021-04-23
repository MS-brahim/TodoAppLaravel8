<!doctype html>
<html lang="en">
  <head>
    <title>Todo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h3 class="text-center mt-5">ToDo List</h3>
        <div class="card bg-light my-4" style="width: auto;">
            <div class="card-header">
                <form class="input-group" action="/create" method="POST">
                    {{csrf_field()}}
                    <input type="text" class="form-control" placeholder="title..." name="name" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Date created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                        <tr>
                            <td>{{ $todo->name }}</td>
                            <td>
                                <form action="/{{ $todo->id }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    @if($todo->completed==0)
                                    <h6> <button type="submit" value="1" class="badge badge-warning">Loading</button></h6>
                                    @else
                                    <h6> <button type="submit" class="badge badge-success" value="0">Completed</button></h6>
                                    @endif
                                </form>
                                
                            </td>
                            <td>{{ $todo->created_at }}</td> 
                            <td class="float-right">
                                <div  class="btn-group" role="group">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#todoEdit{{ $todo->name }}">Pen</button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="todoEdit{{ $todo->name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="input-group" action="/{{ $todo->id }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    
                                                        <input type="text" class="form-control" value="{{$todo->name}}" name="name" />
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary mt-4" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Model  -->
                                    <form action="/{{ $todo->id }}" method="POST">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>