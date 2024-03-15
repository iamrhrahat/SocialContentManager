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
                    <table class="table lms_table_active dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                      <thead>
                        <tr role="row">
                          <th scope="col" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th>
                          <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 400px;" aria-label="Account Name: activate to sort column ascending">Account Name</th>
                          <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row" class="odd">
                          <td>1</td>
                          <td>Account 1</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr role="row" class="even">
                          <td>2</td>
                          <td>Account 2</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
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

