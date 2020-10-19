<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kalkulačka</title>
</head>
<body>
<h1>Kalkulačka</h1>

<form method="POST" action="/calculator">
    Operace:
    <select name="operation">
        @foreach ($operations as $operation => $text)
            <option value="{{ $operation }}">{{ $text }}</option>
        @endforeach
    </select>
    <br />

    První číslo:
    <input type="number" name="a" value="{{ $a ?? 0 }}" />
    <br />

    Druhé číslo:
    <input type="number" name="b" value="{{ $b ?? 0 }}" />
    <br />

    <button type="submit">Spočítej výsledek</button>
</form>

@if (isset($result))
    <p>Výsledek je: {{ $result }}</p>
@endif
</body>
</html>
