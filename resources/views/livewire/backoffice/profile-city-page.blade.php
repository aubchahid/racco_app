<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $city->name }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients">Clients</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients du jour">Clients du jour</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients_of_the_day'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Declarations du jour">Declarations du jour</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients_delcare_of_the_day'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Blocage du jour">Blocage du jour</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients_bloque_of_the_day'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Plaques">Plaques</h5>
                    <h3 class="mt-3 mb-1">{{ $city->plaques->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Pipe du ville">Pipe du ville</h5>
                    <h3 class="mt-3 mb-1">{{ $data['pipe_city'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom d-flex">
                    <h5 class="text-muted fw-bold">Filtrage</h5>
                    <div class="ms-auto">
                        <button class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#exportation-modal"> <i class="uil-export me-2"></i> Générer un rapport
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingInput" placeholder=""
                                    wire:model="start_date" />
                                <label for="floatingInput">Du</label>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingInput" placeholder=""
                                    wire:model="end_date" />
                                <label for="floatingInput">Au</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients">Clients</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients_filtre'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Declarations">Declarations</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients_delcare'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Blocage">Blocage</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clients_bloque'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Pipe du ville">Pipe du ville</h5>
                    <h3 class="mt-3 mb-1">{{ $data['pipe_city_filtre'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {!! $chart->container() !!}
        </div>
    </div>

    @push('scripts')
        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    @endpush

</div>
