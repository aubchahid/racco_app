<div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card">
                <!-- Logo -->
                <div class="card-header py-4 text-center bg-dark">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" height="22">
                </div>

                <div class="card-body p-4">

                    <div class="text-center m-auto">
                        <img src="{{ asset('assets/images/svg/mail_sent.svg') }}" alt="mail sent image"
                            height="64" />
                        <h4 class="text-dark-50 text-center mt-4 fw-bold">Veuillez vérifier votre e-mail</h4>
                        <p class="text-muted mb-4">
                            Un e-mail a été envoyé à <b>youremail@domain.com</b>. Veuillez rechercher un e-mail de la
                            société
                            et cliquez sur le lien inclus pour réinitialiser votre mot de passe.
                        </p>
                    </div>

                    <div class="mb-0 text-center d-grid">
                        <a class="btn btn-primary shadow-none" href="{{ route('login') }}"><i
                                class="mdi mdi-home me-1"></i> Retour
                            à la page de
                            connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
