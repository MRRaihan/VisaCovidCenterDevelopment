@extends('ImmigrationOfficer.layouts.master')

@push('title')
Dashboard
@endpush

@push('css')

@endpush

@section('content')
<div class="tab-content w-100 " id="v-pills-tabContent">
    <div class="tab-pane fade show active " id="v-pills-home" role="tabpanel"
        aria-labelledby="v-pills-home-tab">
        <!--================= first container start===================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card w-75 my-3">
                        <img src="{{ asset($latestImmigration->passedUser->image ?? get_static_option('no_image')) }}" class="card-img-top img-fluid spy-card" alt="User Image">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="text-muted info-font">Name</h6>
                                <h5 class="info-font">{{ $latestImmigration->passedUser->name }}</h5>
                                <h6 class="text-muted info-font">Passport</h6>
                                <h5 class="info-font">{{ $latestImmigration->passedUser->userInfo->passport_no }}</h5>
                            </div>
                            <h6 class="text-muted">Status</h6>
                            <div class="text-center">

                                <button class="btn {{ $latestImmigration->passedUser->vaccination->date_of_first_dose ? 'btn-success' : 'btn-danger' }}">Vaccine-1</button>
                                <button class="btn {{ $latestImmigration->passedUser->vaccination->date_of_second_dose ? 'btn-success' : 'btn-danger' }} m-1">Vaccine-2</button>
                                <button class="btn  {{ $latestImmigration->passedUser->booster->date ? 'btn-success' : 'btn-danger' }} m-1">Booster</button>
                                <button class="btn btn-danger">PCR</button>
                            </div>
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <button class="btn w-100 btn-primary my-2 " id="nav-profile-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">
                                    <span class="mx-2"><i class="fa fa-bars"></i></span>
                                    Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        <div class="card  shadow details-card my-3 mx-0 ">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8 d-flex">
                                            <img src="{{ asset($latestImmigration->passedUser->image ?? get_static_option('no_image')) }}" height="100px" width="100px"
                                                alt="">
                                            <div class="information-card p-2">
                                                <h3 class="info-font">Anuska Rahman</h3>
                                                <h5 class="info-font">Uttara 10, Dhaka-1230, bangladesh</h5>
                                                <h6 class="info-font">+880 182 765 342</h6>
                                            </div>
                                        </div>

                                        <div class="col-md-4 d-flex justify-content-center mt-1">
                                            <div class="content ">
                                                <img src="./assest/img/Logo/logo2.jpeg" alt="">
                                                <div class="qr mt-3">
                                                    <img src="./assest/img/Spy/QR.PNG" alt="" width="80px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="new3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div
                                            class="col-md-4 details-card-info d-flex justify-content-center align-items-center">
                                            <h3>Vaccine 1</h3>
                                        </div>
                                        <div class="col-md-8 details-card-info">
                                            <div class="row">
                                                <div class="col-md-8 p-2">
                                                    <h6>Moderna</h6>
                                                    <h6>Received at Hospital_Name</h6>
                                                    <h6>23rd October 2021</h6>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <img src="./assest/img/Spy/1.png" alt="" height="80px"
                                                        width="80px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div
                                            class="col-md-4 details-card-info2 d-flex justify-content-center align-items-center">
                                            <h3>Vaccine 2</h3>
                                        </div>
                                        <div class="col-md-8 details-card-info2">
                                            <div class="row">
                                                <div class="col-md-8 p-2">
                                                    <h6>Moderna</h6>
                                                    <h6>Received at Hospital_Name</h6>
                                                    <h6>23rd October 2021</h6>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <img src="./assest/img/Spy/1.png" alt="" height="80px"
                                                        width="80px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div
                                            class="col-md-4 details-card-info3 d-flex justify-content-center align-items-center">
                                            <h3>Booster</h3>
                                        </div>
                                        <div class="col-md-8 details-card-info3">
                                            <div class="row">
                                                <div class="col-md-8 p-2">
                                                    <h6>Moderna</h6>
                                                    <h6>Received at Hospital_Name</h6>
                                                    <h6>23rd October 2021</h6>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <img src="./assest/img/Spy/1.png" alt="" height="80px"
                                                        width="80px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div
                                            class="col-md-4 details-card-info4 d-flex justify-content-center align-items-center">
                                            <h3>PCR</h3>
                                        </div>
                                        <div class="col-md-8 details-card-info4">
                                            <div class="row">
                                                <div class="col-md-8 p-2">
                                                    <h6>Negative</h6>
                                                    <h6>Received at Hospital_Name</h6>
                                                    <h6>Vailidity 23rd Oct 21, 14:20-25th Oct 21, 14:20</h6>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <img src="./assest/img/Spy/Checkmark-green-tick-isolated-on-transparent-background-PNG.png"
                                                        alt="" height="80px" width="80px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================= first container end===================== -->
    </div>
    {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <div class="eabzn tg-container">
            <div class="eabd">
                <div class="row ">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="accorion-link filter-btn mt-2">
                                    <div class="accorion-btn dropdown">
                                        <button class="dropbtn" onclick="myFunction()"><img
                                                src="./assest/img/menu.png" alt=""> Fiter</button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="#home">Home</a>
                                            <a href="#about">About</a>
                                            <a href="#contact">Contact</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group search-abc">
                                    <input type="text" class="form-control search-table" placeholder="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary btn-color-search" type="button"
                                            data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eabd  table-hp">
                    <div class="row ">
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm table-text-color sl-o'>Sl</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm table-text-color'>Date & time</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm table-text-color'>Name</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm table-text-color'>Passport</p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm img-text-center table-text-color'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm img-text-center table-text-color'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm img-text-center table-text-color'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm table-text-color'>Booster</p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm table-text-color'>PCR</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eabd takla ">
                    <div class="row moblie-border">
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Sl</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p class="sl-o">01</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Date & time</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p>12:30 PM 12/09/21</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Name</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p>Mustafizur Rahman</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Passport</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p>123 432 321</p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="img-bnt"></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="img-bnt"></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="img-bnt"></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Booster</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="bootster-btn "></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>PCR</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="pcr-btn "></button></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eabd takla ">
                    <div class="row moblie-border">
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Sl</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p class="sl-o">02</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Date & time</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p>12:30 PM 12/09/21</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Name</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p>Mustafizur Rahman</p>
                            </div>
                        </div>
                        <div class="col-sm-2 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Passport</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p>123 432 321</p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="img-bnt"></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="img-bnt"></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'><img
                                        src="./assest/img/vacchine.png" alt="./assest/img/vacchine.png"></p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="img-bnt"></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>Booster</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="bootster-btn "></button></p>
                            </div>
                        </div>
                        <div class="col-sm-1 ">
                            <div class='bldec '>
                                <p class='hidden-sm hidden-md hidden-lg vliss Tab-table'>PCR</p>
                                <p class='hidden-sm hidden-md hidden-lg vsiss Tab-table'> : </p>
                                <p><button class="pcr-btn "></button></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="card mt-3 w-50 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Logged in as</h5>
                        <h3>Immigration Officer</h3>
                        <button class="mt-5 btn btn-lg w-100 btn-primary">
                            <span class="mx-2"><i class="fas fa-sign-out-alt"></i></span>
                            Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

</script>
{{-- <div>
        This is dashboard page
    </div> --}}
@endsection

@push('script')

@endpush
