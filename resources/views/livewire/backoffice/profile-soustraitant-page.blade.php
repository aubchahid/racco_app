<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $soustraitant->name }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Clients">Total Clients</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->clients->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Affectations">Total Affectations</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->totalAffectations() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-check-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Declarations">Total Declarations</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->totalDeclarations() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-times-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Blocages">Total Blocages</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->totalBlocages() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-bottom d-flex">
            <h5 class="text-muted fw-bold">Statistique</h5>
            <div class="ms-auto">
                <button class="btn btn-primary btn-sm shadow-none" wire:click="search"> <i class="uil-search me-2"></i> Filtrer
                </button>
                <button class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal"
                    data-bs-target="#exportation-modal"> <i class="uil-export me-2"></i> Exproter
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="floatingInput" placeholder=""
                            wire:model="start_date" />
                        <label for="floatingInput">Du</label>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="floatingInput" placeholder=""
                            wire:model="end_date" />
                        <label for="floatingInput">Au</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients">Clients</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $data['clients'] }} </h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Affectations">Affectations</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $data['affectations'] }} </h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-check-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Declarations">Declarations</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $data['declarations'] }} </h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-times-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Blocages">Blocages</h5>
                    <h3 class="mt-3 mb-1 text-primary">12 </h3>
                </div>
            </div>
        </div>
    </div>

</div>
