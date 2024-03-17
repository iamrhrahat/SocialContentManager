@extends('layout')
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <div class="QA_table mb_30">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table table-bordered table-striped" id="pageTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Account Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Account 1</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Account 2</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>

    </div>
    </div>
</div>
@endsection
<!-- Include jQuery and DataTables library -->
<!-- Include jQuery and DataTables library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#DataTables_Table_0').DataTable({
      searching: true // Enable search functionality
    });
  });
</script>

