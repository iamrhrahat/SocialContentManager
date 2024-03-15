@extends('layout')

@section('content')
<form action="#" method="POST">
    @csrf
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
    <div class="row justify-content-center">
    <div class="col-lg-7">
        <textarea name="body" id="body" rows="5" class="form-control" style="resize: none; height: calc(100vh - 350px);" placeholder="Write your post here..." required></textarea>
    </div>
    <div class="col-lg-5">
    <div class="white_card card_height_100 mb_30">
    <div class="white_card_header">
    <div class="box_header m-0">
    <div class="main-title">
    <h3 class="m-0">Accounts</h3>
    <div class="form-check mt-3">
        <input type="checkbox" name="social_accounts[]" value="facebook" id="facebook" class="form-check-input">
        <label for="facebook" class="form-check-label">Facebook Page</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="social_accounts[]" value="instagram" id="instagram" class="form-check-input">
        <label for="instagram" class="form-check-label">Instagram Account</label>
    </div>

</form>
    </div>
    </div>
    </div>

    </div>
    </div>
    <div class="row-lg-12">
    <button type="submit" value="Submit"></button>
</div>
    </div>
    </div>
    </div>
@endsection
