<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="login-container">
                    <!-- Left side - Image with Component label -->
                    <div class="login-image" style="background-image: url('{{ asset('images/power-plant.jpg') }}');">
                        <div class="component-label">
                            <span class="component-icon">⬥</span> Component 1
                        </div>
                    </div>
                    
                    <!-- Right side - Login form -->
                    <div class="login-form">
                        <!-- Logo and title -->
                        <div class="login-logo">
                            <img src="{{ asset('storage/images/ip-logo.png') }}" alt="PLN Logo" class="logo-img">
                            <div class="logo-text">
                             </div>
                        </div>
                        
                        <h3 class="login-title">Login Admin</h3>
                        
                        <!-- Login form -->
                        <form method="POST" action="{{ route('login') }}" style="width: 100%;">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="login-submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>