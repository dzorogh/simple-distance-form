const $button  = $('#submitButton');
const $results = $('#results');

let originGeo;

function disableButton() {
    $button.attr('disabled', true);
}

function enableButton() {
    $button.attr('disabled', false);
}

function clearOriginGeo() {
    originGeo = {
        lat: null,
        lon: null,
    }
}

function clearResults() {
    $results.text('');
}

clearOriginGeo();

$('#originAddress').on('input', function() {
    disableButton();
    clearOriginGeo();
    clearResults();
});

$('#originAddress').suggestions({
    token: '594e41d454c28aedbc6951b66015384e053a0cae',
    type:  'ADDRESS',

    onSelect: function(suggestion) {
        clearResults();

        if (
            !suggestion
            || !suggestion.data.geo_lat
            || !suggestion.data.geo_lon) {
            return false;
        }

        originGeo.lat = suggestion.data.geo_lat;
        originGeo.lon = suggestion.data.geo_lon;

        console.log(originGeo);

        enableButton();
    },

    onSelectNothing() {
        disableButton();
        clearOriginGeo();
        clearResults();
    },
});

$button.on('click', function(e) {
    e.preventDefault();

    $results.hide();
    disableButton();

    $.post('/api/distance-to-office', {
        lat: originGeo.lat,
        lon: originGeo.lon,
    }).then(function(result) {
        if (result || result === '0') {
            const resultsInKm = Math.round(result / 1000);
            const resultModulusInM = Math.round(result % 1000);
            let resultTest = '';

            if (resultsInKm > 0) {
                resultTest += `${resultsInKm}км `;
            }

            resultTest += `${resultModulusInM}м`;

            $results.text(resultTest);
            $results.show();
        } else {
            alert('Не удалось получить расстояние');
        }

    });
});


