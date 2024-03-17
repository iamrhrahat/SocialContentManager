@extends('layout')
@section('content')
<head>
    <style>
        .container {
          display: flex;
          flex-wrap: wrap;
        }

        .card_box {
          width: calc(20% - 20px); /* Adjust the width as needed */
          margin: 10px;
          background-color: #ffffff;
          border-radius: 10px;
          overflow: hidden;
        }

        .white_box_tittle {
          background-color: #f5f5f5;
          padding: 10px;
        }

        .main-title2 {
          font-size: 18px;
        }

        .box_body {
          padding: 20px;
        }

        .card_box {
  width: 200px; /* Set the width of the card */
  text-align: center;
}

.box_body {
  padding: 20px;
}

.card_box i {
  font-size: 40px; /* Set the size of the icon */
  margin-bottom: 10px;
}

.facebook-color {
  color: #3b5998; /* Facebook brand color */
}

.instagram-color {
  color: #833ab4; /* Instagram brand color */
}

.pinterest-color {
  color: #bd081c; /* Pinterest brand color */
}

.tiktok-color {
  color: #000000; /* Tiktok brand color */
}

.google-color {
  color: #4285f4; /* Google brand color */
}

.yelp-color {
  color: #af0606; /* Yelp brand color */
}

        .connect-btn {
          background-color: #007bff;
          color: #ffffff;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s ease;
        }

        .connect-btn:hover {
          background-color: #0056b3;
        }
      </style>

</head>
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <i class="fab fa-facebook-f facebook-color"></i>
                <h4 class="mb-2 nowrap">Facebook</h4>
                <form action="{{route('facebook.connect')}}" method="get">
                    @csrf
                    <button class="connect-btn" type="submit">Connect</button>
                </form>
              </div>
            </div>

            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <i class="fab fa-instagram instagram-color"></i>
                <h4 class="mb-2 nowrap">Instagram</h4>
                <button class="connect-btn">Connect</button>
              </div>
            </div>

            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <i class="fab fa-pinterest-p pinterest-color"></i>
                <h4 class="mb-2 nowrap">Pinterest</h4>
                <button class="connect-btn">Connect</button>
              </div>
            </div>

            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <i class="fab fa-tiktok"></i>
                <h4 class="mb-2 nowrap">Tiktok</h4>
                <button class="connect-btn">Connect</button>
              </div>
            </div>

            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <i class="fab fa-google google-color"></i>
                <h4 class="mb-2 nowrap">GMB</h4>
                <button class="connect-btn">Connect</button>
              </div>
            </div>

            <div class="card_box box_shadow position-relative mb_30">
              <div class="box_body">
                <i class="fab fa-yelp yelp-color"></i>
                <h4 class="mb-2 nowrap">Yelp</h4>
                <button class="connect-btn">Connect</button>
              </div>
            </div>
          </div>



    </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Maq1sUHq5yR6F2s8bMmJ02w9Ejkmr8Ae3BYBX0T3KmX5mh3HKwSoHHlA/qIcFXAG06CMbQ5Dpi4Ms7cQaJeHBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
