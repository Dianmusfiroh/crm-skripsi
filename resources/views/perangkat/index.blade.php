@extends('layouts.main')
@section('content')
<div class="row mt-4  d-flex justify-content-center" >
  <div class="col-lg-7 mb-lg-0 mb-4 ">
    <div class="card z-index-2 h-100" id="contentdata" >
      <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Data Device</h6>
      </div>
      <div class="card-body p-3">
     
        <div class="alert alert-danger text-white" role="alert"> silahkan restart jika terjadi kesalahan</div>
        <div class="d-flex justify-content-center">
          <img src="{{asset('assets/img/noun-connected-2360746.svg')}}" width="100"  alt="">
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Nama Device </label> 
          <label for="staticEmail" class="col-sm-1 col-form-label">:</label> 
          <div class="col-sm-2 col-form-label">
           <p class="title text text-capitalize" id="title"> </p>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-3 col-form-label">Nomor Device </label> 
          <label for="staticEmail" class="col-sm-1 col-form-label">:</label> 
          <div class="col-sm-5 col-form-label">
           <p class="title text text-capitalize" id="nomor"> </p>
          </div>
        </div>
        <div class="form-group row ">
        <a class="btn btn-primary" id="logout">Log Out</a>
        </div>
      </div>
    </div>
    <div class="card z-index-2 h-100" id="contentqr">
      <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Scan QR </h6>
      </div>
      <div class="card-body p-3">
        <div class="alert alert-danger text-white" role="alert"> silahkan restart jika terjadi kesalahan</div>
        <div style="   display: flex;
        justify-content: center;
        align-items: center;" class="spinner-border mx-auto  text-primary" role="status" id="spinner">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="container mt-5">
            <div id="scanDiv" class="col-sm-5 mx-auto  d-flex justify-content-center">
              <img src="" alt="QR Code" id="qrcode" style="display:none">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/jquery-qrcode-master/src/jquery.qrcode.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/jquery-qrcode-master/src/qrcode.js') }}"></script>
@section('js')

{{-- var bar1 = new ldBar("#myItem1");
var bar2 = document.getElementById('myItem1').ldBar;
bar1.set(60); --}}
var refInterval = window.setInterval('update()', 30000); // 30 seconds
var id = 999
$("#spinner").show();
var update =  function() {
    $.ajax({
    type: "GET",
    data:{"perangkat":id},
    url: "http://localhost:3000/session",
    crossDomain: true,
    dataType: 'json',
    success: function (response,data) {
      console.log(response);
      if (response.response.status == 'disconnet') {
        $(`#qrcode`).attr('src', response.response.qrcode).show();
        $('#readyDiv').hide();
        $("#spinner").hide();
        $('#contentqr').show();
        $('#myItem1').hide();
        $('#scanDiv').show();
        $('#contentdata').hide();

        $(`#title`).html('');
      } else if (response.response.status == 'connect') {
        $('#myItem1').hide();
        $('#scanDiv').hide();
        $('#readyDiv').show();
        $("#spinner").hide();
        $('#contentqr').hide();
        $('#contentdata').show();

        $(`#qrcode`).attr('src', '').hide();
        $(`#title`).html(response.response.name);
        $(`#nomor`).html(response.response.number);
        if(!response.response.qrcode){
          $(`.logs`).append($('<li>').text('Silahkan reload jika nama WhatsApp anda tidak tampil'));
        }
      }
    }
  });
};
update();
$('#logout').click(function(e){
  $.ajax({
    url: "http://localhost:3000/logout/",
    crossDomain: true,
    dataType: 'json',
    type: 'GET',
    success:function(){
      window.location.reload();
      alert("Anda akan memutuskan hubungan dengan whatsapp!");
    }
  });
});
@endsection
@endsection