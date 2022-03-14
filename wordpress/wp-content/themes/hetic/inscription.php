<form action="<?= admin_url('admin-post.php') ?>" method="post">
    <div class="form-group row meta-options">
        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" id="inputName" placeholder="Nom">
        </div>
    </div>
    <div class="form-group row meta-options">
        <label for="inputFirstName" class="col-sm-2 col-form-label">Prénom</label>
        <div class="col-sm-10">
            <input name="lastname" type="text" class="form-control" id="inputFirstName" placeholder="Prénom">
        </div>
    </div>
    <div class="form-group row meta-options">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group row meta-options">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
        </div>
    </div>
    <fieldset class="form-group meta-options">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Vous êtes un :</legend>
            <div class="col-sm-10">
                <div class="form-check meta-options">
                    <input name="role" class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="subscriber" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Particulier
                    </label>
                </div>
                <div class="form-check meta-options">
                    <input name="role" class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="logement_manager">
                    <label class="form-check-label" for="gridRadios2">
                        Loueur
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <input type="hidden" name="action" value="wpinscription_form">
    <?php wp_nonce_field('random_action', 'random_nonce'); ?>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="c-btn is__orange">S'inscrire</button>
        </div>
    </div>
</form>
