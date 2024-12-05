document.addEventListener('DOMContentLoaded', function () {
    // Vérifie si les éléments nécessaires existent sur la page
    const answersContainer = document.getElementById('answers-container');
    const addAnswerButton = document.getElementById('add-answer');

    if (!answersContainer || !addAnswerButton) {
        console.error('Elements #answers-container or #add-answer not found.');
        return; // Quitte si les éléments sont introuvables
    }

    // Initialisation de l'index des réponses
    let answerIndex = 0

    // Ajouter un champ de réponse
    addAnswerButton.addEventListener('click', () => {
        const answerField = document.createElement('div');
        answerField.classList.add('answer-field', 'mb-3', 'd-flex', 'align-items-center', 'gap-2');
        answerField.innerHTML = `
            <input type="text" name="new-answers[${answerIndex}][content]"
                   class="form-control" placeholder="Réponse">
            <label class="d-flex align-items-center gap-1">
                <input type="checkbox" name="new-answers[${answerIndex}][is_correct]" value="1">
                Juste
            </label>
            <button type="button" class="btn btn-danger btn-sm remove-answer">Supprimer</button>
        `;
        answersContainer.appendChild(answerField);
        answerIndex++;
    });

    // Supprimer un champ de réponse
    answersContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-answer')) {
            e.target.parentElement.remove();
        }
    });
});
