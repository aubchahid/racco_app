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
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <td class="fw-bold">
                                        <span
                                            class="badge badge-{{ $item->status ? 'success' : 'danger' }}-lighten">{{ $item->status ? 'Actif' : 'Inactif' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm shadow-none"href=""><i
                                                class="uil-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-warning btn-sm shadow-none"><i
                                                class="uil-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm shadow-none"><i
                                                class="uil-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 ps-4">
                    {{ $plaques->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
