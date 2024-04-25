@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="row">
            <div class="col-md-12">
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                    @include('layouts.flash-messages')
                    <h2>Registration Form</h2>
                    <form action="{{ url('/api/createNewUser') }}" method="post" id="create-user" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required
                                   placeholder="+380xxxxxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="position_id">Position:</label>
                            <select class="form-control" id="position_id" name="position_id" required>
                                <option value="">Select Position</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position['id'] }}">{{ $position['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" class="form-control-file" id="photo" name="photo" required
                                   accept="image/jpeg">
                            <div style="margin-top:20px">Size: <span id="size">0</span> bytes</div>
                        </div>
                        <button id="submit-button" type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#photo').on('change', function (e) {
                let size = this.files[0].size;
                $('#size').text(size);
            });
        })

        $(document).ready(function () {
            $('#phone').inputmask("+380999999999");
        });

        document.addEventListener('DOMContentLoaded', function () {
            var submitButton = document.getElementById('submit-button');

            submitButton.addEventListener('click', function (event) {
                event.preventDefault();

                var size = document.getElementById('photo').files[0].size;
                if (size > 2000000) {
                    alert('Size is greater than 2MB');
                    return;
                }

                document.getElementById('create-user').submit();
            });
        });
    </script>
@endsection
