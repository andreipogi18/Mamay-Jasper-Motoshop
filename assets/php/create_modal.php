<div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-dark">
                <h4 class="modal-title text-light">Create User</h4><button type="button" class="btn-close btn-danger"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container  ">
                    <div class=" bg-transparent">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3"
                            style="background-color: whitesmoke;opacity: .9;">
                            <div class="col-lg-12 ">
                                <div class="p-0 ">
                                    <form action="../assets/php/register.php" class="user login-clean" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="firstName"
                                                    name="firstName" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" pattern="[a-zA-ZÀ-ž\s]{1,}" title="Must not contain any number or special character"  placeholder="First Name" required>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <input type="text" class="form-control form-control-user" id="lastName"
                                                    name="lastName" onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');" pattern="[a-zA-ZÀ-ž\s]{1,}" title="Must not contain any number or special character"  placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="username" class="form-control form-control-user" id="username"
                                                name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                name="email" placeholder="Email Address" value="" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-3 ">
                                                <input type="password" class="form-control form-control-user w-100"
                                                    id="password" name="password" minlength="8" maxlength="25"  title="Must not 8 characters"  placeholder="Password" required>
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                <input type="password" class="form-control form-control-user w-100"
                                                    name="rptpass" id="rptpass" minlength="8" maxlength="25" title="Must not contain 8 characters"  placeholder="Repeat Password" required>
                                            </div>
                                            <div class="mb-3 col-sm-4 mb-3">
                                                <select class="form-select" name="role" id="role">
                                                    <option selected value="Client">Client</option>
                                                    <option value="Staff">Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" href="index.php" class="btn btn-primary d-block w-100"
                                            name="Add">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>