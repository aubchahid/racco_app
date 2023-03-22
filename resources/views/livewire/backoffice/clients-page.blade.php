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
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-envelope-add widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients du jour">Clients du jour</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clientsOfTheDay'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Total Clients">Total Clients</h5>
                    <h3 class="mt-3 mb-1">{{ $data['allClients'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients B2B">Clients B2B</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clientsB2B'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="uil-users-alt widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-bold mt-0" title="Clients B2C">Clients B2C</h5>
                    <h3 class="mt-3 mb-1">{{ $data['clientsB2C'] }}</h3>
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
                        <button class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#exportation-modal"> <i class="uil-export me-2"></i> Exproter
                        </button>
                        <button class="btn btn-info btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#importation-modal"> <i class="uil-down-arrow me-2"></i> Importer
                        </button>
                        <button class="btn btn-warning btn-sm shadow-none"> <i class="uil-down-arrow me-2"></i> Importer
                            automatique
                        </button>
                        <button class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#delete-all-modal"> <i class="uil-trash me-2"></i> Supprimer
                        </button>
                        <button class="btn btn-secondary btn-sm shadow-none" wire:click="deleteAll"> <i class="uil-label me-2"></i> Affecter
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="Ex : Amine Bachiri" wire:model="client_name" />
                                <label for="floatingInput">Nom de client</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="Ex : 0548445185" wire:model="client_sip" />
                                <label for="floatingInput">SIP</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" wire:model="client_status">
                                    <option value="" selected>Tous</option>
                                    <option value="Saisie">Saisie</option>
                                    <option value="Blocage">Blocage</option>
                                    <option value="Affecté">Affecté</option>
                                    <option value="Planifié">Planifié</option>
                                </select>
                                <label for="floatingSelect">Statut du client</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" wire:model="technicien">
                                    <option value="" selected>-</option>
                                    @foreach ($techniciens as $item)
                                        <option value="{{ $item->id }}">{{ $item->user->getFullname() }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Statut du client</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingInput" placeholder=""
                                    wire:model="start_date" />
                                <label for="floatingInput">Du</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
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

    <div class="card">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-12">
                    <table class="table table-centered table-responsive mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th></th>
                                <th class="text-center">Sip</th>
                                <th>Adresse</th>
                                <th>Nom du client</th>
                                <th>Telephone</th>
                                <th>Technicien</th>
                                <th class="text-center">Etat</th>
                                <th class="text-center">Créé à</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($clients->count() != 0)
                                @foreach ($clients as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input"  value="{{ $item->id }}" wire:model="deleteList">
                                        </td>
                                        <td class="text-center">{{ $item->sip }}</td>
                                        <td>
                                            <h5 class="font-14 my-1">{{ Str::limit($item->address, 30) }}</h5>
                                            <span class="text-muted font-13">{{ $item->city->name }}</span>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone_no }}</td>
                                        <td>{{ $item->technicien_first_name ?? '-' }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-{{ $item->getStatusColor() }}-lighten p-1 ps-2 pe-2">{{ $item->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm shadow-none"
                                                href="{{ route('admin.clients.profile', [$item->id]) }}"><i
                                                    class="uil-eye"></i> </a>
                                            <button type="button" class="btn btn-warning btn-sm shadow-none"><i
                                                    class="uil-pen"></i> </button>
                                            <button type="button" class="btn btn-danger btn-sm shadow-none"
                                                wire:click="$set('client_id',{{ $item->id }})"
                                                data-bs-toggle="modal" data-bs-target="#delete-modal"><i
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
                <div class="col-12 mt-2 ps-4">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="importation-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="importation-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="importation-modalLabel">Importer liste des clients</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Veuillez utiliser le modèle
                            ci-dessous.</label>
                        <input type="file" id="example-fileinput" class="form-control">
                    </div>
                    <a href="">Telecharger template</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light shadow-none" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary shadow-none">Ajouter</button>
                </div>
            </div>
        </div>
    </div>

    <div id="exportation-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="importation-modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="export">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Exporter liste des clients</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold f-16">Êtes-vous sûr de vouloir exporter un liste des clients vers un fichier
                            Excel ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light shadow-none"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary shadow-none">
                            <span wire:loading.remove wire:target="export">Oui, exporter</span>
                            <span wire:loading wire:target="export">
                                <span class="spinner-border spinner-border-sm me-2" role="status"
                                    aria-hidden="true"></span>
                                Chargement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="importation-modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="delete">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Supprimer un client</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold f-16">Voulez-vous vraiment supprimer ce client ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light shadow-none"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger shadow-none">
                            <span wire:loading.remove wire:target="delete">Oui, supprimez-le</span>
                            <span wire:loading wire:target="delete">
                                <span class="spinner-border spinner-border-sm me-2" role="status"
                                    aria-hidden="true"></span>
                                Chargement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="delete-all-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="importation-modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="deleteAll">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Supprimer des clients</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold f-16">Voulez-vous vraiment supprimer les clients ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light shadow-none"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger shadow-none">
                            <span wire:loading.remove wire:target="deleteAll">Oui, supprimez-le</span>
                            <span wire:loading wire:target="deleteAll">
                                <span class="spinner-border spinner-border-sm me-2" role="status"
                                    aria-hidden="true"></span>
                                Chargement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
