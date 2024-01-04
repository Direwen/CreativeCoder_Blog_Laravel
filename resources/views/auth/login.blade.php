<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3 class="text-primary text-center my-3 fw-bold">Login Form</h3>
                <div class="card p-4 my-3 shadow-lg">
                    <form action="" method="POST">
                        <!--This @csrf generates a hidden CSRF token field to protect against CSRF attacks 
                        for POST, PUT, PATCH, or DELETE requests-->
                        @csrf
                        <!-- old function preserves user-entered data when a form submission fails validation -->
                        <!-- preventing the user from having to retype everything. -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="exampleInputEmail1" 
                                name="email"
                                value="{{old('email')}}"
                                required
                            >
                            <x-error name="email" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="exampleInputPassword1" 
                                name="password"
                                required
                            >
                            <x-error name="password" />
                        </div>
                        <button type="submit" class="btn btn-primary d-block mx-auto">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>