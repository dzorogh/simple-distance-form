<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Distance</title>
    <link href="/css/app.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />

</head>
<body>
<div class="container py-5">
    <div class="mb-3">
        <label for="destinationAddress" class="form-label">Адрес назначения</label>
        <input type="text" class="form-control" id="originAddress" placeholder="Начните вводить адрес">
    </div>
    <div class="mb-5">
        <button class="btn btn-primary" id="submitButton" disabled>
            Рассчитать расстояние от офиса
        </button>
    </div>
    <div id="results" class="display-2"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
