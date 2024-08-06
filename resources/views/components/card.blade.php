<div class="card">
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>
    <div class="card-body">
        <p><strong>Penyebab:</strong></p>
        <ul>
            @foreach ($causes as $cause)
                @if(isset($cause['type']) && isset($cause['description']))
                    <li><strong>{{ $cause['type'] }}:</strong> {{ $cause['description'] }}</li>
                @else
                    <li>{{ $cause }}</li>
                @endif
            @endforeach
        </ul>

        <h5>Kriteria Lolos:</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($criteria['headers'] as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($criteria['rows'] as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="defect-image">
            <h5>Contoh Gambar Defect</h5>
            <img src="{{ asset('img/' . $image) }}" alt="{{ $title }}" class="img-fluid">
        </div>

        @if (isset($additional_info))
            <h5>Point Penting:</h5>
            <p>{{ $additional_info }}</p>
        @endif
    </div>
</div>
