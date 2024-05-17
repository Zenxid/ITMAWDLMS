$(document).ready(function() {
    $(document).on("click", ".plus", function() {
        var inputField = $(this).siblings("input[type='number']");
        var maxQuantity = parseInt(inputField.closest("tr").data("max-quantity"));
        var currentValue = parseInt(inputField.val());
        if (currentValue < maxQuantity) {
            inputField.val(currentValue + 1);
        }
    });

    $(document).on("click", ".minus", function() {
        var inputField = $(this).siblings("input[type='number']");
        var currentValue = parseInt(inputField.val());
        if (currentValue > 1) {
            inputField.val(currentValue - 1);
        }
    });
});

/* ---------------------- ADD AND MINUS ------------------------- */

$(document).ready(function() {
    $(document).on("click", ".delete-row", function(e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        var rowId = row.attr("data-row-id");

        $.ajax({
            url: "PHP/delete_row.php",
            method: "POST",
            data: {row_id: rowId},
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    row.remove();
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

/* ----------------------------- DELETING DATA --------------------------- */

function showModal(open, modalContent){
    const openButton = document.querySelector(open);
    const modalContainer = document.querySelector(modalContent);

    openButton && modalContainer ? (
        openButton.addEventListener('click', () => {
            modalContainer.classList.add('show');
        })
    ) : '';
}

showModal('#Borrow-Button', '#validation-wrapper');

const closeButton = document.querySelectorAll('.validation-button');

function closeModal(){
    const modalContainer = document.querySelector('#validation-wrapper');
    modalContainer.classList.remove('show');
}

closeButton.forEach(x => x.addEventListener('click', closeModal));