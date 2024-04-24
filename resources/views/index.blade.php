@extends('layouts.app')

@section('title', 'User List')

@section('content')
    @include('layouts.styles.css')
    @include('layouts.flash-messages')
    <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="row">
            <div class="col-md-12">
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                    <table class="table manage-candidates-top mb-0">
                        <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th class="text-center">Position</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users['users'] as $user)
                            <tr class="candidates-list">
                                <td class="title">
                                    <div class="thumb">
                                        <img src="{{ $user['photo'] }}" alt="{{ $user['photo'] }}" width="100"  height="100" class="img-fluid">
                                    </div>
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0">{{ $user['name'] }}</h5>
                                            </div>
                                            <div class="candidate-list-option">
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-filter pr-1"></i>email: {{ $user['email'] }}</li>
                                                    <li><i class="fas fa-map-marker-alt pr-1"></i>phone: {{ $user['phone'] }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="candidate-list-favourite-time text-center">
                                    <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                    <span class="candidate-list-time order-1">{{ $user['position'] }}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @include('layouts.pagination')
                </div>
            </div>
        </div>
    </div>
@endsection
