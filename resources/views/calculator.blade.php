<!-- resources/views/calculator.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Fee Calculator</title>
    <style>
        body {
            background-color: {{ $config['params']['calcBackground'] }};
            color: {{ $config['params']['fontColor'] }};
        }
        .calculator-field {
            font-size: {{ $config['params']['fontSize'] }}px;
            color: {{ $config['params']['fieldNameFontColor'] }};
        }
    </style>
</head>
<body>
    <h1>{{ $config['name'] }}</h1>
    <form action="{{ route('calculate') }}" method="POST">
        @csrf
        @foreach($config['fields'] as $field)
            <div class="calculator-field">
                <label for="{{ $field['id'] }}">{{ $field['name'] }}</label>
                <input type="text" id="{{ $field['id'] }}" name="{{ $field['id'] }}" value="{{ $field['value'] }}" class="calculator-field">
            </div>
        @endforeach
        <button type="submit">Calculate</button>
    </form>
</body>
</html>
