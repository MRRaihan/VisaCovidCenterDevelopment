{{-- Navbar Starts  --}}
<div class="nav flex-column  tab-height nav-pills me-3">
    <div class="nav-link">
        <img height="70px;" width="70px;" src="{{ asset(get_static_option('logo') ?? get_static_opton('no_image')) }}" class="img-fluid" alt="">
    </div>
    <div class="nav-link active d-flex justify-content-center align-items-center">
        <a href="{{ route('immigrationOfficer.latestUser.show') }}">
            <i class="fa fa-tv fa-2x text-light"></i>
        </a>
    </div>
    <div class="nav-link d-flex justify-content-center align-items-center my-4">

        <a href="{{ route('immigrationOfficer.immigrationPassedList.index') }}">
            <i class="fa fa-history fa-2x text-light"></i>
        </a>
    </div>
    <div class="nav-link d-flex justify-content-center align-items-center">
        <a href="{{ route('immigrationOfficer.profile') }}">
            <i class="fa fa-user-circle fa-2x text-light"></i>
        </a>
    </div>
</div>
{{-- Navbar Ends  --}}