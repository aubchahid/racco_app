<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Affectations</h4>
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
                                <th>Nom de technicien</th>
                                <th>Status</th>
                                <th>Compteur de Planification</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($techniciens as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $item->user->getFullname() }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->planification_count }}</td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun technicien trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 ps-4">

                </div>
            </div>
        </div>
    </div>
</div>
