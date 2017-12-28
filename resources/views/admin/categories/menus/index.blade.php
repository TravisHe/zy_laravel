@extends('layouts.admin')

@section('content')
  <h2>Menus</h2>

  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">分类</h4>
          <p class="category">Here is a subtitle for this table</p>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>Name</th>
              <th>Intro</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($menus)
                @foreach($menus as $key => $menu)
                <tr>
                  <td>{{$menu->id}}</td>
                  <td class="text-primary"><a href="#">{{$menu->name}}</a></td>
                  <td>{{$menu->intro}}</td>
                  <td>{{$menu->created_at ? $menu->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$menu->updated_at ? $menu->created_at->diffForHumans() : 'No Date'}}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@stop
