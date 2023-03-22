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
            <div class="card bg-{{ $client->getStatusColor($client->status) }} shadow-none">
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
                    <hr>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">SIP</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->sip }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Nom du client</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->name }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Adresse</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->address }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Numero de telephone</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->phone_no }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Ville</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->city->name }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Type</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->type }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Débit</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->debit }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Status du client</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->debit }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Date de creation</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->created_at->format('d-m-Y H:i:s') }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Date de modification</label>
                        <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="example-static"
                                value="{{ $client->updated_at->format('d-m-Y H:i:s') }}">
                        </div>
                    </div>
                    <div class="row mb-2 align-middle">
                        <label for="inputEmail3" class="col-5 col-form-label">Créé par</label>
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
                    <h4 class="header-title bg-light p-2 mt-0 mb-3"> <i class="uil-chart me-2"></i> Status</h4>
                    <hr>
                    <div class="timeline-alt pb-0">
                        <div class="timeline-item">
                            <i class=" bg-success-lighten text-success timeline-icon"></i>
                            <div class="timeline-item-info">
                                <h5 class="mt-0 mb-1">Client Affecte</h5>
                                <p class="font-14"><i class="uil-user"></i> Technicien : Alae Ramzi <span
                                        class="ms-2 font-12"> <i class="uil-clock"></i> 12-02-2023 12:45 </span>
                                </p>
                                <p class="text-muted mt-2 mb-0 pb-3"></p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class=" bg-danger-lighten text-danger timeline-icon"></i>
                            <div class="timeline-item-info">
                                <h5 class="mt-0 mb-1">Client Affecte</h5>
                                <p class="font-14"><i class="uil-user"></i> Technicien : Alae Ramzi <span
                                        class="ms-2 font-12"> <i class="uil-clock"></i> 12-02-2023 12:45 </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title bg-light p-2 mt-5 mb-3"> <i class="uil-file me-2"></i> Rapports</h4>
                    <hr>
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
