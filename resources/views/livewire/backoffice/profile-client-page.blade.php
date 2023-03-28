<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $client->name }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card bg-{{ $client->getStatusColor() }} shadow-none">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 mb-1 text-white">{{ $client->name }}</h4>
                                        <p class="font-13 text-white-50"></p>
                                        <ul class="mb-0 list-inline text-light">
                                            <li class="list-inline-item me-3">
                                                <h5 class="mb-1 text-white">{{ $client->created_at->format('d-m-Y') }}
                                                </h5>
                                                <p class="mb-0 font-13 text-white-50">Date de creation</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1 text-white">{{ $client->status }}</h5>
                                                <p class="mb-0 font-13 text-white-50">Status</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title bg-light p-2 mt-0 mb-3"> <i class="uil-user me-2"></i> Informations du
                        client</h4>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">SIP</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->sip }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Nom du client</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->name }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Adresse</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->address }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Numéro de téléphone</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->phone_no }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Ville</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->city->name }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Type</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->type }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Débit</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->debit }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Status du client</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->status }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Date de création</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->created_at->format('d-m-Y H:i:s') }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Date de la dernière mise à
                            jour</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->updated_at->format('d-m-Y H:i:s') }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label fw-bold">Créé par</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->createdBy->getFullname() }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title bg-light p-2 mt-0 mb-3"> <i class="uil-chart me-2"></i> Historique des affectationsnode</h4>
                    <div class="timeline-alt pb-0">
                        @if (count($client->affectations))
                            @foreach ($client->affectations[0]->history as $item)
                                <div class="timeline-item">
                                    <i
                                        class="bg-{{ $item->getStatusColor() }}-lighten text-{{ $item->getStatusColor() }} timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <h5 class="mt-0 mb-1">{{ $item->status }} </h5>
                                        <p class="font-14"><i class="uil-user"></i> Technicien :
                                            {{ $item->technicien->user->getFullname() }} <span class="ms-2 font-12">
                                                <i class="uil-clock"></i>
                                                {{ $item->created_at->format('d-m-Y H:i:s') }}
                                            </span>
                                        </p>
                                        <p class="text-muted mt-2 mb-0 pb-3"></p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                <h1><i class="uil-times-circle"></i></h1>
                                <h4>Il n'y a pas encore d'affectations.</h4>
                            </div>
                        @endif

                    </div>
                    <h4 class="header-title bg-light p-2 mt-5 mb-3"> <i class="uil-file me-2"></i> Rapports</h4>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="card mb-2 shadow-none border">
                            <div class="p-1">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-danger rounded">
                                                .PDF
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col ps-0">
                                        <a href="javascript:void(0);" class="text-muted fw-bold">sales-assets.zip</a>
                                        <p class="mb-0 font-12 fw-bold">Rapport de validations</p>
                                    </div>
                                    <div class="col-auto" id="tooltip-container9">
                                        <!-- Button -->
                                        <a href="javascript:void(0);" data-bs-container="#tooltip-container9"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            class="btn btn-link text-muted btn-lg p-0" aria-label="Download"
                                            data-bs-original-title="Download">
                                            <i class="uil uil-cloud-download"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-bs-container="#tooltip-container9"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            class="btn btn-link text-danger btn-lg p-0" aria-label="Delete"
                                            data-bs-original-title="Delete">
                                            <i class="uil uil-multiply"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
