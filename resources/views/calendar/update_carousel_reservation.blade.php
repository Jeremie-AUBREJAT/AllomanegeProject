@extends('layouts.appsecond')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier la réservation</div>

                    <div class="card-body">
                        <form method="POST" action= "{{ url('reservation/update/'.$reservation->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Champ pour la date de début -->
                            <div class="form-group">
                                <label for="debut_date">Date de début</label>
                                <input id="debut_date" type="datetime-local" class="form-control" name="debut_date" value="{{ $reservation->debut_date }}" required>
                            </div>

                            <!-- Champ pour la date de fin -->
                            <div class="form-group">
                                <label for="fin_date">Date de fin</label>
                                <input id="fin_date" type="datetime-local" class="form-control" name="fin_date" value="{{ $reservation->fin_date }}" required>
                            </div>
                            <select name="status" class="form-control mb-4">
                                @foreach (config('enumCalendarStatus.status') as $key => $value)
                                    <option value="{{ $key }}" {{ $reservation->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <!-- Bouton de soumission -->
                            <button type="submit" class="btn btn-primary">Modifier la réservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
