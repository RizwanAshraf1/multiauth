<div class="class container">
    <div class="class row">
        <div class="col-md-6 col-lg-4 offset-2">
            @if(Auth::guard("web")->check())
            <p class="text-green text-center">
                You are logged in as <strong>User!</strong>
            </p>
            @else
            <p class="text-danger text-center">
                You are logged out as <strong>User!</strong>
            </p>
            @endif

            @if(Auth::guard("admin")->check())
            <p class="text-green text-center">
                You are logged in as <strong>Admin!</strong>
            </p>
            @else
            <p class="text-danger text-center">
                You are logged out as <strong>Admin!</strong>
            </p>
            @endif
        </div>
    </div>

</div>