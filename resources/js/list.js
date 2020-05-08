document.addEventListener('DOMContentLoaded', function () {
    addEventToAll('#quizits .delete', 'click', onQuizitDeleteClick);
    addEventToAll('#quizits .start', 'click', onQuizitStartClick);
    addEventToAll('#quizits .stop', 'click', onQuizitStopClick);
});

function onQuizitStartClick(event) {
    event.preventDefault();

    const id = event.target.closest('tr').getAttribute('data-quizit-id');
    axios.put('/quizits/create/' + id)
        .then(function (response) {
            response = response.data;

            Swal.fire(response.title, response.message, response.status).then(function () {
                location.reload();
            });
        });
}

function onQuizitStopClick(event) {
    event.preventDefault();

    const id = event.target.closest('tr').getAttribute('data-quizit-id');
    axios.put('/quizits/stop/' + id)
        .then(function (response) {
            response = response.data;

            Swal.fire(response.message, '', response.status).then(function () {
                location.reload();
            });
        });
}

function onQuizitDeleteClick(event) {
    event.preventDefault();
    const id = event.currentTarget.getAttribute('data-quizit-id');

    Swal.fire({
        icon: 'question',
        title: 'QuizOUT',
        text: 'Are you sure you want to remove this quizit?',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        showCancelButton: true,
    }).then(function (result) {
        if (result.value) {
            deleteQuizit(id, event.target);
        }
    });
}

function deleteQuizit(id, target) {
    axios.delete('/quizits/delete/' + id, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
        .then(function (response) {
            Swal.fire(
                'QuizOUT',
                response.data.message,
                response.data.status,
            ).then(function () {
                if (response.data.status === 'success') {
                    const tr = target.closest('tr');

                    tr.parentElement.removeChild(tr);
                }
            });
        })
        .catch(function (error) {
            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
}

function addEventToAll(selector, eventType, eventHandler) {
    const all = document.querySelectorAll(selector);

    for (let i = 0; i < all.length; i++) {
        all[i].addEventListener(eventType, eventHandler);
    }
}
