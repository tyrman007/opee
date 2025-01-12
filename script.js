document.addEventListener('DOMContentLoaded', function () {
    const bibleForm = document.getElementById('bibleForm');
    bibleForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const days = parseFloat(document.getElementById('days').value);
        let percentage = document.getElementById('percentage').value.replace(',', '.');
        percentage = parseFloat(percentage);

        if (isNaN(days) || isNaN(percentage) || percentage <= 0 || percentage > 100) {
            alert('Proszę wprowadzić prawidłowe dane.');
            return;
        }

        const D = (days / percentage) * 100;
        const C = D - days;

        const roundedD = Math.round(D);
        const roundedC = Math.round(C);

        const endDate = new Date();
        endDate.setDate(endDate.getDate() + roundedC);
        const endDateString = endDate.toISOString().split('T')[0];

        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `<p>Przeczytasz Biblię w: ${roundedD} dni</p>
                              <p>Pozostało do końca: ${roundedC} dni</p>
                              <p>Data ukończenia: ${endDateString}</p>
                              <div class="progress-container">
                                <div class="progress-bar" style="width: ${percentage}%;"></div>
                                <div class="progress-labels">
                                    <span>0%</span>
                                    <span>25%</span>
                                    <span>50%</span>
                                    <span>75%</span>
                                    <span>100%</span>
                                </div>
                              </div>`;
    });
});