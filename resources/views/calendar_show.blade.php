<!DOCTYPE html>
<html>
    <head>
        <title>Calendar</title>
    </head>
    <body>
        <div class="container">
            <h1>Data for Date: {{ $data->date }}</h1>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Details</h5>
                    <ul>
                        <li>Date: {{ $data->date }}</li>
                        <!-- Display other fields from $data as needed -->
                    </ul>
                </div>
            </div>

            <a href="{{ route('calendar.index') }}" class="btn btn-primary">Back to Calendar</a>
        </div>
    </body>
</html>
