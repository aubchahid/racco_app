<div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card">
                <div class="card-header py-4 text-center bg-dark">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="22">
                </div>
                <div class="card-body p-4">
                    <div class="text-center w-100 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Récupérer votre mot de passe</h4>
                        <p class="text-muted mb-4">Entrez un nouveau mot de passe pour vous connecter à votre compte</p>
                    </div>
                    <form wire:submit.prevent="resetPassword">
                        @error('password')
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        @error('confirmed')
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="mb-3">                        
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control"
                                    placeholder="Entrez votre mot de passe" wire:model.lazy="password" required>
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirmation mot de passe</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control"
                                    placeholder="Entrez votre mot de passe" wire:model.lazy="confirmed" required>
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0 text-center d-grid">
                            <button class="btn btn-primary shadow-none" type="submit">
                                <span wire:target="resetPassword" wire:loading.remove> Change mon mot de passe</span>
                                <span wire:target="resetPassword" wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status"
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
</div>
