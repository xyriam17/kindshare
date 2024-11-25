@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kindshare - Donate Now')

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-payment.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
  ])
<style>
  .donation-form {
    max-width: 700px;
    margin: 0 auto;
  }
  .donationtype.hidden{
    display: none !important;
  }
</style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/cleavejs/cleave.js',
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',

    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
  'resources/assets/js/pages-pricing.js',
  'resources/assets/js/front-page-payment.js',
  'resources/js/donation.js'
])
@endsection

@section('content')
<section class="section-py bg-body first-section-pt  ">
  <div class="container">
    <div class="w-full md:w-auto donation-form">
    <div class="card ">
      <h5 class="card-header">Donation Form</h5>
      <form id="form-donate">
        @csrf
      <div class="card-body">
        <div class="row">
          <div class="mb-4 col-md-12">
              <input class="form-check-input" type="checkbox" value="" id="donate-anonymous">
              <label class="form-check-label" for="defaultCheck1">
                Donate as a anonymous
              </label>
              <input type="hidden" name="checkanonymous" id="check-anonymous">
          </div>

          <div class="mb-4 col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Firstname</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" data-keeper-lock-id="k-efsoifgi8h">
          </div>
          <div class="mb-4 col-md-6">
            <label for="exampleFormControlReadOnlyInput1" class="form-label">Lastname</label>
            <input class="form-control" type="text"  placeholder="" name="lastname" id="lastname">
          </div>
          <div class="mb-4 col-md-6">
            <label for="exampleFormControlReadOnlyInput1" class="form-label">Email</label>
            <input class="form-control" type="email" name="email" id="email"  placeholder="" >
          </div>
          <div class="mb-4 col-md-6">
            <label for="exampleFormControlReadOnlyInput1" class="form-label">Phone Number</label>
            <input class="form-control" type="text" name="contact_number" id="contact_number"  placeholder="" >
          </div>
          <div class="mb-4 col-md-12">
              <label for="exampleFormControlSelect1" class="form-label">Type of Donation</label>
              <select class="form-select"  name="donation_type" id="donation-type">
                <option value="money" selected>Money</option>
                <option value="inkinds">Inkinds</option>
                <option value="food">Food</option>
              </select>
          </div>
          <div  claass="mb-4 col-md-12 donationtype" id="donation-money">
          <div class="mb-4 col-md-12">
             <label for="exampleFormControlReadOnlyInput1" class="form-label">Amount (<small>Minimum amount : 100</small>)</label>

            <input class="form-control" type="number" name="amount" id="amount" min="100"  placeholder="0.00" >
          </div>

        </div>
          <div class="mb-4 col-md-12 donationtype hidden" id="donation-inkinds">
            <div class="row">
              <div class="mb-4 col-md-6">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Quanity</label>
               <input class="form-control" type="number" name="quantity"  id="quantity" placeholder="0.00" >
             </div>
             <div class="mb-4 col-md-6">
              <label for="exampleFormControlReadOnlyInput1" class="form-label">Unit</label>
               <select name="unit" id="unit" class="form-select">
                  <option value="sacks">Sacks</option>
               </select>
           </div>
            </div>
               <div class="col-md-12">
                  <label for="exampleFormControlReadOnlyInput1" class="form-label">Description</label>
                  <textarea name="description" id="description" readonly class="form-control" value="Assorted Clothing" disabled>Assorted Clothing</textarea>
                </div>

         </div>
         <div class="mb-4 col-md-12 donationtype hidden" id="donation-food">
          <div class="row">
            <div class="mb-4 col-md-6">
              <label for="exampleFormControlReadOnlyInput1" class="form-label">Food Type</label>
               <select name="food-type" id="food-type" class="form-select">
                <option value="canned-goods" selected>Canned Goods</option>
                <option value="noodles">Noodles</option>
                <option value="water">Water</option>
                <option value="grains">Grains</option>
                <option value="biscuits">Biscuits</option>
                <option value="other">Others</option>
               </select>
           </div>
            <div class="mb-4 col-md-6">
              <label for="exampleFormControlReadOnlyInput1" class="form-label">Quanity</label>
             <input class="form-control" type="number" name="food_quanity" id="food_quanity" placeholder="0.00" >
           </div>
           <div class="mb-4 col-md-6">
            <label for="exampleFormControlReadOnlyInput1" class="form-label">Expiry</label>
             <input type="date" class="form-control" name="expiry" id="expiry">
         </div>
           <div class="mb-4 col-md-6">
            <label for="exampleFormControlReadOnlyInput1" class="form-label">Unit</label>
             <input type="text" name="food_unit" id="food_unit" class="form-control">
         </div>
          </div>
             <div class="col-md-12">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Name/Description</label>
                <textarea name="food_description" id="food_description" class="form-control"></textarea>
              </div>
       </div>
        </div>

        <div class="mb-4 col-md-12">
          <button type="button" class="btn btn-primary waves-effect waves-light" id="submitDonation">Submit Donation</button>
     </div>
      </div>
    </form>
    </div>
    </div>
  </div>
</section>

<!-- Modal -->
@include('_partials/_modals/modal-pricing')
<!-- /Modal -->
@endsection
