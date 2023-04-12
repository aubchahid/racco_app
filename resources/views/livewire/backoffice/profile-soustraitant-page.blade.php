<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="javascript: void(0);" class="btn btn-primary shadow-none">
                        <i class="uil-file-upload-alt me-2"></i> Générer un rapport
                    </a>
                </div>
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
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Techniciens">Techniciens</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->techniciens->count() }}</h3>
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
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->totalDeclarations ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-times-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Blocage">Total Blocage</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $soustraitant->totalDeclarations ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-bottom d-flex">
            <h5 class="text-muted fw-bold">Statistique</h5>
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
        <div class="col-xl-4 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients">Clients</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $clients->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-check-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Declarations">Total Declarations</h5>
                    <h3 class="mt-3 mb-1 text-primary">{{ $clients->where('status','Déclaré')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-times-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Blocages">Total Validations</h5>
                    <h3 class="mt-3 mb-1 text-primary"> </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="title-head">Clients</h4>
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-12">
                    <table class="table table-centered table-responsive mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Sip</th>
                                <th>Adresse</th>
                                <th>Nom du client</th>
                                <th>Numéro de téléphone</th>
                                <th>Technicien</th>
                                <th class="text-center">Etat</th>
                                <th class="text-center">Créé à</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td class="text-center">{{ $client->sip }}</td>
                                    <td>
                                        <h5 class="font-14 my-1">{{ Str::limit($client->address, 30) }}
                                        </h5>
                                        <span class="text-muted font-13">{{ $client->city->name }}</span>
                                    </td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone_no }}</td>
                                    <td>{{ $client->technicien ? $client->technicien->user->getFullname() : '-' }}
                                    <td class="text-center">
                                        <span
                                            class="badge badge-{{ $client->getStatusColor() }}-lighten p-1 ps-2 pe-2">{{ $client->status }}</span>
                                    </td>
                                    <td class="text-center">
                                        {{ $client->created_at->format('d-m-Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <h5 class="text-center">Aucun client trouvé</h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
