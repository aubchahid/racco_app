<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Plaques</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom d-flex">
                    <h5 class="text-muted fw-bold">Filtrage</h5>
                    <div class="ms-auto">
                        <button class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#add-modal">
                            <i class="uil-plus me-2"></i> Ajouter
                        </button>
                        <button class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#exportation-modal"> <i class="uil-export me-2"></i> Exproter
                        </button>
                        <button class="btn btn-info btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#importation-modal"> <i class="uil-down-arrow me-2"></i> Importer
                        </button>
                        <button class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#delete-all-modal"> <i class="uil-trash me-2"></i> Supprimer
                        </button>
                        <button class="btn btn-secondary btn-sm shadow-none" data-bs-toggle="modal"
                            data-bs-target="#affecter-modal"> <i class="uil-label me-2"></i> Affecter
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="Ex : 01.18.56" wire:model="plaque_name" />
                                <label for="floatingInput">Code Plaque</label>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" wire:model="status">
                                    <option value="" selected>Tous</option>
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                                <label for="floatingSelect">Statut du plaque</label>
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
                                <th>Plaque</th>
                                <th>Ville</th>
                                <th>Client</th>
                                <th>Technicien</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($plaques->count() > 0)
                                @foreach ($plaques as $item)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input" value="{{ $item->id }}"
                                                wire:model="deleteList">
                                        </td>
                                        <td>{{ $item->code_plaque }}</td>
                                        <td>{{ $item->city->name }}</td>
                                        <td>{{ $item->clients->count() }} Clients</td>
                                        <td>{{ $item->techniciens->count() }} Technicien</td>
                                        <td class="text-center">
                                            <a
                                                class="btn btn-primary btn-sm shadow-none"href="{{ route('admin.plaques.profile', $item) }}"><i
                                                    class="uil-eye"></i>
                                            </a>
                                            <button type="button" wire:click="setPlaque({{ $item }})"
                                                data-bs-target="#edit-modal" data-bs-toggle="modal"
                                                class="btn btn-warning btn-sm shadow-none"><i class="uil-pen"></i>
                                            </button>
                                            <button type="button" wire:click="$set('plaque_id',{{ $item->id }})"
                                                data-bs-target="#delete-modal" data-bs-toggle="modal"
                                                class="btn btn-danger btn-sm shadow-none"><i class="uil-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="6">Aucun plaque trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 ps-4">
                    {{ $plaques->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importation-modalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="delete">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Supprimer un plaque</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold f-16">Voulez-vous vraiment supprimer cet plaque ?</p>
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
                        <h4 class="modal-title" id="importation-modalLabel">Supprimer des plaques</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold f-16">Voulez-vous vraiment supprimer les plaques ?</p>
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

    <div id="affecter-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="importation-modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="affectation">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Affectation des clients</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect"
                                aria-label="Floating label select example" wire:model="technicien_affectation"
                                required>
                                <option selected>Sélectionnez un technicien</option>
                                @foreach ($techniciens as $item)
                                    <option value="{{ $item->id }}">{{ $item->user->getFullname() }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Technicien </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light shadow-none"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary shadow-none">
                            <span wire:loading.remove wire:target="affectation">Affecter</span>
                            <span wire:loading wire:target="affectation">
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

    <div id="exportation-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="importation-modalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="export">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Exporter liste des plaques</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold f-16">Êtes-vous sûr de vouloir exporter un liste des plaques vers un fichier
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

    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importation-modalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="add">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Nouveau plaque</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" wire:model="plaque" />
                            <label for="floatingInput">Code Plaque</label>
                        </div>
                        <div class="form-floating mt-3">
                            <select class="form-select" id="floatingSelect"
                                aria-label="Floating label select example" wire:model="city">
                                <option selected>Sélectionnez un ville</option>
                                @foreach ($cities as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Ville </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light shadow-none"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary shadow-none">
                            <span wire:loading.remove wire:target="add">Ajouter</span>
                            <span wire:loading wire:target="add">
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

    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importation-modalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="edit">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importation-modalLabel">Affectation des clients</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" wire:model="plaque" />
                            <label for="floatingInput">Code Plaque</label>
                        </div>
                        <div class="form-floating mt-3">
                            <select class="form-select" id="floatingSelect"
                                aria-label="Floating label select example" wire:model="city">
                                <option selected>Sélectionnez un ville</option>
                                @foreach ($cities as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Ville </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light shadow-none"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary shadow-none">
                            <span wire:loading.remove wire:target="add">Ajouter</span>
                            <span wire:loading wire:target="add">
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
