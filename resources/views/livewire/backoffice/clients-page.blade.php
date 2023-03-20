<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Clients</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <a href="">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="uil-envelope-add widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-bold mt-0" title="Total Clients">Total Clients</h5>
                        <h3 class="mt-3 mb-1">{{ $allClients }}</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <a href="">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="uil-users-alt widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-bold mt-0" title="Clients du jour">Clients du jour</h5>
                        <h3 class="mt-3 mb-1">{{ $clientsOfTheDay }}</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <a href="">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="uil-users-alt widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-bold mt-0" title="Clients B2B">Clients B2B</h5>
                        <h3 class="mt-3 mb-1">{{ $clientsB2B }}</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <a href="">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="uil-users-alt widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-bold mt-0" title="Clients B2C">Clients B2C</h5>
                        <h3 class="mt-3 mb-1">{{ $clientsB2C }}</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom d-flex">
                    <h5 class="text-muted fw-bold">Filtrage</h5>
                    <div class="ms-auto">
                        <button class="btn btn-success btn-sm shadow-none"> <i class="uil-export me-2"></i> Exproter
                        </button>
                        <button class="btn btn-info btn-sm shadow-none"> <i class="uil-down-arrow me-2"></i> Importer
                        </button>
                        <button class="btn btn-danger btn-sm shadow-none"> <i class="uil-down-arrow me-2"></i> Importer
                            automatique
                        </button>
                        <button class="btn btn-primary btn-sm shadow-none"> <i class="uil-search me-2"></i> Rechercher
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <label for="form-client-name" class="form-label">Client Nom : </label>
                                <input type="text" class="form-control" id="form-client-name" wire:model="client_name">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Sip : </label>
                                <input type="text" class="form-control" id="formrow-firstname-input" wire:model="client_sip">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Status de client :</label>
                                <select class="form-select" name="" id="">
                                    @for ($i = 0; $i < 12; $i++)
                                        <option value="">Technicien {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Technicien :</label>
                                <select class="form-select" name="" id="">
                                    @for ($i = 0; $i < 12; $i++)
                                        <option value="">Technicien {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Date debut : </label>
                                <input type="text" class="form-control" id="formrow-firstname-input">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Date Fin : </label>
                                <input type="text" class="form-control" id="formrow-firstname-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-centered table-responsive mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Sip</th>
                                <th>Adresse</th>
                                <th>Nom du client</th>
                                <th>Ville</th>
                                <th>Telephone</th>
                                <th>Technicien</th>
                                <th class="text-center">Etat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($clients->count() != 0)
                                @foreach ($clients as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $item->sip }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->city->name }}</td>
                                        <td>{{ $item->phone_no }}</td>
                                        <td>-</td>
                                        <td class="text-center"><i class="mdi mdi-circle {{ $item->getStatusColor($item->status) }}"></i> {{ $item->status }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm shadow-none"><i
                                                    class="uil-eye"></i> </button>
                                            <button type="button" class="btn btn-warning btn-sm shadow-none"><i
                                                    class="uil-pen"></i> </button>
                                            <button type="button" class="btn btn-danger btn-sm shadow-none"><i
                                                    class="uil-trash"></i> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Aucun client trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-3">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
