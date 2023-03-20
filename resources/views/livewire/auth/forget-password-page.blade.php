<div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card">
                <div class="card-header py-4 text-center bg-dark">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="22">
                </div>
                <div class="card-body p-4">
                    <div class="text-center w-100 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Récupérer le mot de passe</h4>
                        <p class="text-muted mb-4">Aucun problème! Saisissez l'adresse e-mail associée à votre compte et
                            nous vous enverrons un lien pour réinitialiser votre mot de passe.
                        </p>
                    </div>
                    <form wire:submit.prevent="resetPassword">
                        @error('email')
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Adresse email</label>
                            <input class="form-control" type="email" id="emailaddress" required
                                placeholder="Entrez votre adresse email" wire:model.lazy="email">
                        </div>

                        <div class="mb-0 text-center d-grid">
                            <button class="btn btn-primary shadow-none" type="submit">
                                <span wire:target="resetPassword" wire:loading.remove> Envoyer</span>
                                <span wire:target="resetPassword" wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Chargement...
                                </span>
                            </button>
                        </div>
                        <hr>
                        <div class="col-12 text-center">
                            <p class="text-muted">Retour à la page de<a href="{{ route('login') }}"
                                    class="text-muted ms-1"><b>Connexion</b></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
