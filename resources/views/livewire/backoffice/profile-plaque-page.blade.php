<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Plaque : {{ $plaque->code_plaque }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-map-pin-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Ville">Ville</h5>
                    <h3 class="mt-3 mb-1">{{ $plaque->city->name }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Techniciens">Techniciens</h5>
                    <h3 class="mt-3 mb-1">{{ $plaque->techniciens->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients">Clients</h5>
                    <h3 class="mt-3 mb-1">{{ $plaque->clients->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>
