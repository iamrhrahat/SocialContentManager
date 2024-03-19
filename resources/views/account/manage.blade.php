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
                            <?php
                            $pages= \App\Models\FacebookPage::all();
                            ?>
                        @if ($pages)
                        <tbody>
                            @foreach ($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->page_name }}</td>
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
                            @endforeach

                        </tbody>
                        @else
    <p>No Facebook pages found.</p>
@endif
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
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-page');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const pageId = this.dataset.id;
                const confirmation = confirm('Are you sure you want to delete this page?');

                if (confirmation) {
                    deletePage(pageId);
                }
            });
        });

        function deletePage(pageId) {
            fetch(`/facebook/pages/${pageId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // Add this header to work with Symfony's CSRF protection
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle success
                alert(data.message); // Show a success message
                // Optionally, you can remove the deleted row from the table
                // const row = document.querySelector(`tr[data-id="${pageId}"]`);
                // if (row) row.remove();
            })
            .catch(error => {
                // Handle error
                console.error('There was a problem with the fetch operation:', error);
            });
        }
    });
</script>
<script>
  $(document).ready(function() {
    $('#DataTables_Table_0').DataTable({
      searching: true // Enable search functionality
    });
  });
</script>

