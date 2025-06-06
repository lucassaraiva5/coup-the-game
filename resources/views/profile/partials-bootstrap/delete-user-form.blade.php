<section class="mb-4"></section>
    <header>
        <h2 class="h4 mb-3"></h2>
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted small mb-3"></p>
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="deleteAccountModal" aria-hidden="true" x-show="$errors->userDeletion->isNotEmpty()">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-3">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button type="button" class="btn-close" x-on:click="$dispatch('close')" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="visually-hidden">{{ __('Password') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Password') }}"
                            />
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
