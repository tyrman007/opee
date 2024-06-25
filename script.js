document.addEventListener('DOMContentLoaded', function () {
    const bibleForm = document.getElementById('bibleForm');
    bibleForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const days = parseFloat(document.getElementById('days').value);
        let percentage = document.getElementById('percentage').value.replace(',', '.');
        percentage = parseFloat(percentage);

        if (isNaN(days) || isNaN(percentage)) {
            alert('Proszę wprowadzić prawidłowe dane.');
            return;
        }

        const D = (100 / percentage) * days;
        const C = D - days;

        const roundedD = Math.round(D);
        const roundedC = Math.round(C);

        const endDate = new Date();
        endDate.setDate(endDate.getDate() + roundedC);
        const endDateString = endDate.toISOString().split('T')[0];

        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `Liczba dni na przeczytanie całej Biblii (D): ${roundedD} dni<br>
                              Liczba dni pozostałych do końca (C): ${roundedC} dni<br>
                              Data ukończenia: ${endDateString}`;
    });
});