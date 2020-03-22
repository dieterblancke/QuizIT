document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('#quizits .delete');

    for (let i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', onQuizitDeleteClick);
    }
});

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
